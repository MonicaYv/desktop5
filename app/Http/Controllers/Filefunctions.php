<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\File as FileModel ;
use App\Models\LightApp;
use App\Models\App;

class Filefunctions extends Controller
{

    public function createNewFile($fileatype, $destinationParentPath){
        $destinationPath = Storage::disk('root')->path($destinationParentPath);
        $sourcePath = Storage::disk('public')->path('newfile.'.$fileatype);
        $newFileName = 'New File.'.$fileatype;
        $actualpath = $destinationParentPath.'/'.$newFileName;
        $count = 1;
        $destinationfPath = $destinationPath.'/'.$newFileName;
        while (file_exists($destinationfPath)) {
            $newFileName = 'New File('.($count).').'.$fileatype;
            $destinationfPath = $destinationPath.'/'.$newFileName;
            $actualpath = $destinationParentPath.'/'.$newFileName;
            $count++;
        }
        
        $checkapp = checkLightApp($fileatype);
        $lightapp = LightApp::where('name',$checkapp)->where('status',1)->first();
        $lightapp = empty($lightapp) ? App::where('name',$checkapp)->where('status',1)->first():$lightapp;
        if (copy($sourcePath, $destinationfPath)) {
            $filetype = $this->getFiletype($destinationfPath);
            $fileSize = getFileSize($destinationfPath);
            $newFile = new FileModel();
            $newFile->name = $newFileName;
            $newFile->extension = $fileatype;
            $newFile->filetype = $filetype;
            $newFile->parentpath = $destinationParentPath;
            $newFile->path = $actualpath;
            $newFile->openwith = ($lightapp) ? $lightapp->id : '';
            $newFile->path = $actualpath;
            $newFile->filehash = md5(date('d-M-Y H:i:s'));
            $newFile->status = 1; // Assuming 1 means active
            $newFile->created_by = auth()->id(); // Assuming you want to save the ID of the authenticated user
            $newFile->size = $fileSize;
            $newFile->save();
            $appname =($lightapp) ? $lightapp->name :'';
            $appicon =($lightapp) ? $lightapp->icon :'';
            $returnarr = array('filekey'=> $newFile->id,'appkey'=> $newFile->openwith,'filename'=>$newFile->name,'appname'=>$appname,'appicon'=>$appicon);
            return $returnarr;

        }else{
            return false;
        }
    }

    // public function createNewFile($fileatype, $destinationParentPath){
    //     $destinationPath = Storage::disk('root')->path($destinationParentPath);
    //     $sourcePath = Storage::disk('public')->path('newfile.'.$fileatype);
    //     $newFileName = 'New File.'.$fileatype;
    //     $actualpath = $destinationParentPath.'/'.$newFileName;
    //     $count = 1;
    //     $destinationfPath = $destinationPath.'/'.$newFileName;
    //     while (file_exists($destinationfPath)) {
    //         $newFileName = 'New File('.($count).').'.$fileatype;
    //         $destinationfPath = $destinationPath.'/'.$newFileName;
    //         $actualpath = $destinationParentPath.'/'.$newFileName;
    //         $count++;
    //     }
        
    //     $checkapp = checkLightApp($fileatype);
    //     $lightapp = LightApp::where('name',$checkapp)->where('status',1)->first();
    //     $lightapp = empty($lightapp) ? App::where('name',$checkapp)->where('status',1)->first():$lightapp;
    //     if (copy($sourcePath, $destinationfPath)) {
    //         $filetype = $this->getFiletype($destinationfPath);
    //         $newFile = new FileModel();
    //         $newFile->name = $newFileName;
    //         $newFile->extension = $fileatype;
    //         $newFile->filetype = $filetype;
    //         $newFile->parentpath = $destinationParentPath;
    //         $newFile->path = $actualpath;
    //         $newFile->openwith = ($lightapp) ? $lightapp->id : '';
    //         $newFile->path = $actualpath;
    //         $newFile->filehash = md5(date('d-M-Y H:i:s'));
    //         $newFile->status = 1; // Assuming 1 means active
    //         $newFile->created_by = auth()->id(); // Assuming you want to save the ID of the authenticated user
    //         $newFile->save();
    //         $appname =($lightapp) ? $lightapp->name :'';
    //         $appicon =($lightapp) ? $lightapp->icon :'';
    //         $returnarr = array('filekey'=> $newFile->id,'appkey'=> $newFile->openwith,'filename'=>$newFile->name,'appname'=>$appname,'appicon'=>$appicon);
    //         return $returnarr;

    //     }else{
    //         return false;
    //     }
    // }

    public function getDocumentType($ext) {
        $ExtsDoc = array("doc", "docm", "docx", "dot", "dotm", "dotx", "epub", "fodt", "ott", "htm", "html", "mht", "odt", "pdf", "rtf", "txt", "djvu", "xps");
        $ExtsPre = array("fodp", "odp", "pot", "potm", "potx", "pps", "ppsm", "ppsx", "ppt", "pptm", "pptx", "otp");
        $ExtsSheet = array("xls", "xlsx", "xltx", "ods", "ots", "csv", "xlt", "xltm", "fods");
        if (in_array($ext,$ExtsDoc)) {
            return "word";
        } elseif (in_array($ext,$ExtsPre)) {
            return "presentation";
        } elseif (in_array($ext,$ExtsSheet)) {
            return "spreadsheet";
        } else {
            return "undefined";
        }
    }
    
    public function fileTypeAlias($ext) {
        if (strpos(".docm.dotm.dot.wps.wpt",'.'.$ext) !== false) {
            $ext = 'doc';
        } else if (strpos(".xlt.xltx.xlsm.dotx.et.ett",'.'.$ext) !== false) {
            $ext = 'xls';
        } else if (strpos(".pot.potx.pptm.ppsm.potm.dps.dpt",'.'.$ext) !== false) {
            $ext = 'ppt';
        }
        return $ext;
    }
    
    public function getFiletype($file){
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file);
        finfo_close($finfo);
        $mimeParts = explode('/', $mime);
        return $mimeParts[0];
    }

    public function getFileSize($filePath)
    {
        if (File::exists($filePath)) {
            $size = File::size($filePath);
            return $size;
        } else {
            return false;
        }
    }
    
    private function folderSize($directory)
    {
        $size = 0;
        foreach (File::allFiles($directory) as $file) {
            $size += $file->getSize();
        }
        return $size;
    }

    // Function to reorder the array
    public function moveSubArrayToTop(&$array, $filekeyToMove) {
        foreach ($array as $key => $subArray) {
            foreach ($subArray as $item) {
                if ($item['filekey'] === $filekeyToMove) {
                    // Move the matching sub-array to the top
                    $temp = [$key => $array[$key]];
                    unset($array[$key]);
                    $array = $temp + $array;
                    break 2;
                }
            }
        }
    }
}

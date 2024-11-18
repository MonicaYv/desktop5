<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'extension',
        'path',
        'openwith',
        'parentpath',
        'filetype',
        'folder',
        'sort_order',
        'status',
        'created_by'
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder');
    }
}


?>
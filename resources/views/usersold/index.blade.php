<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>User List</h2>
  <p>Please add user's as per requirment</p>
  <a href="{{ route('user-add') }}"><button type="button" class="btn btn-primary">Add User</button></a>
  <a href="{{ route('roles') }}"><button type="button" class="btn btn-primary">Roles</button></a>
  <a href="{{ route('permissions') }}"><button type="button" class="btn btn-primary">Document/Permissions</button></a>
  <a href="{{ route('groups') }}"><button type="button" class="btn btn-primary">Groups</button></a>
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4"></div>
    <div class="col-sm-4"></div>
  </div>                                                                                      
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
          <tbody> 
                  @php $count = 1 @endphp
                  @foreach($users as $user)
                    <tr>
                      <td>{{ $count }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        <a href="{{ route('user-edit',['id' => $user->id]) }}"><button type="button" class="btn btn-info">Edit</button></a>
                        <!-- <a href="{{ route('user-delete',['id' => $user->id]) }}"><button type="button" class="btn btn-danger">Delete</button></a> -->
                      </td>
                    </tr>
                   @php $count++; @endphp
                  @endforeach
          </tbody>
  </table>
  </div>
</div>

</body>
</html>

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
  <a href="{{ route('users') }}"><button type="button" class="btn btn-default">Back</button></a>
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4"></div>
    <div class="col-sm-4"></div>
  </div>                                                                                      
  <div class="table-responsive">          
    <form action="{{ route('user-update',['id' => $user->id]) }}" method="POST">
       @csrf
      <div class="form-group">
        <label for="email">Name(username):</label>
        <input type="text" class="form-control" id="email" placeholder="Enter name" name="name" value="{{ $user->username }}">
      </div>
      <div class="form-group">
        <label for="email">Nick-Name:</label>
        <input type="text" class="form-control" id="email" placeholder="Enter Nick-Name" name="nickName" value="{{ $user->name }}">
      </div>
      <div class="form-group">
        <label for="pwd">Email:</label>
        <input type="email" class="form-control" id="pwd" placeholder="Enter email" name="email" value="{{ $user->email }}">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" value="{{ $user->password }}">
      </div>
       <div class="form-group">
        <label for="email">Space-Size:</label>
        <input type="text" class="form-control" id="email" placeholder="Enter Space-Size" name="sizeMax" value="{{ $user->sizeMax }}">
      </div>
      <div class="form-group">
        <label for="sel1">Roles:</label>
          <select class="form-control" id="sel1" name="roleID">
             @foreach($roles as $role)
              <option value="{{ $role->id }}" @php echo ($role->id == $user->roleID)?'selected':'' @endphp>{{ $role->name }}</option>
             @endforeach
          </select>
      </div>
      <div class="form-group">
        <label for="sel1">Groups:</label>
          <select class="form-control" id="sel1" name=" groupID">
             @foreach($groups as $group)
              <option value="{{ $group->id }}" @php echo ($group->id == $user->groupID)?'selected':'' @endphp>{{ $group->name }}</option>
             @endforeach
          </select>
      </div>

      <button type="submit" class="btn btn-info">Update</button>
    </form>
  </div>
</div>

</body>
</html>

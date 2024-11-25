<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../public/js/jsUserList.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/styleUserList.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>User List</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>Manage Users</h1>
            <button type="button" onclick="creationAdmin()">Add Administrator</button>
        </div>
        <div class="user-list">
            <table id="idTable-user">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Inscription Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AlejandroBerrio</td>
                        <td>Administrator</td>
                        <td>2024-11-24</td>
                        <td>
                            <button type="button" id="edit-user" class="btn btn-primary" data-toggle="modal" data-target="#edit-user-modal">Edit</button>
                            &nbsp;
                            <button type="button" id="delete-user" class="btn btn-primary" data-toggle="modal" data-target="#delete-user-modal">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>DiegoBerrio</td>
                        <td>User</td>
                        <td>2024-11-24</td>
                        <td>
                            <button type="button" id="edit-user" class="btn btn-primary" data-toggle="modal" data-target="#edit-user-modal">Edit</button>
                            &nbsp;
                            <button type="button" id="delete-user" class="btn btn-primary" data-toggle="modal" data-target="#delete-user-modal">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Edit User Modal -->
    <div id="edit-user-modal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h3 class="modal-title">Edit</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" placeholder="Enter New User Name">
                        </div>
                        <div class="form-group">
                            <label>User Email</label>
                            <input type="text" class="form-control" placeholder="Enter New User Email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete User Modal -->
    <div id="delete-user-modal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h3 class="modal-title">Delete User</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
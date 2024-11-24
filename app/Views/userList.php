<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css//styleUserList.css">
    <script src="../../public/js/jsUserList.js"></script>
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
                        <td><button type="button" class="edit-user">Edit</button>&nbsp;<button type="button" class="delete-user">Delete</button></td>
                    </tr>
                    <tr>
                        <td>DiegoBerrio</td>
                        <td>User</td>
                        <td>2024-11-24</td>
                        <td><button type="button" class="edit-user">Edit</button>&nbsp;<button type="button" class="delete-user">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
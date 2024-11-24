<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styleAdminCreation.css">
    <title>Admin Creation</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>New Admin</h1>
        </div>
        <div class="add-admin-container">
            <form id="admin-creation-form">
                <table>
                    <tr>
                        <td><label for="username">Username: </label></td>
                        <td><input type="text" name="username" id="username"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email: </label></td>
                        <td><input type="text" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password: </label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                </table>
                <br/>
                <button type="submit">Create Admin</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
session_start();
if ($_SESSION['role'] == 1) {


    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    include_once("../components/connection.php");

    if (isset($_POST['update'])) {
        $id = $_POST['UserID'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);
        $role = $_POST['role'];

        $result = mysqli_query($mysqli, "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE UserID=$id");

        if ($result) {
            header("Location: index.php");
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = mysqli_query($mysqli, "SELECT * FROM users WHERE UserID=$id");

        if ($result) {
            $user_data = mysqli_fetch_array($result);
            $username = $user_data['username'];
            $email = $user_data['email'];
            $role = $user_data['role'];
            $password = $user_data['password'];
        } else {
            echo "Error fetching record: " . mysqli_error($mysqli);
        }
    } else {
        echo "No user ID provided.";
        exit();
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit User Data</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
            }

            .admin {
                max-width: 1200px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            h1 {
                text-align: center;
                color: #333;
            }

            a.back {
                display: inline-block;
                margin-bottom: 20px;
                padding: 10px 20px;
                background-color: rgb(255, 81, 0);
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            a.back:hover {
                background-color: rgb(133, 0, 0);
            }

            a {
                display: inline-block;
                margin-bottom: 20px;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            a:hover {
                background-color: #0056b3;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            table,
            th,
            td {
                border: 1px solid #ddd;
            }

            th,
            td {
                padding: 15px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
                color: #333;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            tr:hover {
                background-color: #f1f1f1;
            }

            .form-container {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            .form-container table {
                width: 100%;
                border: none;
            }

            .form-container td {
                padding: 10px;
            }

            .form-container input[type="text"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .form-container input[type="radio"] {
                margin-right: 10px;
            }

            .form-container input[type="submit"] {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .form-container input[type="submit"]:hover {
                background-color: #0056b3;
            }
        </style>
    </head>

    <body>

        <form class="form-container" name="update_user" method="POST" action="edit.php">
            <table border="0">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" value="<?php echo $password; ?>"></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                        <input type="radio" name="role" value="0" <?php if ($_SESSION['role'] == 0) {echo "checked";} ?> required> User
                        <input type="radio" name="role" value="1" <?php if ($_SESSION['role'] == 1) {echo "checked";} ?> required> Admin
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <a class="back" href="index.php">Go Back</a>
                        </center>
                        <input type="hidden" name="UserID" value="<?php echo $id; ?>">
                    </td>
                    <td><input type="submit" name="update" value="Update"></td>
                </tr>
            </table>
        </form>
    </body>

    </html>

<?php
} else { // if not admin
    header("Location: ../accessDenied.html");
    exit();
}
?>
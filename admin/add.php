<?php
session_start();
if ($_SESSION['role'] == 1) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Page</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
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
                width: 100%;
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

            .form-container input[type="text"],
            .form-container input[type="password"] {
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

            button {
                padding: 17px 40px;
                border-radius: 10px;
                border: 0;
                background-color: rgb(255, 56, 86);
                letter-spacing: 1.5px;
                font-size: 15px;
                transition: all 0.3s ease;
                box-shadow: rgb(201, 46, 70) 0px 10px 0px 0px;
                color: hsl(0, 0%, 100%);
                cursor: pointer;
            }

            button:hover {
                box-shadow: rgb(201, 46, 70) 0px 7px 0px 0px;
            }

            button:active {
                background-color: rgb(255, 56, 86);
                /*50, 168, 80*/
                box-shadow: rgb(201, 46, 70) 0px 0px 0px 0px;
                transform: translateY(5px);
                transition: 200ms;
            }
        </style>
    </head>

    <body>

        <form action="add.php" method="POST" name="form1" class="form-container">
            <table width="25%" border="0">
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                        <input type="radio" name="role" value="0"> User
                        <input type="radio" name="role" value="1"> Admin
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <a class="back" href="index.php">Go Back</a>
                        </center>
                    </td>
                    <td><input type="submit" name="Submit" value="Add" class="submit"></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['Submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = hash('sha256', $_POST['password']);
            $role = $_POST['role'];

            include_once("config.php");

            $result = mysqli_query($mysqli, "INSERT INTO users(username, email, password, role) VALUES('$username', '$email', '$password', '$role')");
        ?>
            <script>
                alert("User added successfully");
                window.location = "index.php";
            </script>
        <?php
        }
        ?>
    </body>

    </html>

<?php
} else {
    header("Location: ../accessDenied.html");
    exit();
}
?>
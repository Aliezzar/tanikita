<?php
session_start();
if ($_SESSION['role'] == 1) {

    include_once("config.php");
    $no = 0;

    $result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY UserID ASC");
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Qualycheck Admin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
            }

            .title {
                padding: 1rem;
                font-size: 1.5rem;
                font-weight: bold;
            }

            .sidebar {
                width: 16rem;
                background-color: #1f2937;
                color: white;
                height: 100vh;
                position: sticky;
                top: 0;
            }

            .admin {
                max-width: 1200px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            .sidebar-container {
                margin-top: 2.5rem;
            }

            .sidebar-container .child {
                background-color: #1F2937;
                display: block;
                padding: 0.625rem 1rem;
                border-radius: 0.375rem;
                transition: 0.2s;
                color: white;
                text-decoration: none;
            }

            h1 {
                text-align: center;
                color: #333;
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

            .choices a {
                margin-right: 10px;
                color: #007bff;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .choices a:hover {
                color: #0056b3;
            }
        </style>
    </head>

    <body style="background-color: #f3f4f6;">
        <section style="display: flex;">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="title">
                    <span style="color: #9ca3af;">Panel</span> Admin
                </div>
                <nav class="sidebar-container">
                    <a href="#" class="child">
                        <i class="fas fa-tachometer-alt" style="margin-right: 0.5rem;"></i> User Management System
                    </a>
                </nav>
            </div>

            <section class="admin">
                <h1>Admin Panel</h1>
                <a href="add.php">Add New User</a>
                <a href="logout.php">Logout</a> <br> <br>
                <table width='80%' border=1>
                    <tr>
                        <th>
                            <center>No.</center>
                        </th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>password</th>
                        <th>Role</th>
                        <th>Choices</th>
                    </tr>
                    <?php
                    while ($user_data = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td> <?php echo ++$no . "."; ?> </td>
                            <td> <?php echo $user_data['username']; ?> </td>
                            <td> <?php echo $user_data['email']; ?> </td>
                            <td> <?php echo $user_data['password']; ?> </td>
                            <td>
                                <?php
                                if ($user_data['role'] == 0) {
                                    echo "User";
                                } elseif ($user_data['role'] == 1) {
                                    echo "Admin";
                                } else {
                                    echo "Unknown";
                                }
                                ?>
                            </td>
                            <td>
                                <a href='edit.php?id=<?php echo $user_data["UserID"]; ?>'>Edit</a> |
                                <script>
                                    function deleteNotif() {
                                        if (confirm("yakin mau menghapus akun ini?")) {
                                            window.location.href = 'delete.php?hapus=<?= $user_data["UserID"]; ?>'
                                        }
                                    }
                                </script>
                                <a onclick="deleteNotif()" style="cursor: pointer;">Delete</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
            </section>
        </section>


    </body>

    </html>

<?php
} else { // if not admin
    header("Location: ../accessDenied.html");
    exit();
}
?>
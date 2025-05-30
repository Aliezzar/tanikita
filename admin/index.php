<?php
session_start();
if ($_SESSION['role'] === 0 || !isset($_SESSION['role'])) {
    header("Location: ../accessDenied.html");
    exit();
}

include_once("../components/connection.php");
$no = 0;

$query = 'SELECT * FROM users ORDER BY UserID ASC';
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaniKita Admin</title>
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
            padding: 10px;
            text-align: center;
            max-width: 490px;
            overflow-x: auto;
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
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
</head>

<body style="background-color: #f3f4f6;">
    <?php include_once 'components/header.php'; ?>
    <section style="display: flex;">
        <!-- Sidebar -->
        <?php include_once 'components/sidebar.php'; ?>

        <section class="admin">
            <h1>User Manajemen</h1>
            <a href="add.php">Add New User</a>
            <a href="logout.php">Logout</a>
            <a href="../index.php">Halaman utama</a>
             <br> <br>
            <table width='80%' border=1>
                <tr>
                    <th>
                        <center>No.</center>
                    </th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>password</th>
                    <th>profile</th>
                    <th>Role</th>
                    <th>Choices</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td> <?php echo ++$no . "."; ?> </td>
                        <td> <?php echo $row['username']; ?> </td>
                        <td> <?php echo $row['email']; ?> </td>
                        <td> <?php echo $row['password']; ?> </td>
                        <td>
                            <img src="../img/profile/<?= $row['profile_picture']; ?>" width="140px" alt="">
                        </td>
                        <td>
                            <?php
                            if ($row['role'] == 0) {
                                echo "User";
                            } elseif ($row['role'] == 1) {
                                echo "Admin";
                            } else {
                                echo "Unknown";
                            }
                            ?>
                        </td>
                        <td>
                            <a href='edit.php?id=<?php echo $row["UserID"]; ?>'>Edit</a> |
                            <a onclick="deleteNotif(<?= $row['UserID']; ?>, '<?= $row['profile_picture']; ?>')" style="cursor: pointer;">Delete</a>
                        </td>
                    </tr>
                <?php }
                ?>
        </section>
    </section>


    <script>
        function deleteNotif(id_user, foto_profil) {
            const lokasi = `../img/profile/${foto_profil}`;
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete.php?hapus=${id_user}&lokasi=${lokasi}&foto=${foto_profil}`;
                }
            });
        }
    </script>
</body>

</html>
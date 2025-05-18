<?php
function checkLogin() {
    global $conn;
    if (isset($_POST['submit'])) {
        $emailUsername = $_POST['email-username'];
        $password = hash('sha256', $_POST['password']);
      
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE (email = ?  OR username = ?) AND password = ?");
        mysqli_stmt_bind_param($stmt, "sss", $emailUsername, $emailUsername, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
      
      
        if ($result->num_rows > 0) {
          $row = mysqli_fetch_assoc($result);
          $_SESSION['username'] = $row['username'];
          $_SESSION['role'] = $row['role'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['UserID'] = $row['UserID'];
          $_SESSION['jenis_kelamin'] = $row['jenis_kelamin'];
          $_SESSION['profile_picture'] = $row['profile_picture'];
      
          session_regenerate_id(true);
      
          if ($row['role'] == 1) {
            header("Location: ../../admin/index.php");
          } else {
            header("Location: berhasil_login.php");
          }
          exit();
        } else {
          echo '
            <style>
            .container {
                display: none;
        }
            </style>
          <script>
          Swal.fire({
            icon: "error",
            title: "Login Gagal",
            text: "Email, nama atau password salah.",
          }).then(() => {
            document.querySelector(".container").style.display = "block";
          });
           </script>';
        }
      }
}

function checkRegister() {
    global $conn;
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $sanitizeEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = hash('sha256', $_POST['password']); 
        $cpassword = hash('sha256', $_POST['cpassword']);
        $jenis_kelamin = $_POST['jenis_kelamin'];
    
        if (filter_var($sanitizeEmail, FILTER_VALIDATE_EMAIL) && !empty($password)) {
            $allowedDomains = [
                'gmail.com',
                'yahoo.com',
                'outlook.com',
                'hotmail.com',
                'aol.com',
                'icloud.com',
                'protonmail.com',
                'zoho.com',
                'yandex.com',
                'mail.com',
                'gmx.com',
                'apple.com',
                'microsoft.com',
                'amazon.com',
                'facebook.com',
                'twitter.com',
                'qq.com',
                '163.com',
                'naver.com',
                'daum.net',
                'rambler.ru',
                'rediffmail.com'
            ];
            $emailDomain = substr(strrchr($sanitizeEmail, "@"), 1);
    
            if (!in_array($emailDomain, $allowedDomains)) {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Domain Tidak Diizinkan',
                    text: 'Gunakanlah email terpercaya seperti Gmail, Yahoo, Outlook, dll.'
                });
                </script>";
                exit();
            }
    
            if ($password == $cpassword) {
                $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ? OR username = ?");
                mysqli_stmt_bind_param($stmt, "ss", $email, $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (!$result->num_rows > 0) {
                    $sql = "INSERT INTO users (username, email, password, jenis_kelamin)
                            VALUES ('$username', '$email', '$password', '$jenis_kelamin')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Pendaftaran Berhasil',
                            text: 'Selamat, pendaftaran berhasil.',
                        }).then(() => {
                            window.location = 'index.php';
                        });
                        </script>";
                        $username = "";
                        $email = "";
                        $_POST['password'] = "";
                        $_POST['cpassword'] = "";
                        $jenis_kelamin = "";
                    } else {
                        echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Maaf, terjadi kesalahan.'
                        });
                        </script>";
                    }
                } else {
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ups, email atau username sudah terdaftar.'
                    });
                    </script>";
                }
            } else {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password tidak sesuai.'
                });
                </script>";
            }
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Email tidak valid atau password kosong.'
            });
            </script>";
        }
    }
}

?>
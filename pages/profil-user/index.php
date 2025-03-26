<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body style="background-color: black;">
    <nav>
        <a href="." class="logo">Qualy<span>Check</span></a>
        <ul style="color: black;">
            <li><a href="../../.#home">Home</a></li>
            <li><a href="../../.#informasi">informasi</a></li>
            <li><a href="../about.php">Tentang Kami</a></li>
            <?php if (isset($_SESSION['username'])) { ?>
                <li>
                    <div class="container">
                        <div class="dropdown" id="dropdown-content">
                            <a class="dropdown__button" id="dropdown-button">
                                <i class="ri-user-3-line dropdown__icon"></i>
                                <span class="dropdown__name">Akun</span>
                                <div class="dropdown__icons">
                                    <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                                    <i class="ri_close-line dropdown__close"></i>
                                </div>
                            </a>

                            <ul class="dropdown__menu">
                                <li class="dropdown__item" onclick="href('.')">
                                    <i class="ri-user-3-line dropdown__icon"></i>
                                    <span class="dropdown__name">Profil</span>
                                </li>

                                <li class="dropdown__item" onclick="href('../login-register/logout.php')">
                                    <i class="ri-logout-box-line dropdown__icon"></i>
                                    <span class="dropdown__name">Log out</span>
                                </li>

                                <li class="dropdown__item cursor: pointer;" onclick="deleteAccount()">
                                    <i class="ri-delete-bin-line dropdown__icon"></i>
                                    <span class="dropdown__name">Hapus Akun</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <script>
                        /*=============== DROPDOWN JS ===============*/
                        const showDropdown = (content, button) => {
                            const dropdownContent = document.getElementById(content),
                                dropdownButton = document.getElementById(button);

                            dropdownButton.addEventListener("click", () => {
                                // We add the show-dropdown class, so that the menu is displayed
                                dropdownContent.classList.toggle("show-dropdown");
                            });
                        };

                        showDropdown("dropdown-content", "dropdown-button");
                    </script>
                </li>
            <?php } else { ?>
                <li>
                    <a href="../login-register">Sign in / Sign up</a>
                </li>
            <?php } ?>
        </ul>
        <div class="menu-toggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <section class="container">
        <div class="profile-edit">
            <h2>Edit Profil</h2>
            <form action="update-profile.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="profile_picture">Foto Profil:</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="password">Password Baru:</label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </section>

    <!-- script -->
    <script src="javascript/script.js"></script>
</body>

</html>
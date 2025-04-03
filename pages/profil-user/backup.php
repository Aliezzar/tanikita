<form action="update-profile.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <?php //echo htmlspecialchars($user['UserID']); 
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']);?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']);?>" required>
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



                <?php if ($_SESSION['jenis_kelamin'] == null) {
                                echo htmlspecialchars('Undefined');
                            } else {
                                echo htmlspecialchars($_SESSION['jenis_kelamin']);
                            } ?>
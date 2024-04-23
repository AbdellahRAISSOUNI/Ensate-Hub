<div class="header" style="background-color: #15429b; color: #fff; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">    <div class="pull-left">
        <div class="logo">
            <a href="dashboard.php" style="color: #fff; text-decoration: none;">
                <!-- <img src="assets/images/logo.png" alt="" /> -->
                <span style="color: #ffffff;">Ensaté-Hub Admin</span>
            </a>
        </div>
        <div class="hamburger sidebar-toggle">
            <span class="line" style="background-color: #fff;"></span>
            <span class="line" style="background-color: #fff;"></span>
            <span class="line" style="background-color: #fff;"></span>
        </div>
    </div>

    <div class="pull-right p-r-15">
        <ul>
            <?php
            $aid = $_SESSION['ocasaid'];
            $sql = "SELECT * from tbladmin where ID=:aid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':aid', $aid, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
                foreach ($results as $row) {
            ?>
                    <li class="header-icon dib">
                        <img class="avatar-img" src="../assets/images/avatar/images (1).png" alt="" />
                        <span class="user-avatar" style="color: #fff;"><?php echo $row->AdminName; ?> <i class="ti-angle-down f-s-10"></i></span>
                        <div class="drop-down dropdown-profile">
                            <div class="dropdown-content-heading" style="background-color: #ffffff; color: #fff; padding: 10px;">
                                <span class="text-left"><?php echo $row->Email; ?></span>
                                <p class="trial-day"><?php echo $row->MobileNumber; ?></p>
                            </div>
                            <div class="dropdown-content-body" style="background-color: #fff; color: #333; padding: 10px;">
                                <ul>
                                    <li><a href="profile.php" style="text-decoration: none; color: #333;"><i class="ti-user"></i> <span>Profile</span></a></li>
                                    <li><a href="change-password.php" style="text-decoration: none; color: #333;"><i class="ti-settings"></i> <span>Setting</span></a></li>
                                    <li><a href="logout.php" style="text-decoration: none; color: #333;"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
            <?php $cnt = $cnt + 1;
                }
            } ?>
        </ul>
    </div>
</div>
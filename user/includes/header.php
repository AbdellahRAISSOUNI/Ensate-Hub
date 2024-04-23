<div class="header" style="background-color: #15429b; color: #fff;">
    <div class="pull-left">
        <div class="logo">
            <a href="dashboard.php" style="color: #fff; text-decoration: none;">
                <!-- <img src="assets/images/logo.png" alt="" /> -->
                <span style="color: #ffffff;">Ensaté-Hub Etudiant</span>            </a>
        </div>
        <div class="hamburger sidebar-toggle">
            <span class="line" style="background-color: #fff;"></span>
            <span class="line" style="background-color: #fff;"></span>
            <span class="line" style="background-color: #fff;"></span>
        </div>
    </div>

    <div class="pull-right p-r-15">
        <ul>
            <li class="header-icon dib">
                <i class="ti-bell" style="color: #fff;"></i>
                <div class="drop-down">
                    <div class="dropdown-content-heading" style="background-color: #ffffff; color: #fff; padding: 10px;">
                        <span class="text-left">Recent Notifications</span>
                    </div>
                    <div class="dropdown-content-body" style="background-color: #fff; color: #333; padding: 10px;">
                        <ul>
                            <?php
                            $cid = $_SESSION['ocasucid'];
                            $uid = $_SESSION['ocasuid'];
                            $currentdate = date('Y-m-d');
                            $sql = "SELECT tblassigment.AssignmentNumber, tblassigment.AssignmenttTitle, tblassigment.SubmissionDate, tblassigment.ID as aid from tblassigment 
                                    join tblcourse on tblcourse.ID=tblassigment.Cid 
                                    where (tblassigment.Cid=$cid and tblassigment.SubmissionDate >='$currentdate') && (tblassigment.ID not in(select AssId from tbluploadass where UserID='$uid'))";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) {
                                    ?>
                                    <li>
                                        <a href="submit-assignment.php?sid=<?php echo $row->aid; ?>" style="text-decoration: none; color: #333;">
                                            <img class="pull-left m-r-10 avatar-img" src="../assets/images/list.png" alt="" />
                                            <div class="notification-content">
                                                <small class="notification-timestamp pull-right" style="color: #15429b;"><?php echo $row->AssignmentNumber; ?></small>
                                                <div class="notification-heading"><?php echo $row->AssignmenttTitle; ?></div>
                                                <div class="notification-text">Last Date- <?php echo $row->SubmissionDate; ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php
                                }
                            } else {
                                ?>
                                <p style="color: #15429b; font-weight: bold;">No Record Found</p>
                            <?php } ?>
                            <li class="text-center">
                                <a href="new-assignment.php" class="more-link" style="color: #15429b;">See All</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php
            $uid = $_SESSION['ocasuid'];
            $sql = "SELECT FullName, Email, MobileNumber from tbluser where ID=:uid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
                foreach ($results as $row) {
                    ?>
                    <li class="header-icon dib">
                        <img class="avatar-img" src="../assets/images/avatar/images (1).png" alt="" />
                        <span class="user-avatar" style="color: #fff;"><?php echo $row->FullName; ?> <i class="ti-angle-down f-s-10"></i></span>
                        <div class="drop-down dropdown-profile">
                            <div class="dropdown-content-heading" style="background-color: #15429b; color: #fff; padding: 10px;">
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
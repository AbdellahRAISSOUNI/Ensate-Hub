<div class="header" style="background-color: #15429b; color: #fff; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">    <div class="pull-left">
        <div class="logo">
            <a href="dashboard.php" style="color: #fff; text-decoration: none;">
                <!-- <img src="../assets/images/logo.png" alt="" /> -->
                <span style="color: #ffffff;">Ensaté-Hub Professeur</span>
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
            $tid = $_SESSION['ocastid'];
            $currentdate = date('Y-m-d');
            $sql = "SELECT tbluser.FullName, tbluser.RollNumber, tblassigment.AssignmentNumber, tblassigment.AssignmenttTitle, tblassigment.SubmissionDate, tblassigment.ID as aid, tbluploadass.SubmitDate, tbluploadass.AssId, tbluploadass.UserID from tblassigment 
                    join tbluploadass on tbluploadass.AssId=tblassigment.ID 
                    join tbluser on tbluser.Id=tbluploadass.UserID
                    where (tblassigment.Tid='$tid') and tbluploadass.Marks is null";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            $uploadedassign = $query->rowCount();
            if ($query->rowCount() > 0) {
            ?>
                <li class="header-icon dib">
                    <i class="ti-email" style="color: #fff;"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-heading" style="background-color: #15429b; color: #fff; padding: 10px;">
                            <span class="text-left"><?php echo $uploadedassign; ?> Nouvelle Affectation</span>
                        </div>
                        <div class="dropdown-content-body" style="background-color: #fff; color: #333; padding: 10px;">
                            <ul>
                                <?php
                                foreach ($results as $row) {
                                ?>
                                    <li class="notification-unread">
                                        <a href="submit-assignment.php?assinid=<?php echo $row->AssId; ?>&&uid=<?php echo $row->UserID; ?>" style="text-decoration: none; color: #333;">
                                            <img class="pull-left m-r-10 avatar-img" src="../assets/images/list.png" alt="" />
                                            <div class="notification-content">
                                                <small class="notification-timestamp pull-right"><?php echo $row->SubmitDate; ?></small>
                                                <div class="notification-heading">
                                                    <?php echo $row->FullName; ?>(<?php echo $row->RollNumber; ?>)
                                                </div>
                                                <div class="notification-text">Affectations disponibles</div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>

                                <li class="text-center">
                                    <a href="#" class="more-link" style="color: #15429b;">Voir tout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php }
            $tid = $_SESSION['ocastid'];
            $sql = "SELECT * from tblteacher where ID=:tid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':tid', $tid, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
                foreach ($results as $row) {
            ?>
                    <li class="header-icon dib">
                        <img class="avatar-img" src="../assets/images/avatar/images (1).png" alt="" />
                        <span class="user-avatar" style="color: #fff;"><?php echo $row->FirstName; ?> <i class="ti-angle-down f-s-10"></i></span>
                        <div class="drop-down dropdown-profile">
                            <div class="dropdown-content-heading" style="background-color: #ffffff; color: #fff; padding: 10px;">
                                <span class="text-left"><?php echo $row->Email; ?></span>
                                <p class="trial-day"><?php echo $row->MobileNumber; ?></p>
                            </div>
                            <div class="dropdown-content-body" style="background-color: #fff; color: #333; padding: 10px;">
                                <ul>
                                    <li><a href="profile.php" style="text-decoration: none; color: #333;"><i class="ti-user"></i> <span>Profile</span></a></li>
                                    <li><a href="change-password.php" style="text-decoration: none; color: #333;"><i class="ti-settings"></i> <span>Paramètres</span></a></li>
                                    <li><a href="logout.php" style="text-decoration: none; color: #333;"><i class="ti-power-off"></i> <span>Déconnexion</span></a></li>
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
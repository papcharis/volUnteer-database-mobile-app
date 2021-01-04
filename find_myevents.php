<?php

    function find_myevents(mysqli $conn, $mode) {
        session_start();
        if (!isset($_SESSION['loggedin'])) {
            header('Location: index.html');
            exit;
          }

        $username = $_SESSION['username'];
        // $username = 'edi14';

        $sql = "SELECT Role_Title, Activity_ID FROM hires
        WHERE Volunteer_Username= '$username'";

        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $RecPos = 280;
            $ActNamePos = 284;
            $DurationPos= 310;
            $RolePos = 330;
            $LocPos = 353;
            $ButtonPos = 340;
            $TextPos = 345;

            $text1 = 284;
            $text2 = 310;
            $text3 = 332;
            $text4 = 353;
            $text5 = 284;
            $text6 = 284;

            # find completed events
            if($mode == 'completed') {
                while($row = $result->fetch_assoc()) {
                    $actId = $row['Activity_ID'];
                    $sql2 = "SELECT ActName, City, Start_Date, End_Date FROM voluntary_activity
                    WHERE Activity_ID= '$actId'";

                    $act_result = $conn->query($sql2);
                    $record = $act_result->fetch_row();

                    # event_end_date < current date
                    if($record[3] < date('Y-m-d')) {

                        echo '<div class="rectangle"  style = "
                        position: absolute;
                        width: 320px;
                        height: 100px;
                        left: 27px;
                        top: '.$RecPos.'px;
                        background: #C1D5D5;
                        border-radius: 15px;"></div>';

                        echo '<div class="duration" style = "
                        top: '.$DurationPos.'px;
                        "
                        >
                            <img src="./images/duration-small.svg" alt="" />
                        </div>';
                        echo '<div class="role" style = "
                        top: '.$RolePos.'px;
                        ">
                            <img src="./images/role-small.svg" alt="" />
                        </div>';
                        echo '<div class="location" style = "
                        top: '.$LocPos.'px;
                        ">
                            <img src="./images/location-small.svg" alt="" />
                        </div>';

                        echo '<div class="actname" style = "
                        top: '.$text1.'px;
                        ">
                        '.$record[0].'
                        </div>';
                        echo '<div class="durationText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                        top: '.$text2.'px;
                        ">
                        '.$record[2].' - '.$record[3].'
                        </div>';
                        echo '<div class="roleText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                        top: '.$text3.'px;
                        ">
                        '.$row['Role_Title'].'
                        </div>';
                        echo '<div class="locationText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                        top: '.$text4.'px;
                        ">
                        '.$record[1].'
                        </div>';

                        echo '<a href="./review.php">
                            <div class="review" style = "
                            top: '.$ButtonPos.'px;
                            "></div>
                            <div class="review-1" style = "
                            top: '.$TextPos.'px;
                            ">
                            Review
                            </div>
                            <div class="review-2" style = "
                            top: '.$TextPos.'px;
                            ">
                                <img src="./images/arrow-small.svg" alt="" />
                            </div>
                        </a>';

                        $RecPos = $RecPos +120;
                        $ActNamePos = $ActNamePos + 120;
                        $DurationPos= $DurationPos + 120;
                        $RolePos = $RolePos + 120;
                        $LocPos = $LocPos + 120;
                        $ButtonPos = $ButtonPos + 120;
                        $TextPos = $TextPos +120;
                        $text1 = $text1 + 120;
                        $text2 = $text2 + 120;
                        $text3 = $text3 + 120;
                        $text4 = $text4 + 120;
                        $text5 = $text5 + 120;
                        $text6 = $text6 + 120;
                    }
                }
            }



            # find upcoming events
            if($mode == 'upcoming') {
                while($row = $result->fetch_assoc()) {
                    $actId = $row['Activity_ID'];
                    $sql2 = "SELECT ActName, City, Start_Date, End_Date FROM voluntary_activity
                    WHERE Activity_ID= '$actId'";

                    $act_result = $conn->query($sql2);
                    $record = $act_result->fetch_row();

                    # event_start_date > current date
                    if($record[2] > date('Y-m-d')) {

                        echo '<div class="rectangle"  style = "
                        position: absolute;
                        width: 320px;
                        height: 100px;
                        left: 27px;
                        top: '.$RecPos.'px;
                        background: #FFC59D;
                        border-radius: 15px;"></div>';

                        echo '<div class="duration" style = "
                        top: '.$DurationPos.'px;
                        "
                        >
                            <img src="./images/duration-small.svg" alt="" />
                        </div>';
                        echo '<div class="role" style = "
                        top: '.$RolePos.'px;
                        ">
                            <img src="./images/role-small.svg" alt="" />
                        </div>';
                        echo '<div class="location" style = "
                        top: '.$LocPos.'px;
                        ">
                            <img src="./images/location-small.svg" alt="" />
                        </div>';

                        echo '<div class="actname" style = "
                        top: '.$text1.'px;
                        ">
                        '.$record[0].'
                        </div>';
                        echo '<div class="durationText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                          top: '.$text2.'px;
                        ">
                        '.$record[2].' - '.$record[3].'
                        </div>';
                        echo '<div class="roleText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                        top: '.$text3.'px;
                        ">
                        '.$row['Role_Title'].'
                        </div>';
                        echo '&nbsp';
                        echo '<div class="locationText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                        top: '.$text4.'px;
                        ">
                        '.$record[1].'
                        </div>';

                        $RecPos = $RecPos +120;
                        $ActNamePos = $ActNamePos + 120;
                        $DurationPos= $DurationPos + 120;
                        $RolePos = $RolePos + 120;
                        $LocPos = $LocPos + 120;
                        $ButtonPos = $ButtonPos + 120;
                        $TextPos = $TextPos +120;
                        $text1 = $text1 + 120;
                        $text2 = $text2 + 120;
                        $text3 = $text3 + 120;
                        $text4 = $text4 + 120;
                        $text5 = $text5 + 120;
                        $text6 = $text6 + 120;
                    }
                }
            }



            if($mode == 'inprogress') {
                while($row = $result->fetch_assoc()) {
                    $actId = $row['Activity_ID'];
                    $sql2 = "SELECT ActName, City, Start_Date, End_Date FROM voluntary_activity
                    WHERE Activity_ID= '$actId'";

                    $act_result = $conn->query($sql2);
                    $record = $act_result->fetch_row();

                    # event start date <= current date <= event end date
                    if($record[2] <= date('Y-m-d') && $record[3] >= date('Y-m-d')) {

                        echo '<div class="rectangle"  style = "
                        position: absolute;
                        width: 320px;
                        height: 100px;
                        left: 27px;
                        top: '.$RecPos.'px;
                        background: #D9B8CB;
                        border-radius: 15px;"></div>';

                        echo '<div class="duration" style = "
                        top: '.$DurationPos.'px;
                        "
                        >
                            <img src="./images/duration-small.svg" alt="" />
                        </div>';
                        echo '<div class="role" style = "
                        top: '.$RolePos.'px;
                        ">
                            <img src="./images/role-small.svg" alt="" />
                        </div>';
                        echo '<div class="location" style = "
                        top: '.$LocPos.'px;
                        ">
                            <img src="./images/location-small.svg" alt="" />
                        </div>';

                        echo '<div class="actname" style = "
                        top: '.$text1.'px;
                        ">
                        '.$record[0].'
                        </div>';
                        echo '<div class="durationText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                        top: '.$text2.'px;
                        ">
                        '.$record[2].' - '.$record[3].'
                        </div>';
                        echo '<div class="roleText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                        top: '.$text3.'px;
                        ">
                        '.$row['Role_Title'].'
                        </div>';
                        echo '<div class="locationText" style = "font-family: Montserrat;
                          font-style: normal;
                          font-weight: normal;
                          font-size: 13px;
                          line-height: 16px;
                          text-align: center;
                          color: #544A4A;
                          position: absolute;
                          width: auto;
                          left: 65px;
                        top: '.$text4.'px;
                        ">
                        '.$record[1].'
                        </div>';

                        $RecPos = $RecPos +120;
                        $ActNamePos = $ActNamePos + 120;
                        $DurationPos= $DurationPos + 120;
                        $RolePos = $RolePos + 120;
                        $LocPos = $LocPos + 120;
                        $ButtonPos = $ButtonPos + 120;
                        $TextPos = $TextPos +120;
                        $text1 = $text1 + 120;
                        $text2 = $text2 + 120;
                        $text3 = $text3 + 120;
                        $text4 = $text4 + 120;
                        $text5 = $text5 + 120;
                        $text6 = $text6 + 120;
                    }
                }
            }
        }
    }
?>

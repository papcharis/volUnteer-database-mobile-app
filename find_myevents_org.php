<?php

    function find_myevents_org(mysqli $conn, $mode) {
        session_start();
        if (!isset($_SESSION['loggedin'])) {
            header('Location: login.html');
            exit;
        }


        $username = $_SESSION['username'];
        $org_id=0;
        $name="";

        $sql0 = "SELECT organizer_ID FROM accountso WHERE username='$username'";
        $sql0_result = $conn->query($sql0);
        if ($sql0_result->num_rows > 0) {
            $record = $sql0_result->fetch_row();
            $org_id = $record[0];
        }

        $sql1 = "SELECT Name FROM organizer_profile WHERE organizer_ID='$org_id'";
        $sql1_result = $conn->query($sql1);
        if ($sql1_result->num_rows > 0) {
            $record = $sql1_result->fetch_row();
            $name = $record[0];
        }
        else {
            echo "QUERY ERROR";
        }


        $sql = "SELECT ActName, Activity_ID, City, Street, ZipCode, VolunteersNeeded, Start_Date, End_Date FROM voluntary_activity
        WHERE Organizer_ID= '$org_id'";

        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $RecPos = 270;
            $ActNamePos = 280;
            $DurationPos= 305;
            $VolNeededPos = 335;
            $LocPos = 365;
            $IdPos = 391;
            $BtnsPos = 425;
            $IdText = 390.25;
            $BtnsTextsPos = 415;

            $text2 = 305;
            $text3 = 335;
            $text4 = 365;

            # find upcoming events
            if($mode == 'upcoming') {
                while($row = $result->fetch_assoc()) {

                    # event_end_date > current date
                    if($row['Start_Date'] > date('Y-m-d')) {

                        echo '<div class="rectangle"  style = "
                        top: '.$RecPos.'px;
                        "></div>';

                        echo '<div class="duration" style = "
                        top: '.$DurationPos.'px;
                        ">
                            <img src="./images/duration-small.svg" alt="" />
                        </div>';
                        echo '<div class="staff" style = "
                        top: '.$VolNeededPos.'px;
                        ">
                            <img src="./images/role-small.svg" alt="" />
                        </div>';
                        echo '<div class="location" style = "
                        top: '.$LocPos.'px;
                        ">
                            <img src="./images/location-small.svg" alt="" />
                        </div>';
                        echo '<div class="id" style = "
                        top: '.$IdPos.'px;
                        ">
                            <img src="./images/id-icon-small.svg" alt="" />
                        </div>';

                        $actname = $row['ActName'];
                        $actname = strlen($actname) > 30 ? substr($actname,0,30)."..." : $actname;
                        echo '<div class="actname" style = "
                        top: '.$ActNamePos.'px;
                        ">
                        '.$actname.'
                        </div>';
                        echo '<div class="InfoText" style = "
                        top: '.$DurationPos.'px;
                        ">
                        '.$row['Start_Date'].' - '.$row['End_Date'].'
                        </div>';
                        echo '<div class="InfoText" style = "
                        top: '.$VolNeededPos.'px;
                        ">
                        '.$row['VolunteersNeeded'].'
                        </div>';
                        echo '<div class="InfoText" style = "
                        top: '.$LocPos.'px;
                        ">
                        '.$row['Street'].', '.$row['ZipCode']. ', ' .$row['City'].'
                        </div>';
                        echo '<div class="IdText" style = "
                        top: '.$IdText.'px;
                        ">
                        '.$row['Activity_ID'].'
                        </div>';

                        echo '<a href="add-staff.php?ActID='.urldecode($row['Activity_ID']).'">
                            <div class="edit" style=" top: '.$BtnsTextsPos.'px"></div>
                            <div class="edit-1" style= " top: '.$BtnsPos.'px">
                            Add Staff
                            </div>
                            <div class="edit-2" style= " top: '.$BtnsPos.'px" >
                                <img src="./images/arrow-small.svg" alt="" />
                            </div>
                        </a>';
                        echo '<a href="handle-volunteers.php?ActID='.urldecode($row['Activity_ID']).'">
                            <div class="handle" style= " top: '.$BtnsTextsPos.'px"></div>
                            <div class="handle-1" style= " top: '.$BtnsPos.'px">
                            Handle Volunteers
                            </div>
                            <div class="handle-2" style= " top: '.$BtnsPos.'px" >
                                <img src="./images/arrow-small.svg" alt="" />
                            </div>
                        </a>';

                        $RecPos = $RecPos +215;
                        $ActNamePos = $ActNamePos + 215;
                        $DurationPos= $DurationPos + 215;
                        $VolNeededPos = $VolNeededPos + 215;
                        $LocPos = $LocPos + 215;
                        $IdPos = $IdPos + 215;
                        $BtnsPos = $BtnsPos + 215;
                        $BtnsTextsPos = $BtnsTextsPos +215;
                        $text2 = $text2 + 215;
                        $text3 = $text3 + 215;
                        $text4 = $text4 + 215;
                        $IdText = $IdText + 215;
                    }
                }
            }


            #  find completed events
            if($mode == 'completed') {
                $LocPos = 340;
                while($row = $result->fetch_assoc()) {

                    # event_end_date > current date
                    if($row['End_Date'] < date('Y-m-d')) {

                        echo '<div class="rectangle"  style = "
                        top: '.$RecPos.'px;
                        "></div>';

                        echo '<div class="duration" style = "
                        top: '.$DurationPos.'px;
                        ">
                            <img src="./images/duration-small.svg" alt="" />
                        </div>';

                        // echo '<div class="staff" style = "
                        // top: '.$VolNeededPos.'px;
                        // ">
                        //     <img src="./images/role-small.svg" alt="" />
                        // </div>';

                        echo '<div class="location" style = "
                        top: '.$LocPos.'px;
                        ">
                            <img src="./images/location-small.svg" alt="" />
                        </div>';

                        $actname = $row['ActName'];
                        $actname = strlen($actname) > 30 ? substr($actname,0,30)."..." : $actname;
                        echo '<div class="actname" style = "
                        top: '.$ActNamePos.'px;
                        ">
                        '.$actname.'
                        </div>';
                        echo '<div class="InfoText" style = "
                        top: '.$DurationPos.'px;
                        ">
                        '.$row['Start_Date'].' - '.$row['End_Date'].'
                        </div>';
                        // echo '<div class="InfoText" style = "
                        // top: '.$text3.'px;
                        // ">
                        // '.$row['VolunteersNeeded'].'
                        // </div>';
                        echo '<div class="InfoText" style = "
                        top: '.$LocPos.'px;
                        ">
                        '.$row['Street'].', '.$row['ZipCode'].'
                        </div>';

                        // echo '<a href="">
                        //     <div class="edit" style=" top: '.$BtnsTextsPos.'px"></div>
                        //     <div class="edit-1" style= " top: '.$BtnsPos.'px">
                        //     Edit Event
                        //     </div>
                        //     <div class="edit-2" style= " top: '.$BtnsPos.'px" >
                        //         <img src="./images/arrow-small.svg" alt="" />
                        //     </div>
                        // </a>';
                        // echo '<a href="handle-volunteers.php">
                        //     <div class="handle" style= " top: '.$BtnsTextsPos.'px"></div>
                        //     <div class="handle-1" style= " top: '.$BtnsPos.'px">
                        //     Handle Volunteers
                        //     </div>
                        //     <div class="handle-2" style= " top: '.$BtnsPos.'px" >
                        //         <img src="./images/arrow-small.svg" alt="" />
                        //     </div>
                        // </a>';

                        $RecPos = $RecPos +120;
                        $ActNamePos = $ActNamePos + 120;
                        $DurationPos= $DurationPos + 120;
                        $VolNeededPos = $VolNeededPos + 120;
                        $LocPos = $LocPos + 120;
                        $BtnsPos = $BtnsPos + 120;
                        $BtnsTextsPos = $BtnsTextsPos +120;

                    }
                }
            }


            # find in progress events
            if($mode == 'inprogress') {
                while($row = $result->fetch_assoc()) {

                    # event_end_date > current date
                    if( $row['Start_Date'] <= date('Y-m-d') &&  $row['End_Date'] >= date('Y-m-d')) {

                        echo '<div class="rectangle"  style = "
                        top: '.$RecPos.'px;
                        "></div>';

                        echo '<div class="duration" style = "
                        top: '.$DurationPos.'px;
                        ">
                            <img src="./images/duration-small.svg" alt="" />
                        </div>';
                        echo '<div class="staff" style = "
                        top: '.$VolNeededPos.'px;
                        ">
                            <img src="./images/role-small.svg" alt="" />
                        </div>';
                        echo '<div class="location" style = "
                        top: '.$LocPos.'px;
                        ">
                            <img src="./images/location-small.svg" alt="" />
                        </div>';

                        $actname = $row['ActName'];
                        $actname = strlen($actname) > 30 ? substr($actname,0,30)."..." : $actname;
                        echo '<div class="actname" style = "
                        top: '.$ActNamePos.'px;
                        ">
                        '.$actname.'
                        </div>';
                        echo '<div class="InfoText" style = "
                        top: '.$text2.'px;
                        ">
                        '.$row['Start_Date'].' - '.$row['End_Date'].'
                        </div>';
                        echo '<div class="InfoText" style = "
                        top: '.$text3.'px;
                        ">
                        '.$row['VolunteersNeeded'].'
                        </div>';
                        echo '<div class="InfoText" style = "
                        top: '.$text4.'px;
                        ">
                        '.$row['Street'].', '.$row['ZipCode'].'
                        </div>';

                        echo '<a href="">
                            <div class="edit" style=" top: '.$BtnsTextsPos.'px"></div>
                            <div class="edit-1" style= " top: '.$BtnsPos.'px">
                            Edit Event
                            </div>
                            <div class="edit-2" style= " top: '.$BtnsPos.'px" >
                                <img src="./images/arrow-small.svg" alt="" />
                            </div>
                        </a>';
                        echo '<a href="handle-volunteers.php?ActID='.urldecode($row['Activity_ID']).'">
                            <div class="handle" style= " top: '.$BtnsTextsPos.'px"></div>
                            <div class="handle-1" style= " top: '.$BtnsPos.'px">
                            Handle Volunteers
                            </div>
                            <div class="handle-2" style= " top: '.$BtnsPos.'px" >
                                <img src="./images/arrow-small.svg" alt="" />
                            </div>
                        </a>';

                        $RecPos = $RecPos +215;
                        $ActNamePos = $ActNamePos + 215;
                        $DurationPos= $DurationPos + 215;
                        $VolNeededPos = $VolNeededPos + 215;
                        $LocPos = $LocPos + 215;
                        $BtnsPos = $BtnsPos + 215;
                        $BtnsTextsPos = $BtnsTextsPos +215;
                        $text2 = $text2 + 215;
                        $text3 = $text3 + 215;
                        $text4 = $text4 + 215;
                    }
                }
            }











        }
    }
?>

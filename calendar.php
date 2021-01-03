<?php

include 'db_connection.php';
$conn = open_con();

class Calendar {

    /**
     * Constructor
     */
    public function __construct(){
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    /********************* PROPERTY ********************/
    private $currentYear=0;
    private $currentMonth=0;
    private $naviHref= null;

    /********************* PUBLIC **********************/

    /**
    * print out the calendar
    */
    public function show() {
        $year  = null;
        $month = null;
        if(null==$year&&isset($_GET['year'])){

            $year = $_GET['year'];

        }else if(null==$year){

            $year = date("Y",time());

        }
        if(null==$month&&isset($_GET['month'])){

            $month = $_GET['month'];

        }else if(null==$month){

            $month = date("m",time());

        }
        $this->currentYear=$year;
        $this->currentMonth=$month;
        $content='<div id="calendar">'.
                        $this->_createNavi().
                        '</div>';
        return $content;
    }

    public function eventsOfMonth(mysqli $conn) {

      $sql = "SELECT ActName, volunteersNeeded,City,Start_Date ,DATEDIFF(End_Date,Start_Date) AS Duration FROM voluntary_activity
              WHERE month(Start_Date)= '$this->currentMonth' AND year(Start_Date) = '$this->currentYear' ORDER BY Start_Date";
      $result = $conn->query($sql);
      $bg = array('#FFC59D','#D9B8CB','#C1D5D5','#FFC59D','#D9B8CB','#C1D5D5','#FFC59D','#D9B8CB','#C1D5D5');
      $sg = array('#FF842E','#993E73','#7CA7A7','#FF842E','#993E73','#7CA7A7','#FF842E','#993E73','#7CA7A7');
      $rg = array('200','330','460','590','720','850','980','1110','1240');
      $tg = array('202','332','462','592','722','852','982','1112','1242');
      $lg = array('260','390','520','650','780','910','1040','1170','1300');
      $ng = array('266','396','526','656','786','916','1046','1176','1306');
      $kg = array('220','350','480','610','740','870','100','1130','1260');
      $i = 0;


      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $selectedBg = "$bg[$i]";
          $selectedRg = "$rg[$i]";
          $selectedTg = "$tg[$i]";
          $selectedSg = "$sg[$i]";
          $selectedLg = "$lg[$i]";
          $selectedNg = "$ng[$i]";
          $selectedKg = "$kg[$i]";
          echo '<div class="rc" style = "
          position: absolute;
          width: 245px;
          height: 100px;
          left: 111px;
          top: '.$selectedRg.'px;
          background: '.$selectedBg.';
          border-radius: 15px;"></div>';
          echo '<div id="names" class="text" style="top: '.$selectedTg.'px;">';
          echo '<span style="font-size:16px;font-weight:600;line-height: 30px;">';
          echo $row["ActName"];
          echo '</span> <br>';
          echo '&nbsp;';
          echo '<img src="./images/duration-small.svg" alt="" />';
          echo '<span style="line-height: 20px; color: #544A4A;">';
          echo '&emsp;&nbsp;';
          echo $row["Duration"];
          echo '<br>';
          echo '<img src="./images/staff-small.svg" alt="" />';
          echo '&emsp;&nbsp;';
          echo $row["volunteersNeeded"];
          echo '<br>';
          echo '&nbsp;';
          echo '<img src="./images/location-small.svg" alt="" />';
          echo '&emsp;&nbsp;';
          echo $row["City"];
          echo  '</div>';
          echo '<a href="./events-description.php?ActName='.urldecode($row["ActName"]).'">';
          echo  '<div class="more" style = "
          position: absolute;
          width: 72px;
          height: 29px;
          left: 274px;
          top: '.$selectedLg.'px;
          background: '.$selectedSg.';
          border-radius: 15px;"></div>';
          echo  '</a>';
          echo '<a href="./events-description.php?ActName='.urldecode($row["ActName"]).'">';
          echo  '<div class="more-1" style="
          position: absolute;
          width: 72px;
          height: 29px;
          left: 270px;
          top: '.$selectedLg.'px;
          font-family: Montserrat;
          font-style: normal;
          font-weight: 600;
          font-size: 16px;
          line-height: 28px;
          text-align: center;
          text-decoration: none;
          color: #000000;">';
          echo   ' More';
          echo '&nbsp;';
          echo  '</div>';
          echo  '</a>';
          echo '<a href="./events-description.php?ActName='.urldecode($row["ActName"]).'">';
          echo '<div class="more-1" style="
          position: absolute;
          width: 72px;
          height: 29px;
          left: 328px;
          top: '.$selectedNg.'px;">';
          echo    '<img src="./images/arrow-small.svg" alt="" />';
          echo  '</div>';
          echo  '</a>';
          $originalDate = $row["Start_Date"];
          $newDate1 = date("d", strtotime($originalDate));
          $newDate2 = date("D", strtotime($originalDate));
          echo '<div id="names2" class="text2" style="text-align:center;text-transform: uppercase;  top: '.$selectedKg.'px;">';
          echo '<span style="font-size:36px;font-weight:600;line-height: 34px; color: #000000;">';
          echo $newDate1;
          echo '</span> <br>';
          echo $newDate2;
          echo  '</div>';
          $i++;

        }
      } else {
        echo "0 results";
      }
    }

    private function _createNavi(){

        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
        return
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'"><img src="./images/left-arrow.svg" alt="" /></a>'.
                    '<span class="title">'.date('F Y',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'"><img src="./images/right-arrow.svg" alt="" /></a>'.
            '</div>';
    }

}

<?php $y=1;
$num_term = 3;
//start date
$month_sched = date("2021-09-31");
while($y <= $num_term) {
    //15th
    $month_line_15 = strtotime($month_sched." +14 day");
    //last day of month
    $month_line_last = strtotime($month_sched." next month - 1 hour");
    $date = date("Y-m-d",strtotime($month_sched." +14 day"));
    echo $date;
  //  echo $day = date("M-d", $month_line_15);
   echo "<br>" .$month_int = date("Y-m-d", $month_line_last)  ."<br>" ;
    $month_sched = date("Y-m-d",strtotime($month_sched." +1month"));
    $y++;
}
?>
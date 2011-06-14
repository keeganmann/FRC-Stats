<?php
//OBSOLETE:
//HISTORICALLY USED TO TEST THE TEAMDATA CLASS IN TEAMDATA.PHP

echo "team data test<br/>";
include("teamdata.php");
$data = new TeamData();
foreach($data->columns as $val){
    echo "$val  ";
}

?>

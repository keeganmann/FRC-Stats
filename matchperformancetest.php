<?php
//OBSOLETE
//HISTORICALLY USED TO TEST THE MATCHPERFORMANCE CLASS LOCATED IN 
//MATCHPERFORMANCE.PHP

include("matchperformance.php");
$perf = new MatchPerformance();
echo sizeof($perf->columns);
foreach($perf->controltypes as $value){
    echo " $value, ";
}

?>

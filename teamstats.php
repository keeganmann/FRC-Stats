<?php
require_once "config.php";
include("matchperformance.php");

/*
 * Used to calculate averages from performance data.
 */
class TeamStats {

    public $columns;
    public $labels;
    
    public function __construct(){
        $perf = new MatchPerformance();
        $this->columns = array_slice($perf->columns, 2);
        $this->labels = array_slice($perf->labels, 2);
    }

    public function getStats($teamnumber) {
        $stats = array();
        //connect to database
        $con = frcmysqlconnect();
        //get match query
        $result = mysql_query("SELECT * FROM Performance WHERE teamnumber=" . $teamnumber);
        //get the row representing each match
        $count = 0;
        while ($row = mysql_fetch_array($result)) {
            $count++;
            foreach ($this->columns as $value) {
                $stats[$value] += $row[$value];
            }
            //$stats['tot'] = $stats['top'] + $stats['middle'] + $stats['bottom'];
        }
        foreach ($stats as $index => $value) {
            $stats[$index] = $value / $count;
        }
        mysql_close($con);
        return $stats;
    }

}

?>

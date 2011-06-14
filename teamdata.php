<?php
/*
 * Used to manage general, static team data.
 */
class TeamData {

    public $columns;

    function __construct() {
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        $result = mysql_query("SELECT * FROM TeamData");
        while ($property = mysql_fetch_field($result)) {
            $this->columns[] = $property->name;
        }

        mysql_close($con);
    }

    function getTeamData($teamnumber) {
        //connect to database
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        //get match query
        $result = mysql_query("SELECT * FROM TeamData WHERE teamnumber=" . $teamnumber);
        //get the row representing each match
        $row = mysql_fetch_array($result);
        mysql_close($con);
        return $row;
    }

}

?>

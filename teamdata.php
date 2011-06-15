<?php
require_once "config.php";
/*
 * Used to manage general, static team data.
 */
class TeamData {

    public $columns;

    function __construct() {
        $con = frcmysqlconnect();
        $result = mysql_query("SELECT * FROM TeamData");
        while ($property = mysql_fetch_field($result)) {
            $this->columns[] = $property->name;
        }

        mysql_close($con);
    }

    function getTeamData($teamnumber) {
        //connect to database
        $con = frcmysqlconnect();
        //get match query
        $result = mysql_query("SELECT * FROM TeamData WHERE teamnumber=" . $teamnumber);
        //get the row representing each match
        $row = mysql_fetch_array($result);
        mysql_close($con);
        return $row;
    }

}

?>

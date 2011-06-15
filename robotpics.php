<?php
/*
 * Class used to manage the robot picture database.
 */
class RobotPics {

    public function getRobotPicPath($teamnumber) {
        //connect to database
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        //get match query
        $result = mysql_query("SELECT * FROM Robopics WHERE teamnumber=" . $teamnumber);
        //get the row representing each match
        $row = mysql_fetch_array($result);
        $result = $row["path"];
        mysql_close($con);
        return $result;
    }
    public function getRobotThumbPath($teamnumber) {
        //connect to database
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        //get match query
        $result = mysql_query("SELECT * FROM Robopics WHERE teamnumber=" . $teamnumber);
        //get the row representing each match
        $row = mysql_fetch_array($result);
        if($row["path"])
            $result = dirname($row["path"]) . "/220x220_" . basename($row['path']);
        else
            $result = FALSE;
        mysql_close($con);
        return $result;
    }
    public function addRobotPicPath($teamnumber, $path) {
        //connect to database
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        //delete existing
        $result = mysql_query("DELETE FROM Robopics WHERE teamnumber=" . $teamnumber);
        //get match query
        $result = mysql_query($query = "INSERT INTO Robopics VALUES ($teamnumber, '$path')");
        mysql_close($con);
        return $query;
    }

}

?>

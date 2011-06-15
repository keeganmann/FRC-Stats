<?php
require_once "config.php";
/*
 * This class is used to manage the list of matches.
 */
class Matches {

    public $columns = array("matchnumber", "team1", "team2", "team3", "team4",
        "team5", "team6", "redscore", "bluescore");
    public $labels = array("Match #", "team 1", "team 2", "team 3", "team 4",
        "team 5", "team 6", "red score", "blue score");
    private $table;

    public function update() {
        $this->table = array();
        //connect to database
        $con = frcmysqlconnect();
        //get match query
        $result = mysql_query("SELECT * FROM Matches ORDER BY matchnumber");
        //get the row representing each match
        while ($row = mysql_fetch_array($result)) {
            //get the entries
            $this->table[$row["matchnumber"]] = array();
            foreach ($this->columns as $column) {
                $this->table[$row["matchnumber"]][$column] = $row[$column];
            }
        }
        mysql_close($con);
        return $this->table;
    }
    public function matchesForTeam($teamnumber) {
        $this->table = array();
        //connect to database
        $con = frcmysqlconnect();
        //get match query
        $result = mysql_query("SELECT * FROM Matches WHERE team1=$teamnumber OR team2=$teamnumber OR team3=$teamnumber OR team4=$teamnumber OR team5=$teamnumber OR team6=$teamnumber ORDER BY matchnumber");
        //get the row representing each match
        while ($row = mysql_fetch_array($result)) {
            //get the entries
            $this->table[$row["matchnumber"]] = array();
            foreach ($this->columns as $column) {
                $this->table[$row["matchnumber"]][$column] = $row[$column];
            }
        }
        mysql_close($con);
        return $this->table;
    }

    public function getMatchTable() {
        return $this->table;
    }

    public function getMatch($matchnumber) {
        //connect to database
        $con = frcmysqlconnect();
        //get match query
        $result = mysql_query("SELECT * FROM Matches WHERE matchnumber=" . $matchnumber);
        //get the row representing the match
        $row = mysql_fetch_array($result);

        mysql_close($con);
        return $row;
    }

    public function addMatch($matchnumber, $match) {
        //connect to database
        $con = frcmysqlconnect();
        //delete any existing matches with this match number
        mysql_query("DELETE FROM Matches WHERE matchnumber=" . $matchnumber);
        //generate query
        $query = "INSERT INTO Matches VALUES (" . $matchnumber;
        for ($i = 1; $i < sizeof($this->columns); $i++) {
            $query .= "," . $match[$this->columns[$i]];
            if ($match[$this->columns[$i]] == "")
                $query .= "null";
        }
        $query .= ")";
        //send query
        mysql_query($query);
        //close connection
        mysql_close($con);
        return $query;
    }
    
    public function addScore($matchnumber, $redscore, $bluescore){
        //connect to database
        $con = frcmysqlconnect();
        //send query
        mysql_query($query = "UPDATE Matches SET bluescore=" . $bluescore . 
                    ", redscore=" . $redscore .
                    " WHERE matchnumber=" . $matchnumber);
        //close connection
        mysql_close($con);
        return $query;
    }
}

?>

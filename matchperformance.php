<?php
require_once "config.php";
/*
 * Class used to manage match performance data.
 */
class MatchPerformance {

    public $columns;
    public $labels;
    public $datatypes;
    public $controltypes;
    private $table;

    function __construct() {
        $this->columns = array();
        //connect to database
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("information_schema", $con);
        //get match query
        $result = mysql_query("SELECT * FROM COLUMNS WHERE TABLE_NAME='Performance'");
        //get the row representing each match
        while ($row = mysql_fetch_array($result)) {
            //get the entries
            $this->columns[] = $row["COLUMN_NAME"];
            if($row["COLUMN_COMMENT"] != "")
                $this->labels[] = $row["COLUMN_COMMENT"];
            else
                $this->labels[] = $row["COLUMN_NAME"];
            $this->datatypes[] = $row["DATA_TYPE"];
            if ($row["DATA_TYPE"] == "tinyint") {
                $this->controltypes[] = "checkbox";
            } else {
                $this->controltypes[] = "text";
            }
        }
        mysql_close($con);
        return $this->table;
    }

    public function update($matchnumber) {
        $this->table = array();
        //connect to database
        $con = frcmysqlconnect();
        //get match query
        $result = mysql_query("SELECT * FROM Performance WHERE matchnumber=" . $matchnumber);
        //get the row representing each match
        while ($row = mysql_fetch_array($result)) {
            //get the entries
            $this->table[$row["teamnumber"]] = array();
            foreach ($this->columns as $column) {
                $this->table[$row["teamnumber"]][$column] = $row[$column];
            }
        }
        mysql_close($con);
        return $this->table;
    }

    public function clearData($matchnumber) {
        $this->table = array();
        //connect to database
        $con = frcmysqlconnect();
        //get match query
        $result = mysql_query("DELETE FROM Performance WHERE matchnumber=" . $matchnumber);
        mysql_close($con);
        return $this->table;
    }
    
    //TODO add a "clearAllData()" method

    public function getMatchTable() {
        return $this->table;
    }

    public function addMatch($matchnumber, $match) {
        //connect to database
        $con = frcmysqlconnect();
        //delete any existing matches with this match number
        mysql_query("DELETE FROM Performance WHERE matchnumber=" . $matchnumber .
                " AND teamnumber=" . $match["teamnumber"]);
        //generate query
        $query = "INSERT INTO Performance VALUES (" . $matchnumber;
        for ($i = 1; $i < sizeof($this->columns); $i++) {
            $query .= "," . $match[$this->columns[$i]];
        }
        $query .= ")";
        //send query
        mysql_query($query);
        //close connection
        mysql_close($con);
        return $query;
    }

}

?>

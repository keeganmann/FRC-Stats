<?php
/*
 * Used to manage survey response data.
 */
class SurveyResponses {

    public $columns;
    public $labels;
    public $datatypes;
    public $controltypes;

    function __construct() {
        $this->columns = array();
        //connect to database
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("information_schema", $con);
        //get match query
        $result = mysql_query("SELECT * FROM COLUMNS WHERE TABLE_NAME='SurveyResponses'");
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
    }

    function addResponse($response) {
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        mysql_query("DELETE FROM SurveyResponses WHERE teamnumber=" . $response['teamnumber']);
        $query = "INSERT INTO SurveyResponses VALUES (";
        $delimeter = "";
        foreach($this->columns as $column){
            $query .= $delimeter . $response[$column];
            $delimeter = ", ";
        }
        $query .= ")";
        mysql_query($query);
        mysql_close();
        return $query;
    }

    function getResponse($teamnumber) {
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        $query = "SELECT * FROM SurveyResponses WHERE teamnumber=" . $teamnumber;
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            foreach($this->columns as $column){
                $out[$column] = $row[$column];
            }
        }
        mysql_close();
        return $out;
    }

}

;
?>

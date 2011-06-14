<?php
/*
 * This class is used to manipulate the list of user accounts stored in the sql
 * database.
 */

class Accounts {

    public $columns = array('username', 'password', 'firstname', 'lastname', 'email', 'permissions');

    public function getAccountTable() {
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        $query = "SELECT * FROM Accounts";
        $result = mysql_query($query);
        $out = array();
        while ($row = mysql_fetch_array($result)) {
            foreach ($this->columns as $column) {
                $out[$row['username']][$column] = $row[$column];
            }
        }
        mysql_close();
        return $out;
    }

    public function getAccount($username) {
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        $query = "SELECT * FROM Accounts WHERE username='$username'";
        $result = mysql_query($query);
        $out = array();
        $row = mysql_fetch_array($result);
        foreach ($this->columns as $column) {
            $out[$column] = $row[$column];
        }
        mysql_close();
        return $out;
    }
    public function deleteAccount($username){
        //TODO add a protection against deleting the root user.
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        $query = "DELETE FROM Accounts WHERE username='$username'";
        $result = mysql_query($query);
        mysql_close();
        return $out;
    }
    public function addAccount($account){
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        mysql_query("DELETE FROM Accounts WHERE username='" . $account['username'] . "'");
        $query = "INSERT INTO Accounts VALUES (";
        $delimeter = "";
        foreach($this->columns as $column){
            $query .= $delimeter . "'$account[$column]'";
            $delimeter = ", ";
        }
        $query .= ")";
        $result = mysql_query($query);
        mysql_close();
        return $query;
    }
    public function updateAccount($account){
        $con = mysql_connect("localhost", "root", "nageek5tree");
        mysql_select_db("frc_stats_2011", $con);
        $query = "UPDATE Accounts SET ";
        $delimeter = "";
        foreach($account as $index=>$column){
            $query .= $delimeter . "$index='$column'";
            $delimeter = ", ";
        }
        $query .= " WHERE username='" . $account['username'] . "'";
        $result = mysql_query($query);
        mysql_close();
        return $query;
    }
}

?>

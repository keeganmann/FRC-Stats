<?php

/*
 * Used for general configuration settings that cannot be taken from a database.
 */

//TODO: Use this file to replace the literals present in various places where we log into the sql database.

$frcmysqlusername = "root";
$frcmysqlpassword = "nageek5tree";
$frcmysqldatabase = "frc_stats_2011";
$frcmysqlserverurl ="localhost";

//login to the server and select the database
//DONT USE THIS TO REPLACE WHERE WE SELECT THE information-schema DATABASE.
function frcmysqlconnect() {
    $con = mysql_connect($GLOBALS[frcmysqlserverurl], $GLOBALS[frcmysqlusername], $GLOBALS[frcmysqlpassword]);
    mysql_select_db($GLOBALS[frcmysqldatabase], $con);
    return $con;
}

function frcgetsqlusername(){
    return $GLOBALS[frcmysqlusername];
}
function frcgetsqlpassword(){
    return $GLOBALS[frcmysqlpassword];
}
function frcgetsqldatabase(){
    return $GLOBALS[frcmysqldatabase];
}
function frcgetsqlserverurl(){
    return $GLOBALS[frcmysqlserverurl];
}

?>

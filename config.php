<?php

/*
 * Used for general configuration settings that cannot be taken from a database.
 */

//////// START CONFIGURATION SETTINGS ////////
//sql username
$frcmysqlusername = "root";
//sql database name
$frcmysqlpassword = "nageek5tree";
//database name
$frcmysqldatabase = "frc_stats_2011";
//server url
$frcmysqlserverurl ="localhost";
////////  END CONFIGURATION SETTINGS  ////////
 
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
function frcgetinstalled(){
    return $GLOBALS[frcinstalled];
}

?>

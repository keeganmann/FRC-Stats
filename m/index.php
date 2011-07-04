<?php
//header("Location: login.php");

//Secure this page
require("../common.php");
require_authentication();
?>

<html>
    <head>
        <title>FRC STATS - Mobile Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

        <meta name="app-mobile-web-app-capable" content="yes" />
        <meta name="apple-touch-fullscreen" content="YES" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <link rel="apple-touch-icon" href="apple-touch-icon.png" />

        <link rel="stylesheet" type="text/css" href="styles.css" />
        <script>
            
            /////////////////////////////
            //main code
            /////////////////////////////
            fullscreen();
            function fullscreen(){
                if (navigator.userAgent.indexOf('iPhone') != -1) {
                    setTimeout(function () {
                        window.scrollTo(0, 1);
                    }, 1000);
                }
            }
            function hideURLbar() {
                alert("scrolling");
                window.scrollTo(0, 1);
            }
            function toggle(div_id) {
                var el = document.getElementById(div_id);
                if ( el.style.display == 'none' ) {
                    el.style.display = 'block';
                } else {
                    el.style.display = 'none';
                }
            }
            function blanket_size(popUpDivVar) {
                if (typeof window.innerWidth != 'undefined') {
                    viewportheight = window.innerHeight;
                } else {
                    viewportheight = document.documentElement.clientHeight;
                }
                if ((viewportheight > document.body.parentNode.scrollHeight) && 
                    (viewportheight > document.body.parentNode.clientHeight)) {
                    blanket_height = viewportheight;
                } else {
                    if (document.body.parentNode.clientHeight > document.body.parentNode.scrollHeight) {
                        blanket_height = document.body.parentNode.clientHeight;
                    } else {
                        blanket_height = document.body.parentNode.scrollHeight;
                    }
                }
                var blanket = document.getElementById('blanket');
                blanket.style.height = blanket_height + 'px';
                var popUpDiv = document.getElementById(popUpDivVar);
                popUpDiv_height=50;//blanket_height/2-100;//150 is half popup's height
                popUpDiv.style.top = popUpDiv_height + 'px';
            }
            function window_pos(popUpDivVar) {
                if (typeof window.innerWidth != 'undefined') {
                    viewportwidth = window.innerWidth;
                } else {
                    viewportwidth = document.documentElement.clientHeight;
                }
                if ((viewportwidth > document.body.parentNode.scrollWidth) && (viewportwidth > document.body.parentNode.clientWidth)) {
                    window_width = viewportwidth;
                } else {
                    if (document.body.parentNode.clientWidth > document.body.parentNode.scrollWidth) {
                        window_width = document.body.parentNode.clientWidth;
                    } else {
                        window_width = document.body.parentNode.scrollWidth;
                    }
                }
                var popUpDiv = document.getElementById(popUpDivVar);
                window_width=window_width/2-100;//150 is half popup's width
                popUpDiv.style.left = window_width + 'px';
            }
            function popup(windowname) {
                blanket_size(windowname);
                window_pos(windowname);
                toggle('blanket');
                toggle(windowname);		
            }    
            //main ajax 
            function updateNav(str)
            {   
                document.getElementById("navspan").innerHTML="Loading..." + 
                    "<br/> <br/><br/><br/><br/><br/><br/><br/><br/><br/>" +
                    "<br/> <br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                if (str.length==0)
                { 
                    document.getElementById("navspan").innerHTML="Invalid Location";
                    return;
                }
                else{
                    //document.getElementById("txtStats").innerHTML="<p><center>Loading...</center></p>";
                }
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("navspan").innerHTML=xmlhttp.responseText;
                        //fullscreen();
                    }
                }
                xmlhttp.open("GET",str,true);
                //fullscreen();
                xmlhttp.send();
            }
            /////////////////////////////
            //stats.php code
            /////////////////////////////
            function updateStats(str){
        
                document.getElementById("statspan").innerHTML="Loading..." + 
                    "<br/> <br/><br/><br/><br/><br/><br/><br/><br/><br/>" +
                    "<br/> <br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                if (str.length==0)
                { 
                    document.getElementById("statspan").innerHTML="ERROR: Invalid Location";
                    return;
                }
                else{
                    //document.getElementById("statspan").innerHTML="ERROR: Invalid Location";
                }
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("statspan").innerHTML=xmlhttp.responseText;
                        //fullscreen();
                    }
                }
                xmlhttp.open("GET",str,true);
                //fullscreen();
                xmlhttp.send();
            }
            function searchstats(){
                updateStats("getstats.php?q=" + document.getElementById("teamnumbertext").value);
            }
        </script>
    </head>
    <body onload="updateNav('home.php');">
        <div class="navbar">
            <div style="float:left" class="navitem"> <a href="login.php">logout</a></div> 
            <div style="float:right" class="navitem"><a href="#" onclick="popup('popUpDiv')">menu</a></div>
            <h1>
                FRC STATS
            </h1>
        </div>
        <span id="navspan">
            Loading...
        </span>
        <div id="blanket" style="display:none;"></div>
        <div id="popUpDiv" class="rounded" style="display:none;">
            <div class="padderline" onclick="                                  popup('popUpDiv');" style="text-align: center;color: #ffcccc">
                Cancel
            </div>
            <div class="padderline" onclick="updateNav('home.php');            popup('popUpDiv');" style="text-align: center;color: #ffffff">
                Home
            </div>
            <div class="padderline" onclick="updateNav('stats.php');           popup('popUpDiv');" style="text-align: center;color: #ffffff">
                Team Stats
            </div>
            <div class="padderline" onclick="updateNav('performanceentry.php');popup('popUpDiv');" style="text-align: center;color: #ffffff">
                Performance (not functional)
            </div>
            <!--<div class="padderline" onclick="updateNav('home.php');popup('popUpDiv');">
                Match List
            </div>
            <div class="padder" onclick="updateNav('home.php');popup('popUpDiv');">
                Team Info
            </div>-->
        </div>
    </body>
</html>
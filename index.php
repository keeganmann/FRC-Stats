<?php
/*
 * This file defines the top level layout and appearance of the website.  Every
 * page request really originates here in this file.  Using php, it includes the
 * required file depending on $_GET['n'] which defines the actual page the user 
 * wants to view.  
 */

//Secure this page
require("common.php");
require_authentication();
?>
<!DOCTYPE html>
<html>
    <?php
    $browser = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    if ($browser == true) {
        $browser = 'iphone';
    }
    if ($browser == 'iphone') {
        ?>
        <!--<meta name="viewport" content="width=device-width, minimum-scale=0.47, maximum-scale=1" />-->
        <?php
    }
    $currentNav = $_GET["n"];
    //TODO:  convert this to an array - easier to maintain
    if ($currentNav == "dataentry")
        $title = "Performance Data";
    else if ($currentNav == "teams")
        $title = "Team Stats";
    else if ($currentNav == "pics")
        $title = "Team Information";
    else if ($currentNav == "summary")
        $title = "Upcoming Matches";
    else if ($currentNav == "matchentry")
        $title = "Match Data";
    else if ($currentNav == "settings")
        $title = "Settings";
    else {
        $currentNav = "main";
    }
    if ($currentNav == "main")
        $title = "Main Page";
    ?>
    <head>
        <title>FRC STATS - <?php echo $title ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <script type="text/javascript">
            function updateClock(){
                /* 
                 * TODO  Use a list of future dates for the countdown from a sql database or php array.
                 */
                var event = "Kickoff 2012";
                var currentTime = new Date ( );
                var targetDate = new Date("January 7, 2012");
                var diff = targetDate.getTime() - currentTime.getTime();
                var days = Math.floor(diff / 1000 / 60 / 60 / 24);
                var hours = Math.floor(diff / 1000 / 60 / 60) - days * 24;
                var minutes = Math.floor(diff / 1000 / 60) - days * 24 * 60 - hours * 60;
                var seconds = Math.floor(diff / 1000) - days * 24 * 60 * 60 - hours * 60 * 60 - minutes * 60;
                document.getElementById("clockspan").innerHTML = days + " days, " + hours + " hours, " + minutes + " minutes, and " + seconds + " seconds until " + event + "!";
            }
        </script>
    </head>

    <body onload="updateClock(); setInterval('updateClock()', 1000 )">
        <div class="header">  
            <div class="logout"><a href="login.php">logout</a></div>
            <span id="clockspan" style="margin-bottom: 0;padding-bottom: 0;color: #888888; font-size:10px;">Countdown</span>
            <h1 class="maintitle" style="margin-top: 10px;padding-top: 0;">FRC STATS</h1>
        </div>

        <div class="navbar">
            <div class="navpadder" <?php if ($currentNav == "main")
        echo "id=sel" ?>>
                <a href="index.php?n=main">Home</a></div>  
            <div class="navpadder" <?php if ($currentNav == "matchentry")
                 echo "id=sel" ?>>
                <a href="index.php?n=matchentry">Matches</a></div>  
            <div class="navpadder" <?php if ($currentNav == "dataentry")
                 echo "id=sel" ?>>
                <a href="index.php?n=dataentry">Performance</a></div>  
            <div class="navpadder" <?php if ($currentNav == "teams")
                 echo "id=sel" ?>>
                <a href="index.php?n=teams">Stats</a></div>  
            <div class="navpadder" <?php if ($currentNav == "summary")
                 echo "id=sel" ?>>
                <a href="index.php?n=summary">Upcoming</a></div>
            <div class="navpadder" <?php if ($currentNav == "pics")
                 echo "id=sel" ?>>
                <a href="index.php?n=pics">TeamInfo</a></div>
            <div class="navpadder" <?php if ($currentNav == "settings")
                 echo "id=sel" ?>>
                <a href="index.php?n=settings">Settings</a></div>
        </div>

        <div class="content">
            <!--The following commented code would be used for a navigation sidebar-->
            <!--<div class="navleft">
            <div class="padder">
            <p>
                <a href="http://www.nurdrobotics.com">Main web site for team #3255</a>
            </p>
            </div>
            </div>-->
            <div class="padder">
                <h1><?php echo $title ?></h1>
                <?php
                if ($currentNav == "main") {
                    ?>
                    <p>
                        This is a database of statistics for <a href="http://www.usfirst.org">FIRST Robotics Competition</a> teams.  
                        We are team #3255, and our main website is located at: <a href=""http://www.nurdrobotics.com/">www.nurdrobotics.com</a>.
                        This system is intended to be used for entering data on teams during a competition.
                        It is capable of logging specific data such as number of tubes placed 
                        so that we can make more informed decisions with our alliances and hopefully during 
                        the process of alliance selection for the finals.  It can also be used to record 
                        responses to surveys.
                    </p>
                    <h2>Code</h2>
                    <p>
                        The code for this project is now available through an SVN repository as part of the google code project here:
                        <a href="http://code.google.com/p/frcstats/">http://code.google.com/p/frcstats/</a>.
                    </p>
                    <h2>Operation</h2>
                    <ul>
                        <li>To start, click "Matches" above and enter all the matches for the competition.  
                            You can leave the scores blank to enter them later.</li>
                        <li>Then, click "Performance.  Here, you will enter the data for the teams during the match.
                            Entering the score in this page updates the Match table automatically.  </li>
                        <li>Under "Stats", you can view a summary performance data you entered for a specified team. </li>
                        <li>Under "Upcoming", you can view stats for teams you will be facing in upcoming matches. </li>
                        <li>If you submit a picture of a team's robot under "Team Info" it will show up next 
                            to the team's statistics.</li>
                        <li>If you survey responses under "Team Info" it will show up with 
                            the team's statistics.</li>
                        <li>Easy configuration of team statistics properties and survey questions for adapting the 
                            system to future games is available under "Settings".</li>
                        <li>Accounts can now be managed under "Settings". </li>
                    </ul>
                    <h2>Needed Features</h2>
                    <p>Note: this list does not include various small fixes.  This is a list of major new features.</p>
                    <ul>
                        <li>Configuration header -- database login information.</li>
                        <li>An install file would make the system much easier to set up.  Currently, it is necessary to create the 
                            database tables manually using phpmyadmin when setting it up on a new server.  Might necessitate a
                            global settings class</li>
                    </ul>
                    <h2>These Features would be Nice</h2>
                    <p>Note: this list does not include various small fixes.  This is a list of major new features.</p>
                    <ul>
                        <li>Time column in match lists. </li>
                        <li>Would it be too difficult to log penalties for individual teams. </li>
                        <li>A simple CMS: I'm running out of room for more entries on the top navigation bar 
                            and might need to add another level if I want to extend the system further or if someone wants to add a 
                            significant amount of documentation.  The layout for a sidebar has already been developed but I'm 
                            realizing that a real CMS would be necessary to manage it.</li>
                        <li>Logging of Penalty and Surrogate information for matches in order to determine real time standing.</li>
                        <li>It might also be useful to log comments for individual matches in case we want to look back on 
                            interesting ones.</li>
                        <li>Upload the website code to an svn server for future development.</li>
                        <li>There is a twitter feed which sends out real time data on which matches are coming up. Synch with this?</li>
                    </ul>
                    <h2>Further Questions</h2>
                    <p>Should we deploy this site to the same server as our nurdrobotics.com site, or should we deploy it on 
                        web server running on a small computer.  The advantage to using a server we can take to the competition
                        is that we could set up our own network and not have to connect to the real internet.  The answer to that 
                        question might also depend on what device we want to use to post data.  
                    </p>
                    <p>
                        Further developing this system involves understanding HTML, CSS, PHP, javascript, MySQL, AJAX, and maybe 
                        a little bit of server administration.  <br/>
                        <strong>
                            However, if there's anyone who knows or is willing to learn HTML (it's really easy) 
                            they can write some documentation pages.  We can upload the website to a subversion server and teach 
                            you how to use NetBeans with subversion to write HTML.  Do any mentors have experience with web development?
                        </strong>
                    </p>
                    <p>
                        We should also recruit people to be in charge of entering this data during the competition.
                    </p>
                    <p>
                        Is the fixed-width layout working or should we change it.  Should it fill the whole screen or be wider?
                    </p>
                    <?php
                    //TODO:  convert the following else ifs to an array - easier to maintain
                } else if ($currentNav == "dataentry") {
                    include("dataentry.php");
                } else if ($currentNav == "matchentry") {
                    include("matchentry.php");
                } else if ($currentNav == "teams") {
                    include("teams.php");
                } else if ($currentNav == "summary") {
                    include("mymatches.php");
                } else if ($currentNav == "pics") {
                    include("pics.php");
                } else if ($currentNav == "settings") {
                    include("settings.php");
                }
                ?>
            </div>
        </div>
        <div class="footer">
            <div class="padder" style="text-align: center">
                <a href="http://www.nurdrobotics.com/">www.nurdrobotics.com</a>
                <br/>
                powered by Apache
            </div>
        </div>
    </body>
</html>

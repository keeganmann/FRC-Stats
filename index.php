<?php
/*
 * This file defines the top level layout and appearance of the website.  Every
 * page request really originates here in this file.  Using php, it includes the
 * required file depending on $_GET['n'] which defines the actual page the user 
 * wants to view.  
 */

//check installed
require_once 'config.php';
if (!frcgetinstalled()) {
    header("Location:install.php");
    exit();
}
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
    if (!$currentNav)
        $currentNav = "main";
    $navtitles = array(
        "dataentry" => "Performance Data",
        "teams" => "Team Stats",
        "pics" => "Team Information",
        "summary" => "Upcoming Matches",
        "matchentry" => "Match Data",
        "settings" => "Settings",
        "main" => "Main Page"
    );
    $navpages = array(
        "dataentry" => "dataentry.php",
        "teams" => "teams.php",
        "pics" => "teaminfo.php",
        "summary" => "mymatches.php",
        "matchentry" => "matchentry.php",
        "settings" => "settings.php",
        "main" => "none"
    );
    $navlinks = array(
        "main" => "Home",
        "matchentry" => "Matches",
        "dataentry" => "Performance",
        "teams" => "Stats",
        "summary" => "Upcoming",
        "pics" => "TeamInfo",
        "settings" => "Settings"
    );
    $title = $navtitles[$currentNav];
    ?>
    <head>
        <title>FRC STATS - <?php echo $title ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <?php
        // ADD ADDITIONAL EVENTS TO COUNT 
        // DOWN TO IN THE FUTURE BELOW
        $events = array(
            "Kickoff 2012" => "January 7, 2012",
            "Ship Date 2012" => "February 21, 2012",
            "Kickoff 2013" => "January 5, 2013",
            "Ship Date 2013" => "February 19, 2013"
        );
        $t = time();
        $eventdate = "";
        $eventname = "";
        foreach ($events as $name => $event) {
            $t2 = strtotime($event);
            if ($t2 > $t) {
                $eventdate = $event;
                $eventname = $name;
                break;
            }
        }
        ?>
        <script type="text/javascript">
            function updateClock(){
                var event = "<?php echo $eventname; ?>";
                var currentTime = new Date ( );
                var targetDate = new Date("<?php echo $eventdate; ?>");
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
            <?php
            foreach ($navlinks as $index => $label) {
                echo '<div class="navpadder"';
                if ($currentNav == $index)
                    echo "id=sel";
                echo ">";
                echo "<a href='index.php?n=$index'>";
                echo $label;
                echo '</a></div>';
            }
            ?>
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
                        <strong>Logged in as <?php echo $_SESSION[username]; ?>.</strong>
                    </p>
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
                        <li>?</li>
                    </ul>
                    <h2>These Features would be Nice</h2>
                    <p>Note: this list does not include various small fixes.  This is a list of major new features.</p>
                    <ul>
                        <li>Time column in match lists. </li>
                        <li>Would it be too difficult to log penalties for individual teams? </li>
                        <li>A simple CMS.</li>
                        <li>Logging of Penalty and Surrogate information for matches in order to determine real time standing.</li>
                        <li>It might also be useful to log comments for individual matches in case we want to look back on 
                            interesting ones.</li>
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
                } else {
                    include($navpages[$currentNav]);
                }
                ?>
            </div>
        </div>
        <div class="footer">
            <a href="http://www.nurdrobotics.com/">www.nurdrobotics.com</a>
            <br/>
            powered by Apache, PHP, MySql, and Ubuntu Server
            <br/>
            Code licensed under <a href="http://www.gnu.org/licenses/gpl.html">GNU GPL v3.0</a>
        </div>
    </body>
</html>

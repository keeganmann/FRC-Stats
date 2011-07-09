<?php
//Secure this page
require("../common.php");
require_authentication();
?>
<div class="rounded"><div class="padder" style="height:auto; text-align: left;">
        <p>Welcome, this is the mobile version of the FRC Stats system.</p>


        <p>
            <strong>Logged in as <?php echo $_SESSION['username']; ?>.</strong>
        </p>
        <p>
            FRC Stats is a database of statistics for <a href="http://www.usfirst.org">FIRST Robotics Competition</a> teams.  
            We are team #3255, and our main website is located at: <a href=""http://www.nurdrobotics.com/">www.nurdrobotics.com</a>.
            This system is intended to be used for entering data on teams during a competition.
            It is capable of logging specific data such as number of tubes placed 
            so that we can make more informed decisions with our alliances and hopefully during 
            the process of alliance selection for the finals.  It can also be used to record 
            responses to surveys.
        </p>
        <h2>Mobile Version Limitations</h2>
        <p>
            Currently, with this mobile version, it is only possible to view statistics.
        </p>
        <p>
            I hope to soon implement the performance data entry form and the survey response entry form.
            I am considering not implementing the match list entry and settings features off the mobile version.
        </p>
        <h2>Code</h2>
        <p>
            The code for this project is now available through an SVN repository as part of the google code project here:
            <a href="http://code.google.com/p/frcstats/">http://code.google.com/p/frcstats/</a>.
        </p>
        <h2>iPhone Install</h2>
        <p>
            You can install a web app on the iPhone so that it appears on the home screen like any other app.
            Simply press the middle button on the bottom bar with the arrow then press "Add to Home Screen".
        </p>
    </div>
</div>
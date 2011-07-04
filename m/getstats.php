<?php
//Secure this page
//require_once 'common.php';
//require_authentication();
/*
 * Displays a small box containing a team's data.
 * Intended to be contained within another page using ajax though php includes 
 * might work too.  The team number should be supplied using the GET 'q' 
 * variable.  For example, "getstats?q=3255" would display the stats for team 
 * #3255
 */
include("../teamstats.php");
include("../robotpics.php");
include("../surveyresponses.php");
include("../teamdata.php");
$teamnumber = $_GET["q"];
$stats = new TeamStats();
$table = $stats->getStats($_GET["q"]);
$surveyresponses = new SurveyResponses();
$response = $surveyresponses->getResponse($teamnumber);
$data = new TeamData();
$teamdata = $data->getTeamData($teamnumber);
?>


<div class="rounded">
    <div class="padderline">

        Team <?php echo $teamnumber . " : " . $teamdata['teamname']; ?>

    </div>
    <div class="padder">

        <?php echo $teamdata['city'] . " " . $teamdata['state'] . " " . $teamdata['country'] . " &nbsp;&nbsp;<em>since " . $teamdata['rookieyear'] . "</em>"; ?>

    </div>
</div>
<div class="rounded">

    <?php
    if (sizeof($table) == 0) {
        echo "NO DATA";
    } else {
        ?>
        <?php
        $i = 0;
        foreach ($table as $index => $value) {
            ?>

            <div class=padderline>

                <?php echo $stats->labels[$i] ?> 

                <div class="floatright">

                    <?php echo $value ?>

                </div>

            </div>

            <?php
            $i++;
        }
    }
    ?>

</div>
<div class="rounded">
    <?php
    if (sizeof($response) < 2) {
        echo "NO SURVEY";
    }
    for ($i = 1; $i < sizeof($response); $i++) {
        ?>

        <div class=padderline>

            <?php echo $surveyresponses->labels[$i]; ?>

            <div class="floatright">

                <?php echo $response[$surveyresponses->columns[$i]]; ?> <br/> 

            </div>

        </div>

        <?php
    }
    ?>

</div>
<div class="rounded">

    <?php
    $pics = new RobotPics();
    if ($path = $pics->getRobotThumbPath($teamnumber)) {
        ?>
        <img src="../<?php echo $path ?>" height="220px" />
        <?php
    } else {
        echo "NO PICTURE";
    }
    ?>

</div>

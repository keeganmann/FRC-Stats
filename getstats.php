<?php
/*
 * Displays a small box containing a team's data.
 * Intended to be contained within another page using ajax though php includes 
 * might work too.  The team number should be supplied using the GET 'q' 
 * variable.  For example, "getstats?q=3255" would display the stats for team 
 * #3255
 */
include("teamstats.php");
include("robotpics.php");
include("surveyresponses.php");
include("teamdata.php");
$teamnumber = $_GET["q"];
$stats = new TeamStats();
$table = $stats->getStats($_GET["q"]);
$surveyresponses = new SurveyResponses();
$response = $surveyresponses->getResponse($teamnumber);
$data = new TeamData();
$teamdata = $data->getTeamData($teamnumber);
?>

<table height="220px">
    <tr>
        <td valign="top">
            <h3 style="margin-bottom:5px;margin-top:0px;">Team <?php echo $teamnumber . " : " . $teamdata['teamname']; ?></h3>
            <p style="margin-top:9px;"><?php echo $teamdata['city'] . " " . $teamdata['state'] . " " . $teamdata['country'] . " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <em>since " . $teamdata['rookieyear'] . "</em>"; ?></p>
            <?php
            if (sizeof($table) == 0) {
                echo "NO DATA";
            } else {
                ?>
                <table style="width:100%;">
                    <?php
                    $i = 0;
                    foreach ($table as $index => $value) {
                        ?>
                        <tr>
                            <td class="stats">
                                <strong>
                                    <?php echo $stats->labels[$i] ?>
                                </strong>
                            </td>
                            <td class="stats"> 
                                <?php echo $value ?> 
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    <?php
                    for ($i = 1; $i < sizeof($response); $i++) {
                        ?>
                        <tr>
                            <td class="stats2">
                                <strong>
                                    <?php echo $surveyresponses->labels[$i] ?>
                                </strong>
                            </td>
                            <td class="stats2"> 
                                <?php echo $response[$surveyresponses->columns[$i]] ?> 
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
            ?>
        </td>
        <td width="220px">
            <?php
            $pics = new RobotPics();
            if ($path = $pics->getRobotPicPath($teamnumber)) {
                ?>
                <img src="getthumbnail.php?w=220&s=<?php echo $path ?>" height="220px" />
                <?php
            } else {
                echo "<table height='100%'><tr><td><center>NO PICTURE</center></td></tr></table>";
            }
            ?>
        </td>
    </tr>
</table>
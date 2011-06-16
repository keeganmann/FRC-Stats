<!--Included by index.php-->
<?php
/*
 * Used for uploading robot pictures and survey responses.
 * TODO: rename to teaminfo.php and update required includes/links/form actins.
 */

include("robotpics.php");
include("thumbgen.php");
$pics = new RobotPics();

if ($_GET['update'] == "pic") {
    $target_dir = "robopics/";

    //$target_path = $target_path . basename($_FILES['uploadedfile']['name']);
    $target_name = "robo" . $_POST["teamnumber"] . "." .
            pathinfo($_FILES['uploadedfile']['name'], PATHINFO_EXTENSION);
    $target_path = $target_dir . $target_name;
    if ($result = move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
        echo "<p>The file " . basename($_FILES['uploadedfile']['name']) .
        " has been uploaded to <a href='$target_path'>$target_path</a>!</p>";
        echo "<p class='fineprint'>" . $pics->addRobotPicPath($_POST["teamnumber"], $target_path) . "</p>";
        createthumb($target_path, $target_dir . "220x220_" . $target_name, 220, 220);
        createthumb($target_path, $target_dir . "100x100_" . $target_name, 100, 100);
    } else {
        echo "<p>There was an error uploading the file, please try again!  " .
        $_FILES["uploadedfile"]["error"] . "</p>";
    }
}
?>
<h2>Robot Picture Upload</h2>
<p>Upload a robot picture and it will be shown next to a team's statistics.</p>
<form enctype="multipart/form-data" action="index.php?n=pics&update=pic" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <table border="0px">
        <tr>
            <td>
                Team Number:  
            </td>
            <td>
                <input type="text" name="teamnumber" />
            </td>
        </tr>
        <tr>
            <td>
                Choose a file to upload:  
            </td>
            <td>
                <input name="uploadedfile" type="file" />
            </td>
        </tr>
    </table>
    <br />
    <input type="submit" value="Upload File" />
</form>
<br/>
<hr/>

<h2>Team Survey Data Entry</h2>
<p>Enter teams' responses to the survey below. 
    Note that entries cannot be partially updated i.e. the new entry completely replaces the old one.</p>
<?php
include("surveyresponses.php");
$responses = new SurveyResponses();
if ($_GET['update'] == 'survey') {
    echo "<p><strong>Survey Response Submitted</strong></p>";
    $entry = array();
    for ($i = 0; $i < sizeof($responses->columns); $i++) {
        if ($responses->controltypes[$i] == "checkbox")
            $entry[$responses->columns[$i]] = (int) ($_POST[$responses->columns[$i]] != "");
        else
            $entry[$responses->columns[$i]] = "'" . $_POST[$responses->columns[$i]] . "'";
    }
    echo "<p class=fineprint>" . $responses->addResponse($entry) . "</p>";
}
?>
<form action="index.php?n=pics&update=survey" method="POST">
    <table>
        <?php
        for ($i = 0; $i < sizeof($responses->columns); $i++) {
            ?>
            <tr>
                <td>
                    <?php echo $responses->labels[$i] ?>
                </td>
                <td>
                    <input type="<?php echo $responses->controltypes[$i] ?>" 
                           name="<?php echo $responses->columns[$i] ?>" />
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br/>
    <input type="submit" value="Submit" />
</form>

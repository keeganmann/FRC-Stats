<!--Included by index.php-->

<?php
require("matches.php");
require("matchperformance.php");
$matchnumber = $_GET["matchnumber"];
if ($_GET["update"] == "true") {
    $performance = new MatchPerformance();
    for ($i = 0; $i < sizeof($performance->columns); $i++) {
        if ($performance->controltypes[$i] == "checkbox")
            $match[$performance->columns[$i]] = (int)($_POST[$performance->columns[$i]] != "");
        else
            $match[$performance->columns[$i]] = $_POST[$performance->columns[$i]];
    }
    echo "<p class=fineprint>" . $performance->addMatch($matchnumber, $match) . "</p>";
}
else if ($_GET["update"] == "clear") {
    $performance = new MatchPerformance();
    $performance->clearData($matchnumber);
} else if ($_GET["update"] == "score") {
    $matches = new Matches();
    echo "<p class=fineprint>" .
    $matches->addScore($matchnumber, $_POST["redscore"], $_POST["bluescore"])
    . "</p>";
}
?>

<p>
    Enter the number of the match for which you would like to view or enter 
    data then press enter to start.
</p>
<form action="index.php" method="get">
    <input type="text" name="matchnumber" <?php if ($matchnumber == "")
    echo "id=initial" ?> />
    <input type="hidden" name="n" value="dataentry" />
    <input type="submit" value="Go" />
</form>

<?php
if ($matchnumber != "") {
    $matches = new Matches();
    $match = $matches->getMatch($matchnumber);
    ?>
    <h2>Match #<?php echo $matchnumber ?></h2>
    <form action="index.php?n=dataentry&update=score&matchnumber=<?php echo $matchnumber ?>" method="post">
        <table style="width: auto; border:#000000; border-style: solid; border-width: 1px">
            <tr>
                <td class="grey" style="padding:10px; text-align:center;">
                    <strong>SCORE: &nbsp;&nbsp;&nbsp;</strong>
                </td>
                <td class="red" style="padding:10px; text-align:center;">
                    <strong><?php echo $match["redscore"] ?></strong>
                </td>
                <td class="blue" style="padding:10px; text-align:center;">
                    <strong><?php echo $match["bluescore"] ?></strong>
                </td>
            </tr>
            <tr>
                <td class="grey" style="padding:10px; text-align:center;">
                    <strong><input type="submit" value="UPDATE:" /></strong>
                </td>
                <td class="red" style="padding:10px; text-align:center;">
                    <input type="text" class="matchentry" name="redscore" />
                </td>
                <td class="blue" style="padding:10px; text-align:center;">
                    <input type="text" class="matchentry"" name="bluescore" />
                </td>
            </tr>
        </table>
    </form>
    <br/>
    <form action="index.php?matchnumber=<?php echo $matchnumber ?>&n=dataentry&update=true" method="post">
        <table>
            <?php
            $performance = new MatchPerformance();
            $performance->update($matchnumber);
            $table = $performance->getMatchTable();
            echo "<tr>";
            foreach ($performance->labels as $column) {
                echo "<td class='grey'><strong>" . $column . "</strong></td>";
            }
            echo "</tr>";
            foreach ($table as $row) {
                echo "<tr>";
                foreach ($row as $entry) {
                    echo "<td class='grey'>";
                    echo $entry;
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "<tr><td class=grey><strong>ADD:</strong></td>";
            ?>
            <td class=grey>
                <select name="teamnumber" id="teamnumberselect" >
                    <?php
                    for ($i = 1; $i <= 6; $i++) {
                        echo "<option value='" . $match["team" . $i] . "' >" . $match["team" . $i] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <?php
            for ($i = 2; $i < sizeof($performance->columns); $i++) {
                echo "<td class=grey><input class=fullwidth type=" . $performance->controltypes[$i] . " name=" . $performance->columns[$i] . " />";
            }
            echo "</tr>";
            ?>
        </table>
        <br/>
        <input type="submit" value="Add Row" />
    </form>
    <br/>
    <form action="index.php" method="get">
        <input type="hidden" name="matchnumber" value="<?php echo $matchnumber ?>" />
        <input type="hidden" name="n" value="dataentry" />
        <input type="hidden" name="update" value="clear" />
        <input type="submit" value="Clear" /> (Clear performance data for this match)
    </form>
    <?php
    //TODO add a "clear all performance data" button
}
?>

<!-- code to set the default input focus -->
<script>
    document.getElementById('teamnumberselect').focus();
</script>


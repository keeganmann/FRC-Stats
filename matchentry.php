<!--included by index.php-->
<p>Enter the list of matches below.</p>
<p>
    It is estimated that 100 matches will take 1 hour to enter working nonstop.  
    Try to use the keyboard rather than the mouse to navigate between controls 
    i.e. use tab and enter.  
    <br/><br/>
    TODO: Automate this process-fetch data from somewhere.
</p>
<?php
//TODO: Automate the match entry process.
include("matches.php");
if ($_POST["matchnumber"] != "") {
    echo "<p class=fineprint>";
    $matches = new Matches();
    echo "UPDATED : QUERY=" . $matches->addMatch($_POST["matchnumber"], $_POST) . "</p>";
}
?>

<form action="index.php?n=matchentry" method="post">
    <table>
        <tr>
            <td class="grey"><strong>Match Number</strong></td>
            <td class="red"> <strong>Team 1</strong></td>
            <td class="red"> <strong>Team 2</strong></td>
            <td class="red"> <strong>Team 3</strong></td>
            <td class="blue"><strong>Team 4</strong></td>
            <td class="blue"><strong>Team 5</strong></td>
            <td class="blue"><strong>Team 6</strong></td>
            <td class="red"> <strong>Red Score</strong></td>
            <td class="blue"><strong>Blue Score</strong></td>
        </tr>
        <?php
        $matches = new Matches();
        $matches->update();
        foreach ($matches->getMatchTable() as $matchnumber => $match) {
            ?>
            <tr>
                <td class="grey"><?php echo $matchnumber ?></td>
                <td class="red"><?php echo $match["team1"] ?></td>
                <td class="red"><?php echo $match["team2"] ?></td>
                <td class="red"><?php echo $match["team3"] ?></td>
                <td class="blue"><?php echo $match["team4"] ?></td>
                <td class="blue"><?php echo $match["team5"] ?></td>
                <td class="blue"><?php echo $match["team6"] ?></td>
                <td class="red"><?php echo $match["redscore"] ?></td>
                <td class="blue"><?php echo $match["bluescore"] ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td class="grey"><input class="matchentry" type="text" name="matchnumber" id="inputmatchnumber"/></td>
            <td class="red"> <input class="matchentry" type="text" name="team1"/></td>
            <td class="red"> <input class="matchentry" type="text" name="team2"/></td>
            <td class="red"> <input class="matchentry" type="text" name="team3"/></td>
            <td class="blue"><input class="matchentry" type="text" name="team4"/></td>
            <td class="blue"><input class="matchentry" type="text" name="team5"/></td>
            <td class="blue"><input class="matchentry" type="text" name="team6"/></td>
            <td class="red"> <input class="matchentry" type="text" name="redscore"/></td>
            <td class="blue"><input class="matchentry" type="text" name="bluescore"/></td>
        </tr>
    </table>
    <br/>
    <input type="submit" value="Add Row"/>
</form>
<!-- code to set the default input focus -->
<script>
  document.getElementById('inputmatchnumber').focus();
</script>

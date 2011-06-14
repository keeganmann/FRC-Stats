<!--Included by index.php-->

<p>
    Upcoming matches are listed below.
</p>

<script type="text/javascript">
    function getRequest(address, spanout){
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById(spanout).innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET",address,false);
        xmlhttp.send(); 
    }
    function updateTeams(matchnumber, team1, team2, team3, team4, team5, team6){
        document.getElementById("matchnumberspan").innerHTML = "Teams in Match #" + matchnumber;
        document.getElementById("team1span").innerHTML = 
            document.getElementById("team2span").innerHTML = 
            document.getElementById("team3span").innerHTML = 
            document.getElementById("team4span").innerHTML = 
            document.getElementById("team5span").innerHTML = 
            document.getElementById("team6span").innerHTML = "Loading...";
        getRequest("getstats.php?rot=horiz&q=" + team1, "team1span");
        getRequest("getstats.php?rot=horiz&q=" + team2, "team2span");
        getRequest("getstats.php?rot=horiz&q=" + team3, "team3span");
        getRequest("getstats.php?rot=horiz&q=" + team4, "team4span");
        getRequest("getstats.php?rot=horiz&q=" + team5, "team5span");
        getRequest("getstats.php?rot=horiz&q=" + team6, "team6span");
    }
</script>

<?php
include("matches.php");
$myteam = "3255";
$detailmatch = $_GET["matchnumber"];
?>
<p>
    <strong>View your competition in upcoming matches by clicking "detail" for a match below.</strong>
</p>
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
        <td class="grey"><strong>Detail</strong></td>
    </tr>
    <?php
    $matches = new Matches();
    $matches->matchesForTeam($myteam);
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
            <td class="grey"><input type="button" 
                                    value="detail" 
                                    onclick="updateTeams(
                                    <?php
                                    echo $matchnumber . "," .
                                    $match["team1"] . "," .
                                    $match["team2"] . "," .
                                    $match["team3"] . "," .
                                    $match["team4"] . "," .
                                    $match["team5"] . "," .
                                    $match["team6"]
                                    ?>)" /></td>
        </tr>
        <?php
    }
    ?>
</table>

<h2><span id="matchnumberspan"></span></h2>

<span id="team1span"></span><br/>
<span id="team2span"></span><br/>
<span id="team3span"></span><br/>
<span id="team4span"></span><br/>
<span id="team5span"></span><br/>
<span id="team6span"></span><br/>


<!--

OBSOLETE - SHOULD BE DELETED
WAS USED IN AN ATTEMPT TO CONVERT THE CURRENT PERFORMANCE DATA ENTRY SYSTEM TO 
USE AJAX.  SEE DATAENTRY.PHP FOR THE FUNCTIONING IMPLEMENTATION.

-->

<script type="text/javascript">
    function updateData(str)
    {
        if (str.length==0)
        { 
            document.getElementById("dataentryspan").innerHTML="";
            return;
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
                document.getElementById("dataentryspan").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","dataentry.php?matchnumber="+str,true);
        xmlhttp.send();
    }
</script>

<p>
    Enter the number of the match for which you would like to view or enter 
    data to start.
</p>
<form>
    <input type="text" value="<?php echo $_GET['matchnumber'] ?>" name="matchnumber" id="matchnumberselect" onkeyup="updateData(this.value)"  />
</form>

<span id="dataentryspan"></span>

<!-- code to set the default input focus -->
<script>
    document.getElementById('matchnumberselect').focus();
</script>

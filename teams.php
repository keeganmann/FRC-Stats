<!--Included by index.php-->
<!--Used to view general team data returned by "getstats.php"-->

<script type="text/javascript">
    function updateStats(str)
    {   
        if (str.length==0)
        { 
            document.getElementById("txtHint").innerHTML="";
            return;
        }
        else{
            //document.getElementById("txtStats").innerHTML="<p><center>Loading...</center></p>";
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
                document.getElementById("txtStats").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getstats.php?rot=horiz&q="+str,true);
        xmlhttp.send();
    }
</script>

<p>
    View statistics for teams by typing the team's number below.  In the 
    resulting table, information in grey was supplied as match performance data 
    and data in green was entered as part of the survey.
</p>

<form>
    Team #: <input type="text" onkeyup="updateStats(this.value)" id="initial" size="20" />
</form>
<br/>
<span id="txtStats"></span>

<!-- code to set the default input focus -->
<script>
    document.getElementById('initial').focus();
</script>

<!--Included by index.php-->
<p style="font-size: 10px">
    WARNING: The following operations modify the structure of the data stored in 
    the database. Removing a single parameter below will destroy all data
    associated with it.  However, right now we are in a testing phase and have 
    no precious data to destroy, so don't worry.  
</p>
<h2>Performance Data Properties</h2>
<p>
    These properties are entered under the Performance tab and are displayed in 
    the team statistics.  
</p>
<p>
    <strong>NEW:</strong> You can edit them below.  However the buttons labeled 'edit' don't work.
    Therefore, the only way to modify a property is to delete it and add it back.
    Note that doing so will clear all data for the property).
</p>
<script type="text/javascript" src="http://pajhome.org.uk/crypt/md5/md5.js"></script>
<script type="text/javascript">
    var xmlhttp;
    var currentTable = "";
    var currentSpan = "";
    var currentLockedRows = 0;
    function reset(){
        document.getElementById('performancepropertiesspan').innerHTML=
            '<input type="button" value="Start Editing Performance Properties" onclick="startperformanceproperties();" />';
        document.getElementById('surveyquestionsspan').innerHTML=
            '<input type="button" value="Start Editing the Survey Questions" onclick="startsurveyquestions();" />';
        //account edit span
        document.getElementById('useraccountsspan').innerHTML=
            '<input type="button" value="Start Editing User Accounts" onclick="startedituseraccounts();" />';
    }
    function startperformanceproperties(){
        reset()
        currentTable = "Performance";
        currentSpan = "performancepropertiesspan";
        currentLockedRows = 2;
        start();
    }
    function startsurveyquestions(){
        reset();
        currentTable = "SurveyResponses";
        currentSpan = "surveyquestionsspan";
        currentLockedRows = 1;
        start();
    }
    function start(){
        updateSpan(currentSpan, "editcolumns/viewcolumns.php?table=" + currentTable + "&lock=" + currentLockedRows);
    }
    function updateSpan(spanname, query)
    {   
        ajaxGet(query, function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById(spanname).innerHTML=xmlhttp.responseText;
            }
        });
    }
    function ajaxGet(query, func){
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=func;
        xmlhttp.open("GET",query,false);
        xmlhttp.send();
    }
    function removeColumn(columnname){
        ajaxGet("editcolumns/remove.php?table=" + currentTable + "&column=" + columnname, function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert('done dropping');
                startperformanceproperties();
            }
        });
    }
    function addNewColumn(){
        updateSpan(currentSpan, "editcolumns/add.php?table=" + currentTable)
    }
    function addNow(){
        columnname = document.getElementById("textaddcolumnname").value;
        datatype = document.getElementById("textadddatatype").value;
        label = document.getElementById("textaddlabel").value;
        ajaxGet("editcolumns/addnow.php?table=" + currentTable + "&columnname=" + columnname + 
            "&datatype=" + datatype + "&label=" + label, function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert(xmlhttp.responseText);
                start();
            }
        });
    }
    
    //user account edit functions
    function startedituseraccounts(){
        reset();
        updateSpan("useraccountsspan", "editaccounts/view.php");
    }
    function editAccount(username){
        updateSpan("useraccountsspan", "editaccounts/edit.php?username=" + username);
    }
    function cancelEditAccount(){
        startedituseraccounts();
    }
    function addAccount(){
        updateSpan("useraccountsspan", "editaccounts/add.php");
    }
    function deleteUser(username){
        ajaxGet("editaccounts/delete.php?username=" + username, function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert(xmlhttp.responseText);
                startedituseraccounts();
            }
        });
    }
    function checkPasswordMatch(){
        return document.getElementById("passwordtext").value ==
            document.getElementById("password2text").value;
    }
    function addUserNow(){
        username = document.getElementById("usernametext").value;
        password = document.getElementById("passwordtext").value;
        hexpass = hex_md5(password);
        if(!checkPasswordMatch()){
            alert("passwords don't match");
            return;
        }
        firstname = document.getElementById("firstnametext").value;
        lastname = document.getElementById("lastnametext").value;
        email = document.getElementById("emailtext").value;
        permissions = document.getElementById("permissionstext").value;
        ajaxGet("editaccounts/addnow.php?username=" + username + "&password=" + hexpass + 
            "&firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + 
            "&permissions=" + permissions, function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert(xmlhttp.responseText);
                startedituseraccounts();
            }
        });
    }
    function updateUser(username){
        username = document.getElementById("usernametext").value;
        firstname = document.getElementById("firstnametext").value;
        lastname = document.getElementById("lastnametext").value;
        email = document.getElementById("emailtext").value;
        permissions = document.getElementById("permissionstext").value;
        ajaxGet("editaccounts/update.php?username=" + username  + 
            "&firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + 
            "&permissions=" + permissions, function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert(xmlhttp.responseText);
                startedituseraccounts();
            }
        });
    }
    function changePass(username){
        updateSpan("useraccountsspan", "editaccounts/pass.php?username=" + username);
    }
    function changePassNow(username){
        password = document.getElementById("passwordtext").value;
        if(!checkPasswordMatch()){
            alert("passwords don't match");
            return;
        }
        hexpass = hex_md5(password);
        ajaxGet("editaccounts/update.php?username=" + username + "&password=" + hexpass, function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert(xmlhttp.responseText);
                startedituseraccounts();
            }
        });
        startedituseraccounts()
    }
</script>
<span id="performancepropertiesspan">
    <form>
        <input type="button" value="Start Editing Performance Properties" onclick="startperformanceproperties();" />
    </form>
</span>
<hr/>
<h2>Survey Questions</h2>
<p>
    These properties are entered under the Team Data tab and are displayed in 
    the team statistics.  
</p>
<p>
    <strong>NEW:</strong> You can edit them below.  However the buttons labeled 'edit' don't work.
    Therefore, the only way to modify a property is to delete it and add it back.
    Note that doing so will clear all data for the property).
</p>
<span id="surveyquestionsspan">
    <form>
        <input type="button" value="Start Editing the Survey Questions" onclick="startsurveyquestions();" />
    </form>
</span>
<hr/>
<h2>User Accounts</h2>
<?php
if ($_SESSION['permissions'] == 'admin') {
    ?>
    <script type="text/javascript">
    </script>
    <span id="useraccountsspan">
        <form>
            <input type="button" value="Start Editing User Accounts" onclick="startedituseraccounts();" />
        </form>
    </span>
    <?php
} else {
    ?>
    <p>Only an admin user can edit user accounts.</p>
    <?php
}
?>

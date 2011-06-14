<?php
include('../accounts.php');
$username = $_GET['username'];
$accounts = new Accounts();
$account = $accounts->getAccount($username);
?>

<script type="text/javascript">
    function updatecheckbox(value){
        alert(((value == 'on') ? '' : 'disabled'));
        //        document.getElementById('passwordtext').disabled = 
        //            document.getElementById('password2text').disabled = 
        //            ((value == 'on') ? '' : 'disabled'));
    }
</script>
<table>
    <tr>
        <td>
            Username: 
        </td>
        <td>
            <input type="hidden" id="usernametext" value="<?php echo $username; ?>" /><?php echo $username; ?>
        </td>
    </tr>
    <tr>
        <td>
            First Name: 
        </td>
        <td>
            <input type="text" id="firstnametext" value="<?php echo $account['firstname']; ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            Last Name: 
        </td>
        <td>
            <input type="text" id="lastnametext" value="<?php echo $account['lastname']; ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            Email: 
        </td>
        <td>
            <input type="text" id="emailtext"  value="<?php echo $account['email']; ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            Permissions: 
        </td>
        <td>
            <select id="permissionstext" <?php if ($username == "root") echo " disabled='disabled' "; ?>>
                <option <?php echo $account['permissions'] == 'admin' ?       'selected=selected': ""; ?> >      admin</option>
                <option <?php echo $account['permissions'] == 'contributor' ? 'selected=selected': ""; ?> >contributor</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            <input type="button" value="update" onclick="updateUser('<?php echo $username; ?>')" />
            <input type="button" value="delete" onclick="deleteUser('<?php echo $username; ?>')" 
            <?php if ($username == "root")
                echo " disabled='disabled' "; ?>/>
            <input type="button" value="cancel" onclick="cancelEditAccount()" />
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            <?php if ($username == "root")
                echo "(root user cannot be deleted and must be an admin)"; ?>
        </td>
    </tr>
</table>
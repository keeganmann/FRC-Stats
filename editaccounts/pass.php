<?php
$username = $_GET['username'];
echo "<p>Changing password for user $username.</p>"
?>
<table>
    <tr>
        <td>
            Password:
        </td>
        <td>
            <input type="password" id="passwordtext" />
        </td>
    </tr>
    <tr>
        <td>
            Confirm:
        </td>
        <td>
            <input type="password" id="password2text" />
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            <input type="button" value="Cancel" onclick="cancelEditAccount()" />
            <input type="button" value="Change Password" onclick="changePassNow('<?php echo $username; ?>')" />
        </td>
    </tr>
</table>

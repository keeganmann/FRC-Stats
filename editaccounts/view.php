<?php
//Secure this page
require_once '../common.php';
require_authentication();

include("../accounts.php");
$accounts = new Accounts();
?>
<table>
    <tr>
        <td class="grey">
            <strong>
                Username
            </strong>
        </td>
        <td class="grey">
            <strong>
                First Name
            </strong>
        </td>
        <td class="grey">
            <strong>
                Last Name
            </strong>
        </td>
        <td class="grey">
            <strong>
                Email
            </strong>
        </td>
        <td class="grey">
            <strong>
                Permissions
            </strong>
        </td>
        <td class="grey">
            <strong>
                Edit
            </strong>
        </td>
    </tr>
    <?php
    $table = $accounts->getAccountTable();
    foreach ($table as $account) {
        ?>
        <tr>
            <td class="narrow">
                <?php echo $account['username']; ?>
            </td>
            <td class="narrow">
                <?php echo $account['firstname']; ?>
            </td>
            <td class="narrow">
                <?php echo $account['lastname']; ?>
            </td>
            <td class="narrow">
                <?php echo $account['email']; ?>
            </td>
            <td class="narrow">
                <?php echo $account['permissions']; ?>
            </td>
            <td class="narrow">
                <input type="button" value="EDIT" onclick="editAccount('<?php echo $account['username']; ?>');" />
                <input type="button" value="PASS" onclick="changePass('<?php echo $account['username']; ?>');" />
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<input type="button" value="ADD NEW" onclick="addAccount();" />

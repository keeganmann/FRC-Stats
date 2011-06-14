<table>
    <tr>
        <td>
            Username: 
        </td>
        <td>
            <input type="text" id="usernametext" />
        </td>
    </tr>
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
            Confirm Password: 
        </td>
        <td>
            <input type="password" id="password2text" />
        </td>
    </tr>
    <tr>
        <td>
            First Name: 
        </td>
        <td>
            <input type="text" id="firstnametext" />
        </td>
    </tr>
    <tr>
        <td>
            Last Name: 
        </td>
        <td>
            <input type="text" id="lastnametext" />
        </td>
    </tr>
    <tr>
        <td>
            Email: 
        </td>
        <td>
            <input type="text" id="emailtext" />
        </td>
    </tr>
    <tr>
        <td>
            Permissions: 
        </td>
        <td>
            <select id="permissionstext">
                <option>admin</option>
                <option selected="selected">contributor</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            <input type="button" value="Cancel" onclick="cancelEditAccount()" />
            <input type="button" value="Add Now" onclick="addUserNow()" />
        </td>
    </tr>
</table>
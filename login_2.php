<?php
///////////////////////////////////////////////////////////////////////////// 
// 
// LOGIN PAGE - OBSOLETE
// 
//   Server-side: 
//     1. Start a session
//     2. Clear the session
//     3. Generate a random challenge string
//     4. Save the challenge string in the session
//     5. Expose the challenge string to the page via a hidden input field
//
//  Client-side:
//     1. When the completes the form and clicks on Login button
//     2. Validate the form (i.e. verify that all the fields have been filled out)
//     3. Set the hidden response field to HEX(MD5(server-generated-challenge + user-supplied-password))
//     4. Submit the form
////////////////////////////////////////////////////////////////////////////////// 
session_start();
session_unset();
srand();
$challenge = "";
for ($i = 0; $i < 80; $i++) {
    $challenge .= dechex(rand(0, 15));
}
$_SESSION[challenge] = $challenge;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>FRC STATS - Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <STYLE type="text/css">
            body {
                font-family: Helvetica, sans-serif;
                font-size: 14px;
                text-align:center;
                background-color: #aaaaaa;
                color: #444444;
            }
            a
            {
                text-decoration:none;
                color: #0000ff;
            }
            a:hover
            {
                text-decoration:none;
                color: #ff0000;
            }
            div.box{
                background-image: url('/graphics/box.png');
                background-repeat: no-repeat;
                background-attachment: left bottom;
                width: 400px;
                height:500px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 0px;
                border: #aaaaaa;
                border-style: solid;
                border-width: 1px;
            }
            div.login{
                padding: 10px;
                border: black;
                border-style: none;
                border-width: 1px;
                margin-left: 93px;
                margin-right: auto;
                margin-top: 100px;
                margin-bottom: auto;
                width: 180px;
                height:280px;
            }
            p{
                font-size: 14px;
                margin-top:10px;
            }
            p.first {
                margin-top:52px;
            }
            p.back{
                font-size: 10px;
            }
            label{
                font-size: 12px;
                color: #707070;
            }
        </STYLE>
        <link rel="shortcut icon" href="favicon.ico" />
        <script type="text/javascript" src="http://pajhome.org.uk/crypt/md5/md5.js"></script>
        <script type="text/javascript">
            function login() {
                var loginForm = document.getElementById("loginForm");
                //make sure it's filled in
                if (loginForm.username.value == "") {
                    alert("Please enter your user name.");
                    return false;
                }
                if (loginForm.password.value == "") {
                    alert("Please enter your password.");
                    return false;
                }
                //submit the hidden form
                var submitForm = document.getElementById("submitForm");
                submitForm.username.value = loginForm.username.value;
                submitForm.response.value = 
                    hex_md5(loginForm.challenge.value+loginForm.password.value);
                submitForm.submit();
            }
        </script> 
    </head>
    <body>
        <div class="box">
            <div class="login">
                <!--<h1>Please Login</h1>-->
                <p class="first">
                    Username is 'nurd' and the password is '3255'.
                </p>
                <form id="loginForm" action="#" method="post">
                    <input type="hidden" name="challenge" value="<?php echo $challenge; ?>"/>
                    <?php if (isset($_REQUEST[error])) { ?>
                        <p style="color: red;">
                            Error <?php echo $_REQUEST[error]; ?>
                        </p>
                    <?php } ?>
                    <p>
                        <label>User Name<br/>
                            <input type="text" id="username" name="username"/></label>
                    </p>
                    <p>
                        <label>Password<br/>
                            <input type="password" name="password" 
                                   onkeydown="if (event.keyCode == 13) 
                                       document.getElementById('triggerbutton').click()"/>
                        </label>
                    </p>
                    <p>
                        <input type="button" id="triggerbutton" name="submit" value="Login" onclick="login();"/>
                    </p>
                    <p class="back"><a href="http://www.nurdrobotics.com">Back to nurdrobotics.com</a></p>
                </form>
            </div>
        </div>
        <form id="submitForm" action="authenticate.php" method="post">
            <div>
                <input type="hidden" name="username"/>
                <input type="hidden" name="response"/>
            </div>
        </form>
    </body>
</html>

<!-- code to set the default input focus -->
<script>
    document.getElementById('username').focus();
</script>

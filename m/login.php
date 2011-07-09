<?php
session_start();
session_unset();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>FRC STATS - Mobile Login</title>
        <meta name="app-mobile-web-app-capable" content="yes" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
        <script>
            fullscreen();
            function fullscreen(){
                if (navigator.userAgent.indexOf('iPhone') != -1) {
                    setTimeout(function () {
                        window.scrollTo(0, 1);
                    }, 1000);
                }
            }
        </script>
        <style type="text/css">
            body.login {
                font-family: Helvetica, sans-serif;
                font-size: 14px;
                text-align:center;
                background-color: #b6b6b6;
                background-image: url('pics/baloon.jpg');
                background-repeat: no-repeat;
                background-position: top;
                color: #ffffff;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body class="login">
        <h1>Login</h1>
        <form action="authenticate.php" method="post" >
            <div class="rounded">
                <div class="padderline">
                    Username: 
                    <input type="text" name="username" autocorrect="off" autocapitalize="off"/>
                </div>
                <div class="padderline">
                    Password: 
                    <input type="password" name="password" />
                </div>
                <div class="padder">
                    <input type="submit" value="Login" style="background-color:#000044;width:280px;font-weight: bold;" />
                </div>
            </div>
        </form>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </body>
</html>
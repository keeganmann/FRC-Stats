<html>
    <head>
        <title>FRC STATS - <?php echo $title ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <style type="text/css">
            table{
                margin-left: auto;
                margin-right: auto;
                width:auto;
                background: #b9b9b9;
                color: #555555;
            }
            h2, h1{
                color: #ffffff;
            }
            body {
                font-family: Helvetica, sans-serif;
                font-size: 14px;
                text-align:center;
                background-color: #b6b6b6;
                background-color: #000000;
                background-image: url('graphics/tilestars.jpg');
                background-repeat:repeat;
                color: #b6b6b6;
            }
        </style>
    </head>
    <body>
        <?php
        include('config.php');
        if(frcgetinstalled()){
            ?>
            <h1 style="color: #ff0000;">ERROR: SYSTEM ALREADY INSTALLED</h1>
            <A href="index.php">Click here to continue</a>
            <?php
        }
        else if ($_POST['username'] != "") {
            echo "installing...";
            //set database login info in config.php
            $file = fopen("config.php", "a");
            fwrite($file, "<?php\n");
            fwrite($file, "\$frcmysqlusername = " . $_POST[username] . ";\n");
            fwrite($file, "\$frcmysqlpassword = " . $_POST[password] . ";\n");
            fwrite($file, "\$frcmysqldatabase = " . $_POST[database] . ";\n");
            fwrite($file, "\$frcmysqlserverurl =" . $_POST[serverurl] . ";\n");
            fwrite($file, "\$frcinstalled = TRUE;\n");
            fwrite($file, "?>\n");
            fclose($file);
            echo "connecting...";
            $con = mysql_connect($_POST[serverurl], $_POST[username], $_POST[password]);
            if (!$con)
                die("ERROR: COULD NOT CONNECT TO DATABASE");
            //create the database
            echo "create database...";
            mysql_query("CREATE DATABASE " . $_POST[database]);
            mysql_select_db($_POST[database], $con);
            //create the tables
            echo "create tables...";
            mysql_query("
                CREATE TABLE Accounts
                (
                username varchar(50), 
                password varchar(50), 
                firstname varchar(50), 
                lastname varchar(50), 
                email varchar(100), 
                permissions varchar(50)
                )");
            mysql_query("
                CREATE TABLE Matches
                (
                matchnumber int(11), 
                team1 int(11), 
                team2 int(11), 
                team3 int(11), 
                team4 int(11), 
                team5 int(11), 
                team6 int(11), 
                redscore int(11), 
                bluescore int(11)
                )");
            mysql_query("
                CREATE TABLE Performance
                (
                matchnumber int(11), 
                teamnumber int(5)
                )");
            mysql_query("
                CREATE TABLE Robopics
                (
                teamnumber int(11), 
                path varchar(50)
                )");
            mysql_query("
                CREATE TABLE SurveyResponses
                (
                teamnumber int(5)
                )");
            mysql_query("
                CREATE TABLE TeamData
                (
                teamnumber int(5), 
                teamname varchar(50), 
                city varchar(50), 
                state varchar(50), 
                country varchar(50), 
                rookieyear int(4)
                )");
            //create root account
            echo "adding root user...";
            mysql_query("
                INSERT INTO Accounts 
                VALUES ('root', '" . md5($_POST['rootpass']) . "', NULL, NULL, NULL, 'admin')");
            mysql_close()
            ?>
            <h1>INSTALLATION SUCCESSFUL</h1>
            <A href="index.php">Click here to continue</a>
            <?php
        } else {
            ?>
            <h1>Install</h1>
            <form action="install.php" method="post">
                <h2>Database</h2>
                <table>
                    <tr>
                        <td>
                            Username:  
                        </td>
                        <td>
                            <input type="text" name="username" value="root" /><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password:  
                        </td>
                        <td>
                            <input type="password" name="password" value="nageek5tree" /><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Database Name:  
                        </td>
                        <td>
                            <input type="text" name="database" value="frc_stats_2011" /><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Server URL:  
                        </td>
                        <td>
                            <input type="text" name="serverurl" value="localhost" /><br/>
                        </td>
                    </tr>
                </table>
                <br/>
                <h2>Account</h2>
                <table>
                    <tr>
                        <td>
                            root password:  
                        </td>
                        <td>
                            <input type="password" name="rootpass" value="cobalt60" /><br/>
                        </td>
                    </tr>
                </table>
                <br/>
                <p>
                    <input type="submit" value="Install" />
                </p>
            </form>
            <?php
        }
        ?>
    </body>
</html>
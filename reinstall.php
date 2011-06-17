<?php

//Secure this page
require("common.php");
require_authentication();
//Reset installed switch in config.php
$file = fopen("config.php", "a");
fwrite($file, "<?php\n");
fwrite($file, "\$frcinstalled = FALSE;\n");
fwrite($file, "?>\n");
fclose($file);
//redirect to install page.
header("Location:install.php");

?>

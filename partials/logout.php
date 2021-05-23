<?php
session_start();
session_destroy();


echo "Logging you out please wait";
header("location:/Foram");
?>
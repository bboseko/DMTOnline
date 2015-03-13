<?php

session_start();
if (isset($_SESSION["lang"])) {
    echo $_SESSION['lang'];
}
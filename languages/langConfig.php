<?php
session_start();
// What languages do we support
$available_langs = array('en', 'fr');
// Set our default language session
$_SESSION['lang'] = 'en';
if (isset($_GET['lang']) && $_GET['lang'] != '') {
    // check if the language is one we support
    if (in_array($_GET['lang'], $available_langs)) {
        $_SESSION['lang'] = $_GET['lang']; // Set session
    }
}
// Include active language
include($_SESSION['lang'] . '/lang.' . $_SESSION['lang'] . '.php');

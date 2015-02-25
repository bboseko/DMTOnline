<?php

// CONNECT TO THE DATABASE
header("content-type: text/html; charset=UTF-8");
include_once ("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
// GATHER THE POSTED DATA INTO LOCAL VARIABLES
$db_id = $_POST['id-edit'];
$firstname = $_POST['firstname'];
$familyname = $_POST['familyname'];
$othername = $_POST['othername'];
$sex = $_POST['sex'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$nationality = $_POST['nationality'];
$profession = $_POST['profession'];
$institution = $_POST['institution'];

//---------------------------------
// FORM DATA ERROR HANDLING
if ($firstname === "" || $familyname === "" || $sex === "" || $address === "" || $phone === "" || $email === "" || $nationality === "" || $profession === "" || $institution === "") {
    echo "The_form_submission_is_missing_values";
    exit();
} else {
    // Update user info into the database table for the main site table
    $sql = "update dmt_user set firstname='" . mysql_real_escape_string($firstname) . "', familyname='" . mysql_real_escape_string($familyname) . "', othername='" . mysql_real_escape_string($othername) . "', sex='" . mysql_real_escape_string($sex) . "', address='" . mysql_real_escape_string($address) . "', phone='" . mysql_real_escape_string($phone) . "', email='" . mysql_real_escape_string($email) . "', profession='" . mysql_real_escape_string($profession) . "', institution='" . mysql_real_escape_string($institution) . "', nationality='" . mysql_real_escape_string($nationality) . "' where id_user='$db_id' limit 1";
    $Connex->query($sql);
    echo "edit_success";
    exit();
}

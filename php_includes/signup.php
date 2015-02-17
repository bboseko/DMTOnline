<?php

// CONNECT TO THE DATABASE
header("content-type: text/html; charset=UTF-8");
include("../languages/langConfig.php");
include_once ("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
// GATHER THE POSTED DATA INTO LOCAL VARIABLES
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
$username = preg_replace('#[^a-z0-9]#i', '', $_POST['username']);
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
//$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

$Connex->query("SELECT * FROM dmt_user WHERE username = '$username' LIMIT 1");
$username_check = $Connex->num_rows();
//---------------------------------
$Connex->query("SELECT * FROM dmt_user WHERE email = '$email' LIMIT 1");
$email_check = $Connex->num_rows();
// FORM DATA ERROR HANDLING
if ($firstname === "" || $familyname === "" || $sex === "" || $address === "" || $phone === "" || $email === "" || $nationality === "" || $profession === "" || $institution === "" || $username === "" || $password1 === "" || $password2 === "") {
    echo "The form submission is missing values.";
    exit();
} else if ($username_check > 0) {
    echo "The username you entered is alreay taken";
    exit();
} else if ($email_check > 0) {
    echo "That email address is already in use in the system";
    exit();
} else if (strlen($username) < 3 || strlen($username) > 16) {
    echo "Username must be between 3 and 16 characters";
    exit();
} else if (strlen($password1) < 5) {
    echo "Password must have at least 5 characters";
    exit();
} else if (is_numeric($username[0])) {
    echo 'Username cannot begin with a number';
    exit();
} else {
    // END FORM DATA ERROR HANDLING
    // Begin Insertion of data into the database
    // Hash the password and apply your own mysterious unique salt
    $cryptpass = crypt($password1);
    include_once ("randStrGen.php");
    $password_hash = randStrGen(20) . "$cryptpass" . randStrGen(20);
    $id_profile = 2;
    include_once ("../script/fonctions.php");
    connectdb();
    // Add user info into the database table for the main site table
    $sql = "INSERT INTO dmt_user (firstname, familyname, othername, sex, address, phone, email, profession, institution, nationality, username, password, register_date, last_visit_date, id_profile)       
		        VALUES ('" . mysql_real_escape_string($firstname) . "','" . mysql_real_escape_string($familyname) . "','" . mysql_real_escape_string($othername) . "','" . mysql_real_escape_string($sex) . "','" . mysql_real_escape_string($address) . "','" . mysql_real_escape_string($phone) . "','" . mysql_real_escape_string($email) . "','" . mysql_real_escape_string($profession) . "','" . mysql_real_escape_string($institution) . "','" . mysql_real_escape_string($nationality) . "','" . mysql_real_escape_string($username) . "','" . mysql_real_escape_string($password_hash) . "',now(), now(), $id_profile)";
    if (!mysql_query($sql)) {
        die('Error: ' . mysql_error());
        echo "An error occured while saving into database";
    } else {
        $userid = @mysql_insert_id();
        // Create directory(folder) to hold each user's files(pics, MP3s, etc.)
//    if (!file_exists("user/$username")) {
//        mkdir("user/$username", 0755);
//    }
        // Email the user their activation link
        $to = "$email";
        $from = "dmt@osfac.net";
        $subject = 'OSFAC-DMT Account Activation';
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>OSFAC-DMT Message</title></head><body><div id=":pf" style="direction: ltr;"><div id=":pe" style="overflow: hidden;"><div style="background:#f4f4f4;font-size:16px;padding:20px;font-family:Arial, Helvetica, sans-serif;"><div style="background:#67b021;font-size:20px;min-height:50px;color:#fff;line-height:50px;padding-left:15px;margin-bottom:0px">OSFAC-DMT</div><div style="background:#fff;padding:15px;font-family:Arial, Helvetica, sans-serif;"><p>Welcome  <b>' . $firstname . ' ' . $familyname . ' </b><br></p>To complete your registration process at OSFAC-DMT you just have to activate your account by clicking on the following link:<br/><br/><a href="http://www.osfac.net/dev/php_includes/activation.php?id=' . $userid . '&u=' . $username . '&e=' . $email . '&p=' . $password_hash . '">Click here to activate your account now</a><br/><br/>Login after successful activation using your:<br />* Username: <b>' . $username . '</b><br/><br/>With our compliments,<br>OSFAC Data Management Team</div></div></div></div></body></html>';
        $headers = "From: OSFAC-DMT <$from>\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        mail($to, $subject, $message, $headers);
        echo "signup_success";
    }
    exit();
}

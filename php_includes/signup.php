<?php

include ("../languages/include_lang_file.php");
// CONNECT TO THE DATABASE
header("content-type: text/html; charset=UTF-8");
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
    echo $lang['form-submission-error'];
    exit();
} else if ($username_check > 0) {
    echo $lang['username-already-taken'];
    exit();
} else if ($email_check > 0) {
    echo $lang['email-in-use-system'];
    exit();
} else if (strlen($username) < 3 || strlen($username) > 16) {
    echo $lang['username-length-problem'];
    exit();
} else if (strlen($password1) < 5) {
    echo $lang['password-length-problem'];
    exit();
} else if (is_numeric($username[0])) {
    echo $lang['username-begin-number'];
    exit();
} else {
    // END FORM DATA ERROR HANDLING
    // Begin Insertion of data into the database
    // Hash the password and apply your own mysterious unique salt
    $password_hash = md5($password1);
    $id_profile = 2;
    include_once ("../script/fonctions.php");
    connectdb();
    // Add user info into the database table for the main site table
    $sql = "INSERT INTO dmt_user (firstname, familyname, othername, sex, address, phone, email, profession, institution, nationality, username, password, register_date, last_visit_date, id_profile)       
		        VALUES ('" . mysql_real_escape_string($firstname) . "','" . mysql_real_escape_string($familyname) . "','" . mysql_real_escape_string($othername) . "','" . mysql_real_escape_string($sex) . "','" . mysql_real_escape_string($address) . "','" . mysql_real_escape_string($phone) . "','" . mysql_real_escape_string($email) . "','" . mysql_real_escape_string($profession) . "','" . mysql_real_escape_string($institution) . "','" . mysql_real_escape_string($nationality) . "','" . mysql_real_escape_string($username) . "','" . mysql_real_escape_string($password_hash) . "',now(), now(), $id_profile)";
    if (!mysql_query($sql)) {
        die('Error: ' . mysql_error());
        echo $lang['error-while-saving'];
    } else {
        $userid = @mysql_insert_id();
        // Create directory(folder) to hold each user's files(pics, MP3s, etc.)
//    if (!file_exists("user/$username")) {
//        mkdir("user/$username", 0755);
//    }
        // Email the user their activation link
        $to = "$email";
        $from = "dmt@osfac.net";
        $subject = $lang['account-activation'];
        $message = $lang['email-account-activation1'] . $firstname . ' ' . $familyname . $lang['email-account-activation2'] . $userid . '&u=' . $username . '&e=' . $email . '&p=' . $password_hash . $lang['email-account-activation3'] . $username . $lang['email-account-activation4'];
        $headers = "From: OSFAC-DMT <$from>\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        mail($to, $subject, $message, $headers);
        echo "signup_success";
    }
    exit();
}

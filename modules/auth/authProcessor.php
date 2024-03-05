<?php
session_start();
include_once "../../core/constants.php";
include_once "../../core/helper.php";
include_once "./authClass.php";
include_once "./userClass.php";

if (empty($_POST)) {
    die('invalid access');
}


if (!isset($_POST['_action'])) {
    die('invalid access');
}


$action = $_POST['_action'];
pr($_POST);


if ($action == "process_login") {


    $err = "";

    if (empty($_POST['email'])) {

        $err .= "Email is required <br>";
    }

    if (empty($_POST['password'])) {

        $err .= "password is required <br>";
    }

    if (!emailValidate($_POST['email']) && !empty($_POST['email'])) {
        $err .= "enter a valid email <br>";
    }


    if ($err) {

        header("location:login.php?err=$err");
        die();
    }

    $authObject = new authClass();
    $authObject->verifyLogin($_POST);
    $user = $authObject->getCurrentUser();


    if (!$user) {
        header('location:login.php?err= invalid password and email are incorrect <br>');
        exit();
    }

    if ($user['status'] == 2) {
        header('location:login.php?err=hey ' . $user['first_name'] . ',your account is under reveiw <br>');
        exit;
    }
    if ($user['status'] == 0) {
        header('location:login.php?err=hey ' . $user['first_name'] . ',your account is diabled or blocked <br>');
        exit;
    }

    $authObject->createSessions();
    pr($_SESSION['user']);
    header('location:../dashboard');

    exit;


} elseif ($action === "process_register") {
    pr($_POST);



    $err = "";


    if (empty($_POST['full_name'])) {

        $err .= "Full name is required <br>";
    }
    if (empty($_POST['email'])) {

        $err .= "Email is required <br>";
    }

    if (empty($_POST['password'])) {

        $err .= "password is required <br>";
    }

    if (!emailValidate($_POST['email']) && !empty($_POST['email'])) {
        $err .= "enter a valid email <br>";
    }

    if (!nameValidate($_POST['full_name']) && !empty($_POST['full_name'])) {
        $err .= "enter a valid full name <br>";
    }


    if ($err) {
        header("location:register.php?err=$err");
        exit;
    }






    $userObject = new userClass();

    $user = $userObject->getUserByEmail($_POST['email']);
    if ($user) {
        header('location:register.php?err=' . $_POST['email'] . ' email is already registered');
        exit;
    }

    $row = $userObject->createUser($_POST);

    if ($userObject->getRowCount($row)) {

        include_once "../../core/Emailer.php";

        $objectEmailer = new Emailer();
        $objectEmailer->sendEmail('Hey Admin, new reuest for content writer signup', 'hey admin please check the content pannel there a new post for  the approval');
        $objectEmailer->sendEmail('Thanks for the signup', 'please keep chekcing your emails  and spam folder , we will look into your application as soon as possible');

        header('location:register.php?msg=' . $_POST['full_name'] . ' user registered successfully , but you will be able to login after approval');
    }



} else if ($action === 'send_reset_password_link') {
    $userObject = new userClass();



    if (empty($_POST['email'])) {

        $err .= "Email is required <br>";
    }

    if (!emailValidate($_POST['email']) && !empty($_POST['email'])) {
        $err .= "enter a valid email <br>";
    }
    if ($err) {
        header("location:forgot-password.php?err=$err");
        exit;
    }

    $email = $_POST['email'];
    pr($email);
    $user = $userObject->getUserByEmail($email);
    echo "send_reset_password_link";
    if (!$user) {
        header('location:forgot-password.php?err=hey' . $user['first_name'] . 'does not found in our database');
        exit;
    }


    $forgotKey = generateRandomString();

    $stmt = $userObject->insertQuery('update ' . DB_PREFIX . 'users set forgot_key=:forgotkey where email=:email', [':email' => $email, ':forgotkey' => $forgotKey]);

    if (!$userObject->getRowCount($stmt)) {

        header('location:forgot-password.php?err=hey, there is an server error');
        exit;
    }


    $resetPasswordLink = SITE_URL . "/modules/auth/forgot-reset-passowrd-link.php?forgotKey=$forgotKey&email=" . base64_encode($email);

    echo $resetPasswordLink;

    include_once "../../core/Emailer.php";

    $objectEmailer = new Emailer();

    $objectEmailer->sendEmail('Hey' . $user . 'here is your password reset link', 'use this link to reset password link <a href=' . $resetPasswordLink . '>Reset Password</a>');
    $base64email = base64_encode($email);
    header('location:/modules/auth/forgot-password-thankyou.php?email=' . $base64email . '&msg=hey we send an email to reset the password, pleas check your email');

} elseif ($action === 'update_user_password_with_forgotKey') {


    $email = base64_decode($_REQUEST['email']);
    $password = $_REQUEST['password'];

    $userObject = new userClass();
    $forgotKey = $_REQUEST['forgot_key'];
    $user = $userObject->getUserByEmail($email);

    if (empty($user)) {
        header("location:modules/auth/forgot-password.php?err=Sorry that link was expired please regenerate");
    }

    if ($forgotKey != $user['forgot_key']) {
        header("location:modules/auth/forgot-password.php?err=Sorry that link was expired please regenerate");
    }

    $stmt = $userObject->insertQuery('update ' . DB_PREFIX . 'users set password=:password where email=:email and forgot_key=:forgot_key', [':email' => $email, ':password' => $password, ':forgot_key' => $forgotKey]);
    var_dump($userObject->getRowCount($stmt));

    if (!$userObject->getRowCount($stmt)) {

        header('location:/modules/auth/login.php?err=hey, unable to reset password updated succesfully!');
        exit;
    }

    header('location:/modules/auth/login.php?msg= user password updated succesfully!');
    exit;

}


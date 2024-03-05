<?php
include '../common/header.php';
include_once "./userClass.php";

pr($_REQUEST);


$email = base64_decode($_REQUEST['email']);
echo $email;
$userObject = new userClass();
$forgotKey = $_REQUEST['forgotKey'];
$user = $userObject->getUserByEmail($email);

if (empty($user)) {
    die("this link is expired, use <a href='forgot-password.php'>reset password</a>");
}

if ($forgotKey != $user['forgot_key']) {
    die("this link is expired, use <a href='forgot-password.php'>reset password</a>");
}
pr($user);

?>

<h2>Enter a new passsword</h2>
<form action="authProcessor.php" method="post">

    <input type="password" name="password" placeholder="Enter a new passowrd">

    <input type="hidden" value="update_user_password_with_forgotKey" name="_action">
    <input type="hidden" value=<?php echo $forgotKey ?> name="forgot_key">
    <input type="hidden" value=<?php echo $_REQUEST['email'] ?> name="email">
    <button type="submit">Update PAssword </button>
</form>

<div class="error">

    <?php
    if (!empty($_GET) && isset($_GET['err'])) {
        echo $_GET['err'];
    }

    ?>


</div>

<div class="success">
    <?php
    if (!empty($_GET) && isset($_GET['msg'])) {
        echo $_GET['msg'];
    }
    ?>
</div>
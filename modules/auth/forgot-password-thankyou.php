<?php
include "../common/header.php";


if (isLogin()) {
    header('location:/modules/dashboard');
}

?>

<div class="success">
    <?php
    if (!empty($_GET) && isset($_GET['msg'])) {
        echo $_GET['msg'];
    }

    if (!empty($_GET) && isset($_GET['email'])) {
        $email = base64_decode($_GET['email']);
        echo $email;
    }
    ?>
</div>

<form action="authProcessor.php" method="post">

    <input type="hidden" name="email" value=<?php echo $email; ?>>
    <input type="hidden" value="send_reset_password_link" name="_action">
    <button type="submit">Reset Link</button>
</form>
<?php
include "../common/footer.php";
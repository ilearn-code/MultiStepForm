<?php
include "../common/header.php";


if (isLogin()) {
    header('location:/modules/dashboard');
}

?>
<form action="authProcessor.php" method="post">

    <input type="text" name="email" placeholder="Enter a the Email">
    <input type="password" name="password" placeholder="Enter The Passowrd">
    <input type="hidden" value="process_login" name="_action">
    <button type="submit">Log in</button>
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
<a href="register.php">Register</a>
<a href="forgot-password.php">Forgot Passsowrd?</a>
<?php
include "../common/footer.php";
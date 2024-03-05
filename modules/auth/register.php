<?php
include "../common/header.php";


if (isLogin()) {
    header('location:../dashboard');
}

?>
<h2>Create an Account
</h2>
<form action="authProcessor.php" method="post">
    <input type="text" name="full_name" placeholder="Enter Full Name">
    <input type="email" name="email" placeholder="Enter a the Email">
    <input type="password" name="password" placeholder="Enter The Passowrd">
    <input type="hidden" value="process_register" name="_action">
    <button type="submit">Register</button>
</form>

<div class="error">

    <?php
    if (!empty($_GET) && isset($_GET['err'])) {
        echo $_GET['err'];
    }
    ?>


</div>

<div class="success">
    <?php if (!empty($_GET) && isset($_GET['msg'])) {
        echo $_GET['msg'];
    } ?>
</div>
<a href="login.php">Login </a>
<?php
include "../common/footer.php";
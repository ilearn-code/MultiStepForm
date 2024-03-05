<form action="authProcessor.php" method="post">

    <input type="email" name="email" placeholder="Enter a the Email">
    <input type="hidden" value="send_reset_password_link" name="_action">
    <button type="submit">Send Reset Link</button>
</form>
<a href="login.php">back</a>

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
<?php
session_start();
include_once "../../core/constants.php";
include_once "../../core/helper.php";
if(isLogin())
{
?>
<a href="modules/dashboard">
Dashboard
</a>

<a href="modules/posts">
Posts
</a>
<a href="modules/users">
Users
</a>
<a href="/modules/auth/logout.php">
Logout
</a>
<?php
}
?>
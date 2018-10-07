<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 07.10.18
 * Time: 0:57
 */
?>

<form class="js-loginForm" >

    <div>
        <label>Username or Email</label>
        <input type="text" name="login">
    </div>

    <div>
        <label>Password</label>
        <input name="password">
    </div>
</form>
</div>

<button class="js-submit">
    <span class="label">Log in</span>
</button>
<?= $text ?>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="js/home.js"></script>
<?php if (empty($_POST)) { ?>
    <script>Controller_Home.init()</script>
<?php } ?>

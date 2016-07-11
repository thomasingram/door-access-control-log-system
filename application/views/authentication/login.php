<h2>Login</h2>

<?php echo validation_errors('<p class="form-error">', '</p>'); ?>

<?php
if (isset($loginError)) {
    echo '<p class="form-error">' . $loginError . '</p>';
}
?>

<div class="row">
    <div class="five columns">
        <form action="<?php echo site_url('login'); ?>" method="post">
            <label for="email">Email</label>
            <input class="u-full-width" id="email" name="email" type="email">

            <label for="password">Password</label>
            <input class="u-full-width" id="password" name="password" type="password">

            <input class="button-primary" name="login" type="submit" value="Log in">
        </form>
    </div>
</div>

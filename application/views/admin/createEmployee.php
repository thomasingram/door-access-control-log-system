<h2>Create employee</h2>

<?php echo validation_errors('<p class="form-error">', '</p>'); ?>

<?php
if (isset($successMessage)) {
    echo '<p class="form-success">' . $successMessage . '</p>';
}
?>

<div class="row">
    <div class="five columns">
        <form action="<?php echo site_url('admin/employee/create'); ?>" method="post">
            <label for="firstName">First name</label>
            <input class="u-full-width" id="firstName" name="firstName" type="text">

            <label for="lastName">Last name</label>
            <input class="u-full-width" id="lastName" name="lastName" type="text">

            <input class="button-primary" name="createEmployee" type="submit" value="Create employee">
        </form>
    </div>
</div>

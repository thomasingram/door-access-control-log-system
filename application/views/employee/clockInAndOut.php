<h2 id="time"></h2>

<?php echo validation_errors('<p class="form-error">', '</p>'); ?>

<?php
if (isset($clockError)) {
    echo '<p class="form-error">' . $clockError . '</p>';
}
?>

<?php
if (isset($clockMessage)) {
    echo '<p class="form-success">' . $clockMessage . '</p>';
}
?>

<div class="row">
    <div class="five columns">
        <form action="<?php echo site_url('employee/clock_in_out'); ?>" method="post">
            <label for="doorEntryCode">Door entry code</label>
            <input class="u-full-width" id="doorEntryCode" name="doorEntryCode" type="text">

            <input class="button-primary" name="clockIn" type="submit" value="Clock in">
            <input class="button-primary" name="clockOut" type="submit" value="Clock out">
        </form>
    </div>
</div>

<script>
    function updateClock() {
        var now = new Date();

        var hours = now.getHours();
        var minutes = now.getMinutes();

        if (hours < 10) {
            hours = '0' + hours;
        }
        if (minutes < 10) {
            minutes = '0' + minutes;
        }

        var elem = document.getElementById('time');

        elem.innerHTML = hours + ':' + minutes;

        window.setTimeout(updateClock, 1000);
    }

    window.onload = updateClock;
</script>

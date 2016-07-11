<h2>Clock times</h2>

<table class="u-full-width">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Type</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee->first_name; ?></td>
            <td><?php echo $employee->last_name; ?></td>
            <td><?php echo $employee->activity_type; ?></td>
            <td><?php echo date('d/m/Y H:i', $employee->activity_date); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

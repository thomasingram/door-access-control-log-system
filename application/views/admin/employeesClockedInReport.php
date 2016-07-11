<h2>Employees clocked in</h2>

<table class="u-full-width">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Clock in time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee->first_name; ?></td>
            <td><?php echo $employee->last_name; ?></td>
            <td><?php echo date('d/m/Y H:i', $employee->clockInTime); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

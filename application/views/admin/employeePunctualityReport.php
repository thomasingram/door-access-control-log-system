<h2>Employee punctuality</h2>

<h5><?php echo date('j F Y', $startDate); ?> to <?php echo date('j F Y', $endDate); ?></h5>

<table class="u-full-width">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Arrived late</th>
            <th>Left early</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee->first_name; ?></td>
            <td><?php echo $employee->last_name; ?></td>
            <td><?php echo $employee->lateForWork; ?></td>
            <td><?php echo $employee->leftWorkEarly; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

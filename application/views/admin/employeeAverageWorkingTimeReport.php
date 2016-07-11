<h2>Employee average working time</h2>

<h5><?php echo date('j F Y', $startDate); ?> to <?php echo date('j F Y', $endDate); ?></h5>

<table class="u-full-width">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Total hours</th>
            <th>Average hours per day</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee->first_name; ?></td>
            <td><?php echo $employee->last_name; ?></td>
            <td><?php echo floor($employee->totalHours) . ':' . floor(($employee->totalHours - floor($employee->totalHours)) * 60); ?></td>
            <td><?php echo floor($employee->averageHoursPerDay) . ':' . floor(($employee->averageHoursPerDay - floor($employee->averageHoursPerDay)) * 60); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

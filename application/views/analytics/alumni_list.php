<!DOCTYPE html>
<html>
<head>
    <title>View Alumni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f6fa;
        }

        h1 {
            color: #222;
        }

        .nav {
            margin-bottom: 20px;
        }

        .nav a {
            margin-right: 15px;
        }

        .filter-box {
            background: #fff;
            padding: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-right: 6px;
        }

        select, button, a.button {
            padding: 7px;
            margin-right: 10px;
        }

        a.button {
            background: #eee;
            border: 1px solid #bbb;
            text-decoration: none;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 9px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #eee;
        }

        .count {
            margin-bottom: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>View Alumni</h1>

<div class="nav">
    <a href="<?php echo site_url('analytics/dashboard'); ?>">Dashboard</a>
    <a href="<?php echo site_url('analytics/alumni'); ?>">View Alumni</a>
    <a href="<?php echo site_url('analytics/graphs'); ?>">Graphs</a>
    <a href="<?php echo site_url('auth/dashboard'); ?>">Main Dashboard</a>
    <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
</div>

<div class="filter-box">
    <form method="get" action="<?php echo site_url('analytics/alumni'); ?>">

        <label>Programme:</label>
        <select name="programme">
            <option value="">All Programmes</option>
            <?php foreach ($filter_options['programmes'] as $programme): ?>
                <option value="<?php echo html_escape($programme->degree_name); ?>"
                    <?php echo ($filters['programme'] === $programme->degree_name) ? 'selected' : ''; ?>>
                    <?php echo html_escape($programme->degree_name); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Graduation Year:</label>
        <select name="graduation_year">
            <option value="">All Years</option>
            <?php foreach ($filter_options['graduation_years'] as $year): ?>
                <option value="<?php echo html_escape($year->graduation_year); ?>"
                    <?php echo ($filters['graduation_year'] == $year->graduation_year) ? 'selected' : ''; ?>>
                    <?php echo html_escape($year->graduation_year); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Industry Sector:</label>
        <select name="industry_sector">
            <option value="">All Sectors</option>
            <?php foreach ($filter_options['industry_sectors'] as $sector): ?>
                <option value="<?php echo html_escape($sector->industry_sector); ?>"
                    <?php echo ($filters['industry_sector'] === $sector->industry_sector) ? 'selected' : ''; ?>>
                    <?php echo html_escape($sector->industry_sector); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Apply Filters</button>
        <a class="button" href="<?php echo site_url('analytics/alumni'); ?>">Reset</a>
    </form>
</div>

<div class="count">
    Showing <?php echo count($alumni); ?> alumni record(s)
</div>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Programme(s)</th>
            <th>Graduation Year</th>
            <th>Current Job</th>
            <th>Company</th>
            <th>Industry Sector</th>
            <th>Location</th>
            <th>LinkedIn</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($alumni)): ?>
            <?php foreach ($alumni as $person): ?>
                <tr>
                    <td><?php echo html_escape($person->first_name . ' ' . $person->last_name); ?></td>
                    <td><?php echo html_escape($person->university_email); ?></td>
                    <td><?php echo html_escape($person->programmes ?: 'Not added'); ?></td>
                    <td><?php echo html_escape($person->graduation_year); ?></td>
                    <td><?php echo html_escape($person->current_job_title); ?></td>
                    <td><?php echo html_escape($person->current_company); ?></td>
                    <td><?php echo html_escape($person->industry_sector); ?></td>
                    <td>
                        <?php echo html_escape(trim($person->location_city . ', ' . $person->location_country, ', ')); ?>
                    </td>
                    <td>
                        <?php if (!empty($person->linkedin_url)): ?>
                            <a href="<?php echo html_escape($person->linkedin_url); ?>" target="_blank">View</a>
                        <?php else: ?>
                            Not added
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">No alumni found for the selected filters.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

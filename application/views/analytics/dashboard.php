<!DOCTYPE html>
<html>
<head>
    <title>University Analytics Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>

<div class="container">
    <div class="page-header">
        <h1>University Analytics Dashboard</h1>
        <p>Overview of alumni profiles, career outcomes, certifications, and professional development trends.</p>
    </div>

    <div class="navbar">
        <a href="<?php echo site_url('analytics/dashboard'); ?>">Dashboard</a>
        <a href="<?php echo site_url('analytics/alumni'); ?>">View Alumni</a>
        <a href="<?php echo site_url('analytics/graphs'); ?>">Graphs</a>
        <a href="<?php echo site_url('analytics/export-summary-csv'); ?>">Export Summary CSV</a>
        <a href="<?php echo site_url('auth/dashboard'); ?>">Main Dashboard</a>
        <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Total Alumni</h3>
            <p><?php echo (int)$total_alumni; ?></p>
        </div>

        <div class="card">
            <h3>Completed Profiles</h3>
            <p><?php echo (int)$total_profiles; ?></p>
        </div>

        <div class="card">
            <h3>Certifications</h3>
            <p><?php echo (int)$total_certifications; ?></p>
        </div>

        <div class="card">
            <h3>Short Courses</h3>
            <p><?php echo (int)$total_courses; ?></p>
        </div>
    </div>

    <div class="section">
        <h2>Key Insights</h2>

        <p>
            <strong>Top Industry Sector:</strong>
            <?php echo $top_industry_sector ? html_escape($top_industry_sector->industry_sector) . ' (' . $top_industry_sector->total . ')' : 'No data available'; ?>
        </p>

        <p>
            <strong>Most Common Job Title:</strong>
            <?php echo $top_job_title ? html_escape($top_job_title->current_job_title) . ' (' . $top_job_title->total . ')' : 'No data available'; ?>
        </p>

        <p>
            <strong>Top Employer:</strong>
            <?php echo $top_employer ? html_escape($top_employer->current_company) . ' (' . $top_employer->total . ')' : 'No data available'; ?>
        </p>

        <p>
            <a class="btn" href="<?php echo site_url('analytics/export-summary-csv'); ?>">Download Summary Report CSV</a>
        </p>
    </div>

    <div class="section">
        <h2>Recently Updated Alumni Profiles</h2>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Graduation Year</th>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Industry Sector</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recent_profiles)): ?>
                    <?php foreach ($recent_profiles as $profile): ?>
                        <tr>
                            <td><?php echo html_escape($profile->first_name . ' ' . $profile->last_name); ?></td>
                            <td><?php echo html_escape($profile->university_email); ?></td>
                            <td><?php echo html_escape($profile->graduation_year); ?></td>
                            <td><?php echo html_escape($profile->current_job_title); ?></td>
                            <td><?php echo html_escape($profile->current_company); ?></td>
                            <td><?php echo html_escape($profile->industry_sector); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No alumni profiles available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

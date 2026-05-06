<!DOCTYPE html>
<html>

<head>
    <title>Main Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>

<body>

    <div class="container">

        <?php
        $user_name = $this->session->userdata('user_name');
        $role = $this->session->userdata('user_role');
        ?>

        <div class="page-header">
            <h1>Welcome, <?php echo html_escape($user_name); ?></h1>
            <p>Use the dashboard below to access the features available for your account role.</p>
            <span class="role-badge">
                Role: <?php echo ucfirst(html_escape($role)); ?>
            </span>
        </div>

        <div class="navbar">
            <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a>
            <a href="<?php echo site_url('logout'); ?>">Logout</a>
        </div>

        <div class="cards">

            <?php if ($role === 'alumnus'): ?>

                <div class="card">
                    <h3>My Profile</h3>
                    <p>Create, view, and update your alumni profile information.</p>
                    <a href="<?php echo site_url('profile'); ?>">Open Profile</a>
                </div>

                <div class="card">
                    <h3>Edit Main Profile</h3>
                    <p>Update biography, LinkedIn URL, image, job details, and personal information.</p>
                    <a href="<?php echo site_url('profile/edit-main'); ?>">Edit Profile</a>
                </div>

                <div class="card">
                    <h3>Degrees</h3>
                    <p>Add, edit, or delete your university degree records.</p>
                    <a href="<?php echo site_url('profile/degrees'); ?>">Manage Degrees</a>
                </div>

                <div class="card">
                    <h3>Certifications</h3>
                    <p>Manage professional certifications used in your alumni profile.</p>
                    <a href="<?php echo site_url('profile/certifications'); ?>">Manage Certifications</a>
                </div>

                <div class="card">
                    <h3>Licences</h3>
                    <p>Manage professional licence records and awarding body links.</p>
                    <a href="<?php echo site_url('profile/licences'); ?>">Manage Licences</a>
                </div>

                <div class="card">
                    <h3>Short Courses</h3>
                    <p>Manage short professional courses and post-graduation learning.</p>
                    <a href="<?php echo site_url('profile/short-courses'); ?>">Manage Courses</a>
                </div>

                <div class="card">
                    <h3>Employment History</h3>
                    <p>Add, edit, or delete employment history records.</p>
                    <a href="<?php echo site_url('profile/employment'); ?>">Manage Employment</a>
                </div>

                <div class="card">
                    <h3>Bidding</h3>
                    <p>Place or increase a bid for the Alumni Influencer of the Day slot.</p>
                    <a href="<?php echo site_url('bidding'); ?>">Open Bidding</a>
                </div>

                <div class="card">
                    <h3>Bid Notifications</h3>
                    <p>View winner, loser, and bidding status notifications.</p>
                    <a href="<?php echo site_url('bidding/notifications'); ?>">View Notifications</a>
                </div>

            <?php elseif ($role === 'developer'): ?>

                <div class="card">
                    <h3>API Token Management</h3>
                    <p>Generate, view, and revoke API keys for external client applications.</p>
                    <a href="<?php echo site_url('apitokens'); ?>">Manage API Tokens</a>
                </div>

                <div class="card">
                    <h3>API Usage Logs</h3>
                    <p>View token usage statistics, accessed endpoints, timestamps, and response codes.</p>
                    <a href="<?php echo site_url('apitokens/usage'); ?>">View Usage Logs</a>
                </div>

                <div class="card">
                    <h3>Swagger Documentation</h3>
                    <p>Open the interactive OpenAPI documentation for testing protected API endpoints.</p>
                    <a href="<?php echo site_url('api-docs'); ?>">Open API Docs</a>
                </div>

                <div class="card">
                    <h3>Analytics Dashboard</h3>
                    <p>Access the university analytics dashboard for technical testing and API validation.</p>
                    <a href="<?php echo site_url('analytics'); ?>">Open Analytics</a>
                </div>

            <?php elseif ($role === 'client'): ?>

                <div class="card">
                    <h3>University Analytics Dashboard</h3>
                    <p>View summary metrics generated from alumni profile and employment data.</p>
                    <a href="<?php echo site_url('analytics'); ?>">Open Dashboard</a>
                </div>

                <div class="card">
                    <h3>View Alumni</h3>
                    <p>Filter alumni by programme, graduation year, and industry sector.</p>
                    <a href="<?php echo site_url('analytics/alumni'); ?>">View Alumni</a>
                </div>

                <div class="card">
                    <h3>Graphs and Trends</h3>
                    <p>View charts for skills gaps, employment sectors, employers, job titles, and courses.</p>
                    <a href="<?php echo site_url('analytics/graphs'); ?>">View Graphs</a>
                </div>

                <div class="card">
                    <h3>Export Alumni Data</h3>
                    <p>Download filtered alumni records as a CSV file from the View Alumni page.</p>
                    <a href="<?php echo site_url('analytics/alumni'); ?>">Go to Export</a>
                </div>

            <?php else: ?>

                <div class="card">
                    <h3>Unknown Role</h3>
                    <p>Your account role is not recognised. Please contact the system administrator.</p>
                </div>

            <?php endif; ?>

        </div>

    </div>

</body>

</html>

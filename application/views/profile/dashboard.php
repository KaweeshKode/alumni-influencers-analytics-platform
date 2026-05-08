<!DOCTYPE html>
<html>
<head>
    <title>Profile Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>

<div class="container">

    <div class="navbar">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a>
        <a href="<?php echo site_url('profile'); ?>">My Profile</a>
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a>
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </div>

    <div class="page-header">
        <h1>My Alumni Profile</h1>
        <p>Welcome, <?php echo html_escape($this->session->userdata('user_name')); ?>. Manage your profile details and professional records from this page.</p>
    </div>

    <div class="section">
        <h2>Main Profile Details</h2>

        <p>
            <a class="btn" href="<?php echo site_url('profile/edit_main'); ?>">Edit Main Profile</a>
        </p>

        <?php if (!empty($profile)) : ?>
            <?php if (!empty($profile->profile_image)) : ?>
                <p>
                    <img src="<?php echo base_url('uploads/profile_images/' . $profile->profile_image); ?>" width="150" alt="Profile Image" style="border-radius: 8px; border: 1px solid #ddd;">
                </p>
            <?php endif; ?>

            <table>
                <tbody>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo html_escape($profile->phone_number); ?></td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td><?php echo html_escape($profile->date_of_birth); ?></td>
                    </tr>
                    <tr>
                        <th>Graduation Year</th>
                        <td><?php echo html_escape($profile->graduation_year); ?></td>
                    </tr>
                    <tr>
                        <th>Current Job Title</th>
                        <td><?php echo html_escape($profile->current_job_title); ?></td>
                    </tr>
                    <tr>
                        <th>Current Company</th>
                        <td><?php echo html_escape($profile->current_company); ?></td>
                    </tr>
                    <tr>
                        <th>Industry Sector</th>
                        <td><?php echo html_escape($profile->industry_sector); ?></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td><?php echo html_escape($profile->location_city); ?></td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td><?php echo html_escape($profile->location_country); ?></td>
                    </tr>
                    <tr>
                        <th>Biography</th>
                        <td><?php echo nl2br(html_escape($profile->biography)); ?></td>
                    </tr>
                    <tr>
                        <th>LinkedIn</th>
                        <td>
                            <?php if (!empty($profile->linkedin_url)) : ?>
                                <a href="<?php echo html_escape($profile->linkedin_url); ?>" target="_blank">
                                    <?php echo html_escape($profile->linkedin_url); ?>
                                </a>
                            <?php else : ?>
                                Not added
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <p>No profile details added yet.</p>
        <?php endif; ?>
    </div>

    <div class="section">
        <h2>Profile Sections</h2>

        <div class="cards">
            <div class="card">
                <h3>Degrees</h3>
                <p>Manage your university degree records and official degree links.</p>
                <a href="<?php echo site_url('profile/degrees'); ?>">Manage Degrees</a>
            </div>

            <div class="card">
                <h3>Certifications</h3>
                <p>Manage your professional certifications and provider details.</p>
                <a href="<?php echo site_url('profile/certifications'); ?>">Manage Certifications</a>
            </div>

            <div class="card">
                <h3>Licences</h3>
                <p>Manage your professional licences and awarding bodies.</p>
                <a href="<?php echo site_url('profile/licences'); ?>">Manage Licences</a>
            </div>

            <div class="card">
                <h3>Short Courses</h3>
                <p>Manage completed short professional courses and learning records.</p>
                <a href="<?php echo site_url('profile/short_courses'); ?>">Manage Courses</a>
            </div>

            <div class="card">
                <h3>Employment History</h3>
                <p>Manage current and previous employment history records.</p>
                <a href="<?php echo site_url('profile/employment'); ?>">Manage Employment</a>
            </div>

            <div class="card">
                <h3>Blind Bidding</h3>
                <p>Open the bidding dashboard to compete for the Alumni Influencer of the Day slot.</p>
                <a href="<?php echo site_url('bidding'); ?>">Open Bidding</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>

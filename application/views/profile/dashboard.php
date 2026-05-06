<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: Arial; margin: 20px; }
    h2 { color: #2c3e50; }
    a { color: #007bff; }
    ul { line-height: 1.8; }

    .profile-nav {
        background: #f8f9fa;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 18px;
    }
    .profile-nav a {
        margin-right: 8px;
        text-decoration: none;
    }
</style>
<title>Profile Dashboard</title>
</head>
<body>
    <p class="profile-nav">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('profile'); ?>">My Profile</a> |
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>

    <h2>My Alumni Profile</h2>

    <p>Welcome, <?php echo html_escape($this->session->userdata('user_name')); ?>!</p>

    <p>
        <a href="<?php echo site_url('profile/edit_main'); ?>">Edit Main Profile</a>
    </p>

    <?php if (!empty($profile)) : ?>
        <?php if (!empty($profile->profile_image)) : ?>
            <p>
                <img src="<?php echo base_url('uploads/profile_images/' . $profile->profile_image); ?>" width="150" alt="Profile Image">
            </p>
        <?php endif; ?>

        <p><strong>Phone:</strong> <?php echo html_escape($profile->phone_number); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo html_escape($profile->date_of_birth); ?></p>
        <p><strong>Graduation Year:</strong> <?php echo html_escape($profile->graduation_year); ?></p>
        <p><strong>Current Job Title:</strong> <?php echo html_escape($profile->current_job_title); ?></p>
        <p><strong>Current Company:</strong> <?php echo html_escape($profile->current_company); ?></p>
        <p><strong>Industry Sector:</strong> <?php echo html_escape($profile->industry_sector); ?></p>
        <p><strong>City:</strong> <?php echo html_escape($profile->location_city); ?></p>
        <p><strong>Country:</strong> <?php echo html_escape($profile->location_country); ?></p>
        <p><strong>Biography:</strong> <?php echo nl2br(html_escape($profile->biography)); ?></p>

        <?php if (!empty($profile->linkedin_url)) : ?>
            <p>
                <strong>LinkedIn:</strong>
                <a href="<?php echo html_escape($profile->linkedin_url); ?>" target="_blank">
                    <?php echo html_escape($profile->linkedin_url); ?>
                </a>
            </p>
        <?php endif; ?>
    <?php else : ?>
        <p>No profile details added yet.</p>
    <?php endif; ?>

    <hr>

    <h3>Profile Sections</h3>
    <ul>
        <li><a href="<?php echo site_url('profile/degrees'); ?>">Manage Degrees</a></li>
        <li><a href="<?php echo site_url('profile/certifications'); ?>">Manage Certifications</a></li>
        <li><a href="<?php echo site_url('profile/licences'); ?>">Manage Licences</a></li>
        <li><a href="<?php echo site_url('profile/short_courses'); ?>">Manage Short Courses</a></li>
        <li><a href="<?php echo site_url('profile/employment'); ?>">Manage Employment History</a></li>
        <!-- bidding url -->
        <li><a href="<?php echo site_url('bidding'); ?>">Blind Bidding Dashboard</a></li>
    </ul>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<title>Certifications</title>
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


        <h1>My Certifications</h1>


    </div>

    <p>
        <a href="<?php echo site_url('profile/add_certification'); ?>">Add Certification</a> |
        <a href="<?php echo site_url('profile'); ?>">Back</a>
    </p>

    <?php if (!empty($certifications)) : ?>
        <ul>
            <?php foreach ($certifications as $c) : ?>
                <li>
                    <strong><?php echo html_escape($c->certification_name); ?></strong><br>
                    Provider: <?php echo html_escape($c->provider_name); ?><br>
                    <a href="<?php echo html_escape($c->course_url); ?>" target="_blank">Course URL</a><br>
                    Completed: <?php echo html_escape($c->completion_date); ?><br>
                    <a href="<?php echo site_url('profile/edit_certification/' . $c->id); ?>">Edit</a> |
                    <a href="<?php echo site_url('profile/delete_certification/' . $c->id); ?>"
                        onclick="return confirm('Are you sure you want to delete this?');">
                        Delete
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No certifications added yet.</p>
    <?php endif; ?>
</div>
</body>
</html>

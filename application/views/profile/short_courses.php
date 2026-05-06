<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<title>Short Courses</title>
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


        <h1>My Short Courses</h1>


    </div>

    <p>
        <a href="<?php echo site_url('profile/add_short_course'); ?>">Add Short Course</a> |
        <a href="<?php echo site_url('profile'); ?>">Back</a>
    </p>

    <?php if (!empty($short_courses)) : ?>
        <ul>
            <?php foreach ($short_courses as $s) : ?>
                <li>
                    <strong><?php echo html_escape($s->course_name); ?></strong><br>
                    Provider: <?php echo html_escape($s->provider_name); ?><br>
                    <a href="<?php echo html_escape($s->course_url); ?>" target="_blank">Course URL</a><br>
                    Completed: <?php echo html_escape($s->completion_date); ?><br>
                    <a href="<?php echo site_url('profile/edit_short_course/' . $s->id); ?>">Edit</a> |
                    <a href="<?php echo site_url('profile/delete_short_course/' . $s->id); ?>"
                       onclick="return confirm('Are you sure you want to delete this?');">
                       Delete
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No short courses added yet.</p>
    <?php endif; ?>
</div>
</body>
</html>

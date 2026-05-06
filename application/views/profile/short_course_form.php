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
<title><?php echo isset($short_course) ? 'Edit Short Course' : 'Add Short Course'; ?></title>
</head>
<body>
    <p class="profile-nav">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('profile'); ?>">My Profile</a> |
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>

    <h2><?php echo isset($short_course) ? 'Edit Short Course' : 'Add Short Course'; ?></h2>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php
    $action = isset($short_course)
        ? 'profile/edit_short_course/' . $short_course->id
        : 'profile/add_short_course';

    echo form_open($action);
    ?>

    <p>Course Name:
        <input type="text" name="course_name" value="<?php echo set_value('course_name', $short_course->course_name ?? ''); ?>">
    </p>

    <p>Provider Name:
        <input type="text" name="provider_name" value="<?php echo set_value('provider_name', $short_course->provider_name ?? ''); ?>">
    </p>

    <p>Course URL:
        <input type="url" name="course_url" value="<?php echo set_value('course_url', $short_course->course_url ?? ''); ?>">
    </p>

    <p>Completion Date:
        <input type="date" name="completion_date" value="<?php echo set_value('completion_date', $short_course->completion_date ?? ''); ?>">
    </p>

    <p><button type="submit">Save</button></p>

    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('profile/short_courses'); ?>">Back to Short Courses</a></p>
</body>
</html>

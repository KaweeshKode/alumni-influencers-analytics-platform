<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<title><?php echo isset($certification) ? 'Edit Certification' : 'Add Certification'; ?></title>
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


        <h1><?php echo isset($certification) ? 'Edit Certification' : 'Add Certification'; ?></h1>


    </div>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php
    $action = isset($certification)
        ? 'profile/edit_certification/' . $certification->id
        : 'profile/add_certification';

    echo form_open($action);
    ?>

    <p>Certification Name:
        <input type="text" name="certification_name" value="<?php echo set_value('certification_name', $certification->certification_name ?? ''); ?>">
    </p>

    <p>Provider Name:
        <input type="text" name="provider_name" value="<?php echo set_value('provider_name', $certification->provider_name ?? ''); ?>">
    </p>

    <p>Course URL:
        <input type="url" name="course_url" value="<?php echo set_value('course_url', $certification->course_url ?? ''); ?>">
    </p>

    <p>Completion Date:
        <input type="date" name="completion_date" value="<?php echo set_value('completion_date', $certification->completion_date ?? ''); ?>">
    </p>

    <p><button type="submit">Save</button></p>

    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('profile/certifications'); ?>">Back to Certifications</a></p>
</div>
</body>
</html>

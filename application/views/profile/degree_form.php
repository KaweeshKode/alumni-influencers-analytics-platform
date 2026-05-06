<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<title><?php echo isset($degree) ? 'Edit Degree' : 'Add Degree'; ?></title>
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


        <h1><?php echo isset($degree) ? 'Edit Degree' : 'Add Degree'; ?></h1>


    </div>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php
    $action = isset($degree)
        ? 'profile/edit_degree/' . $degree->id
        : 'profile/add_degree';

    echo form_open($action);
    ?>

    <p>Degree Name:
        <input type="text" name="degree_name" value="<?php echo set_value('degree_name', $degree->degree_name ?? ''); ?>">
    </p>

    <p>University Name:
        <input type="text" name="university_name" value="<?php echo set_value('university_name', $degree->university_name ?? ''); ?>">
    </p>

    <p>Official Degree URL:
        <input type="url" name="official_degree_url" value="<?php echo set_value('official_degree_url', $degree->official_degree_url ?? ''); ?>">
    </p>

    <p>Completion Date:
        <input type="date" name="completion_date" value="<?php echo set_value('completion_date', $degree->completion_date ?? ''); ?>">
    </p>

    <p><button type="submit">Save</button></p>

    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('profile/degrees'); ?>">Back to Degrees</a></p>
</div>
</body>
</html>

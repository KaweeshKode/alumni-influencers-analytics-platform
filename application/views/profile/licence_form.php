<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<title><?php echo isset($licence) ? 'Edit Licence' : 'Add Licence'; ?></title>
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


        <h1><?php echo isset($licence) ? 'Edit Licence' : 'Add Licence'; ?></h1>


    </div>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php
    $action = isset($licence)
        ? 'profile/edit_licence/' . $licence->id
        : 'profile/add_licence';

    echo form_open($action);
    ?>

    <p>Licence Name:
        <input type="text" name="licence_name" value="<?php echo set_value('licence_name', $licence->licence_name ?? ''); ?>">
    </p>

    <p>Awarding Body:
        <input type="text" name="awarding_body" value="<?php echo set_value('awarding_body', $licence->awarding_body ?? ''); ?>">
    </p>

    <p>Awarding Body URL:
        <input type="url" name="awarding_body_url" value="<?php echo set_value('awarding_body_url', $licence->awarding_body_url ?? ''); ?>">
    </p>

    <p>Completion Date:
        <input type="date" name="completion_date" value="<?php echo set_value('completion_date', $licence->completion_date ?? ''); ?>">
    </p>

    <p><button type="submit">Save</button></p>

    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('profile/licences'); ?>">Back to Licences</a></p>
</div>
</body>
</html>

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
<title><?php echo isset($employment) ? 'Edit Employment' : 'Add Employment'; ?></title>
</head>
<body>
    <p class="profile-nav">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('profile'); ?>">My Profile</a> |
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>

    <h2><?php echo isset($employment) ? 'Edit Employment' : 'Add Employment'; ?></h2>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php
    $action = isset($employment)
        ? 'profile/edit_employment/' . $employment->id
        : 'profile/add_employment';

    echo form_open($action);
    ?>

    <p>Job Title:
        <input type="text" name="job_title" value="<?php echo set_value('job_title', $employment->job_title ?? ''); ?>">
    </p>

    <p>Company Name:
        <input type="text" name="company_name" value="<?php echo set_value('company_name', $employment->company_name ?? ''); ?>">
    </p>

    <p>Start Date:
        <input type="date" name="start_date" value="<?php echo set_value('start_date', $employment->start_date ?? ''); ?>">
    </p>

    <p>End Date:
        <input type="date" name="end_date" value="<?php echo set_value('end_date', $employment->end_date ?? ''); ?>">
    </p>

    <p>
        <label>
            <input type="checkbox" name="is_current_job" value="1" <?php echo set_checkbox('is_current_job', '1', isset($employment) && (int)$employment->is_current_job === 1); ?>>
            This is my current job
        </label>
    </p>

    <p>Description:</p>
    <p>
        <textarea name="description" rows="5" cols="50"><?php echo set_value('description', $employment->description ?? ''); ?></textarea>
    </p>

    <p><button type="submit">Save</button></p>

    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('profile/employment'); ?>">Back to Employment History</a></p>
</body>
</html>

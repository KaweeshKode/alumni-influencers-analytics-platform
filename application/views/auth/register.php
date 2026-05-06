<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>Alumni Registration</h1>
        <p>Create an alumni account using a valid @iit.ac.lk university email address.</p>
    </div>

    <div class="section">
        <?php if (!empty($error)) : ?>
            <div class="alert alert-error"><?php echo html_escape($error); ?></div>
        <?php endif; ?>

        <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

        <?php echo form_open('auth/register'); ?>
            <p>
                <label>First Name:</label><br>
                <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>">
            </p>
            <p>
                <label>Last Name:</label><br>
                <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>">
            </p>
            <p>
                <label>University Email:</label><br>
                <input type="email" name="university_email" value="<?php echo set_value('university_email'); ?>">
            </p>
            <p>
                <label>Password:</label><br>
                <input type="password" name="password">
            </p>
            <p>
                <label>Confirm Password:</label><br>
                <input type="password" name="confirm_password">
            </p>
            <p><button type="submit">Register</button></p>
        <?php echo form_close(); ?>

        <p><a href="<?php echo site_url('auth/login'); ?>">Already have an account? Login</a></p>
    </div>

</div>
</body>
</html>

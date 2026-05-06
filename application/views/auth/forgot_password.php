<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>Forgot Password</h1>
        <p>Enter your university email address to receive a password reset link.</p>
    </div>

    <div class="section">
        <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

        <?php echo form_open('auth/forgot_password'); ?>
            <p>
                <label>University Email:</label><br>
                <input type="email" name="university_email" value="<?php echo set_value('university_email'); ?>">
            </p>
            <p><button type="submit">Send Reset Link</button></p>
        <?php echo form_close(); ?>

        <p><a href="<?php echo site_url('auth/login'); ?>">Back to Login</a></p>
    </div>

</div>
</body>
</html>

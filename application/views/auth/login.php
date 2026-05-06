<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>Login</h1>
        <p>Access the Alumni Influencers Platform using your university account.</p>
    </div>

    <div class="section">
        <?php if (!empty($error)) : ?>
            <div class="alert alert-error"><?php echo html_escape($error); ?></div>
        <?php endif; ?>

        <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

        <?php echo form_open('auth/login'); ?>
            <p>
                <label>University Email:</label><br>
                <input type="email" name="university_email" value="<?php echo set_value('university_email'); ?>">
            </p>
            <p>
                <label>Password:</label><br>
                <input type="password" name="password">
            </p>
            <p><button type="submit">Login</button></p>
        <?php echo form_close(); ?>

        <p><a href="<?php echo site_url('auth/forgot_password'); ?>">Forgot Password?</a></p>
        <p><a href="<?php echo site_url('auth/register'); ?>">Create Account</a></p>
    </div>

</div>
</body>
</html>

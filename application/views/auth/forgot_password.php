<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php echo form_open('auth/forgot_password'); ?>
        <p>University Email: <input type="email" name="university_email" value="<?php echo set_value('university_email'); ?>"></p>
        <p><button type="submit">Send Reset Link</button></p>
    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('auth/login'); ?>">Back to Login</a></p>
</body>
</html>

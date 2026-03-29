<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (!empty($error)) : ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php echo form_open('auth/login'); ?>
        <p>University Email: <input type="email" name="university_email" value="<?php echo set_value('university_email'); ?>"></p>
        <p>Password: <input type="password" name="password"></p>
        <p><button type="submit">Login</button></p>
    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('auth/forgot_password'); ?>">Forgot Password?</a></p>
    <p><a href="<?php echo site_url('auth/register'); ?>">Create Account</a></p>
</body>
</html>

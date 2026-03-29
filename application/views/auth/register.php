<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Alumni Registration</h2>

    <?php if (!empty($error)) : ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php echo form_open('auth/register'); ?>
        <p>First Name: <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>"></p>
        <p>Last Name: <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>"></p>
        <p>University Email: <input type="email" name="university_email" value="<?php echo set_value('university_email'); ?>"></p>
        <p>Password: <input type="password" name="password"></p>
        <p>Confirm Password: <input type="password" name="confirm_password"></p>
        <p><button type="submit">Register</button></p>
    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('auth/login'); ?>">Already have an account? Login</a></p>
</body>
</html>

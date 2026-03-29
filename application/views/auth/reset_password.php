<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php echo form_open(current_url() . '?token=' . urlencode($token)); ?>
        <p>New Password: <input type="password" name="password"></p>
        <p>Confirm Password: <input type="password" name="confirm_password"></p>
        <p><button type="submit">Reset Password</button></p>
    <?php echo form_close(); ?>
</body>
</html>

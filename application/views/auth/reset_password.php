<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>Reset Password</h1>
        <p>Enter and confirm your new account password.</p>
    </div>

    <div class="section">
        <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

        <?php echo form_open(current_url() . '?token=' . urlencode($token)); ?>
            <p>
                <label>New Password:</label><br>
                <input type="password" name="password">
            </p>
            <p>
                <label>Confirm Password:</label><br>
                <input type="password" name="confirm_password">
            </p>
            <p><button type="submit">Reset Password</button></p>
        <?php echo form_close(); ?>
    </div>

</div>
</body>
</html>

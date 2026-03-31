<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo html_escape($this->session->userdata('user_name')); ?>!</p>

    <ul>
        <li><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
        <li><a href="<?php echo site_url('auth/forgot_password'); ?>">Reset Password</a></li>
    </ul>
</body>
</html>

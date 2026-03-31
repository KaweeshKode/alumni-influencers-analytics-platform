<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
</head>
<body>
    <h2>Message</h2>
    <p><?php echo $message; ?></p>

    <?php if ($this->session->userdata('logged_in')) : ?>
        <p><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></p>
    <?php else : ?>
        <p><a href="<?php echo site_url('auth/login'); ?>">Login</a></p>
    <?php endif; ?>
</body>
</html>
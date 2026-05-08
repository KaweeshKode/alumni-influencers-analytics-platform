<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>Message</h1>
    </div>

    <div class="section">
        <p><?php echo $message; ?></p>

        <?php if ($this->session->userdata('logged_in')) : ?>
            <p><a class="btn" href="<?php echo site_url('auth/logout'); ?>">Logout</a></p>
        <?php else : ?>
            <p><a class="btn" href="<?php echo site_url('auth/login'); ?>">Login</a></p>
        <?php endif; ?>
    </div>

</div>
</body>
</html>

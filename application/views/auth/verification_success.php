<!DOCTYPE html>
<html>
<head>
    <title>Verification Success</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>Success</h1>
    </div>

    <div class="section">
        <div class="alert alert-success"><?php echo html_escape($message); ?></div>
        <p><a class="btn" href="<?php echo site_url('auth/login'); ?>">Go to Login</a></p>
    </div>

</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
    <title>Bid Notifications</title>
</head>
<body>
<div class="container">
    <div class="navbar">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a>
        <a href="<?php echo site_url('profile'); ?>">My Profile</a>
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a>
        <a href="<?php echo site_url('bidding/notifications'); ?>">Notifications</a>
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </div>

    <div class="page-header">


        <h1>Bid Notifications</h1>


    </div>

    <?php if (!empty($notifications)) : ?>
        <ul>
            <?php foreach ($notifications as $n) : ?>
                <li>
                    <strong><?php echo ucfirst(html_escape($n->notification_type)); ?>:</strong>
                    <?php echo html_escape($n->message); ?>
                    (<?php echo html_escape($n->created_at); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No notifications yet.</p>
    <?php endif; ?>

    <p><a href="<?php echo site_url('bidding'); ?>">Back to Bidding Dashboard</a></p>
</div>
</body>
</html>
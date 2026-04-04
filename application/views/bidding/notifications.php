<!DOCTYPE html>
<html>
<head>
    <title>Bid Notifications</title>
</head>
<body>
    <h2>Bid Notifications</h2>

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
</body>
</html>
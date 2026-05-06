<!DOCTYPE html>
<html>
<head>
    <title>Bidding Dashboard</title>
</head>
<body>

    <p>
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('profile'); ?>">My Profile</a> |
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a> |
        <a href="<?php echo site_url('bidding/notifications'); ?>">Notifications</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>
    <h2>Blind Bidding Dashboard</h2>

    <?php if ($this->session->flashdata('success')) : ?>
        <p style="color:green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <p><strong>Bid Date:</strong> <?php echo html_escape($slot->slot_date); ?></p>
    <p><strong>Wins this month:</strong> <?php echo (int)$wins_this_month; ?> / 3</p>
    <p><strong>Remaining featured chances this month:</strong> <?php echo (int)$remaining_slots; ?></p>

    <?php if ($user_bid) : ?>
        <p><strong>Your Current Bid:</strong> <?php echo number_format($user_bid->bid_amount, 2); ?></p>
        <p><strong>Your Status:</strong> <?php echo ucfirst(html_escape($user_bid->bid_status)); ?></p>
    <?php else : ?>
        <p>You have not placed a bid yet.</p>
    <?php endif; ?>

    <?php if ((int)$remaining_slots <= 0) : ?>
        <p style="color:red;"><strong>You have reached the monthly featured limit for this month.</strong></p>
    <?php else : ?>
        <?php if ($user_bid) : ?>
            <p><a href="<?php echo site_url('bidding/place_bid'); ?>">Increase My Bid</a></p>
        <?php else : ?>
            <p><a href="<?php echo site_url('bidding/place_bid'); ?>">Place a Bid</a></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
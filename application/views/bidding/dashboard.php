<!DOCTYPE html>
<html>
<head>
    <title>Bidding Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
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
        <h1>Blind Bidding Dashboard</h1>
        <p>Place or increase a blind bid for the next Alumni Influencer featured slot.</p>
    </div>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <div class="section">
        <h2>Current Slot Status</h2>
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
            <div class="alert alert-error"><strong>You have reached the monthly featured limit for this month.</strong></div>
        <?php else : ?>
            <?php if ($user_bid) : ?>
                <p><a class="btn" href="<?php echo site_url('bidding/place_bid'); ?>">Increase My Bid</a></p>
            <?php else : ?>
                <p><a class="btn" href="<?php echo site_url('bidding/place_bid'); ?>">Place a Bid</a></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>
</body>
</html>

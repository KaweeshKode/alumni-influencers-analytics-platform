<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
    <title><?php echo !empty($user_bid) ? 'Increase Your Bid' : 'Place Your Bid'; ?></title>
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


        <h1><?php echo !empty($user_bid) ? 'Increase Your Bid' : 'Place Your Bid'; ?></h1>


    </div>

    <?php if ($this->session->flashdata('error')) : ?>
        <p style="color:red;"><?php echo html_escape($this->session->flashdata('error')); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')) : ?>
        <p style="color:green;"><?php echo html_escape($this->session->flashdata('success')); ?></p>
    <?php endif; ?>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php echo form_open('bidding/place_bid'); ?>

    <p>
        <label for="bid_amount">Bid Amount:</label>
        <input
            type="number"
            step="0.01"
            min="0.01"
            name="bid_amount"
            id="bid_amount"
            value="<?php echo set_value('bid_amount'); ?>"
            required
        >
    </p>

    <?php if (!empty($user_bid)) : ?>
        <p>
            <strong>Your current bid:</strong>
            <?php echo number_format($user_bid->bid_amount, 2); ?>
        </p>
        <p>New bid must be higher than your current bid.</p>
    <?php else : ?>
        <p>You are placing a new blind bid for today’s slot.</p>
    <?php endif; ?>

    <p><button type="submit">Submit Bid</button></p>

    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('bidding'); ?>">Back to Bidding Dashboard</a></p>
</div>
</body>
</html>

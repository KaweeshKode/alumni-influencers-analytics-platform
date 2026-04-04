<!DOCTYPE html>
<html>
<head>
    <title>Place Bid</title>
</head>
<body>
    <h2><?php echo !empty($user_bid) ? 'Increase Your Bid' : 'Place Your Bid'; ?></h2>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php echo form_open('bidding/place_bid'); ?>

    <p>Bid Amount:
        <input type="number" step="0.01" min="0.01" name="bid_amount" value="">
    </p>

    <?php if (!empty($user_bid)) : ?>
        <p>Your current bid is <?php echo number_format($user_bid->bid_amount, 2); ?>. New bid must be higher.</p>
    <?php endif; ?>

    <p><button type="submit">Submit Bid</button></p>

    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('bidding'); ?>">Back to Bidding Dashboard</a></p>
</body>
</html>
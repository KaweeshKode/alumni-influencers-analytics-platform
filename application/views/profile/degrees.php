<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<title>Degrees</title>
</head>
<body>
<div class="container">
    <div class="navbar">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a>
        <a href="<?php echo site_url('profile'); ?>">My Profile</a>
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a>
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </div>

    <div class="page-header">


        <h1>My Degrees</h1>


    </div>

    <p>
        <a href="<?php echo site_url('profile/add_degree'); ?>">Add Degree</a> |
        <a href="<?php echo site_url('profile'); ?>">Back</a>
    </p>

    <?php if (!empty($degrees)) : ?>
        <ul>
            <?php foreach ($degrees as $d) : ?>
                <li>
                    <strong><?php echo html_escape($d->degree_name); ?></strong> -
                    <?php echo html_escape($d->university_name); ?> <br>
                    <a href="<?php echo html_escape($d->official_degree_url); ?>" target="_blank">View Degree</a> <br>
                    Completed: <?php echo html_escape($d->completion_date); ?> <br>
                    <a href="<?php echo site_url('profile/edit_degree/' . $d->id); ?>">Edit</a> |
                    <a href="<?php echo site_url('profile/delete_degree/' . $d->id); ?>"
                        onclick="return confirm('Are you sure you want to delete this?');">
                        Delete
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No degrees added yet.</p>
    <?php endif; ?>
</div>
</body>
</html>

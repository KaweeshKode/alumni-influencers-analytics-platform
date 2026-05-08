<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<title>Licences</title>
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


        <h1>My Licences</h1>


    </div>

    <p>
        <a href="<?php echo site_url('profile/add_licence'); ?>">Add Licence</a> |
        <a href="<?php echo site_url('profile'); ?>">Back</a>
    </p>

    <?php if (!empty($licences)) : ?>
        <ul>
            <?php foreach ($licences as $l) : ?>
                <li>
                    <strong><?php echo html_escape($l->licence_name); ?></strong><br>
                    Awarding Body: <?php echo html_escape($l->awarding_body); ?><br>
                    <a href="<?php echo html_escape($l->awarding_body_url); ?>" target="_blank">Awarding Body URL</a><br>
                    Completed: <?php echo html_escape($l->completion_date); ?><br>
                    <a href="<?php echo site_url('profile/edit_licence/' . $l->id); ?>">Edit</a> |
                    <a href="<?php echo site_url('profile/delete_licence/' . $l->id); ?>"
                        onclick="return confirm('Are you sure you want to delete this?');">
                        Delete
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No licences added yet.</p>
    <?php endif; ?>
</div>
</body>
</html>

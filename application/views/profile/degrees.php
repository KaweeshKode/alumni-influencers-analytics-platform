<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: Arial; margin: 20px; }
    h2 { color: #2c3e50; }
    a { color: #007bff; }
    ul { line-height: 1.8; }

    .profile-nav {
        background: #f8f9fa;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 18px;
    }
    .profile-nav a {
        margin-right: 8px;
        text-decoration: none;
    }
</style>
<title>Degrees</title>
</head>
<body>
    <p class="profile-nav">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('profile'); ?>">My Profile</a> |
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>

    <h2>My Degrees</h2>

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
</body>
</html>

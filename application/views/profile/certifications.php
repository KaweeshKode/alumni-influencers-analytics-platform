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
<title>Certifications</title>
</head>
<body>
    <p class="profile-nav">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('profile'); ?>">My Profile</a> |
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>

    <h2>My Certifications</h2>

    <p>
        <a href="<?php echo site_url('profile/add_certification'); ?>">Add Certification</a>
    </p>

    <?php if (!empty($certifications)) : ?>
        <ul>
            <?php foreach ($certifications as $c) : ?>
                <li>
                    <strong><?php echo html_escape($c->certification_name); ?></strong><br>
                    Provider: <?php echo html_escape($c->provider_name); ?><br>
                    <a href="<?php echo html_escape($c->course_url); ?>" target="_blank">Course URL</a><br>
                    Completed: <?php echo html_escape($c->completion_date); ?><br>
                    <a href="<?php echo site_url('profile/edit_certification/' . $c->id); ?>">Edit</a> |
                    <a href="<?php echo site_url('profile/delete_certification/' . $c->id); ?>"
                        onclick="return confirm('Are you sure you want to delete this?');">
                        Delete
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No certifications added yet.</p>
    <?php endif; ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: Arial; margin: 20px; }
    h2 { color: #2c3e50; }
    a { color: #007bff; }
    ul { line-height: 1.8; }
</style>
<title>Licences</title>
</head>
<body>
    <h2>My Licences</h2>

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
</body>
</html>

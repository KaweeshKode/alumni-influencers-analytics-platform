<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: Arial; margin: 20px; }
    h2 { color: #2c3e50; }
    a { color: #007bff; }
    ul { line-height: 1.8; }
</style>
<title>Certifications</title>
</head>
<body>
    <h2>My Certifications</h2>

    <p>
        <a href="<?php echo site_url('profile/add_certification'); ?>">Add Certification</a> |
        <a href="<?php echo site_url('profile'); ?>">Back</a>
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

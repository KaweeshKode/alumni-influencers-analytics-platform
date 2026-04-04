<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: Arial; margin: 20px; }
    h2 { color: #2c3e50; }
    a { color: #007bff; }
    ul { line-height: 1.8; }
</style>
<title>Employment History</title>
</head>
<body>
    <h2>Employment History</h2>

    <p>
        <a href="<?php echo site_url('profile/add_employment'); ?>">Add Employment</a> |
        <a href="<?php echo site_url('profile'); ?>">Back</a>
    </p>

    <?php if (!empty($employment_history)) : ?>
        <ul>
            <?php foreach ($employment_history as $e) : ?>
                <li>
                    <strong><?php echo html_escape($e->job_title); ?></strong><br>
                    Company: <?php echo html_escape($e->company_name); ?><br>
                    Start: <?php echo html_escape($e->start_date); ?><br>
                    End: <?php echo $e->is_current_job ? 'Present' : html_escape($e->end_date); ?><br>
                    Description: <?php echo nl2br(html_escape($e->description)); ?><br>
                    <a href="<?php echo site_url('profile/edit_employment/' . $e->id); ?>">Edit</a> |
                    <a href="<?php echo site_url('profile/delete_employment/' . $e->id); ?>"
                        onclick="return confirm('Are you sure you want to delete this?');">
                        Delete
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No employment history added yet.</p>
    <?php endif; ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: Arial; margin: 20px; }
    h2 { color: #2c3e50; }
    a { color: #007bff; }
    ul { line-height: 1.8; }
</style>
<title><?php echo isset($degree) ? 'Edit Degree' : 'Add Degree'; ?></title>
</head>
<body>
    <h2><?php echo isset($degree) ? 'Edit Degree' : 'Add Degree'; ?></h2>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php
    $action = isset($degree)
        ? 'profile/edit_degree/' . $degree->id
        : 'profile/add_degree';

    echo form_open($action);
    ?>

    <p>Degree Name:
        <input type="text" name="degree_name" value="<?php echo set_value('degree_name', $degree->degree_name ?? ''); ?>">
    </p>

    <p>University Name:
        <input type="text" name="university_name" value="<?php echo set_value('university_name', $degree->university_name ?? ''); ?>">
    </p>

    <p>Official Degree URL:
        <input type="url" name="official_degree_url" value="<?php echo set_value('official_degree_url', $degree->official_degree_url ?? ''); ?>">
    </p>

    <p>Completion Date:
        <input type="date" name="completion_date" value="<?php echo set_value('completion_date', $degree->completion_date ?? ''); ?>">
    </p>

    <p><button type="submit">Save</button></p>

    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('profile/degrees'); ?>">Back to Degrees</a></p>
</body>
</html>

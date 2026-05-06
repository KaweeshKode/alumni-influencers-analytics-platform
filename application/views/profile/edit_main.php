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
<title>Edit Main Profile</title>
</head>
<body>
    <p class="profile-nav">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('profile'); ?>">My Profile</a> |
        <a href="<?php echo site_url('bidding'); ?>">Bidding</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>

    <h2>Edit Main Profile</h2>

    <?php if (!empty($error)) : ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php echo validation_errors('<p style="color:red;">', '</p>'); ?>

    <?php echo form_open_multipart('profile/edit_main'); ?>

        <p>Phone Number:
            <input type="text" name="phone_number" value="<?php echo set_value('phone_number', $profile->phone_number ?? ''); ?>">
        </p>

        <p>Date of Birth:
            <input type="date" name="date_of_birth" value="<?php echo set_value('date_of_birth', $profile->date_of_birth ?? ''); ?>">
        </p>

        <p>Graduation Year:
            <input type="number" name="graduation_year" value="<?php echo set_value('graduation_year', $profile->graduation_year ?? ''); ?>">
        </p>

        <p>Current Job Title:
            <input type="text" name="current_job_title" value="<?php echo set_value('current_job_title', $profile->current_job_title ?? ''); ?>">
        </p>

        <p>Current Company:
            <input type="text" name="current_company" value="<?php echo set_value('current_company', $profile->current_company ?? ''); ?>">
        </p>

        <p>Industry Sector:
            <input type="text" name="industry_sector" value="<?php echo set_value('industry_sector', $profile->industry_sector ?? ''); ?>">
        </p>

        <p>City:
            <input type="text" name="location_city" value="<?php echo set_value('location_city', $profile->location_city ?? ''); ?>">
        </p>

        <p>Country:
            <input type="text" name="location_country" value="<?php echo set_value('location_country', $profile->location_country ?? ''); ?>">
        </p>

        <p>LinkedIn URL:
            <input type="url" name="linkedin_url" value="<?php echo set_value('linkedin_url', $profile->linkedin_url ?? ''); ?>">
        </p>

        <p>Biography:</p>
        <p>
            <textarea name="biography" rows="6" cols="60"><?php echo set_value('biography', $profile->biography ?? ''); ?></textarea>
        </p>

        <p>Profile Image:
            <input type="file" name="profile_image">
        </p>

        <?php if (!empty($profile->profile_image)) : ?>
            <p>
                <img src="<?php echo base_url('uploads/profile_images/' . $profile->profile_image); ?>" width="120" alt="Current Profile Image">
            </p>
        <?php endif; ?>

        <p><button type="submit">Save Profile</button></p>
    <?php echo form_close(); ?>

    <p><a href="<?php echo site_url('profile'); ?>">Back to Profile Dashboard</a></p>
</body>
</html>

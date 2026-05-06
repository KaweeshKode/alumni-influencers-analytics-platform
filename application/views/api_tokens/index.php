<!DOCTYPE html>
<html>
<head>
    <title>API Tokens</title>
</head>
<body>
    <p>
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('apitokens'); ?>">API Tokens</a> |
        <a href="<?php echo site_url('apitokens/usage'); ?>">Usage Logs</a> |
        <a href="<?php echo site_url('api-docs'); ?>">Swagger Docs</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>

    <h2>Manage API Tokens</h2>

    <?php if ($this->session->flashdata('success')) : ?>
        <p style="color:green;"><?php echo html_escape($this->session->flashdata('success')); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <p style="color:red;"><?php echo html_escape($this->session->flashdata('error')); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('generated_token')) : ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">
            <p><strong>Copy this token now. It will not be shown again:</strong></p>
            <code><?php echo html_escape($this->session->flashdata('generated_token')); ?></code>
        </div>
    <?php endif; ?>

    <h3>Create New Token</h3>

    <?php echo form_open('apitokens/create'); ?>
        <p>
            <label for="token_name">Token Name:</label><br>
            <input type="text" name="token_name" id="token_name" required>
        </p>

        <p>
            <label for="client_id">Client:</label><br>
            <select name="client_id" id="client_id" required>
                <option value="">-- Select Client --</option>
                <?php foreach ($clients as $client) : ?>
                    <option value="<?php echo (int)$client->id; ?>">
                        <?php echo html_escape($client->client_name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p><button type="submit">Create Token</button></p>
    <?php echo form_close(); ?>

    <h3>Your Tokens</h3>

    <?php if (!empty($tokens)) : ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Client</th>
                    <th>Prefix</th>
                    <th>Scopes</th>
                    <th>Last Used</th>
                    <th>Expires</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tokens as $token) : ?>
                    <tr>
                        <td><?php echo html_escape($token->token_name); ?></td>
                        <td><?php echo html_escape($token->client_name); ?></td>
                        <td><?php echo html_escape($token->token_prefix); ?>...</td>
                        <td><?php echo html_escape($token->scopes); ?></td>
                        <td><?php echo $token->last_used_at ? html_escape($token->last_used_at) : 'Never'; ?></td>
                        <td><?php echo $token->expires_at ? html_escape($token->expires_at) : 'No expiry'; ?></td>
                        <td>
                            <?php echo ($token->is_active && !$token->revoked_at) ? 'Active' : 'Revoked'; ?>
                        </td>
                        <td>
                            <?php if ($token->is_active && !$token->revoked_at) : ?>
                                <a href="<?php echo site_url('apitokens/revoke/' . (int)$token->id); ?>"
                                   onclick="return confirm('Revoke this token?');">
                                    Revoke
                                </a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No API tokens created yet.</p>
    <?php endif; ?>

    <p>
        <a href="<?php echo site_url('apitokens/usage'); ?>">View Usage Logs</a>
    </p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>API Usage Logs</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
</head>
<body>
<div class="container">

    <div class="navbar">
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a>
        <a href="<?php echo site_url('apitokens'); ?>">API Tokens</a>
        <a href="<?php echo site_url('apitokens/usage'); ?>">Usage Logs</a>
        <a href="<?php echo site_url('api-docs'); ?>">Swagger Docs</a>
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </div>

    <div class="page-header">
        <h1>API Usage Logs</h1>
        <p>Review token usage, accessed endpoints, timestamps, and response codes.</p>
    </div>

    <div class="section">
        <?php if (!empty($logs)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Client</th>
                        <th>Token Name</th>
                        <th>Method</th>
                        <th>Endpoint</th>
                        <th>Response</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log) : ?>
                        <tr>
                            <td><?php echo html_escape($log->requested_at); ?></td>
                            <td><?php echo html_escape($log->client_name); ?></td>
                            <td><?php echo html_escape($log->token_name); ?></td>
                            <td><?php echo html_escape($log->http_method); ?></td>
                            <td><?php echo html_escape($log->endpoint); ?></td>
                            <td><?php echo (int)$log->response_code; ?></td>
                            <td><?php echo html_escape($log->ip_address); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No API usage logs found yet.</p>
        <?php endif; ?>
    </div>

    <p><a class="btn" href="<?php echo site_url('apitokens'); ?>">Back to API Tokens</a></p>

</div>
</body>
</html>

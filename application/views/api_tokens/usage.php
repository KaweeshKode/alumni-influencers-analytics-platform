<!DOCTYPE html>
<html>
<head>
    <title>API Usage Logs</title>
</head>
<body>
    <p>
        <a href="<?php echo site_url('dashboard'); ?>">Main Dashboard</a> |
        <a href="<?php echo site_url('apitokens'); ?>">API Tokens</a> |
        <a href="<?php echo site_url('apitokens/usage'); ?>">Usage Logs</a> |
        <a href="<?php echo site_url('api-docs'); ?>">Swagger Docs</a> |
        <a href="<?php echo site_url('logout'); ?>">Logout</a>
    </p>

    <h2>API Usage Logs</h2>

    <?php if (!empty($logs)) : ?>
        <table border="1" cellpadding="8" cellspacing="0">
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

    <p><a href="<?php echo site_url('apitokens'); ?>">Back to API Tokens</a></p>
</body>
</html>

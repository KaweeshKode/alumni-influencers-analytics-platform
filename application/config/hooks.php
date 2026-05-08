<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file defines application hooks used by CodeIgniter.
| SecurityHeaders adds global HTTP security headers and controlled CORS
| headers for API routes.
| -------------------------------------------------------------------------
*/

$hook['post_controller_constructor'][] = [
    'class'    => 'SecurityHeaders',
    'function' => 'set_headers',
    'filename' => 'SecurityHeaders.php',
    'filepath' => 'hooks'
];

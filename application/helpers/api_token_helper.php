<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_plain_api_token')) {
    function generate_plain_api_token()
    {
        return bin2hex(random_bytes(32)); // 64 hex chars
    }
}

if (!function_exists('hash_api_token')) {
    function hash_api_token($plain_token)
    {
        return hash('sha256', $plain_token);
    }
}

if (!function_exists('make_token_prefix')) {
    function make_token_prefix($plain_token)
    {
        return substr($plain_token, 0, 12);
    }
}

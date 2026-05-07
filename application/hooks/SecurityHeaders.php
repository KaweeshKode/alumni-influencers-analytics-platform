<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SecurityHeaders
{
    public function set_headers()
    {
        $CI =& get_instance();

        // Global security headers: PHP/CodeIgniter equivalent of common Helmet-style protections.
        $CI->output
            ->set_header('X-Frame-Options: SAMEORIGIN')
            ->set_header('X-Content-Type-Options: nosniff')
            ->set_header('X-XSS-Protection: 1; mode=block')
            ->set_header('Referrer-Policy: strict-origin-when-cross-origin')
            ->set_header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

        $uri = trim($CI->uri->uri_string(), '/');

        // Apply controlled CORS only to public API routes such as /api/featured-today,
        // /api/alumni, /api/analytics-summary, and /api/analytics-charts.
        if (preg_match('#^api(/|$)#', $uri)) {
            $allowed_origins = [
                'http://localhost',
                'http://localhost:3000',
                'http://localhost:5173',
                'http://127.0.0.1',
                'http://127.0.0.1:3000',
                'http://127.0.0.1:5173'
            ];

            $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

            if (in_array($origin, $allowed_origins, true)) {
                $CI->output->set_header('Access-Control-Allow-Origin: ' . $origin);
            } else {
                // Safe local default for tools such as Postman and local browser testing.
                $CI->output->set_header('Access-Control-Allow-Origin: http://localhost');
            }

            $CI->output
                ->set_header('Vary: Origin')
                ->set_header('Access-Control-Allow-Methods: GET, OPTIONS')
                ->set_header('Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With')
                ->set_header('Access-Control-Max-Age: 86400');

            if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
                $CI->output
                    ->set_status_header(204)
                    ->set_output('')
                    ->_display();
                exit;
            }
        }
    }
}

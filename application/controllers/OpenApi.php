<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpenApi extends CI_Controller
{
    public function json()
    {
        $file = APPPATH . 'docs/openapi.json';

        if (!file_exists($file)) {
            show_error('OpenAPI definition not found.', 404);
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(file_get_contents($file));
    }
}

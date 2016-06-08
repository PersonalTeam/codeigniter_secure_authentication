<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('loadView')) {
    function loadView ($context = null, $view = null, $data = null) {
        ($context == null) ? exit('No class context passed to the view helper') : null;
        $context->load->view('theme/home', $data);

        if( $view != null ) {
            $context->load->view('pages/' . $view);
        }

        $context->load->view('theme/footer');
    }
}
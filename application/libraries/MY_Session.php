<?php
class MY_Session extends CI_Session {

    /**
     * Update an existing session
     *
     * @access    public
     * @return    void
    */
    function sess_update() {
            // skip the session update if this is an AJAX call! This is a bug in CI; see:
            // https://github.com/EllisLab/CodeIgniter/issues/154
            // http://codeigniter.com/forums/viewthread/102456/P15
            if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || ( stripos($_SERVER['REQUEST_URI'], 'live/request') != 0 ) ) { 
                    parent::sess_update();
            }
    }
}
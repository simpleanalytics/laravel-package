<?php

return [
    // Custom Domain simple.example.com
    'custom_domain' => null,
    // Enable the script
    'enabled' => true,
    // Change mode (hash)
    'data-mode' => null,
    // Collect DONotTrack visits
    'data-collect-dnt' => false,
    // Ignore pages
    'data-ignore-pages' => array(),
    // Auto collect
    'data-auto-collect' => true,
    // Onload function
    'data-onload' => null,
    // Overwrite hostname
    'data-hostname' => null,
    // Overwrite global
    'data-sa-global' => null,
    // Non-unique hostnames
    'data-non-unique-hostnames' => null,
    // Override global
    'data-sa-global' => null,

    // Custom Settings
    // if a setting is missing add array key => value like:
    // 'data-collect-dark-mode' => true
    'custom-settings' => array(),

    // EVENT SETTINGS
    'automated-events' => false,
    // Automated Events outbound,emails,downloads
    'data-collect' => array('outbound','emails','downloads'),
    // Auto collect downloads pdf,csv,docx,xlsx,zip,doc,xls
    'data-extensions' => array('png','csv','docx','xlsx','zip','doc','xls'),
    // Use titles of page
    'data-use-title' => true,
    // Use full URLs
    'data-full-urls' => false,

    // Serversidetracking of api
    // Track Api Calls
    'track-api' => false

];

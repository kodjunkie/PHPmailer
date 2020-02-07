<?php

/*
 * Initialize the app
 * */

// Start Session
session_start();

// Include the functions file
include_once("functions.php");

// Autoload classes
spl_autoload_register(function ($className) {
    require_once("classes/".$className.".php");
});

/*
 * Ban IP Addresses
 * If enabled, public crawlers will be banned from accessing the app
 * */
//bannedIPs();

/*
 * Log Activity
 * If enabled, every request to this app will be logged
 * */
//logActivity();

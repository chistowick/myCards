<?php

//FRONT CONTROLLER
session_start();

/*
 * General settings. Note: only for development period and if this 
 * is not configured by default in php.ini
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connecting the main view
include_once ('views/main_view.php');
<?php
/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;

ini_set('display_errors', 1);

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', true);
Config::define('SCRIPT_DEBUG', true);
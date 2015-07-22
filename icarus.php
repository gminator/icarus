<?php
/*
Plugin Name: Icarus
Plugin URI: http://www.rsaweb.co.za
Description: Creates a health status page to use with any monitoring solution
Author: RSAWEB
Version: 1.0.0
Author URI: RSAWEB <thedevs@rsaweb.co.za>
*/
define('ICARUS_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

require_once "lib/icarus.php";


new Icarus();
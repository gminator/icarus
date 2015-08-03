<?php
/**
 * Status Page
 *
 * Current Tests
 *
 * Test 1:
 * This will attempt to load the wordpress core, if it fails you likley get a 500 if php errors enabled or you will get a Content-Length 0 if its not enabled
 *
 * Test 2:
 * It will attempt to retrieve on settings record from the database, if this does not return a result, the you will receive status 500
 * 
 **/
define('WP_USE_THEMES', false);
global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
define("BASE_PATH", preg_replace("/wp-content.*/", "", __FILE__)); 
require(BASE_PATH . 'wp-load.php');
require_once "lib/icarus.php";

//By now we can assume that core has been loaded
$icarus = new Icarus();
$nodes = Node::all();
foreach($nodes as $node)
{
      wp_delete_post( $node->id, true);
}

$node = Node::register_node();

$icarus->admins_settings_page("/views/health.html.php");
<?php
	/*
	Plugin Name: Training Orga Plugin (TOP)
	Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
	Description: Basic WordPress Plugin Header Comment
	Version:     20160911
	Author:      WordPress.org
	Author URI:  https://developer.wordpress.org/
	License:     GPL2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
	Text Domain: wporg
	Domain Path: /languages
	Author:      Julien Seitz
	*/
	
	// Protect from direct access
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	require_once('top_constants');
	
	global $top_db_version;
	$top_db_version = '1.0';

	require_once('top_install');

	// Install Database
	register_activation_hook( __FILE__, 'top_install_db' );
	register_activation_hook( __FILE__, 'top_install_data' );

	// Modify Menu
	add_action('admin_menu','top_groups_modifymenu');

	// Add Stylesheets
	add_action( 'wp_enqueue_scripts', 'top_register_plugin_styles' );

	// Require additionl actions
	//require_once(ROOTDIR . 'groups_list.php');
	require_once(ROOTDIR . 'groups_create.php');
	//require_once(ROOTDIR . 'groups_update.php');

	// Load additional functions
	require_once(ROOTDIR . 'top_functions.php');
?>
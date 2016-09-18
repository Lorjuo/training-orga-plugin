<?php
  function top_install_training_groups() {
    global $wpdb;
    global $top_db_version;

    $table_name = $wpdb->prefix . GROUPS_TABLE;
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
      name VARCHAR(256) NOT NULL,
      description TEXT NOT NULL,
      department_id BIGINT(20) UNSIGNED NOT NULL,
      age_begin TINYINT(2) UNSIGNED NOT NULL,
      age_end TINYINT(2) UNSIGNED NOT NULL,
      ancient BOOLEAN NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    
    write_log($sql);
  }

  function top_install_db() {
    global $top_db_version;
    
    top_install_training_groups();

    add_option( 'top_db_version', $top_db_version );
  }

  function top_install_data() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . GROUPS_TABLE;
    
    $wpdb->insert( 
      $table_name, 
      array(  
        'name' => 'Sample Group',
        'description' => 'Description',
        'department_id' => 1,
        'age_begin' => 0,
        'age_end' => 99,
        'ancient' => false,
      ) 
    );
  }

  function top_groups_modifymenu() {
    
    //this is the main item for the menu
    add_menu_page('Training Groups', //page title
    'Training Groups', //menu title
    'manage_options', //capabilities
    'top_groups_list', //menu slug
    'top_groups_list' //function
    );
    
    //this is a submenu
    add_submenu_page('top_groups_list', //parent slug
    'Add New Group', //page title
    'Add New', //menu title
    'manage_options', //capability
    'top_groups_new', //menu slug
    'top_groups_new'); //function
    
    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, //parent slug
    'Edit Group', //page title
    'Edit', //menu title
    'manage_options', //capability
    'top_groups_edit', //menu slug
    'top_groups_edit'); //function
  }

  function top_register_plugin_styles() {
    wp_register_style( 'top_plugin', plugins_url( PLUGIN_NAME+'/css/plugin.css' ) );
    wp_enqueue_style( 'top_plugin' );
  }
?>
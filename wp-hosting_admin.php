<?php

function wp_hosting_menu() {
  add_menu_page(__('WP Hosting','wp-hosting'), __('WP Hosting','wp-hosting'), 'manage_options', 'wp-hosting-options', 'wp_hosting_options');
  add_submenu_page( 'wp-hosting-options', __('Add Hosting plan','wp-hosting'), __('Add','wp-hosting'), 'manage_options', 'wp-hosting-add', 'wp_hosting_add');
}

function wp_hosting_options() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
  
  global $wpdb;
  
  echo '<div class="wrap">';
  echo '<h1>View hosting plans</h1>';
  echo '<p>Here is where the form would go if I actually had options.</p>';
  echo $wpdb->query("SELECT * FROM asd WHERE id > 0");
  echo $wpdb->get_var("SELECT name FROM asd");
  echo '</div>';
}

function wp_hosting_add() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
  echo '<div class="wrap">';
  echo '<h1>Add a new plan:</h1>';
  echo '<p></p>';
  echo '</div>';
}

?>

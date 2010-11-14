<?php

function grimp_hosting_menu() {
  add_menu_page(__('Grimp Hosting','grimp-hosting'), __('Grimp Hosting','grimp-hosting'), 'manage_options', 'grimp-hosting-options', 'grimp_hosting_options');
  add_submenu_page( 'grimp-hosting-options', __('Add Hosting plan','grimp-hosting'), __('Add','grimp-hosting'), 'manage_options', 'grimp-hosting-add', 'grimp_hosting_add');
}

function grimp_hosting_options() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
  
  global $wpdb;
  
  echo '<div class="wrap">';
  echo '<h1>View hosting plans</h1>';
  echo '<p>Here is where the form would go if I actually had options.</p>';
  echo $wpdb->get_row("SELECT * FROM asd WHERE id > 0");
  echo $wpdb->get_var("SELECT name FROM asd");
  echo '</div>';
}

function grimp_hosting_add() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
  echo '<div class="wrap">';
  echo '<h1>Add a new plan:</h1>';
  echo '<p></p>';
  echo '</div>';
}

?>

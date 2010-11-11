<?php

function wp_hosting_menu() {
  add_menu_page('WP-Hosting', 'WP-Hosting', 'manage_options', 'wp-hosting-options', 'wp_hosting_options');
}

function wp_hosting_options() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
  echo '<div class="wrap">';
  echo '<p>Here is where the form would go if I actually had options.</p>';
  echo '</div>';
}

function wp_hosting_add() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
  echo '<div class="wrap">';
  echo '<h1>Add A new plan:</h1>';
  echo '<p></p>';
  echo '</div>';
}

?>

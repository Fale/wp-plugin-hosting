<?php
/*
Plugin Name: WP-Hosting
Plugin URI: http://git.grimp.eu/projects/wp-hosting
Description: This plugin will allow you to manage hosting plans, hosting comparison etc.
Version: 0.1
Author: Fabio Alessandro Locati
Author URI: http://grimp.eu
License: GPL2
*/

//register_activation_hook('wp-hosting_setup.php', 'wp_hosting_setup');

include_once 'wp-hosting_setup.php';
wp_hosting_setup();

if(is_admin()){
	include_once 'wp-hosting_admin.php';
	add_action('admin_menu', 'wp_hosting_menu');
}else{
}

function wp_hosting_plan($id)
{
  global $wpdb;

  $out = "<table>";
  $out.= "  <tr>";
  $out.= "    <th>Opzione</th>";
  $out.= "    <th>Piano " . $wpdb->get_var("SELECT name FROM asd WHERE id = $id") . "</th>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Nome</td>";
  $out.= "    <td>" . $wpdb->get_var("SELECT name FROM asd WHERE id = $id") . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Hard Disk</td>";
  $out.= "    <td>" . $wpdb->get_var("SELECT hd FROM asd WHERE id = $id") . "</td>";
  $out.= "  </tr>";
  $out.="</table>";

  return $out;
}
?>

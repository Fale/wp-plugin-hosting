<?php
/*
Plugin Name: Grimp-Hosting
Plugin URI: http://git.grimp.eu/projects/wp-hosting
Description: This plugin will allow you to manage hosting plans, hosting comparison etc.
Dependencies: grimp-php/grimp-php.php
Version: 0.1
Author: Fabio Alessandro Locati
Author URI: http://grimp.eu
License: GPL2
*/

//register_activation_hook('wp-hosting_setup.php', 'wp_hosting_setup');

include_once 'grimp-hosting_setup.php';
grimp_hosting_setup();

if(is_admin()){
	include_once 'grimp-hosting_admin.php';
	add_action('admin_menu', 'grimp_hosting_menu');
}else{
}

function grimp_hosting_plan($id)
{
  global $wpdb;
  $plan = $wpdb->get_row("SELECT * FROM asd WHERE id = $id");

  $out = "<table>";
  $out.= "  <tr>";
  $out.= "    <th>Opzione</th>";
  $out.= "    <th>Piano $plan->name</th>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Nome</td>";
  $out.= "    <td>$plan->name</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Hard Disk</td>";
  $out.= "    <td>$plan->hd</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Banda</td>";
  $out.= "    <td>$plan->bw</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Domini</td>";
  $out.= "    <td>$plan->domains</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Domini aggiuntivi*</td>";
  $out.= "    <td>$plan->addons</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Sottodomini</td>";
  $out.= "    <td>$plan->subdomains</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Indirizzi e-mail</td>";
  $out.= "    <td>$plan->emails</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Accoount FTP</td>";
  $out.= "    <td>$plan->ftps</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Database MySQL</td>";
  $out.= "    <td>$plan->db</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Quota annuale</td>";
  $out.= "    <td>$plan->yearly</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>Setup**</td>";
  $out.= "    <td>$plan->setup</td>";
  $out.= "  </tr>";
  $out.= "</table>";
  $out.= "* I domini non sono inclusi, è solo inclusa la possibilità di aggiungerli<br />";
  $out.= "** Una tantum";

  return $out;
}
?>

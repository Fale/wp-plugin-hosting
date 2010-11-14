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

function grimp_hotsing_mb2gb($value)
{
  return $value/1024;
}

function grimp_hosting_values($value)
{
  if($value > 0)
    return $value;
  if($value == 0 )
    return __("unlimited","grimp-hosting");
  if($value == -1)
    return "-";
}

function grimp_hosting_plan($id)
{
  global $wpdb;
  $table_name = $wpdb->prefix . "hosting_plans";
  $plan = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");

  $out = "<table>";
  $out.= "  <tr>";
  $out.= "    <th>" . __("Option","grimp-hosting") . "</th>";
  $out.= "    <th>" . __("Plan","grimp-hosting") . " $plan->name</th>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Name","grimp-hosting") . "</td>";
  $out.= "    <td>$plan->name</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Hard Disk Space","grimp-hosting") . "</td>";
  $out.= "    <td>$plan->hd</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Transfert","grimp-hosting") . "</td>";
  $out.= "    <td>" . number_format(grimp_hotsing_mb2gb($plan->bw),2) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Domains","grimp-hosting") . "</td>";
  $out.= "    <td>$plan->domains</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Add-ons domains","grimp-hosting") . "*</td>";
  $out.= "    <td>" . grimp_hosting_values($plan->addons) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Subdomains","grimp-hosting") . "</td>";
  $out.= "    <td>" . grimp_hosting_values($plan->subdomains) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Email adresses","grimp-hosting") . "</td>";
  $out.= "    <td>" . grimp_hosting_values($plan->emails) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("FTP Accounts","grimp-hosting") . "</td>";
  $out.= "    <td>" . grimp_hosting_values($plan->ftps) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("MySQL Database","grimp-hosting") . "</td>";
  $out.= "    <td>" . grimp_hosting_values($plan->db) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Yearly fees","grimp-hosting") . "</td>";
  $out.= "    <td>$plan->yearly</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Setup fees","grimp-hosting") . "**</td>";
  $out.= "    <td>$plan->setup</td>";
  $out.= "  </tr>";
  $out.= "</table>";
  $out.= "* I domini non sono inclusi, è solo inclusa la possibilità di aggiungerli<br />";
  $out.= "** Una tantum";

  return $out;
}

function grimp_hosting_comparison($ids)
{
  global $wpdb;
  $table_name = $wpdb->prefix . "hosting_plans";
  $plans = array();
  foreach($ids as $i => $id)
    $plans[] = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");

  $out = "<table>";
  $out.= "  <tr>";
  $out.= "    <th>" . __("Option","grimp-hosting") . "</th>";
  foreach($plans as $i => $plan)
    $out.= "    <th>" . __("Plan","grimp-hosting") . " $plan->name</th>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Name","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>$plan->name</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Hard Disk Space","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>$plan->hd</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Transfert","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>" . number_format(grimp_hotsing_mb2gb($plan->bw),2) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Domains","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>$plan->domains</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Add-ons domains","grimp-hosting") . "*</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>" . grimp_hosting_values($plan->addons) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Subdomains","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>" . grimp_hosting_values($plan->subdomains) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Email adresses","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>" . grimp_hosting_values($plan->emails) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("FTP Accounts","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>" . grimp_hosting_values($plan->ftps) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("MySQL Database","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>" . grimp_hosting_values($plan->db) . "</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Yearly fees","grimp-hosting") . "</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>$plan->yearly</td>";
  $out.= "  </tr>";
  $out.= "  <tr>";
  $out.= "    <td>" . __("Setup fees","grimp-hosting") . "**</td>";
  foreach($plans as $i => $plan)
    $out.= "    <td>$plan->setup</td>";
  $out.= "  </tr>";
  $out.= "</table>";
  $out.= "* I domini non sono inclusi, è solo inclusa la possibilità di aggiungerli<br />";
  $out.= "** Una tantum";

  return $out;
}
?>

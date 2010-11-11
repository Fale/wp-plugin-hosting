<?php

global $wp_hosting_db_version;
$wp_hosting_db_version = "0.1";

function wp_hosting_setup() {
  global $wpdb;
  global $wp_hosting_db_version;

  $table_name = $wpdb->prefix . "hosting_plans";
  if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
    $sql = "CREATE TABLE " . $table_name . " (
  	  id smallint unsigned NOT NULL AUTO_INCREMENT,
	    name tinytext NOT NULL,
	    hd smallint unsigned NOT NULL,
	    bw smallint unsigned NOT NULL,
	    domains tinyint unsigned NOT NULL,
	    addons smallint NOT NULL,
	    subdomains smallint NOT NULL,
	    emails smallint NOT NULL,
	    ftps smallint NOT NULL,
	    db smallint NOT NULL,
	    yearly decimal(8,2) unsigned NOT NULL,
	    setup decimal(8,2) unsigned NOT NULL,
  	  UNIQUE KEY id (id)
    	);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $result = dbDelta($sql);
    var_dump($result);

    add_option("wp_hosting_db_version", $wp_hosting_db_version);
  }
}

?>

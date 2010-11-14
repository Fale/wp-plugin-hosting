<?php

global $grimp_hosting_db_version;
$grimp_hosting_db_version = "0.1";

function grimp_hosting_setup() {
  global $wpdb;
  global $grimp_hosting_db_version;

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
  	  UNIQUE KEY (id)
    	);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option("grimp_hosting_db_version", $grimp_hosting_db_version);
  }
}

?>

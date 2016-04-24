<?php 

//Plugin Name: csdb
function csdb_database_create(){
global $wpdb;

$table_name = $wpdb->prefix.'csdb';

if( $wpdb->get_var('SHOW TABLES LIKE '.$table_name) != $table_name ){
	$sql = 'CREATE TABLE '.$table_name.' (
		id INTEGER (10) UNSIGNED AUTO_INCREMENT,
		name VARCHAR (255),
		roll INTEGER (8),
		total_num INTEGER (3),
		status VARCHAR (10),
		reg_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id)
	) ';
	
	require_once(ABSPATH.'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	
	
	
}

}
register_activation_hook(__FILE__,'csdb_database_create');
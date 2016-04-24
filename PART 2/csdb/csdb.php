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

// ADD PAGE FOR OUR PLUGIN

function csdb_add_menu_page(){
	add_menu_page(
		'CSDB',
		'CSDB',
		'read',
		'csdb_plugin',
		'csdb_menu_page_callback',
		'dashicons-admin-tools',
		60
	);
	
	
	
	
}

add_action('admin_menu','csdb_add_menu_page');


//callback function of plugn menu page.

function csdb_menu_page_callback(){
	echo '<h1>WELCOME TO CSDB</h1>';
	global $wpdb;

$table_name = $wpdb->prefix.'csdb';
	if(isset($_POST['submitnow'])){
		$name = $_POST['name'];
		$roll = $_POST['roll'];
		$total = $_POST['total'];
		$status = $_POST['status'];
		if( empty($name) || empty($roll) || empty($total) || empty($status) ){    
			echo '<p style="color:red; font-size:16px;"  > FILL UP ALL FIELDS. </p>';
		
		 }elseif(!is_numeric($roll) || !is_numeric($total) ){
			 
			 echo '<p style="color:red; font-size:16px;"  > ENTER NUMERIC NUMBER ON ROLL AND TOTLAT FIELD </p>';
		 }elseif(!is_string($name) || !is_string($status) ){
			 
			  echo '<p style="color:red; font-size:16px;"  > ENTER STRING ONLY AS NAME FIELD. </p>';
		 }elseif(strlen($roll) != 8 ){
			 echo '<p style="color:red; font-size:16px;"  > ENTER VALID ROLL NUMBER. </p>';
		 }elseif(strlen($total) != 3 || $total > 500 ){
			 
			 echo '<p style="color:red; font-size:16px;"  > ENTER VALID TOTLAL. TOTAL NUM SHOULD NOT BE MORE THAT 3 DIGIT  and SHOULD NOT BE MORE THAN 500</p>';
		 }else{
			 $roll_num = $wpdb->get_var('SELECT roll FROM '.$table_name.' WHERE roll="'.$roll.'" ');
			 
			if($roll_num == $roll ){
				
				echo '<p style="color:red; font-size:16px;"  >THIS ROLL NUMBER ALREADY EXIXT IN DATABASE.</p>';
				
			}else{
				$wpdb->insert( $table_name,
				
				array(
				'name'=> esc_sql($name),			
				'roll'=> esc_sql($roll),			
				'total_num'=> esc_sql($total),			
				'status'=> esc_sql($status)		
				
				
				),
				array(
				'%s', '%d', '%d', '%s'
				
				)
				
				);
				
				echo '<p style="color:green; font-size:16px;"  >DATA INSERTED.</p>';
			}
			 
		 }
		
		
		
		
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	if(is_user_logged_in ()){
		if(current_user_can('manage_options')){
			
			
			
			?>
			<form action="" method="post">
				<p>Name: </p>
				<input type="text" name="name" />
				<p>Roll: </p>
				<input type="number" name="roll" />
				
				<p>Total: </p>
				<input type="number" name="total" />
				<p>Status: </p>
				<select name="status" id="">
					<option value="pass"> PASS </option>
					<option value="filed"> FAILED </option>
				
				</select>
				<p></p>
				<input type="submit" value="Submit"  name="submitnow" />
			
			</form>
			
			<?php
	}
}
	
	
	
	
	
	
	
	
	
	
	
	
}






















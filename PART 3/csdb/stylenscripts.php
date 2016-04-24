<?php 

function load_custom_wp_admin_style($hook) {
	if( $hook =='toplevel_page_csdb_plugin'){
        wp_enqueue_style( 'csdb_css', plugin_dir_url( __FILE__ ) . 'css/csdb.css', array(), '1.0.0', 'all' );
      } 
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
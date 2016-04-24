<?php 


//plugin shortcode
function csdb_seachu_form_by_shortcode( $atts ){
	return csdb_serach_result_function ();
}
add_shortcode( 'seach_form', 'csdb_seachu_form_by_shortcode' );
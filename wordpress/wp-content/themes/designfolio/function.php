<?php
 
/* Designfolio Child Theme.
 *
 * v1.0.
 */
 
function pc_custom_footer() {
	echo "<div style='text-align:center;'><p>This is my custom footer message!</p></div>";
}
add_filter( 'wp_footer', 'pc_custom_footer' );
 
function pc_custom_content($content) {
	return $content."<div><p>Brought to you by PressCoders.com!</p></div>";
}
add_filter( 'the_content', 'pc_custom_content' );
 
?>

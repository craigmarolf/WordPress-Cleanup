<?php
// CLEAN UP WP-ADMIN ----------------------------------

// Enqueue Admin CSS Override
function stackpilot_admin_style(){
	wp_register_style( 'stackpilot_admin_css', get_bloginfo('stylesheet_directory') . '/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'stackpilot_admin_css' );
}
	add_action('admin_enqueue_scripts', 'stackpilot_admin_style');

// Remove WordPress links from wp-admin nav
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}

// Replace WordPress thank you in admin footer
function modify_footer_admin () {
	echo 'Custom Message Here';
}
	add_filter('admin_footer_text', 'modify_footer_admin');

// Remove comments from wp-admin bar
function my_admin_bar_render() {
	global $wp_admin_bar;
  	$wp_admin_bar->remove_menu('comments');
}
	add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

// Remove comments from wp-admin nav
	function custom_menu_page_removing() {
	remove_menu_page( 'edit-comments.php' );
}
	add_action( 'admin_menu', 'custom_menu_page_removing' );

// Disable Default Dashboard Widgets
function remove_dashboard_meta() {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
	remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
	remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
	remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
	//remove_meta_box('tribe_dashboard_widget', 'dashboard', 'normal'); //Removes Tribe Events Cal Widget
	//remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' ); //Removes Yoast SEO Widget
	remove_action('admin_notices', 'update_nag');
}
  	add_action('admin_init', 'remove_dashboard_meta');

// OPTIMIZE ----------------------------------

// De-Register Unneccessary scripts and styles
function wpcustom_deregister_scripts_and_styles(){
	wp_deregister_style('nectar-ie8');
	wp_deregister_style('shortCodeCss');
	wp_deregister_script('wp-embed');
	wp_deregister_script('modernizer');
}

	add_action( 'wp_print_styles', 'wpcustom_deregister_scripts_and_styles', 100 );

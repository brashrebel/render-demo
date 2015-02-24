<?php

/*
Plugin Name: Render Demo Rules
Plugin URI: http://realbigplugins.com
Description: Adds a special role to the site for demo users with only specific capabilities.
Version: 0.1
Author: Kyle Maurer
Author URI: http://kyleblog.net
License: GPL2
*/

class Render_Demo_Rules {

	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'add_role' ) );
		register_deactivation_hook( __FILE__, array( $this, 'remove_role' ) );
		register_activation_hook( __FILE__, array( $this, 'my_activation' ) );
		add_action( 'purge', array( $this, 'do_this_hourly' ) );
	}

	public static function pd_remove_roles() {
		remove_role( 'demo' );
	}

	public static function add_role() {
		add_role( 'demo', 'Demo User', array(
				'read',
				'edit_posts',
				'edit_published_posts',
				'edit_theme_options',
			)
		);
	}

	public static function my_activation() {
		wp_schedule_event( current_time( 'timestamp' ), 'hourly', 'purge' );
	}

	public function do_this_hourly() {
		// do something every hour
	}

}

new Render_Demo_Rules();
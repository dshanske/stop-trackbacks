<?php
/**
 * Plugin Name: Stop Trackbacks
 * Plugin URI: https://github.com/dshanske/stop-trackbacks
 * Description: Disable the Receipt of Trackbacks
 * Author: David Shanske
 * Author URI: https://david.shanske.com
 * Version: 0.01
 */


/* 
 * Any Time A Trackback is Received Return an Error.
 * @since 4.7.0
 */

function stop_trackbacks_pre_trackback_post( $tb_id, $tb_url, $charset, $title, $excerpt, $blog_name ) {
	header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ) );
	trackback_response( 1, __( 'Sorry, trackbacks are closed for this item.', 'default' ) );
}

add_action( 'pre_trackback_post', 'stop_trackbacks_pre_trackback_post', 10, 6 );


/*
 * Do Not Try to Send Trackbacks.
 * @since 5.6.0
 */
remove_action( 'do_all_pings', 'do_all_trackbacks' );


function stop_trackbacks_remove_meta_box() {
	remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
}

add_action( 'admin_menu' , 'stop_trackbacks_remove_meta_box' );

<?php
/*
Plugin Name: KeywordLuv
Plugin URI: http://wordpress.org/extend/plugins/keywordluv/
Description: Reward your commentators by separating their name from their keywords, in the link to their website, giving them improved anchor text. For example, leaving "Stephen @ Custom WordPress Plugins" in the name field, will result in the following: Stephen from <a href="http://www.scratch99.com/">Custom WordPress Plugins</a>. Requires a DoFollow plugin</a> to be effective.
Version: 3.0
Date: 2nd January 2014
Author: Stephen Cronin
Author URI: http://www.scratch99.com/
   
   Copyright 2008 - 2014  Stephen Cronin  (email : sjc@scratch99.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/ 


// ****** GLOBAL VARIABLES AND CONSTANTS ******
// initialise variable, overriding any exploitation attempt (only possible if register_globals is On and wp_unregister_GLOBALS() is disabled)
$keywordluv_name = '';
// *******************************************


// ****** SETUP ACTIONS AND FILTERS ******
add_action( 'activate_' . dirname( plugin_basename( __FILE__ ) ) . '/' . basename( __FILE__ ), 'create_keywordluv_options' );
add_filter( 'get_comment_author_link', 'keywordluv' );
add_filter( 'get_comment_author', 'keywordluv2' );
add_action( 'comment_form', 'keywordluv_text' );
add_action( 'admin_menu', 'keywordluv_admin' );
add_filter( 'preprocess_comment', 'keywordluv_commentluv', 10 );  // low priority so CommentLuv fires first
add_action( 'init', 'keywordluv_init' );
// **************************************


// ****** RUN INIT STUFF ******
function keywordluv_init() {
	// strip link from message to make sure there are no 404s for users.
	$keywordluv_options = get_option( 'keywordluv_options' );
	if ( empty ( $keywordluv_options[ 'remove_link' ] ) ) {
		$keywordluv_options[ 'message' ] = str_replace( '<a href="http://www.scratch99.com/wordpress-plugin-keywordluv/">KeywordLuv</a>', 'KeywordLuv', html_entity_decode( stripslashes( $keywordluv_options[ 'message' ] ) ) );
		$keywordluv_options[ 'remove_link' ] = 'done';
		update_option( 'keywordluv_options' , $keywordluv_options );
	}
}
// ***************************


// ****** FOR THEMES THAT DON'T USE COMMENT_AUTHOR_LINK ******
function keywordluv_name() {
	// only want to do anything if compatibility mode is on
	$keywordluv_options = get_option( 'keywordluv_options' );
	if ( $keywordluv_options[ 'compatibility_mode' ] == 'true' ) {
		global $keywordluv_name;
		echo esc_html( $keywordluv_name );
	}
}
// ***********************************************************


// ****** FUNCTION TO STRIP THE KEYWORDS OUT FOR COMMENTLUV ******
function keywordluv_commentluv( $comment_data ) {
	$author = $comment_data[ 'comment_author' ];
	$end = strpos( $author, "@" );
	if ( $end != 0 ) {
		$comment = $comment_data[ 'comment_content' ];
		if ( strstr( $comment, $author ) ) {
			$comment_data[ 'comment_content' ] = str_replace( $author, trim( substr( $author, 0, $end) ), $comment );
		}
	}
	return $comment_data;
}
// ***************************************************************


// ****** FUNCTION TO MOVE NAME OUTSIDE THE LINK ******
function keywordluv( $link ) {
	// only proceed if there is actually a link 
	if ( strpos( $link, 'href=' ) == 0 )
		return $link;
	$keywordluv_options = get_option( 'keywordluv_options' );
	if ( $keywordluv_options[ 'compatibility_mode' ] == 'true' ) {
		global $keywordluv_name;
		// if it's empty then keywordluv2 didn't find @.
		if ( $keywordluv_name != '' ) {
			// if the plugin is now reversed, just return link (keywords should have been stripped in keywordluv2), otherwise go with original functionality
			if ( $keywordluv_options[ 'reverse' ] == 'true' ) {
				return $link;
			}
			else {
				$link = $keywordluv_name . $link;
			}
		}
	}
	else {
		// only do anything if @ is present in anchor text.
		$end = strpos( $link, "@" );
		if ( $end != 0 ) {
			// if the plugin is now reversed, use the name, otherwise go with original functionality
			if ( $keywordluv_options[ 'reverse' ] == 'true' ) {
				$link = trim( substr( $link, 0, $end ) ) . '</a>';
			}
			else {
				$start = strpos( $link, ">" ) + 1;
				$name = trim( substr( $link, $start, $end-$start ) );
				$rest = substr( $link, 0, $start ) . ltrim( substr( $link, $end+1 ) );
				$link = $name . ' from ' . $rest;
			}
		}
	}
	return $link;
}
// ***************************************************


// ****** FUNCTION TO MOVE NAME OUTSIDE THE LINK ******
function keywordluv2( $author ) {
	$keywordluv_options = get_option( 'keywordluv_options' );
	// only filter comment_author if compatibility mode is on, as it affects Admin->Comments
	if ( $keywordluv_options[ 'compatibility_mode' ] == 'true' ) {
		global $keywordluv_name;
		// only do anything if @ is present in anchor text.
		$end = strpos( $author, "@" );
		if ( $end != 0 ) {
			// check if the plugin is now reversed, otherwise go with original functionality
			if ( $keywordluv_options[ 'reverse' ] == 'true' ) {
				$keywordluv_name = trim( substr( $author, 0, $end ) );
				$author = ltrim( substr( $author, 0, $end-1 ) );			
			}
			else {
				$keywordluv_name = trim( substr( $author, 0, $end ) ) . ' from ';
				$author = ltrim( substr( $author, $end+1 ) );			
			}
		}
		else {
			$keywordluv_name = '';
		}
	}
	return $author;
}
// ***************************************************


// ****** FUNCTION TO ADD INFORMATION TO COMMENT FORM ******
function keywordluv_text( $id ){
	global $user_ID;
	$keywordluv_options = get_option( 'keywordluv_options' );
	if ( $keywordluv_options[ 'show_message' ] == 'true' && $keywordluv_options[ 'reverse' ] != 'true' ) {
		if ( !$user_ID ) {
			echo '<p>' . html_entity_decode( stripslashes( $keywordluv_options[ 'message' ] ) ) . '</p>';
		}
	}
	return $id;
}
// **********************************************************


// ****** FUNCTION TO CREATE OPTIONS AND DEFAULTS ON ACTIVATION ******
function create_keywordluv_options() {
	// get current options, assign defaults if not already set, update the options db
	$keywordluv_options = get_option( 'keywordluv_options' );
	$message = 'This site uses KeywordLuv. Enter YourName@YourKeywords in the Name field to take advantage.';
	if ( !isset( $keywordluv_options[ 'show_message' ] ) ) { $keywordluv_options[ 'show_message' ] = 'true'; }
	if ( !isset( $keywordluv_options[ 'message' ] ) ) { $keywordluv_options[ 'message' ] = $message; }
	if ( !isset( $keywordluv_options[ 'compatibility_mode' ] ) ) { $keywordluv_options[ 'compatibility_mode' ] = 'false'; }
	$keywordluv_options[ 'default_message' ] = $message;
	update_option( 'keywordluv_options' , $keywordluv_options );
}
// ******************************************************************


// ****** FUNCTION TO ADD ADMIN PAGE TO PRESENTATION MENU ******
function keywordluv_admin() {
	require_once( 'keywordluv-admin.php' );
}
// ************************************************************


?>
<?php
// This file is called on Admin pages

	// ****** Register the options page ******
	if ( function_exists( 'add_options_page' ) ) {
		add_options_page( 'KeywordLuv Setup', 'KeywordLuv', 'update_plugins', basename(__FILE__), 'keywordluv_admin_page' );
	}
	// ***********************************



	// ****** FUNCTION TO DRAW OPTIONS PAGE CONTENT ******
	function keywordluv_admin_page() {

		// load the options
		$keywordluv_options = get_option( 'keywordluv_options' );
		
		// Post the form
		if ( isset( $_POST[ 'keywordluv_options_submit' ] ) && check_admin_referer( 'keywordluv_admin_page_submit' ) ) {
			if ( esc_html( $_POST[ 'keywordluv_reverse' ] ) == 'true' ) { $keywordluv_options[ 'reverse' ] = 'true'; } else { $keywordluv_options[ 'reverse' ] = 'false'; } 
			if ( esc_html( $_POST[ 'keywordluv_show_message' ] ) == 'true' ) { $keywordluv_options[ 'show_message' ] = 'true'; } else { $keywordluv_options[ 'show_message' ] = 'false'; } 
			$keywordluv_options[ 'message' ] = ( esc_html( $_POST[ 'keywordluv_message' ] ) );
			if ( esc_html( $_POST[ 'keywordluv_compatibility_mode' ] ) == 'true' ) { $keywordluv_options[ 'compatibility_mode' ] = 'true'; } else { $keywordluv_options[ 'compatibility_mode' ] = 'false'; } 
			update_option( 'keywordluv_options', $keywordluv_options );
			echo '<div id="message" class="updated"><p><strong>';
			_e('Options saved.');
			echo '</strong></p></div>';
		} 

		// now drop out of php to create the HTML for the Options page
	?>
	
		<div class="wrap"> 
			<h2>KeywordLuv Settings</h2>			
			<div id="poststuff">

				<!-- Start Form (Posts to this page) -->
				<form name="keywordluv_options_form" action="" method="post">
				<?php if (function_exists(wp_nonce_field)) {wp_nonce_field('keywordluv_admin_page_submit'); }?>

				<div class="stuffbox">
					<h3>General Settings</h3>
					<div class="inside">

						<span style="color:red"><label class="keywordluv_options" for="keywordluv_reverse">Reverse KeywordLuv</label>
						<input type="checkbox" name="keywordluv_reverse" id="keywordluv_reverse" value="true" <?php if ( esc_attr( $keywordluv_options[ 'reverse' ] == 'true' ) ) echo 'checked="checked"'; ?> /> KeywordLuv is no longer recommended. In 2014, it may have a negative SEO effect on your site and those of your commentators. Choose this to display the commentators name rather than their keywords.</span>

						<label class="keywordluv_options" for="keywordluv_message">Comment Form Message</label>
						<textarea style="width: 75%; height: 90px;" id="keywordluv_message" name="keywordluv_message"><?php echo esc_html( stripslashes( $keywordluv_options[ 'message' ] ) ); ?></textarea>
						<br />This message will be shown on the comment form, if the Show Comment Form Message options is set.

						<label class="keywordluv_options" for="keywordluv_show_message">Show Comment Form Message</label>
						<input type="checkbox" name="keywordluv_show_message" id="keywordluv_show_message" value="true" <?php if ( esc_attr( $keywordluv_options[ 'show_message' ] == 'true' ) ) echo 'checked="checked"'; ?> /> Turn this off if you want to tell your visitors how to enter name @ keywords through your theme, rather than this message.

						<label class="keywordluv_options" for="keywordluv_compatibility_mode">Compatibility Mode</label>
						<input type="checkbox" name="keywordluv_compatibility_mode" id="keywordluv_compatibility_mode" value="true" <?php if ( esc_attr( $keywordluv_options[ 'compatibility_mode' ] == 'true' ) ) echo 'checked="checked"'; ?> /> Turn this on if your theme is not compatible with KeywordLuv. <strong>Warning: <a href="http://scratch99.com/wordpress-plugin-keywordluv/keywordluv-theme-compatibility-issue/">Read the implications</a> of doing this first</strong>.

						<!-- Show Update Button -->
						<div class="submit">
						<input type="submit" name="keywordluv_options_submit" value="<?php _e('Update Options &raquo;') ?>"/>
						</div>

					</div> <!-- end class="inside" -->
				</div> <!-- end class="stuffbox" -->

				<!-- End Form -->
				</form>
				
				<!-- Thank You Section -->
				<p style="font-size:0.9em">KeywordLuv Copyright 2008 - 2012 by Stephen Cronin. Released under the GNU General Public License (version 2 or later).</p>
	
			</div> <!-- end id="poststuff" -->
		</div> <!-- end class="wrap" -->

	<?php
	}
	// *********** END ADMIN PAGE FUNCTION ***********
	
	
	
	// ****** Start style / scripts to head element for options page ******
	add_action( 'admin_head', 'keywordluv_admin_head' );
	function keywordluv_admin_head() {
	?>
		<!-- Start KeywordLuv plugin additions -->
		<style type="text/css" media>
			label.keywordluv_options {
				display:block;
				margin: 16px 0 4px;
				font-weight:bold;
			}
			#submit {
				margin: 0 0 20px;
			}
		</style>
		<!-- End KeywordLuv plugin additions -->
	<?php
	}
	// ****** End style / scripts to head element for options page ******



	// ****** Start error message to no longer use the plugin ******
	function keywordluv_admin_notice() {
	
		// get the options
		$keywordluv_options = get_option( 'keywordluv_options' );

		// if current page has the URL parameter requesting message to be disabled, then set the option
		if ( isset( $_GET[ 'keywordluv_message' ] ) && esc_html( $_GET[ 'keywordluv_message' ] ) == 'disable' && $keywordluv_options[ 'please_disable' ] != 1 ) {
			$keywordluv_options[ 'please_disable' ] = 1;
			update_option( 'keywordluv_options' , $keywordluv_options );
		}

		// only display message if the option isn't set
		if ( $keywordluv_options[ 'please_disable' ] != 1 ) {
	?>
			<div id="keywordluv_message" class="updated">
				<a id="keywordluv_message_trigger" href="<?php echo esc_url( add_query_arg( array( 'keywordluv_message' => 'disable' ) ) ); ?>" style="float:right; text-decoration:underline; cursor:pointer; padding:6px 0 6px 6px;">Dismiss</a>
				<p><strong>WARNING: The KeywordLuv plugin is no longer recommended for use.</strong></p>
				<p>What was a great idea in 2008 is no longer effective and may even be harmful in 2014. Your commentators will not receive any benefit. In fact, if most of their links come from comments, they are likely to be penalised by Google. Additionally, if you have many low quality comments on your site, it may even affect your ranking.</p>
				<p>It is recommended that you switch the plugin into reverse mode on the <a href="options-general.php?page=keywordluv-admin.php">Settings page</a>. Comments will remain in the system, but will revert to using the name for comments using the KeywordLuv syntax, which may help.</p>
			</div>
	<?php
		}
	}
	add_action( 'admin_notices', 'keywordluv_admin_notice' );
	// ****** End error message to no longer use the plugin ******

?>
<?php
/**
 * Custom theme options available via WP Dashboard
 */

?>
<?php

function pinbin_get_default_options() {
	$options = array(
		'logo' => get_template_directory_uri() .'/images/logo.png'
	);
	return $options;
}


function pinbin_options_init() {
     $pinbin_options = get_option( 'theme_pinbin_options' );
	 
	 // Are our options saved in the DB?
     if ( false === $pinbin_options ) {
		  // If not, we'll save our default options
          $pinbin_options = pinbin_get_default_options();
		  add_option( 'theme_pinbin_options', $pinbin_options );
     }
	 
     // In other case we don't need to update the DB
}
// Initialize Theme options
add_action( 'after_setup_theme', 'pinbin_options_init' );

function pinbin_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		// Now we'll replace the 'Insert into Post Button inside Thickbox' 
		add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
	}
}
add_action( 'admin_init', 'pinbin_options_setup' );

function replace_thickbox_text($translated_text, $text ) {	
	if ( 'Insert into Post' == $text ) {
		$referer = strpos( wp_get_referer(), 'pinbin-settings' );
		if ( $referer != '' ) {
			return __('I want this to be my logo!', 'pinbin' );
		}
	}

	return $translated_text;
}

// Add "Pinbin Options" link to the "Appearance" menu
function pinbin_menu_options() {
	//add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
     add_theme_page('Pinbin Options', 'Pinbin Options', 'edit_theme_options', 'pinbin-settings', 'pinbin_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'pinbin_menu_options');

function pinbin_admin_options_page() {
	?>
		<!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes 
		for a good WP Admin Panel viewing and are predefined by WP CSS -->
		
		
		
		<div class="wrap">
			
			<div id="icon-themes" class="icon32"><br /></div>
		
			<h2><?php _e( 'Pinbin Options', 'pinbin' ); ?></h2>
			
			<!-- If we have any error by submiting the form, they will appear here -->
			<?php settings_errors( 'pinbin-settings-errors' ); ?>
			
			<form id="form-pinbin-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
					settings_fields('theme_pinbin_options');
					do_settings_sections('pinbin');
				?>
			
				<p class="submit">
					<?php submit_button( __( 'Save Settings', 'pinbin' ), 'primary', 'theme_pinbin_options[submit]', false ); ?>
					<?php submit_button( __( 'Restore Defaults', 'pinbin' ), 'secondary', 'theme_pinbin_options[reset]', false ); ?>
				</p>
			 <div class="credit"><?php _e( 'You can reach us at', 'pinbin' ); ?> <a href="http://colorawesomeness.com/themes/pinbin/">Color Awesomeness</a>.</div>
   
			</form>
	
		</div>
	<?php
}

function pinbin_options_validate( $input ) {
	$default_options = pinbin_get_default_options();
	$valid_input = $default_options;
	
	$pinbin_options = get_option('theme_pinbin_options');
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_logo = ! empty($input['delete_logo']) ? true : false;
	
	if ( $submit ) {
		if ( $pinbin_options['logo'] != $input['logo']  && $pinbin_options['logo'] != '' )
			delete_image( $pinbin_options['logo'] );
		
		$valid_input['logo'] = $input['logo'];
	}
	elseif ( $reset ) {
		delete_image( $pinbin_options['logo'] );
		$valid_input['logo'] = $default_options['logo'];
	}
	elseif ( $delete_logo ) {
		delete_image( $pinbin_options['logo'] );
		$valid_input['logo'] = '';
	}
	
	return $valid_input;
}

function delete_image( $image_url ) {
	global $wpdb;
	
	// We need to get the image's meta ID..
	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
	$results = $wpdb -> get_results($query);

	// And delete them (if more than one attachment is in the Library
	foreach ( $results as $row ) {
		wp_delete_attachment( $row -> ID );
	}	
}

/********************* JAVASCRIPT ******************************/
function pinbin_options_enqueue_scripts() {
	wp_register_script( 'pinbin-upload', get_template_directory_uri() .'/js/pinbin-upload.js', array('jquery','media-upload','thickbox') );	

	if ( 'appearance_page_pinbin-settings' == get_current_screen() -> id ) {
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('pinbin-upload');
		
	}
	
}
add_action('admin_print_styles-appearance_page_pinbin-settings', 'pinbin_options_enqueue_scripts');


function pinbin_options_settings_init() {
	register_setting( 'theme_pinbin_options', 'theme_pinbin_options', 'pinbin_options_validate' );
	
	// Add a form section for the Logo
	add_settings_section('pinbin_settings_header', __( 'Logo Options', 'pinbin' ), 'pinbin_settings_header_text', 'pinbin');
	
	// Add Logo uploader
	add_settings_field('pinbin_setting_logo',  __( 'Logo', 'pinbin' ), 'pinbin_setting_logo', 'pinbin', 'pinbin_settings_header');
	
	// Add Current Image Preview 
	add_settings_field('pinbin_setting_logo_preview',  __( 'Logo Preview', 'pinbin' ), 'pinbin_setting_logo_preview', 'pinbin', 'pinbin_settings_header');
}
add_action( 'admin_init', 'pinbin_options_settings_init' );

function pinbin_setting_logo_preview() {
	$pinbin_options = get_option( 'theme_pinbin_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $pinbin_options['logo'] ); ?>" />
	</div>
	<?php
}

function pinbin_settings_header_text() {
	?>
		<p><?php _e( 'Upload your logo. Theme supports GIF, JPEG, PNG.', 'pinbin' ); ?></p>
	<?php
}

function pinbin_setting_logo() {
	$pinbin_options = get_option( 'theme_pinbin_options' );
	?>
		<input type="hidden" id="logo_url" name="theme_pinbin_options[logo]" value="<?php echo esc_url( $pinbin_options['logo'] ); ?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'pinbin' ); ?>" />
		<?php if ( '' != $pinbin_options['logo'] ): ?>
			<input id="delete_logo_button" name="theme_pinbin_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'pinbin' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'pinbin' ); ?></span>
	<?php
}


?>
<?php 

// Functions for admin options
add_action( 'admin_menu', 'fct_social_sharing_add_admin_menu' );
add_action( 'admin_init', 'fct_social_sharing_settings_init' );

// Function to add settings menu
function fct_social_sharing_add_admin_menu(  ) { 
	add_options_page( 'Factory Social Sharing Buttons', 'Factory Social Sharing Buttons', 'manage_options', 'factory_social_sharing_buttons', 'fct_social_sharing_options_page' );
}

// Function for adding settings section and setting fields to Factory Social Sharing Buttons options page
function fct_social_sharing_settings_init(  ) { 
	// Register options and database row
	register_setting( 'fctSocialPage', 'fct_social_sharing_settings' );
	
	// Define sections

	// Add social networks section
	add_settings_section(
		'fct_social_sharing_fctSocialPage_section', 
		__( 'Select Social Networks', 'fct-social-sharing' ), 
		'fct_social_sharing_settings_section_callback', 
		'fctSocialPage'
	);

	// Add types section
	add_settings_section(
		'fct_social_sharing_fctSocialPage_section_types', 
		__( 'Select Post Types', 'fct-social-sharing' ), 
		'fct_social_sharing_settings_section_callback_types', 
		'fctSocialPage'
	);
	// Add positions section
	add_settings_section(
		'fct_social_sharing_fctSocialPage_section_positions', 
		__( 'Select Buttons Position', 'fct-social-sharing' ), 
		'fct_social_sharing_settings_section_callback_positions', 
		'fctSocialPage'
	);

	// Add button size section
	add_settings_section(
		'fct_social_sharing_fctSocialPage_section_buttonsize', 
		__( 'Select the buttons size', 'fct-social-sharing' ), 
		'fct_social_sharing_settings_section_callback_buttonsize', 
		'fctSocialPage'
	);

	// Add other settings section
	add_settings_section(
		'fct_social_sharing_fctSocialPage_section_colors', 
		__( 'Button colors and title', 'fct-social-sharing' ), 
		'fct_social_sharing_settings_section_callback_colors', 
		'fctSocialPage'
	);

	//Define Fields
	add_settings_field( 
		'fct_social_sharing_field_facebook', 
		__( 'Facebook', 'fct-social-sharing' ), 
		'fct_social_sharing_field_facebook_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section' 
	);

	add_settings_field( 
		'fct_social_sharing_field_twitter', 
		__( 'Twitter', 'fct-social-sharing' ), 
		'fct_social_sharing_field_twitter_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section' 
	);

	add_settings_field( 
		'fct_social_sharing_field_gplus', 
		__( 'Google Plus', 'fct-social-sharing' ), 
		'fct_social_sharing_field_gplus_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section' 
	);

	add_settings_field( 
		'fct_social_sharing_field_pinterest', 
		__( 'Pinterest', 'fct-social-sharing' ), 
		'fct_social_sharing_field_pinterest_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section' 
	);

	add_settings_field( 
		'fct_social_sharing_field_linkedin', 
		__( 'Linkedin', 'fct-social-sharing' ), 
		'fct_social_sharing_field_linkedin_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section' 
	);

	add_settings_field( 
		'fct_social_sharing_field_whatsapp', 
		__( 'Whats App', 'fct-social-sharing' ), 
		'fct_social_sharing_field_whatsapp_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section' 
	);

	add_settings_field( 
		'fct_social_sharing_field_undercontent', 
		__( 'Under the post/page content', 'fct-social-sharing' ), 
		'fct_social_sharing_field_undercontent_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section_positions' 
	);


	add_settings_field( 
		'fct_social_sharing_field_undertitle', 
		__( 'Under the page/post title', 'fct-social-sharing' ), 
		'fct_social_sharing_field_undertitle_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section_positions' 
	);

	add_settings_field( 
		'fct_social_sharing_field_floatleft', 
		__( 'Float left on screen', 'fct-social-sharing' ), 
		'fct_social_sharing_field_floatleft_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section_positions' 
	);

	add_settings_field( 
		'fct_social_sharing_field_buttonsize', 
		__( 'Buttons size', 'fct-social-sharing' ), 
		'fct_social_sharing_field_buttonsize_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section_buttonsize' 
	);

	add_settings_field( 
		'fct_social_sharing_field_colorselect', 
		__( 'Social buttons color', 'fct-social-sharing' ), 
		'fct_social_sharing_field_colorselect_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section_colors' 
	);

	add_settings_field( 
		'fct_social_sharing_field_colordefine', 
		__( 'Your color hex code', 'fct-social-sharing' ), 
		'fct_social_sharing_field_colordefine_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section_colors' 
	);

	add_settings_field( 
		'fct_social_sharing_field_sharetitle', 
		__( 'Share buttons title', 'fct-social-sharing' ), 
		'fct_social_sharing_field_sharetitle_render', 
		'fctSocialPage', 
		'fct_social_sharing_fctSocialPage_section_colors' 
	);

	// Register setting for post types
	register_setting( 'fctSocialPage', 'fct_social_sharing_settings_types' );
	// Get post types and generate option fields for each post type except attachment, revision and nav_menu_item
	add_settings_field( 
		'fct_social_sharing_field_types', 
		__( 'Post types', 'fct-social-sharing' ),
		'fct_social_sharing_field_types_render',
		'fctSocialPage',
		'fct_social_sharing_fctSocialPage_section_types' 
	);
}

//Functions to render each option field
function fct_social_sharing_field_facebook_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_facebook]' <?php checked( $options['fct_social_sharing_field_facebook'], 1 ); ?> value='1'>
	<?php
}

function fct_social_sharing_field_twitter_render(  ) { 

	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_twitter]' <?php checked( $options['fct_social_sharing_field_twitter'], 1 ); ?> value='1'>
	<?php

}

function fct_social_sharing_field_gplus_render(  ) { 

	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_gplus]' <?php checked( $options['fct_social_sharing_field_gplus'], 1 ); ?> value='1'>
	<?php

}

function fct_social_sharing_field_pinterest_render(  ) { 

	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_pinterest]' <?php checked( $options['fct_social_sharing_field_pinterest'], 1 ); ?> value='1'>
	<?php

}

function fct_social_sharing_field_linkedin_render(  ) { 

	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_linkedin]' <?php checked( $options['fct_social_sharing_field_linkedin'], 1 ); ?> value='1'>
	<?php

}

function fct_social_sharing_field_whatsapp_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_whatsapp]' <?php checked( $options['fct_social_sharing_field_whatsapp'], 1 ); ?> value='1'>
	<?php
}

function fct_social_sharing_field_undercontent_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_undercontent]' <?php checked( $options['fct_social_sharing_field_undercontent'], 1 ); ?> value='1'>
	<?php
}

function fct_social_sharing_field_undertitle_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_undertitle]' <?php checked( $options['fct_social_sharing_field_undertitle'], 1 ); ?> value='1'>
	<?php
}

function fct_social_sharing_field_floatleft_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type='checkbox' name='fct_social_sharing_settings[fct_social_sharing_field_floatleft]' <?php checked( $options['fct_social_sharing_field_floatleft'], 1 ); ?> value='1'>
	<?php
}

function fct_social_sharing_field_buttonsize_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type="radio" name='fct_social_sharing_settings[fct_social_sharing_field_buttonsize]' <?php checked( $options['fct_social_sharing_field_buttonsize'], 1 ); ?> value='1'> Small  <br/>
	<input type="radio" name='fct_social_sharing_settings[fct_social_sharing_field_buttonsize]' <?php checked( $options['fct_social_sharing_field_buttonsize'], 2 ); ?> value='2'> Medium <br/>
	<input type="radio" name='fct_social_sharing_settings[fct_social_sharing_field_buttonsize]' <?php checked( $options['fct_social_sharing_field_buttonsize'], 3 ); ?> value='3'> Large  <br/>
	<?php
}

function fct_social_sharing_field_colorselect_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type="radio" name='fct_social_sharing_settings[fct_social_sharing_field_colorselect]' <?php checked( $options['fct_social_sharing_field_colorselect'], 1 ); ?> value='1'> Display icons in social network colors <br/>
	<input type="radio" name='fct_social_sharing_settings[fct_social_sharing_field_colorselect]' <?php checked( $options['fct_social_sharing_field_colorselect'], 2 ); ?> value='2'> Display icons in your own color<br/>
	<?php
}

function fct_social_sharing_field_colordefine_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type="text" name="fct_social_sharing_settings[fct_social_sharing_field_colordefine]" value="<?php echo $options['fct_social_sharing_field_colordefine']; ?>" />
	<p>Enter hex value for your desired color without #. You can find your desired color hex value <a href="http://www.colorpicker.com/" target="_blank">here.</a></p>
	<?php
}

function fct_social_sharing_field_sharetitle_render(  ) { 
	$options = get_option( 'fct_social_sharing_settings' );
	?>
	<input type="text" name="fct_social_sharing_settings[fct_social_sharing_field_sharingtitle]" value="<?php echo $options['fct_social_sharing_field_sharingtitle']; ?>" />
	<?php
}




function fct_social_sharing_field_types_render (  ) {
	$options = get_option('fct_social_sharing_settings_types');
	$types = get_post_types(array('public' => true), 'objects');

	foreach ($types as $type) { ?>
       	<input type="checkbox" name="fct_social_sharing_settings_types[fct_social_sharing_field_types][]" value="<?php echo $type->name; ?>" <?php if (in_array($type->name, $options['fct_social_sharing_field_types'])) { ?> checked="checked"<?php } ?>  /> <?php echo $type->label; ?></label><br/>
        <?php    }  
}


function fct_social_sharing_settings_section_callback(  ) { 
	echo __( 'What social buttons do you want to display?', 'fct-social-sharing' );
}

function fct_social_sharing_settings_section_callback_types(  ) { 
	echo __( 'Which post types do you want to display social buttons on?', 'fct-social-sharing' );
}

function fct_social_sharing_settings_section_callback_positions(  ) { 
	echo __( 'Where on your pages/posts do you want the social buttons to appear?', 'fct-social-sharing' );
}

function fct_social_sharing_settings_section_callback_buttonsize(  ) { 
	echo __( 'Which size of the buttons do you want to display?', 'fct-social-sharing' );
}

function fct_social_sharing_settings_section_callback_colors(  ) { 
	echo __( 'What colors do you want your icons to be, and what share title do you want to display?', 'fct-social-sharing' );
}

function fct_social_sharing_options_page(  ) { 
	?>
	<form action='options.php' method='post'>

		<h2>Factory Social Sharing Buttons</h2>

		<?php
		settings_fields( 'fctSocialPage' );
		do_settings_sections( 'fctSocialPage' );
		submit_button();
		?>

	</form>
	<?php
}

?>
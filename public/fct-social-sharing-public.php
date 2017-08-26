<?php 

// Enqueue styles and scripts in wordpress
function fct_social_sharing_enqueue() {
    wp_enqueue_style( 'fct-social-sharing-style', plugins_url( '/', dirname(__FILE__) ) . 'public/style/style.css' );
    wp_enqueue_script ( 'Font Awesome', 'https://use.fontawesome.com/b9a1bd1970.js' );
}
add_action( 'wp_enqueue_scripts', 'fct_social_sharing_enqueue' );

function detect_mobile( ) {
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	$isitmobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
	return $isitmobile;
}

// Function to display social icons on bottom of the content
function generate_social_icons( $buttons ) {

	// defaults for options fields
	$defaults = array(
        'fct_social_sharing_field_facebook'   => '0',
        'fct_social_sharing_field_twitter'	  => '0',
        'fct_social_sharing_field_gplus'	  => '0',
        'fct_social_sharing_field_pinterest'	  => '0',
        'fct_social_sharing_field_linkedin'	  => '0',
        'fct_social_sharing_field_whatsapp'	  => '0',
        'fct_social_sharing_field_buttonsize'	  => '0',
        'fct_social_sharing_field_colorselect'	  => '0',
        'fct_social_sharing_field_colordefine'	  => '0',
        'fct_social_sharing_field_sharingtitle'	  => '0',
    );

    // Grab option fields from the database with defaults
	$social = wp_parse_args(get_option( 'fct_social_sharing_settings', $defaults ), $defaults);

	$colorselection = $social['fct_social_sharing_field_colorselect'];
	$color = $social['fct_social_sharing_field_colordefine'];
	$pluginurl = plugins_url( '/', dirname(__FILE__) );
	if ( $social['fct_social_sharing_field_sharingtitle'] == '') {
		$sharetitle = 'Share this';
	} else {
		$sharetitle = $social['fct_social_sharing_field_sharingtitle'];
	}

	if ($colorselection == 1) {
		$fbcolor = '3b5998';
		$twcolor = '55acee';
		$gpcolor = 'dd4b39';
		$ptcolor = 'cb2027';
		$licolor = '007bb5';
		$wacolor = '4dc247';
	} else if ($colorselection == 2) {
		$fbcolor = $color;
		$twcolor = $color;
		$gpcolor = $color;
		$ptcolor = $color;
		$licolor = $color;
		$wacolor = $color;
	}

	// Get current page url
	$postlink = get_permalink();
	// Define buttons variable as empty string
	$buttons = '<div class="fctbuttons"><h5 class="fctheading">' . $sharetitle . '</h5>';

	

	$smallicon = 'smallicon';
	$mediumicon = 'mediumicon';
	$largeicon = 'largeicon';

	if ($social["fct_social_sharing_field_buttonsize"] == 1) {
		$iconsize = $smallicon; }
	else if ($social["fct_social_sharing_field_buttonsize"] == 2) {
		$iconsize = $mediumicon; }
	else if ($social["fct_social_sharing_field_buttonsize"] == 3) {
		$iconsize = $largeicon; }

    $facebookshare = '<a class="fctfb" style="color: #' . $fbcolor . ';" href="https://www.facebook.com/sharer/sharer.php?u=' . $postlink . '"><i class="fa fa-facebook-square ' . $iconsize . '" aria-hidden="true"></i></a> ';
    $twittershare = '<a class="fcttw" style="color: #' . $twcolor . ';" href="https://twitter.com/home?status=' . $postlink . '"><i class="fa fa-twitter-square ' . $iconsize . '" aria-hidden="true"></i></a> ';
    $gplusshare = '<a class="fctgp" style="color: #' . $gpcolor . ';" href="https://plus.google.com/share?url=' . $postlink . '"><i class="fa fa-google-plus-square ' . $iconsize . '" aria-hidden="true"></i></a> ';
    $pinterestshare = '<a class="fctpin" style="color: #' . $ptcolor . ';" href="https://pinterest.com/pin/create/button/?url=&media=&description=' . $postlink . '"><i class="fa fa-pinterest-square ' . $iconsize . '" aria-hidden="true"></i></a> ';
 	$linkedinshare = '<a class="fctli" style="color: #' . $licolor . ';" href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=' . $postlink . '"><i class="fa fa-linkedin-square ' . $iconsize . '" aria-hidden="true"></i></a> ';
 	if (detect_mobile()) {
 	$whatsappshare = '<a class="fctwa" style="color: #' . $wacolor . ';" href="whatsapp://send?text=' . $postlink . '"><i class="fa fa-whatsapp ' . $iconsize . '" aria-hidden="true"></i></a>';
 	} else $whatsappshare = '';
 	// Display social icons depending on selection

	if ($social["fct_social_sharing_field_facebook"] == 1) {
		$buttons .= $facebookshare;
	}

	if ($social["fct_social_sharing_field_twitter"] == 1) {
		$buttons .= $twittershare;
	}

	if ($social["fct_social_sharing_field_gplus"] == 1) {
		$buttons .= $gplusshare;
	}

	if ($social["fct_social_sharing_field_pinterest"] == 1) {
		$buttons .= $pinterestshare;
	}

	if ($social["fct_social_sharing_field_linkedin"] == 1) {
		$buttons .= $linkedinshare;
	}

	if ($social["fct_social_sharing_field_whatsapp"] == 1) {
		$buttons .= $whatsappshare;
	}

	$buttons .= '</div>';
	// Return the generated social icons to use in other functions
	return $buttons;
}

// generate shortcode for buttons
function fct_social_buttons_register_shortcode() {
    add_shortcode( 'fct_social', 'generate_social_icons' );
}

// add action for shortcode
add_action( 'init', 'fct_social_buttons_register_shortcode' );

// hook add buttons under 
add_filter( 'the_content', 'display_social_icons_content' );

// Function to display social icons under content
function display_social_icons_content( $buttons ) {

	// Defaults for options fields
	$defaults = array(
	        'fct_social_sharing_field_undercontent'   => '0',
	        'fct_social_sharing_field_undertitle'   => '0',
	        'fct_social_sharing_field_floatleft'	  => '0',
	);

	// Grab option fields from the database with  defaults
	$social = wp_parse_args(get_option( 'fct_social_sharing_settings', $defaults ), $defaults);
	$typeoptions = get_option( 'fct_social_sharing_settings_types' );


	$buttons = generate_social_icons($buttons);
	$content = get_the_content();

	$types = get_post_types(array('public' => true), 'objects');
	
	foreach ($types as $type) {
		if (in_array($type->name, $typeoptions['fct_social_sharing_field_types'])) {
			$posttype = get_post_type();
			if (is_single() || is_page()) {
			if ($posttype == $type->name) {

				if ($social["fct_social_sharing_field_undercontent"] == 1) {
					$content = $content . $buttons ;
				}

				if ($social["fct_social_sharing_field_undertitle"] == 1) {
					$content = $buttons . $content ;
				}
				if(!detect_mobile()) {
					if ($social["fct_social_sharing_field_floatleft"] == 1) {
						$content .= '<div class="fct_social floatleft">' . $buttons ;
					}
				}
				

			}

			}
		}
	}

	return $content;
}
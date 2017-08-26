<?php

/**
 * @link              http://vladirad.azurewebsites.net
 * @since             1.0.0
 * @package           WP Social Sharing Icons
 *
 * @wordpress-plugin
 * Plugin Name:       Factory Social Sharing Buttons
 * Plugin URI:        http://vladirad.azurewebsites.net
 * Description:       Add social sharing buttons to your Wordpress pages or posts
 * Version:           1.0.0
 * Author:            Vladimir Radisic
 * Author URI:        http://vladirad.azurewebsites.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fct-social-sharing
 * Domain Path:       /languages
 * 
 * {Plugin Name} is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *  
 * Factory Social Sharing Buttons is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Factory Social Sharing Buttons. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// Plugin activation function
function fct_social_sharing_activate() {
    flush_rewrite_rules();
}

// Plugin activation hook
register_activation_hook( __FILE__, 'fct_social_sharing_activate' );

// Plugin deactivation function
function pluginprefix_deactivation() {
    flush_rewrite_rules();
}

// Plugin deactivation hook
register_deactivation_hook( __FILE__, 'fct_social_sharing_deactivate' );


// Include the options page and settings

include 'admin/fct-social-sharing-admin.php';

include 'public/fct-social-sharing-public.php';


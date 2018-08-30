<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  '/lib/wp_bootstrap_navwalker.php' // Bootstrap Navigation Walker (not a part of Sage)
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/*
** BEGIN: ACF GOOGLE FONTS Plugin
*/

/* SERVER KEY */
define( 'ACFGFS_API_KEY', 'AIzaSyBtyK_9452X4Ph3t7eqrIvjFiKhcIltMZY' ); // Conflare Temp Key

/* BROWSER KEY */
//define( 'ACFGFS_API_KEY', 'AIzaSyBmaqQqDGvinXQTS0nTGm4A23uiBhfGMWE' ); // Conflare Temp Key

// function wpdocs_extend_http_response_timeout( $timeout ) {
// 	return 30; // seconds default wordpress is 5
// }
// add_filter( 'http_response_timeout', 'wpdocs_http_response_timeout' );

/**
 * Loads the color style choices, specified in ACF Options, into the color style dropdowns
 */
function acf_load_color_style_choices( $field ) {
    $field['choices'] = array();
    if( have_rows('color_styles', 'option') ) {
      $count = 0;
        while( have_rows('color_styles', 'option') ) {
           $count++;
            the_row();
            $value = $count;
            $field['choices'][ $value ] = $value;
        }
    }
    return $field;
}
add_filter('acf/load_field/name=color_style', 'acf_load_color_style_choices');

/**
 * Writes custom CSS file using fields in ACF Options
 */
function generate_options_css() {
    $ss_dir = get_stylesheet_directory() . '/assets/styles/';
    ob_start(); // Capture all output into buffer
    require($ss_dir . 'custom-styles.php'); // Grab the custom-style.php file
    $css = ob_get_clean(); // Store output in a variable, then flush the buffer
    file_put_contents(get_stylesheet_directory() . '/dist/styles/custom-styles.css', $css, LOCK_EX); // Save it as a css file
}
add_action( 'acf/save_post', 'generate_options_css' ); //Parse the output and write the CSS file on post save

/* Convert hexdec color string to rgb(a) string */
function hex2rgba($color, $opacity = false) {

$default = 'rgb(0,0,0)';

//Return default if no color provided
if(empty($color))
       return $default;

//Sanitize $color if "#" is provided
     if ($color[0] == '#' ) {
      $color = substr( $color, 1 );
     }

     //Check if color has 6 or 3 characters and get values
     if (strlen($color) == 6) {
             $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
     } elseif ( strlen( $color ) == 3 ) {
             $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
     } else {
             return $default;
     }

     //Convert hexadec to rgb
     $rgb =  array_map('hexdec', $hex);

     //Check if opacity is set(rgba or rgb)
     if($opacity){
      if(abs($opacity) > 1)
         $opacity = 1.0;
      $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
     } else {
      $output = 'rgb('.implode(",",$rgb).')';
     }

     //Return rgb(a) color string
     return $output;
}

/* Lighten or darken a hex color */
function adjustBrightness($hex, $steps) {
// Steps should be between -255 and 255. Negative = darker, positive = lighter
$steps = max(-255, min(255, $steps));

// Normalize into a six character long hex string
$hex = str_replace('#', '', $hex);
if (strlen($hex) == 3) {
     $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
}

// Split into three parts: R, G and B
$color_parts = str_split($hex, 2);
$return = '#';

foreach ($color_parts as $color) {
     $color   = hexdec($color); // Convert to decimal
     $color   = max(0,min(255,$color + $steps)); // Adjust color
     $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
}

return $return;
}

//Custom CSS Widget
add_action('admin_menu', 'custom_css_hooks');
add_action('save_post', 'save_custom_css');
add_action('wp_head','insert_custom_css');
function custom_css_hooks() {
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'post', 'normal', 'high');
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'page', 'normal', 'high');
	//Custom slug for CPT UI
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'events', 'normal', 'high');
}
function custom_css_input() {
	global $post;
	echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
	echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}
function save_custom_css($post_id) {
	if (!wp_verify_nonce($_POST['custom_css_noncename'], 'custom-css')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$custom_css = $_POST['custom_css'];
	update_post_meta($post_id, '_custom_css', $custom_css);
}
function insert_custom_css() {
	if (is_page() || is_single()){
		if (have_posts()) : while (have_posts()) : the_post();
			echo '<style type="text/css">'.get_post_meta(get_the_ID(), '_custom_css', true).'</style>';
		endwhile; endif;
		rewind_posts();
	}
}
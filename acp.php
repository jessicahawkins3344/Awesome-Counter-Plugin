<?php 

/**
 * Plugin Name: Awesome Counter Plugin
 * Plugin URI: http://wpdarko.com/items/responsive-pricing-table-pro/
 * Description: A responsive, easy and elegant way to present your offer to your visitors. Just create a new pricing table (custom type) and copy-paste the shortcode into your posts/pages. Find help and information on our <a href="http://wpdarko.com/support/">support site</a>. This free version is NOT limited and does not contain any ad. Check out the <a href='http://wpdarko.com/items/responsive-pricing-table-pro/'>PRO version</a> for more great features.
 * Version: 1.0.0
 * Author: Jessica Hawkins
 * Author URI: http://wpdarko.com
 * Text Domain: acp
 * License: GPL2
 */


define('ACP_URL', plugin_dir_url( __FILE__ ));
define('ACP_DIR', plugin_dir_path(__FILE__));

require ACP_DIR . '/class.settings-api.php';

require ACP_DIR . '/acp-options.php'; //

new ACP_Settings_API_Test();

/* Enqueue styles */
add_action( 'wp_enqueue_scripts', 'add_rpt_scripts', 99 );
add_action( 'wp_enqueue_scripts', 'add_counter_styles', 99 );



function add_rpt_scripts() {
	wp_enqueue_script( 'acp-main', plugins_url('assets/js/acp-main.js', __FILE__), ('jquery'));
	wp_enqueue_script( 'countimator', 'https://cdn.rawgit.com/benignware/jquery-countimator/master/dist/js/jquery.countimator.min.js', ('jquery'));
	wp_enqueue_script( 'handlebars', 'https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.3/handlebars.min.js', ('jquery'));
	wp_enqueue_style( 'acp',  plugins_url('assets/css/main.css', __FILE__));
}

function add_counter_styles() {
	wp_enqueue_style( 'counter-css',  plugins_url('counter.php', __FILE__));
}

function register_button( $buttons ) {
   array_push( $buttons, "|", "recent_posts" );
   return $buttons;
}

function add_plugin( $plugin_array ) {
   $plugin_array['recentposts'] = plugins_url( 'assets/js/tiny-editor.js', __FILE__);
   return $plugin_array;
}

function my_recent_posts_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }

}

add_action('init', 'my_recent_posts_button');

// Add Shortcode
function counterShortcode( $atts, $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'title' => 'Description',
			'value' => '20',
			'value_size' => 'auto',
			'title_size' => 'auto',
			'value_color' => '',
			'title_color' => '',
			'class' => '',
			'duration' => '3400',
			'format' => '',
			'icon' => 'fa-heart',
			'icon_size' => '30px',
		),
		$atts,
		'counter'
	);
  
  	$awesome_counter_options = get_option( 'acp_defaults' ); // Array of All Options
$color_title = $awesome_counter_options['color-title']; // Default Title Size
$value_color = $awesome_counter_options['value-color']; // Default Value Size
$value_size = $awesome_counter_options['value-size']; // Default Title Color
$icon_name = $awesome_counter_options['icon-name']; // Default Title Color

  	return '<div class="counter count-number ' . $atts['class'] . '" data-duration="' . $atts['duration'] . '" data-value="' . $atts['value'] .'">' . '<i class="fa ' . $icon_name . ' ' . $atts['icon'] . '" style="line-height:' . $atts['icon_size'] .'; font-size:' . $atts['icon_size'] .';"></i>' . '<span class="counter-count" style=" display: inline-block; color:' . $value_color .'; color:' . $atts['value_color'] .'; line-height:' . $value_size . '; line-height:' . $atts['value_size'] .'; font-size:' . $value_size . '; font-size:' . $atts['value_size'] .';">' . $atts['value'] . '</span>' . '<span>' . $atts['format'] . '</span>' . '<h4 class="count-heading" style="color:' . $color_title . '; color: ' . $atts['title_color'] . '; font-size:' . $title_size . '; font-size: ' . $atts['title_size'] . '; line-height:' . $title_size . '; line-height: ' . $atts['title_size'] . ';">' . $atts['title'] . '</h4>' . '</div>';

}
add_shortcode( 'counter', 'counterShortcode' );
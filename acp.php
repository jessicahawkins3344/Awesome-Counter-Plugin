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


/* Enqueue styles */
add_action( 'wp_enqueue_scripts', 'add_rpt_scripts', 99 );

function add_rpt_scripts() {
	wp_enqueue_script( 'acp-main', plugins_url('assets/js/acp-main.js', __FILE__), ('jquery'));
	wp_enqueue_script( 'countimator', 'https://cdn.rawgit.com/benignware/jquery-countimator/master/dist/js/jquery.countimator.min.js', ('jquery'));
	wp_enqueue_script( 'handlebars', 'https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.3/handlebars.min.js', ('jquery'));
	wp_enqueue_style( 'acp',  plugins_url('assets/css/main.css', __FILE__));
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
			'value_size' => '40px',
			'title_size' => '22px',
			'value_color' => 'inherit',
			'title_color' => 'inherit',
			'class' => '',
			'duration' => '3400',
			'format' => '',
			'icon' => 'fa-heart',
			'icon_size' => '30px',
		),
		$atts,
		'counter'
	);
  
  	return '<div class="counter count-number ' . $atts['class'] . '" data-duration="' . $atts['duration'] . '" data-value="' . $atts['value'] .'">' . '<i class="fa ' . $atts['icon'] . '" style="line-height:' . $atts['icon_size'] .'; font-size:' . $atts['icon_size'] .';"></i>' . '<span class="counter-count" style=" display: inline-block; color:' . $atts['value_color'] .'; line-height:' . $atts['value_size'] .'; font-size:' . $atts['value_size'] .';">' . $atts['value'] . '</span>' . '<span>' . $atts['format'] . '</span>' . '<h4>' . $atts['title'] . '</h4>' . '</div>';

}
add_shortcode( 'counter', 'counterShortcode' );
<?php 

/**
 * Plugin Name: WP Awesome Countimator
 * Plugin URI: http://jsquaredcreative.me
 * Description: Animated Number Countimator Plugin - Create individual jquery counter using shortcodes.
 * Version: 1.0.0
 * Author: Jessica Hawkins
 * Author URI: http://jsquaredcreative.me
 * Text Domain: acp
 * License: GPLv2
 */


define('ACP_URL', plugin_dir_url( __FILE__ ));
define('ACP_DIR', plugin_dir_path(__FILE__));

require ACP_DIR . '/class.settings-api.php';

require ACP_DIR . '/acp-options.php'; //

new ACP_Settings_API_ACP();

/* Enqueue styles */
add_action( 'wp_enqueue_scripts', 'check_font_awesome');
add_action( 'wp_enqueue_scripts', 'check_bootstrap');
add_action( 'wp_enqueue_scripts', 'add_acp_scripts', 99 );

/**
 * Styles & Scripts
 */
function add_acp_scripts() {
    wp_enqueue_script( 'acp-main', plugins_url('assets/js/acp-main.js', __FILE__), ('jquery'));
    wp_enqueue_script( 'countimator', 'https://cdn.rawgit.com/benignware/jquery-countimator/master/dist/js/jquery.countimator.min.js', ('jquery'));
    wp_enqueue_style( 'acp-style',  plugins_url('assets/css/main.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'check_font_awesome', 99999);

function check_font_awesome() {
  global $wp_styles;
  $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
  if ( in_array('font-awesome.css', $srcs) || in_array('font-awesome.min.css', $srcs) || in_array('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', $srcs  ) ) {
  } else {
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  }
}

function check_bootstrap() {
  global $wp_styles;
  $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
  if ( in_array('bootstrap.css', $srcs) || in_array('bootstrap.min.css', $srcs) || in_array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', $srcs  ) || in_array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', $srcs ) ){
  } else {
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  }
}

/**
 * Inline Styles
 */
require ACP_DIR . '/main.php';

/**
 * Admin Styles
 */
add_action('admin_head', 'acp_admin_styles');

function acp_admin_styles() {
  echo '<style>
    form.acp-form h2 { 
            font-size: 36px;
            font-weight: 200;
            line-height: 36px;
            margin-bottom: 5px;
            margin-top: 5px;
            border-bottom: 1px solid #323232;
            padding-bottom: 15px; 
        }

        #acp-defaults p.description {
            margin-top: 0px;
            margin-bottom: 0;
            text-transform: uppercase;
            font-size: 12px;
            font-style: normal;
        }
        form.acp-form { 
            width: 60%;
            background: #fff;
            border-radius: 10px;
            margin-top: 0px;
            padding: 40px;
        }

        form.acp-form .form-table td {
            margin-bottom: 5px;
            padding: 15px 10px 5px;
            line-height: 1.3;
            vertical-align: middle;
        }

        form.acp-form .form-table th {
            text-align: right;
            padding: 20px 10px 20px 0;
            width: 135px;
        }
  </style>';
}

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
            'icon' => 'fa-diamond',
            'icon_size' => '',
            'icon_color' => 'auto',
        ),
        $atts,
        'counter'
    );
  
    $awesome_counter_options = get_option( 'acp_defaults' ); // Array of All Options
    $custom_class = $awesome_counter_options['custom-class']; // Default Title Color

    return '<div class="counter count-number ' . $custom_class . ' ' . $atts['class'] . '" data-duration="' . $atts['duration'] . '" data-value="' . $atts['value'] .'">' . '<i class="counter-icon fa ' . $atts['icon'] . '" style="line-height:' . $atts['icon_size'] .'; font-size:' . $atts['icon_size'] .'; color:' . $atts['icon_color'] .';""></i>' . '<div clas="text-center">' . '<span class="counter-count" style=" display: inline-block; color:' . $atts['value_color'] .'; line-height:' . $atts['value_size'] .'; font-size:' . $atts['value_size'] .';">' . $atts['value'] . '</span>' . '<span class="format" style="line-height:' . $atts['value_size'] .'">' . $atts['format'] . '</span>' . '</div>' . '<span class="count-heading" style="color: ' . $atts['title_color'] . '; font-size:' . $atts['title_size'] . '; line-height: ' . $atts['title_size'] . ';">' . $atts['title'] . '</span>' . '</div>';

}
add_shortcode( 'counter', 'counterShortcode' );


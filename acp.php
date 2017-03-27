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



define('ACP_URL', plugins_url('',__FILE__) );
define('ACP_DIR', plugin_dir_path(__FILE__));
define('ACP_PLUGIN_VERSION', '1.0.0');
define('ACP_PLUGIN_NAME', 'WP Awesome Countimator');

require ACP_DIR . '/class.settings-api.php';

require ACP_DIR . '/acp-options.php';



// Enqueue The Styles
add_action( 'wp_enqueue_scripts', 'acp_add_scripts', 99 );

// Styles & Scripts
function acp_add_scripts() {
    wp_enqueue_script( 'acp-main', plugins_url('assets/js/acp-main.js', __FILE__), ('jquery'));

    wp_enqueue_script( 'acp-countimator', ACP_URL . '/assets/js/jquery.countimator.min.js', ('jquery'));

    wp_enqueue_script( 'acp-handlebars', ACP_URL . '/assets/js/handlebars.min.js', ('jquery'));

    wp_enqueue_style( 'acp-style',  ACP_URL . '/assets/css/main.css' );
}


// Check if Font Awesome is already loaded before loading
add_action('wp_enqueue_scripts', 'acp_check_font_awesome', 98);

/* Check if fontawesome has already been enqued */
function acp_check_font_awesome() {
  global $wp_styles;
  $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
  if ( in_array('font-awesome.css', $srcs) || in_array('font-awesome.min.css', $srcs)  ) {
    /* echo 'font-awesome.css registered'; */
  } else {
    wp_enqueue_style('acp-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  }
}


// Check if bootstrap CSS is already loading before loading
add_action('wp_enqueue_scripts', 'acp_check_bootstrap', 97);

function acp_check_bootstrap() {
  global $wp_styles;

  $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
  if ( in_array('bootstrap.css', $srcs) || in_array('bootstrap.min.css', $srcs)  ) {
    /* echo 'font-awesome.css registered'; */
  } else {
    wp_enqueue_style('acp-bootstrap', ACP_URL . '/assets/css/acp-bootstrap.min.css' );
  }
}


// Inline Styles
require ACP_DIR . '/main.php';

// Admin Styles
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
        .metabox-holder {
            
            margin-top: 25px!important; 
            width: 60%;
            background: #fff;
            border-radius: 10px;
            margin-top: 0px;
            padding: 40px;
        }

        .metabox-holder p.metabox-p {
            font-size: 18px!important;
            font-weight: lighter;
            line-height: 1;
            margin-bottom:
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

        .metabox-holder h4 {
            font-weight: 200;
            margin-top: 0px!important;
            margin-bottom: 3px!important;
            font-size: 22px;
            line-height: 28px;
        }

        .metabox-holder h5 {
            margin-top: 0px!important;
            font-size: 14px;
            line-height: 16px;
            margin-bottom: 10PX;
        }
        form.acp-form .acp-shortcode-text p, form.acp-form .acp-shortcode-text ul li {
                font-style: italic;
                color: #999;
        }
  </style>';
}

// Add Shortcode
function acp_counterShortcode( $atts, $content = null ) {

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
        'counter'// the actual shortcode name
    );
  
    $acp_counter_options = get_option( 'acp_defaults' ); // Array of All Options
    $acp_custom_class = acp_get_option( 'custom-class', 'acp_defaults', '' ); // Custom Class Attribute

    return '<div class="count-wrapper ' . $acp_custom_class . ' ' . $atts['class'] . '">' . '<i class="counter-icon fa ' . $atts['icon'] . '" style="line-height:' . $atts['icon_size'] .'; font-size:' . $atts['icon_size'] .'; color:' . $atts['icon_color'] .';""></i>' . '<h3 class="counter count-number" style=" display: inline-block; color:' . $atts['value_color'] .'; line-height:' . $atts['value_size'] .'; font-size:' . $atts['value_size'] .';">' . $atts['value'] . '</h3>' . '<span class="format" style="line-height:' . $atts['value_size'] .'">' . $atts['format'] . '</span>' . '<span class="count-heading" style="color: ' . $atts['title_color'] . '; font-size:' . $atts['title_size'] . '; line-height: ' . $atts['title_size'] . ';">' . $atts['title'] . '</span>' . '</div>';

}

add_shortcode( 'counter', 'acp_counterShortcode' );


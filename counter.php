<?php

header('Content-type:text/css');
$wp_load = $absolute_path[0] . 'class.settings-api.php';
 require_once($wp_load);

$awesome_counter_options = get_option( 'acp_defaults' ); // Array of All Options
$color_title = $awesome_counter_options['color-title']; // Default Title Size
$default_value_size_1 = $awesome_counter_options['default_value_size_1']; // Default Value Size
$default_title_color_2 = $awesome_counter_options['default_title_color_2']; // Default Title Color
?>

h4.count-heading {
   color: <?php echo $color_title ?>;
}


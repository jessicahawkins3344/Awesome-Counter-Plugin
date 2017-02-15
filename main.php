<?php 

function my_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
    return $options[$option];
    }
 
    return $default;
}


function acp_styles_method() {
	wp_enqueue_style(
		'custom-style',
		get_template_directory_uri() . '/assets/css/main.css'
	);
		$title_color = my_get_option( 'color-title', 'acp_defaults', '' );
		$custom_css .= "span.count-heading { color: {$title_color}; }";

		$title_size = my_get_option( 'title-size', 'acp_defaults', '' );
		$custom_css .= "span.count-heading { font-size: {$title_size}px; line-height: {$title_size}px; }";

		$value_color = my_get_option( 'value-color', 'acp_defaults', '' );
		$custom_css .= "h3.counter.count-number { color: {$title_color}; }";

		$value_size = my_get_option( 'value-size', 'acp_defaults', '' );
		$custom_css .= "h3.counter.count-number { font-size: {$value_size}px; line-height: {$value_size}px; }";

		$value_size = my_get_option( 'value-size', 'acp_defaults', '' );
		$form_size = $value_size / 2.75;
		$custom_css .= "span.format { font-size: {$form_size}px; line-height: {$value_size}px; }";

		$icon_size = my_get_option( 'icon-size', 'acp_defaults', '' );
		$custom_css .= "i.counter-icon { font-size: {$icon_size}px; line-height: {$icon_size}px; }";

		$icon_color = my_get_option( 'icon-color', 'acp_defaults', '' );
		$custom_css .= "i.counter-icon { color: {$icon_color}; }";

		$custom_css = my_get_option( 'custom-css', 'acp_defaults', '' );
		$custom_css .= "{$custom_css}";	

        wp_add_inline_style( 'custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'acp_styles_method' );

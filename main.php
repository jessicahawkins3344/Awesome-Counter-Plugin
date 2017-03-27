<?php 


// Function to retrieve option value
function acp_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
    return $options[$option];
    }
 
    return $default;
}


// Inline Custom Styles from Default Settings
function acp_styles_method() {
	wp_enqueue_style(
		'acp-custom-style',
		ACP_URL . 'assets/css/main.css'
	);
		$custom_css = '';
		$title_color = acp_get_option( 'color-title', 'acp_defaults', '' );
		$custom_css .= "span.count-heading { color: {$title_color}; }";

		$title_size = acp_get_option( 'title-size', 'acp_defaults', '' );
		$custom_css .= "span.count-heading { font-size: {$title_size}; line-height: 1; }";

		$value_color = acp_get_option( 'value-color', 'acp_defaults', '' );
		$custom_css .= "h3.counter.count-number { color: {$value_color}; }";

		$value_size = acp_get_option( 'value-size', 'acp_defaults', '' );
		$custom_css .= "h3.counter.count-number { font-size: {$value_size}; line-height: 1; }; }";

		$value_size = acp_get_option( 'value-size', 'acp_defaults', '' );
		$form_size = $value_size / 2.75;
		$custom_css .= "span.format { font-size: {$form_size}; line-height: {$value_size}; }";

		$icon_size = acp_get_option( 'icon-size', 'acp_defaults', '' );
		$custom_css .= "i.counter-icon { font-size: {$icon_size}; line-height: 1; }";

		$icon_color = acp_get_option( 'icon-color', 'acp_defaults', '' );
		$custom_css .= "i.counter-icon { color: {$icon_color}; }";

		$custom_css_setting = acp_get_option( 'custom-css', 'acp_defaults', '' );
		$custom_css .= "{$custom_css_setting}";	

        wp_add_inline_style( 'acp-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'acp_styles_method' );
<?php

// ACP Settings API Class
if ( !class_exists('ACP_Settings_API_ACP' ) ):
class ACP_Settings_API_ACP {
    private $settings_api;
    function __construct() {
        $this->settings_api = new ACP_Settings_API;
        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->acp_get_settings_sections() );
        $this->settings_api->set_fields( $this->acp_get_settings_fields() );
        //initialize settings
        $this->settings_api->admin_init();
    }


    function admin_menu() {
        //create new top-level menu
        add_menu_page(ACP_PLUGIN_NAME, ACP_PLUGIN_NAME, 'administrator', 'acp_options' , array($this, 'acp_plugin_page'), 'dashicons-editor-kitchensink' );
    }

    function acp_get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'acp_defaults',
                'title' => __( 'WP Awesome Countimator Defaults', 'acp' )
            )
        );
        return $sections;
    }
    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */

    // The Settings
    function acp_get_settings_fields() {
        $settings_fields = array(
            'acp_defaults' => array(
                array(
                    'name'        => 'html',
                    'desc'        => __( 'Default Styles for Counters - can be changed via shortcode.', 'acp' ),
                    'type'        => 'html'
                ),
                array(
                    'name'              => 'title-size',
                    'label'             => __( 'Title Size', 'acp' ),
                    'desc'              => __( 'Title Size, include px, em, %, rem after number', 'acp' ),
                    'placeholder'       => __( 'Title Size in px, em, %, rem, etc.', 'acp' ),
                    'type'              => 'text',
                    'default'           => 'px'
                ),
                array(
                    'name'    => 'color-title',
                    'class'   => 'count-heading',
                    'label'   => __( 'Title Color', 'acp' ),
                    'desc'    => __( 'Title Color Picker', 'acp' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'              => 'value-size',
                    'label'             => __( 'Value Size', 'acp' ),
                    'desc'              => __( 'Value Size in px, em, %, rem, etc.', 'acp' ),
                    'placeholder'       => __( 'Value Size in px, em, %, rem, etc.', 'acp' ),
                    'type'              => 'text',
                    'default'           => '30px'
                ),
                array(
                    'name'    => 'value-color',
                    'label'   => __( 'Value Color', 'acp' ),
                    'desc'    => __( 'Value Color Picker', 'acp' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'              => 'format',
                    'label'             => __( 'Format', 'acp' ),
                    'desc'              => __( 'Format - %, $, /mo, yearly, etc. Leave blank for no format default', 'acp' ),
                    'placeholder'       => __( 'Leave blank for no default', 'acp' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'icon-size',
                    'label'             => __( 'Icon Size', 'acp' ),
                    'desc'              => __( 'Icon Size in px, em, %, rem, etc.', 'acp' ),
                    'placeholder'       => __( 'Icon Size in px, em, %, rem, etc.', 'acp' ),
                    'type'              => 'text',
                    'default'           => '60px'
                ),
                array(
                    'name'    => 'icon-color',
                    'label'   => __( 'Icon Color', 'acp' ),
                    'desc'    => __( 'Icon Color Picker', 'acp' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'              => 'custom-class',
                    'label'             => __( 'Custom Class', 'acp' ),
                    'desc'              => __( 'Add a Custom Class', 'acp' ),
                    'placeholder'       => __( 'example-class', 'acp' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'custom-css',
                    'label'             => __( 'Custom CSS', 'acp' ),
                    'desc'              => __( 'Add Custom CSS', 'acp' ),
                    'placeholder'       => __( 'custom css here', 'acp' ),
                    'type'              => 'textarea',
                    'default'           => ''
                ),
            ),
        );
        return $settings_fields;
    }

    // Get the Settings Page
    function acp_plugin_page() {
        echo '<div class="wrap-acp">';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
        echo '</div>';
    }
    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function acp_get_pages() {
        $pages = acp_get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }
        return $pages_options;
    }
}

endif;

new ACP_Settings_API_ACP();
 
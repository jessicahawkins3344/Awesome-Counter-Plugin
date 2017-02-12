<?php
/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('ACP_Settings_API_Test' ) ):
class ACP_Settings_API_Test {
    private $settings_api;
    function __construct() {
        $this->settings_api = new ACP_Settings_API;
        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }
    function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );
        //initialize settings
        $this->settings_api->admin_init();
    }
    function admin_menu() {
        add_options_page( 'ACP Settings', 'ACP Settings', 'manage_options', 'acp_options', array($this, 'plugin_page') );
    }
    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'acp_defaults',
                'title' => __( 'ACP Defaults', 'acp' )
            )
        );
        return $sections;
    }
    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'acp_defaults' => array(
            	array(
                    'name'        => 'html',
                    'desc'        => __( 'HTML area description. You can use any <strong>bold</strong> or other HTML elements.', 'acp' ),
                    'type'        => 'html'
                ),
                array(
                    'name'              => 'title-size',
                    'label'             => __( 'Title Size', 'acp' ),
                    'desc'              => __( 'Title Size', 'acp' ),
                    'placeholder'       => __( 'Title Size in px', 'acp' ),
                    'type'              => 'text',
                    'default'           => 'px',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'    => 'color-title',
                    'class'   => 'count-heading',
                    'label'   => __( 'Color', 'acp' ),
                    'desc'    => __( 'Color description', 'acp' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'              => 'value-size',
                    'label'             => __( 'Value Size', 'acp' ),
                    'desc'              => __( 'Value Size in em, px, rem', 'acp' ),
                    'placeholder'       => __( 'px', 'acp' ),
                    'type'              => 'text',
                    'default'           => 'px',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'    => 'value-color',
                    'label'   => __( 'Value Color', 'acp' ),
                    'desc'    => __( 'Value Color description', 'acp' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'icon-name',
                    'label'   => __( 'Icon Name', 'acp' ),
                    'desc'    => __( 'Icon Name - fa-diamond', 'acp' ),
                    'type'    => 'text',
                    'default'           => 'fa-diamond',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
            ),
        );
        return $settings_fields;
    }
    function plugin_page() {
        echo '<div class="wrap">';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
        echo '</div>';
    }
    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
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
 
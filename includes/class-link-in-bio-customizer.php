<?php
/**
 * Create section for link in bio settings in customizer.
 *
 * @package link-in-bio
 */

 // Exit if accessed directly.
 if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'LinkInBio_Customizer' ) ) {

	require_once ABSPATH . WPINC . '/class-wp-customize-control.php';

	/**
	 * LinkInBio_Customizer class.
	 */
	class LinkInBio_Customizer {

		/**
		 * Constructing a customizing running lemming.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'register' ) );
		}

		/**
		 * Idxbroker_customize_register function.
		 *
		 * @access public
		 * @param mixed $wp_customize Support Customizer.
		 * @return void
		 */
		function register( $wp_customize ) {

			// Link In Bio Settings Panel.
			$wp_customize->add_panel(
				'linkinbio',
				array(
					'priority'        => 10,
					'capability'      => 'manage_options',
					'theme_supports'  => '',
					'title'           => __( 'Link In Bio Settings', 'linkinbio' ),
					'description'     => __( 'Customize settings for the Link In Bio plugin.', 'linkinbio' ),
				)
			);

			// Landing Page Settings Section.
			$wp_customize->add_section(
				'linkinbio_landing_page_section',
				array(
					'title'       => __( 'Landing Page Settings', 'linkinbio' ),
					//'description' => __( 'Insert code into the header or footer', 'linkinbio' ),
					'priority'    => 30,
					'panel'       => 'linkinbio',
				)
			);

			// Landing Page Image setting.
			$wp_customize->add_setting( 'linkinbio_page_image', array(
				'sanitize_callback' => 'absint',
				'type'              => 'option',
			) );

			// Landing Page Title setting.
			$wp_customize->add_setting(
				'linkinbio_landing_page_caption',
				array(
					'default'   => '',
					'type'      => 'option',
					'transport' => 'refresh',
					'sanitize_callback' => 'wp_kses',
				)
			);

			// Landing Page Title setting.
			$wp_customize->add_setting(
				'linkinbio_landing_page_image_link',
					array(
						'default'   => '',
						'type'      => 'option',
						'transport' => 'refresh',
						'sanitize_callback' => 'esc_url_raw',
				)
			);

			// Landing Page custom slug setting.
			$wp_customize->add_setting(
				'linkinbio_landing_page_custom_slug',
					array(
						'default'   => '',
						'type'      => 'option',
						'transport' => 'refresh',
						'sanitize_callback' => 'sanitize_title_with_dashes',
				)
			);

			// Landing Page custom slug setting.
			$wp_customize->add_setting(
				'linkinbio_landing_page_disable_css',
					array(
						'default'   => 0,
						'type'      => 'option',
						'transport' => 'refresh',
						'sanitize_callback' => 'wp_kses',
				)
			);
 
			// Landing Page Image Control.
			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'linkinbio_page_image', array(
				'label'    => __( 'Landing Page Image', 'infinity-pro' ),
				'section'  => 'linkinbio_landing_page_section',
				'settings' => 'linkinbio_page_image',
				'width' => 150,
				'height' => 150,
				'flex_width' => false,
				'flex_height' => false,
			) ) );

			// Landing Page Image Link.
			$wp_customize->add_control(
				'linkinbio_image_link',
				array(
					'label'       => __( 'Image Link', 'linkinbio' ),
					'description' => __( 'Where you want to landing page image to link to. i.e https://example.com', 'linkinbio' ),
					'type'        => 'text',
					'section'     => 'linkinbio_landing_page_section',
					'settings'    => 'linkinbio_landing_page_image_link',
					'input_attrs' => array(
						'placeholder' => __( 'https://example.com', 'linkinbio' ),
					)
				)
			);

			// Landing Page Title Controls.
			$wp_customize->add_control(
				'linkinbio_page_title',
				array(
					'label'       => __( 'Page Caption', 'linkinbio' ),
					'description' => __( 'A quick caption to be displayed under the landing page image.', 'linkinbio' ),
					'type'        => 'text',
					'section'     => 'linkinbio_landing_page_section',
					'settings'    => 'linkinbio_landing_page_caption',
					'input_attrs' => array(
						'placeholder' => __( 'Tap photo for details', 'linkinbio' ),
					)
				)
			);

			// Landing Page Custom Slug Controls.
			$wp_customize->add_control(
				'linkinbio_page_custom_slug',
				array(
					'label'       => __( 'Custom Slug', 'linkinbio' ),
					'description' => sprintf( __( 'The default landing page url is %s. You can customize this url to anything you like.', 'linkinbio'), site_url('/links/') ),
					'type'        => 'text',
					'section'     => 'linkinbio_landing_page_section',
					'settings'    => 'linkinbio_landing_page_custom_slug',
					'input_attrs' => array(
						'placeholder' => __( 'i.e. instagram', 'linkinbio' ),
					)
				)
			);

			// Landing Page Custom Slug Controls.
			$wp_customize->add_control(
				'linkinbio_page_disable_css',
				array(
					'label'       => __( 'Disable Default CSS?', 'linkinbio' ),
					'description' => __( 'Disable the default plugin CSS in order to add your own custom CSS for the landing page.', 'linkinbio'),
					'type'        => 'checkbox',
					'section'     => 'linkinbio_landing_page_section',
					'settings'    => 'linkinbio_landing_page_disable_css',
				)
			);
			

		}
	}

	new LinkInBio_Customizer();

}

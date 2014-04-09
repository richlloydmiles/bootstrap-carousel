<?php

class BS_Carousel_Admin {

	public function __construct()
	{
		add_action( 'init', array( $this, 'post_type_setup' ) );
	    add_action( 'init', array( $this, 'taxonomy_setup' ) );
	    add_action( 'admin_init', array( $this, 'shortcode_ui' ) );
	    add_action( 'admin_enqueue_scripts', array( $this, 'shortcode_ui_style' ) );
	}

	/**
	 * Register the Team post type
	 */
	public function post_type_setup() 
	{
		$labels = array(
		    'name'               => _x( 'Slides', 'post type general name', 'bs-carousel' ),
		    'singular_name'      => _x( 'Slide', 'post type singular name', 'bs-carousel' ),
		    'add_new'            => _x( 'Add New', 'post type general name', 'bs-carousel' ),
		    'add_new_item'       => __( 'Add New Slide', 'bs-carousel' ),
		    'edit_item'          => __( 'Edit Slide', 'bs-carousel' ),
		    'new_item'           => __( 'New Slide', 'bs-carousel' ),
		    'all_items'          => __( 'All Slides', 'bs-carousel' ),
		    'view_item'          => __( 'View Slide', 'bs-carousel' ),
		    'search_items'       => __( 'Search Slides', 'bs-carousel' ),
		    'not_found'          => __( 'No slides found', 'bs-carousel' ),
		    'not_found_in_trash' => __( 'No slides found in Trash', 'bs-carousel' ),
		    'parent_item_colon'  => __( '', 'bs_carousel' ),
		    'menu_name'          => _x( 'Slides', 'admin menu', 'bs-carousel' )
		);

		$args = array(
		    'labels'             => $labels,
		    'public'             => true,
		    'publicly_queryable' => true,
		    'show_ui'            => true,
		    'show_in_menu'       => true,
		    'menu_icon'			=> 'dashicons-leftright',
		    'query_var'          => true,
		    'rewrite'            => array( 'slug' => 'slide' ),
		    'capability_type'    => 'post',
		    'has_archive'        => false,
		    'hierarchical'       => false,
		    'menu_position'      => null,
		    'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'slide', $args );
	}

	/**
	 * Register the Slide Group taxonomy
	 */
	public function taxonomy_setup()
	{
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Slide Groups', 'taxonomy general name', 'bs-carousel' ),
			'singular_name'     => _x( 'Slide Group', 'taxonomy singular name', 'bs-carousel' ),
			'search_items'      => __( 'Search Slide Groups', 'bs-carousel' ),
			'all_items'         => __( 'All Slide Groups', 'bs-carousel' ),
			'parent_item'       => __( 'Parent Slide Group', 'bs-carousel' ),
			'parent_item_colon' => __( 'Parent Slide Group:', 'bs-carousel' ),
			'edit_item'         => __( 'Edit Slide Group', 'bs-carousel' ),
			'update_item'       => __( 'Update Slide Group', 'bs-carousel' ),
			'add_new_item'      => __( 'Add New Slide Group', 'bs-carousel' ),
			'new_item_name'     => __( 'New Slide Group Name', 'bs-carousel' ),
			'menu_name'         => __( 'Slide Groups', 'bs-carousel' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,			
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'slide-group' ),
		);

		register_taxonomy( 'slide_group', array( 'slide' ), $args );

	}

	/**
	 * Add custom shortcode button to the editor
	 */
	function shortcode_ui() 
	{
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_buttons', array( $this, 'filter_mce_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_plugin' ) );
		}
	}
	
	/**
	 * Add a seperation before the custom editor button
	 */
	function filter_mce_button( $buttons ) 
	{
		// add a separation before our button, here our button's id is "carousel_button"
		array_push( $buttons, '|', 'carousel_button' );
		return $buttons;
	}
	
	/**
	 * Include the custom Tiny MCE carousel shortcode js plugin file
	 */
	function filter_mce_plugin( $plugins ) 
	{
		// this plugin file will work the magic of our button
		$plugins['carousel'] = dirname( plugin_dir_url( __FILE__ ) ) . '/js/mce_carousel_plugin.js';
		return $plugins;
	}

	/**
	 * Enqueue styling for the custom editor button
	 */
	function shortcode_ui_style() 
	{
		wp_enqueue_style( 'tinymce-carousel', dirname( plugin_dir_url( __FILE__ ) ) . '/css/tinymce.css'  );
	}
	
}

$BS_Carousel_Admin = new BS_Carousel_Admin();
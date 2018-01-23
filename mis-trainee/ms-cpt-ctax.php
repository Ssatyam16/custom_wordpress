<?php

// Register MIS Trainee Posttype
function mis_trainee_function() {

	$labels = array(
		'name'                  => _x( 'MIS Trainees', 'Post Type General Name', 'iwm_theme' ),
		'singular_name'         => _x( 'MIS Trainee', 'Post Type Singular Name', 'iwm_theme' ),
		'menu_name'             => __( 'MIS Trainees', 'iwm_theme' ),
		'name_admin_bar'        => __( 'MIS Trainee', 'iwm_theme' ),
		'archives'              => __( 'Trainee Archives', 'iwm_theme' ),
		'attributes'            => __( 'Trainee Attributes', 'iwm_theme' ),
		'parent_item_colon'     => __( 'Parent Trainee:', 'iwm_theme' ),
		'all_items'             => __( 'All Trainees', 'iwm_theme' ),
		'add_new_item'          => __( 'Add New Trainee', 'iwm_theme' ),
		'add_new'               => __( 'Add New', 'iwm_theme' ),
		'new_item'              => __( 'New Trainee', 'iwm_theme' ),
		'edit_item'             => __( 'Edit Trainee', 'iwm_theme' ),
		'update_item'           => __( 'Update Trainee', 'iwm_theme' ),
		'view_item'             => __( 'View Trainee', 'iwm_theme' ),
		'view_items'            => __( 'View Trainees', 'iwm_theme' ),
		'search_items'          => __( 'Search Trainee', 'iwm_theme' ),
		'not_found'             => __( 'Not found', 'iwm_theme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'iwm_theme' ),
		'featured_image'        => __( 'Trainee Image', 'iwm_theme' ),
		'set_featured_image'    => __( 'Set Trainee image', 'iwm_theme' ),
		'remove_featured_image' => __( 'Remove Trainee image', 'iwm_theme' ),
		'use_featured_image'    => __( 'Use as Trainee image', 'iwm_theme' ),
		'insert_into_item'      => __( 'Insert into Trainee', 'iwm_theme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Trainee', 'iwm_theme' ),
		'items_list'            => __( 'Trainees list', 'iwm_theme' ),
		'items_list_navigation' => __( 'Trainees list navigation', 'iwm_theme' ),
		'filter_items_list'     => __( 'Filter Trainees list', 'iwm_theme' ),
	);
	$args = array(
		'label'                 => __( 'MIS Trainee', 'iwm_theme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', ),
		'taxonomies'            => array( 'financial_year', 'state_center_trade_batch' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-users',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'mis_trainee', $args );

}
add_action( 'init', 'mis_trainee_function', 0 );

// Register Financial Years, Batches Taxonomy
function financial_year_batch_function() {

	$labels = array(
		'name'                       => _x( 'Financial Years', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Financial Year', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Financial Year', 'text_domain' ),
		'all_items'                  => __( 'All Financial Years', 'text_domain' ),
		'parent_item'                => __( 'Parent Financial Year', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Financial Year:', 'text_domain' ),
		'new_item_name'              => __( 'New Financial Year Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Financial Year', 'text_domain' ),
		'edit_item'                  => __( 'Edit Financial Year', 'text_domain' ),
		'update_item'                => __( 'Update Financial Year', 'text_domain' ),
		'view_item'                  => __( 'View Financial Year', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Financial Years with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Financial Years', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Financial Years', 'text_domain' ),
		'search_items'               => __( 'Search Financial Years', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Financial Years', 'text_domain' ),
		'items_list'                 => __( 'Financial Years list', 'text_domain' ),
		'items_list_navigation'      => __( 'Financial Years list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
	);
	register_taxonomy( 'financial_year', array( 'mis_trainee' ), $args );

}
add_action( 'init', 'financial_year_batch_function', 0 );

// Register States, Centers, Trades Taxonomy
function state_center_trade_function() {

	$labels = array(
		'name'                       => _x( 'States, Centers, Trades, Batches', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'State, Center, Trade, Batch', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'State, Center, Trade, Batch', 'text_domain' ),
		'all_items'                  => __( 'All States, Centers, Trades, Batches', 'text_domain' ),
		'parent_item'                => __( 'Parent State, Center, Trade, Batch', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent State, Center, Trade, Batch:', 'text_domain' ),
		'new_item_name'              => __( 'New State, Center, Trade, Batch Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New State, Center, Trade, Batch', 'text_domain' ),
		'edit_item'                  => __( 'Edit State, Center, Trade, Batch', 'text_domain' ),
		'update_item'                => __( 'Update State, Center, Trade, Batch', 'text_domain' ),
		'view_item'                  => __( 'View State, Center, Trade, Batch', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate States, Centers, Trades, Batches with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove States, Centers, Trades, Batches', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular States, Centers, Trades, Batches', 'text_domain' ),
		'search_items'               => __( 'Search States, Centers, Trades, Batches', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No States, Centers, Trades, Batches', 'text_domain' ),
		'items_list'                 => __( 'States, Centers, Trades, Batches list', 'text_domain' ),
		'items_list_navigation'      => __( 'States, Centers, Trades, Batches list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
	);
	register_taxonomy( 'state_center_trade_batch', array( 'mis_trainee' ), $args );

}
add_action( 'init', 'state_center_trade_function', 0 );


function trainee_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'mis_trainee' == $screen->post_type ) {
          $title = 'Enter Trainee Name';
     }
  
     return $title;
}
  
add_filter( 'enter_title_here', 'trainee_change_title_text' );
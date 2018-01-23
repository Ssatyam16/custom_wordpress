<?php

 /**
 * Plugin Name: IWM Detail Post Plugin
 * Plugin URI: http://satyamsagar.com
 * Description: This plugin adds all the deatils regarding a person.
 * Version: 1.0.0
 * Author: Satyam Sagar
 * Author URI: http://satyamsagar.com
 */



  /* CUSTOM POST TYPE FOR DETAILS */

  // Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Details', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Detail', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Details', 'text_domain' ),
		'name_admin_bar'        => __( 'Details', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Trainee Name', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Detail', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title','thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-users',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'additional_info', $args );

}
add_action( 'init', 'custom_post_type', 0 );



/* CUSTOM META BOX */



// Add the Testimonial Meta Boxes
function add_testimonial_metaboxes() {
 add_meta_box('iwm_testimonial_details', 'Additional Information', 'iwm_testimonial_details', 'additional_info', 'normal', 'default');
}
add_action( 'add_meta_boxes', 'add_testimonial_metaboxes' );




// The Testimonials Metabox
function iwm_testimonial_details() {
 global $post;



 
 // Noncename needed to verify where the data originated
 echo '<input type="hidden" name="testimeta_noncename" id="testimeta_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
  
 // Get the location data if its already been entered
 $location = get_post_meta($post->ID, '_location', true); 
 // Echo out the field
 echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="_location">Status of Trainee:</label></p><input type="text" name="_location" id="_location" value="' . $location  . '" class="widefat" />';


// radio button



   // Get the location data if its already been entered
  $gender = get_post_meta($post->ID, 'gender', true); 
 // Echo out the field
/*   echo '  <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="gender">Gender:</label></p>
    <input type="radio" name="gender" value="male", <?php checked( $gender, "male" ); ?>Male </br> 
    <input type="radio" name="gender" value="female", <?php checked( $gender, "female" ); ?> FeMale  '; */


echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="gender">Gender:</label></p>
<select name="gender" id="gender" class="widefat">  
        <option value="Male" <?php selected( $gender, "Male" ); ?>Male</option>  
        <option value="Female" <?php selected( $gender, "Female" ); ?>Female</option>
    </select>';


$community = get_post_meta($post->ID, '_community', true);

echo' <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="_community">Community:</label></p>
      <select name="_community" id="_community">
            <option value="muslim" <?php selected( $selected, "muslim" ); ?>Muslim</option>
            <option value="christians" <?php selected( $selected, "christians" ); ?>Christians</option>
            <option value="" <?php selected( $selected, "" ); ?>Christians</option>
        </select> ';


  // Get the location data if its already been entered
 $parent = get_post_meta($post->ID, '_parent', true); 
 // Echo out the field
 echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="_parent">Son/Daughter/Wife Of:</label><input type="text" name="_parent" id="_parent" value="' . $parent  . '" class="widefat" />';

 // Get the location data if its already been entered
 $description = get_post_meta($post->ID, '_description', true); 
 // Echo out the field
 echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="_description">Address:</label></p><textarea name="_description" id="_description" class="widefat">' . $description  . '</textarea><div class="dt_hr dt_hr-bottom"></div>';




 
}

// Save the Metabox Data

function wpt_save_testimonial_meta($post_id, $post) {
 
 // verify this came from the our screen and with proper authorization,
 // because save_post can be triggered at other times
 if ( !wp_verify_nonce( $_POST['testimeta_noncename'], plugin_basename(__FILE__) )) {
 return $post->ID;
 }

 // Is the user allowed to edit the post or page?
 if ( !current_user_can( 'edit_post', $post->ID ))
  return $post->ID;

 // OK, we're authenticated: we need to find and save the data
 // We'll put it into an array to make it easier to loop though.
 $events_meta['_description'] = $_POST['_description']; 
 $events_meta['_location'] = $_POST['_location'];
 $events_meta['_parent'] = $_POST['_parent'];
 $events_meta['gender'] = $_POST['gender']; 
 $events_meta['_community'] = $_POST['_community'];

 
 // Add values of $events_meta as custom fields
 foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
  if( $post->post_type == 'revision' ) return; // Don't store custom data twice
  $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
  if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
   update_post_meta($post->ID, $key, $value);
  } else { // If the custom field doesn't have a value
   add_post_meta($post->ID, $key, $value);
  }
  if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
 }
}

add_action('save_post', 'wpt_save_testimonial_meta', 1, 2); // save the custom fields





// Register Custom Financial Year Taxonomy 

function financial_year_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Financial Years', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Financial Year', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Financial Years', 'text_domain' ),
		'all_items'                  => __( 'All Financial Years', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Financial Years', 'text_domain' ),
		'add_new_item'               => __( 'Add New Financial Year', 'text_domain' ),
		'edit_item'                  => __( 'Edit', 'text_domain' ),
		'update_item'                => __( 'Update', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Financial Years', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'financial-year', array( 'additional_info' ), $args );

}
add_action( 'init', 'financial_year_taxonomy', 0 );

?>
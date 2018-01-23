<?php

// Add the MIS Trainee Meta Boxes
function add_mis_trainee_metaboxes() {
	add_meta_box('mis_trainee_details', 'MIS Trainee Details', 'mis_trainee_details', 'mis_trainee', 'normal', 'default');
}
add_action( 'add_meta_boxes', 'add_mis_trainee_metaboxes' );

// The MIS Trainee Metabox
function mis_trainee_details() {
	global $post;
	
	wp_nonce_field( 'mis_trainee_meta_box', 'mis_trainee_meta_box_nonce' );

	// Get the data if its already been entered
	$gender = get_post_meta($post->ID, 'gender', true);
	$community = get_post_meta($post->ID, 'community', true);
	$sdw = get_post_meta($post->ID, 'sdw', true);
	$address = get_post_meta($post->ID, 'address', true);
	$status = get_post_meta($post->ID, 'status', true);
?>	

	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="gender">Gender:</label></p>
<select name="gender" id="gender" class="widefat">  
        <option value="Male" <?php selected( $gender, 'Male' ); ?>>Male</option>  
        <option value="Female" <?php selected( $gender, 'Female' ); ?>>Female</option>  
    </select> 
<div class="dt_hr dt_hr-bottom"></div>

	<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="community">Community Name:</label></p>
<select name="community" id="community" class="widefat">  
        <option value="Muslims" <?php selected( $community, 'Muslims' ); ?>>Muslims</option>
        <option value="Christians" <?php selected( $community, 'Christians' ); ?>>Christians</option>
        <option value="Sikhs" <?php selected( $community, 'Sikhs' ); ?>>Sikhs</option>
        <option value="Buddhist" <?php selected( $community, 'Buddhist' ); ?>>Buddhist</option>
        <option value="Parsis" <?php selected( $community, 'Parsis' ); ?>>Parsis</option>
        <option value="Jains" <?php selected( $community, 'Jains' ); ?>>Jains</option>
        <option value="Non-minority Others" <?php selected( $community, 'Non-minority Others' ); ?>>Non-minority Others</option>
    </select> 
<div class="dt_hr dt_hr-bottom"></div>

<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="sdw">Son/Daughter/Wife Of:</label><input type="text" name="sdw" id="sdw" value="<?php echo $sdw; ?>" class="widefat" />

<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="address">Address:</label><input type="text" name="address" id="address" value="<?php echo $address; ?>" class="widefat" />

<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="status">Status of Trainee:</label><input type="text" name="status" id="status" value="<?php echo $status; ?>" class="widefat" />

<?php
}

// Save the Metabox Data

function wpt_save_mis_trainee_meta($post_id, $post) {
	
	if ( ! isset( $_POST['mis_trainee_meta_box_nonce'] ) ) {
        	return;
    	}

	if ( !wp_verify_nonce( $_POST['mis_trainee_meta_box_nonce'], 'mis_trainee_meta_box' ) ) {
                return;
        }

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	$trainee_meta['gender'] = $_POST['gender'];
	$trainee_meta['community'] = $_POST['community'];
	$trainee_meta['address'] = $_POST['address'];
	$trainee_meta['sdw'] = $_POST['sdw'];
	$trainee_meta['status'] = $_POST['status'];
	
	// Add values of $events_meta as custom fields
	foreach ($trainee_meta as $key => $value) { // Cycle through the $events_meta array!
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

add_action('save_post', 'wpt_save_mis_trainee_meta', 1, 2); // save the custom fields
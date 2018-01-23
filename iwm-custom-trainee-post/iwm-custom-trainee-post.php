<?php

/**
 * Plugin Name: IWM Detail Post Plugin
 * Plugin URI: http://satyamsagar.com
 * Description: This plugin adds all the deatils regarding a person.
 * Version: 1.0.0
 * Author: Satyam Sagar
 * Author URI: http://satyamsagar.com
 */


/* CUSTOM POST TYPE */

// Register MIS Trainee Posttype
function mis_trainee_function() {

	$labels = array(
		'name'                  => _x( 'MIS Trainees', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'MIS Trainee', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'MIS Trainees', 'text_domain' ),
		'name_admin_bar'        => __( 'MIS Trainee', 'text_domain' ),
		'archives'              => __( 'Trainee Archives', 'text_domain' ),
		'attributes'            => __( 'Trainee Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Trainee:', 'text_domain' ),
		'all_items'             => __( 'All Trainees', 'text_domain' ),
		'add_new_item'          => __( 'Add New Trainee', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Trainee', 'text_domain' ),
		'edit_item'             => __( 'Edit Trainee', 'text_domain' ),
		'update_item'           => __( 'Update Trainee', 'text_domain' ),
		'view_item'             => __( 'View Trainee', 'text_domain' ),
		'view_items'            => __( 'View Trainees', 'text_domain' ),
		'search_items'          => __( 'Search Trainee', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Trainee Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set Trainee image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Trainee image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Trainee image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Trainee', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Trainee', 'text_domain' ),
		'items_list'            => __( 'Trainees list', 'text_domain' ),
		'items_list_navigation' => __( 'Trainees list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Trainees list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'MIS Trainee', 'text_domain' ),
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




add_action( 'vc_before_init', 'mis_trainee_list_function' );


function mis_trainee_list_function() {
   vc_map( array(
      "name" => __( "MIS Trainee List with Filter", "text_domain" ),
      "base" => "trainee_list_with_filter",
      "class" => "",
      "icon" => plugins_url('student.png',__FILE__ ),
      "category" => __( "Content", "text_domain"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "save_always" => true,
            "heading" => __( "Filter", "text_domain" ),
            "param_name" => "filter",
            "value" => __( "Yes", "text_domain" ),
            "description" => __( "Yes or No.", "text_domain" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "save_always" => true,
            "heading" => __( "Trainee List per Page", "text_domain" ),
            "param_name" => "list_count",
            "value" => __( "20", "text_domain" ),
            "description" => __( "No of trainees show in a page.", "text_domain" )
         )
      	)
    ) );
}

function kriesi_pagination($pages = '', $range = 2, $extraurl = '')
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
$html = '';
     if(1 != $pages)
     {
         $html .= "<tr class='pagination'><td colspan='11'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) $html .= "<a href='".get_pagenum_link(1)."?$extraurl'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) $html .= "<a href='".get_pagenum_link($paged - 1)."?$extraurl'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 $html .= ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."?$extraurl' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) $html .= "<a href='".get_pagenum_link($paged + 1)."?$extraurl'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $html .= "<a href='".get_pagenum_link($pages)."?$extraurl'>&raquo;</a>";
         $html .= "</td></tr>\n";
     }
     return $html;
}

// Add Shortcode

add_shortcode ( "trainee_list_with_filter", "trainee_filter_listing_function" );


function  ( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'filter' => 'Yes',
			'list_count' => '20',
		), $atts,
		'trainee_list_with_filter'
	);

	$financial_year = $state = $center = $trade = $batch = $community = $gender = '';
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	if(isset($_REQUEST['btnSubmit'])) {
		$financial_year = $_REQUEST['financial_year'] ? $_REQUEST['financial_year'] : "";
		$state 		= $_REQUEST['state'] ? $_REQUEST['state'] : "";
		$center 	= $_REQUEST['center'] ? $_REQUEST['center'] : "";
		$trade 		= $_REQUEST['trade'] ? $_REQUEST['trade'] : "";
		$batch 		= $_REQUEST['batch'] ? $_REQUEST['batch'] : "";
		$community 	= $_REQUEST['community'] ? $_REQUEST['community'] : "";
		$gender 	= $_REQUEST['gender'] ? $_REQUEST['gender'] : "";
	}

	$html = '';

	if($atts['filter'] == 'Yes') {
		$html .= '<form action="'.get_permalink().'" method="POST" id="filter_form">';

		//Financial Year Filter
		$finance_args = ['taxonomy' => 'financial_year', 'parent' => 0, 'hide_empty' => false];
		$financeterms = get_terms( $finance_args );
		$html .= '<div class="filter_control">
			<label for="financial_year">Financial Year *</label>
			<select name="financial_year" id="financial_year" class="filter-dropdown" required><option value="0">--Select--</option>';
		foreach ( $financeterms as $financechild ) {
		       $html .= '<option value="'.$financechild->term_id.'" '.selected( $financial_year, $financechild->term_id, false ).'>' . $financechild->name . '</option>';
		}
		$html .= '</select><span class="error">Please select financial year</span></div>';

		//State Filter
		$state_args = ['taxonomy' => 'state_center_trade_batch', 'parent' => 0, 'hide_empty' => false];
		$stateterms = get_terms( $state_args );
		$html .= '<div class="filter_control">
			<label for="state">State</label>
			<select name="state" id="state" class="filter-dropdown"><option value="0">--All--</option>';
		foreach ( $stateterms as $statechild ) {
		       $html .= '<option value="'.$statechild->term_id.'" '.selected( $state, $statechild->term_id, false ).'>' . $statechild->name . '</option>';
		}
		$html .= '</select></div>';

		//Center Filter
		$center_args = ['taxonomy' => 'state_center_trade_batch', 'parent' => $state, 'hide_empty' => false];
		$centerterms = get_terms( $center_args );
		$html .= '<div class="filter_control">
			<label for="center">Center</label>
			<select name="center" id="center" class="filter-dropdown"><option value="0">--All--</option>';
		if($state){
		   foreach ( $centerterms as $centerchild ) {
		       $html .= '<option value="'.$centerchild->term_id.'" '.selected( $center, $centerchild->term_id, false ).'>' . $centerchild->name . '</option>';
		   }
		}
		$html .= '</select></div>';

		//Trade Filter
		$trade_args = ['taxonomy' => 'state_center_trade_batch', 'parent' => $center, 'hide_empty' => false];
		$tradeterms = get_terms( $trade_args );
		$html .= '<div class="filter_control">
			<label for="trade">Trade</label>
			<select name="trade" id="trade" class="filter-dropdown"><option value="0">--All--</option>';
		if($center){
		   foreach ( $tradeterms as $tradechild ) {
		       $html .= '<option value="'.$tradechild->term_id.'" '.selected( $trade, $tradechild->term_id, false ).'>' . $tradechild->name . '</option>';
		   }
		}
		$html .= '</select></div>';

		//Batch Filter
		$batch_args = ['taxonomy' => 'state_center_trade_batch', 'parent' => $trade, 'hide_empty' => false];
		$batchterms = get_terms( $batch_args );
		$html .= '<div class="filter_control">
			<label for="batch">Batch</label>
			<select name="batch" id="batch" class="filter-dropdown"><option value="0">--All--</option>';
		if($trade){
		   foreach ( $batchterms as $batchchild ) {
		       $html .= '<option value="'.$batchchild->term_id.'" '.selected( $batch, $batchchild->term_id, false ).'>' . $batchchild->name . '</option>';
		   }
		}
		$html .= '</select></div>';

		//Community Name Filter
		$html .= '<div class="filter_control">
			<label for="community">Community Name</label>
			<select name="community" id="community" class="filter-dropdown">
				<option value="0">--All--</option>
			        <option value="Muslims" '. selected( $community, 'Muslims', false ).'>Muslims</option>
			        <option value="Christians" '. selected( $community, 'Christians', false ).'>Christians</option>
			        <option value="Sikhs" '. selected( $community, 'Sikhs', false ).'>Sikhs</option>
			        <option value="Buddhist" '. selected( $community, 'Buddhist', false ).'>Buddhist</option>
			        <option value="Parsis" '.selected( $community, 'Parsis', false ).'>Parsis</option>
			        <option value="Jains" '.selected( $community, 'Jains', false ).'>Jains</option>
			        <option value="Non-minority Others" '.selected( $community, 'Non-minority Others', false ).'>Non-minority Others</option>
			</select></div>';

		//Gender Filter
		$html .= '<div class="filter_control">
			<label for="gender">Gender</label>
			<select name="gender" id="gender" class="filter-dropdown">
				<option value="0">--All--</option>
				<option value="Male" '.selected( $gender, 'Male', false ).'>Male</option>
				<option value="Female" '.selected( $gender, 'Female', false ).'>Female</option>
			</select></div>';

		$html .= '<input type="hidden" name="trainees" value="0" id="show_trainees"><input type="submit" name="btnSubmit" value="search"><input type="button" name="search" value="Search">';

		$html .= "</form>";
	}

    if($_REQUEST['trainees']) {
	$meta_query = array('relation' => 'AND');
	if($community) {
		$meta_query[] = array(
			'key'     => 'community',
			'value'   => $community,
                        'compare' => '=',
		);
	}
	if($gender) {
		$meta_query[] = array(
			'key'     => 'gender',
			'value'   => $gender,
                        'compare' => '=',
		);
	}

	$state_center_trade_batch = array();
	if($state) {$state_center_trade_batch[] = $state;}
	if($center) {$state_center_trade_batch[] = $center;}
	if($trade) {$state_center_trade_batch[] = $trade;}
	if($batch) {$state_center_trade_batch[] = $batch;}

	$tax_query = array('relation' => 'AND');
	if($financial_year) {
		$tax_query[] = array(
			'taxonomy' => 'financial_year',
			'field'    => 'id',
			'terms'    => $financial_year,
		);
	}

	$state_center_trade_batch = array_filter($state_center_trade_batch);
	if(!empty($state_center_trade_batch)) {
		$tax_query[] = array(
			'taxonomy' => 'state_center_trade_batch',
			'field'    => 'id',
			'terms'    => $state_center_trade_batch,
			'operator' => 'AND',
			'include_children' => false,
		);
	}
	$extraurl = 'financial_year='.$financial_year.'&state='.$state.'&center='.$center.'&trade='.$trade.'&batch='.$batch.'&community='.$community.'&gender='.$gender.'&trainees=yes&btnSubmit=search';

	$args = array('post_type' => array( 'mis_trainee' ),'post_status' => array( 'any' ), 'paged' => $paged, 'posts_per_page' => $atts['list_count'],'order' => 'DESC','orderby' => 'date','meta_query' => $meta_query, 'tax_query' => $tax_query,);

	$query = new WP_Query( $args );
        $html .= '<div class="table-responsive"><table class="table"><thead>
                        <tr>
                                <th>SN.</th>
                                <th>Trade Name</th>
                                <th>Trainee Name</th>
                                <th>Trainee Photo</th>
                                <th>Gender</th>
                                <th>Son / Daughter / Wife Of</th>
                                <th>Community</th>
                                <th>Address</th>
                                <th>Center</th>
                                <th width="100">Batch</th>
                                <th width="100">Status</th>
                        </tr>
                </thead><tbody>';
	if ( $query->have_posts() ) {
        $count = ($paged-1)*10+1;
		while ( $query->have_posts() ) {
			$query->the_post();
			$photo = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : '<img src="https://placeholdit.imgix.net/~text?txtsize=50&bg=eee&txtclr=000&txt=MIS+Trainee+Photo&w=250&h=250&txttrack=0">';
			$financial_year = get_the_terms( get_the_ID(), 'financial_year' );
			$term_args = array('orderby' => 'term_order', 'order' => 'DESC', 'fields' => 'all');
			$state = wp_get_post_terms( get_the_ID(), 'state_center_trade_batch', $term_args );
			$gender = get_post_meta(get_the_ID(), 'gender', true);
			$community = get_post_meta(get_the_ID(), 'community', true);
			$sdw = get_post_meta(get_the_ID(), 'sdw', true);
			$address = get_post_meta(get_the_ID(), 'address', true);
			$status = get_post_meta(get_the_ID(), 'status', true);

			$html .= '<tr>
			        <td>'.$count.'.</td>
        			<td>'.$state[2]->name.'</td>
	        		<td>'.get_the_title().'</td>
		        	<td>'.$photo.'</td>
			        <td>'.$gender.'</td>
			        <td>'.$community.'</td>
			        <td>'.$sdw.'</td>
			        <td>'.$address.'</td>
			        <td>'.$state[1]->name.'</td>
        			<td>'.$state[3]->name.'</td>
			        <td>'.$status.'</td>
			</tr>';
                        $count++;
		}
		$html .= kriesi_pagination($query->max_num_pages, 3,$extraurl);
	} else {
		$html .= '<tr><td colspan="11">No Trainee Found</td></tr>';
	}
        $html .= '</tbody></table></div>';
    }
    $html .= '<script>jQuery("#state,#center,#trade").on("change",function(){var $form=jQuery(this).closest("form");$form.find("input[type=submit]").click();});
jQuery("input[type=button]").click(function(){if(jQuery("#financial_year option:selected").text() != "--Select--"){jQuery("#show_trainees").val("yes");var $form=jQuery(this).closest("form");$form.find("input[type=submit]").click();}else{jQuery(".error").show();}});</script>';

    wp_reset_postdata();
    return $html;

}
?>

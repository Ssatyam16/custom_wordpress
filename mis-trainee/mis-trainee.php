<?php
/* 
Plugin Name: MIS Trainee Plugin
Description:
Plugin URI:
Plugin Author: 
Author URI: 
Version: 1.0
*/

include( plugin_dir_path( __FILE__ ) . 'mis-cpt-ctax.php');
include( plugin_dir_path( __FILE__ ) . 'mis-cf.php');

add_action( 'vc_before_init', 'mis_trainee_list_function' );

function mis_trainee_list_function() {
   vc_map( array(
      "name" => __( "MIS Trainee List with Filter", "iwm-theme" ),
      "base" => "trainee_list_with_filter",
      "class" => "",
      "icon" => plugins_url('student.png',__FILE__ ),
      "category" => __( "Content", "iwm-theme"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "save_always" => true,
            "heading" => __( "Filter", "iwm_theme" ),
            "param_name" => "filter",
            "value" => __( "Yes", "iwm_theme" ),
            "description" => __( "Yes or No.", "iwm_theme" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "save_always" => true,
            "heading" => __( "Trainee List per Page", "iwm_theme" ),
            "param_name" => "list_count",
            "value" => __( "20", "iwm_theme" ),
            "description" => __( "No of trainees show in a page.", "iwm_theme" )
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

add_shortcode( 'trainee_list_with_filter', 'trainee_filter_listing_function' );


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
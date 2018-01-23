<?php

/**
*
* Plugin Name: IWM Member Box
* Description: Create the Member information box.
* Plugin URI: 
* Plugin Author: SATYAM SAGAR
* Author URI: 
* Version: 1.0
*
*/


add_action( 'vc_before_init', 'vc_custom_field_function' );

function vc_custom_field_function() {
   vc_map( array(
      "name" => __( "Member Info Box", "" ),
      "base" => "my_base_function",
      "class" => "",
      "category" => __( "Content", ""),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "save_always" => true,
            "heading" => __( "Member Name", "" ),
            "param_name" => "member_name",
            "value" => __( "", "" ),
            "description" => __( "Enter the name of the member.", "" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "save_always" => true,
            "heading" => __( "Member Post", ""),
            "param_name" => "member_post",
            "value" => __( "", "" ),
            "description" => __( "Enter the post of member.", "" )
         ),
          array(
              "type" => "attach_image",
              "holder" => "div",
              "class" => "",
              "save_always" => true,
              "heading" => __( "Member Image", "" ),
              "param_name" => "member_image",
              "value" => __("",""),
              "description" => __("Enter the Featured image", "")
          )
      )
   ) );
}


add_shortcode('my_base_function', 'iwm_field_function');

function iwm_field_function($atts) {

$atts = shortcode_atts(
		array(

			'member_name' => '',
			'member_post' => '',
			'member_image' => '',
		), $atts,
		'my_base_function'
	);

$html .='';
     $image = $atts['member_image'];
     $image_attributes = wp_get_attachment_image_src($image, 'medium');
$html .= '<div class="member-box">';
$html .= '<div class="member-image"><img src="'. $image_attributes[0] .'"></div>';
$html .='<div class="box-description">';
$html .= '<p class="member-name">'. $atts['member_name'] .'</p>';
$html .= '<p class="member-post">'. $atts['member_post'] .'</p>';
$html .= '</div>';
$html .= '</div>';
echo $html;

}



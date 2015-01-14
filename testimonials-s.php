<?php
/*
Plugin Name: sTestimonials
Plugin URI: https://github.com/systemo-biz/testimonials-s
Description: Testimonials by Systemo for WordPress
Version: 0.1
License: GPL
Author: Systemo
Author URI: http://systemo.biz
*/


add_action('init', 'cptui_register_my_cpt_testimonial');
function cptui_register_my_cpt_testimonial() {
register_post_type('testimonial', array(
'label' => 'Отзывы',
'description' => '',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => false,
'rewrite' => array('slug' => 'testimonials', 'with_front' => 1),
'query_var' => true,
'has_archive' => true,
'supports' => array('title','editor','custom-fields','revisions','thumbnail','author','post-formats'),
'taxonomies' => array('post_tag'),
'labels' => array (
  'name' => 'Отзывы',
  'singular_name' => 'Отзыв',
  'menu_name' => 'Отзывы',
  'add_new' => 'Add Отзыв',
  'add_new_item' => 'Add New Отзыв',
  'edit' => 'Edit',
  'edit_item' => 'Edit Отзыв',
  'new_item' => 'New Отзыв',
  'view' => 'View Отзыв',
  'view_item' => 'View Отзыв',
  'search_items' => 'Search Отзывы',
  'not_found' => 'No Отзывы Found',
  'not_found_in_trash' => 'No Отзывы Found in Trash',
  'parent' => 'Parent Отзыв',
)
) ); }



add_action('init', 'cptui_register_my_taxes_testimonials_category');
function cptui_register_my_taxes_testimonials_category() {
register_taxonomy( 'testimonials-category',array (
  0 => 'testimonial',
),
array( 'hierarchical' => false,
	'label' => 'Категории отзывов',
	'show_ui' => true,
	'query_var' => true,
	'show_admin_column' => false,
	'labels' => array (
  'search_items' => 'Категория отзывов',
  'popular_items' => '',
  'all_items' => '',
  'parent_item' => '',
  'parent_item_colon' => '',
  'edit_item' => '',
  'update_item' => '',
  'add_new_item' => '',
  'new_item_name' => '',
  'separate_items_with_commas' => '',
  'add_or_remove_items' => '',
  'choose_from_most_used' => '',
)
) ); 
}

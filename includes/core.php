<?php

/**
 * Core Testimonials by Systemo
 */
class TestimonialsSystemo
{

  function __construct()
  {


    add_action('init', array($this, 'model_cpt'));
    add_action('init', array($this, 'model_taxonomy'));

    add_action( 'add_meta_boxes', array($this, 'meta_boxes_s') );
    add_action('save_post', array($this, 'save_box_data_s'));


  }



  //добавляем метабокс
  function meta_boxes_s() {
  	add_meta_box('truediv', 'Данные отзыва', array($this, 'print_box_s'), 'testimonial', 'normal', 'high');
  }


   /*
   * Заполнение
   */
  function print_box_s($post) {
  	wp_nonce_field( basename( __FILE__ ), 'testimonial_metabox_nonce' );
  	?>
      <div id="testimonial_meta_wrapper">
          <div>
              <label for="testimonial_author_s">Автор отзыва</label>
          </div>
          <div>
              <input type="text" id="testimonial_author_s" name="sf_testimonial_cite" value="<?php echo get_post_meta($post->ID, 'sf_testimonial_cite',true) ?>" />
          </div>
      </div>
      <?php
  }

  /*
   *  Сохранение
   */
  function save_box_data_s ( $post_id ) {
  	// проверяем, пришёл ли запрос со страницы с метабоксом
  	if ( !isset( $_POST['testimonial_metabox_nonce'] ) || !wp_verify_nonce( $_POST['testimonial_metabox_nonce'], basename( __FILE__ ) ) ) return $post_id;

      // проверяем, является ли запрос автосохранением
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

      // проверяем, права пользователя, может ли он редактировать записи
  	if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;

      update_post_meta($post_id, 'sf_testimonial_cite', esc_attr($_POST['sf_testimonial_cite']));
  	return $post_id;
  }


  function model_cpt() {
      $labels = array(
  		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'testimonials-s' ),
  		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'testimonials-s' ),
  		'menu_name'             => __( 'Testimonials', 'testimonials-s' ),
  		'name_admin_bar'        => __( 'Testimonial', 'testimonials-s' ),
  		'archives'              => __( 'Item Testimonial', 'testimonials-s' ),
  		'parent_item_colon'     => __( 'Parent Item:', 'testimonials-s' ),
  		'all_items'             => __( 'All Items', 'testimonials-s' ),
  		'add_new_item'          => __( 'Add New Item', 'testimonials-s' ),
  		'add_new'               => __( 'Add New', 'testimonials-s' ),
  		'new_item'              => __( 'New Item', 'testimonials-s' ),
  		'edit_item'             => __( 'Edit Item', 'testimonials-s' ),
  		'update_item'           => __( 'Update Item', 'testimonials-s' ),
  		'view_item'             => __( 'View Item', 'testimonials-s' ),
  		'search_items'          => __( 'Search Item', 'testimonials-s' ),
  		'not_found'             => __( 'Not found', 'testimonials-s' ),
  		'not_found_in_trash'    => __( 'Not found in Trash', 'testimonials-s' ),
  		'featured_image'        => __( 'Featured Image', 'testimonials-s' ),
  		'set_featured_image'    => __( 'Set featured image', 'testimonials-s' ),
  		'remove_featured_image' => __( 'Remove featured image', 'testimonials-s' ),
  		'use_featured_image'    => __( 'Use as featured image', 'testimonials-s' ),
  		'insert_into_item'      => __( 'Insert into item', 'testimonials-s' ),
  		'uploaded_to_this_item' => __( 'Uploaded to this item', 'testimonials-s' ),
  		'items_list'            => __( 'Items list', 'testimonials-s' ),
  		'items_list_navigation' => __( 'Items list navigation', 'testimonials-s' ),
  		'filter_items_list'     => __( 'Filter items list', 'testimonials-s' ),
  	);
  	$args = array(
  		'label'                 => __( 'Testimonial', 'testimonials-s' ),
  		'description'           => __( 'Testimonials for WordPress', 'testimonials-s' ),
  		'labels'                => $labels,
  		'supports'              => array( ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 5,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => true,
  		'can_export'            => true,
  		'has_archive'           => true,
  		'exclude_from_search'   => false,
  		'publicly_queryable'    => true,
  		'capability_type'       => 'page',
  	);
  	register_post_type( 'testimonial', $args );
  }



  function model_taxonomy(){

    $labels = array(
  		'name'                       => _x( 'Testimonials', 'Taxonomy General Name', 'testimonials-s' ),
  		'singular_name'              => _x( 'Testimonial', 'Taxonomy Singular Name', 'testimonials-s' ),
  		'menu_name'                  => __( 'Taxonomy', 'testimonials-s' ),
  		'all_items'                  => __( 'All Items', 'testimonials-s' ),
  		'parent_item'                => __( 'Parent Item', 'testimonials-s' ),
  		'parent_item_colon'          => __( 'Parent Item:', 'testimonials-s' ),
  		'new_item_name'              => __( 'New Item Name', 'testimonials-s' ),
  		'add_new_item'               => __( 'Add New', 'testimonials-s' ),
  		'edit_item'                  => __( 'Edit Item', 'testimonials-s' ),
  		'update_item'                => __( 'Update Item', 'testimonials-s' ),
  		'view_item'                  => __( 'View Item', 'testimonials-s' ),
  		'separate_items_with_commas' => __( 'Separate items with commas', 'testimonials-s' ),
  		'add_or_remove_items'        => __( 'Add or remove items', 'testimonials-s' ),
  		'choose_from_most_used'      => __( 'Choose from the most used', 'testimonials-s' ),
  		'popular_items'              => __( 'Popular Items', 'testimonials-s' ),
  		'search_items'               => __( 'Search Items', 'testimonials-s' ),
  		'not_found'                  => __( 'Not Found', 'testimonials-s' ),
  		'no_terms'                   => __( 'No items', 'testimonials-s' ),
  		'items_list'                 => __( 'Items list', 'testimonials-s' ),
  		'items_list_navigation'      => __( 'Items list navigation', 'testimonials-s' ),
  	);
  	$args = array(
  		'labels'                     => $labels,
  		'hierarchical'               => false,
  		'public'                     => true,
  		'show_ui'                    => true,
  		'show_admin_column'          => true,
  		'show_in_nav_menus'          => true,
  		'show_tagcloud'              => true,
  	);
  	register_taxonomy( 'testimonials-category', array( 'testimonial' ), $args );

}



}
$TheTestimonialsSystemo = new TestimonialsSystemo;

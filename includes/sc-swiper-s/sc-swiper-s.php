<?php
/*
Plugin Name: Swiper posts shortcode
Description: [posts_swiper] - shortcode for posts lists
Version: 0.1
License: GPL
Author: Systemo
Author URI: http://systemo.biz
*/

function posts_swiper_callback($attr) {
    extract( shortcode_atts( array(
        'post_type'         => 'testimonial',
        'numberposts'    => 5,
        'offset'                => 0,
        'category'        => '',
        'orderby'         => 'rand',
        'order'           => 'DESC',
        'post_status'     => 'publish'

     ), $atts ) );
    
    ob_start();
    ?>
    <div class="swiper_wrapper_s">
         <div class="swiper_box_s">
             <div class="pagination"></div>
            <div class="swiper-container">
              <div class="swiper-wrapper">
                  <?php 
                    $posts = get_posts(array(
                        'post_type'       => 'testimonial',
                        'numberposts'     => $numberposts,
                        'offset'          => $offset,
                        'category'        => $category,
                        'orderby'         => $orderby,
                        'order'           => $order,
                        'post_status'     => $post_status,
                    ));
                  ?>
                    <?php foreach($posts as $post): setup_postdata($post); ?>
                        <div class="swiper-slide">
                            <blockquote>
                              <p><?php echo $post->post_content; ?></p>
                              <footer><?php echo get_post_meta($post->ID, 'sf_testimonial_cite', true); ?></footer>
                            </blockquote>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
              </div>
            </div>
          </div>
          <script>
              jQuery(document).ready(function($) {
                  var sSwiper = new Swiper('.swiper-container',{
                    pagination: '.pagination',
                    loop:true,
                    grabCursor: true,
                    autoplay: 2000, 
                    paginationClickable: true
                  })
                  //sSwiper.startAutoplay();
              });
        </script>
    </div>

    <?php
    $html = ob_get_contents();
    ob_get_clean();

 return $html;
}
add_shortcode('testimonials_swiper_s', 'posts_swiper_callback');

function posts_swiper_register_ss(){
    wp_register_script( 'swiper', plugins_url( '/swiper/dist/idangerous.swiper.min.js',__FILE__ ), array('jquery'), '2.7.5', 'all');
	wp_enqueue_script('swiper');
    
    wp_register_style( 'swiper', plugins_url( '/swiper/dist/idangerous.swiper.css',__FILE__ ), array(), '2.7.5', 'all' );
	wp_enqueue_style('swiper');

    wp_register_style( 'swiper-1', plugins_url( '/style.css',__FILE__ ), array('swiper'), '20150117', 'all' );
	wp_enqueue_style('swiper-1');
}
add_action('wp_enqueue_scripts', 'posts_swiper_register_ss');

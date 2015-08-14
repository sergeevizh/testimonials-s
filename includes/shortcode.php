<?php

//Testimonials shortcode swiper
class Testimonials_SC_Singleton {
private static $_instance = null;
private function __construct() {
  add_shortcode('testimonials', array($this, 'testimonials_sc_callback'));
  add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts_cb'));
  add_action('wp_head', array($this, 'hook_css'));
}

  function wp_enqueue_scripts_cb(){
    wp_register_style( 'swiper', plugin_dir_url(__FILE__).'swiper/dist/css/swiper.min.css', '', $ver = '3.1.0', $media = 'all' );
    wp_register_script( 'swiper', plugin_dir_url(__FILE__).'swiper/dist/js/swiper.jquery.min.js', array('jquery'), $ver = '3.1.0' );
    wp_enqueue_style( 'swiper' );
    wp_enqueue_script( 'swiper' );

  }


  function testimonials_sc_callback($atts) {

    extract( shortcode_atts( array(
        'post_type'       => 'testimonial',
        'numberposts'     => 7,
      	'offset'          => 0,
      	'category'        => '',
      	'orderby'         => 'post_date',
      	'order'           => 'DESC',
      	'include'         => '',
      	'exclude'         => '',
      	'meta_key'        => '',
      	'meta_value'      => '',
      	'post_parent'     => '',
      	'post_status'     => 'publish',
        'slides_per_view' => 5,
        'size'            => 'thumbnail',
        'show_title'      => '',
        'url'             => '',
        'space_between'   => 15,

  	 ), $atts ) );

     $posts = get_posts(array(
       'post_type'       => $post_type,
       'numberposts'     => $numberposts,
       'offset'          => $offset,
       'category'        => $category,
       'orderby'         => $orderby,
       'order'           => $order,
       'include'         => $include,
       'exclude'         => $exclude,
       'meta_key'        => $meta_key,
       'meta_value'      => $meta_value,
       'post_parent'     => $post_parent,
       'post_status'     => $post_status,
     ));


     ob_start();

     ?>
     <div class="testimonials-sc-wrapper">
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <?php
              foreach($posts as $post):
              setup_postdata($post);
              $cite = get_post_meta( $post->ID, $key = 'sf_testimonial_cite', $single = true );
            ?>
              <div class="swiper-slide">
                <div>
                  <blockquote>
                    <?php echo $post->post_content; ?>
                  </blockquote>
                  <cite title="<?php echo $cite ?>"><?php echo $cite ?></cite>
                </div>
              </div>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
          <!-- Add Pagination -->
          <div class="swiper-pagination"></div>
        </div>

        <!-- Initialize Swiper -->
        <script>
          jQuery(document).ready(function($) {

            var swiper = new Swiper('.testimonials-sc-wrapper .swiper-container', {
                slidesPerView: 1,
                spaceBetween:  33,
                pagination: '.testimonials-sc-wrapper .swiper-pagination',
                paginationClickable: true,
                autoplay: 3333,
                autoplayDisableOnInteraction: true,
                loop: true,
                direction: 'vertical',
                //mousewheelControl: true,
            });
          });
        </script>
     </div>
     <?php

     $html = ob_get_contents();
     ob_get_clean();

     return $html;
  }

function hook_css(){


    ?>
      <style id="testimonials-sc-css">

        .testimonials-sc-wrapper {
          height: 200px;
        }



        .testimonials-sc-wrapper .swiper-container {
            width: 100%;
            height: 100%;
        }

        .testimonials-sc-wrapper .swiper-slide {
            !min-height: 100px;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

      </style>
    <?php

}

protected function __clone() {
	// ограничивает клонирование объекта
}
static public function getInstance() {
	if(is_null(self::$_instance))
	{
	self::$_instance = new self();
	}
	return self::$_instance;
}
} $TheTestimonials_SC = Testimonials_SC_Singleton::getInstance();

<?php


class MetaTestimonialSingleton {
	private static $_instance = null;
	private function __construct() {
        add_action( 'admin_menu', array($this, 'meta_boxes_s') );
        add_action('save_post', array($this, 'save_box_data_s'));    
    }
    
//добавляем метабокс
function meta_boxes_s() {
	add_meta_box('truediv', 'Данные', array($this, 'print_box_s'), 'testimonial', 'normal', 'high');
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
} $MetaTestimonial = MetaTestimonialSingleton::getInstance();
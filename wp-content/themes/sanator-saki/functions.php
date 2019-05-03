<?php @ob_start();?>
<?php
/*
Theme Name: Sanatorium Saki
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************НАСТРОЙКИ ТЕМЫ*****************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
function mk_scripts(){
	wp_register_style( 'awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false, '4.4.0' );
	wp_enqueue_style( 'awesome' );
	
	wp_register_style( 'roboto', 'https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic', false, '' );
	wp_enqueue_style( 'roboto' );
	
	wp_register_style( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', false, '3.5.7' );
	wp_enqueue_style( 'fancybox' );
	
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap' );
	
	wp_register_style( 'responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css');
	wp_enqueue_style( 'responsive' );
	
	wp_register_style( 'mmenu', get_template_directory_uri() . '/css/mmenu.css');
	wp_enqueue_style( 'mmenu' );
	
	wp_register_style( 'carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
	wp_enqueue_style( 'carousel' );
	
	wp_register_style( 'custom', get_template_directory_uri() . '/css/custom.css'); 
	wp_enqueue_style( 'custom' );
	

	if (!is_admin()) {
		wp_enqueue_script( 'jquery-min', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', '', '', true );
		wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', '', '', true );
		wp_enqueue_script( 'mmenu-min', get_template_directory_uri() . '/js/mmenu.js', '', '', true );
		wp_enqueue_script( 'carousel-min', get_template_directory_uri() . '/js/owl.carousel.min.js', '', '', true );
		wp_enqueue_script( 'custom-min', get_template_directory_uri() . '/js/custom.js', '', '', true );
		wp_enqueue_script( 'fancybox-min', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', '', '', true );
	}
}
add_action( 'wp_enqueue_scripts', 'mk_scripts' );

//Регистрируем название сайта
function mkvadrat_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ug' ), max( $paged, $page ) );
	}

	if ( is_404() ) {
        $title = '404';
    }

	return $title;
}
add_filter( 'wp_title', 'mkvadrat_wp_title', 10, 2 );

//Регистрируем меню
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array(
		  'main_menu'   => 'Главное меню',
		  'frst_menu'   => 'Блок 1',
		  'scnd_menu'   => 'Блок 2',
		)
	);
}

//Регистрируем sidebar
function register_my_widgets(){
	register_sidebar( array(
		'name' => "Виджет меню для страниц",
		'id' => 'menu-page',
		'description' => 'Меню будет показано на страницах в правой колонке сайта',
		'before_widget' => '<div id="%1$s" class="sidebar__menu %2$s">', // по умолчанию виджеты выводятся <li>-списком
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => "Виджет формы бронирования для страниц",
		'id' => 'travelline-page',
		'description' => 'Форма бронирования будет показана на страницах в правой колонке сайта',
		'before_widget' => '<div id="%1$s" class="booking__block %2$s">', // по умолчанию виджеты выводятся <li>-списком
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => "Виджет баннера для страниц",
		'id' => 'banner-page',
		'description' => 'Виджет баннера будет показан на страницах в правой колонке сайта',
		'before_widget' => '<div id="%1$s" class="banner__sidebar %2$s">', // по умолчанию виджеты выводятся <li>-списком
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	) );
}
add_action( 'widgets_init', 'register_my_widgets' );

//Изображение в шапке сайта
$args = array(
	'width'         => 255,
	'height'        => 120,
	'default-image' => get_template_directory_uri() . '/img/sanatorii-saki-logo.jpg',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

//Добавление в тему миниатюры записи и страницы
if ( function_exists( 'add_theme_support' ) ) {
     add_theme_support( 'post-thumbnails' );
}

//Отключить редактор
add_filter('use_block_editor_for_post', '__return_false');

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*********************************************************************РАБОТА С METAПОЛЯМИ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод данных из произвольных полей для всех страниц сайта
function getMeta($meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s ORDER BY meta_id DESC LIMIT 1", $meta_key) );
	
	return $value;
}

//Вывод изображения для плагина nextgen-gallery
function getNextGallery($post_id, $meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta AS pm JOIN $wpdb->posts AS p ON (pm.post_id = p.ID) AND (pm.post_id = %s) AND meta_key = %s ORDER BY pm.post_id DESC LIMIT 1", $post_id, $meta_key) );
	
	$unserialize_value = unserialize($value);
	
	return $unserialize_value;	
}

//Вывод связанных данных для single.php
function getRelatedMeta($post_id, $meta_key){
	global $wpdb;
	
	$value = array();

	$serialized_object = $wpdb->get_results( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %s AND meta_key = %s", $post_id, $meta_key) );
	
	$unserialized_object = unserialize($serialized_object[0]->meta_value);
	
	if($unserialized_object){
		foreach($unserialized_object as $post_id){
			$value[] = get_post( $post_id );
		}
	}
	
	return $value;
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************МЕНЮ САЙТА*********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
// Добавляем свой класс для пунктов меню:
class header_menu extends Walker_Nav_Menu {
	// Добавляем классы к вложенным ul
	function start_lvl( &$output, $depth ) {
		// Глубина вложенных ul
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			''
			);
		$class_names = implode( ' ', $classes );
		// build html
		if($depth == 0){
			$output .= "\n" . $indent . '<ul class="sub-menu">' . "\n";
		}else if($depth == 1){
			$output .= "\n" . $indent . '<ul class="sub-menu">' . "\n";
		}else if($depth >= 2){
			$output .= "\n" . $indent . '<ul class="sub-menu">' . "\n";
		}
	}

	// Добавляем классы к вложенным li
	function start_el( &$output, $item, $depth, $args ) {
		global $wpdb;
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'has-sub' : '' ),
			( $depth >=2 ? '' : '' ),
			( $depth % 2 ? '' : '' ),
			'menu-item-depth-' . $depth
		);

		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$mycurrent = ( $item->current == 1 ) ? ' active' : '';

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		$output .= $indent . '<li class="menu-item hasSubMenu">';

		// Добавляем атрибуты и классы к элементу a (ссылки)
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
		$attributes .= ' class="menu-link ' . ( $depth == 0 ? 'parent' : '' ) . ( $depth == 1 ? 'child' : '' ) . ( $depth >= 2 ? 'sub-child' : '' ) . '"';

		if($depth == 0){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;
		
			$title = apply_filters( 'the_title', $item->title, $item->ID );
			
			$actual_http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
			
			if(!empty($has_children)){
				if(!empty($item->classes[0])){
					$item_output = '<a class="' . $item->classes[0] . '" href="'. $link .'">' . $title .' </a>';
				}else{
					$item_output = '<a href="'. $link .'">' . $title .' </a>';
				}
			}else{
				if(!empty($item->classes[0])){
					$item_output = '<a class="' . $item->classes[0] . '" href="'. $link .'"></a>';
				}else{
					$item_output = '<a href="'. $link .'">' . $title .' </a>';
				}
			}
		}else if($depth == 1){
			$has_children = $wpdb->get_results( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = %s AND meta_key = '_menu_item_menu_item_parent'", $item->ID), ARRAY_A);

			$link  =  $item->url;

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			if(!empty($has_children)){
				$item_output = '<a href="'. $link .'">' . $title .' </a>';
			}else{
				$item_output = '<a href="'. $link .'">' . $title .'</a>';
			}
		}else if($depth >= 2){
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}
		// build html

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
********************************************************************РАЗДЕЛ "МАГАЗИН" В АДМИНКЕ*************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод в админке раздела
function register_post_type_app() {
	$labels = array(
	 'name' => 'Номера',
	 'singular_name' => 'Номера',
	 'add_new' => 'Добавить номер',
	 'add_new_item' => 'Добавить новый номер',
	 'edit_item' => 'Редактировать номер',
	 'new_item' => 'Новые номера',
	 'all_items' => 'Все номера',
	 'view_item' => 'Просмотр номера на сайте',
	 'search_items' => 'Искать номер',
	 'not_found' => 'Номер не найдена.',
	 'not_found_in_trash' => 'В корзине нет номеров.',
	 'menu_name' => 'Номера'
	 );
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-building',
		'menu_position' => 8,
		'supports' => array( 'title','editor', 'thumbnail' ),
	);
 	register_post_type('rooms', $args);
}
add_action( 'init', 'register_post_type_app' );

function true_post_type_app( $rooms ) {
	global $post, $post_ID;

	$rooms['rooms'] = array(
			0 => '',
			1 => sprintf( 'Статьи обновлены. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
			2 => 'Статья обновлёна.',
			3 => 'Статья удалёна.',
			4 => 'Статья обновлена.',
			5 => isset($_GET['revision']) ? sprintf( 'Статья восстановлена из редакции: %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( 'Статья опубликована на сайте. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
			7 => 'Статья сохранена.',
			8 => sprintf( 'Отправлена на проверку. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( 'Запланирована на публикацию: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Просмотр</a>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( 'Черновик обновлён. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $rooms;
}
add_filter( 'post_updated_messages', 'true_post_type_app' );
	
function create_taxonomies_app(){
    // Cats Categories
    register_taxonomy('rooms-list',array('rooms'),array(
        'hierarchical' => true,
        'label' => 'Рубрики',
        'singular_name' => 'Рубрика',
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'rooms-list' )
    ));
}
add_action( 'init', 'create_taxonomies_app', 0 );




/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************FAQ****************************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
function faq_register(){
	$labels = array(
		'name' => _x('FAQ', 'post type general name','codeless'),
		'singular_name' => _x('Статья faq', 'post type singular name', 'codeless'),
		'add_new' => _x('Добавить статью', 'faq', 'codeless'),
		'add_new_item' => __('Добавить новую статью', 'codeless'),
		'edit_item' => __('Редактировать статью', 'codeless'),
		'new_item' => __('Новая статья', 'codeless'),
		'view_item' => __('Просмотр статей на сайте', 'codeless'),
		'search_items' => __('Искать статью', 'codeless'),
		'not_found' =>  __('Статья не найден.', 'codeless'),
		'not_found_in_trash' => __('В корзине нет статьи.', 'codeless'), 
		'parent_item_colon' => ''
	);
	
	$slugRule = "faq";

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),
		'query_var' => true,
		'show_in_nav_menus'=> false,
		'supports' => array('title','thumbnail','editor')
	);

	register_post_type( 'faq' , $args );

	register_taxonomy("faq_entries", 
		array("faq"), 
		array(	"hierarchical" => true, 
		"label" => "Рубрики", 
		"singular_label" => "Рубрика", 
		"rewrite" => true,
		"query_var" => true
	));  
}
add_action('init', 'faq_register', 4);

function prod_edit_faq_columns($columns){
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Title",
		"faq_entries" => "Categories"
	);

	$columns= array_merge($newcolumns, $columns);

	return $columns;
}
add_filter("manage_edit-faq_columns", "prod_edit_faq_columns");

function prod_custom_faq_columns($column){
	global $post;
	switch ($column){
		case "description":
		break;
		case "price":
		break;
		case "faq_entries":
		echo get_the_term_list($post->ID, 'faq_entries', '', ', ','');
		break;
	}
}
add_action("manage_posts_custom_column",  "prod_custom_faq_columns");

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*********************************************************************ШОРТКОДЫ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод страниц из родительской 
function my_list_child_pages() { 
	global $post;
	if ( is_page() && $post->post_parent ){
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	}else{
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	}
	if ( $childpages ) {
		$string = '<ul>' . $childpages . '</ul>';
	}
	return $string;
}
add_shortcode('my_childpages', 'my_list_child_pages');

function getFaqs($atts){
	$output = '';
	
	$atts = shortcode_atts( array(
		'faq_cat' => '',
		'style'   => '',   
	), $atts );
		
		$output = '<div class="">';

        if($atts['faq_cat'] == 0){
            $args = array(
                'taxonomy'  => 'faq_entries',
                'hide_empty'=> 0
            );

            $categories = get_categories($args);
             
            if(count($categories) > 0){
                $output .='<!-- Portfolio Filter --><nav id="faq-filter" class="">';
                   $output .= '<ul class="">';
                     $output .= '<li class="active all"><a href="#"  data-filter="*">'.__('View All', 'codeless').'</a><span></span></li>';
                        
                    foreach($categories as $cat):
                        
                           $output .= '<li class="other"><a href="#" data-filter=".'.esc_attr($cat->category_nicename).'">'.esc_attr($cat->cat_name).'</a><span></span></li>';    
                        
                    endforeach;
                    
                    $output .='</ul>';
                $output .= '</nav>';
           }
        }
       $nr = rand(0, 5000);
       
    $output .= '<div class="accordion faq '.esc_attr($atts['style']).'" id="accordion'.esc_attr($nr).'">';
       if((int) $atts['faq_cat'] == 0)
            $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'faq' );                          
        else{
            $query_post = array('posts_per_page'=> 9999, 
                                'post_type'=> 'faq',
                                'tax_query' => array(   array(  'taxonomy'  => 'faq_entries', 
                                                                                    'field'     => 'id', 
                                                                                    'terms'     => (int) $atts['faq_cat'],  
                                                                                    'operator'  => 'IN')) );
        }
	$i = 0;
       $loop = new WP_Query($query_post);
       if($loop->have_posts()){
            while($loop->have_posts()){
                $i++;
                $loop->the_post();
                $sort_classes = "";
                $item_categories = get_the_terms( get_the_ID(), 'faq_entries' );
            
                if(is_object($item_categories) || is_array($item_categories))
                {
                    foreach ($item_categories as $cat)
                    {
                        $sort_classes .= $cat->slug.' ';
                    }
                }
                    $output .= '<div class="accordion-group '.esc_attr($sort_classes).'">';
                        $output .= '<div class="accordion-heading '.( ($i == 1)?'in_head':'' ).'">';
                        $id = rand(0, 50000);
                            $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.esc_attr($nr).'" href="#toggle'.esc_attr($id).'">';
                                $output .= get_the_title();
                            $output .= '</a>';
                        $output .= '</div>';
                        $output .= '<div id="toggle'.esc_attr($id).'" class="accordion-body '.( ($i == 1)?'in':'' ).' collapse ">';
                            $output .= '<div class="accordion-inner">';
                                $output .= get_the_content();
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
            }

        }
        $output .= '</div>';
        
        $output .= '</div>';
        echo $output;
}
add_shortcode('faq', 'getFaqs');



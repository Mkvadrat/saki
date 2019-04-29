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
/*function mk_scripts(){
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
  wp_enqueue_style( 'bootstrap' );
	
	wp_register_style( 'roboto', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false, '4.4.0' );
	wp_enqueue_style( 'roboto' );

	wp_register_style( 'reset', get_template_directory_uri() . '/css/reset.css');
  wp_enqueue_style( 'reset' );
	
	wp_register_style( 'fonts', get_template_directory_uri() . '/css/fonts.css');
  wp_enqueue_style( 'fonts' );
	
	wp_register_style( 'styles', get_template_directory_uri() . '/css/styles.css');
  wp_enqueue_style( 'styles' );
	
	wp_register_style( 'media', get_template_directory_uri() . '/css/media.css');
  wp_enqueue_style( 'media' );
	
	wp_register_style( 'owl-default', get_template_directory_uri() . '/css/owl.carousel.min.css'); 
  wp_enqueue_style( 'owl-default' );
	
	wp_register_style( 'owl-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css');
  wp_enqueue_style( 'owl-theme' );
	
	wp_register_style( 'fancybox', get_template_directory_uri() . '/js/source/jquery.fancybox.css');
  wp_enqueue_style( 'fancybox' );
	
	wp_register_style( 'fancybox-buttons', get_template_directory_uri() . '/js/source/helpers/jquery.fancybox-buttons.css');
  wp_enqueue_style( 'fancybox-buttons' );
	
	wp_register_style( 'fancybox-thumbs', get_template_directory_uri() . '/js/source/helpers/jquery.fancybox-thumbs.css');
  wp_enqueue_style( 'fancybox-thumbs' );
	
	wp_register_style( 'sweetalert', get_template_directory_uri() . '/css/sweetalert.css');
  wp_enqueue_style( 'sweetalert' );
	
	if (!is_admin()) {
		wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/jquery-2.1.1.min.js', '', '2.1.1', true );
		wp_enqueue_script( 'flip', get_template_directory_uri() . '/js/jquery.flip.min.js', '', '5.0.3', true );
		wp_enqueue_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.min.js', '', '', true );
		wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/source/jquery.fancybox.pack.js', '', '', true );
		wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel-3.0.6.pack.js', '', '', true );
		wp_enqueue_script( 'fancybox-buttons', get_template_directory_uri() . '/js/source/helpers/jquery.fancybox-buttons.js', '', '', true );
		wp_enqueue_script( 'fancybox-media', get_template_directory_uri() . '/js/source/helpers/jquery.fancybox-media.js', '', '', true );
		wp_enqueue_script( 'fancybox-thumbs', get_template_directory_uri() . '/js/source/helpers/jquery.fancybox-thumbs.js', '', '', true );
		wp_enqueue_script( 'sweetalert', get_template_directory_uri() . '/js/sweetalert.min.js', '', '', true );
		wp_enqueue_script( 'common-file', get_template_directory_uri() . '/js/common.js', '', '', true );
	}
}
add_action( 'wp_enqueue_scripts', 'mk_scripts' );*/

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
		)
	);
}

//Изображение в шапке сайта
$args = array(
  'default-image' => get_template_directory_uri() . '/images/logo.png',
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

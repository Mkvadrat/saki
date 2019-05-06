<?php
/*
Theme Name: Sanatorium Saki
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <title><?php echo mkvadrat_wp_title('','|', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <?php wp_head(); ?>
</head>
<body>

<div id="page">
    <div id="header">
        <div class="header__block">
            <div class="header__container max__wrap">
                <div class="header__col header__address">
                    <?php echo getMeta('address_header_main_page'); ?>
                </div>
                <div class="header__col header__logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img
                          src="<?php header_image(); ?>"
                          height="<?php echo get_custom_header()->height; ?>"
                          width="<?php echo get_custom_header()->width; ?>"
                          alt="logotype"
                        />
                    </a>
                </div>
                <div class="header__col header__call">
                    <?php echo getMeta('contact_header_main_page'); ?>
                </div>
            </div>
        </div>
        <a class="mmenu" href="#menu"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;Меню</a>
        <div class="booking__block">
            <?php echo getMeta('travelline_header_main_page'); ?>
        </div>
        
        <?php if( is_front_page() ) { ?>
        <div class="main-slider">
            <div id="slider-overlay">
                <div class="widget slider-menu">
                    <div class="slider-menu-container">
                        <?php echo getMeta('slider_text_block_header_main_page'); ?>
                    </div>
                </div>
            </div>
            <div class="slider">
                <div class="owl-carousel">
                    <?php
                        global $nggdb;
                        $gallery_id = getNextGallery(4, 'slider_header_main_page');
                        $gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
                        if($gallery_image){
                            foreach($gallery_image as $image) { 
                        ?>
                            <div>
                                <img src="<?php echo nextgen_esc_url($image->imageURL); ?>" alt="">
                            </div>
                        <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>
        
        <nav id="menu">
            <?php
                if (has_nav_menu('main_menu')){
                    wp_nav_menu( array(
                        'theme_location'  => 'main_menu',
                        'menu'            => '',
                        'container'       => false,
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'menu_id'         => '',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul class="menu max__wrap">%3$s</ul>',
                        'depth'           => 3,
                        'walker'          => new header_menu(),
                    ) );
                }
            ?>
        </nav>
    </div>
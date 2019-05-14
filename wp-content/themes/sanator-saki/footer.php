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

    <div id="footer">
        <div class="inner">
            <div class="container">
                <div class="row-fluid ff">
                    <div class="span4">
                        <div id="nav_menu-4" class="widget">
                            <div>
                                <?php
                                    if (has_nav_menu('frst_menu')){
                                        wp_nav_menu( array(
                                            'theme_location'  => 'frst_menu',
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
                                            'items_wrap'      => '<ul class="menu">%3$s</ul>',
                                            'depth'           => 1,
                                        ) );
                                    }
                                ?>
                            </div>
                        </div>
                        <div id="nav_menu-5" class="widget">
                            <div>
                                <?php
                                    if (has_nav_menu('scnd_menu')){
                                        wp_nav_menu( array(
                                            'theme_location'  => 'scnd_menu',
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
                                            'items_wrap'      => '<ul class="menu">%3$s</ul>',
                                            'depth'           => 1,
                                        ) );
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="widget widget_text footer__logo">
                            <div class="textwidget">
                                <?php echo wp_get_attachment_image( getMeta('logo_footer_main_page'), 'full '); ?>
                            </div>
                        </div>
                        <div class="widget social_widget">
                            <?php echo getMeta('social_footer_main_page'); ?>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="widget widget_text">
                            <div class="textwidget">
                                <div class="pull-right">
                                    <?php echo getMeta('contact_footer_main_page'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget_text">
                            <div class="textwidget">
                                <?php echo getMeta('yandex_informer_footer_main_page'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="copyright">
            <div class="max__wrap">
                <div class="row-fluid">
                    <div class="span12 desc">
                        <div class="copyright_text">
                            <?php echo getMeta('wrapper_footer_main_page'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display: none;">
    <?php if( is_front_page() ) { ?>
    <div id="inline1" style="width:100%;height:100%;">
        <?php echo getMeta('map_header_main_page'); ?>
    </div>
    <?php } ?>

    <div id="callback" class="hentry">
        <?php
            $forms_a = getMeta('callback_footer_main_page');
            if($forms_a){
                echo do_shortcode('[contact-form-7 id=" ' . $forms_a . ' "]'); 
            }
        ?>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
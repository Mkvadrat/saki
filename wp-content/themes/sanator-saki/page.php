<?php
/*
Theme Name: Sanatorium Saki
Theme URI: http://mkvadrat.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/

get_header(); ?>
	
	<div id="content">
        <div class="page__content">
            <div class="max__wrap">
                <div class="content__with-sidebar">
                    <div class="rooms__grid">
                        <div class="text__block">
							<?php the_post_thumbnail('large'); ?>
							
                            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                                <?php the_content(); ?>
                            <?php endwhile; endif; ?>
							
							<?php
								if ( function_exists('dynamic_sidebar') )
									dynamic_sidebar('sharing-page');
							 ?>
                        </div>
                    </div>
                    <div class="sidebar__right">
                        <?php
                            if ( function_exists('dynamic_sidebar') )
                                dynamic_sidebar('menu-page');
                                dynamic_sidebar('travelline-page');
                                dynamic_sidebar('banner-page');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>

<?php
/*
Theme Name: Sanatorium Saki
Theme URI: http://hotelhersones.com/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/

get_header();
?>

    <div id="content">
        <div class="page__content">
            <div class="max__wrap">
                <div class="content__with-sidebar">
                    <div class="rooms__grid">
                        <div class="text__block">
                            <h1><?php the_title(); ?></h1>
                            
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
                            $cat = get_the_category(get_the_ID());
                            $args_input = array(
                                'numberposts' => 5,
                                'category'    => $cat[0]->term_id,
                                'orderby'     => 'date',
                                'order'       => 'DESC',
                                'post_type'   => 'post',
                                'suppress_filters' => true, 
                            );

                            $articles_line = get_posts( $args_input );

                            foreach($articles_line as $post){ setup_postdata($post);
                        ?>
                        
                            <ul>
                                <li class="page_item"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo wp_trim_words( $post->post_title, 2, '...' ); ?></a></li>
                            </ul>
                            
                        <?php wp_reset_postdata(); ?>
                        
                        <?php } ?>

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

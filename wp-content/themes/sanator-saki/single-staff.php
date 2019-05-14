<?php
/*
Theme Name: Sanatorium Saki
Theme URI: http://mkvadrat.com/
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
					<?php
						$prev_post = get_previous_post( true, '', 'staff_entries' );
						$next_post = get_next_post( true, '', 'staff_entries' );
					?>
					<?php if (!empty(  $next_post )){ ?>
						<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="link__slide left__slide"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
					<?php } ?>
					
					<?php if (!empty( $prev_post )){ ?>
						<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="link__slide right__slide"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
					<?php } ?>
					
                    <div class="rooms__grid">
                        <div class="team__single">
							<?php
								$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full'); 
							?>
                            <img src="<?php echo $image_url ? $image_url : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>" alt="">
							
                            <div class="team__text">
                                <h1><?php the_title(); ?></h1>
                                
								<?php if (have_posts()): while (have_posts()): the_post(); ?>
									<?php the_content(); ?>
								<?php endwhile; endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__right">
                        <?php
                            if ( function_exists('dynamic_sidebar') )
                                dynamic_sidebar('travelline-page');
                                dynamic_sidebar('banner-page');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>

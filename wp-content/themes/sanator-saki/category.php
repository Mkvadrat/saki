<?php
/*
Theme Name: Sanatorium Saki
Theme URI: http://nord.ru/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта http://mkvadrat.com/
Version: 1.0
*/

get_header(); 
?>
    <?php if(get_queried_object()->term_id == 14) { ?>
    <div id="content">
        <div class="page__content">
            <div class="max__wrap">
                <div class="content__with-sidebar">
                    <div class="rooms__grid">
                        <?php
							$args = array(
								'tax_query' => array(
									array(
										'taxonomy' => 'category',
										'field' => 'id',
										'terms' => array( get_queried_object()->term_id )
									)
								),
									'post_type' => 'post',
									'numberposts' => -1,
                                    'post_status' => 'publish',
                                    'orderby'     => 'date',
                                    'order'       => 'DESC'
							);
				
							$posts = get_posts( $args );
							
							if($posts){
						?>
                        <section class="actions__grid">
                            <?php foreach($posts as $post){ ?>
							<?php
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
							?>
                            <div class="action__item">
                                <div class="scaleRotateIn">
                                    <div class="gitem-zone" style="background-image: url('<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>');">
                                        <a href="<?php echo get_permalink($post->ID); ?>" class="gitem-link"></a>
                                    </div>
                                    <div class="gitem-zone gitem-zone-2">
                                        <a href="<?php echo get_permalink($post->ID); ?>" class="gitem-link"></a>
                                        <div class="gitem-zone-mini">
                                            <div class="gitem-post-data"><?php echo get_the_date( 'd.m.y', $post->ID ); ?></div>
                                            <h3><?php echo $post->post_title; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </section>
                        <?php }else{ ?>
                        <section class="portfolio-preview-items">
							<p style="text-align: center;">Статьи не найдены!</p>
						</section>	
                        <?php } ?>
                        
                        <?php
							if ( function_exists('dynamic_sidebar') )
								dynamic_sidebar('sharing-page');
						?>
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
    <?php }else{ ?>
    <div id="content">
        <div class="news__content">
            <div class="max__wrap">
                <div class="content__with-sidebar">
                    <div class="news__grid">
                        <?php
							$args = array(
								'tax_query' => array(
									array(
										'taxonomy' => 'category',
										'field' => 'id',
										'terms' => array( get_queried_object()->term_id )
									)
								),
									'post_type' => 'post',
									'numberposts' => -1,
                                    'post_status' => 'publish',
                                    'orderby'     => 'date',
                                    'order'       => 'DESC'
							);
				
							$posts = get_posts( $args );
							
							if($posts){
						?>
                        <span class="timeline-border"></span>

                        <?php foreach($posts as $post){ ?>
                            <?php
                                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
                            ?>
                            <div class="news__item">
                                <div class="timeline">
                                    <div class="date">
                                        <span class="day"><?php the_time('j'); ?></span>
                                        <span class="month"><?php the_time('M'); ?></span>
                                    </div>
                                </div>
                                <div class="post__box box__shadow">
                                    <div class="media">
                                        <a href="<?php echo get_permalink($post->ID); ?>">
                                            <div class="overlay">
                                                <div class="post_type_circle"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                                            </div>
                                        </a>
                                        <img src="<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>" alt="">
                                    </div>
                                    <div class="content">
                                        <h3>
                                            <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                                        </h3>
                                        
                                        <div class="text"><?php echo wp_trim_words( $post->post_excerpt, 20, '...' ); ?></div>
                                        <div class="button__box">
                                            <a href="<?php echo get_permalink($post->ID); ?>" class="btn-bt default"><span>Читать полностью</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php } ?>
                        
                        <?php
							if ( function_exists('dynamic_sidebar') )
								dynamic_sidebar('sharing-page');
						?>
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
    <?php } ?>
    
<?php get_footer(); ?>
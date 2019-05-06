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
                                        <img src="img/gift-action.jpg" alt="">
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
                        <?php } ?>
                    </div>
                    <div class="sidebar__right">
                        <div class="booking__block">Виджет бронирования номеров</div>
                        <div class="banner__sidebar">
                            <a href="http://sak-vojazh.ru/" target="_blank"><img src="img/sakvojazh2.gif" alt="sakvojazh2"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php get_footer(); ?>
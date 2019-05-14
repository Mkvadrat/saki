<?php
/*
Theme Name: Sanatorium Saki
Theme URI: https://mkvadrat.com/
Author: mkvadrat
Author URI: https://mkvadrat.com/
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
						$args = array(
							'tax_query' => array(
								array(
									'taxonomy' => 'staff_entries',
									'field' => 'id',
									'terms' => array( get_queried_object()->term_id )
								)
							),
								'post_type' => 'staff',
								'numberposts' => -1,
								'post_status' => 'publish',
								'orderby'     => 'date',
								'order'       => 'DESC',
						);
			
						$staff_entries = get_posts( $args );
						
						if($staff_entries){
					?>
                    <div class="rooms__grid">
                        <div class="team__grid">
							<?php foreach($staff_entries as $staff){ ?>
							<?php
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($staff->ID), 'full'); 
							?>
                            <div class="team__item">
                                <a href="<?php echo get_permalink($staff->ID); ?>"><div class="bg__team" style="background-image: url('<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>')"></div></a>
                                <a href="<?php echo get_permalink($staff->ID); ?>"><?php echo $staff->post_title; ?></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
					<?php }else{ ?>
					<div class="rooms__grid">
                        <div class="team__grid">
                            <div class="team__item">
                                <p>Персонал не найден!</p>
                            </div>
                        </div>
                    </div>
					<?php } ?>
					
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

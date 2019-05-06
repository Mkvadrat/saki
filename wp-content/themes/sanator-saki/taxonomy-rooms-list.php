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
                    <div class="rooms__grid">
						<?php
							$args = array(
								'tax_query' => array(
									array(
										'taxonomy' => 'rooms-list',
										'field' => 'id',
										'terms' => array( get_queried_object()->term_id )
									)
								),
									'post_type' => 'rooms',
									'numberposts' => -1,
									'post_status' => 'publish',
									'orderby'     => 'date',
									'order'       => 'DESC',
							);
				
							$rooms_list = get_posts( $args );
							
							if($rooms_list){
						?>
                        <section class="portfolio-preview-items">
							<?php foreach($rooms_list as $room){ ?>
							<?php
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($room->ID), 'full'); 
							?>
                            <!-- Portfolio Normal Mode -->
                            <div class="portfolio-item">
                                <div class="he-wrap">
                                    <a href="<?php echo get_permalink($room->ID); ?>" style="background-image: url('<?php echo $image_url[0] ? $image_url[0] : esc_url( get_template_directory_uri() ) . '/img/no_image.jpg' ?>')"></a>
                                </div>
                                <div class="show_text">
                                    <h5><a href="<?php echo get_permalink($room->ID); ?>"><?php echo $room->post_title; ?></a></h5>
                                    <ul class="room-info">
										<?php
											$total_area = get_post_meta( $room->ID, 'total_area_single_rooms_page', $single = true );
											$bed = get_post_meta( $room->ID, 'bed_single_rooms_page', $single = true );
											$placement = get_post_meta( $room->ID, 'placement_single_rooms_page', $single = true );
											$price = get_post_meta( $room->ID, 'price_single_rooms_page', $single = true );
											$valute = get_post_meta( $room->ID, 'valute_single_rooms_page', $single = true );
											$tl_id = get_post_meta( $room->ID, 'tl_id_single_rooms_page', $single = true );
										?>
										
										<li><span class="title"><abbr title="Общая площадь"></abbr></span><p><?php echo $total_area ? $total_area : 0 . 'кв.м'; ?></p></li>
										
										<li><span class="title"><abbr title="Кровать"><i class="fa fa-bed" aria-hidden="true"></i></abbr></span> <p><?php echo $bed ? $bed : 0; ?></p></li>
										
										<li><span class="title"><abbr title="Размещение"><i class="fa fa-users" aria-hidden="true"></i></abbr></span><p><?php echo $placement ? $placement : 0; ?></p></li>
										
										<li class="clearfix"></li>
                                    </ul>
                                </div>
								<div class="b-table b-book-a-price b-table-room main-page-room">
									<div class="price b-table-cell">
										<div class="price-value">от <span class="price-color"><?php echo $price ? $price : 0; ?></span></div>
										<div class="valuta">
											<?php echo $valute ? $valute : ''; ?>
										</div>
									</div>
									<div class="book b-table-cell">
										<a href="/booking/?room-type=<?php echo $tl_id ? $tl_id : 0; ?>" class="btn-bt default booking-btn">Забронировать</a>
									</div>
								</div>
                            </div>
                            <!-- Portfolio Normal Mode End -->
							<?php } ?>
                        </section>
						<?php }else{ ?>
						<section class="portfolio-preview-items">
							<p style="text-align: center;">Номера не найдены!</p>
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
	
<?php get_footer(); ?>

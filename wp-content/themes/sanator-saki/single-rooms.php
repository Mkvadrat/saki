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
        <div class="single__content">
            <div class="max__wrap">
                <h1><?php the_title(); ?></h1>
                <div class="single__slider">
                    <div class="main-slider">
                        <div class="slider slider__single">
                            <div class="owl-carousel">
								<?php
									global $nggdb;
									$gallery_id = getNextGallery(get_the_ID(), 'gallery_single_rooms_page');
									$gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
									if($gallery_image){
										foreach($gallery_image as $image) { 
									?>
										<div style="background-image: url('<?php echo nextgen_esc_url($image->imageURL); ?>')"></div>
									<?php
										}
									}
								?>
                            </div>
                        </div>
                    </div>
                    <div class="gallery">
						<?php
							global $nggdb;
							$gallery_id = getNextGallery(get_the_ID(), 'gallery_single_rooms_page');
							$gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
							if($gallery_image){
								foreach($gallery_image as $image) { 
							?>
								<a class="lightbox-gallery fancybox" data-fancybox="images" href="<?php echo nextgen_esc_url($image->imageURL); ?>" rel="gallery-0">
									<div class="visual lightbox">
										<img src="<?php echo nextgen_esc_url($image->thumbnailURL); ?>" alt="">
									</div>
								</a>
							<?php
								}
							}
						?>
                    </div>
                </div>
                <div class="single__info">
                    <div class="room__details">
                        <h4>Детали</h4>
						<?php
							$total_area = get_post_meta( get_the_ID(), 'total_area_single_rooms_page', $single = true );
							$bed = get_post_meta( get_the_ID(), 'bed_single_rooms_page', $single = true );
							$placement = get_post_meta( get_the_ID(), 'placement_single_rooms_page', $single = true );
							$price = get_post_meta( get_the_ID(), 'price_single_rooms_page', $single = true );
							$valute = get_post_meta( get_the_ID(), 'valute_single_rooms_page', $single = true );
							$tl_id = get_post_meta( get_the_ID(), 'tl_id_single_rooms_page', $single = true );
						?>
                        <ul>
                            <li><h4>Общая площадь</h4><?php echo $total_area ? $total_area : 0 . 'кв.м'; ?></li>
                            <li><h4>Кровать</h4><?php echo $bed ? $bed : 0; ?></li>
                            <li><h4>Размещение</h4><?php echo $placement ? $placement : 0; ?></li>
                        </ul>
                    </div>
                    <div class="room__description">
                        <h4>Стоимость номера</h4>
                        <div class="b-table b-room-item ">
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
						
                        <?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
                    </div>
                </div>
				
				<?php
					$args = array(
							'post_type'   => 'rooms',
							'numberposts' => -1,
							'orderby'     => 'date',
							'order'       => 'DESC',
					);
		
					$rooms_list = get_posts( $args );
					
					if($rooms_list){
				?>
                <div class="other__rooms">
                    <h2 class="custom_heading">Другие номера</h2>
                    <div class="owl-carousel">
						
						<?php foreach($rooms_list as $room){ ?>
							<?php
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($room->ID), 'full'); 
							?>
						
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
							
						<?php } ?>
                    </div>
                </div>
				<?php } ?>
				
                <div class="square__line">
                    <hr>
                    <div class="big__square"><i class="fa fa-square-o" aria-hidden="true"></i></div>
                    <hr>
                </div>

				<?php
					if ( function_exists('dynamic_sidebar') )
						dynamic_sidebar('direction-page');
				?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>

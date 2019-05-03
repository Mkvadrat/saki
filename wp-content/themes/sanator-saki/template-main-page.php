<?php
/*
Template name: Main page
*/

get_header(); 
?>
      
    <div id="content">
        <div class="section__about-home">
            <div class="max__wrap">
                <?php echo get_post_meta( get_the_ID(), 'description_sanatorium_main_page', $single = true ); ?>
            </div>
        </div>
        <div class="section__info-home">
            <div class="max__wrap">
                <?php echo get_post_meta( get_the_ID(), 'saxonia_main_page', $single = true ); ?>
            </div>
        </div>
        <div class="section__actions-home">
            <div class="max__wrap">
                <?php echo get_post_meta( get_the_ID(), 'action_main_page', $single = true ); ?>
                <div class="latest_blog">
                    <div class="row">
                        <?php 
                            $args = array(
                                'numberposts' => 3,
                                'orderby'     => 'date',
                                'category'    => 14,
                                'order'       => 'DESC',
                                'post_type'   => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            );
    
                            $posts = get_posts( $args );
                            if($posts){
                                foreach($posts as $post){ setup_postdata($post);
                                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                        ?>
                                <div class="blog-item">
                                    <?php if(!empty($image_url)){ ?>
                                       <img src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true ); ?>">
                                    <?php }else{ ?>
                                       <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/no_image.jpg" alt="">
                                    <?php } ?>
                                    
                                    <div class="content">
                                        <h4><a href="<?php echo get_permalink($post->ID); ?>"><?php echo wp_trim_words( $post->post_title, 15, '...' ); ?></a></h4>
                                        <p><?php echo wp_trim_words( $post->post_excerpt, 20, '...' ); ?></p>
                                        <a class="btn-bt default booking-btn" href="<?php echo get_permalink($post->ID); ?>">Подробнее</a>
                                    </div>
                                </div>
                            <?php
                                
                                }
    
                            wp_reset_postdata();
                            }
                        ?>
                    </div>
                </div>
                <div class="button__box">
                    <a class="btn-bt align-center default" href="<?php echo get_category_link( 14 ); ?>"><span>Посмотреть все акции</span><i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="section__info-home">
            <div class="max__wrap">
                <?php echo get_post_meta( get_the_ID(), 'savoyege_main_page', $single = true ); ?>
            </div>
        </div>
        <div class="section__rooms-home">
            <div class="max__wrap">
                <?php echo get_post_meta( get_the_ID(), 'rooms_main_page', $single = true ); ?>
                <div class="section_clear">
                    <div class="rooms__info">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'title_sanatorium_main_page', $single = true ); ?>
                            <div class="list">
                            <?php echo get_post_meta( get_the_ID(), 'first_block_main_page', $single = true ); ?>  
                            </div>
                            <hr>
                            <div class="list">
                            <?php echo get_post_meta( get_the_ID(), 'second_block_main_page', $single = true ); ?>   
                            </div>
                        </div>
                    </div>
                    <?php $rooms = getRelatedMeta(get_the_ID(), 'choice_numbers_main_page'); ?>
                    <?php if($rooms){ ?>
                    <div class="rooms__grid">
                        <div class="wpb_wrapper">
                            <div class="recent_portfolio">
                                <section class="portfolio-preview-items">
                                    <?php foreach($rooms as $room){ ?>
                                    <?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($room->ID), 'full'); ?>
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
                            </div>
                            <div class="button__box">
                                <a class="btn-bt default" href="<?php echo get_category_link( 36 ); ?>"><span>Посмотреть все номера</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__news-home">
            <div class="max__wrap">
                <div class="section_clear">
                    <div class="span4">
                        <div class="wpb_wrapper">
                            <h3 class="custom_heading"><a href="<?php echo get_category_link( 22 ); ?>"><?php echo get_post_meta( get_the_ID(), 'mass_media_block_main_page', $single = true ); ?></a></h3>
                            <div class="latest_blog news__blog">
                                <div class="blog_slider owl-carousel">
                                    <div class="blog-item">
                                        <?php 
                                            $args = array(
                                                'numberposts' => 1,
                                                'orderby'     => 'date',
                                                'category'    => 22,
                                                'order'       => 'DESC',
                                                'post_type'   => 'post',
                                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                            );
                    
                                            $medias = get_posts( $args );
                                            if($medias){
                                                foreach($medias as $media){ setup_postdata($media);
                                                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($media->ID), 'full');
                                        ?>
                                                    <?php if(!empty($image_url)){ ?>
                                                        <div class="blog__img" style="background-image: url('<?php echo $image_url[0]; ?>')" ></div>
                                                    <?php }else{ ?>
                                                        <div class="blog__img" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/img/no_image.jpg')" ></div>
                                                    <?php } ?>
                                                    <div class="content">
                                                        <h4><a href="<?php echo get_permalink($media->ID); ?>"><?php echo wp_trim_words( $media->post_title, 15, '...' ); ?></a></h4>
                                                        <ul class="info">
                                                            <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date( 'd.m.y', $media->ID ); ?></li>
                                                        </ul>
                                                        <p><?php echo wp_trim_words( $media->post_excerpt, 30, '...' ); ?></p>
                                                        <a class="btn-bt default booking-btn" href="<?php echo get_permalink($media->ID); ?>">Подробнее</a>
                                                    </div>
                                                <?php
                                                
                                                }
                    
                                            wp_reset_postdata();
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="wpb_wrapper">
                            <h3 class="custom_heading"><a href="<?php echo get_category_link( 21 ); ?>"><?php echo get_post_meta( get_the_ID(), 'news_block_main_page', $single = true ); ?></a></h3>
                            <div class="latest_blog news__blog">
                                <div class="blog_slider owl-carousel">
                                    <div class="blog-item">
                                        <?php 
                                            $args = array(
                                                'numberposts' => 1,
                                                'orderby'     => 'date',
                                                'category'    => 21,
                                                'order'       => 'DESC',
                                                'post_type'   => 'post',
                                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                            );
                    
                                            $news = get_posts( $args );
                                            if($news){
                                                foreach($news as $uncos){ setup_postdata($uncos);
                                                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($uncos->ID), 'full');
                                        ?>
                                                    <?php if(!empty($image_url)){ ?>
                                                        <div class="blog__img" style="background-image: url('<?php echo $image_url[0]; ?>')" ></div>
                                                    <?php }else{ ?>
                                                        <div class="blog__img" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/img/no_image.jpg')" ></div>
                                                    <?php } ?>
                                                    <div class="content">
                                                        <h4><a href="<?php echo get_permalink($uncos->ID); ?>"><?php echo wp_trim_words( $uncos->post_title, 15, '...' ); ?></a></h4>
                                                        <ul class="info">
                                                            <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date( 'd.m.y', $uncos->ID ); ?></li>
                                                        </ul>
                                                        <p><?php echo wp_trim_words( $uncos->post_excerpt, 30, '...' ); ?></p>
                                                        <a class="btn-bt default booking-btn" href="<?php echo get_permalink($uncos->ID); ?>">Подробнее</a>
                                                    </div>
                                                <?php
                                                
                                                }
                    
                                            wp_reset_postdata();
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="wpb_wrapper">
                            <h3 class="custom_heading"><a><?php echo get_post_meta( get_the_ID(), 'weather_block_main_page', $single = true ); ?></a></h3>
                            <?php echo get_post_meta( get_the_ID(), 'weather_widget_main_page', $single = true ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__contacts-home">
            <div class="contact__map-home">
                <?php echo get_post_meta( get_the_ID(), 'location_block_main_page', $single = true ); ?>
            </div>
            <div class="contact__info-home">
                <div class="wpb_wrapper">
                    <?php echo get_post_meta( get_the_ID(), 'how_get_there_block_main_page', $single = true ); ?>
                    
                    <div class="button__box"><a class="btn-bt default" href="<?php echo get_permalink( 47 ); ?>"><span><?php echo get_post_meta( get_the_ID(), 'all_contacts_block_main_page', $single = true ); ?></span><i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                </div>
            </div>
        </div>
    </div>
    
<?php get_footer(); ?>
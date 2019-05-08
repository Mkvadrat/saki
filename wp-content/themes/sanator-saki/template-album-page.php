<?php
/*
Template name: Album page
*/

get_header(); 
?>
      
    <div id="content">
        <div class="single__content">
            <div class="max__wrap">
                <h1><?php the_title(); ?></h1>
                
                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>
                
                <div class="gallery__grid">
                    <?php
                        global $nggdb;
                        
                        $albums = $nggdb->find_all_album();
                        
                        if($albums){
                            foreach($albums as $album){
                                $gal_info = $nggdb->find_gallery($album->sortorder[0]);
                                if($gal_info->previewpic){
                                    $previewpic = nggdb::find_image($gal_info->previewpic)->cached_singlepic_file(728, 728, 'crop');
                                }else{
                                    $previewpic = esc_url( get_template_directory_uri() ) . '/img/no_image.jpg';
                                }   
                    ?>
                            <div class="gallery__item">
                                <a href="<?php echo $gal_info->pageid ? get_permalink($gal_info->pageid) : '/#/'; ?>" class="title"><?php echo $album->name; ?></a>
                                <div class="overflow__hidden">
                                    <div class="gallery__img" style="background-image: url('<?php echo $previewpic; ?>')"><a href="<?php echo $gal_info->pageid ? get_permalink($gal_info->pageid) : '/#/'; ?>"><i class="fa fa-search" aria-hidden="true"></i></a></div>
                                </div>
                            </div>
                    
                        <?php } ?>
                    <?php }else{ ?>
                        <p>Альбомов не найдено!</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
<?php get_footer(); ?>
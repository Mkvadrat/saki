<?php
/*
Template name: Gallery page
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
                
                <p><a class="btn-bt default booking-btn button__back back" href="#">Назад</a></p>
                
                <ul class="list-gallery-photos">
                    <?php
                        global $nggdb;
                        $gallery_id = getNextGallery(get_the_ID(), 'images_gallery_page');
                        $gallery_image = $nggdb->get_gallery($gallery_id[0]["ngg_id"], 'sortorder', 'ASC', false, 0, 0);
                        if($gallery_image){
                            foreach($gallery_image as $image) { 
                        ?>
                            <li class="small-block" style="background-image: url( '<?php echo nextgen_esc_url($image->imageURL); ?>' );">
                                <a data-fancybox="gallery" href="<?php echo nextgen_esc_url($image->imageURL); ?>"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                            </li>
                        <?php
                            }
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.back').click(function(){
            parent.history.back();
            return false;
        });
    });
    </script>
    
<?php get_footer(); ?>
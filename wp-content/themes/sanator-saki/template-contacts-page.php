<?php
/*
Template name: Contacts page
*/

get_header(); 
?>
      
    <div id="content">
        <div class="single__content">
            <div class="max__wrap">
                <h1><?php the_title(); ?></h1>
                <div class="contacts__grid">
                    <div class="contacts__item">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'text_block_a_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'text_block_b_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'text_block_c_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'text_block_d_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                </div>
                <div class="square__line">
                    <hr>
                    <div class="big__square"><i class="fa fa-square-o" aria-hidden="true"></i></div>
                    <hr>
                </div>
                <div class="contacts__grid">
                    <div class="contacts__item">
                        <div class="wpb_wrapper">
                           <?php echo get_post_meta( get_the_ID(), 'text_block_e_contacts_page', $single = true ); ?>
                        </div>
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'text_block_f_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'text_block_g_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'text_block_h_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'text_block_i_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                </div>

                <?php echo get_post_meta( get_the_ID(), 'title_maps_contacts_page', $single = true ); ?>

                <div class="way__grid">
                    <div class="way__map way__left">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'maps_block_a_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="way__text way__righ">
                        <div class="wpb_wrapper">
                           <?php echo get_post_meta( get_the_ID(), 'maps_block_b_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                </div>

                <div class="way__grid">
                    <div class="way__text way__left">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'maps_block_c_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                    <div class="way__map way__righ">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'maps_block_d_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                </div>

                <div class="way__grid">
                    <div class="way__map way__left">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'maps_block_e_contacts_page', $single = true ); ?>   
                        </div>
                    </div>
                    <div class="way__text way__righ">
                        <div class="wpb_wrapper">
                            <?php echo get_post_meta( get_the_ID(), 'maps_block_f_contacts_page', $single = true ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php get_footer(); ?>
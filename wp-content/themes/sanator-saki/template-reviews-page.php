<?php
/*
Template name: Reviews page
*/

get_header(); 
?>
      
    <div id="content">
        <div class="page__content testimonials__content">
            <div class="max__wrap">
                <div class="content__with-sidebar">
                    <div class="rooms__grid">
                        <section class="testimonials__grid">
                            <?php 
                            
                                define( 'DEFAULT_COMMENTS_PER_PAGE', $GLOBALS['wp_query']->query_vars['comments_per_page']);
                            
                                $page = (get_query_var('page')) ? get_query_var('page') : 1;
                            
                                $limit = DEFAULT_COMMENTS_PER_PAGE;
                            
                                $offset = ($page * $limit) - $limit;
                            
                                $param = array(
                                    'status'	=> 'approve',
                                    'offset'	=> $offset,
                                    'number'	=> $limit
                                );
                            
                                $total_comments = get_comments(array(
                                    'orderby' => 'comment_date',
                                    'order'   => 'ASC',
                                    'status'  => 'approve',
                                    'parent'  => 0
                            
                                ));
                            
                                $pages = ceil(count($total_comments)/DEFAULT_COMMENTS_PER_PAGE);
                            
                                $comments = get_comments( $param );
                            
                                $args = array(
                                    'base'         => @add_query_arg('page','%#%'),
                                    'format'       => '?page=%#%',
                                    'total'        => $pages,
                                    'current'      => $page,
                                    'show_all'     => false,
                                    'mid_size'     => 4,
                                    'prev_next'    => false,
                                    'prev_text'    => __('&laquo; В начало'),
                                    'next_text'    => __('В конец &raquo;'),
                                    //'type'         => 'comment'
                                    'type' => 'array'
                                );
                                
                                if($comments){
                                foreach($comments as $comment){
                                    $author = $comment->comment_author;
                                    $descr = strip_tags( $comment->comment_content );
                                    $city = get_comment_meta($comment->comment_ID, 'city', true);
                                    global $cnum;
                            
                                    // определяем первый номер, если включено разделение на страницы
                            
                                    $per_page = $limit;
                            
                                    if( $per_page && !isset($cnum) ){
                                        $com_page = $page;
                                        if($com_page>1)
                                            $cnum = ($com_page-1)*(int)$per_page;
                                    }
                                    // считаем
                                    $cnum = isset($cnum) ? $cnum+1 : 1;
                            ?>
                            <div class="testimonial__item">
                                <div class="testimonial__review">
                                    <div class="review_author"><h3><?php echo $author; ?></h3></div>
                                    <div class="review_datePublished"><i class="fa fa-calendar-o" aria-hidden="true"></i><?php comment_date( 'd.m.y', $comment->comment_ID ); ?></div>
                                </div>
                                <blockquote><p><?php echo $descr; ?></p></blockquote>
                            </div>
                            <?php } ?>
                            <?php } ?>
                            
                            <?php $pagination = paginate_links($args);
                                
                            if($pagination){
                            ?>
                            <ul class="paggination">
                                <?php foreach ($pagination as $pag){ ?>
                                    <li><?php echo $pag; ?></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </section>
                    </div>
                    
                    <div class="sidebar__right">
                        <div class="testimonial__form">
                            <form id="commentform">
                                <h3>Оставьте свой отзыв</h3>
                                <span>
                                    <label for="author">Имя:</label>
                                    <input type="text" name="author" id="author">
                                </span>
                                <span>
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email">
                                </span>
                                <span>
                                    <label for="comment">Ваш отзыв:</label>
                                    <textarea name="comment" id="comment" rows="8" cols="50"></textarea>
                                </span>
                                <span>
                                    <label><input type="checkbox" name="confirm" class="fconfirm" value="1">&nbsp; Это не спам</label>
                                </span>
                                <?php echo comment_id_fields(); ?>
                                <div class="respond"></div>
                            </form>
                            <div class="form-bottomed">
                                <input type="submit" onclick="submit();" class="sumbit-btn" value="Отправить" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    
                    <?php
                        if ( function_exists('dynamic_sidebar') )
                            dynamic_sidebar('sharing-page');
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <script language="javascript">
        function submit(){
            $("#commentform").submit();
        }
    </script>
    
<?php get_footer(); ?>
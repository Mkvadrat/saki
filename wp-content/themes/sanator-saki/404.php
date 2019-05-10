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
        <div class="page__404 single__content">
            <div class="max__wrap">
                <h1>Ошибка 404 - данная страница не найдена</h1>
                <div class="button__box">
                    <a class="btn-bt default booking-btn back__home" href="<?php echo esc_url( home_url( '/' ) ); ?>">На главную</a>
                </div>
            </div>
        </div>
    </div>
    
<?php get_footer(); ?>
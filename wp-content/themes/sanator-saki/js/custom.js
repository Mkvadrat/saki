document.addEventListener(
    "DOMContentLoaded", () => {
        new Mmenu("#menu", {
            "extensions": [
                "pagedim-black",
                "theme-dark"
            ]
        }, {
            clone: true
        });
    }
);


$(document).ready(function () {

    $(".slider .owl-carousel").owlCarousel({
        items: 1,
        nav: true,
        navText: ["<img src='wp-content/themes/sanator-saki/img/left.png'>", "<img src='wp-content/themes/sanator-saki/img/right.png'>"]
    });

    $(".blog_slider.owl-carousel").owlCarousel({
        items: 1
    });

    $(".other__rooms .owl-carousel").owlCarousel({
        items: 4,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2,
                margin: 20
            },
            800: {
                items: 3,
                margin: 20
            },
            1000: {
                items: 4,
                margin: 20
            }
        }
    });

    $(".accordion-group .accordion-heading").on("click", "a", function () {
        var a = $(this).parent().parent();
        a.find(".accordion-heading").hasClass("in_head") ? a.parent().find(".accordion-heading").removeClass("in_head") : (a.parent().find(".accordion-heading").removeClass("in_head"), a.find(".accordion-heading").addClass("in_head"))
    });


    // Устанавливаем ширину и высоту контейнера в соответствии с размерами изображения
    $('#wrapper').css({
        'width': $('#wrapper img').width(),
        'height': $('#wrapper img').height()
    });

    //Направление символа подсказки
    var tooltipDirection;

    for (i = 0; i < $(".pin").length; i++) {
        // Устанавливаем направление символа подсказки - вверх или вниз
        if ($(".pin").eq(i).hasClass('pin-down')) {
            tooltipDirection = 'tooltip-down';
        } else {
            tooltipDirection = 'tooltip-up';
        }

        if ($(".pin").eq(i).hasClass('st1')) {
            // Добавляем подсказку
            $("#wrapper").append(
                "<div style='left:" + $(".pin").eq(i).data('xpos') + "px;top:" + $(".pin").eq(i).data('ypos') + "px' class='" + tooltipDirection + "'>\
                    <div class='tooltip st1'>" + $(".pin").eq(i).html() + "</div>\
                </div>"
            );
        } else {
            // Добавляем подсказку
            $("#wrapper").append(
                "<div style='left:" + $(".pin").eq(i).data('xpos') + "px;top:" + $(".pin").eq(i).data('ypos') + "px' class='" + tooltipDirection + "'>\
                    <div class='tooltip'>" + $(".pin").eq(i).html() + "</div>\
                </div>"
            );
        }
    }

    // Выводим/скрываем подсказку
    $('.tooltip-up, .tooltip-down').mouseenter(function () {
        $(this).children('.tooltip').fadeIn(100);
    }).mouseleave(function () {
        $(this).children('.tooltip').fadeOut(100);
    });

    $(".maps-sanatorium").fancybox({
        touch: false
    });
});
export function slick(){
    $('.slides').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-angle-left fa-3x"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-angle-right fa-3x"></i></button>'
    });

    $('.services-carousel').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-angle-left fa-2x"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-angle-right fa-2x"></i></button>',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: true,
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 992,
                settings: {
                    arrows: true,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.clients-slide').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-angle-left fa-2x"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-angle-right fa-2x"></i></button>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.reviews-slide').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-angle-left fa-2x"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-angle-right fa-2x"></i></button>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.news-slider').slick({
        slidesToShow: 4,
        dots: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
}
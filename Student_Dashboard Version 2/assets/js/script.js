//School Login
$('.form').find('input, textarea').on('keyup blur focus', function (e) {

    var $this = $(this),
        label = $this.prev('label');

    if (e.type === 'keyup') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
        } else {
            label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
        } else {
            label.removeClass('highlight');
        }
    } else if (e.type === 'focus') {

        if ($this.val() === '') {
            label.removeClass('highlight');
        } else if ($this.val() !== '') {
            label.addClass('highlight');
        }
    }
});
$('.tab a').on('click', function (e) {

    e.preventDefault();

    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');

    target = $(this).attr('href');

    $('.tab-content > div').not(target).hide();

    $(target).fadeIn(600);

});

//Dropdown
$(document).ready(function () {

    $('nav.navbar').children('ul.nav').children('li').each(function (indexCount) {

        $(this).children('ul.dropdown').children('li').each(function (index) {

            var delay = 0.1 + index * 0.03;

            $(this).css("animation-delay", delay + "s")
        });
    });
});

//Autoplay Youtube Videos
autoPlayYouTubeModal();
function autoPlayYouTubeModal() {
    var trigger = $("body").find('[data-toggle="modal"]');
    trigger.click(function () {
        var theModal = $(this).data("target"),
            videoSRC = $(this).attr("data-theVideo"),
            videoSRCauto = videoSRC + "?autoplay=1";
        $(theModal + ' iframe').attr('src', videoSRCauto);
        $(theModal + ' button.close').click(function () {
            $(theModal + ' iframe').attr('src', videoSRC);
        });
    });
}

//Autoplay Other Videos
$(document).ready(function () {
    $('#videoModal').on('shown.bs.modal', function () {
        $('#video1')[0].play();
    })
    $('#videoModal').on('hidden.bs.modal', function () {
        $('#video1')[0].pause();
    })
});

//Vertical Carousel
$(".verticalCarousel").verticalCarousel({
    currentItem: 1,
    showItems: 3,
});

$(".verticalCarousel-2").verticalCarousel({
    currentItem: 1,
    showItems: 3,
});

//Owl Carousel
$(".owl-carousel ").owlCarousel({
    loop: true,
    margin: 40,
    responsiveClass: true,
    nav: true,
    loop: true,
    items: 1,
    responsive: {
        0: {
            items: 1
        },
        526: {
            items: 1
        },
        651: {
            items: 2
        },
        900: {
            items: 2
        },
        1000: {
            items: 2
        }
    }
});
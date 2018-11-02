//School Login
$(".form")
  .find("input, textarea")
  .on("keyup blur focus", function(e) {
    var $this = $(this),
      label = $this.prev("label");

    if (e.type === "keyup") {
      if ($this.val() === "") {
        label.removeClass("active highlight");
      } else {
        label.addClass("active highlight");
      }
    } else if (e.type === "blur") {
      if ($this.val() === "") {
        label.removeClass("active highlight");
      } else {
        label.removeClass("highlight");
      }
    } else if (e.type === "focus") {
      if ($this.val() === "") {
        label.removeClass("highlight");
      } else if ($this.val() !== "") {
        label.addClass("highlight");
      }
    }
  });
$(".tab a").on("click", function(e) {
  e.preventDefault();

  $(this)
    .parent()
    .addClass("active");
  $(this)
    .parent()
    .siblings()
    .removeClass("active");

  target = $(this).attr("href");

  $(".tab-content > div")
    .not(target)
    .hide();

  $(target).fadeIn(600);
});

//Dropdown
$(document).ready(function() {
  $("nav.navbar")
    .children("ul.nav")
    .children("li")
    .each(function(indexCount) {
      $(this)
        .children("ul.dropdown")
        .children("li")
        .each(function(index) {
          var delay = 0.1 + index * 0.03;

          $(this).css("animation-delay", delay + "s");
        });
    });
});

//Autoplay Youtube Videos
autoPlayYouTubeModal();
function autoPlayYouTubeModal() {
  var trigger = $("body").find('[data-toggle="modal"]');
  trigger.click(function() {
    var theModal = $(this).data("target"),
      videoSRC = $(this).attr("data-theVideo"),
      videoSRCauto = videoSRC + "?autoplay=1";
    $(theModal + " iframe").attr("src", videoSRCauto);
    $(theModal + " button.close").click(function() {
      $(theModal + " iframe").attr("src", videoSRC);
    });
  });
}

//On Close Pause Yt Video
jQuery("#videoModal").on("hidden.bs.modal", function(e) {
  $("#videoModal iframe").attr("src", "");
});

//Autoplay Other Videos
$(document).ready(function() {
  $("#videoModal2").on("shown.bs.modal", function() {
    $("#video1")[0].play();
  });
  $("#videoModal2").on("hidden.bs.modal", function() {
    $("#video1")[0].pause();
  });
});

//Vertical Carousel
$(".verticalCarousel").verticalCarousel({
  currentItem: 1,
  showItems: 3
});

$(".verticalCarousel-2").verticalCarousel({
  currentItem: 1,
  showItems: 3
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

//FAQ
const items = document.querySelectorAll(".faq-div a");
function toggleAccordion() {
  this.classList.toggle("active");
  this.nextElementSibling.classList.toggle("active");
}

//Nav
(function($) {
  $.fn.menumaker = function(options) {
    var cssmenu = $(this),
      settings = $.extend(
        {
          format: "dropdown",
          sticky: false
        },
        options
      );
    return this.each(function() {
      $(this)
        .find(".cl-button")
        .on("click", function() {
          $(this).toggleClass("menu-opened");
          var mainmenu = $(this).next("ul");
          if (mainmenu.hasClass("open")) {
            mainmenu.slideToggle().removeClass("open");
          } else {
            mainmenu.slideToggle().addClass("open");
            if (settings.format === "dropdown") {
              mainmenu.find("ul").show();
            }
          }
        });
      cssmenu
        .find("li ul")
        .parent()
        .addClass("has-sub");
      multiTg = function() {
        cssmenu
          .find(".has-sub")
          .prepend('<span class="submenu-button"></span>');
        cssmenu.find(".submenu-button").on("click", function() {
          $(this).toggleClass("submenu-opened");
          if (
            $(this)
              .siblings("ul")
              .hasClass("open")
          ) {
            $(this)
              .siblings("ul")
              .removeClass("open")
              .slideToggle();
          } else {
            $(this)
              .siblings("ul")
              .addClass("open")
              .slideToggle();
          }
        });
      };
      if (settings.format === "multitoggle") multiTg();
      else cssmenu.addClass("dropdown");
      if (settings.sticky === true) cssmenu.css("position", "fixed");
      resizeFix = function() {
        var mediasize = 1000;
        if ($(window).width() > mediasize) {
          cssmenu.find("ul").show();
        }
        if ($(window).width() <= mediasize) {
          cssmenu
            .find("ul")
            .hide()
            .removeClass("open");
        }
      };
      resizeFix();
      return $(window).on("resize", resizeFix);
    });
  };
})(jQuery);

(function($) {
  $(document).ready(function() {
    $("#cssmenu").menumaker({
      format: "multitoggle"
    });
  });
})(jQuery);

//Logout Dropdown
$("#dropdown").on("click", function(e) {
  e.preventDefault();

  if ($(this).hasClass("open")) {
    $(this).removeClass("open");
    $(this)
      .children("ul")
      .slideUp("fast");
  } else {
    $(this).addClass("open");
    $(this)
      .children("ul")
      .slideDown("fast");
  }
});

//SideNav

function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

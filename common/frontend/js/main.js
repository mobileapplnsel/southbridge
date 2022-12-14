$(document).ready(function(){
    $('.single-slider').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 0,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 1,
                nav: true,
                loop: true
            },
            1000: {
                items: 1,
                nav: true,
                loop: true
            }
        }
    });

    $('.fare-calendarslide').owlCarousel({
        loop: false,
        autoplay: false,
        margin: 0,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
            },
            600: {
                items: 2,
                nav: true,
            },
            1000: {
                items: 5,
                nav: true,
            }
        }
    });

    $(document).ready(function(){
        $(".addrm-btn").click(function(){
          $(".select-box").toggleClass("show-box");
        });
        $(".clickbtn").click(function(){
         $(".guest-details").addClass("show-gdbox");
         $(".clickbtn").hide();
      
        });
      });
});
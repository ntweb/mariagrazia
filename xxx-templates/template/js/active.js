/* ===================== active your plugin here ========================= */

(function($) {
    "use strict";


    /* ==========================================================================
   window laod function
   ========================================================================== */
    
    $(window).load(function() {
        $(window).trigger("scroll");
        $(window).trigger("resize");
        (function() {

          var support = { animations : Modernizr.cssanimations },
            container = document.getElementById( 'ip-container' ),
            header = container.querySelector( 'div.ip-header' ),
            loader = new PathLoader( document.getElementById( 'ip-loader-circle' ) ),
            animEndEventNames = { 'WebkitAnimation' : 'webkitAnimationEnd', 'OAnimation' : 'oAnimationEnd', 'msAnimation' : 'MSAnimationEnd', 'animation' : 'animationend' },
            // animation end event name
            animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ];

          function PRE_init() {
            var onEndInitialAnimation = function() {
              if( support.animations ) {
                this.removeEventListener( animEndEventName, onEndInitialAnimation );
              }

              startLoading();
            };

            // disable scrolling
            window.addEventListener( 'scroll', noscroll );

            // initial animation
            classie.add( container, 'loading' );

            if( support.animations ) {
              container.addEventListener( animEndEventName, onEndInitialAnimation );
            }
            else {
              onEndInitialAnimation();
            }
          }

          function startLoading() {
            // simulate loading something..
            var simulationFn = function(instance) {
              var progress = 0,
                interval = setInterval( function() {
                  progress = Math.min( progress + Math.random() * 0.1, 1 );

                  instance.setProgress( progress );

                  // reached the end
                  if( progress === 1 ) {
                    classie.remove( container, 'loading' );
                    classie.add( container, 'loaded' );
                    clearInterval( interval );

                    var onEndHeaderAnimation = function(ev) {
                      if( support.animations ) {
                        if( ev.target !== header ) return;
                        this.removeEventListener( animEndEventName, onEndHeaderAnimation );
                      }

                      classie.add( document.body, 'layout-switch' );
                      window.removeEventListener( 'scroll', noscroll );
                    };

                    if( support.animations ) {
                      header.addEventListener( animEndEventName, onEndHeaderAnimation );
                    }
                    else {
                      onEndHeaderAnimation();
                    }
                  }
                }, 80 );
            };

            loader.setProgressFn( simulationFn );
          }

          function noscroll() {
            window.scrollTo( 0, 0 );
          }

          PRE_init();

          })();
    });
    

    $(window).resize(function() {
        
    });

    /* ==========================================================================
   document ready function
   ========================================================================== */
    
    $(document).ready(function() {

        $(window).trigger("resize");

        // Countdown
          // To change date, simply edit: var endDate = "Feb 26, 2019 20:39:00";
            var endDate = "Feb 26, 2019 20:39:00";

            if ($(".drop-underconstruction").hasClass('drop-countdown')) {
                $('.drop-countdown').countdown({
                date: endDate,
                render: function(data) {
                  $(this.el).html('<div><div><span>' + (parseInt(this.leadingZeros(data.years, 2)*365) + parseInt(this.leadingZeros(data.days, 2))) + '</span><span>Days</span></div><div><span>' + this.leadingZeros(data.hours, 2) + '</span><span>h</span></div></div><div class="drop-countdown-ms"><div><span>' + this.leadingZeros(data.min, 2) + '</span><span>m</span></div><div><span class="theme-color">' + this.leadingZeros(data.sec, 2) + '</span><span class="theme-color">s</span></div></div>');
                }
              });
            };


        // ajax mail Chimp
        $('#drop-mc-form').ajaxChimp({
            language: 'tr98',
            // Replace this with your own mailchimp post URL
            url: 'http://hasib-rahman.us8.list-manage2.com/subscribe/post?u=74e8ba57153fb3b7bae403d34&id=514058c103'
        });


        // Mailchimp translation
        //
        // Defaults:
        //'submit': 'Submitting...',
        //  0: 'We have sent you a confirmation email',
        //  1: 'Please enter a value',
        //  2: 'An email address must contain a single @',
        //  3: 'The domain portion of the email address is invalid (the portion after the @: )',
        //  4: 'The username portion of the email address is invalid (the portion before the @: )',
        //  5: 'This email address looks fake or invalid. Please enter a real email address'

        $.ajaxChimp.translations.tr98 = {
            'submit': 'Submitting...',
            0: '<p> We will be in touch soon!</p>',
            1: '<p> Please enter a value.</p>',
            2: '<p> E-mail address is not valid.</p>',
            3: '<p> E-mail address is not valid.</p>',
            4: '<p> E-mail address is not valid.</p>',
            5: '<p> E-mail address is not valid.</p>'
        };

        $(".mobile-menu").on('click',function() {
            $(this).toggleClass("open");
            $("header nav > ul").slideToggle("slow");
        });

        $.stellar({
            horizontalScrolling: false,
            verticalOffset: 40
          });

        var pageSection = $(".page-content, .fixed-bg, .bg-img");
          pageSection.each(function(indx){
              
              if ($(this).attr("data-background")){
                  $(this).css("background-image", "url(" + $(this).data("background") + ")");
              }
          });
          
          // Progress bars
          var progressBar = $(".progress-bar");
          progressBar.each(function(indx){
              $(this).css("width", $(this).attr("aria-valuenow") + "%");
          });

          if ( $('.popup-youtube, .popup-vimeo, .popup-gmaps').length ) {

            $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-with-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
              });
          }

        $('#drop-tab a').on('click', function (e) {
          e.preventDefault();
          $(this).tab('show');
        });

        // Accordion
        var allPanels = $(".accordion > dd").hide();
        allPanels.first().slideDown("easeOutExpo");
        $(".accordion > dt > a").first().addClass("active");

        $(".accordion > dt > a").on('click', function() {

            var current = $(this).parent().next("dd");
            $(".accordion > dt > a").removeClass("active");
            $(this).addClass("active");
            allPanels.not(current).slideUp("easeInExpo");
            $(this).parent().next().slideDown("easeOutExpo");

            return false;

        });

        // Toggle
        var allToggles = $(".toggle > dd").hide();

        $(".toggle > dt > a").on('click', function() {

            if ($(this).hasClass("active")) {

                $(this).parent().next().slideUp("easeOutExpo");
                $(this).removeClass("active");

            } else {
                var current = $(this).parent().next("dd");
                $(this).addClass("active");
                $(this).parent().next().slideDown("easeOutExpo");
            }

            return false;
        });
        
        init_counters();
        initWorkFilter();
        init_masonry();
    });

/* ---------------------------------------------
     Fun Facts section
     --------------------------------------------- */

    function init_counters() {
        $(".count-number").appear(function() {
            var count = $(this);
            count.countTo({
                from: 0,
                to: count.html(),
                speed: 1300,
                refreshInterval: 60,
            });

        });
    }

/* ---------------------------------------------
 Portfolio section
 --------------------------------------------- */

// Projects filtering
var fselector = 0;
var work_grid = $("#atom-works-grid");

function initWorkFilter(){
     var isotope_mode;
     if (work_grid.hasClass("masonry")){
         isotope_mode = "masonry";
     } else{
         isotope_mode = "fitRows";
     }
     work_grid.imagesLoaded(function(){
            work_grid.isotope({
                itemSelector: '.atom-work-item',
                layoutMode: isotope_mode,
                filter: fselector
            });
        });
        
        $(".atom-portfolio-filter > li > a").on('click',function(){
            $(".atom-portfolio-filter > li > a").removeClass("active");
            $(this).addClass("active");
            fselector = $(this).attr('data-filter');
            
            work_grid.isotope({
                itemSelector: '.atom-work-item',
                layoutMode: isotope_mode,
                filter: fselector
            });
            return false;
        });
}

/* ---------------------------------------------
 Masonry
 --------------------------------------------- */

function init_masonry(){    
    $(".masonry").imagesLoaded(function(){
        $(".masonry").masonry();
    });
}




})(jQuery);

// Header Separator
var nav_bar_height  = jQuery('.nav-bar').outerHeight();
var viewport_width  = jQuery(window).width();
var viewport_height = jQuery(window).height();

jQuery(".nav-bar-separator").css("height", nav_bar_height );

if(viewport_width < 992) {
    jQuery(".main-navigation-sm, .secondary-navigation-sm").css("top", nav_bar_height).css("height", viewport_height - nav_bar_height);
} else {
    jQuery(".main-navigation-sm, .secondary-navigation-sm").css("top", nav_bar_height);
}

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = jQuery('.nav-bar').outerHeight();

jQuery(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 200);

function hasScrolled() {
    var st = jQuery(this).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight) {

        // Scroll Down
        jQuery('.nav-bar').removeClass('nav-down').css("top",-navbarHeight-20 );
    } else {
        // Scroll Up
        if(st + jQuery(window).height() < jQuery(document).height()) {
            jQuery('.nav-bar').addClass('nav-down').css("top", "0" );
        }
    }

    lastScrollTop = st;
}

( function( $ ) {
    'use strict';

    // Nav Bar Search Form
    $( '.nav-bar-search-icon' ).on( 'click', function() {
        $('body').on('wheel.modal mousewheel.modal', function () { return false; } );
        $( '.nav-bar-search-wrap' ).addClass( 'is-active' );

        setTimeout(function(){
            $('.nav-bar-search-wrap').find('.search-field').focus();
        }, 50);
    });

    $( '.nav-bar-search-close' ).on( 'click', function() {
        $('body').off('wheel.modal mousewheel.modal');
        $( '.nav-bar-search-wrap' ).removeClass( 'is-active' );
    });

    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            $('body').off('wheel.modal mousewheel.modal');
            $( '.nav-bar-search-wrap' ).removeClass( 'is-active' );
        }
    });

    // Primary Nav Bar Small Screen Nav
    $( '.hamburger-menu-primary' ).on( 'click', function() {
        $( '.main-navigation-sm' ).toggleClass( 'is-active' );
        $( '.secondary-navigation-sm' ).removeClass( 'is-active' );
        $( '.hamburger-menu-secondary' ).removeClass( 'open' );
        $( '.nav-bar' ).toggleClass( 'nav-bar-show' );
        $(this).toggleClass('open');
    });

    // Secondary Nav Bar Small Screen Nav
    $( '.hamburger-menu-secondary' ).on( 'click', function() {
        $( '.secondary-navigation-sm' ).toggleClass( 'is-active' );
        $( '.main-navigation-sm' ).removeClass( 'is-active' );
        $( '.hamburger-menu-primary' ).removeClass( 'open' );
        $( '.nav-bar' ).toggleClass( 'nav-bar-show' );
        $(this).toggleClass('open');
    });

    // Masonry
    if ( ( typeof $.fn.masonry !== 'undefined' ) ) {
        var $container = $( '.masonry' );
        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : 'article.child-element',
                transitionDuration: 0
            });
        });
    }

    // Fade in up effects
    var article = $('.blog-layout').find('.child-element');
    article.each(function(i){
        setTimeout(function(){
            article.eq(i).addClass('fade-in-up');
        }, 160 * (i+1));
    });

    // Back to Top
    if ($('.back-to-top').length) {
        var scrollTrigger = 500, // px
            backToTop = function () {
                var scrollTop = $( window ).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('.back-to-top').addClass('show');
                } else {
                    $('.back-to-top').removeClass('show');
                }
            };
        backToTop();

        $(window).on('scroll', function() {
            backToTop();
        });

        $('.back-to-top').on('click', function(e) {
            e.preventDefault();
            $('html,body').animate( {
                scrollTop: 0
            }, 800);
        });
    }
    
} )( jQuery );

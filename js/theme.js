/////////////////////////////////////////////////////////////////////
// jQuery for page scrolling feature - requires jQuery Easing plugin
/////////////////////////////////////////////////////////////////////

$('.page-scroll').bind('click', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
        scrollTop: $($anchor.attr('href')).offset().top -64
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
});



////////////////////////////////////////////////////////////////////////
// On-Scroll Animated Header: https://github.com/codrops/AnimatedHeader
////////////////////////////////////////////////////////////////////////

var cbpAnimatedHeader = (function() {

    var docElem = document.documentElement,
        header = document.querySelector( '.navbar-fixed-top' ),
        didScroll = false,
        changeHeaderOn = 10;

    function init() {
        window.addEventListener( 'scroll', function( event ) {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( scrollPage, 250 );
            }
        }, false );
    }

    function scrollPage() {
        var sy = scrollY();
        if ( sy >= changeHeaderOn ) {
            classie.add( header, 'navbar-shrink' );
        }
        else {
            classie.remove( header, 'navbar-shrink' );
        }
        didScroll = false;
    }

    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }

    init();

})();



//////////////////////////////////////////////
// Highlight the top nav as scrolling occurs
//////////////////////////////////////////////

$('body').scrollspy({
    target: '.navbar',
    offset: 65
})



///////////////////////////////////////////
// Display loading image while page loads
///////////////////////////////////////////

// Wait for window load
$(window).load(function() {
    // Animate loader off screen
    $(".page-loader").fadeOut("slow");
});



////////////////////////////////////////////////////
// OWL Carousel: http://owlgraphic.com/owlcarousel
////////////////////////////////////////////////////

// Intro text carousel
$("#owl-intro-text").owlCarousel({
    singleItem : true,
    autoPlay : 6000,
    stopOnHover : true,
    navigation : false,
    navigationText : false,
    pagination : true
})


// Partner carousel
$("#owl-partners").owlCarousel({
    items : 4,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [980,2],
    itemsTablet: [768,2],
    autoPlay : 5000,
    stopOnHover : true,
    pagination : false
})

// Testimonials carousel
$("#owl-testimonial").owlCarousel({
    singleItem : true,
    pagination : true,
    autoHeight : true
})


////////////////////////////////////////////////////////////////////
// Stellar (parallax): https://github.com/markdalgleish/stellar.js
////////////////////////////////////////////////////////////////////

$.stellar({
    // Set scrolling to be in either one or both directions
    horizontalScrolling: false,
    verticalScrolling: true,
});



///////////////////////////////////////////////////////////
// WOW animation scroll: https://github.com/matthieua/WOW
///////////////////////////////////////////////////////////

new WOW().init();



////////////////////////////////////////////////////////////////////////////////////////////
// Counter-Up (requires jQuery waypoints.js plugin): https://github.com/bfintal/Counter-Up
////////////////////////////////////////////////////////////////////////////////////////////

$('.counter').counterUp({
    delay: 10,
    time: 2000
});



////////////////////////////////////////////////////////////////////////////////////////////
// Isotop Package
////////////////////////////////////////////////////////////////////////////////////////////
$(window).load(function() {
$('.portfolio_menu ul li').click(function(){
	$('.portfolio_menu ul li').removeClass('active_prot_menu');
	$(this).addClass('active_prot_menu');
});

var $container = $('#portfolio');
$container.isotope({
  itemSelector: '.col-sm-4',
  layoutMode: 'fitRows'
});
$('#filters').on( 'click', 'a', function() {
  var filterValue = $(this).attr('data-filter');
  $container.isotope({ filter: filterValue });
  return false;
});
});



/////////////////////////
// Scroll to top button
/////////////////////////

// Check to see if the window is top if not then display button
$(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
        $('.scrolltotop').fadeIn();
    } else {
        $('.scrolltotop').fadeOut();
    }
});

// Click event to scroll to top
$('.scrolltotop').click(function(){
    $('html, body').animate({scrollTop : 0}, 1500, 'easeInOutExpo');
    return false;
});

$('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
});


			$('#art-form-link').click(function(e) {
				$("#art-form").delay(100).fadeIn(100);
				if($("#lang-form-link").hasClass('active'))
				{
 					$("#lang-form").fadeOut(100);
					$('#lang-form-link').removeClass('active');
				}
				if($("#quiz-form-link").hasClass('active'))
				{
					$("#quiz-form").fadeOut(100);
					$('#quiz-form-link').removeClass('active');
				}
				if($("#video-form-link").hasClass('active'))
				{
					$("#video-form").fadeOut(100);
					$('#video-form-link').removeClass('active');
				}
				$(this).addClass('active');
				e.preventDefault();
			});
			$('#lang-form-link').click(function(e) {
				$("#lang-form").delay(100).fadeIn(100);
				if( $("#quiz-form-link").hasClass('active') ) 
				{
 					$("#quiz-form").fadeOut(100);
					$('#quiz-form-link').removeClass('active');
				}
				if($("#art-form-link").hasClass('active'))
				{
					$("#art-form").fadeOut(100);
					$('#art-form-link').removeClass('active');
				}
				if($("#video-form-link").hasClass('active'))
				{
					$("#video-form").fadeOut(100);
					$('#video-form-link').removeClass('active');
				}
				$(this).addClass('active');
				e.preventDefault();
			});
			$('#quiz-form-link').click(function(e) {
				$("#quiz-form").delay(100).fadeIn(100);
				if($("#lang-form-link").hasClass('active'))
				{
 					$("#lang-form").fadeOut(100);
					$('#lang-form-link').removeClass('active');
				}
				if($("#art-form-link").hasClass('active'))
				{
					$("#art-form").fadeOut(100);
					$('#art-form-link').removeClass('active');
				}
				if($("#video-form-link").hasClass('active'))
				{
					$("#video-form").fadeOut(100);
					$('#video-form-link').removeClass('active');
				}
				$(this).addClass('active');
				e.preventDefault();
			});
			$('#video-form-link').click(function(e) {
				$("#video-form").delay(100).fadeIn(100);
				if($("#lang-form-link").hasClass('active'))
				{
 					$("#lang-form").fadeOut(100);
					$('#lang-form-link').removeClass('active');
				}
				if($("#art-form-link").hasClass('active'))
				{
					$("#art-form").fadeOut(100);
					$('#art-form-link').removeClass('active');
				}
				if($("#quiz-form-link").hasClass('active'))
				{
					$("#quiz-form").fadeOut(100);
					$('#quiz-form-link').removeClass('active');
				}
				$(this).addClass('active');
				e.preventDefault();
			});




////////////////////////////////////////////////////////////////////
// Close mobile menu when click menu link (Bootstrap default menu)
////////////////////////////////////////////////////////////////////

$(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
        $(this).collapse('hide');
    }
});

$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});

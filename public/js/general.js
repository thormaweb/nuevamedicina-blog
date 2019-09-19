"use strict";


/******************************************************************************************************************/
// SCROLL FX
/******************************************************************************************************************/

function handleScrollFx(){

	// if (ww > 768) {
    //
	// 	// on scroll
	// 	$(window).scroll(function(){
    //
	// 		var wscroll = $(this).scrollTop();
    //
	// 		// bg
	// 		// $('.bg img').css('marginRight', (- wscroll / 90) + '%');
	// 		$('.bg img').css('opacity', (890 - wscroll) / 1000 );
    //
	// 		// timeline
	// 		$('#timeline li:nth-of-type(2n) .item').css('marginTop', (wscroll / 50) + '%');
    //
	// 		// head
	// 		if (wscroll > 70) $('.landing #head').addClass('compact');
	// 		else $('.landing #head').removeClass('compact');
	// 	});
    //
	// }
	
	// scrollto
	$(document).on('click', '.scrollto', function(e){
		e.preventDefault();
		
		mypos = $($(this).attr('href')).position();
		$('html, body').animate({ scrollTop: mypos.top }, 800);
	});
	
}

/******************************************************************************************************************/
// MENU
/******************************************************************************************************************/

function handleMenu(){

	// nav fx
	$(document).on('click', '.menu a', function(e){
		
		var mylink = $(this).attr('href');
		
		// internal links or anchors
		if ( !$(this).attr('target') && ($(this).attr('id') != 'tgl-form') && ( mylink.indexOf('#') == -1) && !$(this).hasClass('fancybox') && !$(this).hasClass('fancybox-close') ){
			e.preventDefault();
			
			$('#preload').removeClass('loaded');
			
			setTimeout(function(){	
		    	window.location = mylink;
		    }, 700);
		}
		
	});
	
	// toggle menu (mobile)
	$(document).on('click', '.tgl-menu', function(e){ 
		e.preventDefault();
		
		var mymenu = $(this).attr('href'); 
		
		if ($(mymenu).hasClass('open')) $(mymenu).removeClass('open');
		else $(mymenu).addClass('open');
	});
	
	// product form
	$(document).on('click', '#tgl-form', function(e){
		e.preventDefault();
		
		if ($('#frm-prod').hasClass('show')) $('#frm-prod').removeClass('show');
		else $('#frm-prod').addClass('show');
		
	});
	
}

/******************************************************************************************************************/
// on load...
/******************************************************************************************************************/

var ww;

$(function(){
	
	// window width
	ww = $(window).width();
	$(window).resize(function(){ 
		ww = $(window).width();
		 
		handleScrollFx();
	});
	
	// preload
	$('body').waitForImages({
	    waitForAll: true,
	    finished: function() {
	    	
	    	setTimeout(function(){	 
	    		$('#preload').addClass('loaded');
	    		$('body').removeClass('init');
	    	}, 700);
	       
	       // slider
	       $('.carousel.slider').slick({
               autoplay: true,
               autoplaySpeed: 5000,
               dots: true,
               arrows: true,
               speed: 800,
               cssEase: 'cubic-bezier(0.190,1.000,0.220,1.000)',
               responsive: [{
                   breakpoint: 800,
                   settings: {
                       dots: false,
                       arrows: false,
                       infinite: true,
                   }
               }]
	       });
	       
	       // gal
	       $('.carousel.gal').slick({
               autoplay: true,
               autoplaySpeed: 5000,
               dots: true,
               arrows: true,
               speed: 800,
               cssEase: 'cubic-bezier(0.190,1.000,0.220,1.000)',
               responsive: [{
                   breakpoint: 800,
                   settings: {
                       dots: false,
                       arrows: false,
                       infinite: true,
                   }
               }]
	       });
	       
	       // brands
	       $('.carousel.brands').slick({
	       		slidesToShow: 1,
		   		slidesToScroll: 1,
                verticalSwiping: false,
				arrows: true,
				autoplay: true,
				autoplaySpeed: 3000,
				speed: 800
	       });
	       
	       // scroll fx
	       handleScrollFx();
	       
	       // masonry
           if ($('.posts ul').size()) $('.posts ul').masonry({ itemSelector: 'li' });
	       
	    }  
	});
	
	// menu
	handleMenu();
	
});

	
//	Fancybox
$('a.fancybox').fancybox();


// Popup Newsletter
function subscriptionPopup(){
    // get the mPopup
    var mpopup = $('#mpopupBox');

    // open the mPopup
    mpopup.show();

    // close the mPopup once close element is clicked
    $(".close").on('click',function(){
        mpopup.hide();
    });

    // close the mPopup when user clicks outside of the box
    $(window).on('click', function(e) {
        if(e.target == mpopup[0]){
            mpopup.hide();
        }
    });
}

$(document).ready(function() {
    var popDisplayed = $.cookie('popDisplayed');
    if(popDisplayed == '1'){
        return false;
    }else{
        setTimeout( function() {
            subscriptionPopup();
        },10000);
        $.cookie('popDisplayed', '1', { expires: 7 });
    }
});

jQuery(document).ready(function($) {
	// alert(jt_stayfor);
var interv = setInterval(runSlides, jt_stayfor);
var numSlides = $('#slidetick li').length;
var slideCount = 1;
var firstSlide = $('#slidetick li:first');
function runSlides(){
	var currSlide = $('#slidetick li.current-post');
	currSlide.fadeOut(jt_fadeoutspeed, function(){
		currSlide.removeClass('current-post');
		if(slideCount < numSlides){
			currSlide.next().delay(jt_delayfor).fadeIn( jt_fadeinspeed, function(){
				currSlide.next().addClass('current-post');
			});
			slideCount += 1;
		} else {
			firstSlide.delay(jt_delayfor).fadeIn( jt_fadeinspeed, function(){
				firstSlide.addClass('current-post');
			});
			slideCount = 1;
		}
	});
}
});
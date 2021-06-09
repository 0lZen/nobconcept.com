document.addEventListener('DOMContentLoaded', function(){
		$('.js-nob21-season-slider').slick({
		  dots: false,
		  arrows: true,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  variableWidth: true,
		  touchThreshold: 50,
		  responsive: [
		    {
		      breakpoint: 735,
		      settings: {
		        slidesToShow: 1,
		        arrows: false,
		        dots: true,
		        variableWidth: false
		      }
		    },
		  ]
		});
})



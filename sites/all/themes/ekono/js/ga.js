jQuery(document).ready(function($) {
    if (_gaq) {
		

		jQuery('.slider-inicio .views-row-1 a').click(function(){
			  _gaq.push(['_trackEvent', 'Frontpage Slideshow', 'Click en slide 1 del frontpage']);
		});

		jQuery('.slider-inicio .views-row-2 a').click(function(){
			  _gaq.push(['_trackEvent', 'Frontpage Slideshow', 'Click en slide 2 del frontpage']);
		});

		jQuery('.slider-inicio .views-row-3 a').click(function(){
			  _gaq.push(['_trackEvent', 'Frontpage Slideshow', 'Click en slide 3 del frontpage']);
		});

		jQuery('.slider-inicio .views-row-4 a').click(function(){
			  _gaq.push(['_trackEvent', 'Frontpage Slideshow', 'Click en slide 4 del frontpage']);
		});

		jQuery('.slider-inicio .views-row-5 a').click(function(){
			  _gaq.push(['_trackEvent', 'Frontpage Slideshow', 'Click en slide 5 del frontpage']);
		});

		//print 
		jQuery('.print_html a').click(function(){
			  _gaq.push(['_trackEvent', 'Print', 'Click en boton de imprimir noticia', document.title]);
		});

    }
});

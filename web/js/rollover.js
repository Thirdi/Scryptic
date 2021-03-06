/**
 * jQuery.Preload
 * Copyright (c) 2008 Ariel Flesler - aflesler(at)gmail(dot)com
 * Dual licensed under MIT and GPL.
 * Date: 3/12/2008
 *
 * @projectDescription Multifunctional preloader
 * @author Ariel Flesler
 * @version 1.0.7
 *
 * @id jQuery.preload
 * @param {String, jQuery, Array< String, <a>, <link>, <img> >} original Collection of sources to preload
 * @param {Object} settings Hash of settings.
 *
 * @id jQuery.fn.preload
 * @param {Object} settings Hash of settings.
 * @return {jQuery} Returns the same jQuery object, for chaining.
 *
 * @example Link Mode:
 *	$.preload( '#images a' );
 *
 * @example Rollover Mode:
 *	$.preload( '#images img', {
 *		find:/\.(gif|jpg)/,
 *		replace:'_over.$1'
 *	});
 *
 * @example Src Mode:
 *	$.preload( [ 'red', 'blue', 'yellow' ], {
 *		base:'images/colors/',
 *		ext:'.jpg'
 *	});
 *
 * @example Placeholder Mode:
 *	$.preload( '#images img', {
 *		placeholder:'placeholder.jpg',
 *		notFound:'notfound.jpg'
 *	});
 *
 * @example Placeholder+Rollover Mode(High res):
 *	$.preload( '#images img', {
 *		placeholder:true,
 *		find:/\.(gif|jpg)/,
 *		replace:'_high.$1'
 *	});
 */
;(function( $ ){

	var $preload = $.preload = function( original, settings ){
		if( original.split )//selector
			original = $(original);

		settings = $.extend( {}, $preload.defaults, settings );
		var sources = $.map( original, function( source ){
			if( !source ) 
				return;//skip
			if( source.split )//URL Mode
				return settings.base + source + settings.ext;
			var url = source.src || source.href;//save the original source
			if( typeof settings.placeholder == 'string' && source.src )//Placeholder Mode, if it's an image, set it.
				source.src = settings.placeholder;
			if( url && settings.find )//Rollover mode
				url = url.replace( settings.find, settings.replace );
			return url || null;//skip if empty string
		});

		var data = {
			loaded:0,//how many were loaded successfully
			failed:0,//how many urls failed
			next:0,//which one's the next image to load (index)
			done:0,//how many urls were tried
			//found:false,//whether the last one was successful
			total:sources.length//how many images are being preloaded overall
		};
		
		if( !data.total )//nothing to preload
			return finish();
		
		var imgs = '<img/>',//ensure one
			thres = settings.threshold;//save a copy
		
		while( --thres > 0 )//it could be oddly negative
			imgs += '<img/>';
		imgs = $(imgs).load(handler).error(handler).bind('abort',handler).each(fetch);
		
		function handler( e ){
			data.found = e.type == 'load';
			data.image = this.src;
			var orig = data.original = original[this.index];
			data[data.found?'loaded':'failed']++;
			data.done++;
			if( settings.placeholder && orig.src )//special case when on placeholder mode
				orig.src = data.found ? data.image : settings.notFound || orig.src;
			if( settings.onComplete )
				settings.onComplete( data );
			if( data.done < data.total )//let's continue
				fetch( 0, this );
			else{//we are finished
				if( imgs.unbind )//sometimes IE gets here before finishing line 84
					imgs.unbind('load').unbind('error').unbind('abort');//cleanup
				imgs = null;
				finish();
			}
		};
		function fetch( i, img, retry ){
			if( $.browser.msie && data.next && data.next % $preload.gap == 0 && !retry ){//IE problem, can't preload more than 15
				setTimeout(function(){ fetch( i, img, true ); }, 0);
				return false;
			}
			if( data.next == data.total ) return false;//no more to fetch
			img.index = data.next;//save it, we'll need it.
			img.src = sources[data.next++];
			if( settings.onRequest ){
				data.image = img.src;
				data.original = original[data.next-1];
				settings.onRequest( data );
			}
		};
		function finish(){
			if( settings.onFinish )
				settings.onFinish( data );
		};
	};

	// each time we load this amount and it's IE, we must rest for a while, make it lower if you get stack overflow.
	$preload.gap = 14; 

	$preload.defaults = {
		threshold:2,//how many images to load simultaneously
		base:'',//URL mode: a base url can be specified, it is prepended to all string urls
		ext:'',//URL mode:same as base, but it's appended after the original url.
		replace:''//Rollover mode: replacement (can be left empty)
		/*
		find:null,//Rollover mode: a string or regex for the replacement
		notFound:''//Placeholder Mode: Optional url of an image to use when the original wasn't found
		placeholder:'',//Placeholder Mode: url of an image to set while loading
		onRequest:function( data ){ ... },//callback called every time a new url is requested
		onComplete:function( data ){ ... },//callback called every time a response is received(successful or not)
		onFinish:function( data ){ ... }//callback called after all the images were loaded(or failed)
		*/
	};

	$.fn.preload = function( settings ){
		$preload( this, settings );
		return this;
	};

})( jQuery );


/** 
* IMAGE ROLLOVERS
* Finds all <img> and <input type="image"> tags on the page with a src value that ends in "-off"
* (or whatever the option "offSuffix" is set to) and applies a rollover image using the same filename, 
* but with "-on" instead of "-off". This script will preload all "-on" images once rest of the page loads.
*/


/**
* TODO: add functionality for a "-down" suffix for mousedown action. Have already started this.
*/

(function($) {

	$.imageRollovers = function(options) {

		// define default settings and then override with options, if there were any passed in
		var settings = {
			offSuffix: "-off",
			onSuffix: "-on"
		};
        var o = $.extend(settings, options || {});
        
		// find all of the images and inputs with the offSuffix, and store them in this $images variable
		// (the $ lets us know its "type" is a jQuery object)
		var $images = $("img[src*='"+o.offSuffix+".'], input[@type=image][src*='"+o.offSuffix+".']");
        
		// uses jquery.preload plugin to preload all images added to the $images object
		$images.preload({
			/*onRequest:update,
			onComplete:update,	*/		
 			find:o.offSuffix,
 			replace:o.onSuffix
 		});
		
		// this adds the rollover animation for the images
        $images.hover(function(){
			this.src = this.src.replace(o.offSuffix, o.onSuffix);
		},function(){
			this.src = this.src.replace(o.onSuffix, o.offSuffix);
		});	
		
		// debugging the preloader, using /examples/rollover.jsp
		/*function update( data ){
			$('#done').html( ''+data.done );
			$('#total').html( ''+data.total );
			$('#loaded').html( ''+data.loaded );
			$('#failed').html( ''+data.failed );
			$('#image-loaded').html( data.image );
			$('#image-next').html( data.image );
		};*/			

		return $images;
		
	};
})(jQuery);


/**
* since the current implementation of rollover.js runs just by attaching this external .js file,
* we'll instantiate this plugin automatically here too:
*/
$(function(){ $.imageRollovers(); });
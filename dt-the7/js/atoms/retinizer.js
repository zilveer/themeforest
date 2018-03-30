

jQuery(document).ready(function($) {
	//Cache variables
	var $document = $(document),
		$window = $(window),
		$html = $("html"),
		$body = $("body"),
		$page = $("#page");

	/*!- Custom resize function*/
	var dtResizeTimeout;
	if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone){
		$window.bind("orientationchange", function(event) {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$window.trigger( "debouncedresize" );
			}, 200);
		});
	}else{
		$window.on("resize", function() {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$window.trigger( "debouncedresize" );
			}, 200);
		});
	}
	/* #Retina images using srcset polyfill
	================================================== */
	//Layzy img loading
	$.fn.layzrInitialisation = function(container) {
	  return this.each(function() {
	      var $this = $(this);

	      var layzr = new Layzr({
	        container: container,
	        selector: '.lazy-load',
	        attr: 'data-src',
	        attrSrcSet: 'data-srcset',
	        retinaAttr: 'data-src-retina',
	        hiddenAttr: 'data-src-hidden',
	        threshold: 30,
	        before: function() {
	          // For fixed-size images with srcset; or have to be updated on window resize.
	          this.setAttribute("sizes", this.width+"px");
			   var ext = $(this).attr("data-src").substring($(this).attr("data-src").lastIndexOf(".")+1);
			   if(ext == "png"){
			      $(this).parent().addClass("layzr-bg-transparent");
			  }
	        },
	        callback: function() {

	          	this.classList.add("is-loaded");
	         	var $this =  $(this);
	         	setTimeout(function(){
					$this.parent().removeClass("layzr-bg");
				}, 350)
	        }
	      });
	    });
	};
	$(".layzr-loading-on, .vc_single_image-img").layzrInitialisation();

	$.fn.layzrBlogInitialisation = function(container) {
	  return this.each(function() {
	      var $this = $(this);
	      $(".blog-shortcode.jquery-filter article").removeClass("shown");
	      $this.addClass("shown");
	      $this.find("img").addClass("blog-thumb-lazy-load-show");

	      var layzrBlog = new Layzr({
	        container: container,
	        selector: ".blog-thumb-lazy-load-show",
	        attr: 'data-src',
	        attrSrcSet: 'data-srcset',
	        retinaAttr: 'data-src-retina',
	        hiddenAttr: 'data-src-hidden',
	        threshold: 30,
	        before: function() {
	          // For fixed-size images with srcset; or have to be updated on window resize.
	          if($(this).parents(".post").first().hasClass("visible")){
	          	//console.log( $(this))
		          this.setAttribute("sizes", this.width+"px");
				   var ext = $(this).attr("data-src").substring($(this).attr("data-src").lastIndexOf(".")+1);
				   if(ext == "png"){
				      $(this).parent().addClass("layzr-bg-transparent");
				 	}
				 }
	        },
	        callback: function() {
	        	if($(this).parents(".post").first().hasClass("visible")){
	          		this.classList.add("is-loaded");

			 		//console.log( $(this))
		         	var $this =  $(this);
		         	setTimeout(function(){
						$this.parent().removeClass("layzr-bg");
					}, 350);
				}
	        }
	      });
	    });
	};
	$(".layzr-loading-on .blog-shortcode.jquery-filter .visible").layzrBlogInitialisation();

	/*Call visual composer function for preventing full-width row conflict */
	if($('div[data-vc-stretch-content="true"]').length > 0 && $('div[data-vc-full-width-init="false"]').length > 0){
		vc_rowBehaviour();

	}

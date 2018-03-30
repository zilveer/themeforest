// Accordion Menu
$(document).ready(function() {
	var accordion_head = $('.accordion > li > a'),
		accordion_body = $('.accordion li > .sub-menu');
		accordion_head.on('click', function(event) {
			event.preventDefault();
			if ($(this).attr('class') != 'active'){
					accordion_body.slideUp('normal');
					$(this).next().stop(true,true).slideToggle('normal');
					accordion_head.removeClass('active');
					$(this).addClass('active');
				}

			});

		});




$(function(){
			if( $.browser.msie && $.browser.version < 9 ) {
				$('html').addClass('ie');
				
				$('div.option-group').each(function(){
					var $this = $(this);
					
					$this.find('label').append('<span class="before"></span> <span class="after"></span>');
					
					// radio button styling
					if( $this.hasClass('radio') ) {
						$this.delegate('input[type="radio"]', 'click', function(){
							if( this.checked ) {
								$(this).siblings('label').removeClass('checked').end().next('label').addClass('checked');
							}
							else {
								$(this).next('label').removeClass('checked');
							}
						});
					}
					
					// checkbox styling
					else if( $this.hasClass('check') ) {
						$this.delegate('input[type="checkbox"]', 'click', function(){
							if( this.checked ) {
								$(this).next('label').addClass('checked');
							}
							else {
								$(this).next('label').removeClass('checked');
							}
						});
					}
				});
				
			}
			
			
			// select box styling
			if( $.browser.msie && $.browser.version <= 9 ) {
				$('html').addClass('ie9');
				
				$('form.general')
					.find('select')
					.css({ 'opacity': '0', 'position': 'relative', 'z-index': '10' })
					.after('<span class="selectTop"/>')
					.change(function(){
						$(this).next().text( $('option:selected', this).text() );
					})
					.trigger('change');
			}
			
			// add 'invalid' class when HTML5 form valiation fails
			if( !$.browser.firefox ) {
				$('form.general').each(function(){
					$(this).find('input.form-input').bind('invalid', function(){
						$(this).addClass('invalid');
					});
				});
			}
		});
		
		
		
// File Upload		
$(document).ready(function(){
$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
$("input[type=file]").each(function(){
if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("No file selected...");}
});
});

// Form Element
$(function(){
			if( $.browser.msie && $.browser.version < 9 ) {
				$('html').addClass('ie');
				
				$('div.option-group').each(function(){
					var $this = $(this);
					
					$this.find('label').append('<span class="before"></span> <span class="after"></span>');
					
					// radio button styling
					if( $this.hasClass('radio') ) {
						$this.delegate('input[type="radio"]', 'click', function(){
							if( this.checked ) {
								$(this).siblings('label').removeClass('checked').end().next('label').addClass('checked');
							}
							else {
								$(this).next('label').removeClass('checked');
							}
						});
					}
					
					// checkbox styling
					else if( $this.hasClass('check') ) {
						$this.delegate('input[type="checkbox"]', 'click', function(){
							if( this.checked ) {
								$(this).next('label').addClass('checked');
							}
							else {
								$(this).next('label').removeClass('checked');
							}
						});
					}
				});
				
			}
			
			
			// select box styling
			if( $.browser.msie && $.browser.version <= 9 ) {
				$('html').addClass('ie9');
				
				$('form.general')
					.find('select')
					.css({ 'opacity': '0', 'position': 'relative', 'z-index': '10' })
					.after('<span class="selectTop"/>')
					.change(function(){
						$(this).next().text( $('option:selected', this).text() );
					})
					.trigger('change');
			}
			
			// add 'invalid' class when HTML5 form valiation fails
			if( !$.browser.firefox ) {
				$('form.general').each(function(){
					$(this).find('input.form-input').bind('invalid', function(){
						$(this).addClass('invalid');
					});
				});
			}
		});

// Slider Upload Accordion
(function($) {
	$.fn.mfxAccordion = function(options) {
		// Set up the options
		var o = $.extend({
			singleOption: true, // 'true' for only allowing one option open at once
			slideSpeed: 200 // the speed in milliseconds at which IE will animate
		}, options);
		
		// Multiple accordions supported
		$(this).each(function() {
			var $this = $(this);
			
			$this.children('.section').each(function() {
				// Store some variables
				var $section = $(this);
				var contentHeight = $section.find('.content').height();
				
				// Set the base heights
				if (!$section.hasClass('first')) {
					$section.find('.content').height(0);
				} else {
					$section.find('.content').height(contentHeight);
				}
				
				// Bind a click event to the trigger
				$section.find('.trigger').click(function(event) {
					// Determine if the content area is already visible
					var visible = ($(this).siblings('.content').height() > 0);
					var $content = $(this).siblings('.content');
					
					// If only one can be open at a time, close the rest
					if (o.singleOption) {
						if (!visible) {
							$this.children('.section').removeClass('active');
							
							if ($.browser.msie) {
								$this.find('.content').stop(true, true).animate({ height: 0 }, o.slideSpeed);
							} else {
								$this.find('.content').height(0);
							}
						}
					}
					
					// If it's visible, hide it
					if (visible) {
						if ($.browser.msie) {
							$content.stop(true, true).animate({ height: 0 }, o.slideSpeed);
						} else {
							$content.height(0);
						}
					} else {
						// Otherwise, show it
						if ($.browser.msie) {
							$content.stop(true, true).animate({ height: contentHeight }, o.slideSpeed);
						} else {
							$content.height(contentHeight);
						}
					}
					
					$section.toggleClass('active');
				});	
			});
		});
	}
})(jQuery);

$(document).ready(function() {
				$('.mfx_accordion').mfxAccordion({
					slideSpeed: 200,
					singleOption: false
				});
			});

//Portfolio

(function(c){var k=function(i,j,k){var a=c.extend({},c.fn.fancyfolio.defaults,j),b=c(i),g=[],f=[],h=!1,l=function(c){var e=b.find("span.ff_left");"u"==c?e.animate({bottom:0},a.titleSlideTransitionUp):h||e.animate({bottom:"-"+e.outerHeight()+"px"},a.titleSlideTransitionDown)},m=function(d,e){d.stopPropagation();var n=c(e);b.find("span.ff_right").fadeOut(a.maximizeUIFadeTransition);n.fadeOut(a.maximizeUIFadeTransition,function(){b.animate({top:g.top+"px",left:g.left+"px",width:f.width+"px",height:f.height+ "px"},a.maximizeTransitionClose,function(){b.css("z-index",f.zindex);h=!1;var c=b.find("span.ff_left");"0px"==c.css("bottom")&&c.animate({bottom:"-"+c.outerHeight()+"px"},a.titleSlideTransitionDown)})})},o=function(){g=b.position();f.width=b.width();f.height=b.height();f.zindex=b.css("z-index");b.css("z-index",1E3);h=!0;var d=b.find("img").outerHeight();b.animate({width:"100%",left:0,top:"relative"==a.position?g.top:"0",height:d+"px"},a.maximizeTransitionOpen,function(){var c=b.find("span.ff_close"); c.css({top:0,right:0,marginTop:"5px",marginRight:"5px"});c.fadeIn(a.maximizeUIFadeTransition);b.find("span.ff_right").fadeIn(a.maximizeUIFadeTransition)});d="relative"==a.position?b.offset().top:b.parent().parent().offset().top;a.scrollToPosition&&c("html, body").animate({scrollTop:d-a.maximizePaddingTop},a.maximizeTransitionOpen)};(function(){var d="padding: "+a.titleSlideLinkPaddingTop+"px "+a.titleSlideLinkPaddingRight+"px "+a.titleSlideLinkPaddingBottom+"px "+a.titleSlideLinkPaddingLeft+"px;"; b.prepend('<span style="'+("padding: "+a.titleSlidePaddingTop+"px "+a.titleSlidePaddingRight+"px "+a.titleSlidePaddingBottom+"px "+a.titleSlidePaddingLeft+"px; height: "+a.titleSlideHeight+"px; bottom: -"+(a.titleSlideHeight+a.titleSlidePaddingTop+a.titleSlidePaddingBottom)+"px;")+'" class="ff_left">'+b.find("img").attr("title")+'</span><span class="ff_close"></span><span class="ff_right" style="'+d+" height: "+a.titleSlideHeight+'px;"><a href="'+b.find("a").attr("href")+'" target="'+a.linkTarget+ '">'+b.find("a").attr("title")+"</a></span>");b.prepend("");b.find("span.ff_close").click(function(a){m(a,this)});b.find("span.ff_right").click(function(c){c.stopPropagation();a.autoCloseOnLinkOpen&&m(c,b.find("span.ff_close"))});if(b.index()+1==k){var d=b.parent().parent(),e=b.outerHeight(!0);c.browser.msie&&7==parseInt(c.browser.version,10)&&d.css("margin-bottom",e+"px");parentOffset=d.offset();d.css("height",d.outerHeight());c(d.find("li").get().reverse()).each(function(){var a=c(this).position(), b=c(this).offset(),d=[];c.browser.msie&&7==parseInt(c.browser.version,10)?(d.top=b.top-parentOffset.top+e,d.left=b.left-parentOffset.left):(d.top=a.top,d.left=a.left);c(this).css({position:"absolute",top:d.top+"px",left:d.left+"px"})})}})(b);b.bind({mouseenter:function(){l("u")},mouseleave:function(){l("d")},click:function(a){a.preventDefault();h||o()}})};c.fn.fancyfolio=function(i){var j=c(this).find("ul li").length;c(this).find("ul li").each(function(){new k(this,i,j)})};c.fn.fancyfolio.defaults= {titleSlideTransitionUp:250,titleSlideTransitionDown:250,titleSlideHeight:25,titleSlidePaddingTop:5,titleSlidePaddingRight:0,titleSlidePaddingBottom:0,titleSlidePaddingLeft:10,titleSlideLinkPaddingTop:5,titleSlideLinkPaddingRight:10,titleSlideLinkPaddingBottom:0,titleSlideLinkPaddingLeft:0,maximizeTransitionOpen:500,maximizeTransitionClose:500,maximizePaddingTop:20,maximizeUIFadeTransition:250,position:"top",linkTarget:"_blank",autoCloseOnLinkOpen:!1,scrollToPosition:!0}})(jQuery);

$(document).ready(function() {
    $('#fancyfolio').fancyfolio();
});
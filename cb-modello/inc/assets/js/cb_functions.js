jQuery(document).ready(function(){ 
	"use strict";
	
	jQuery('.head_tope #searchform').prepend('<input type="hidden" name="post_type" value="product" />');

    jQuery('form.mailchimpform').submit(function() {
        var data = jQuery(this).serialize();
        var ajaxurl = ajax_script.ajaxurl;
        var form = jQuery(this);
        jQuery.post(ajaxurl, data, function(response) {
            if(response.success==true){
                form.slideUp();
                form.parent().find('.message').removeClass('error').html(response.message).slideDown();
            }else{
                form.parent().find('.message').addClass('error').html(response.message).slideDown();
            }

        }, 'json');
        return false;

    });
    jQuery('.comment-respond').addClass('woocommerce');
    
    jQuery('.top-area #searchform .submit_search').prepend('<input type="hidden" name="post_type" value="product"/>');
    
    var st=jQuery('.top-area #searchform input').val();
    if(st=='') jQuery('.top-area #searchform input').val('SEARCH');
    jQuery('#sidebar_l').addClass('woocommerce');
    jQuery('#sidebar_r').addClass('woocommerce');
    jQuery('.wpcf7-submit').addClass('md-button');
    jQuery('.wpcf7-submit').addClass('larger');

    jQuery('.top-area #searchform input').on('focus', function() {
        if (!jQuery(this).data('defaultText')) jQuery(this).data('defaultText', jQuery(this).val());
        if (jQuery(this).val()==jQuery(this).data('defaultText')) jQuery(this).val('');
    });
    jQuery('.top-area #searchform input').on('blur', function() {
        if (jQuery(this).val()=='') jQuery(this).val(jQuery(this).data('defaultText')); 
    });

    jQuery('.grid_view').click(function(){
    	jQuery('.prods').removeClass('list_view');
    	jQuery('.prods').addClass('grid_view');
    	jQuery('.grid-list-buttons ul li').removeClass('active');
    	jQuery(this).parent().addClass('active');
    });
    jQuery('.list_view').click(function(){
    	jQuery('.prods').removeClass('grid_view');
    	jQuery('.prods').addClass('list_view');
    	jQuery('.grid-list-buttons ul li').removeClass('active');
    	jQuery(this).parent().addClass('active');
    });
    
    jQuery('.widget_product_categories ul li').prepend('<i class="fa fa-chevron-right"></i> ');
    
    
    

    jQuery('.checkout_actions input.input-text').each(function(){
    	var labe=jQuery(this).prev('label').html();
    	if(labe!=''&&typeof labe!='undefined'){ 
    	labe=labe.replace(/<(?:.|\n)*?>/gm, '');
    	jQuery(this).prev('label').remove();
    	jQuery(this).attr('placeholder',labe);

    	}
    });
    
  /*  jQuery('.checkout_actions input.input-text').on('click focusin', function() {
        var inputVal = jQuery(this).val();  
        var defVal = jQuery(this).attr('data-def');
	    if(inputVal==defVal) this.value = '';
	});
	jQuery('.checkout_actions input.input-text').blur(function() {
        var inputVal = jQuery(this).val();  
        var defVal = jQuery(this).attr('data-def');
	    if(inputVal==''&&defVal!=''&&defVal!='undefined'&&defVal!=undefined) this.value = defVal;
		});
*/
    jQuery('.woocommerce-account input.input-text').each(function(){
    	var labe=jQuery(this).prev('label').html();
    	if(labe!=''&&typeof labe!='undefined'){ 
    	labe=labe.replace(/<(?:.|\n)*?>/gm, '');
    	jQuery(this).prev('label').remove();
    	jQuery(this).attr('placeholder',labe);
    	//jQuery(this).val(labe);
    	}
    });
    
    
    
    jQuery('.product-categories .children').hide();
    jQuery('.product-categories i').click(function(){
    	jQuery(this).parent().find('.children').slideToggle('slow');
    	if (jQuery(this).hasClass('fa-chevron-right')) {
        	jQuery(this).removeClass('fa-chevron-right');
        	jQuery(this).addClass('fa-chevron-down');
    	} else { 
        	jQuery(this).removeClass('fa-chevron-down');
        	jQuery(this).addClass('fa-chevron-right');
    	}
    });

    jQuery('.product-categories .current-cat .children').show();
	jQuery('.product-categories .current-cat i').removeClass('fa-chevron-right');
	jQuery('.product-categories .current-cat i').addClass('fa-chevron-down');
    
    
    
    jQuery('.woocommerce-account input.input-text').on('click focusin', function() {
        var inputVal = jQuery(this).val();  
        var defVal = jQuery(this).attr('data-def');
	    if(inputVal==defVal) this.value = '';
	});
	jQuery('.woocommerce-account input.input-text').blur(function() {
        var inputVal = jQuery(this).val();  
        var defVal = jQuery(this).attr('data-def');
	    if(inputVal==''&&defVal!=''&&defVal!='undefined'&&defVal!=undefined) this.value = defVal;
		});

	

    
    
    if(jQuery('.aq-template-wrapper').children().first().hasClass('rw_div')==true) { 
    	if(jQuery('.slider_top').children().hasClass('rev_slider_wrapper')){} 
    	else jQuery('.slider_top').addClass('pb100'); 
    	}
    jQuery('i').each(function(){
    	  var ihtml=jQuery(this).html('');
    	  if(ihtml=='&nbsp;') jQuery(this).html('');
      });
    jQuery('#searchsubmit').remove();
    jQuery('#searchform').append('<a class="submit_search"><i class="fa fa-search"></i></a>');
    jQuery('.submit_search').click(function(){
    	jQuery(this).parent().submit();
    });
    jQuery('input[type="submit"]').addClass('bttn');
    jQuery('.cb_posts .col1').last().addClass('bor0');
    jQuery('.cb_posts .col1').last().addClass('mb0');
    jQuery('input[type="submit"]').addClass('skin');
    jQuery('.wpcf7-submit').addClass('bttn');
    jQuery('.wpcf7-submit').addClass('skin');

    jQuery('.add_to_wishlist').addClass('add-to-wishlist');
    jQuery('.add_to_wishlist').addClass('ic-sm-heart');
    jQuery('.cb-menu > li').last().addClass('last-menu-item');
    jQuery('ul.cb-menu li ul li ul li:last-child').addClass('bpb0');
    jQuery('ul.cb-menu li ul li a').prepend('<i class="fa fa-chevron-right menu-icon"></i>');
    jQuery('.mega-icon').each(function(){
    	   var geti = jQuery.grep(this.className.split(" "), function(v, i){
    	       return v.indexOf('micon') === 0;
    	   }).join();
    	   var mico=geti.replace('micon-','');
    	   jQuery(this).find('.sub-menu').first().append('<div class="menu-icon-bottom"><i class="fa '+mico+'"></i></div>');
    });
    	   
    var $window = jQuery(window);

    jQuery('.price del').each(function(){
    	var as=jQuery(this).width();
    	if(as > 90){ jQuery(this).css('display','block'); }
    });
    
    jQuery('.navi_full_wrap').each(function(){
     	jQuery(this).parent().after(this);
    });

    jQuery('.list_style .col1 .bttn.more').html('<i class="fa fa-plus-square"></i>');
    jQuery('.list_style .col1').hover(function(){
    	jQuery(this).find('.bttn.more').stop().fadeIn('slow');
    },function(){
    	jQuery(this).find('.bttn.more').stop().fadeOut('slow');
    });
   
    
    
    	jQuery('.icon_block > div > div> i').each(function(){
        	var iw=jQuery(this).width();
    		jQuery(this).css('height',iw);
    		jQuery(this).css('line-height',iw+'px');
    	});
    
    
});


jQuery(window).bind("load",function(){
	var tith=jQuery('.head_title').html();
	if(tith=='') jQuery('.head_title').addClass('head_title_imp');

	jQuery('.featured_image.bottom_to_top .container .main_link').imagesLoaded( function() {
		jQuery('.featured_image.bottom_to_top .container .main_link').each( function() {
     	var ph=jQuery(this).parent().height();
      	jQuery(this).css('height',ph);
		});});
	

	setTimeout(function(){jQuery('.fullbgspacer').imagesLoaded( function() {
    jQuery('.fullbgspacer').each(function(){
     	var ph=jQuery(this).parent().height();
      	jQuery(this).css('height',ph);
    });});
	jQuery('.fullbgspacer').imagesLoaded( function() {
	    jQuery('.fullbgspacer').each(function(){
	     	var ph=jQuery(this).parent().height();
	      	jQuery(this).css('height',ph);
	    });});
	jQuery('.fullbg_tint').imagesLoaded( function() {
    jQuery('.fullbg_tint').each(function(){
    	var ph=jQuery(this).parent().height();
    	jQuery(this).css('height',ph);
    });});
	},800);

    
});












jQuery(document).ready(function($){
    

    	var Grid = (function() {

    	    // list of items
    	    var $grid = $( '.ajax_hover' ),
    	    // the items
    	        $items = $grid.children( '.portfolio').children('.frame').children('.container'),
    	    // current expanded item's index
    	        current = -1,
    	    // position (top) of the expanded item
    	    // used to know if the preview will expand in a different row
    	        previewPos = -1,
    	    // extra amount of pixels to scroll the window
    	        scrollExtra = 0,
    	    // extra margin when expanded (between preview overlay and the next items)
    	        marginExpanded = 10,
    	        $window = $( window ), winsize,
    	        $body = $( 'html, body' ),
    	    // transitionend events
    	        transEndEventNames = {
    	            'WebkitTransition' : 'webkitTransitionEnd',
    	            'MozTransition' : 'transitionend',
    	            'OTransition' : 'oTransitionEnd',
    	            'msTransition' : 'MSTransitionEnd',
    	            'transition' : 'transitionend'
    	        },
    	        transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
    	    // support for csstransitions
    	        support = Modernizr.csstransitions,
    	    // default settings
    	        settings = {
    	            minHeight : 300,
    	            speed : 350,
    	            easing : 'ease'
    	        };

    	    function init( config ) {

    	        // the settings..
    	        settings = $.extend( true, {}, settings, config );

    	        // preload all images
    	        $grid.imagesLoaded( function() {

    	            // save item´s size and offset
    	            saveItemInfo( true );
    	            // get window´s size
    	            getWinSize();
    	            // initialize some events
    	            initEvents();

    	        } );

    	    }

    	    // add more items to the grid.
    	    // the new items need to appended to the grid.
    	    // after that call Grid.addItems(theItems);
    	    function addItems( $newitems ) {

    	        $items = $items.add( $newitems );

    	        $newitems.each( function() {
    	            var $item = $( this );
    	            $item.data( {
    	                offsetTop : $item.offset().top,
    	                height : $item.height()
    	            } );
    	        } );

    	        initItemsEvents( $newitems );

    	    }

    	    // saves the item´s offset top and height (if saveheight is true)
    	    function saveItemInfo( saveheight ) {
    	        $items.each( function() {
    	            var $item = $( this );
    	            $item.data( 'offsetTop', $item.offset().top );
    	            if( saveheight ) {

    	                $item.data( 'height', $item.height() );
    	            }
    	        } );
    	    }

    	    function initEvents() {

    	        // when clicking an item, show the preview with the item´s info and large image.
    	        // close the item if already expanded.
    	        // also close if clicking on the item´s cross
    	        initItemsEvents( $items );

    	        // on window resize get the window´s size again
    	        // reset some values..
    	        $window.on( 'debouncedresize', function() {

    	            scrollExtra = 0;
    	            previewPos = -1;
    	            // save item´s offset
    	            saveItemInfo();
    	            getWinSize();
    	            var preview = $.data( this, 'preview' );
    	            if( typeof preview != 'undefined' ) {
    	                hidePreview();
    	            }

    	        } );

    	    }

    	    function initItemsEvents( $items ) {
                $(document).on("click",'.portfolio a.main_link ', function (event) {
                    var $item = $(event.target).parent().parent();


                    // check if item already opened
                    //current === $item.index() ? hidePreview() : showPreview( $item );


                    hidePreview();
                    //console.log($item);

                     $('.og-expandeds').removeClass( 'og-expandeds' );
                        showPreview( $item );

                });

                $(document).on("click", 'span.og-close', function() {
                    hidePreview();
                    return false;
                } );
    	    }

    	    function getWinSize() {
    	        winsize = { width : $window.width(), height : $window.height() };
    	    }

    	    function showPreview( $item ) {

    	        var preview = $.data( this, 'preview' ),
    	        // item´s offset top
    	            position = $item.data( 'offsetTop' );

    	        scrollExtra = 0;

    	        // if a preview exists and previewPos is different (different row) from item´s top then close it
    	        if( typeof preview != 'undefined' ) {

    	            // not in the same row
    	            if( previewPos !== position ) {
    	                // if position > previewPos then we need to take te current preview´s height in consideration when scrolling the window
    	                if( position > previewPos ) {
    	                    scrollExtra = preview.height;
    	                }
    	                hidePreview();
    	            }
    	            // same row
    	            else {
    	                preview.update( $item );
    	                return false;
    	            }

    	        }

    	        // update previewPos
    	        previewPos = position;
    	        // initialize new preview for the clicked item
    	        preview = $.data( this, 'preview', new Preview( $item ) );
    	        // expand preview overlay
    	        preview.open();

    	    }

    	    function hidePreview() {
    	        current = -1;
    	        var preview = $.data( this, 'preview' );
                if( typeof preview != 'undefined' ) {
                    preview.close();
                    $.removeData( this, 'preview' );
                }
    	    }

    	    // the preview obj / overlay
    	    function Preview( $item ) {
    	        this.$item = $item;
    	        this.expandedIdx = this.$item.index();
    	        this.create();
    	        this.update();
    	    }

    	    Preview.prototype = {
    	        create : function() {
    	            // create Preview structure:

    	            // create Preview structure:
    	            this.$title = $( '<h3></h3>' );
    	            this.$description = $( '<p></p>' );
    	            this.$href = $( '<a href="#">Visit website</a>' );
    	            this.$details = $( '<div class="og-details"></div>' ).append(this.$item.parent().parent().find('.ajax_start').html());
    	            this.$loading = $( '<div class="og-loading"></div>' );
    	            this.$fullimage = $( '<div class="og-fullimg"></div>' ).append( this.$loading );
    	            this.$closePreview = $( '<span class="og-close"></span>' );
    	            this.$previewInner = $( '<div class="og-expander-inner"></div>' ).append( this.$closePreview, this.$fullimage, this.$details,'<div class="cl"></div>' );
    	            this.$previewEl = $( '<div class="og-expander"></div>' ).append( this.$previewInner,'<div class="cl"></div>' );
    	            // append preview element to the item
    	            this.$item.parent().parent().append( this.getEl());
    	           // this.$item.append( this.getEl() );



    	            // set the transitions for the preview and the item
    	            if( support ) {
    	                this.setTransition();
    	            }
    	        },
    	        update : function( $item ) {

    	            if( $item ) {
    	                this.$item = $item;
    	            }

    	            // if already expanded remove class "og-expanded" from current item and add it to new item
    	            if( current !== -1 ) {
    	                var $currentItem = $items.eq( current );
    	                $currentItem.removeClass( 'og-expanded' );
    	                this.$item.addClass( 'og-expanded' );
    	                $currentItem.parent().removeClass( 'og-expandeds' );
    	                $currentItem.parent().parent().removeClass( 'og-par' );
    	                this.$item.parent().addClass( 'og-expandeds' );
    	                this.$item.parent().parent().addClass( 'og-par' );
    	                // position the preview correctly
    	                this.positionPreview();
    	            }

    	            // update current value
    	            current = this.$item.index();

    	            // update preview´s content
    	            var $itemEl = this.$item.children( 'a' ),
    	                eldata = {
    	                    href : $itemEl.attr( 'href' ),
    	                    largesrc : $itemEl.data( 'largesrc' ),
    	                    title : $itemEl.data( 'title' ),
    	                    description : $itemEl.data( 'description' )
    	                };

    	            this.$title.html( eldata.title );
    	            this.$description.html( eldata.description );
    	            this.$href.attr( 'href', eldata.href );

    	            var self = this;

    	            // remove the current image in the preview
    	            if( typeof self.$largeImg != 'undefined' ) {
    	                self.$largeImg.remove();
    	            }

    	            // preload large image and add it to the preview
    	            // for smaller screens we don´t display the large image (the media query will hide the fullimage wrapper)
    	            if( self.$fullimage.is( ':visible' ) ) {
    	                this.$loading.show();
    	                $( '<img/>' ).load( function() {
    	                    var $img = $( this );
    	                   // console.log($( this ));
    	                    if( $img.attr( 'src' ) === self.$item.children('a').data( 'largesrc' ) ) {
        	                	//alert('1'+$img.attr( 'src' ));
    	                        self.$loading.hide();
    	                        //self.$fullimage.find( 'img' ).remove();
    	                        self.$largeImg = $img.fadeIn( 350 );
    	                        self.$fullimage.append( self.$largeImg );
    	                    }
    	                } ).attr( 'src', eldata.largesrc );
    	            }

    	        },
    	        open : function() {

    	            setTimeout( $.proxy( function() {
    	                // set the height for the preview and the item
    	                this.setHeights();
    	                // scroll to position the preview in the right place
    	                this.positionPreview();
    	                

    	                var parto=this.$item.closest('.aq-block-ful').find('.fullbgspacer');
    	                    var ph=parto.parent().height();
    	                      	parto.css('height',ph);
    	                
    	                
    	                
    	            }, this ), 105 );
    	            this.$item.parent().addClass( 'og-expandeds' );
    	            this.$item.parent().parent().addClass( 'og-par' );

    	        },
    	        close : function() {

    	            var self = this,
    	                onEndFn = function() {
    	                    if( support ) {
    	                        $( this ).off( transEndEventName );
    	                    }
    	                    self.$item.removeClass( 'og-expanded' );

    	                    self.$previewEl.remove();

    	                };

    	            setTimeout( $.proxy( function() {

    	                if( typeof this.$largeImg !== 'undefined' ) {
    	                    this.$largeImg.fadeOut( 'fast' );
    	                }
    	                this.$previewEl.css( 'height', 0 );
    	                this.$previewEl.parent().css( 'height', 'auto' );
    	                // the current expanded item (might be different from this.$item)
    	                var $expandedItem = $items.eq( this.expandedIdx );
    	                $expandedItem.css( 'height', $expandedItem.data( 'height' ) ).on( transEndEventName, onEndFn );

    	                var parto=this.$item.closest('.aq-block-ful').find('.fullbgspacer');
    	                    var ph=parto.parent().height();
    	                      	parto.css('height',ph);
    	                if( !support ) {
    	                    onEndFn.call();
    	                }

    	            }, this ), 25 );


    	            self.$item.parent().removeClass( 'og-expandeds' );
    	            self.$item.parent().parent().removeClass( 'og-par' );

    	            return false;

    	        },
    	        calcHeight : function() {

    	           /* var heightPreview = winsize.height - this.$item.data( 'height' ) - marginExpanded,*/
    	        	//console.log(this.$item.parent().parent().html());
    	        	var heightPreview=this.$item.parent().parent().find('.og-expander .og-fullimg img').height();
    	             var  itemHeight = heightPreview+this.$item.data( 'height' );
    	                var ddi=this.$item;
    	                
        	            if(heightPreview===null) {
        	            	//alert('null');

        	            	setTimeout(function() {
            	        	heightPreview=ddi.parent().parent().find('.og-expander .og-fullimg img').height();
            	            itemHeight = heightPreview+ddi.data( 'height' );
    	    	            this.height = heightPreview;
    	    	            this.itemHeight = itemHeight;
            	        }, 305 );
        	            } else {
                            if(isNaN(itemHeight))itemHeight=heightPreview+250;
                            //console.log('hP:'+heightPreview+ 'iH:'+itemHeight);
            	            this.height = heightPreview;
            	            this.itemHeight = itemHeight;
        	            }

    	            /*if( heightPreview < settings.minHeight ) {
    	                heightPreview = settings.minHeight;
    	                itemHeight = settings.minHeight + this.$item.data( 'height' ) + marginExpanded;
    	            }*/


    	        },
    	        setHeights : function() {

    	            var self = this,
    	                onEndFn = function() {
    	                    if( support ) {
    	                        self.$item.off( transEndEventName );
    	                    }
    	                    self.$item.addClass( 'og-expanded' );

    	                };

        	            this.calcHeight();
        	            if(this.height==null)this.calcHeight();
        	            if(this.height==null)this.calcHeight();
    	            this.$previewEl.css( 'height', this.height );

    	            this.$item.parent().parent().css( 'height', this.itemHeight ).on( transEndEventName, onEndFn );

    	            if( !support ) {
    	                onEndFn.call();
    	            }

    	        },
    	        positionPreview : function() {

    	            // scroll page
    	            // case 1 : preview height + item height fits in window´s height
    	            // case 2 : preview height + item height does not fit in window´s height and preview height is smaller than window´s height
    	            // case 3 : preview height + item height does not fit in window´s height and preview height is bigger than window´s height
    	            var position = this.$item.data( 'offsetTop' ),
    	                previewOffsetT = this.$previewEl.offset().top - scrollExtra,
    	                scrollVal = this.height + this.$item.data( 'height' ) + marginExpanded <= winsize.height ? position : this.height < winsize.height ? previewOffsetT - ( winsize.height - this.height ) : previewOffsetT;

    	            $body.animate( { scrollTop : scrollVal-70 }, settings.speed );

    	        },
    	        setTransition  : function() {
    	            this.$previewEl.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
    	            this.$item.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
    	        },
    	        getEl : function() {
    	            return this.$previewEl;
    	        }
    	    }

    	    return {
    	        init : init,
    	        addItems : addItems
    	    };

    	})();
    	    Grid.init();

    
});

function fullspacerheight(){
    jQuery(document).ready(function($){

    jQuery('.fullbgspacer').each(function(){
        var ph=jQuery(this).parent().height();

        jQuery(this).css('height',ph);
    });
        });
}
function checkMiniGalleries() {

    jQuery(document).ready(function (jQuery) {
        indx = jQuery('.tab-pane.active').attr('id');

        if (jQuery('.product-mini-gallery').length > 0) {

            jQuery('.product-mini-gallery').carouFredSel({
                auto: false
            });


        }
    });

}
function checkMiniGallerie() {

    jQuery(document).ready(function (jQuery) {
        indx = jQuery('.tab-pane.active').attr('id');
        if (jQuery('.product-mini-gallery').length > 0) {

            jQuery('.product-mini-gallery').carouFredSel({
                auto: false
            });


        }
    });

}
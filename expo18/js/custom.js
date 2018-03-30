jQuery(function($){
	locallinks_init();
	countdown_init();
	menu_init();
	secmenu_init();
	//slider_init();
	infopane_init();
	speakers_init();
	
	toggle_init();
	tabs_init();
	
	news_init();
	agenda_init();
	
	logos_init();
	
	shadelr_init();
	
	tooltips_init();
	
	sidebar_lists_init();
	
	jQuery('.navigation-prev-next .navigation-next a, .navigation-prev-next .navigation-prev a').append('<span class="after" />');
	
	//headline_init();
	
	placeholders_fix();
	
	registration_form_init();
	
	responsive_embed_init();

	if(jQuery.browser.webkit)
		jQuery('body').addClass('webkit');

	//prettyPhoto
	jQuery('a[rel^=prettyPhoto]').addClass('pp_worked_up').prettyPhoto();
	var $tmp=jQuery('a[href$=".jpg"], a[href$=".png"], a[href$=".gif"], a[href$=".jpeg"], a[href$=".bmp"]').not('.pp_worked_up');
	$tmp.each(function(){
		if(typeof(jQuery(this).attr('title')) == 'undefined')
			jQuery(this).attr('title',''); 
	});
	$tmp.prettyPhoto();
	
	/****************************************************/
	
	function responsive_embed_init() {
		$('.responsive-embed').each(function(){
			var $obj=$(this).children(':first');
			if($obj.length) {
				var w=parseInt($obj.attr('width'));
				var h=parseInt($obj.attr('height'));
				if(!isNaN(w) && !isNaN(h) && w > 0 && h > 0) {
					var r=h/w;
					$(this).css('padding-bottom',(r*100)+'%');
				}
			}
		});
	}
	
});

function sidebar_lists_init()
{
	jQuery('.sidebar-inner ul > li').each(function(){
		var html=jQuery(this).html();
		var match=html.match(/\([0-9]+\)[\s]*$/);
		if(match != null)
		{
			html='<span class="sidebar-list-num">'+( match[0].replace('(','').replace(')','') )+'</span>' + html.replace(match[0],'');
			jQuery(this).html(html);
		}
	});
}

function locallinks_init()
{
	jQuery('a[href^="#"]').each(function(){
		var rel=jQuery(this).attr('href');
		var $obj=jQuery(rel);
		if($obj.length)
		{
			jQuery(this).click(function(){
				var top=$obj.offset().top-20;
				jQuery('body,html').stop(true).animate({scrollTop: top+'px'}, 700);
					
				window.location.hash=rel;
				return false;
			});
		}
	});
}

function menu_init()
{
	jQuery('.primary-menu ul').each(function(){
		jQuery(this).parent().mouseleave(function(){
			jQuery(this).children('ul').stop(true).fadeTo(200,0,function(){
				jQuery(this).hide();
			});
		}).children('a').mouseenter(function(){
			jQuery(this).next('ul').stop(true).show().fadeTo(200,1);
		});
	});
}

function secmenu_init()
{
	jQuery('.secondary-menu').css('min-width',jQuery('.secondary-menu-control').outerWidth());
	jQuery('.secondary-menu-control').click(function(){
		jQuery(this).parent().find('.secondary-menu-wrapper').stop(true).show().fadeTo(200,1);

		return false;
	});
	
	jQuery('.secondary-menu-container').mouseleave(function(){
		jQuery(this).find('.secondary-menu-wrapper').stop(true).fadeTo(200,0,function(){
			jQuery(this).hide();
		});
	});
}

function slider_init(timeout, speed, animation_type)
{
	if(typeof(timeout) == 'undefined')
		timeout=6000;

	if(typeof(speed) == 'undefined')
		speed=800;
		
	if(typeof(animation_type) == 'undefined')
		animation_type='custom';
		
	var $=jQuery;
	if($('#homepage-slider').length == 0)
		return;	
		
	var $pager=$('<div class="slider-pager" />').appendTo('#homepage-slider');
	var $progress=$('<div class="slider-progress" />');
	var $progress_inner=$('<div class="inner" />').appendTo($progress);
	var $next=$('<a href="#">&gt;</a>');

	var cycle_options={
				pager: $pager,
				fx: animation_type, 
				speed: speed,
				timeout: timeout,
				slideResize: 0,
				next: $next
	}
	if(timeout > 0)
	{
		cycle_options.before=function(){
			$progress_inner.stop(true).css('width','0').animate({width: '100%'}, (timeout-speed), 'linear');
		}
	}
	if(animation_type == 'custom')
	{
		cycle_options.fx='fade';
		cycle_options.before=function(currSlideElement, nextSlideElement, options, forwardFlag){
			var $obj=$(nextSlideElement).find('.text');
			$obj.stop(true).css('margin-top','-320px');
			setTimeout(function(){
				$obj.animate({marginTop:0},speed, 'easeOutExpo');
			}, 300);
			
			if(timeout > 0)
				$progress_inner.stop(true).css('width','0').animate({width: '100%'}, timeout, 'linear');
		}
	}
	
	$('#homepage-slider').find('.slider-slides').cycle(cycle_options);
	$next.appendTo($pager);
	if(timeout > 0)
		$progress.appendTo($pager);
}

function headline_init()
{
	var pw=jQuery(window).width();
	jQuery('.headline-wrapper').mousemove(function(e){
		var k=e.pageX/pw-0.5;
		var bx=Math.round(k*600);
		var sx=Math.round(k*300);
		jQuery('.headline-wrapper').stop(true).animate({backgroundPosition: bx+'px 0'}, 1000);
		jQuery('.headline').stop(true).animate({backgroundPosition: sx+'px 0'}, 1000);
	});
}

function speakers_init()
{
	jQuery('.speaker-item').each(function(){
		if(jQuery(this).parent().is('p'))
			jQuery(this).unwrap();
			
		if(jQuery(this).next().next().is('.speaker-item')) {
			var $next=jQuery(this).next();
			if($next.is('br'))
				$next.remove();
			if($next.is('p'))
			{
				if($next.text().replace( /^\s+/g, '').length == 0)
					$next.remove();
			}
		}
	});
	
	while(true)
	{
		var $first=jQuery('.speaker-item:first');
		if($first.length == 0)
			break;
		$first.nextUntil(':not(.speaker-item)').add($first).removeClass('speaker-item').wrapAll('<ul class="speakers" />').wrap('<li />');
	}
	
	jQuery('ul.speakers').wrap('<div class="speakers-wrapper" />');
	
	jQuery('.speakers').isotope({
  	layoutMode: 'fitRows',
  	containerStyle: { position: 'relative', overflow: 'visible' }
	});

	jQuery(window).load(function(){
		jQuery('.speakers').isotope('reLayout');
	});
}

function logos_init()
{
	jQuery('.logos img').addClass('to_process');
	jQuery('.logos a').wrap('<div class="item" />').find('img').removeClass('to_process');
	jQuery('.logos img.to_process').removeClass('to_process').wrap('<div class="item" />');
}

function news_init()
{
	jQuery('#news > li').addClass('shade-lr').mouseleave(function(){
		jQuery('#news > li.hov').removeClass('hov');
	}).mouseenter(function(){
		jQuery('#news > li.hov').removeClass('hov');
	});
	jQuery('#news > li:first').addClass('hov');
}

function agenda_init()
{
	jQuery('.agenda-item').addClass('shade-lr');
}

function shadelr_init()
{
	jQuery('.shade-lr').append('<span class="shade_l"/><span class="shade_r"/>');
}

function infopane_init()
{
	jQuery('.binfopane-button').wrapInner('<span class="inner"/>').prepend('<span class="hov"/>');
	jQuery('.binfopane-button').mouseenter(function(){
		jQuery(this).children('.hov').stop(true).fadeTo(700,1);
		jQuery(this).children('.inner:not(:animated)').animate({backgroundPosition: '200% 0'},500,'easeInExpo',function(){
			jQuery(this).css('background-position','-100% 0').animate({backgroundPosition: '50% 0'},500,'easeOutExpo');
		});
	}).mouseleave(function(){
		jQuery(this).children('.hov').stop(true).fadeTo(500,0);
		jQuery(this).children('.inner:not(:animated)').animate({backgroundPosition: '50% 0'},500);
	});
}

function countdown_init()
{
	if(jQuery('#countdown').length)
	{
		var $obj=jQuery('#countdown');
		var hideseconds=false;
		if($obj.data('hideseconds'))
			hideseconds=true;
			
		var label_days=$obj.data('days');
		var label_hrs=$obj.data('hrs');
		var label_min=$obj.data('min');
		var label_sec=$obj.data('sec');
		
		var txt=$obj.text().replace( /^\s+/g, '').replace( /\s+$/g, '');
		var tmp=txt.split(' ');
		if(tmp.length == 2)
		{
			var tmp_d=tmp[0].split('-');
			var tmp_h=tmp[1].split(':');
			if(tmp_d.length == 3 && tmp_h.length == 3)
			{
				var html=
					'<div class="countdown-box">'+
						'<div class="field">'+
							'<div class="value" id="countdown-days"><div class="current"></div><div class="next"></div><div class="shade"></div></div>'+
							'<div class="name">'+label_days+'</div>'+
						'</div>'+
						'<div class="field dropshade">'+
							'<div class="value" id="countdown-hours"><div class="current"></div><div class="next"></div><div class="shade"></div></div>'+
							'<div class="name">'+label_hrs+'</div>'+
						'</div>';
				if(hideseconds) {
					html+=
						'<div class="field dropshade last">'+
							'<div class="value" id="countdown-minutes"><div class="current"></div><div class="next"></div><div class="shade"></div></div>'+
							'<div class="name">'+label_min+'</div>'+
						'</div>';
				} else {
					html+=
						'<div class="field dropshade">'+
							'<div class="value" id="countdown-minutes"><div class="current"></div><div class="next"></div><div class="shade"></div></div>'+
							'<div class="name">'+label_min+'</div>'+
						'</div>'+
						'<div class="field dropshade last">'+
							'<div class="value" id="countdown-seconds"><div class="current"></div><div class="next"></div><div class="shade"></div></div>'+
							'<div class="name">'+label_sec+'</div>'+
						'</div>';
				}
				html+=
						'<div class="clear"></div>'+
					'</div>';

				jQuery('#countdown').after(html);
				jQuery('.countdown-box').attr('data-label',$obj.data('label'));
				if(hideseconds)
					jQuery('.countdown-box, .headline-right').addClass('no-seconds');
				
				var args={
					until: new Date(tmp_d[0], tmp_d[1]-1, tmp_d[2], tmp_h[0], tmp_h[1], tmp_h[2]),
					onTick: countdown_tick
				};
				if(hideseconds)
					args.tickInterval=60;
				$obj.countdown(args);
				if(hideseconds)
					countdown_tick($obj.countdown('getTimes'));
			}
			else
				jQuery(this).remove();
		}
		else
			jQuery(this).remove();
	}
}

function countdown_tick(periods)
{
	var d,h,m,s;
	var cd,ch,cm,cs;
	
	if(periods[3] < 10)
		d='0'+periods[3];
	else
		d=periods[3];
		
	if(periods[4] < 10)
		h='0'+periods[4];
	else
		h=periods[4];
		
	if(periods[5] < 10)
		m='0'+periods[5];
	else
		m=periods[5];
		
	if(periods[6] < 10)
		s='0'+periods[6];
	else
		s=periods[6];
	
	cd=jQuery('#countdown-days').children('.current').text();
	ch=jQuery('#countdown-hours').children('.current').text();
	cm=jQuery('#countdown-minutes').children('.current').text();
	
	var $secObj=jQuery('#countdown-seconds');
	if($secObj.length)
		cs=$secObj.children('.current').text();
	
	if($secObj.length && s != cs)
	{
		var $next=jQuery('#countdown-seconds').children('.next');
		var $current=jQuery('#countdown-seconds').children('.current');
		countdown_scroll($next,$current,s);
	}
	
	if(m != cm)
	{
		var $next=jQuery('#countdown-minutes').children('.next');
		var $current=jQuery('#countdown-minutes').children('.current');
		countdown_scroll($next,$current,m);
	}
	
	if(h != ch)
	{
		var $next=jQuery('#countdown-hours').children('.next');
		var $current=jQuery('#countdown-hours').children('.current');
		countdown_scroll($next,$current,h);
	}
	
	if(d != cd)
	{
		var $next=jQuery('#countdown-days').children('.next');
		var $current=jQuery('#countdown-days').children('.current');
		countdown_scroll($next,$current,d);
	}
}

function countdown_scroll($next,$current,val)
{
	var cur_top=0;
	var next_top=-54;
	var cur_goto_top=54;
	
	if(val.toString().length > 2)
		$next.addClass('narrow');
	else
		$next.removeClass('narrow');
	$next.html(val);

	$next.removeClass('next').addClass('current');
	$next.css('top',next_top+'px');
	$next.stop(true).animate({top:cur_top+'px'},1000, 'linear');
	
	$current.removeClass('current').addClass('next');
	$current.stop(true).animate({top:cur_goto_top+'px'},1000, 'linear');
}

/*************************************************************************/

function tooltips_init()
{
	var $=jQuery;
	var tt_id=1;
	$('.add-tooltip').each(function(){
		var title=$(this).attr('title');
		if(typeof(title) == 'undefined')
			return;
		$(this).data('tooltip_id',tt_id);
		
		$(this).mouseenter(function(){
			$(this).attr('title','');
			var id=$(this).data('tooltip_id');
			var $tt=$('#tooltip_'+id).stop();
			if(!$tt.length)
			{
				var pos=$(this).offset();
				$tt=$('<div class="tooltip" id="tooltip_'+id+'">'+title+'</div>');
				$tt.appendTo('body');
				$tt.css('left',pos.left + Math.round($(this).outerWidth()/2));
				$tt.css('top',pos.top - $tt.outerHeight());
			}
			$tt.show();
			$tt.animate({opacity:1, marginTop: '-6px'}, 200);
		});

		$(this).mouseleave(function(){
			$(this).attr('title',title);
			var id=$(this).data('tooltip_id');
			$('#tooltip_'+id).stop().animate({opacity:0, marginTop: '-15px'}, 200, function(){
				$(this).remove();
			});
		});

		tt_id++;
	});
	
}

function toggle_init()
{
	var $=jQuery;
	
	$('.accordion .toggle-title').addClass('in-accordion').click(function(){
		if($(this).hasClass('expanded'))
			return false;

		var $acc=$(this).parents('.accordion');
		$acc.find('.toggle-title').removeClass('expanded');
		$acc.find('.toggle-inner').slideUp(300);
		
		$(this).parent().find('.toggle-inner').slideDown(300);
		$(this).addClass('expanded');
		
	});
	
	$('.toggle-title').not('.in-accordion').click(function(){
		var $inner=$(this).parent().find('.toggle-inner');
		if(!$inner.length)
			return false;
		if($inner.is(':animated'))
			return false;
		
		$(this).toggleClass('expanded');
		$inner.slideToggle(300);
		
		return false;
	});
}

function tabs_init()
{
	var $=jQuery;
	
	$('.tabs').each(function(){
		$(this).find('.tabs-control a:first').addClass('active');
		$(this).find('.tabs-tabs .tabs-tab:first').addClass('active').show();
	});
	
	$('.tabs .tabs-control a').click(function(){
		var $tabs=$(this).parents('.tabs');
		if(!$tabs.length)
			return false;
			
		var tabname=$(this).attr('href').replace('#','');
		
		$tabs.find('.tabs-control a').removeClass('active');
		$(this).addClass('active');

		$tabs.find('.tabs-tabs .tabs-tab.active').hide().removeClass('active');
		$tabs.find('.tabs-tabs .tabs-tab.'+tabname).addClass('active').fadeIn(300);
		
		$tabs.find('.tabs-tabs .tabs-tab.'+tabname).find('.isotope').each(function(){
			$(this).isotope('reLayout');
		});
		
		return false;
	});

}

function placeholders_fix () {

	var input = document.createElement("input");
  if(('placeholder' in input)==false) { 
		jQuery('[placeholder]').focus(function() {
			var i = jQuery(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					this.type='password';
				}			
			}
		}).blur(function() {
			var i = jQuery(this);	
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					this.type='text';
				}
				i.addClass('placeholder').val(i.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			jQuery(this).find('[placeholder]').each(function() {
				var i = jQuery(this);
				if(i.val() == i.attr('placeholder')) {
					i.val('').removeClass('placeholder').addClass('placeholder-submitting');
					if(i.hasClass('password')) {
						i.removeClass('password');
						this.type='password';
					}			
				}
			})
		});
	}
	
}

function registration_form_init() {
	
  var options = {
		success: registration_form_success,
		beforeSubmit: registration_form_before
	}; 	
	
	jQuery.extend(jQuery.validator.messages, {
	    required: "&larr;"
	});
	
	var validate_options={
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit(options);
		},
		errorPlacement: function(error, element) {
			if(jQuery(element).attr('type') == 'checkbox')
				error.insertAfter(element);
		},
		errorClass: 'error'
	};

  if(('placeholder' in document.createElement("input"))==false) { 
  	validate_options.invalidHandler = function(event, validator) {
			jQuery(this).find('[placeholder]').each(function(){
				var i = jQuery(this);	
				if(i.val() == '' || i.val() == i.attr('placeholder')) {
					if(this.type=='password') {
						i.addClass('password');
						this.type='text';
					}
					i.addClass('placeholder').val(i.attr('placeholder'));
				}
			});
		};
		validate_options.focusInvalid=false;
  }
	
	jQuery("#registration-form").validate(validate_options);


}

function registration_form_before()
{
	var $obj=jQuery('#registration-form');
	$obj.fadeTo(300,0.5);
	$obj.before('<div id="registration-form-blocker" style="position:absolute;width:'+$obj.outerWidth()+'px;height:'+$obj.outerHeight()+'px;z-index:9999;"></div>');
}

function registration_form_success(resp)
{
	jQuery('#registration-form-blocker').remove();
	if(resp == '0')
	{
		jQuery('#registration-form').fadeOut(300,function(){
			jQuery('#registration-form').remove();
			jQuery('#registration-form-success').fadeIn(200);
		});
	}
	else
	{
		jQuery('#registration-form').fadeOut(300,function(){
			jQuery('#registration-form').remove();
			jQuery('#registration-form-error').fadeIn(200);
		});		
	}
}
var ddaccordion={
	ajaxloadingmsg: '<img src="" /><br />Loading Content...', 

	headergroup: {},
	contentgroup: {},

	preloadimages:function($images){
		$images.each(function(){
			var preloadimage=new Image()
			preloadimage.src=this.src
		})
	},

	expandone:function(headerclass, selected){ 
		this.toggleone(headerclass, selected, "expand")
	},

	collapseone:function(headerclass, selected){ 
		this.toggleone(headerclass, selected, "collapse")
	},

	expandall:function(headerclass){
		var $headers=this.headergroup[headerclass]
		this.contentgroup[headerclass].filter(':hidden').each(function(){
			$headers.eq(parseInt($(this).attr('contentindex'))).trigger("evt_accordion")
		})
	},

	collapseall:function(headerclass){ 
		var $headers=this.headergroup[headerclass]
		this.contentgroup[headerclass].filter(':visible').each(function(){
			$headers.eq(parseInt($(this).attr('contentindex'))).trigger("evt_accordion")
		})
	},

	toggleone:function(headerclass, selected, optstate){ 
		var $targetHeader=this.headergroup[headerclass].eq(selected)
		var $subcontent=this.contentgroup[headerclass].eq(selected)
		if (typeof optstate=="undefined" || optstate=="expand" && $subcontent.is(":hidden") || optstate=="collapse" && $subcontent.is(":visible"))
			$targetHeader.trigger("evt_accordion")
	},

	ajaxloadcontent:function($targetHeader, $targetContent, config, callback){
		var ajaxinfo=$targetHeader.data('ajaxinfo')

		function handlecontent(content){ 
			if (content){ 
				ajaxinfo.cacheddata=content  
				ajaxinfo.status="cached" 
				if ($targetContent.queue("fx").length==0){ 
					$targetContent.hide().html(content) 
					ajaxinfo.status="complete" 
					callback() 
				}
			}
			if (ajaxinfo.status!="complete"){
				setTimeout(function(){handlecontent(ajaxinfo.cacheddata)}, 100) 
			}
		}
		if (ajaxinfo.status=="none"){
			$targetContent.html(this.ajaxloadingmsg)
			$targetContent.slideDown(config.animatespeed)
			ajaxinfo.status="loading"
			$.ajax({
				url: ajaxinfo.url,
				error:function(ajaxrequest){
					handlecontent('Error fetching content. Server Response: '+ajaxrequest.responseText)
				},
				success:function(content){
					content=(content=="")? " " : content
					handlecontent(content)
				}
			})
		}
		else if (ajaxinfo.status=="loading")
			handlecontent(ajaxinfo.cacheddata)
	},

	expandit:function($targetHeader, $targetContent, config, useractivated, directclick, skipanimation){
		var ajaxinfo=$targetHeader.data('ajaxinfo')
		if (ajaxinfo){
			if (ajaxinfo.status=="none" || ajaxinfo.status=="loading")
				this.ajaxloadcontent($targetHeader, $targetContent, config, function(){ddaccordion.expandit($targetHeader, $targetContent, config, useractivated, directclick)})
			else if (ajaxinfo.status=="cached"){
				$targetContent.html(ajaxinfo.cacheddata)
				ajaxinfo.cacheddata=null
				ajaxinfo.status="complete"
			}
		}
		this.transformHeader($targetHeader, config, "expand")
		$targetContent.slideDown(skipanimation? 0 : config.animatespeed, function(){
			config.onopenclose($targetHeader.get(0), parseInt($targetHeader.attr('headerindex')), $targetContent.css('display'), useractivated)
			if (config.postreveal=="gotourl" && directclick){ 
				var targetLink=($targetHeader.is("a"))? $targetHeader.get(0) : $targetHeader.find('a:eq(0)').get(0)
				if (targetLink) 
					setTimeout(function(){location=targetLink.href}, 200)
			}
		})
	},

	collapseit:function($targetHeader, $targetContent, config, isuseractivated){
		this.transformHeader($targetHeader, config, "collapse")
		$targetContent.slideUp(config.animatespeed, function(){config.onopenclose($targetHeader.get(0), parseInt($targetHeader.attr('headerindex')), $targetContent.css('display'), isuseractivated)})
	},

	transformHeader:function($targetHeader, config, state){
		$targetHeader.addClass((state=="expand")? config.cssclass.expand : config.cssclass.collapse)
		.removeClass((state=="expand")? config.cssclass.collapse : config.cssclass.expand)
		if (config.htmlsetting.location=='src'){
			$targetHeader=($targetHeader.is("img"))? $targetHeader : $targetHeader.find('img').eq(0) 
			$targetHeader.attr('src', (state=="expand")? config.htmlsetting.expand : config.htmlsetting.collapse) 
		}
		else if (config.htmlsetting.location=="prefix") 
			$targetHeader.find('.accordprefix').html((state=="expand")? config.htmlsetting.expand : config.htmlsetting.collapse)
		else if (config.htmlsetting.location=="suffix")
			$targetHeader.find('.accordsuffix').html((state=="expand")? config.htmlsetting.expand : config.htmlsetting.collapse)
	},

	urlparamselect:function(headerclass){
		var result=window.location.search.match(new RegExp(headerclass+"=((\\d+)(,(\\d+))*)", "i"))
		if (result!=null)
			result=RegExp.$1.split(',')
		return result
	},

	getCookie:function(Name){ 
		var re=new RegExp(Name+"=[^;]+", "i")
		if (document.cookie.match(re))
			return document.cookie.match(re)[0].split("=")[1]
		return null
	},

	setCookie:function(name, value){
		document.cookie = name + "=" + value + "; path=/"
	},

	init:function(config){
	document.write('<style type="text/css">\n')
	document.write('.'+config.contentclass+'{display: none}\n')
	document.write('a.hiddenajaxlink{display: none}\n')
	document.write('<\/style>')
	jQuery(document).ready(function($){
		ddaccordion.urlparamselect(config.headerclass)
		var persistedheaders=ddaccordion.getCookie(config.headerclass)
		ddaccordion.headergroup[config.headerclass]=$('.'+config.headerclass)
		ddaccordion.contentgroup[config.headerclass]=$('.'+config.contentclass)
		var $headers=ddaccordion.headergroup[config.headerclass]
		var $subcontents=ddaccordion.contentgroup[config.headerclass]
		config.cssclass={collapse: config.toggleclass[0], expand: config.toggleclass[1]}
		config.revealtype=config.revealtype || "click"
		config.revealtype=config.revealtype.replace(/mouseover/i, "mouseenter")
		if (config.revealtype=="clickgo"){
			config.postreveal="gotourl"
			config.revealtype="click"
		}
		if (typeof config.togglehtml=="undefined")
			config.htmlsetting={location: "none"}
		else
			config.htmlsetting={location: config.togglehtml[0], collapse: config.togglehtml[1], expand: config.togglehtml[2]}
		config.oninit=(typeof config.oninit=="undefined")? function(){} : config.oninit
		config.onopenclose=(typeof config.onopenclose=="undefined")? function(){} : config.onopenclose 
		var lastexpanded={}
		var expandedindices=ddaccordion.urlparamselect(config.headerclass) || ((config.persiststate && persistedheaders!=null)? persistedheaders : config.defaultexpanded)
		if (typeof expandedindices=='string')
			expandedindices=expandedindices.replace(/c/ig, '').split(',')
		if (expandedindices.length==1 && expandedindices[0]=="-1")
			expandedindices=[]
		if (config["collapseprev"] && expandedindices.length>1)
			expandedindices=[expandedindices.pop()]
		if (config["onemustopen"] && expandedindices.length==0)
			expandedindices=[0]
		$headers.each(function(index){
			var $header=$(this)
			if (/(prefix)|(suffix)/i.test(config.htmlsetting.location) && $header.html()!=""){ 
				$('<span class="accordprefix"></span>').prependTo(this)
				$('<span class="accordsuffix"></span>').appendTo(this)
			}
			$header.attr('headerindex', index+'h')
			$subcontents.eq(index).attr('contentindex', index+'c')
			var $subcontent=$subcontents.eq(index)
			var $hiddenajaxlink=$subcontent.find('a.hiddenajaxlink:eq(0)')
			if ($hiddenajaxlink.length==1){
				$header.data('ajaxinfo', {url:$hiddenajaxlink.attr('href'), cacheddata:null, status:'none'})
			}
			var needle=(typeof expandedindices[0]=="number")? index : index+''
			if (jQuery.inArray(needle, expandedindices)!=-1){
				ddaccordion.expandit($header, $subcontent, config, false, false, !config.animatedefault)
				lastexpanded={$header:$header, $content:$subcontent}
			}
			else{
				$subcontent.hide()
				config.onopenclose($header.get(0), parseInt($header.attr('headerindex')), $subcontent.css('display'), false)
				ddaccordion.transformHeader($header, config, "collapse")
			}
		})
		$headers.bind("evt_accordion", function(e, isdirectclick){
				var $subcontent=$subcontents.eq(parseInt($(this).attr('headerindex')))
				if ($subcontent.css('display')=="none"){
					ddaccordion.expandit($(this), $subcontent, config, true, isdirectclick)
					if (config["collapseprev"] && lastexpanded.$header && $(this).get(0)!=lastexpanded.$header.get(0)){
						ddaccordion.collapseit(lastexpanded.$header, lastexpanded.$content, config, true)
					}
					lastexpanded={$header:$(this), $content:$subcontent}
				}
				else if (!config["onemustopen"] || config["onemustopen"] && lastexpanded.$header && $(this).get(0)!=lastexpanded.$header.get(0)){
					ddaccordion.collapseit($(this), $subcontent, config, true)
				}
 		})
		$headers.bind(config.revealtype, function(){
			if (config.revealtype=="mouseenter"){
				clearTimeout(config.revealdelay)
				var headerindex=parseInt($(this).attr("headerindex"))
				config.revealdelay=setTimeout(function(){ddaccordion.expandone(config["headerclass"], headerindex)}, config.mouseoverdelay || 0)
			}
			else{
				$(this).trigger("evt_accordion", [true])
				return false
			}
		})
		$headers.bind("mouseleave", function(){
			clearTimeout(config.revealdelay)
		})
		config.oninit($headers.get(), expandedindices)
		$(window).bind('unload', function(){
			$headers.unbind()
			var expandedindices=[]
			$subcontents.filter(':visible').each(function(index){
				expandedindices.push($(this).attr('contentindex'))
			})
			if (config.persiststate==true && $headers.length>0){
				expandedindices=(expandedindices.length==0)? '-1c' : expandedindices
				ddaccordion.setCookie(config.headerclass, expandedindices)
			}
		})
	})
	}
}
ddaccordion.preloadimages(jQuery(ddaccordion.ajaxloadingmsg).filter('img'))

	/*
	ddaccordion.init({
		headerclass: "expandable",
		contentclass: "categoryitems",
		revealtype: "click",
		mouseoverdelay: 200,
		collapseprev: true, 
		defaultexpanded: [0],
		onemustopen: false, 
		animatedefault: false,
		persiststate: false,
		toggleclass: ["", "openheader"],
		togglehtml: ["prefix", "", ""],
		animatespeed: "fast",
		oninit:function(headers, expandedindices){
		},
		onopenclose:function(header, index, state, isuseractivated){
		}
	})
*/
ddaccordion.init({
	headerclass: "subexpandable", 
	contentclass: "subcategoryitems",
	revealtype: "click",
	mouseoverdelay: 200,
	collapseprev: true, 
	defaultexpanded: [],
	onemustopen: false,
	animatedefault: false,
	persiststate: false,
	toggleclass: ["opensubheader", "closedsubheader"],
	togglehtml: ["none", "", ""],
	animatespeed: "fast",
	oninit:function(headers, expandedindices){ 
	},
	onopenclose:function(header, index, state, isuseractivated){
	}
})
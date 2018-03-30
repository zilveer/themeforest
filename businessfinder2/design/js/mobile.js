/*
 * AIT WordPress Theme
 *
 * Copyright (c) 2012-2014, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

"use strict";

function isResponsive(width){
	var w=window,
		d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth;
	return x <= parseInt(width);
}

function isUserAgent(type){
	return navigator.userAgent.toLowerCase().indexOf(type.toLowerCase()) > -1;
}

function isMobile(){
	// maybe inherit modernizr.touchevents
	return isResponsive(640) && (isUserAgent('android') || isUserAgent('iphone') || isUserAgent('ipad') || isUserAgent('ipod'));
}

function isTablet(){
	// maybe inherit modernizr.touchevents
	return isResponsive(1024) && (isUserAgent('ipad') || isUserAgent('android'));
}

function isAndroid(){
	return isUserAgent('android');
}

function isIpad(){
	return isUserAgent('ipad');
}
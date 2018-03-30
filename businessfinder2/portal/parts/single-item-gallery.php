{* REQUIRED PARAMETERS *}
{*
	$post - global wp post
	$meta - meta data of Item
*}

{var $galleryItems = array()}

{if $post->hasImage}
	{? array_push($galleryItems, array(
		'title' => $post->title,
		'image' => $post->imageUrl
	))}
{/if}

{if is_array($meta->gallery)}
	{* We can merge because item's gallery has both title and attribute properties *}
	{var $galleryItems = array_merge($galleryItems, $meta->gallery)}
{/if}

<div class="item-gallery gallery-wrapper">
	<div class="gallery-slider">

		{* FEATURES SECTION *}
		{includePart portal/parts/single-item-features}
		{* FEATURES SECTION *}

		<ul class="slider-items">
			{foreach $galleryItems as $item}
			<li {if $iterator->first}class="active"{/if}>
				<a href="{$item['image']}" target="_blank" data-rel="item-gallery" data-focus="disabled">
					<div style="background-image: url('{imageUrl $item['image'], width => 1000, height => 500, crop => 1}')"></div>
				</a>
			</li>
			{/foreach}
		</ul>
		<div class="navigation-arrows">
			<div class="arrow-left"><i class="fa fa-chevron-left"></i></div>
			<div class="arrow-right"><i class="fa fa-chevron-right"></i></div>
		</div>
	</div>

	<div class="gallery-aside">
		<h3>{__ 'Gallery'}</h3>
		<div class="navigation-list-wrapper">
			<div class="optiscroll">
				<div class="optiscroll-content">
					<ul class="navigation-list">
						{capture $defaultLabel}{__ 'Image'}{/capture}
						{foreach $galleryItems as $item}
						<li class="navigation-item{if $iterator->first} active{/if}">
							{var $label = !empty($item['title']) ? $item['title'] : ($defaultLabel . ' ' . $iterator->counter)}
							<a href="#">{!$label}</a>
						</li>
						{/foreach}
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<script id="single-item-gallery-script">

var singleItemGallery = singleItemGallery || {};

(function($, $window, $document, undefined){
	"use strict";

	var gallery = {
		items: [],
		context: null,
		currentIndex: 0,
		listeners: [],

		dispatch: function() {
			for (var i=0; i < gallery.listeners.length; i++) {
				gallery.listeners[i].apply();
			}
		}

	};

	// ===============================================
	// Start
	// -----------------------------------------------

	$(function(){
		// initialize gallery
		gallery.context = $('.item-gallery.gallery-wrapper');
		gallery.items = gallery.context.find('ul.slider-items li');

		var updateArrows = function() {
			console.log("updating arrows");
			gallery.context.find(".navigation-arrows .arrow-right").removeClass('disabled');
			gallery.context.find(".navigation-arrows .arrow-left").removeClass('disabled');

			if (gallery.currentIndex == 0) {
				gallery.context.find(".navigation-arrows .arrow-left").addClass('disabled');
			} else if ((gallery.currentIndex + 1) == gallery.items.length) {
				gallery.context.find(".navigation-arrows .arrow-right").addClass('disabled');
			}
		};
		gallery.listeners.push(updateArrows);

		var updateListNav = function() {
			console.log("updating list nav");
			gallery.context.find("ul.navigation-list li").each(function(index, value){
				if (gallery.currentIndex == index) {
					$(value).addClass('active');
				} else {
					$(value).removeClass('active');
				}
			});
		}
		gallery.listeners.push(updateListNav);

		var updateGalleryItem = function() {
			for (var i=0; i < gallery.items.length; i++) {
				console.log(gallery.items[i]);
				$(gallery.items[i]).removeClass('active');
			}
			$(gallery.items[gallery.currentIndex]).addClass('active');
			gallery.context.find('.optiscroll').optiscroll('scrollIntoView', gallery.context.find('.navigation-item.active'), 'auto');
		}
		gallery.listeners.push(updateGalleryItem);


		gallery.context.find(".navigation-arrows .arrow-left").on('click', function(){
			gallery.currentIndex -= 1;
			gallery.dispatch();
		});

		gallery.context.find(".navigation-arrows .arrow-right").on('click', function(){
			gallery.currentIndex += 1;
			gallery.dispatch();
		});

		gallery.context.find("ul.navigation-list li.navigation-item").on('click', function(e){
			e.preventDefault();
			console.log($(e.currentTarget).index());
			gallery.currentIndex = $(e.currentTarget).index();
			gallery.dispatch();
		});
	});

	singleItemGallery = gallery;

})(jQuery, jQuery(window), jQuery(document));


</script>

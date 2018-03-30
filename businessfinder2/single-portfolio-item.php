{block content}

	{* template for page title is in parts/page-title.php *}

	{loop as $post}
		<div class="detail-half-content detail-portfolio-content">
				<div class="detail-thumbnail">
					{var $meta = $post->meta('portfolio-item')}
					{var $pictures = $meta->pictures}
					{if $pictures != '' and count($pictures) != 0}
						{* tu pride easy slider *}
						<section class="elm-main elm-easy-slider-main">
							<div class="elm-easy-slider-wrapper">
								<div class="elm-easy-slider easy-pager-thumbnails pager-pos-outside detail-thumbnail-wrap detail-thumbnail-slider">
									<div class="loading"><span class="ait-preloader">{!__ 'Loading&hellip;'}</span></div>
									<ul class="easy-slider">
										<li>
											{if $meta->type == 'video'}
												{if strpos($meta->videoUrl, 'youtube') !== false}
													<span class="easy-thumbnail">
														<span class="easy-title">{!$post->title}</span>
														<iframe src="{videoEmbedUrl $meta->videoUrl}" width="{$vidWidth}" height="{$vidHeight}" class="detail-youtube"></iframe>
													</span>
												{else}
													<span class="easy-thumbnail">
														<span class="easy-title">{!$post->title}</span>
														<iframe src="{videoEmbedUrl $meta->videoUrl}" width="{$vidWidth}" height="{$vidHeight}" class="detail-vimeo"></iframe>
													</span>
												{/if}
											{else}
												<a href="{$post->imageUrl}" target="_blank" rel="item-gallery">
													<span class="easy-thumbnail">
														<span class="easy-title">{!$post->title}</span>
														<img src="{imageUrl $post->imageUrl, width => 640, crop => 1}" alt="{$post->title}" />
													</span>
												</a>
											{/if}
										</li>
										{foreach $pictures as $picture}
										<li>
											{if strpos($picture['link'], 'youtube') !== false}
												<span class="easy-thumbnail">
													{if $picture['title'] != ""}<span class="easy-title">{$picture['title']}</span>{/if}
													<iframe src="{videoEmbedUrl $picture['link']}" width="{$vidWidth}" height="{$vidHeight}" class="detail-youtube"></iframe>
												</span>
											{elseif strpos($picture['link'], 'vimeo') !== false}
												<span class="easy-thumbnail">
													{if $picture['title'] != ""}<span class="easy-title">{$picture['title']}</span>{/if}
													<iframe src="{videoEmbedUrl $picture['link']}" width="{$vidWidth}" height="{$vidHeight}" class="detail-vimeo"></iframe>
												</span>
											{else}
												<a href="{imageUrl $picture['image'], width => 1000, crop => 1}" target="_blank" rel="item-gallery">
													<span class="easy-thumbnail">
														{if $picture['title'] != ""}<span class="easy-title">{$picture['title']}</span>{/if}
														<img src="{imageUrl $picture['image'], width => 640, crop => 1}" alt="{$picture['title']}" />
													</span>
												</a>
											{/if}
										</li>
										{/foreach}
									</ul>


									<div class="easy-slider-pager">
										{if $meta->type == 'video'}
											{if strpos($meta->videoUrl, 'youtube') !== false}
												<a data-slide-index="0" href="#" title="{$post->title}">
													<span class="entry-thumbnail-icon">
														<img src="{videoThumbnailUrl $meta->videoUrl}" alt="{!$picture['title']}" class="detail-image">
													</span>
												</a>
											{elseif strpos($meta->videoUrl, 'vimeo') !== false}
												<a data-slide-index="0" href="#" title="{$post->title}">
													<span class="entry-thumbnail-icon">
														<img src="{videoThumbnailUrl $meta->videoUrl}" alt="{!$picture['title']}" class="detail-image">
													</span>
												</a>
											{else}
												<a data-slide-index="0" href="#" title="{$post->title}">
													<span class="entry-thumbnail-icon">
														<img src="{imageUrl $post->imageUrl, width => 100, height => 75, crop => 1}" alt="{!$post->title}" class="detail-image">
													</span>
												</a>
											{/if}
										{else}
										<a data-slide-index="0" href="#" title="{$post->title}">
											<span class="entry-thumbnail-icon">
												<img src="{imageUrl $post->imageUrl, width => 100, height => 75, crop => 1}" alt="{!$post->title}" class="detail-image">
											</span>
										</a>
										{/if}
										{foreach $pictures as $picture}
											{if $picture['image'] == "" and strpos($picture['link'], 'youtube') !== false}
											<a data-slide-index="{$iterator->getCounter()}" href="#" title="{$picture['title']}">
												<span class="entry-thumbnail-icon">
													<img src="{videoThumbnailUrl $picture['link']}" alt="{!$picture['title']}" class="detail-image">
												</span>
											</a>
											{elseif $picture['image'] == "" and strpos($picture['link'], 'vimeo') !== false}
											<a data-slide-index="{$iterator->getCounter()}" href="#" title="{$picture['title']}">
												<span class="entry-thumbnail-icon">
													<img src="{videoThumbnailUrl $picture['link']}" alt="{!$picture['title']}" class="detail-image">
												</span>
											</a>
											{else}
											<a data-slide-index="{$iterator->getCounter()}" href="#" title="{$picture['title']}">
												<span class="entry-thumbnail-icon">
													<img src="{imageUrl $picture['image'], width => 100, height => 75, crop => 1}" alt="{!$picture['title']}" class="detail-image">
												</span>
											</a>
											{/if}
										{/foreach}
									</div>
								</div>
								<script type="text/javascript">
									jQuery(window).load(function(){
										{if $options->theme->general->progressivePageLoading}
											if(!isResponsive(1024)){
												jQuery(".detail-thumbnail-slider").waypoint(function(){
													portfolioSingleEasySlider({$meta->videoRatio});
													jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
												}, { triggerOnce: true, offset: "95%" });
											} else {
												portfolioSingleEasySlider({$meta->videoRatio});
												jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
											}
										{else}
											portfolioSingleEasySlider({$meta->videoRatio});
											jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
										{/if}
									});
								</script>
							</div>
						</section>
					{else}
						{if $meta->type == 'video'}
							<div class="detail-thumbnail-wrap detail-thumbnail-video">
								<div class="loading"><span class="ait-preloader">{!__ 'Loading&hellip;'}</span></div>
								{if strpos($meta->videoUrl, 'youtube') !== false}
									<iframe src="{videoEmbedUrl $meta->videoUrl}" width="{$vidWidth}" height="{$vidHeight}" class="detail-youtube"></iframe>
								{else}
									<iframe src="{videoEmbedUrl $meta->videoUrl}" width="{$vidWidth}" height="{$vidHeight}" class="detail-vimeo"></iframe>
								{/if}
							</div>
							<script type="text/javascript">
								jQuery(window).load(function(){
									var ratio = {$meta->videoRatio};
									var pRatio = ratio.split(':');
									var width = jQuery('.detail-thumbnail-wrap').width();
									var height = (width / parseInt(pRatio[0])) * parseInt(pRatio[1]);
									jQuery('.detail-thumbnail-wrap iframe').each(function(){
										jQuery(this).attr({'width': width, 'height': height});
									});
									jQuery('.detail-thumbnail-wrap').addClass('video-loaded');
								});
							</script>
						{elseif $meta->type == 'website'}
							<div class="detail-thumbnail-wrap detail-thumbnail-website entry-content">
								{if $post->hasImage}
									<a href="{$meta->websiteUrl}" target="_blank" class="thumb-link">
										<span class="entry-thumbnail-icon">
											<img src="{imageUrl $post->imageUrl, width => 640, crop => 1}" alt="{!$post->title}" class="detail-image">
										</span>
									</a>
								{/if}
							</div>
						{else}
							<div class="detail-thumbnail-wrap detail-thumbnail-image entry-content">
								{if $post->hasImage}
									<a href="{imageUrl $post->imageUrl, width => 640, crop => 1}" class="thumb-link">
										<span class="entry-thumbnail-icon">
											<img src="{imageUrl $post->imageUrl, width => 640, crop => 1}" alt="{!$post->title}" class="detail-image">
										</span>
									</a>
								{/if}
							</div>
						{/if}
					{/if}
				</div>
				<div class="detail-description">
					<div class="detail-text entry-content">
						{if $post->hasContent}
							{!$post->content}
						{else}
							{!$post->excerpt}
						{/if}
					</div>

					{if $meta->informations}
					<div class="local-toggles type-accordion">
						{foreach $meta->informations as $info}
							<div class="toggle-header"><h3 class="toggle-title">{!$info[title]}</h3></div>
	  						<div class="toggle-content"><div class="toggle-container entry-content">{!$info[description]}</div></div>
						{/foreach}
					</div>
					{/if}
				</div>
			{!$post->linkPages}
		</div><!-- .detail-content -->

		<footer class="entry-footer">
			{if $wp->isSingle and $post->author->bio and $post->author->isMulti}
				{includePart parts/author-bio}
			{/if}
		</footer><!-- .entry-footer -->

		{includePart parts/pagination location => nav-below}

	{/loop}

{var $rating_count = AitItemReviews::getRatingCount($post->id)}
{var $rating_mean = floatval(get_post_meta($post->id, 'rating_mean', true))}

{var $showCount = isset($showCount) ? $showCount : false}
{if $rating_count > 0}
<div class="review-stars-container">
		<div class="content rating-star-shown" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
			{* RICH SNIPPETS *}
			<span style="display: none" itemprop="itemreviewed">{!$post->title}</span>
			<span style="display: none" itemprop="rating">{$rating_mean}</span>
			<span style="display: none" itemprop="count">{$rating_count}</span>
			{* RICH SNIPPETS *}
			<span class="review-stars" data-score="{$rating_mean}"></span>
			{if $showCount}<span class="review-count">({$rating_count})</span>{/if}
		</div>
</div>
{/if}

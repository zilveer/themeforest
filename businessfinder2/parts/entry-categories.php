{var $separator = isset($separator) ? $separator : ' '}

<span class="categories">
	{if isset($taxonomy)}
	<span class="cat-links">{!$post->categoryList($separator, '', $taxonomy)}</span>
	{else}
	<span class="cat-links">{!$post->categoryList($separator)}</span>
	{/if}
</span>

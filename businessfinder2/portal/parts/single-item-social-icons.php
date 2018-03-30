{if !isset($meta)}
	{var $meta = $post->meta('item-data')}
{/if}

{var $target = $meta->socialIconsOpenInNewWindow ? 'target="_blank"' : ""}

{if $meta->displaySocialIcons}
<div class="social-icons-container">
	<div class="content">
		{if is_array($meta->socialIcons) && count($meta->socialIcons) > 0}
			<ul><!--
			{foreach $meta->socialIcons as $icon}
			--><li>
					<a href="{!$icon['link']}" {!$target}>
						<i class="fa {$icon['icon']}"></i>
					</a>
				</li><!--
			{/foreach}
			--></ul>
		{/if}
	</div>
</div>
{/if}
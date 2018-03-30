{if $post->hasCommentsOpen}
	<div class="comments-link">
		<a href="{$post->commentsUrl}" title="{__ 'Comments on %s'|printf: $post->title}">
			{if $post->commentsNumber > 1}
				<span class="comments-count" title="{_n '%s Comment', '%s Comments'|printf: $post->commentsNumber}">
					<span class="comments-number">{$post->commentsNumber}</span> 
				</span>
			{elseif $post->commentsNumber == 0}
				<span class="comments-count" title="{__ 'Leave a comment'}">
					<span class="comments-number">0</span> 
				</span>
			{else}
				<span class="comments-count" title="{__ '1 Comment'}">
					<span class="comments-number">1</span> 
				</span>
			{/if}
		</a>
	</div><!-- .comments-link -->
{/if}
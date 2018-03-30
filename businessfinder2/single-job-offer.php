{block content}

	{* template for page title is in parts/page-title.php *}

	{loop as $post}
	

		<div class="entry-content">
			{var $meta = $post->meta('offer-data')}
			{if $post->hasContent}
				{!$post->content}
			{else}
				{!$post->excerpt}
			{/if}

			{if $meta->skills != ""}
			<div class="offer-skills">

				<div class="ait-sc-rule rule-basic"></div>
				<h3 class="offer-skills-title">{__ 'Skills and Experiences'}</h3>
				<div class="entry-content">{!$meta->skills}</div>

			</div>
			{/if}

			{if $meta->contactName != "" or $meta->contactMail != "" or $meta->contactPhone != ""}
			<div class="offer-contact">

				<div class="ait-sc-rule rule-basic"></div>
				<div class="offer-contact-data">
					<span class="offer-contact-title"><strong>{__ 'Contact:'}</strong></span>

					{if $meta->contactName != ""}
					<span class="offer-contact-name">{!$meta->contactName}</span>
					{/if}

					{if $meta->contactMail != ""}
					<span class="offer-contact-mail"><a href="mailto:{$meta->contactMail}">{!$meta->contactMail}</a></span>
					{/if}

					{if $meta->contactPhone != ""}
					<span class="offer-contact-phone">{!$meta->contactPhone}</span>
					{/if}
				</div>

			</div>
			{/if}

		</div><!-- .entry-content -->

		<footer class="entry-footer">
			{if $wp->isSingle and $post->author->bio and $post->author->isMulti}
				{includePart parts/author-bio}
			{/if}
		</footer><!-- .entry-footer -->

		{includePart parts/pagination location => nav-below}
	{/loop}

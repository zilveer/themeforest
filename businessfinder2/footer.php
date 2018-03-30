

	<footer id="footer" class="footer" role="contentinfo">

		{if $options->layout->general->enableWidgetAreas}
		<div class="footer-widgets">
			<div class="footer-widgets-wrap grid-main">
				<div class="footer-widgets-container">


					{foreach $wp->widgetAreas(footer) as $widgetArea}
						{* uncomment condition to hide empty widget areas completely *}
						{* {if $wp->isWidgetAreaActive($widgetArea)} *}
						<div class="widget-area {$widgetArea} widget-area-{$iterator->counter}">
							{widgetArea $widgetArea}
						</div>
						{* {/if} *}
					{/foreach}

				</div>
			</div>
		</div>
		{/if}

		<div class="site-footer">
			<div class="site-footer-wrap grid-main">
				{menu footer, depth => 1}
				<div class="footer-text">{!$options->theme->footer->text}</div>
			</div>
		</div>

	</footer><!-- /#footer -->
</div><!-- /#page -->

{wpFooter}

{!$options->theme->footer->customJsCode}

</body>
</html>

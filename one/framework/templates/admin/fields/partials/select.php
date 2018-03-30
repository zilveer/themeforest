<script type="text/html" data-tpl="select">
	<div id="{{ id }}" class="thb-ui-control select {{ classes }}" data-value="{{ value }}" data-callback="{{ callback }}">
		<input type="hidden" name="{{ name }}" value="{{ value }}">
		<div class="trigger">
			<a href="" role="button">{{ selected_label }}</a>
		</div>
		<ul class="options">
			<# for( var i in options ) { #>
				<li>
					<a class="{{ options[i].value == value ? 'selected' : '' }} value-{{ options[i].value }}" data-value="{{ options[i].value }}" href="#">{{ options[i].label }}</a>
				</li>
			<# } #>
		</ul>
	</div>
</script>
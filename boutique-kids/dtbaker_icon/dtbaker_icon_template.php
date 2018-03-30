<script type="text/html" id="tmpl-dtbaker_mce_icon">
	<div class="dtbaker_icon dtbaker_icon_{{ data.type }}">
		<# if ( data.type == 'square' ) { #>
			<div class="square_wrap">
				<span class="fa fa-{{ data.icon }}" style="color:{{ data.color }}"></span>
			</div>
			<# if ( data.title || data.innercontent ) { #>
			<div class="icon_text">
				<# if ( data.title ) { #>
					<div class="icon_title" style="color:{{ data.color }}">{{{ data.title }}}</div>
				<# } #>
				{{{ data.innercontent }}}
			</div>
			<# } #>
		<# }else if ( data.type == 'horizontal' ) { #>
			<div class="icon_bg" style="color:{{ data.color }}">
				<span class="fa fa-{{ data.icon }}"></span>
			</div>
			<div class="icon_text">
				<# if ( data.title ) { #>
					<div class="icon_title">{{{ data.title }}}</div>
				<# } #>
				{{{ data.innercontent }}}
			</div>
		<# }else{ #>
			<span class="fa fa-{{ data.icon }}" style="color:{{ data.color }}"></span>
			<# if ( data.title ) { #>
				<div class="icon_title" style="color:{{ data.color }}">{{{ data.title }}}</div>
			<# } #>
			<div class="icon_text">{{{ data.innercontent }}}</div>
		<# } #>
	</div>
</script>
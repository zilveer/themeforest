<script id="tmpl-infoBubbleTemplate" type="text/template">
	<a href="{{{ data.link }}}">
		<# if ( typeof( data.thumb ) != 'undefined') { #>
		<span style="background-image: url({{{ data.thumb }}})" class="list-cover has-image"></span>
		<# } #>

		<# if ( typeof( data.title ) != 'undefined') { #>
		<h1>{{{ data.title }}}</h1>
		<# } #>

		<# if ( typeof( data.rating ) != 'undefined') { #>
		<span class="rating stars-{{{ data.rating }}}">
			{{{ data.rating }}}	
		</span> 
		<# } #>

		<# if ( typeof( data.address ) != 'undefined') { #>
		<span class="address">{{{ data.address }}}</span>
		<# } #>
	</a>
</script>

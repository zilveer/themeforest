<form id="form2" class="clearfix" action="<?php echo esc_url(home_url( '/' )); ?>" >
	<fieldset>
		<label class="clearfix">
			<input type="text" name="s" class="search-query" 
			onfocus='if(this.value=="Search")this.value="";' 
			onblur='if(this.value=="")this.value="Search";' 
			value="Search">
		</label>
		<a href="#"  onclick="document.getElementById('form2').submit()" class="btn btn-3 icon-search"></a>
	</fieldset>
</form>


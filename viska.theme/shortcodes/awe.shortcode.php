<!-- Button Shortcode -->
<div id="awe_sc_button"  class="awe_sc_builder  awe_shorcode_dialog hidden">
	<div class="mce-container-body mce-abs-layout">

		<div class="awe-preview">
			<button id="sc-button" class="awe-button" type="button" data-general="btn">Button</button>
		</div>

		<div class="awe-settings" data-shortcodename="awe_button">

			<div class="form-group">
				<!-- <label for="">Type</label> -->
				<!-- <select class="form-control select" name="type" data-type="attr|class" data-target="#sc-button">
					<option value="btn-default">Default</option>
					<option value="btn-success">Success</option>
					<option value="btn-info">Info</option>
					<option value="btn-warning">Warning</option>
					<option value="btn-danger">Danger</option>
					<option value="btn-link">Link</option>
					<option value="btn-default">Blue</option>
				</select> -->
			</div>

			<div class="form-group">
				<label for="">Size</label>
				<select class="form-control select" name="size" data-type="attr|class" data-target="#sc-button">
					<option value="btn-default">Default</option>
					<option value="btn-sm">Small</option>
					<option value="btn-lg">Larger</option>
					<option value="btn-xs">Extract small</option>
				</select>
			</div>

			

			<div class="form-group">
				<label for="">Lable</label>
				<input type="text" class="form-control keypress" name="name" data-type="text" data-target="#sc-button" value="Button">
			</div>
			<div class="form-group">
				<label for="">URL</label>
				<input type="text" class="form-control" name="link" data-target="#sc-button" value="#">
			</div>

			<!-- <input type> -->
		</div>
		
		<button type="button" class="button awe_insert_shortcode button-primary" >Insert Shortcode</button>
	
	</div>
</div>


<!-- Dropcap Shortcode -->
<div id="awe_sc_dropcap"  class="awe_sc_builder awe_shorcode_dialog hidden">
	<div class="mce-container-body mce-abs-layout">

		<div class="awe-preview">
			<span id="awe_dropcap_preview">D</span>
		</div>

		<div class="awe-settings" data-shortcodename="awe_dropcap">
			<input type="text" class="form-control keypress" name="content" data-type="text" data-target="#awe_dropcap_preview" value="D">
			<input type="text" class="form-control color_picker" name="color" data-target="#awe_dropcap_preview" value="#ff9900" data-change="color">
		</div>

		<button type="button" class="button awe_insert_shortcode button-primary" >Insert Shortcode</button>
	</div>
</div>


<!-- Video Shortcode -->
<div id="awe_sc_embed_video"  class="awe_sc_builder awe_shorcode_dialog hidden">
	<div class="mce-container-body mce-abs-layout">

		<div class="awe-preview">

		</div>

		<div class="awe-settings" data-shortcodename="awe_video">
			<div class="form-group">
				<label>Enter youtube url</label>
				<input type="text" class="form-control awe_video_url" name="src"  value="">
				<!-- <input type="button" class="button awe_add_video" value="Add Video"> -->
			</div>
			<!-- <input type="hidden" class="form-control awe_re_src" name="src" value="">  -->
		</div>
		
		<button type="button" class="button awe_insert_shortcode button-primary" >Insert Shortcode</button>
	</div>
</div>

<!-- Alert Shortcode -->
<div id="awe_sc_alert"  class="awe_sc_builder awe_shorcode_dialog hidden">
	<div class="mce-container-body mce-abs-layout">

		<div class="awe-preview">
			<div id="awe_alert_preview" class="alert alert-success" role="alert" data-gereral="alert">
				Well done! This is important alert message.
			</div>
		</div>

		<div class="awe-settings" data-shortcodename="awe_alert">
			<div class="form-group">
				<label>Options</label>
				<select class="form-control select" name="type" data-type="attr|class" data-target="#awe_alert_preview">
					<option value="alert-success"> Success</option>
					<option value="alert-info"> Info</option>
					<option value="alert-warning"> Warning</option>
					<option value="alert-danger"> Danger</option>
				</select>
			</div>

			<div class="form-group">
				<label for="">Alert Content</label>
				<input type="text" class="form-control keypress" name="content" data-type="text" data-target="#awe_alert_preview" value="Well done! This is important alert message. ">
			</div>
		</div>

		<button type="button" class="button awe_insert_shortcode button-primary" >Insert Shortcode</button>
	
	</div>

</div>

<!-- Tabs Shortcode -->
<div id="awe_sc_tabs"  class="awe_sc_builder awe_shorcode_dialog hidden">
	<div class="mce-container-body mce-abs-layout">


		<div class="awe-preview">
			
		</div>

		<div class="awe-settings" data-shortcodename="awe_tabs" data-dontreplacecontnet="true">
			<label>Tabs</label>
			<textarea name="content" class="awe_content">[subtab title="tab1"]Content1[/subtab]
[subtab title="tab2"]Content2[/subtab]
[subtab title="tab3"]Content3[/subtab]
[subtab title="tab4"]Content4[/subtab]</textarea>
		</div>

		

		<button class="awe_live_preview button" data-render="tabs">Preview</button>

		<button type="button" class="button awe_insert_shortcode button-primary">Insert Shortcode</button>
		
	</div>
</div>


<!-- List Shortcode -->
<div id="awe_sc_liststyle"  class="awe_sc_builder awe_shorcode_dialog hidden">
	<div class="mce-container-body mce-abs-layout">

		<div class="awe-preview">
			<ul id="awe_liststyle_preview" class="awe_liststyle">

			</ul>
		</div>

		<div class="awe-settings" data-shortcodename="awe_liststyle" data-dontreplacecontnet="true">
			<div class="form-group">
				<a class="awe_chooseicon thickbox" href="#TB_inline?width=650&height=550&inlineId=awew-popup-it">Choose Icon</a>
	            <input type="text" name="icon" class="form-control awe_icon awe_style" value="">
            </div>
            <input type="text" class="color_picker awe_style" name="color" data-target="#awe_liststyle_preview" value="#ff9900" data-change="color">
			<textarea data-target="#awe_liststyle_preview" name="content" class="awe_content">[list]List Item 0[/list]
[list]List Item 1[/list]
[list]List Item 2[/list]
[list]List Item 3[/list]
[list]List Item 4[/list]</textarea>
		</div>
		

		<button class="button awe_live_preview" data-render="liststyle">Preview</button>

		<button type="button" class="button awe_insert_shortcode button-primary">Insert Shortcode</button>
	
	</div>
</div>

<!-- Toggle Shortcode -->
<div id="awe_sc_toggle"  class="awe_sc_builder awe_shorcode_dialog hidden">
	<div class="mce-container-body mce-abs-layout">

		<div class="awe-preview">
			
		</div>

		<div class="awe-settings" data-shortcodename="awe_accordion" data-dontreplacecontnet="true">
			<label>Tabs</label>
			<textarea name="content" class="awe_content">[accordion title="accordion1"]Content1[/accordion]
[accordion title="accordion2"]Content2[/accordion]
[accordion title="accordion3"]Content3[/accordion]
[accordion title="accordion4"]Content4[/accordion]</textarea>
		</div>

		

		<button class="button awe_live_preview" data-render="accordion">Preview</button>

		<button type="button" class="button awe_insert_shortcode button-primary">Insert Shortcode</button>
		
	</div>
</div>
 

<!-- Progress Bar Shortcode -->
<div id="awe_sc_progress_bar"  class="awe_sc_builder awe_shorcode_dialog hidden">
	<div class="mce-container-body mce-abs-layout">

		<div class="awe-preview">
			
		</div>

		<div class="awe-settings" data-shortcodename="awe_progressbar" data-dontreplacecontnet="true">
			<div class="form-group">
				<label>Effect</label>
				<select class="form-control effect_processbar awe_style" name="effect">
					<option value="">Default</option>
					<option value="progress-bar-striped">Striped</option>
					<option value="progress-bar-striped active">Animated</option>
				</select>
			</div>

			<div class="form-group">
			<label>Progress Bar</label>
				<textarea name="content" class="awe_content">[progressbar context="progress-bar-success" percent="40"][/progressbar]
[progressbar context="progress-bar-info" percent="50"][/progressbar]
[progressbar context="progress-bar-warning" percent="60"][/progressbar]
[progressbar context="progress-bar-danger" percent="80"][/progressbar]</textarea>
			</div>
		</div>

		

		<button class="button awe_live_preview" data-render="progressbar">Preview</button>

		<button type="button" class="button awe_insert_shortcode button-primary">Insert Shortcode</button>
		
	</div>
</div>
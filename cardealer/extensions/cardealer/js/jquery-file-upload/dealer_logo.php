<noscript><link rel="stylesheet" href="<?php echo TMM_EXT_URI . '/cardealer/js/jquery-file-upload/'; ?>css/jquery.fileupload-noscript.css"></noscript>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="<?php echo TMM_EXT_URI . '/cardealer/js/jquery-file-upload/'; ?>js/cors/jquery.xdr-transport.js"></script>
<![endif]-->

<div id="tmm_fileupload" class="tmm-fileupload">

    <div class="fileupload-buttonbar">

        <div class="fileupload-buttons">

	         <span class="fileinput-button button orange">
	            <span><?php _e('Browse Logo ...', 'cardealer'); ?></span>
                <input type="file" name="files[]" />
			</span>

	        <span class="start button orange">
				<?php _e('Start upload', 'cardealer'); ?>
			</span>

            <span class="fileupload-process"></span>

        </div>

        <!-- The global progress state -->
        <div class="fileupload-progress fade" style="display:none">
            <!-- The global progress bar -->
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
        </div>

    </div>

    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="fileupload_presentation">
	    <tbody class="files"></tbody>
    </table>

</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	<tr class="template-upload fade">
	<td>
    <span class="preview"></span>
	</td>
	<td>
    <p class="name"></p>
    <strong class="error"></strong>
	</td>
	<td>
    <p class="size"><?php _e('Processing...', 'cardealer'); ?></p>
	</td>
	<td>
    {% if (!i && !o.options.autoUpload) { %}
	 <button class="start" style="display:none;"><?php _e('Start', 'cardealer'); ?></button>
    {% } %}
    {% if (!i) { %}
	<button class="cancel button orange"><?php _e('Cancel', 'cardealer'); ?></button>
    {% } %}
	</td>
	</tr>
	{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
    <td>
    <span class="preview">
    {% if (file.thumbnailUrl) { %}
    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}" alt=""></a>
    {% } %}
    </span>
    </td>
    <td>
    <p class="name"></p>
    {% if (file.error) { %}
    <div><span class="error"><?php _e('Error', 'cardealer'); ?></span> {%=file.error%}</div>
    {% } %}
    </td>
    <td>
    <span class="size">{%=o.formatFileSize(file.size)%}</span>
    </td>
    <td>
    <button class="delete button orange" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}><?php _e('Delete', 'cardealer'); ?></button>
    </td>
    </tr>
    {% } %}
</script>

<script type="text/javascript">
	(function($) {
		$(function() {

			/* Initialize the jQuery File Upload widget */
			$('#tmm_fileupload').fileupload({
				url: ajaxurl + '?action=app_cardealer_upload_cardealer_logo',
				messages: {
					maxNumberOfFiles: '<?php _e("Maximum number of files exceeded", 'cardealer'); ?>',
					acceptFileTypes: '<?php _e("File type not allowed", 'cardealer'); ?>',
					maxFileSize: '<?php _e("File is too large", 'cardealer'); ?>',
					minFileSize: '<?php _e("File is too small", 'cardealer'); ?>',
					uploadedBytes: '<?php _e("Uploaded bytes exceed file size", 'cardealer'); ?>'
				}
			}).on("fileuploaddone", function(e, data) {
				$(".fileupload_presentation tr").remove();
				$(this).fileupload('option', 'done').call(this, $.Event('done'), {result: data._response.result});
			}).addClass('fileupload-processing');

			/* Load existing files */
			$.ajax({
				url: $('#tmm_fileupload').fileupload('option', 'url'),
				dataType: 'json',
				context: $('#tmm_fileupload')[0]
			}).always(function() {
				$(this).removeClass('fileupload-processing');
			}).done(function(result) {
				$(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
			});

		});
	}(jQuery));

</script>

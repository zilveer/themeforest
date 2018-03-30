
<!-- metabox styles -->

<style>
#adv-settings label[for|="theme-metabox"] {display:none}
</style>

<!-- metabox scripts -->

<script>
(function(a){a.noConflict();a(document).ready(function(){var c=a('.postbox[id^="theme-metabox-id-"]');c.each(function(){var d=a(this),b=d.find("table.form-table").data()["class"];b&&d.addClass(b);d.removeClass("hide-if-js")});var e=function(a){var b=a.replace(/\W/gi,"-");a=".show-for-"+b;b=".hide-for-"+b;c.each(function(){this.style.cssText=""});c.filter(a).show();c.filter(b).hide()};a("#post-formats-select").length&&(e(a("#post-formats-select input:checked")[0].id),a("#post-formats-select input").change(function(){e(this.id)}));
a("#page_template").length&&(e(a("#page_template")[0].value),a("#page_template").change(function(){e(this.value)}));a_send_to_editor_default=window.send_to_editor;c.find('input.button[id^="btn_"]').click(function(d){d.stopPropagation();window.send_to_editor=function(b){b=a("img",b).attr("src");var c=d.target.id.replace("btn_","");document.getElementById(c).value=b;tb_remove();window.send_to_editor=a_send_to_editor_default};tb_show("","media-upload.php?post_ID=0&amp;type=image&amp;TB_iframe=true")})})})(jQuery);
</script>

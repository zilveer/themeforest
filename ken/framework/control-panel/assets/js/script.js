jQuery("#revoke_button").click(function() {
    if (confirm("Are you sure?")) {
        jQuery("#apikey").val("");
    }
});
jQuery(document).ready(function($) {
    var $uploader = $('.uploader'),
        dragging = false,
        activeClass = 'is-drag';
    $uploader.on('dragover', doEnter);
    $uploader.on('dragleave', doLeave);

    function doEnter() {
        $uploader.addClass(activeClass);
    }

    function doLeave() {
        $uploader.removeClass(activeClass);
    }

    function add_log(message) {
        console.log(new Date().getTime() + ': ' + message);
    }

    function add_file(id, file) {
        var file_name = file.name;
        var clean_name = file_name.replace(/.zip/g, "");
        var template = '' + '<div class="file" id="uploadFile' + id + '">' + '<div class="info">' + '<span class="filename" title="Size: ' + file.size + 'bytes - Mimetype: ' + file.type + '">' + clean_name + ' Template</span><br /><small><span class="status">Waiting</span></small>' + '</div>' + '<div class="bar">' + '<div class="progress" style="width:0%"></div>' + '</div>' + '</div>';
        $('#fileList').prepend(template);
    }

    function update_file_status(id, status, message) {
        $('#uploadFile' + id).find('span.status').html(message).addClass(status);
    }

    function update_file_progress(id, percent) {
        $('#uploadFile' + id).find('div.progress').width(percent);
    }
    // Upload Plugin itself
    $('#drag-and-drop-zone').dmUploader({
        url: ajaxurl,
        dataType: 'json',
        allowedTypes: '*',
        extraData: {
            action: 'abb_install_template_action',
            abb_install_template_security: $("#abb_install_template_security").val()
        },
        onInit: function() {
            add_log('File uploader initialized');
        },
        onBeforeUpload: function(id) {
            add_log('Starting the upload of #' + id);
            update_file_status(id, 'uploading', 'Uploading...');
        },
        onNewFile: function(id, file) {
            doLeave();
            add_log('New file added to queue #' + id);
            add_file(id, file);
        },
        onComplete: function() {
            add_log('All pending tranfers finished');
        },
        onUploadProgress: function(id, percent) {
            var percentStr = percent + '%';
            update_file_progress(id, percentStr);
        },
        onUploadSuccess: function(id, data) {
            add_log('Upload of file #' + id + ' completed');
            add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
            update_file_status(id, 'success', 'Upload Completed');
            update_file_progress(id, '100%');
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: "action=abb_get_templates_action",
                success: function(res) {
                    $("#template-list").html(res);
                    mk_import_demos();
                    mk_delete_template();
                }
            });
        },
        onUploadError: function(id, message) {
            add_log('Failed to Upload file #' + id + ': ' + message);
            update_file_status(id, 'error', message);
        },
        onFileTypeError: function(file) {
            add_log('File \'' + file.name + '\' cannot be added: must be a .zip archive');
        },
        onFileSizeError: function(file) {
            add_log('File \'' + file.name + '\' cannot be added: size excess limit');
        },
        onFallbackMode: function(message) {
            alert('Browser not supported(do something else here!): ' + message);
        }
    });

    function mk_import_demos() {
        $('.mk-import-content-btn').click(function(e) {
            var $serilized = 'template=' + $(this).parents('form').find("input[name='template']").val() + '&';
            $serilized += $(this).parents('form').find("input[type='checkbox']").map(function() {
                return this.name + "=" + this.checked;
            }).get().join("&");
            var $import_true = confirm('Are you sure to import dummy content? We highly encourage you to do this action in a fresh WordPress installation!');
            if ($import_true == false) return false;
            $('.import_message').html('<div class="updated settings-error"><div class="import-content-loading">Please be patient while template is being imported. This process may take a couple of minutes.</div></div>');
            var data = {
                action: 'abb_import_demo_action',
                options: $serilized
            };
            $.post(ajaxurl, data, function(response) {
                $('.import_message').html('<div class="updated settings-error">' + response + '</div>');
            });
            $("html, body").animate({
                scrollTop: 0
            }, "fast");
            e.preventDefault();
        });
    }
    mk_import_demos();

    function mk_delete_template() {
        $('.mk-delete-template-btn').click(function(e) {
            var $delete_template = confirm('Are you sure to delete this template from your server?');
            if ($delete_template == false) return false;
            var data = {
                action: 'abb_delete_template',
                abb_install_template_security: $("#abb_install_template_security").val(),
                template: $(this).parents('form').find("input[name='template']").val()
            };
            $.post(ajaxurl, data, function(response) {
                $("#template-list").html(response);
                mk_delete_template();
                mk_import_demos();
            });
            e.preventDefault();
        });
    }
    mk_delete_template();
});





/* System Status generate report
****************/
jQuery('a.debug-report').click(function() {
    var report = '';
    jQuery('#status thead, #status tbody').each(function() {
        if (jQuery(this).is('thead')) {
            var label = jQuery(this).find('th:eq(0)').data('export-label') || jQuery(this).text();
            report = report + "\n### " + jQuery.trim(label) + " ###\n\n";
        } else {
            jQuery('tr', jQuery(this)).each(function() {
                var label = jQuery(this).find('td:eq(0)').data('export-label') || jQuery(this).find('td:eq(0)').text();
                var the_name = jQuery.trim(label).replace(/(<([^>]+)>)/ig, ''); // Remove HTML
                var the_value = jQuery.trim(jQuery(this).find('td:eq(2)').text());
                var value_array = the_value.split(', ');
                if (value_array.length > 1) {
                    // If value have a list of plugins ','
                    // Split to add new line
                    var output = '';
                    var temp_line = '';
                    jQuery.each(value_array, function(key, line) {
                        temp_line = temp_line + line + '\n';
                    });
                    the_value = temp_line;
                }
                report = report + '' + the_name + ': ' + the_value + "\n";
            });
        }
    });
    try {
        jQuery("#debug-report").slideDown();
        jQuery("#debug-report textarea").val(report).focus().select();
        //jQuery(this).fadeOut();
        return false;
    } catch (e) {
        console.log(e);
    }
    return false;
});

jQuery(document).ready(function($){
    $('.status_table tr td.help').each(function() {
        var $this = $(this),
            tooltipWidth = $this.find('.mk-tooltip--text').outerWidth();
        if( tooltipWidth > 300 ){
            $this.find('.mk-tooltip--text').css({
                'white-space': 'inherit',
                'width': '300px'
            });
        }else {
            $this.find('.mk-tooltip--text').css({
                'margin-top': '-29px',
            });
        }
        var tooltipHeight = $this.find('.mk-tooltip--text').innerHeight();
        if( tooltipWidth > 300 ){
            $this.find('.mk-tooltip--text').css({
                'margin-top': -tooltipHeight/2,
            });
        }
        $this.find('.mk-tooltip--link').hover(function() {
            $(this).siblings('.mk-tooltip--text').animate({
                'opacity': 1
            }, 100);
        }, function() {
            $(this).siblings('.mk-tooltip--text').animate({
                'opacity': 0
            }, 100);
        });
    });

});
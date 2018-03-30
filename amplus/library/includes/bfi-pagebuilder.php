<?php
$imageURL = BFI_LIBRARYURL . "views/admin/scripts/pagebuilder/images/";
?>
<script>

// theme shortname to prevent conflicts
var BFI_SHORTNAME = "<?php echo BFI_SHORTNAME ?>";
// section properties class
var SECTION_PROPERTIES_MODEL = "<?php echo BFIAdminPagebuilderController::SECTION_PROPERTIES_MODEL ?>";
var BFI_PAGEBUILDER_VIEW_URL = "../wp-content/themes/<?php echo BFI_SHORTNAME ?>/library/views/admin/scripts/pagebuilder/";
// editor css file
<?php
$editorCSSFile = BFI_LIBRARYURL 
               . 'views/admin/scripts/pagebuilder/css/editor.css';
if (file_exists(BFI_APPLICATIONPATH 
                . 'views/admin/scripts/pagebuilder/css/editor.css')) {
    $editorCSSFile = BFI_APPLICATIONURL 
                   . 'views/admin/scripts/pagebuilder/css/editor.css';
}
?>
var BFI_PAGEBUILDER_EDITOR_CSS = "<?php echo $editorCSSFile ?>";

jQuery(document).ready(function($) {
    
    $('.panels-container:not(.initdone)').each(function() {
        
        // this means we are another pagebuilder for another language
        var langParent = $(this).parents('[id^=wp-bfi_lang_][id$=_content-wrap]');
        if (langParent.length > 0) {
            var lang = /^wp-bfi_lang_([^_]+)_content-wrap$/g.exec(langParent.attr('id'))[1];
            
            bfi_layouting.initPageBuilderData(
                $(this).attr('id'),
                $(this).find('[id=<?php echo BFI_SHORTNAME ?>_pagebuilder_' + lang + ']').addClass('used').val()
            );
            
            var panelsContainer = $(this)
                .find('[id=<?php echo BFI_SHORTNAME ?>_pagebuilder_' + lang + ']')
                .parents('.panels-container');
            
            // create clone page builder button    
            panelsContainer
                .prepend("<button class='section-copy'><i class='icon-copy'></i> Clone Main Page Builder</button>")
                .find('button.section-copy')
                .button()
                .unbind('click')
                .click(function(event) {
                    event.preventDefault();
                    // first page builder always is #pagebuilder1
                    bfi_layouting.initPageBuilderData(
                        panelsContainer.attr('id'),
                        bfi_layouting.getLayoutData('pagebuilder1'));
                });
        } else {
            bfi_layouting.initPageBuilderData(
                $(this).attr('id'),
                $(this).find('[id=<?php echo BFI_SHORTNAME ?>_pagebuilder]').addClass('used').val()
            );
        }
        $(this).addClass('initdone'); // only do once
        $(this).find('.pagebuilder_init_data:not(.used)').remove();
    });
    
    // at the start, rebuild the pagebuilder
    $('.panels-container input.pagebuilder_init_data:not(.done)').each(function() {
        bfi_layouting.initPageBuilderData(
            $(this).parents('.panels-container').attr('id'),
            $(this).val()
        );
        $(this).addClass('done'); // only do once
    });
    
    $('form[id=post]').submit(function() {
        // right before saving, gether all the data from pagebuilder
        $('.panels-container:not(.done)').each(function() {
            $(this).find('input.pagebuilder_init_data').val(
                bfi_layouting.getLayoutData($(this).attr('id'))
                );
            $(this).addClass('done'); // only do once
        });
    });
    
    // highjack click event, and prevent it from going through
    // we first need to save everything via ajax (meta options)
    // afterwards, we can continue with the normal behavior
    // of the click
    setTimeout(function() {
        if (!$('#post-preview').hasClass('inited')) {
            // get the existing click handler
            // WP only has 1
            var clickhandler = function() { };
            var clickData = $._data( $("#post-preview")[0], "events" ).click;
            if (clickData.length > 0) {
                clickhandler = clickData[0].handler;
            }
        
            ajaxhandler = function(e) {
                // open a new tab to get ready for the preview
                // we need this or else it will open in a new window
                $('<form target="wp-preview" action="about:blank"></form>').submit(); 
                
                $('.panels-container').each(function() {
                    $(this).find('input.pagebuilder_init_data').val(
                        bfi_layouting.getLayoutData($(this).attr('id')));
                });
            
                // save our custom fields
                $.ajax({
                  type: "POST",
                  url: "<?php echo wp_nonce_url( 
                                       BFI_LIBRARYURL 
                                            . "includes/custom-field-preview.php", 
                                       'preview') ?>",
                  data: $("form#post").serialize(),
                  // start preview on success
                  success: function() { 
                      var btn = jQuery('#post-preview');
                      btn.unbind('click')
                          .click(btn.data('orighandler'))
                          .trigger('click')
                          .unbind('click')
                          .click(btn.data('ajaxhandler'));
                  },
                  // start preview on error
                  error: function() { 
                      var btn = jQuery('#post-preview');
                      btn.unbind('click')
                          .click(btn.data('orighandler'))
                          .trigger('click')
                          .unbind('click')
                          .click(btn.data('ajaxhandler'));
                  }
                });
                return false;
            };
        
            // assign our hijacked ajax sender
            $('#post-preview').unbind('click')
                .data('orighandler', clickhandler)
                .data('ajaxhandler', ajaxhandler)
                .click(ajaxhandler)
                .addClass('inited');
        }
    }, 100);
});
</script>

<!--
    Add New Section Dialog Box
-->
<div id="dialog-section-new" title="Add New Section">
    <p>Select the layout for the new section</p>
    <button data-widths='[100]'><img src='<?php echo $imageURL ?>col1.png'/><span>1 col</span></button>
    <button data-widths='[50,50]'><img src='<?php echo $imageURL ?>col2.png'/><span>2 col</span></button>
    <button data-widths='[33.3, 33.4, 33.3]'><img src='<?php echo $imageURL ?>col3.png'/><span>3 col</span></button>
    <button data-widths='[66.7, 33.3]'><img src='<?php echo $imageURL ?>col23.png'/><span>2/3 col</span></button>
    <button data-widths='[25,25,25,25]'><img src='<?php echo $imageURL ?>col4.png'/><span>4 col</span></button>
    <button data-widths='[75,25]'><img src='<?php echo $imageURL ?>col34.png'/><span>3/4 col</span></button>
    <button data-widths='[20,20,20,20,20]'><img src='<?php echo $imageURL ?>col5.png'/><span>5 col</span></button>
    <button data-widths='[16.7,16.7,16.7,16.6,16.7,16.6]'><img src='<?php echo $imageURL ?>col6.png'/><span>6 col</span></button>
    <!--button data-widths='[14.3,14.3,14.3,14.2,14.3,14.3,14.3]'><img src='<?php echo $imageURL ?>col7.png'/><span>7 col</span></button>
    <button data-widths='[12.5,12.5,12.5,12.5,12.5,12.5,12.5,12.5]'><img src='<?php echo $imageURL ?>col8.png'/><span>8 col</span></button-->
</div>


<!--
    Change Section Dialog Box
-->
<div id="dialog-section-change" title="Change Column Layout">
    <p>Select the new layout for the section. Your panels will be moved if necessary.</p>
    <button data-widths='[100]'><img src='<?php echo $imageURL ?>col1.png'/><span>1 col</span></button>
    <button data-widths='[50,50]'><img src='<?php echo $imageURL ?>col2.png'/><span>2 col</span></button>
    <button data-widths='[33.3, 33.4, 33.3]'><img src='<?php echo $imageURL ?>col3.png'/><span>3 col</span></button>
    <button data-widths='[66.7, 33.3]'><img src='<?php echo $imageURL ?>col23.png'/><span>2/3 col</span></button>
    <button data-widths='[25,25,25,25]'><img src='<?php echo $imageURL ?>col4.png'/><span>4 col</span></button>
    <button data-widths='[75,25]'><img src='<?php echo $imageURL ?>col34.png'/><span>3/4 col</span></button>
    <button data-widths='[20,20,20,20,20]'><img src='<?php echo $imageURL ?>col5.png'/><span>5 col</span></button>
    <button data-widths='[16.7,16.7,16.7,16.6,16.7,16.6]'><img src='<?php echo $imageURL ?>col6.png'/><span>6 col</span></button>
    <!--button data-widths='[14.3,14.3,14.3,14.2,14.3,14.3,14.3]'><img src='<?php echo $imageURL ?>col7.png'/><span>7 col</span></button>
    <button data-widths='[12.5,12.5,12.5,12.5,12.5,12.5,12.5,12.5]'><img src='<?php echo $imageURL ?>col8.png'/><span>8 col</span></button-->
</div>

<!--
    Delete Dialog Box
-->
<div id="dialog-delete" title="Confirm Delete">
    <p>Are you sure you want to delete this item?</p>
    <button class='cancel'>Cancel</button>
    <button class='delete'>Delete</button>
</div>

<!--
    Copy Paste Dialog Box
-->
<div id="dialog-copy-paste" title="Import and Export Page Builder Layout">
    <p>Use this dialog to import and export page builder layouts across different editors</p>
    <p>Copy this text and paste it in the <strong>import</strong> box of another page builder</p>
    <textarea class='export' style='height: 100px;width: 100%;'></textarea>
    <p>Paste imported below and click on the import button to replace the contents of your page builder with this data</p>
    <textarea class='import' style='height: 100px;width: 100%;'></textarea>
    <button class='import' style='float: right;'>Import</button>
</div>

<!--
    Main Grid
-->
<div class='panels-container'>
    <button class='open-import-export'><i class='icon-exchange icon-large'></i> Import &amp; Export Page Builder Layouts</button>
    <!-- <button class='add-section'><i class='icon-plus'></i> &nbsp; Section</button>
    <button class='add-panel'><i class='icon-plus'></i> &nbsp; Panel</button> -->
    <div class='grid-container'>
        <button class='add-section'><i class='icon-plus icon-large'></i> Section</button>
    </div>
    
    <?php
    
    $languages = bfi_get_option(BFI_SHORTNAME . "_multilanguages");
    if ($languages != "") {
        $languages = unserialize($languages);
        $languageNames = bfi_list_languages();
        
        foreach ($languages as $language => $locale) {
            $data = bfi_get_post_meta($post->ID, 
                                      BFI_SHORTNAME . "_pagebuilder_" . $language);
            if (!$data) $data = '[{"properties":"","columns":[{"width":100,"panels":[]}]}]';
        
            printf("<input type='text' class='pagebuilder_init_data' 
                    id='%s' name='%s' value='%s'/>",
                BFI_SHORTNAME . "_pagebuilder_" . $language,
                BFI_SHORTNAME . "_pagebuilder_" . $language,
                $data);
        }
    }
    
    $data = str_replace("'", "&apos;", bfi_get_post_meta($post->ID, BFI_SHORTNAME . '_pagebuilder'));
    if (!$data) $data = '[{"properties":"","columns":[{"width":100,"panels":[]}]}]';
    
    printf("<input type='hidden' class='pagebuilder_init_data' 
            id='%s' name='%s' value='%s'/>",
        BFI_SHORTNAME . "_pagebuilder",
        BFI_SHORTNAME . "_pagebuilder",
        $data);
    
    ?>
</div>
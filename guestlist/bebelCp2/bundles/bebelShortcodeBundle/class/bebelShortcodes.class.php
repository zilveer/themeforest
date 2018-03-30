<?php


class bebelShortcodes
{
  protected
    $shortcodes;


  public function __construct()
  {

    // create new shortcodeFunctions object. Thats the only solution I found that
    // doesn't suck as much as loose functions...
    $this->shortcodes = new bebelShortcodeFunctions();

    add_action('load-post.php', array($this, 'init'));
    add_action('load-post-new.php', array($this, 'init'));
  }

  public function init()
  {
    // Don't bother doing this stuff if the current user lacks permissions
    if(!current_user_can('edit_posts') && !current_user_can('edit_pages'))
    {
      return;
    }
    

    // letz do it
    if(get_user_option('rich_editing') == 'true')
    {
      add_filter("mce_external_plugins", array($this,"addTinyMcePlugin"));
      add_filter('mce_buttons', array($this,'registerShortcodeButtons'));
    }
    //add_action( 'admin_head', array($this,'renderHtmlButtons') );
    
  }

  /**
   * Simply adds the javascript file to the loader
   * 
   * @param array $plugin_array
   * @return string
   */
  public function addTinyMcePlugin($plugin_array)
  {
    $plugin_array['bebel_shortcode'] = BebelUtils::replaceToken('%BCP_BUNDLE_PATH%/bebelShortcodeBundle/assets/js/tinymce/plugins/bebel_shortcode/editor_plugin.js', 'BCP_BUNDLE_PATH');
    return $plugin_array;
  }

  public function registerShortcodeButtons($buttons)
  {
    array_push(
      $buttons,
      "separator",
      "bebel_button_builder",
      "bebel_list_builder"
      #"bebel_gallery_builder",
      #"bebel_video_builder",
      #"bebel_audio_builder"
      #"bebel_custom_builder"
    );
    return $buttons;
  }

  /**
   * thanks to http://wordpress.org/extend/plugins/davids-ultra-quicktags/ for the inspiration
   *
   * for the declatation of the shortcode buttons, go to the file where the shortcodes are declared.
   */

  public function renderHtmlButtons() {
    
    $shortcode_buttons = $this->shortcodes->getButtons();

    $buttons_html_editor = '';
    $edButtons = '';
    foreach($shortcode_buttons as $button => $value) {
      $buttons_html_editor .= '<input type="button" class="ed_button" onClick="BebelHtmlQuick(\''.$value[1].'\')" title="'.$value[0].'" value="'.$value[1].'" id="'.$button.'" />';
      $edButtons           .= 'edButtons[edButtons.length] = new edButton("'.$value[1].'", "'.$value[1].'", "", "" ,"'.$value[1].'"); ';
    }

    echo '<script type="text/javascript">
            // <![CDATA[
            // Add the buttons to the HTML view
            function BebelHtmlQuick(type) {

              var dvgi = edButtons.length;
              switch (type) {
                case "clear":
                  dvgi = dvgi - 15;
                  newtext = "[clear] ";
                  break;
                case "divider":
                  dvgi = dvgi - 14;
                  newtext = "[divider] ";
                  break;
                case "dropcap":
                  dvgi = dvgi - 13;
                  dropLetter = prompt("Enter a letter to dropcap", "L");
                  if(dropLetter) {
                    newtext = "[dropcap]"+dropLetter+"[/dropcap] ";
                  }
                  break;
                case "dropcap2":
                  dvgi = dvgi - 12;
                  dropLetter = prompt("Enter a letter to dropcap", "L");
                  if(dropLetter) {
                    newtext = "[dropcap2]"+dropLetter+"[/dropcap2] ";
                  }
                  break;
                case "toggle":
                  dvgi = dvgi - 11;
                  toggleText = prompt("Enter some text for the first toggle (shown)", "Lorem Ipsum");
                  if(toggleText) {
                    newtext = "[toggle show=\"show\"]"+toggleText+"[/toggle] ";
                    toggleTextAdd = prompt("Enter some text for the second toggle (hidden)", "Lorem Ipsum");
                    if(toggleTextAdd) {
                      newtext = newtext+" [toggle show=\"hide\"]"+toggleTextAdd+"[/toggle] ";
                      i=3;
                      while(toggleTextAdd) {
                        toggleTextAdd = prompt("Enter some text for toggle "+i+" (hidden)", "Lorem Ipsum");
                        if(toggleTextAdd) {
                          newtext = newtext+" [toggle show=\"hide\"]"+toggleTextAdd+"[/toggle] ";
                          i++;
                        }
                      }
                    }
                  }
                  break;
                case "error":
                  dvgi = dvgi - 11;
                  boxText = prompt("Enter some error", "Lorem Ipsum does not exist!!!!");
                  if(boxText) {
                    newtext = "[error]"+boxText+"[/error] ";
                  }
                  break;
                case "warning":
                  dvgi = dvgi - 10;
                  boxText = prompt("Enter some warning", "Lorem Ipsum or I...!!!!");
                  if(boxText) {
                    newtext = "[warning]"+boxText+"[/warning] ";
                  }
                  break;
                case "info":
                  dvgi = dvgi - 10;
                  boxText = prompt("Enter some info", "Do you know Lorem Ipsum?");
                  if(boxText) {
                    newtext = "[info]"+boxText+"[/info] ";
                  }
                  break;
                case "download":
                  dvgi = dvgi - 9;
                  boxText = prompt("Will be built in three steps\n1.Enter the link", "http://");
                  if(boxText) {
                    link_url = boxText;
                    boxText = prompt("Will be built in three steps\n2.Enter the link text", "Download");
                    if(boxText) {
                      link_text = boxText;
                      boxText = prompt("Will be built in three steps\n3.Enter the link description (small text below linktext)", "Version 1.0 from '.  date_i18n("M d Y").' ");
                      if(boxText) {
                        link_descr = boxText;
                        // build shortcode
                        newtext = "[download link=\""+link_url+"\" smalltext=\""+link_descr+"\"]"+link_text+"[/download] ";
                      }
                    }
                  }
                  break;
                case "one_third":
                  dvgi = dvgi - 8;
                  boxText = prompt("Enter some text", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
                  if(boxText) {
                    newtext = "[one_third]"+boxText+"[/one_third] ";
                  }
                  break;
                case "two_third":
                  dvgi = dvgi - 7;
                  boxText = prompt("Enter some text", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
                  if(boxText) {
                    newtext = "[two_third]"+boxText+"[/two_third] ";
                  }
                  break;
                case "one_fourth":
                  dvgi = dvgi - 6;
                  boxText = prompt("Enter some text", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
                  if(boxText) {
                    newtext = "[one_fourth]"+boxText+"[/one_fourth] ";
                  }
                  break;
                case "three_fourth":
                  dvgi = dvgi - 5;
                  boxText = prompt("Enter some text", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
                  if(boxText) {
                    newtext = "[three_fourth]"+boxText+"[/three_fourth] ";
                  }
                  break;
                case "half_left":
                  dvgi = dvgi - 4;
                  boxText = prompt("Enter some text", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
                  if(boxText) {
                    newtext = "[half_left]"+boxText+"[/half_left] ";
                  }
                  break;
                case "half_right":
                  dvgi = dvgi - 3;
                  boxText = prompt("Enter some text", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
                  if(boxText) {
                    newtext = "[half_right]"+boxText+"[/half_right] ";
                  }
                  break;

              }

              edButtons[dvgi].tagStart = newtext;

              if ( typeof tinyMCE != "undefined" && ( ed = tinyMCE.activeEditor ) && !ed.isHidden() ) {
                ed.focus();
                if (tinymce.isIE)
                  ed.selection.moveToBookmark(tinymce.EditorManager.activeEditor.windowManager.bookmark);
                var toreplace = tinyMCE.activeEditor.selection.getContent();
                ed.execCommand("mceInsertContent", false, newtext + toreplace + "</span>");
              } else
                edInsertTag(edCanvas, dvgi);
            }
            jQuery(document).ready(function(){


              jQuery("#ed_toolbar").append("'. shortcodeUtils::davidJsEscape($buttons_html_editor) .'");
              '.$edButtons.'
            });

            // ]]>
          </script>';


  }


  public function register($shortcodes)
  {
    $this->shortcodes = array_merge($this->shortcodes, $shortcodes);
  }

}
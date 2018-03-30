<?php

#main config
require_once("config.php");
require_once("variables.php");
require_once("update_parameters.php");
require_once("aq_resizer.php");

#page builder
require_once("page-builder/pb.php");

#classes
require_once("classes/admin-tabs-controls.php");
require_once("classes/admin-tabs-option-types.php");
require_once("classes/admin-tabs-list.php");
require_once("classes/gallery_manager.php");

#shortcodes
require_once("shortcodes/title.php");
require_once("shortcodes/textarea.php");
require_once("shortcodes/columns.php");
require_once("shortcodes/gallery.php");
require_once("shortcodes/pricetable.php");
require_once("shortcodes/container.php");
require_once("shortcodes/social_share.php");
require_once("shortcodes/buttons.php");
require_once("shortcodes/diagramm.php");
require_once("shortcodes/blockquote.php");
require_once("shortcodes/postinfo.php");
require_once("shortcodes/testimonials.php");
require_once("shortcodes/iconboxes.php");
require_once("shortcodes/messageboxes.php");
require_once("shortcodes/social_icons.php");
require_once("shortcodes/colorblocks.php");
require_once("shortcodes/dropcaps.php");
require_once("shortcodes/feedback_form.php");
require_once("shortcodes/frame.php");
require_once("shortcodes/promotext.php");
require_once("shortcodes/lislider.php");
require_once("shortcodes/lislide.php");
require_once("shortcodes/ourteam.php");
require_once("shortcodes/partners.php");
require_once("shortcodes/video.php");
require_once("shortcodes/blog.php");
require_once("shortcodes/portfolio.php");
require_once("shortcodes/tabs.php");
require_once("shortcodes/highlighter.php");
require_once("shortcodes/contacts.php");
require_once("shortcodes/accordion.php");
require_once("shortcodes/divider.php");
require_once("shortcodes/toggles.php");
require_once("shortcodes/feature_posts.php");
require_once("shortcodes/list.php");

#all registration
require_once("registrator/admin-pages.php");
require_once("registrator/css-js.php");
require_once("registrator/css-js-demo.php");
require_once("registrator/custom-post-types.php");
require_once("registrator/ajax-handlers.php");
require_once("registrator/post-handlers.php");
require_once("registrator/sidebars.php");
require_once("registrator/fonts.php");
require_once("registrator/misc.php");

#admin
require_once("admin/options.php");
require_once("admin/theme-settings-page.php");

#widgets
require_once("widgets/twitter.php");
require_once("widgets/flickr.php");
require_once("widgets/posts.php");
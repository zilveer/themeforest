<!-- BEGIN #shortcodemanager -->

<div id="shortcodemanager" class="hidden">
<div id="shortcodewrapper">
<h3></h3>

<!-- BEGIN #shortcode-select -->

<select id="shortcode-select" title="Select this Shortcode">
  
  <option value="custom">Custom Shortcode</option>

  <?php if ($this->postType == 'item') : ?>
    <optgroup label="<?php echo A_THEME_NAME ?> Specials">
      <option value="work-content">Sample Work Content</option>
    </optgroup>
  <?php endif ?>

  <?php if ($this->postType == 'page') : ?>
    <optgroup label="<?php echo A_THEME_NAME ?> Specials">
      <option value="about-page">About Page</option>
      <option value="contact-page">Contact Page</option>
      <option value="home-page">Homepage</option>
    </optgroup>
  <?php endif ?>
  
  <optgroup label="Mixed Examples">
    <option value="buttons">Graphic Buttons</option>
    <option value="columns">Columned Content</option>
    <option value="dropcap-labels">Dropcap and Labels</option>
    <option value="lists">Custom Lists</option>
    <option value="tabs-togglers">Tabs and Togglers</option>
  </optgroup>

</select> 

<!-- END #shortcode-select -->

<h3> Result: </h3>

<!-- BEGIN Textareas -->

<textarea name="custom" class="result"><?php echo $this->customShortcode ?></textarea>

<!-- == Sample Work Content == -->
<textarea name="work-content" rows="7">[autocol]
Ice cream pudding tootsie roll <em>topping tiramisu</em> croissant soufflé <a href="#">topping biscuit</a>.

Jujubes chocolate cake dessert sesame snaps gingerbread. Gummi bears sweet jujubes chupa chups chocolate cake. Pie apple pie croissant chocolate pie cupcake.

Cookie sweet roll pastry. Danish candy canes jelly marshmallow bonbon liquorice wafer. Pie I love cotton candy cookie. Cake fruitcake muffin cotton candy jelly beans.

Gummi bears sweet jujubes chupa chups chocolate cake. Danish candy canes jelly marshmallow bonbon liquorice wafer. Jelly beans pastry carrot cake dragée tootsie roll macaroon.
[/autocol]

<!--more-->

[toright]

[caption id="" align="alignnone" width="1000"]<img class="size-full " title="Sample Image" alt="" src="http://html.alaja.info/hati/img/single-1.jpg" width="1000" height="714" /> Cotton candy liquorice powder dessert cotton candy sugar plum. Faworki macaroon.[/caption]

[/toright]

[note pull=right dark=true]

<strong>That&#8217;s interesting</strong>

Cotton candy liquorice powder dessert cotton candy sugar plum. Faworki macaroon.

[/note]

[autocol]
Cookie sweet roll pastry. Chocolate cake lollipop croissant marshmallow I love.

Chocolate cake icing danish wypas carrot cake. Danish gummi bears icing chocolate gummies I love. Ice cream topping biscuit pudding tootsie roll topping tiramisu croissant soufflé. Icing I love liquorice cake toffee sugar plum.

Cupcake applicake cotton candy powder jelly I love sugar plum sweet roll. Chocolate chocolate muffin.
[/autocol]

[note pull=left light=true]

<strong>That&#8217;s interesting</strong>

Cookie sweet roll pastry. I love pastry jujubes chocolate cake marshmallow I love cookie carrot cake.

[/note]

[toright]

[caption id="" align="alignright" width="1000"]<img class="size-full" title="Sample Image" alt="" src="http://html.alaja.info/hati/img/single-2.jpg" width="1000" height="714" /> Cotton candy liquorice powder dessert cotton candy sugar plum. Faworki macaroon.[/caption]

<img class="size-full alignright" title="Sample Image" alt="" src="http://html.alaja.info/hati/img/single-3.jpg" width="1000" height="714" />

[/toright]

[note pull=left]

<strong>That&#8217;s interesting</strong>

Chocolate chocolate muffin. Cotton candy liquorice powder dessert cotton candy sugar plum.

[/note]

[toright]
<img class="size-full alignright" title="Sample Slide" alt="" src="http://html.alaja.info/hati/img/single-4.jpg" width="1000" height="714" />
[/toright]</textarea>

<!-- == Contact Page == -->
<textarea name="contact-page" rows="7">[left]
[heading]Phone / Fax / Mail[/heading]
P: <a href="tel:+number">+8 (41) 9982-23-23</a>
F: <a>+8 (41) 9982-23-24</a>
E: <a href="mailto:noreply@noreply.Hati">contact@Hati.com</a>
[/left]

[center]
[autocol]Please give us a call, email us (on the left of the page) or use the contact form below to reach us right now.[/autocol]
[contact email='your@email' send='Send' yourname='Your Name' yourmail='Your Email' yourmsg='Your Message']
[/center]

[right]
[heading]We looking for[/heading]
<a href="#">Interface Designer</a>
<a href="#">CSS &amp; HTML Viking</a>
[note dark=true]

<strong>Important notice</strong>

We’re always interested in good folks! If you love what you do, just <a href="#reel">send us</a> a link to your reel / portfolio.

[/note]
[/right]</textarea>

<!-- == About Page == -->
<textarea name="about-page" rows="7">[left]
[heading]Homecity / Established[/heading]
<a href="http://en.wikipedia.org/wiki/1984_(disambiguation)">1984.</a> <a href="#">London, UK.</a>
[/left]

[center]
[autocol]
Hi, our names Alex &amp; Kim and we using <a href="#">UI &amp; UX for dragée</a> liquorice sesame snaps.

We passionate about icing croissant, candy jelly-o gummi bears and pastry faworki caramels powder chocolate cake.

Caramels halvah tootsie roll cotton candy biscuit. Gummi bears toffee halvah jelly beans liquorice muffin bear claw chocolate cake. Wypas chocolate sesame snaps tiramisu halvah halvah. Tart ice cream sugar plum. I love pudding candy pie.
[/autocol]

I love pudding candy pie. Ice cream danish soufflé applicake marzipan. Chocolate cake gummi bears dragée cheesecake.

[note pull=left]

<strong>That’s interesting</strong>

Tiramisu jujubes jelly beans chocolate cake cheesecake. Cotton candy liquorice powder dessert cotton candy sugar plum.

[/note]

[note pull=right dark=true]

<strong>Our latest tweets:</strong>
[br]

<a href="http://twitter.com/helloalaja">@helloalex:</a>

[tweet name=helloalaja]
[br]

<a href="http://twitter.com/helloalaja">@hellokim:</a>

[tweet name=helloalaja]

[/note]

[one_half mod=mobile-centred]
<em>Your image here</em>
<h4>Alex Kim</h4>
<a href="#">alex@Hati.com</a>

Cookie sweet roll pastry. Topping lollipop cookie oat cake fruitcake wafer faworki. Pie apple pie croissant chocolate pie cupcake.

Pie I love chupa chups faworki. Icing I love liquorice cake toffee sugar plum. Lollipop apple pie dragée dessert sugar plum muffin.

[/one_half]

[one_half_last mod=mobile-centred]
<em>Your image here</em>
<h4>Kim Alex</h4>
<a href="#">kim@Hati.com</a>

Pie I love chupa chups faworki. Icing I love liquorice cake toffee sugar plum. Lollipop apple pie dragée dessert sugar plum muffin.

Cookie sweet roll pastry. Topping lollipop cookie oat cake fruitcake wafer faworki. Pie apple pie croissant chocolate pie cupcake.

[/one_half_last]
<blockquote>I love pudding candy pie. Ice cream danish soufflé applicake marzipan. Chocolate cake gummi bears dragée cheesecake.</blockquote>
[/center]

[right]
[heading]Yes, we tweet[/heading]
<a href="http://twitter.com/helloalaja">@helloalex</a>
<a href="http://twitter.com/helloalaja">@hellokim</a>
[/right]</textarea>

<!-- == Homepage == -->
<textarea name="home-page" rows="7">[heading rtitle="Contact Us →" rlink="#contact"]About Hati[/heading]
[one_third]
<h4>Who we are</h4>
Chocolate cake gummi bears dragée cheesecake. Brownie chocolate bar candy canes carrot cake. Tiramisu jujubes jelly beans chocolate cake cheesecake. Ice cream danish soufflé applicake marzipan.
[/one_third]
[one_third]
<h4>What we do</h4>
We using <a href="#">UI &amp; UX for dragée</a> liquorice sesame snaps. Pie apple pie croissant chocolate pie cupcake. Topping gingerbread halvah candy. Applicake wypas jelly I love.
[/one_third]
[one_third_last]
<h4>Capabilities</h4>
– Android &amp; iOS App Design
– Interface Design
– Mobile &amp; Tablets
– Responsive Web
– Social Media Tools
[/one_third_last]

[heading rtitle="View All →" rlink="#portfolio"]Latest Projects[/heading]
[folio]</textarea>


<!-- == Mixed Examples: Buttons == -->
<textarea name="buttons" rows="11">[button url="#url"] Button Text [/button]

// styles supported: white, black, blue, orange, teal, yellow, green, brown, gray, purple, steel, cyan, classic
[button url="#url" style=black] Button Text [/button]

// sizes: small, big, wide
[button url="#big" size=big] Big Button [/button]

// compilation
[button url="#wide" size=wide style=gray] Wide Button Caption [/button]</textarea>

<!-- == Mixed Examples: Columns == -->
<textarea name="columns" rows="15">// mixed
[one_third] <strong>one_third</strong>. Jelly beans macaroon cheesecake soufflé marzipan applicake applicake. I love pastry jujubes chocolate. [/one_third]
[two_third_last] <strong>two_third_last</strong>. Jelly beans macaroon cheesecake soufflé marzipan applicake applicake. I love pastry jujubes chocolate cake marshmallow I love cookie carrot cake pudding. [/two_third_last]

[one_sixth] <strong>one_sixth</strong>. Jelly beans macaroon cheesecake soufflé. [/one_sixth]
[one_third] <strong>one_third</strong>. Jelly beans macaroon cheesecake soufflé marzipan applicake chocolate cake marshmallow. [/one_third]
[one_half_last] <strong>one_half_last</strong>. Topping lollipop cookie oat cake fruitcake wafer faworki. Applicake wypas jelly I love. Chocolate cake lollipop. [/one_half_last]

// halves
[one_half] <strong>one_half</strong>. Jelly beans macaroon cheesecake soufflé marzipan applicake applicake. I love pastry jujubes chocolate cake marshmallow I love cookie carrot cake pudding. [/one_half]
[one_half_last] <strong>one_half_last</strong>. Jelly beans macaroon cheesecake soufflé marzipan applicake applicake. I love pastry jujubes chocolate cake marshmallow I love cookie carrot cake pudding. [/one_half_last]

// thirds
[one_third] <strong>one_third</strong>. Topping lollipop cookie oat cake fruitcake wafer faworki. Applicake wypas jelly I love. Chocolate cake lollipop. [/one_third]
[one_third] <strong>one_third</strong>. Topping lollipop cookie oat cake fruitcake wafer faworki. Applicake wypas jelly I love. Chocolate cake lollipop. [/one_third]
[one_third_last] <strong>one_third_last</strong>. Topping lollipop cookie oat cake fruitcake wafer faworki. Applicake wypas jelly I love. Chocolate cake lollipop. [/one_third_last]

// fourths (the same for fifths &amp; sixths)
[one_fourth] <strong>one_fourth</strong>. Cheesecake gummi bears marshmallow cotton candy. Danish gummi bears icing chocolate gummies. [/one_fourth]
[one_fourth] <strong>one_fourth</strong>. Cheesecake gummi bears marshmallow cotton candy. Danish gummi bears icing chocolate gummies. [/one_fourth]
[one_fourth] <strong>one_fourth</strong>. Cheesecake gummi bears marshmallow cotton candy. Danish gummi bears icing chocolate gummies. [/one_fourth]
[one_fourth_last] <strong>one_fourth_last</strong>. Cheesecake gummi bears marshmallow cotton candy. Danish gummi bears icing chocolate. [/one_fourth_last]</textarea>

<!-- == Mixed Examples: Dropcap & Labels == -->
<textarea name="dropcap-labels" rows="9">// dropcaps
[one_half] [dropcap style="dark"] Dropcap [/dropcap] Gummi bears sweet jujubes chupa chups chocolate cake. Topping gingerbread halvah candy. Lollipop apple pie dragée dessert sugar plum muffin. [/one_half]

[one_half_last] [dropcap] Dropcap [/dropcap] Jelly beans macaroon cheesecake soufflé marzipan applicake applicake. I love pastry jujubes chocolate cake marshmallow I love cookie carrot cake pudding. [/one_half_last]

// labels
[one_fifth] [label style="red"] Red label [/label] Apple pie danish toffee jujubes. [/one_fifth]
[one_fifth] [label style="green"] Green label [/label] Chocolate chocolate muffin. [/one_fifth]
[one_fifth] [label style="orange"] Orange label [/label] Pie I love chupa chups. [/one_fifth]
[one_fifth] [label style="blue"] Blue label [/label] Chupa chups chocolate bar danish. [/one_fifth]
[one_fifth_last] [label style="gray"] Gray label [/label] Cupcake cotton candy powder. [/one_fifth_last]</textarea>

<!-- == Mixed Examples: Dropcap & Labels == -->
<textarea name="lists" rows="12">[list]
<ol>
  <li>Default ordered list</li>
  <li>Pellentesque</li>
  <li>Sed posuere</li>
</ol>
[/list]

[list]
<ul>
  <li>Default unordered list</li>
  <li>Pellentesque</li>
  <li>Sed posuere</li>
</ul>
[/list]

[list type=check]
<ul>
  <li>Unordered check list</li>
  <li>Pellentesque</li>
  <li>Sed posuere</li>
</ul>
[/list]

[list type=circle]
<ul>
  <li>Unordered circle list</li>
  <li>Pellentesque</li>
  <li>Sed posuere</li>
</ul>
[/list]

[list type=disc]
<ul>
  <li>Unordered disc list</li>
  <li>Pellentesque</li>
  <li>Sed posuere</li>
</ul>
[/list]

[list type=zero]
<ol>
  <li>Ordered</li>
  <li>Leading Zero</li>
  <li>List</li>
</ol>
[/list]

[list type=cjk]
<ol>
  <li>Ordered</li>
  <li>CJK Ideographic</li>
  <li>List</li>
</ol>
[/list]

[list type=hebrew]
<ol>
  <li>Ordered</li>
  <li>Hebrew</li>
  <li>List</li>
</ol>
[/list]

[list type=hiragana]
<ol>
  <li>Ordered</li>
  <li>Hiragana</li>
  <li>List</li>
</ol>
[/list]

[list type=katakana]
<ol>
  <li>Ordered</li>
  <li>Katakana</li>
  <li>List</li>
</ol>
[/list]

[list type=latin]
<ol>
  <li>Ordered</li>
  <li>Latin</li>
  <li>List</li>
</ol>
[/list]

[list type=roman]
<ol>
  <li>Ordered</li>
  <li>Roman</li>
  <li>List</li>
</ol>
[/list]

[list type=greek]
<ol>
  <li>Ordered</li>
  <li>Greek</li>
  <li>List</li>
</ol>
[/list]

[list type=Latin]
<ol>
  <li>Ordered</li>
  <li>Upper Latin</li>
  <li>List</li>
</ol>
[/list]

[list type=Roman]
<ol>
  <li>Ordered</li>
  <li>Upper Roman</li>
  <li>List</li>
</ol>
[/list]</textarea>

<!-- == Mixed Examples: Tabs & Togglers == -->
<textarea name="tabs-togglers" rows="12">// tabs
[tabs tab1="Tab 1 Title" tab2="Tab 2 Title" tab3="Tab 3 Title"]
  [tab] Chocolate chocolate muffin. [/tab]
  [tab] Apple pie danish toffee jujubes. [/tab]
  [tab] Pie I love chupa chups. [/tab]
[/tabs]

// togglers
[toggle title="Closed by default" state="closed"] Toggle closed by default. [/toggle]
[toggle title="Open by default" state="open"] Toggle open by default. [/toggle]

// accordion
[accordion title="Closed by default"] Toggle closed by default. [/accordion]
[accordion title="Open by default" state="open"] Toggle open by default. [/accordion]
[accordion title="Closed by default"] Toggle closed by default. [/accordion]
[accordion title="Closed by default"] Toggle closed by default. [/accordion]
</textarea>

<!-- END Textareas -->

<p>
  <input type="submit" id="shortcode-cancel" class="button" value="Cancel">
  <input type="submit" id="shortcode-insert" class="button-primary" value="Use This Code">
</p>
</div>
</div>

<!-- END #shortcodemanager -->

<!-- shortcode manager styles -->

<style>
#shortcodewrapper { max-width: 540px; margin: 0 auto; }
#shortcodewrapper h3 { padding: 10px 0 }
#shortcodewrapper p { margin-top: 1.63em }
#shortcodewrapper select { width: 100%; height: 30px; }
#shortcodewrapper textarea { display: none; width: 100%; min-height: 114px; resize: vertical; }
#shortcodewrapper textarea.result { display: block }
#shortcodewrapper #shortcode-insert { float: right }
#shortcodewrapper textarea {line-height:19px;font-size:11px;padding:0 0 0 .5em;font-family:"Lucida Sans Typewriter","Lucida Console",Monaco,"Bitstream Vera Sans Mono",monospace;background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAmCAYAAAAMV1F9AAAAHUlEQVQoU2MQVHLhR8cMo4IDJfj//38MPCo4UIIAHGtNredMLVMAAAAASUVORK5CYII=")top;background-attachment:local}

.wp_themeSkin a#content_wp_asc .mceIcon, #mce_99 i.mce-i-smgr { background: url('<?php echo A_THEME_URL ?>/img/magic.png') no-repeat center bottom; }
.wp_themeSkin a#content_wp_asc:hover .mceIcon, #mce_99:hover i.mce-i-smgr { background-position: center top; }

#mce_99 a.thickbox { outline: none }

#mce_99 .mce-tooltip { margin-left: -55px }
@media screen and (max-width: 782px) { #mce_99 .mce-tooltip { margin-left: -50px } }

#mce_99 .mce-tooltip, #fullscreen-topbar #mce_99 .mce-tooltip { visibility: hidden }
#mce_99:hover .mce-tooltip { visibility: visible }


</style>

<!-- shortcode manager scripts -->

<script>
jQuery.noConflict();

var ShortcodeManager = {
  
  lt39: <?php echo (int) version_compare( get_bloginfo("version"), "3.9", "<" ) ?>,

  btnCode: '<td><a id="content_wp_asc" href="#TB_inline?&amp;inlineId=shortcodemanager&amp;width=640&amp;height=695" class="mceButton mceButtonEnabled mce_wp_asc thickbox" title="Shortcode Manager" tabindex="-1"><span class="mceIcon mce_wp_asc"></span><span class="mceVoiceLabel mceIconOnly" style="display:none;" id="mce_wp_asc_voice">Shortcode Manager</span></a></td>',

  btnCode39: 
    '<div id="mce_99" class="mce-widget mce-btn wp-fullscreen-both" tabindex="-1" role="button" aria-label="Shortcode Manager" title="Shortcode Manager"><a href="#TB_inline?&amp;inlineId=shortcodemanager&amp;width=640&amp;height=695" class="thickbox" title="Shortcode Manager" tabindex="-1"><button aria-label="Shortcode Manager" title="Shortcode Manager" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-smgr"></i></button>'+ 
    '<div class="mce-widget mce-tooltip mce-tooltip-n" role="presentation"><div class="mce-tooltip-arrow"></div><div class="mce-tooltip-inner">Shortcode&nbsp;Manager</div></div>'+
    '</a></div>',

  init: function () { // called from shortcode.manager.php

    if (this.initialized) return; // multiple init calls are very possible
    
    this.addSMButton();
    this.initDelegates();
    
    this.initialized = true;
  },
  // add shortcode manager buttons
  addSMButton: function() {
    if (this.lt39) {
      jQuery('#content_toolbar1').find('.mceToolbarEnd.mceLast').before(this.btnCode); // inject TinyMCE 1st row
      jQuery('#wp-fullscreen-buttons').append('<div>' + this.btnCode + '</div>'); // inject fullscreen editor
    } else {
      jQuery('.mce-toolbar.mce-first').find('.mce-btn.mce-last').after(this.btnCode39); // inject TinyMCE 1st row
      jQuery('#wp-fullscreen-buttons').append(this.btnCode39); // inject fullscreen editor
    }
  },
  // activate shortcode manager actions
  initDelegates: function() {
    var self = this;
    jQuery('body').delegate('#shortcode-insert', 'click', function () {
      self.insertShortcode();
      tb_remove();
    }).delegate('#shortcode-cancel', 'click', function () {
      tb_remove();
    }).delegate('#shortcode-select', 'change', function () {
      jQuery('#TB_window textarea:visible').hide();
      jQuery('#TB_window textarea[name="' + this.value +'"]').fadeIn('fast').focus();
    });
  },
  // insert shortcode content
  insertShortcode: function () {
    var v = jQuery('#TB_window textarea:visible').val();
    v = v.replace( new RegExp('^\/\/.*$', 'gmi'), '' ); // remove comments starting with '//'
    if (switchEditors.wpautop) v = switchEditors.wpautop(v);
    if (v) tinyMCE.execCommand('mceInsertContent', false, v);
  }
}

</script>
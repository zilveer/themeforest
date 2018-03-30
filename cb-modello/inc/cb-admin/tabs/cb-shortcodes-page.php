<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:54
 */
function show_cb_shortcodes_page()
{
    ?>
    <!-- SHORTCODES SECTION START-->

        <b>Columns shortcodes</b>
        <pre>[cols][col2] content [/col2][col2 s="0"] content [/col2][/cols][col_end]</pre>
        <pre>[cols][col3] content [/col3][col3] content [/col3][col3 s="0"] content [/col3][/cols][col_end]</pre>
        <pre>[cols][col4] content [/col4][col4] content [/col4][col4] content [/col4][col4 s="0"] content [/col4][/cols][col_end]</pre>

        <hr />

        <b>Accordion shortcode</b>
<pre><xmp><div id="accordion">
            <br/><a href="#">First header</a>
            <div>First content</div>
            <br/><a href="#">Second header</a>
            <div>Second content</div>
        </div></xmp></pre>
        <hr />

        <b>Info box shortcodes</b>
        <pre>[box type="warning" title="box title"] box warning [/box]</pre>
        <pre>[box type="error" title="box title"] box error [/box]</pre>
        <pre>[box type="good" title="box title"] box good [/box]</pre>
        <pre>[box type="info" title="box title"] box info [/box]</pre>

        <hr />

        <b>Opacity background shortcodes</b>
        White background:
        <pre>[w_50] contetn [/box] </pre>
        Black background:
        <pre>[b_50] content [/box]</pre>

        <hr />

        <b>Button shortcodes</b>
<pre>[bttn link="#"]button[/bttn]<br/>
[bttn link="#" class="magenta" size="big"]button magenta[/bttn]<br/>
[bttn link="#" class="black"]button black[/bttn]<br/>
[bttn link="#" class="blue"]button blue[/bttn]<br/>
[bttn link="#" class="orange"]button orange[/bttn]<br/>
[bttn link="#" class="green"]button green[/bttn][/col2][col2]<br/>
[bttn img="http://cb-theme.com/demo/modello/wp-content/themes/cb-modello/img/bgu/12.jpg" w="200" h="125"]<br/>
[bttn link="http://cb-theme.com/demo/modello/wp-content/themes/cb-modello/img/bgu/11.jpg" img="http://cb-theme.com/demo/modello/wp-content/themes/cb-modello/img/bgu/11.jpg" w="200" h="125" pp="yes"]<br/>
[bttn link="http://cb-theme.com/demo/modello" target="_blank" img="http://cb-theme.com/demo/modello/wp-content/themes/cb-modello/img/bgu/14.jpg" w="200" h="125"]</pre>
        <br/>

        <hr />

        <b>Youtube &amp; Vimeo shortcodes</b>
        <pre>[yt link="http://www.youtube.com/watch?v=taHChX7kPKA" alt="test video" w="300" h="125" pp="yes"]</pre>
        <pre>[vimeo link="http://vimeo.com/34400428" alt="test vimeo video" w="300" h="125" pp="yes"]</pre>

        <pre>[yt link="http://www.youtube.com/watch?v=4HMm9jrgDzM" w="300" h="125" pp="no"]</pre>
        <pre>[vimeo link="http://vimeo.com/34400428" alt="test vimeo video" w="300" h="125" pp="no"]</pre>
        <br/>

        <hr />

        <b>List shortcodes</b>
        <pre><xmp>[list1]<ul><li>list1</li><li>list1</li></ul>[/list1]</xmp></pre>
        <pre><xmp>[list2]<ul><li>list2</li><li>list2</li></ul>[/list2]</xmp></pre>
        <pre><xmp>[list3]<ul><li>list3</li><li>list3</li></ul>[/list3]</xmp></pre>
        <pre><xmp>[list4]<ul><li>list4</li><li>list4</li></ul>[/list4]</xmp></pre>
        <pre><xmp>[list5]<ul><li>list5</li><li>list5</li></ul>[/list5]</xmp></pre>

        <hr />

        <b>Tab shortcode</b>
        <pre>[tabs][tab name="Tab 1"]Tab content 1[/tab][tab name="Tab 2"]Tab content 2[/tab][tab name="Tab 3"]Tab content 3[/tab][/tabs]</pre>

        <hr />

        <b>Gallery shortcode</b>
        <pre>[gall post_id="61" w="75" h="40" style="padding:10px;float:left;" order="ASC" post_number="5"]</pre>

        <hr />

        <b>Slider shortcode</b>
<pre>[slider w="600" h="220" style="padding:10px;" pp="yes"]
image url
youtube url
image url #2
image url ...
youtube url ...
vimeo url ...
[/slider]</pre>

        <hr />

        <b>Slider &amp; frame shortcode</b>
        <pre>[frame][slider post_id="61" w="630" h="220" style="padding:10px;" pp="yes"][/frame]</pre>

        <hr />

        <b>Divider shortcodes</b>
<pre>[divider1] [/divider1]<br/>
[divider2] [/divider2]<br/>
[divider3] [/divider3]<br/>
[divider4] [/divider4]<br/>
[divider5] [/divider5]</pre>

        <hr />

        <b>Google Maps shortcodes</b>

        <pre>[gmap lat="52.229676" lng="21.012229" type="m1" w="960" ]</pre>
        <pre>[gmap lat="52.229676" lng="21.012229" type="m2" info="test" w="960" ]</pre>
        <pre>[gmap lat="52.229676" lng="21.012229" type="m3" info="test" show_info="true" w="960" h="400" icon="icon url"]</pre>
        <pre>[frame][gmap lat="52.229676" lng="21.012229" w="645" type="m4"][/frame]</pre>
        <br/><br/>
        <b><?php _e('Preview','cb-modello'); ?>: <a href="http://cb-theme.com/demo/modello/shortcodes/" target="_blank"><?php _e('here','cb-modello'); ?></a></b>

    <!-- ## SHORTCODES SECTION END ##-->

<?php
}
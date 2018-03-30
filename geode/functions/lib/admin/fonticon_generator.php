<div class="hidden">
    <div id="shortcodelic_fonticons_generator" class="shortcodelic_meta" data-title="<?php _e('Font icon selector', 'geode'); ?>">
        <div class="alignleft">

            <h3><?php _e('Select a font set (from <a href="http://fontello.com/" target="_blank">Fontello.com</a> and <a href="http://fontastic.me/" target="_blank">Fontastic.me</a>)', 'geode'); ?>:</h3>
            <label class="for_select marginhack">
                <span class="for_select select_font_set">
                    <select>
                        <option value="awesome">Font Awesome (by Dave Gandy, license SIL)</option>
                        <option value="entypo">Entypo (by Daniel Bruce, license CC BY-SA)</option>
                        <option value="typicons">Typicons (by Stephen Hutchings, license CC BY-SA 3.0)</option>
                        <option value="iconic">Iconic (by P.J. Onori, license SIL)</option>
                        <option value="modern">Modern Pictograms (by John Caserta, license SIL)</option>
                        <option value="meteocons">Meteocons (by Alessio Atzeni, license SIL)</option>
                        <option value="mfg">MFG Labs (by MFG Labs, license SIL)</option>
                        <option value="maki">Maki (by Mapbox, license BSD)</option>
                        <option value="zocial">Zocial (by Sam Collins, license MIT)</option>
                        <option value="brandico">Brandico (by Crowdsourced for Fontello project, license SIL)</option>
                        <option value="elusive">Elusive (by Aristeides Stathopoulos, license SIL)</option>
                        <option value="linecons">Linecons (by Designmodo for Smashing Magazine, license CC BY)</option>
                        <option value="websymbols">Web Symbols (by Just Be Nice studio, license SIL)</option>
                        <option value="streamline">Streamline (by Webalis, license SIL)</option>
                        <option value="foundation">Foundation (by Zurb, license CC BY)</option>
                        <option value="steadysets">Steadysets (by Shapemade, license SIL)</option>
                        <option value="ecommerce">WooThemes eCommerce (by Freepik, license SIL)</option>
                    </select>
                </span>
            </label>
        </div>


        <div class="alignright">

            <h3><?php _e('Find an icon', 'geode'); ?>:</h3>
            <input type="text" value="" placeholder="<?php _e('enter a keyword', 'geode'); ?>">
            <div class="clear"></div>
        </div>

        <div class="clear"></div>

        <div class="shortcodelic_font_list">

    <?php /*********** SLIDESHOW GENERATOR ***********/

    require_once( get_template_directory() . '/font/scicon-awesome.php' );

    ?>

        </div><!-- .shortcodelic_font_list -->

    </div><!-- #shortcodelic_tabs_generator -->
</div><!-- .hidden -->
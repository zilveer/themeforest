<form id="awe_form" method="POST" action="">
    <div id="md-framewp" class="md-framewp">
        <div id="md-framewp-header">

            <!-- /////////////////// ALERT BOX ///////////////// -->
                <div class="md-alert-boxs">
                    <?php echo $this->messages;?>
                </div>
        </div><!-- /#md-framewp-header -->
        <div id="md-framewp-body" class="md-tabs">
            <div id="md-tabs-framewp" class="md-tabs-framewp">
                <ul class="clearfix">
                    <li><a href="#md-dashboard"><?php _e('Dashboard',self::LANG);?></a></li>
                    <li><a href="#md-very"><?php _e('Site verification',self::LANG);?></a></li>

                    <span class="add-tabs"><i class="icon-add-tabs"></i></span>
                </ul>
            </div><!-- /.md-tabs-framewp -->
            <div class="md-content-framewp">

                <!-- /////////////////// MD UI COMPONENT ///////////////// -->

                <div id="md-dashboard" class="md-sub-tabs md-tabcontent clearfix">
                    <div class="md-content-sidebar md-tabs-sidebar">
                        <ul class="clearfix">
                            <li><a href="#homepage"><i class="icon-home"></i><?php _e('Homepage',self::LANG);?></a></li>
                            <li><a href="#title"><i class="icon-general"></i><?php _e('WP Title',self::LANG);?></a></li>
                            <li><a href="#docheader"><i class="icon-general"></i><?php _e('Head Meta',self::LANG);?></a></li>
                            <li><a href="#robots"><i class="icon-general"></i><?php _e('Robots Meta',self::LANG);?></a></li>
                            <li><a href="#archives"><i class="icon-general"></i><?php _e('Archives Setting',self::LANG);?></a></li>
                            <li><a href="#sitemap"><i class="icon-general"></i><?php _e('Sitemap',self::LANG);?></a></li>
                            <li><a href="#ggauthorship"><i class="icon-general"></i><?php _e('Google Authorship',self::LANG);?></a></li>
                        </ul>
                    </div><!-- /.md-content-sidebar -->

                    <div class="md-content-main">

                        <div id="homepage" class="md-main-home">

                            <div class="md-tabcontent-row" style="display: none">
                                <div class="md-row-element">
                                    <!-- /////////////////// INPUT FORM ///////////////// -->
                                    <div class="form-elements">
                                        <input id="html5" class="input-checkbox" type="checkbox" name="seo[homepage][html5]" value="1" <?php checked($this->seo_options['homepage']['html5'],1);?>>
                                        <label class="label-checkbox" for="html5"><?php _e('Use semantic HTML5 page and section headings throughout site?',self::LANG);?></label>
                                    </div>
                                </div><!-- /.md-row-element -->
                            </div>
                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Document Title',self::LANG);?></h4>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <!-- /////////////////// INPUT FORM ///////////////// -->
                                    <div class="form-elements"> 
                                        <input type="text" class="input-bgcolor image-url" maxlength="150" placeholder="" name="seo[homepage][title]" value="<?php echo $this->seo_options['homepage']['title'];?>">
                                        <p class="description-element"><?php _e('If you leave the document title field blank, your site\'s title will be used instead.',self::LANG);?></p>
                                        <input id="tagline" class="input-checkbox" type="checkbox" name="seo[homepage][tagline]" value="1" <?php checked($this->seo_options['homepage']['tagline'],1);?>>
                                        <label class="label-checkbox" for="tagline"><?php _e('Add site description (tagline) to <code>&lt;title&gt;</code> on home page?',self::LANG);?></label>
                                    </div>
                                </div><!-- /.md-row-element -->
                            </div><!-- /.md-tabcontent-row -->

                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Meta Description',self::LANG);?></h4>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <!-- /////////////////// INPUT FORM ///////////////// -->
                                    <div class="form-elements">
                                        <textarea class="textarea-border" name="seo[homepage][meta-desc]"><?php echo $this->seo_options['homepage']['meta-desc'];?></textarea>
                                        <p class="description-element"><?php _e(' The meta description can be used to determine the text used under the title on search engine results pages.',self::LANG);?></p>
                                    </div>
                                </div><!-- /.md-row-element -->
                            </div><!-- /.md-tabcontent-row -->

                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Meta Keywords (comma separated)',self::LANG);?></h4>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <!-- /////////////////// INPUT FORM ///////////////// -->
                                    <div class="form-elements">
                                        <input type="text" class="input-bgcolor image-url" maxlength="150" placeholder="" name="seo[homepage][keywords]" value="<?php echo $this->seo_options['homepage']['keywords'];?>">
                                        <p class="description-element"><?php _e('Keywords are generally ignored by Search Engines',self::LANG);?></p>
                                    </div>
                                </div><!-- /.md-row-element -->
                            </div><!-- /.md-tabcontent-row -->

                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Robots Meta Tags',self::LANG);?></h4>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <div class="form-elements inline">
                                        <input id="noindex" class="input-checkbox" type="checkbox" name="seo[homepage][noindex]" value="1" <?php checked($this->seo_options['homepage']['noindex'],1);?>>
                                        <label class="label-checkbox" for="noindex"><?php _e('Apply <code>&lt;noindex&gt;</code> to the homepage? ',self::LANG);?></label>
                                        <input id="nofollow" class="input-checkbox" type="checkbox" name="seo[homepage][nofollow]" value="1" <?php checked($this->seo_options['homepage']['nofollow'],1);?>>
                                        <label class="label-checkbox" for="nofollow"><?php _e('Apply <code>&lt;nofollow&gt;</code> to the homepage? ',self::LANG);?></label>
                                        <input id="noarchive" class="input-checkbox" type="checkbox" name="seo[homepage][noarchive]" value="1" <?php checked($this->seo_options['homepage']['noarchive'],1);?>>
                                        <label class="label-checkbox" for="noarchive"><?php _e('Apply <code>&lt;noarchive&gt;</code> to the homepage?',self::LANG);?></label>
                                    </div><!-- checkbox inline -->
                                </div><!-- /.md-row-element -->
                            </div><!-- /.md-tabcontent-row -->


                        </div>

                        <div id="title">
                            <div class="md-tabcontent-header">
                                <h3 class="md-tabcontent-title"><?php _e('WP Title Settings',self::LANG);?></h3>
                            </div><!-- /.md-tabcontent-header -->

                            <div class="md-tabcontent-row">

                                <div class="md-row-element">
                                    <div class="form-elements">
                                        <input id="site-name" class="input-checkbox" type="checkbox" name="seo[title][site-name]" value="1" <?php checked($this->seo_options['title']['site-name'],1);?>>
                                        <label class="label-checkbox" for="site-name"><?php _e('Add site name to <code>&lt;title&gt;</code> on inner pages?  ',self::LANG);?></label>

                                    </div><!-- checkbox inline -->
                                </div><!-- /.md-row-element -->

                                <div class="md-row-element">
                                    <div class="form-elements">
                                        <p><?php _e('<b>Document Title Additions Location:</b>',self::LANG);?></p>
                                        <input id="lleft" class="input-radio" type="radio" name="seo[title][location]" value="left" <?php checked($this->seo_options['title']['location'],'left');?>>
                                        <label class="label-checkbox" for="lleft"><?php _e('Left',self::LANG);?></label>
                                        <input id="lright" class="input-radio" type="radio" name="seo[title][location]" value="right" <?php checked($this->seo_options['title']['location'],'right');?>>
                                        <label class="label-checkbox" for="lright"><?php _e('Right',self::LANG);?></label>
                                    </div><!-- checkbox inline -->
                                </div><!-- /.md-row-element -->

                                <div class="md-row-element">
                                    <!-- /////////////////// INPUT FORM ///////////////// -->
                                    <div class="form-elements">
                                        <p><?php _e('<b>Document Title Separator:</b>',self::LANG);?></p>
                                        <input type="text" class="input-bgcolor" maxlength="10" placeholder="" style="max-width: 50px" name="seo[title][separator]" value="<?php echo $this->seo_options['title']['separator'];?>">
                                        <p class="description-element"><?php _e('If the title consists of two parts (original title and optional addition), then the separator will go in between them.',self::LANG);?></p>

                                    </div>

                                </div><!-- /.md-row-element -->

                                <div class="md-row-element">
                                    <div class="form-elements">
                                        <input id="show-page" class="input-checkbox" type="checkbox" name="seo[title][page]" value="1" <?php checked($this->seo_options['title']['page'],1);?>>
                                        <label class="label-checkbox" for="show-page"><?php _e('Show page on <code>&lt;title&gt;</code>?  ',self::LANG);?></label>

                                    </div><!-- checkbox inline -->
                                </div><!-- /.md-row-element -->

                            </div><!-- /.md-tabcontent-row -->


                        </div>

                        <div id="docheader">
                            <div class="md-tabcontent-header">
                                <h3 class="md-tabcontent-title"><?php _e('Remove Head Meta',self::LANG);?></h3>
                                <p class="md-tabcontent-description"><?php _e('By default, WordPress places several tags in your document <code>&lt;head&gt;</code>. Most of these tags are completely unnecessary, and provide no SEO value whatsoever; they just make your site slower to load. Choose which tags you would like included in your document <code>&lt;head&gt;</code>. If you do not know what something is, leave it unchecked.',self::LANG);?></p>
                            </div><!-- /.md-tabcontent-header -->

                         
                            <div class="md-tabcontent-row">
                                <div class="md-row-element">
                                    <div class="form-elements">
                                        <input id="remove-generator" class="input-checkbox" type="checkbox" name="seo[head][remove-generator]" value="1" <?php checked($this->seo_options['head']['remove-generator'],1);?>>
                                        <label class="label-checkbox" for="remove-generator"><?php _e('Meta Generator',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="canonical-redirect" class="input-checkbox" type="checkbox" name="seo[head][canonical-redirect]" value="1" <?php checked($this->seo_options['head']['canonical-redirect'],1);?>>
                                        <label class="label-checkbox" for="canonical-redirect"><?php _e('Canonical Redirect',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="remove-wlwmanifest" class="input-checkbox" type="checkbox" name="seo[head][remove-wlwmanifest]" value="1" <?php checked($this->seo_options['head']['remove-wlwmanifest'],1);?>>
                                        <label class="label-checkbox" for="remove-wlwmanifest"><?php _e('Windows Live Writer Support',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="remove-rsd" class="input-checkbox" type="checkbox" name="seo[head][remove-rsd]" value="1" <?php checked($this->seo_options['head']['remove-rsd'],1);?>>
                                        <label class="label-checkbox" for="remove-rsd"><?php _e('RSD Link',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="remove-feed" class="input-checkbox" type="checkbox" name="seo[head][remove-feed]" value="1" <?php checked($this->seo_options['head']['remove-feed'],1);?>>
                                        <label class="label-checkbox" for="remove-feed"><?php _e('Feed Links',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="remove-feed-extra" class="input-checkbox" type="checkbox" name="seo[head][remove-feed-extra]" value="1" <?php checked($this->seo_options['head']['remove-feed-extra'],1);?>>
                                        <label class="label-checkbox" for="remove-feed-extra"><?php _e('Feed Links Extra',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="remove-shortlink" class="input-checkbox" type="checkbox" name="seo[head][remove-shortlink]" value="1" <?php checked($this->seo_options['head']['remove-shortlink'],1);?>>
                                        <label class="label-checkbox" for="remove-shortlink"><?php _e('ShortLink Tag',self::LANG);?></label>
                                        <p class="description-element"><?php _e('Note: The shortlink tag might have some use for 3rd party service discoverability, but it has no SEO value whatsoever.',self::LANG);?></p>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="remove-index-rel" class="input-checkbox" type="checkbox" name="seo[head][remove-index-rel]" value="1" <?php checked($this->seo_options['head']['remove-index-rel'],1);?>>
                                        <label class="label-checkbox" for="remove-index-rel"><?php _e('Relationship Link Tags',self::LANG);?></label>
                                        <p class="description-element"><?php _e('Adjacent Posts <code>&lt;rel&gt;</code> link tags',self::LANG);?></p>
                                    </div><!-- checkbox default -->
                                    <div class="form-elements">
                                        <input id="remove-noindex" class="input-checkbox" type="checkbox" name="seo[head][remove-noindex]" value="1" <?php checked($this->seo_options['head']['remove-noindex'],1);?>>
                                        <label class="label-checkbox" for="remove-noindex"><?php _e('NoIndex',self::LANG);?></label>
                                    </div><!-- checkbox default -->
                                </div><!-- /.md-row-element -->
                            </div><!-- /.md-tabcontent-row -->
                            
                        </div>
                        
                        <div id="robots">
                            <div class="md-tabcontent-header">
                                <h3 class="md-tabcontent-title"><?php _e('Robots Meta Settings',self::LANG);?></h3>
                            </div><!-- /.md-tabcontent-header -->

                            <div class="md-tabcontent-row">

                                <div class="md-row-element">
                                    <p><?php _e('Depending on your situation, you may or may not want the following archive pages to be indexed by search engines. Only you can make that determination.',self::LANG);?></p>
                                    <div class="form-elements">
                                        <input id="ni-cat" class="input-checkbox" type="checkbox" name="seo[robots][noindex][category]" value="1" <?php checked($this->seo_options['robots']['noindex']['category'],1);?>>
                                        <label class="label-checkbox" for="ni-cat"><?php _e('Apply <code>&lt;noindex&gt;</code> to Category Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="ni-tag" class="input-checkbox" type="checkbox" name="seo[robots][noindex][tag]" value="1" <?php checked($this->seo_options['robots']['noindex']['tag'],1);?>>
                                        <label class="label-checkbox" for="ni-tag"><?php _e('Apply <code>&lt;noindex&gt;</code> to Tag Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="ni-author" class="input-checkbox" type="checkbox" name="seo[robots][noindex][author]" value="1" <?php checked($this->seo_options['robots']['noindex']['author'],1);?>>
                                        <label class="label-checkbox" for="ni-author"><?php _e('Apply <code>&lt;noindex&gt;</code> to Author Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="ni-date" class="input-checkbox" type="checkbox" name="seo[robots][noindex][date]" value="1" <?php checked($this->seo_options['robots']['noindex']['date'],1);?>>
                                        <label class="label-checkbox" for="ni-date"><?php _e('Apply <code>&lt;noindex&gt;</code> to Date Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="ni-search" class="input-checkbox" type="checkbox" name="seo[robots][noindex][search]" value="1" <?php checked($this->seo_options['robots']['noindex']['search'],1);?>>
                                        <label class="label-checkbox" for="ni-search"><?php _e('Apply <code>&lt;noindex&gt;</code> to Search Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->
                                </div>
                            </div>
                            <div class="md-tabcontent-row">
                                <div class="md-row-element">
                                    <p><?php _e('Some search engines will cache pages in your site (e.g. Google Cache). The <code>&lt;noarchive&gt;</code> tag will prevent them from doing so. Choose which archives you want <code>&lt;noarchive&gt;</code> applied to.',self::LANG);?></p>
                                    <div class="form-elements">
                                        <input id="na-entire" class="input-checkbox" type="checkbox" name="seo[robots][noarchive][entire]" value="1" <?php checked($this->seo_options['robots']['noarchive']['entire'],1);?>>
                                        <label class="label-checkbox" for="na-entire"><?php _e('Apply <code>&lt;noarchive&gt;</code> to Entire Site?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="na-cat" class="input-checkbox" type="checkbox" name="seo[robots][noarchive][category]" value="1" <?php checked($this->seo_options['robots']['noarchive']['category'],1);?>>
                                        <label class="label-checkbox" for="na-cat"><?php _e('Apply <code>&lt;noarchive&gt;</code> to Category Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="na-tag" class="input-checkbox" type="checkbox" name="seo[robots][noarchive][tag]" value="1" <?php checked($this->seo_options['robots']['noarchive']['tag'],1);?>>
                                        <label class="label-checkbox" for="na-tag"><?php _e('Apply <code>&lt;noarchive&gt;</code> to Category Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="na-author" class="input-checkbox" type="checkbox" name="seo[robots][noarchive][author]" value="1" <?php checked($this->seo_options['robots']['noarchive']['author'],1);?>>
                                        <label class="label-checkbox" for="na-author"><?php _e('Apply <code>&lt;noarchive&gt;</code> to Author Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="na-date" class="input-checkbox" type="checkbox" name="seo[robots][noarchive][date]" value="1" <?php checked($this->seo_options['robots']['noarchive']['date'],1);?>>
                                        <label class="label-checkbox" for="na-date"><?php _e('Apply <code>&lt;noarchive&gt;</code> to Date Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="na-search" class="input-checkbox" type="checkbox" name="seo[robots][noarchive][search]" value="1" <?php checked($this->seo_options['robots']['noarchive']['search'],1);?>>
                                        <label class="label-checkbox" for="na-search"><?php _e('Apply <code>&lt;noarchive&gt;</code> to Search Archives?',self::LANG);?></label>
                                    </div><!-- checkbox default -->
                                </div>
                            </div>

                            <div class="md-tabcontent-row">
                                <div class="md-row-element">
                                    <p><?php _e('Occasionally, search engines use resources like the Open Directory Project and the Yahoo! Directory to find titles and descriptions for your content. Generally, you will not want them to do this. The <code>&lt;noodp&gt;</code> and <code>&lt;noydir&gt;</code> tags prevent them from doing so.',self::LANG);?></p>
                                    <div class="form-elements">
                                        <input id="noodp" class="input-checkbox" type="checkbox" name="seo[robots][noodp]" value="1" <?php checked($this->seo_options['robots']['noodp'],1);?>>
                                        <label class="label-checkbox" for="noodp"><?php _e('Apply <code>&lt;noodp&gt;</code> to your Site?',self::LANG);?></label>
                                    </div><!-- checkbox default -->

                                    <div class="form-elements">
                                        <input id="noydir" class="input-checkbox" type="checkbox" name="seo[robots][noydir]" value="1" <?php checked($this->seo_options['robots']['noydir'],1);?>>
                                        <label class="label-checkbox" for="noydir"><?php _e('Apply <code>&lt;noydir&gt;</code> to your Site?',self::LANG);?></label>
                                    </div><!-- checkbox default -->
                                </div>
                            </div>

                        </div>
                        <div id="archives">
                            <div class="md-tabcontent-header">
                                <h3 class="md-tabcontent-title"><?php _e('Archives Settings',self::LANG);?></h3>
                                <p class="md-tabcontent-description"><?php _e('Display or not additional attributes to archives pages( category, author, tag, taxonomy)',self::LANG);?></p>
                            </div><!-- /.md-tabcontent-header -->
                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Display Headline & Introduction:',self::LANG);?></h4>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <div class="form-elements inline">
                                        <input id="dl-category" class="input-checkbox" type="checkbox" name="seo[archives][dl-category]" value="1" <?php checked($this->seo_options['archives']['dl-category'],1);?>>
                                        <label class="label-checkbox" for="dl-category"><?php _e('Category',self::LANG);?></label>
                                        <input id="dl-tag" class="input-checkbox" type="checkbox" name="seo[archives][dl-tag]" value="1" <?php checked($this->seo_options['archives']['dl-tag'],1);?>>
                                        <label class="label-checkbox" for="dl-tag"><?php _e('Tag',self::LANG);?></label>
                                        <input id="dl-author" class="input-checkbox" type="checkbox" name="seo[archives][dl-author]" value="1" <?php checked($this->seo_options['archives']['dl-author'],1);?>>
                                        <label class="label-checkbox" for="dl-author"><?php _e('Author',self::LANG);?></label>
                                        <input id="dl-taxonomy" class="input-checkbox" type="checkbox" name="seo[archives][dl-taxonomy]" value="1" <?php checked($this->seo_options['archives']['dl-taxonomy'],1);?>>
                                        <label class="label-checkbox" for="dl-taxonomy"><?php _e('Taxonomy',self::LANG);?></label>
                                    </div><!-- checkbox default -->
                                </div>
                            </div>
                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Headline:',self::LANG);?></h4>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <div class="form-elements">
                                        <input id="ar-title" class="input-checkbox" type="checkbox" name="seo[archives][headline]" value="1" <?php checked($this->seo_options['archives']['headline'],1);?>>
                                        <label class="label-checkbox" for="ar-title"><?php _e('If blank,Set term name is headline?',self::LANG);?></label>
                                    </div><!-- checkbox default -->
                                </div>
                            </div>
                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Introduction:',self::LANG);?></h4>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <div class="form-elements">
                                        <input id="ar-description" class="input-checkbox" type="checkbox" name="seo[archives][introduction]" value="1" <?php checked($this->seo_options['archives']['introduction'],1);?>>
                                        <label class="label-checkbox" for="ar-description"><?php _e('If blank,Set description is introduction?',self::LANG);?></label>
                                    </div><!-- checkbox default -->
                                </div>
                            </div>
                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Canonical:',self::LANG);?></h4>
                                    <p class="description-element"><?php _e('rel="canonical" meta tag',self::LANG);?></p>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <p><?php _e('This option points search engines to the first page of an archive, if viewing a paginated page. If you do not know what this means, leave it on.',self::LANG);?></p>
                                    <div class="form-elements">
                                        <input id="ar-canonical" class="input-checkbox" type="checkbox" name="seo[archives][canonical]" value="1" <?php checked($this->seo_options['archives']['canonical'],1);?>>
                                        <label class="label-checkbox" for="ar-canonical"><?php _e('Canonical Paginated Archives',self::LANG);?></label>
                                    </div><!-- checkbox default -->
                                </div>
                            </div><!-- /.md-tabcontent-row -->
                        </div>

                        <div id="sitemap">
                            <div class="md-tabcontent-header">
                                <h3 class="md-tabcontent-title"><?php _e('Sitemap Settings',self::LANG);?></h3>
                            </div><!-- /.md-tabcontent-header -->

                            <div class="md-tabcontent-row">

                            </div><!-- /.md-tabcontent-row -->
                        </div>

                        <div id="ggauthorship">
                            <div class="md-tabcontent-header">
                                <h3 class="md-tabcontent-title"><?php _e('Google+',self::LANG);?></h3>
                            </div><!-- /.md-tabcontent-header -->

                            <div class="md-tabcontent-row">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Publisher URL:',self::LANG);?></h4>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <!-- /////////////////// INPUT FORM ///////////////// -->
                                    <div class="form-elements">
                                        <input type="text" class="input-bgcolor image-url" placeholder="" name="seo[google-authorship]" value="<?php echo $this->seo_options['google-authorship'];?>">
                                        <p class="description-element"><?php _e('Your company\'s Google+ Profile URL. Must be a business, not a personal account.',self::LANG);?></p>

                                    </div>
                                </div><!-- /.md-row-element -->
                            </div><!-- /.md-tabcontent-row -->
                        </div>
                    </div><!-- /.md-content-main -->
                </div><!-- /.md-options -->

                <div id="md-very" class="md-tabcontent clearfix">
                    <div class="md-content-main">

                        <div class="md-tabcontent-row">
                            <div class="md-row-description">
                                <h4 class="md-row-title"><?php _e('Google Site Verification',self::LANG);?></h4>
                            </div><!-- /.md-row-description -->
                            <div class="md-row-element">
                                <div class="form-elements">
                                    <input type="text" class="input-bgcolor" placeholder="" name="seo[site-very][google]" value="<?php echo $this->seo_options['site-very']['google'];?>">
                                    <p class="description-element"><?php _e('For optimal search engine performance, we recommend verifying your site with <a target="_blank" href="https://www.google.com/webmasters/tools/">Google Webmaster Tools</a>. Copy and paste the entire Google verification <code>&lt;meta&gt;</code> tag or just the unique <code>content=""</code> value into this field.',self::LANG);?></p>
                                </div><!-- checkbox default -->
                            </div><!-- /.md-row-element -->
                        </div>
                        <div class="md-tabcontent-row">
                            <div class="md-row-description">
                                <h4 class="md-row-title"><?php _e('Bing Site Verification',self::LANG);?></h4>
                            </div><!-- /.md-row-description -->
                            <div class="md-row-element">
                                <div class="form-elements">
                                    <input type="text" class="input-bgcolor" placeholder="" name="seo[site-very][bing]" value="<?php echo $this->seo_options['site-very']['bing'];?>">
                                    <p class="description-element"><?php _e('For optimal search engine performance, we recommend verifying your site with <a target="_blank" href="https://www.google.com/webmasters/tools/">Google Webmaster Tools</a>. Copy and paste the entire Google verification <code>&lt;meta&gt;</code> tag or just the unique <code>content=""</code> value into this field.',self::LANG);?></p>
                                </div><!-- checkbox default -->
                            </div><!-- /.md-row-element -->

                        </div><!-- /.md-tabcontent-row -->
                    </div>
                </div>




            </div><!-- /.md-content-framewp -->
        </div><!-- /#md-framewp-body -->

        <div id="md-framewp-footer" class="md-framewp-footer">
            <div class="footer-right">
                <div class="md-button-group">
                    <input type="submit" value="Reset" name="reset-seo" class="btn btn-reset">
                    <input type="submit" value="Save" name="save-seo" class="btn btn-save">
                </div>
            </div>
            <div class="footer-left">
                <p class="md-copyright">Designed and Developed by <a href="http://awethemes.com/">AweThemes</a></p>
            </div>
        </div><!-- /#md-framewp-footer -->

    </div><!-- /.md-framewp -->
</form>
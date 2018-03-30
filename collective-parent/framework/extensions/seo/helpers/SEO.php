<?php if (!defined('TFUSE')) exit('Direct access forbidden.');


class TF_SEO_SitemapGeneratorXmlEntry {

    var $_xml;

    function TF_SEO_SitemapGeneratorXmlEntry($xml) {
        $this->_xml = $xml;
    }

    function Render() {
        return $this->_xml;
    }

}

/**
 * Represents an item in the page list
 */
class TF_SEO_SitemapGeneratorPage {

    /**
     * @var string $_url Sets the URL or the relative path to the blog dir of the page
     * @access private
     */
    var $_url;

    /**
     * @var float $_priority Sets the priority of this page
     * @access private
     */
    var $_priority;

    /**
     * @var string $_changeFreq Sets the chanfe frequency of the page. I want Enums!
     * @access private
     */
    var $_changeFreq;

    /**
     * @var int $_lastMod Sets the lastMod date as a UNIX timestamp.
     * @access private
     */
    var $_lastMod;

    /**
     * Initialize a new page object
     *
     * @param bool $enabled Should this page be included in thesitemap
     * @param string $url The URL or path of the file
     * @param float $priority The Priority of the page 0.0 to 1.0
     * @param string $changeFreq The change frequency like daily, hourly, weekly
     * @param int $lastMod The last mod date as a unix timestamp
     */
    function TF_SEO_SitemapGeneratorPage($url = "", $priority = 0.0, $changeFreq = "never", $lastMod = 0) {
        $this->SetUrl($url);
        $this->SetProprity($priority);
        $this->SetChangeFreq($changeFreq);
        $this->SetLastMod($lastMod);
    }

    /**
     * Returns the URL of the page
     *
     * @return string The URL
     */
    function GetUrl() {
        return $this->_url;
    }

    /**
     * Sets the URL of the page
     *
     * @param string $url The new URL
     */
    function SetUrl($url) {
        $this->_url = (string) $url;
    }

    /**
     * Returns the priority of this page
     *
     * @return float the priority, from 0.0 to 1.0
     */
    function GetPriority() {
        return $this->_priority;
    }

    /**
     * Sets the priority of the page
     *
     * @param float $priority The new priority from 0.1 to 1.0
     */
    function SetProprity($priority) {
        $this->_priority = floatval($priority);
    }

    /**
     * Returns the change frequency of the page
     *
     * @return string The change frequncy like hourly, weekly, monthly etc.
     */
    function GetChangeFreq() {
        return $this->_changeFreq;
    }

    /**
     * Sets the change frequency of the page
     *
     * @param string $changeFreq The new change frequency
     */
    function SetChangeFreq($changeFreq) {
        $this->_changeFreq = (string) $changeFreq;
    }

    /**
     * Returns the last mod of the page
     *
     * @return int The lastmod value in seconds
     */
    function GetLastMod() {
        return $this->_lastMod;
    }

    /**
     * Sets the last mod of the page
     *
     * @param int $lastMod The lastmod of the page
     */
    function SetLastMod($lastMod) {
        $this->_lastMod = intval($lastMod);
    }

    function Render() {

        if ($this->_url == "/" || empty($this->_url))
            return '';

        $r = "";
        $r.= "\t<url>\n";
        $r.= "\t\t<loc>" . $this->EscapeXML($this->_url) . "</loc>\n";
        if ($this->_lastMod > 0)
            $r.= "\t\t<lastmod>" . date('Y-m-d\TH:i:s+00:00', $this->_lastMod) . "</lastmod>\n";
        if (!empty($this->_changeFreq))
            $r.= "\t\t<changefreq>" . $this->_changeFreq . "</changefreq>\n";
        if ($this->_priority !== false && $this->_priority !== "")
            $r.= "\t\t<priority>" . number_format($this->_priority, 1) . "</priority>\n";
        $r.= "\t</url>\n";
        return $r;
    }

    function EscapeXML($string) {
        return str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'), $string);
    }

}

$tf_seo_sitemap = new TF_SEO_SITEMAP();

class TF_SEO_SITEMAP {

    private static $_initialized = false;

    /**
     * @var bool Defines if the sitemap building process has been scheduled via Wp cron
     */
    var $_isScheduled = false;

    /**
     * @var int The last handled post ID
     */
    var $_lastPostID = 0;

    /**
     * @var bool Defines if the sitemap building process is active at the moment
     */
    var $_isActive = false;

    /**
     * @var object The file handle which is used to write the sitemap file
     */
    var $_fileHandle = null;

    /**
     * @var object The file handle which is used to write the zipped sitemap file
     */
    var $_fileZipHandle = null;

    public function __construct() {

        if (self::$_initialized !== false) {
            return;
        }

        if (tfuse_options('seo_xmls_enabled', false)) {
            //Existing posts was deleted
            add_action('delete_post', array($this, 'CallCheckForAutoBuild'), 9999, 1);

            //Existing post was published
            add_action('publish_post', array($this, 'CallCheckForAutoBuild'), 9999, 1);

            //Existing page was published
            add_action('publish_page', array($this, 'CallCheckForAutoBuild'), 9999, 1);

            //WP Cron hook
            add_action('sm_build_cron', array($this, 'CallBuildSitemap'), 1, 0);

            //External build hook
            add_action('sm_rebuild', array($this, 'CallBuildNowRequest'), 1, 0);
        }

        self::$_initialized = true;
    }

    /**
     * Invokes the CheckForAutoBuild method of the generator
     */
    function CallCheckForAutoBuild($args) {
        $this->CheckForAutoBuild($args);
    }

    /**
     * Checks if sitemap building after content changed is enabled and rebuild the sitemap
     *
     * @param int $postID The ID of the post to handle. Used to avoid double rebuilding if more than one hook was fired.
     */
    function CheckForAutoBuild($postID) {
        global $wp_version;
        global $TFUSE;

        //Build one time per post and if not importing.
        if (($this->_lastPostID != $postID) && (!defined('WP_IMPORTING') || WP_IMPORTING != true)) {

            //Build the sitemap directly or schedule it with WP cron
            if (floatval($wp_version) >= 2.1) {
                if (!$this->_isScheduled) {
                    //Schedule in 15 seconds, this should be enough to catch all changes.
                    //Clear all other existing hooks, so the sitemap is only built once.
                    wp_clear_scheduled_hook('sm_build_cron');
                    wp_schedule_single_event(time() + 15, 'sm_build_cron');
                    $this->_isScheduled = true;
                }
            } else {
                //Build sitemap only once and never in bulk mode
                if (!$this->_lastPostID && (!$TFUSE->request->isset_GET("delete") || count((array)$TFUSE->request->GET('delete')) <= 0)) {
                    $this->BuildSitemap();
                }
            }
            $this->_lastPostID = $postID;
        }
    }

    /**
     * Invokes the BuildSitemap method of the generator
     */
    function CallBuildSitemap() {
        $this->BuildSitemap();
    }

    /**
     * Invokes the CheckForAutoBuild method of the generator
     */
    function CallBuildNowRequest() {
        $this->CheckForAutoBuild(null);
    }

    /**
     * Returns the path to the blog directory
     *
     * @return string The full path to the blog directory
     */
    function GetHomePath() {

        $res = "";
        //Check if we are in the admin area -> get_home_path() is avaiable
        if (function_exists("get_home_path")) {
            $res = get_home_path();
        } else {
            //get_home_path() is not available, but we can't include the admin
            //libraries because many plugins check for the "check_admin_referer"
            //function to detect if you are on an admin page. So we have to copy
            //the get_home_path function in our own...
            $home = home_url();
            if ($home != '' && $home != get_option('url')) {
                $home_path = parse_url($home);
                $home_path = $home_path['path'];
                $root = str_replace($_SERVER["PHP_SELF"], '', $_SERVER["SCRIPT_FILENAME"]);
                $home_path = trailingslashit($root . $home_path);
            } else {
                $home_path = ABSPATH;
            }

            $res = $home_path;
        }
        return $res;
    }

    /**
     * Returns the file system path to the sitemap file
     *
     * @return The file system path;
     */
    function GetXmlPath() {
        return $this->GetHomePath() . 'sitemap.xml';
    }

    /**
     * Returns the URL for the sitemap file
     *
     * @return The URL to the Sitemap file
     */
    function GetXmlUrl($forceAuto = false) {

        return trailingslashit(home_url()) . 'sitemap.xml';
    }

    var $_usedXml = false;
    var $_xmlSuccess = false;
    var $_xmlPath = '';
    var $_xmlUrl = '';

    function StartXml($path, $url) {
        $this->_usedXml = true;
        $this->_xmlPath = $path;
        $this->_xmlUrl = $url;
    }

    function EndXml($success) {
        $this->_xmlSuccess = $success;
    }

    /**
     * Checks if a file is writable and tries to make it if not.
     *
     * @return bool true if writable
     */
    function IsFileWritable($filename) {
        //can we write?
        if (!is_writable($filename)) {
            //no we can't.
            if (!@chmod($filename, 0666)) {
                $pathtofilename = dirname($filename);
                //Lets check if parent directory is writable.
                if (!is_writable($pathtofilename)) {
                    //it's not writeable too.
                    if (!@chmod($pathtofilename, 0666)) {
                        //darn couldn't fix up parrent directory this hosting is foobar.
                        //Lets error because of the permissions problems.
                        return false;
                    }
                }
            }
        }
        //we can write, return 1/true/happy dance.
        return true;
    }

    /**
     * Returns if the compressed sitemap was activated
     *
     * @return true if compressed
     */
    function IsGzipEnabled() {
        return (function_exists("gzwrite"));
    }

    /**
     * Returns the file system path to the gzipped sitemap file
     *
     * @return The file system path;
     */
    function GetZipPath() {
        return $this->GetXmlPath() . ".gz";
    }

    /**
     * Returns the URL for the gzipped sitemap file
     *
     * @return The URL to the gzipped Sitemap file
     */
    function GetZipUrl() {
        return $this->GetXmlUrl() . ".gz";
    }

    var $_usedZip = false;
    var $_zipSuccess = false;
    var $_zipPath = '';
    var $_zipUrl = '';

    function StartZip($path, $url) {
        $this->_usedZip = true;
        $this->_zipPath = $path;
        $this->_zipUrl = $url;
    }

    function EndZip($success) {
        $this->_zipSuccess = $success;
    }

    /**
     * Adds an element to the sitemap
     *
     * @param $page The element
     */
    function AddElement($page) {
        if (empty($page))
            return;

        $s = $page->Render();

        if ($this->_fileZipHandle && $this->IsGzipEnabled()) {
            gzwrite($this->_fileZipHandle, $s);
        }

        if ($this->_fileHandle) {
            fwrite($this->_fileHandle, $s);
        }
    }

    /**
     * Adds a url to the sitemap. You can use this method or call AddElement directly.
     *
     * @param $loc string The location (url) of the page
     * @param $lastMod int The last Modification time as a UNIX timestamp
     * @param $changeFreq string The change frequenty of the page, Valid values are "always", "hourly", "daily", "weekly", "monthly", "yearly" and "never".
     * @param $priorty float The priority of the page, between 0.0 and 1.0
     * @see AddElement
     * @return string The URL node
     */
    function AddUrl($loc, $lastMod = 0, $changeFreq = "monthly", $priority = 0.5) {
        //Strip out the last modification time if activated
        // $lastMod = 0;
        $page = new TF_SEO_SitemapGeneratorPage($loc, $priority, $changeFreq, $lastMod);

        $this->AddElement($page);
    }

    /**
     * Converts a mysql datetime value into a unix timestamp
     * 
     * @param The value in the mysql datetime format
     * @return int The time in seconds
     */
    function GetTimestampFromMySql($mysqlDateTime) {
        list($date, $hours) = explode(' ', $mysqlDateTime);
        list($year, $month, $day) = explode('-', $date);
        list($hour, $min, $sec) = explode(':', $hours);
        return mktime(intval($hour), intval($min), intval($sec), intval($month), intval($day), intval($year));
    }

    /**
     * Returns the option value for the given key
     *
     * @param $key string The Configuration Key
     * @return mixed The value
     */
    function GetOption($key) {

        $config = array(
            'cf_home' => 'daily',
            'cf_posts' => 'monthly',
            'cf_pages' => 'weekly',
            'cf_cats' => 'weekly',
            'cf_arch_curr' => 'daily',
            'cf_arch_old' => 'yearly',
            'cf_tags' => 'weekly',
            'pr_home' => '1.0',
            'pr_posts' => '0.6',
            'pr_posts_min' => '0.2',
            'pr_pages' => '0.6',
            'pr_cats' => '0.3',
            'pr_arch' => '0.3',
            'pr_tags' => '0.3',
            'b_max_posts' => 49999,
        );

        if (array_key_exists($key, $config)) {
            return $config[$key];
        } else
            return null;
    }

    /**
     * Returns if this version of WordPress supports the new taxonomy system
     *
     * @return true if supported
     */
    function IsTaxonomySupported() {
        return (function_exists("get_taxonomy") && function_exists("get_terms"));
    }

    /**
     * Opens a remote file using the WordPress API or Snoopy
     * 
     * @param $url The URL to open
     * @param $method get or post
     * @param $postData An array with key=>value paris
     * @param $timeout Timeout for the request, by default 10
     * @return mixed False on error, the body of the response on success
     */
    function RemoteOpen($url, $method = 'get', $postData = null, $timeout = 10) {
        global $wp_version;

        //Before WP 2.7, wp_remote_fopen was quite crappy so Snoopy was favoured.
        if (floatval($wp_version) < 2.7) {
            if (!file_exists(ABSPATH . 'wp-includes/class-snoopy.php')) {
                trigger_error('Snoopy Web Request failed: Snoopy not found.', E_USER_NOTICE);
                return false; //Hoah?
            }

            require_once( ABSPATH . 'wp-includes/class-snoopy.php');

            $s = new Snoopy();

            $s->read_timeout = $timeout;

            if ($method == 'get') {
                $s->fetch($url);
            } else {
                $s->submit($url, $postData);
            }

            if ($s->status != "200") {
                trigger_error('Snoopy Web Request failed: Status: ' . $s->status . "; Content: " . htmlspecialchars($s->results), E_USER_NOTICE);
            }

            return $s->results;
        } else {

            $options = array();
            $options['timeout'] = $timeout;

            if ($method == 'get') {
                $response = wp_remote_get($url, $options);
            } else {
                $response = wp_remote_post($url, array_merge($options, array('body' => $postData)));
            }

            if (is_wp_error($response)) {
                $errs = $response->get_error_messages();
                $errs = htmlspecialchars(implode('; ', $errs));
                trigger_error('WP HTTP API Web Request failed: ' . $errs, E_USER_NOTICE);
                return false;
            }

            return $response['body'];
        }

        return false;
    }

    /**
     * Builds the sitemap and writes it into a xml file.
     *
     * @return array An array with messages such as failed writes etc.
     */
    function BuildSitemap() {
        global $wpdb, $posts, $wp_version;

        //Other plugins can detect if the building process is active
        $this->_isActive = true;

        if (true) {
            $fileName = $this->GetXmlPath();

            if ($this->IsFileWritable($fileName)) {

                $this->_fileHandle = fopen($fileName, "w");
            }
        }

        //Write gzipped sitemap file
        if ($this->IsGzipEnabled()) {
            $fileName = $this->GetZipPath();

            if ($this->IsFileWritable($fileName)) {

                $this->_fileZipHandle = gzopen($fileName, "w1");
            }
        }

        if (!$this->_fileHandle && !$this->_fileZipHandle) {
            return;
        }


        //Content of the XML file
        $this->AddElement(new TF_SEO_SitemapGeneratorXmlEntry('<?xml version="1.0" encoding="UTF-8"' . '?' . '>'));

        //All comments as an asso. Array (postID=>commentCount)
        $comments = array();

        //Full number of comments
        $commentCount = 0;

        //Go XML!
        $this->AddElement(new TF_SEO_SitemapGeneratorXmlEntry('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'));

        $home = home_url();

        $homePid = 0;

        //Add the home page (WITH a slash!)
        if (true) {
            if ('page' == get_option('show_on_front') && get_option('page_on_front')) {
                $pageOnFront = get_option('page_on_front');
                $p = get_page($pageOnFront);
                if ($p) {
                    $homePid = $p->ID;
                    $this->AddUrl(trailingslashit($home), $this->GetTimestampFromMySql(($p->post_modified_gmt && $p->post_modified_gmt != '0000-00-00 00:00:00' ? $p->post_modified_gmt : $p->post_date_gmt)), $this->GetOption("cf_home"), $this->GetOption("pr_home"));
                }
            } else {
                $this->AddUrl(trailingslashit($home), $this->GetTimestampFromMySql(get_lastpostmodified('GMT')), $this->GetOption("cf_home"), $this->GetOption("pr_home"));
            }
        }

        //Add the posts
        if (true) {

            $wpCompat = false;

            $excludes = ''; //Excluded posts and pages (user enetered ID)

            $exclCats = ''; // Excluded cats

            $sql = "SELECT `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_status`, `post_name`, `post_modified`, `post_modified_gmt`, `post_parent`, `post_type` FROM `" . $wpdb->posts . "` WHERE ";

            $where = '(';

            if (true) {
                $where.=" (post_status = 'publish' AND (post_type in (''";
                foreach (get_post_types() as $customType) {
                    if (!in_array($customType, array('revision', 'nav_menu_item', 'attachment'))) {
                        if (!tfuse_options('seo_xmls_exclude_posttype_' . $customType, false) && 'STOP!' != tfuse_options('seo_xmls_exclude_posttype_' . $customType, 'STOP!')) {
                            $where.= ",'$customType'";
                        }
                    }
                }
                $where .= "))) ";
            }

            $where.=") ";

            $where.=" AND post_password='' ORDER BY post_modified DESC";

            $sql .= $where;

            if ($this->GetOption("b_max_posts") > 0) {
                $sql.=" LIMIT 0," . $this->GetOption("b_max_posts");
            }

            $postCount = intval($wpdb->get_var( "SELECT COUNT(*) AS cnt FROM `" . $wpdb->posts . "` WHERE ". $where, 0, 0));

            //Create a new connection because we are using mysql_unbuffered_query and don't want to disturb the WP connection
            //Safe Mode for other plugins which use mysql_query() without a connection handler and will destroy our resultset :(
            $con = $postRes = null;

            if (true) {
                $postRes = mysql_query( $sql, $wpdb->dbh);
                if (!$postRes) {
                    trigger_error("MySQL query failed: " . mysql_error(), E_USER_NOTICE); //E_USER_NOTICE will be displayed on our debug mode
                    return;
                }
            }

            if ($postRes) {

                $prioProvider = NULL;

                $z = 1;
                $zz = 1;

                //Default priorities
                $default_prio_posts = $this->GetOption('pr_posts');
                $default_prio_pages = $this->GetOption('pr_pages');

                //Change frequencies
                $cf_pages = $this->GetOption('cf_pages');
                $cf_posts = $this->GetOption('cf_posts');

                $minPrio = $this->GetOption('pr_posts_min');


                //Cycle through all posts and add them
                while ($post = mysql_fetch_object($postRes)) {

                    //Fill the cache with our DB result. Since it's incomplete (no text-content for example), we will clean it later.
                    $cache = array(&$post);
                    update_post_cache($cache);

                    //Set the current working post for other plugins which depend on "the loop"
                    $GLOBALS['post'] = &$post;

                    $permalink = get_permalink($post->ID);
                    if ($permalink != $home && $post->ID != $homePid) {

                        $isPage = false;
                        if ($wpCompat) {
                            $isPage = ($post->post_status == 'static');
                        } else {
                            $isPage = ($post->post_type == 'page');
                        }


                        //Default Priority if auto calc is disabled
                        $prio = 0;

                        if ($isPage) {
                            //Priority for static pages
                            $prio = $default_prio_pages;
                        } else {
                            //Priority for normal posts
                            $prio = $default_prio_posts;
                        }

                        if (!$isPage && $minPrio > 0 && $prio < $minPrio) {
                            $prio = $minPrio;
                        }

                        //Add it
                        $this->AddUrl($permalink, $this->GetTimestampFromMySql(($post->post_modified_gmt && $post->post_modified_gmt != '0000-00-00 00:00:00' ? $post->post_modified_gmt : $post->post_date_gmt)), ($isPage ? $cf_pages : $cf_posts), $prio);

                        if (false) {
                            $subPage = '';
                            for ($p = 1; $p <= $post->postPages; $p++) {
                                if (get_option('permalink_structure') == '') {
                                    $subPage = $permalink . '&amp;paged=' . ($p + 1);
                                } else {
                                    $subPage = trailingslashit($permalink) . user_trailingslashit($p + 1, 'single_paged');
                                }

                                $this->AddUrl($subPage, $this->GetTimestampFromMySql(($post->post_modified_gmt && $post->post_modified_gmt != '0000-00-00 00:00:00' ? $post->post_modified_gmt : $post->post_date_gmt)), ($isPage ? $cf_pages : $cf_posts), $prio);
                            }
                        }
                    }

                    //Update the status every 100 posts and at the end.
                    //If the script breaks because of memory or time limit,
                    //we have a "last reponded" value which can be compared to the server settings
                    if ($zz == 100 || $z == $postCount) {
                        $zz = 0;
                    } else
                        $zz++;

                    $z++;

                    //Clean cache because it's incomplete
                    if (version_compare($wp_version, "2.5", ">=")) {
                        //WP 2.5 makes a mysql query for every clean_post_cache to clear the child cache
                        //so I've copied the function here until a patch arrives...
                        wp_cache_delete($post->ID, 'posts');
                        wp_cache_delete($post->ID, 'post_meta');
                        clean_object_term_cache($post->ID, 'post');
                    } else {
                        clean_post_cache($post->ID);
                    }
                }
                unset($postRes);
                unset($prioProvider);
            }
        }

        //Add custom taxonomy pages
        if (true) {

            $taxList = array();

            foreach (get_taxonomies() as $taxName) {
                if (!in_array($taxName, array('nav_menu', 'link_category', 'post_format'))) {

                    $taxonomy = get_taxonomy($taxName);

                    if (isset($taxonomy->labels->name) && trim($taxonomy->labels->name) != '') {
                        if (!tfuse_options('seo_xmls_exclude_taxonomy_' . $taxName, false) && 'STOP!' != tfuse_options('seo_xmls_exclude_taxonomy_' . $taxName, 'STOP!')) {
                            if ($taxonomy)
                                $taxList[] = $wpdb->escape($taxonomy->name);
                        }
                    }
                }
            }

            if (count($taxList) > 0) {
                //We're selecting all term information (t.*) plus some additional fields
                //like the last mod date and the taxonomy name, so WP doesnt need to make
                //additional queries to build the permalink structure.
                //This does NOT work for categories and tags yet, because WP uses get_category_link
                //and get_tag_link internally and that would cause one additional query per term!
                $sql = "
					SELECT
						t.*,
						tt.taxonomy AS _taxonomy,
						UNIX_TIMESTAMP(MAX(post_date_gmt)) as _mod_date
					FROM
						{$wpdb->posts} p ,
						{$wpdb->term_relationships} r,
						{$wpdb->terms} t,
						{$wpdb->term_taxonomy} tt
					WHERE
						p.ID = r.object_id
						AND p.post_status = 'publish'
						AND p.post_password = ''
						AND r.term_taxonomy_id = t.term_id
						AND t.term_id = tt.term_id
						AND tt.count > 0
						AND tt.taxonomy IN ('" . implode("','", $taxList) . "')
					GROUP BY 
						t.term_id";

                $termInfo = $wpdb->get_results( $sql );

                foreach ($termInfo AS $term) {
                    if (!in_array($term->_taxonomy, array('nav_menu', 'link_category', 'post_format'))) {
                        $this->AddUrl(get_term_link($term->slug, $term->_taxonomy), $term->_mod_date, $this->GetOption("cf_tags"), $this->GetOption("pr_tags"));
                    }
                }
            }
        }

        //Add the custom pages
        if ($this->_pages && is_array($this->_pages) && count($this->_pages) > 0) {
            //#type $page TF_SEO_SitemapGeneratorPage
            foreach ($this->_pages AS $page) {
                $this->AddUrl($page->GetUrl(), $page->getLastMod(), $page->getChangeFreq(), $page->getPriority());
            }
        }

        do_action('tf_seo_buildmap');

        $this->AddElement(new TF_SEO_SitemapGeneratorXmlEntry("</urlset>"));


        $pingUrl = '';

        if (true) {
            if ($this->_fileHandle && fclose($this->_fileHandle)) {
                $this->_fileHandle = null;
                $pingUrl = $this->GetXmlUrl();
            }
        }

        if ($this->IsGzipEnabled()) {
            if ($this->_fileZipHandle && fclose($this->_fileZipHandle)) {
                $this->_fileZipHandle = null;
                $pingUrl = $this->GetZipUrl();
            }
        }

        //Ping Google
        if (!empty($pingUrl)) {
            $sPingUrl = "http://www.google.com/webmasters/sitemaps/ping?sitemap=" . urlencode($pingUrl);
            $pingres = $this->RemoteOpen($sPingUrl);

            if ($pingres == NULL || $pingres === false) {
                trigger_error("Failed to ping Google: " . htmlspecialchars(strip_tags($pingres)), E_USER_NOTICE);
            }
        }

        //Ping Ask.com
        if (!empty($pingUrl)) {
            $sPingUrl = "http://submissions.ask.com/ping?sitemap=" . urlencode($pingUrl);
            $pingres = $this->RemoteOpen($sPingUrl);

            if ($pingres == NULL || $pingres === false || strpos($pingres, "successfully received and added") === false) { //Ask.com returns 200 OK even if there was an error, so we need to check the content.
                trigger_error("Failed to ping Ask.com: " . htmlspecialchars(strip_tags($pingres)), E_USER_NOTICE);
            }
        }

        //Ping Bing
        if (!empty($pingUrl)) {
            $sPingUrl = "http://www.bing.com/webmaster/ping.aspx?siteMap=" . urlencode($pingUrl);
            $pingres = $this->RemoteOpen($sPingUrl);
            //Bing returns ip/country-based success messages, so there is no way to check the content. Rely on HTTP 500 only then...
            if ($pingres == NULL || $pingres === false || strpos($pingres, " ") === false) {
                trigger_error("Failed to ping Bing: " . htmlspecialchars(strip_tags($pingres)), E_USER_NOTICE);
            }
        }


        $this->_isActive = false;

        //done...
        return;
    }

}

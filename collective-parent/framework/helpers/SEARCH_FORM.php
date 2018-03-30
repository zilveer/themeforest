<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

abstract class TFSearchFormBase
{
    protected static $sqlDataKeys = array(
        'SELECT',
        'FROM',
        'INNER JOIN',
        'LEFT JOIN',
        'RIGHT JOIN',
        'WHERE',
        'GROUP BY',
        'ORDER BY',
    );

    /**
     * array(
     *  'SELECT' => array('wp_posts.ID', 'wp_posts.post_date AS p_d')
     *  'FROM' => array('wp_posts')
     *  'INNER|LEFT|RIGHT JOIN' => array(
     *      'wp_postmeta' => 'wp_postmeta.post_id = wp_posts.ID'
     *  )
     *  'WHERE' => array(
     *      'AND' => array(
     *          'wp_posts.post_date > 2013', 'wp_posts.ID = 35',
     *          'whateverOptionalId' => array(
     *              'OR' => array(
     *                  'wp_posts.ID > 20', 'wp_posts.ID < 50',
     *              )
     *          )
     *      )
     *      'OR' => array('wp_posts.ID IN (23, 21)')
     *  )
     *  'GROUP BY' => 'wp_posts.ID'
     *  'ORDER BY' => array(
     *      'wp_posts.ID' => 'ASC',
     *      'wp_posts.post_date' => 'DESC'
     *  )
     * )
     */
    protected $sqlData = array();

    /**
     * @var array array(12, 7, 102)
     */
    protected $includedTermsId = array();
    protected $excludedTermsId = array();
    protected $includedPostsId = array();
    protected $excludedPostsId = array();

    final protected static function positiveInt($val)
    {
        $val = (int)$val;
        $val = $val > 0 ? $val : 1;

        return $val;
    }

    /**
     * Merge two sqlData arrays
     * Can be bad formatted or empty, this function will make verifications and return correct array
     *
     * @param $a1
     * @param $a2
     * @return array
     */
    final protected static function mergeSqlData($a1, $a2)
    {
        $result = array();

        foreach (self::$sqlDataKeys as $sqlKey) {
            $a1empty = empty($a1[$sqlKey]);
            $a2empty = empty($a2[$sqlKey]);

            {
                $defaultValue = array();

                if ($sqlKey == 'GROUP BY') {
                    $defaultValue = '';
                } elseif ($sqlKey == 'WHERE') {
                    $defaultValue = array(
                        'AND' => array(),
                        'OR' => array(),
                    );
                }
            }

            $a1value = $a1empty ? $defaultValue : $a1[$sqlKey];
            $a2value = $a2empty ? $defaultValue : $a2[$sqlKey];

            $sqlValue = $defaultValue;

            if (!$a1empty || !$a2empty) {
                switch ($sqlKey) {
                    case 'SELECT':
                    case 'FROM':
                    case 'ORDER BY':
                    case 'INNER JOIN':
                    case 'LEFT JOIN':
                    case 'RIGHT JOIN':
                        $sqlValue = array_merge(
                            $a1empty ? $defaultValue : $a1value,
                            $a2empty ? $defaultValue : $a2value
                        );
                        break;
                    case 'GROUP BY':
                        $sqlValue = $a2empty ? $a1value : $a2value;
                        break;
                    case 'WHERE':
                        $sqlValue = self::mergeSqlDataWhere($a1value, $a2value);
                        break;
                }
            }

            $result[$sqlKey] = $sqlValue;

            unset($sqlValue);
        }

        return $result;
    }

    private static function mergeSqlDataWhere($where1, $where2)
    {
        $result = array();

        foreach (array('AND', 'OR') as $operator) {
            $result[$operator] = array();

            $where1empty = empty($where1[$operator]);
            $where2empty = empty($where2[$operator]);

            if ($where1empty && $where2empty)
                continue;

            if (!empty($where1[$operator])) {
                // move everything from $where1 to result, and merge recursive sub arrays that exists in $where2
                foreach ($where1[$operator] as $key => $val) {
                    if (is_array($val)) {
                        if (!$where2empty && isset($where2[$operator][$key])) {
                            $result[$operator][$key] = self::mergeSqlDataWhere($where1[$operator][$key], $where2[$operator][$key]);

                            unset($where2[$operator][$key]);
                        } else {
                            $result[$operator][$key] = $where1[$operator][$key];
                        }
                    } else {
                        if (is_numeric($key))
                            $result[$operator][] = $val;
                        else
                            $result[$operator][$key] = $val;
                    }

                    unset($where1[$operator][$key]);
                }
            }

            if (!empty($where2[$operator])) {
                // move the rest from $where2 to result
                $result[$operator] = array_merge($result[$operator], $where2[$operator]);
            }
        }

        return $result;
    }

    final public static function sqlDataToSql($sqlData)
    {
        $sql = array();

        foreach (self::$sqlDataKeys as $sqlKey) {
            $sqlValue = isset($sqlData[$sqlKey]) ? $sqlData[$sqlKey] : array();

            switch ($sqlKey) {
                case 'SELECT':
                    if (empty($sqlValue)) {
                        if ($sqlKey == 'SELECT')
                            $sql[] = $sqlKey .' *';
                        else
                            ; // skip, do not include in sql
                    } else {
                        $sqlValue = array_unique($sqlValue);

                        $sql[] = $sqlKey .' '. implode(', ', $sqlValue);
                    }
                    break;
                case 'FROM':
                    if (empty($sqlValue))
                        break;

                    $sqlValue = array_unique($sqlValue);

                    $sql[] = $sqlKey .' '. implode(', ', $sqlValue);
                    break;
                case 'INNER JOIN':
                case 'LEFT JOIN':
                case 'RIGHT JOIN':
                    if (empty($sqlValue))
                        break;

                    foreach ($sqlValue as $tableName => $condition) {
                        $sql[] = $sqlKey .' '. $tableName .' ON '. $condition;
                    }
                    break;
                case 'GROUP BY':
                    if (empty($sqlValue))
                        break;

                    $sql[] = $sqlKey .' '. $sqlValue;
                    break;
                case 'WHERE':
                    if (empty($sqlValue))
                        break;

                    $sql[] = $sqlKey .' '. self::sqlDataToSqlWhere($sqlValue);
                    break;
                case 'ORDER BY':
                    if (empty($sqlValue))
                        break;

                    $_sql = array();
                    foreach ($sqlValue as $column => $type) {
                        $_sql[] = $column .' '. $type;
                    }

                    if (empty($_sql))
                        break;

                    $sql[] = $sqlKey .' '. implode(',', $_sql);
                    break;
            }
        }

        return implode(" \n", $sql);
    }

    private static function sqlDataToSqlWhere($where, $recursion = false)
    {
        $sql = '';

        foreach (array('AND', 'OR') as $operator) {
            if (empty($where[$operator]))
                continue;

            $_sql = array();
            foreach ($where[$operator] as $val) {
                if (is_array($val))
                    $_sql[] = self::sqlDataToSqlWhere($val, true);
                else
                    $_sql[] = $val;
            }

            if ($operator == 'OR' && !empty($sql))
                $sql .= ' OR ';

            $sql .= implode(" {$operator} ", array_unique($_sql));

            unset($_sql);
        }

        if (!empty($sql) && $recursion)
            return '('. $sql .')';
        else
            return $sql;
    }

    /**
     * @param $dotKey
     * @param $defaultValue
     * @return array|null
     */
    final public function getSqlData($dotKey = null, $defaultValue = array())
    {
        return ($dotKey === null ? $this->sqlData : tf_akg($dotKey, $this->sqlData, $defaultValue, '/'));
    }

    final public function setSqlData($dotKey = null, $value)
    {
        if ($dotKey === null)
            $this->sqlData = $value;
        else
            tf_aks($dotKey, $value, $this->sqlData, '/');
    }

    /**
     * @return array
     */
    final public function getIncludedTermsId()
    {
        return $this->includedTermsId;
    }

    final public function setIncludedTermsId(array $ids)
    {
        $this->includedTermsId = $ids;
    }

    /**
     * @return array
     */
    final public function getExcludedTermsId()
    {
        return $this->excludedTermsId;
    }

    final public function setExcludedTermsId(array $ids)
    {
        $this->excludedTermsId = $ids;
    }

    /**
     * @return array
     */
    final public function getIncludedPostsId()
    {
        return $this->includedPostsId;
    }

    final public function setIncludedPostsId(array $ids)
    {
        $this->includedPostsId = $ids;
    }

    /**
     * @return array
     */
    final public function getExcludedPostsId()
    {
        return $this->excludedPostsId;
    }

    final public function setExcludedPostsId(array $ids)
    {
        $this->excludedPostsId = $ids;
    }
}

class TFSearchForm extends TFSearchFormBase
{
    private static $ids = array();

    /**
     * Currently submitted form
     * @var TFSearchForm|null
     */
    private static $submittedForm;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $sql;

    /**
     * @var int
     */
    private $currentPage = 1;

    /**
     * @var int
     */
    private $totalPages;

    /**
     * @var int
     */
    private $postPerPage = 10;

    /**
     * @var int
     */
    private $totalPosts;

    /**
     * @var null|array
     */
    private $searchResults;

    /**
     * @var TFORM
     */
    private $tform;

    protected $filters = array();

    /**
     * Relative path to the view that will output html
     * @var string e.g. 'theme_config/custom_templates/form1.php'
     */
    protected $view;

    final protected function prepareSql()
    {
        if ($this->sql !== null) {
            /**
             * cannot prepare sql more than once
             * with earch new prepare, into the sqlData array will be made more and more pushes
             * so the sql can be different when prepared second and next times
             */
            return false;
        }

        /** @var wpdb $wpdb */
        global $wpdb;

        if (empty($this->filters)) {
            // merge with empty array, just to fix array strucutre
            $this->sqlData = self::mergeSqlData($this->sqlData, array());
        } else {
            /** @var TFSearchFormFilter $filter */
            foreach ($this->filters as $filter) {
                if (method_exists($this, 'hook_before_filterDataMerge')) {
                    // hook for child class
                    // here child class can extract other data from custom filters and merge into class data
                    $this->hook_before_filterDataMerge($filter);
                }

                $this->includedTermsId = array_merge($this->includedTermsId, $filter->getIncludedTermsId());
                $this->excludedTermsId = array_merge($this->excludedTermsId, $filter->getExcludedTermsId());
                $this->includedPostsId = array_merge($this->includedPostsId, $filter->getIncludedPostsId());
                $this->excludedPostsId = array_merge($this->excludedPostsId, $filter->getExcludedPostsId());

                $this->sqlData = self::mergeSqlData($this->sqlData, $filter->getSqlData());
            }
        }

        $this->includedTermsId = array_map('intval', array_unique($this->includedTermsId));
        $this->excludedTermsId = array_map('intval', array_unique($this->excludedTermsId));
        $this->includedPostsId = array_map('intval', array_unique($this->includedPostsId));
        $this->excludedPostsId = array_map('intval', array_unique($this->excludedPostsId));

        // create WHERE conditions from (included|excluded)(Terms|Posts)Id
        {
            // note: Do not forget to (INNER|LEFT|RIGHT)_JOIN wp_(posts|term_relationships) when using (included|excluded)(Terms|Posts)Id

            if (!empty($this->includedTermsId)) {
                $sqlField = $wpdb->term_taxonomy. '.term_id';

                $this->setSqlData('WHERE/AND/'. $sqlField,
                    sprintf("%s IN (%s)", $sqlField, implode(',', $this->includedTermsId))
                );
            }
            if (!empty($this->excludedTermsId)) {
                $sqlField = $wpdb->term_taxonomy. '.term_id';

                $this->setSqlData('WHERE/AND/'. $sqlField,
                    sprintf("%s NOT IN (%s)", $sqlField, implode(',', $this->excludedTermsId))
                );
            }

            if (!empty($this->includedPostsId)) {
                $sqlField = $wpdb->posts. '.ID';

                $this->setSqlData('WHERE/AND/'. $sqlField,
                    sprintf("%s IN (%s)", $sqlField, implode(',', $this->includedPostsId))
                );
            }
            if (!empty($this->excludedPostsId)) {
                $sqlField = $wpdb->posts. '.ID';

                $this->setSqlData('WHERE/AND/'. $sqlField,
                    sprintf("%s NOT IN (%s)", $sqlField, implode(',', $this->excludedPostsId))
                );
            }
        }

        if (method_exists($this, 'hook_filtersDataToSqlData')) {
            // hook for child class
            // here child class convert data from custom filters to class sqlData
            $this->hook_filtersDataToSqlData();
        }

        $this->sql = self::sqlDataToSql($this->sqlData);
        $this->sql .= " \nLIMIT ". (($this->currentPage - 1) * $this->postPerPage) .", ". $this->postPerPage;
    }

    final private function doSearch()
    {
        if ($this->searchDone())
            return false;

        if (method_exists($this, 'hook_before_doSearch')) {
            // hook for child class
            $this->hook_before_doSearch();
        }

        /** @var wpdb $wpdb */
        global $wpdb;

        $this->prepareSql();

        $this->searchResults = $wpdb->get_results($this->sql, ARRAY_A);

        return true;
    }

    public function __construct($id, $properties = array(), $sqlData = array())
    {
        if (isset(self::$ids[$id]))
            trigger_error(__CLASS__ .' with id='. $id .' already defined.', E_USER_ERROR);
        else
            self::$ids[$id] = true;

        $this->id = $id;

        // init properties
        {
            $initProperties = array(
                'view' => true // if required or not
            );

            foreach ($initProperties as $property => $required) {
                if (!isset($properties[$property])) {
                    if ($required)
                        trigger_error('Property "'. $property .'" is required', E_USER_ERROR);
                    else
                        continue;
                }

                $this->{$property} = $properties[$property];
            }
        }

        // init TFORM
        {
            $this->tform = new TFORM(array(
                'id' => $id,
                'html_attr' => array(
                    'method' => 'GET',
                    'action' => get_search_link('~'),
                )
            ));

            add_filter('TFORM__'. $this->tform->get_id() .'__render', array($this, '__tform_render'));

            if (self::$submittedForm === null) {
                if ($this->tform->is_submitted()) {
                    self::$submittedForm = $this;
                }
            }
        }

        /** @var wpdb $wpdb */
        global $wpdb;

        $this->sqlData = array_merge(
            // defaults
            array(
                'FROM' => array($wpdb->posts),
            ),
            $sqlData
        );

        if (method_exists($this, 'hook_after_construct')) {
            // hook for child class
            $this->hook_after_construct();
        }
    }

    public static function getSubmitted()
    {
        return self::$submittedForm;
    }

    final public function getId()
    {
        return $this->id;
    }

    final public function searchDone()
    {
        return $this->searchResults !== null;
    }

    final public function getCurrentPage()
    {
        return $this->currentPage;
    }

    final public function setCurrentPage($currentPage)
    {
        if ($this->searchDone())
            return false;

        $this->currentPage = self::positiveInt($currentPage);

        return true;
    }

    final public function getTotalPosts()
    {
        if ($this->totalPosts !== null)
            return $this->totalPosts;

        if (!$this->searchDone())
            return false;

        $sql = $this->getSqlData();

        $sql['SELECT'] = array('COUNT(1) AS totalPosts');

        unset($sql['ORDER BY']);

        $sql = self::sqlDataToSql($sql);
        $sql .= " \nLIMIT 0,1";

        /** @var wpdb $wpdb */
        global $wpdb;

        $result = $wpdb->get_results($sql, ARRAY_A);
        $result = array_shift($result);

        unset($sql);

        if (!$result) {
            $this->totalPosts = 0;
        } else {
            $this->totalPosts = (int)$result['totalPosts'];
        }

        return $this->totalPosts;
    }

    final public function getTotalPages()
    {
        if ($this->totalPages !== null)
            return $this->totalPages;

        if (!$this->searchDone())
            return false;

        $totalPosts = $this->getTotalPosts();

        if (!$totalPosts) {
            $this->totalPages = 0;
        } else {
            $this->totalPages = intval($totalPosts / $this->postPerPage);

            if ($totalPosts % $this->postPerPage){
                $this->totalPages++;
            }
        }

        return $this->totalPages;
    }

    final public function getPostsPerPage()
    {
        return $this->postPerPage;
    }

    final public function setPostsPerPage($postsPerPage)
    {
        if ($this->searchDone())
            return false;

        $this->postPerPage = self::positiveInt($postsPerPage);

        return true;
    }

    final public function printHtml()
    {
        $this->tform->render();
    }

    /** @private */
    final public function __tform_render($data)
    {
        /** @var TF_TFUSE $TFUSE */
        global $TFUSE;

        $TFUSE->load->tc_file($this->view, array(
            'form'  => $this,
        ));

        $data['submit']['html'] = ''; // do not print default tform submit button

        return $data;
    }

    final public function getSearchResults()
    {
        if (!$this->searchDone())
            $this->doSearch();

        return $this->searchResults;
    }

    final public function getSql()
    {
        $this->prepareSql();

        return $this->sql;
    }

    /**
     * @return TFORM
     */
    final public function getTFORM()
    {
        return $this->tform;
    }

    final public function addFilter(TFSearchFormFilter $filter)
    {
        $this->filters[$filter->getId()] = $filter;
    }

    final public function removeFilter($id)
    {
        unset($this->filters[$id]);
    }

    final public function hasFilter($id)
    {
        return isset($this->filters[$id]);
    }

    /**
     * @param string $id
     * @return TFSearchFormFilter
     */
    final public function getFilter($id)
    {
        return $this->filters[$id];
    }

    /**
     * @return array
     */
    final public function getFilters()
    {
        return $this->filters;
    }

    /**
     * If currently this form was submitted
     * @return bool
     */
    final public function isSubmitted()
    {
        return $this->tform->is_submitted();
    }
}

class TFSearchFormFilter extends TFSearchFormBase
{
    private static $ids = array();

    private $id;

    /**
     * Relative path to the view that will output html
     * @var string e.g. 'theme_config/custom_templates/form_filter1.php'
     */
    protected $view;

    /**
     * Used in html
     * @var string
     */
    protected $inputName;

    public function __construct($id, $properties = array())
    {
        if (isset(self::$ids[$id]))
            trigger_error(__CLASS__ .' with id='. $id .' already defined.', E_USER_ERROR);
        else
            self::$ids[$id] = true;

        $this->id = $id;

        // init properties
        {
            $initProperties = array(
                'view'      => true, // if required or not
                'inputName' => false,
            );

            foreach ($initProperties as $property => $required) {
                if (!isset($properties[$property])) {
                    if ($required)
                        trigger_error('Property "'. $property .'" is required', E_USER_ERROR);
                    else
                        continue;
                }

                $this->{$property} = (string)$properties[$property];
            }

            // set default values for not initialized
            {
                if ($this->inputName === null)
                    $this->inputName = $this->id;
            }
        }
    }

    final public function getId()
    {
        return $this->id;
    }

    final public function getInputName()
    {
        return $this->inputName;
    }

    final public function getInputValue()
    {
        /** @var TF_TFUSE $TFUSE */
        global $TFUSE;

        return $TFUSE->request->GET($this->inputName);
    }

    /**
     * @param TFSearchForm $form The form that currently prints this filter
     */
    final public function printHtml(TFSearchForm $form)
    {
        /** @var TF_TFUSE $TFUSE */
        global $TFUSE;

        $TFUSE->load->tc_file($this->view, array(
            'form'   => $form,
            'filter' => $this,
        ));
    }
}

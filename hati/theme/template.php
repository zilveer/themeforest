<?php
/**
 * Super lightweight Template Engine
 * 
 * @category  Template
 * @package   Template
 * @author    alaja <alaja.info>
 * @copyright 2011 The authors
 *
 * Usage:
 * <code>
 * $tpl = new ATemplate('/path/to/template');
 * $tpl->variable = 'some value';
 * echo $tpl->render();
 * </code>
 */

class ATemplate {

  protected $_templatePath;

  function __construct($tpl) {
    if ($tpl) $this->_templatePath = $tpl;
    else throw new Exception('Template path is required in constructor.');
  }

  protected function isGood($filePath) {
    return (file_exists($filePath) && is_readable($filePath));
  }

  function render() {
    
    if (!$this->isGood($this->_templatePath))
      throw new Exception($this->_templatePath . ' is a bad path.');

    // buffer output so we can return it instead of displaying.
    ob_start();
    
    // include the file
    include $this->_templatePath;

    // get the buffer, and return
    return ob_get_clean();
  }
}
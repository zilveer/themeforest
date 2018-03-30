<?php

require_once SG_TEMPLATEPATH . '/functions/sgpanel/options.php';
require_once SG_TEMPLATEPATH . '/functions/modules/metaboxes-list.php';

class SGP_Config {

	protected static $_ptt;
	protected static $_tpl;
	protected static $_pid;

	public static function init($pid, $ptt, $tpl)
	{
		self::$_pid = $pid;
		self::$_ptt = $ptt;
		self::$_tpl = $tpl;
	}
	
	public static function getTPL()
	{
		return self::$_ptt . '|' . self::$_tpl;
	}
	
	public static function getModule($module, $noinit = FALSE)
	{
		if (!$noinit AND !SG_Module::factory($module)->inited()) {
			$ml = sg_modules_list();
			$mb = isset($ml[self::$_ptt][self::$_tpl]) ? $ml[self::$_ptt][self::$_tpl] : array();
			$init = FALSE;
			
			foreach ($mb as $metabox => $opt) {
				if (isset($opt['modules'][$module])) {
					$mo = $opt['modules'][$module];
					$uniq = $opt['unique'];
					$params = (isset($mo['params']) AND !empty($mo['params'])) ? $mo['params'] : NULL;
					$defaults = (isset($mo['default']) AND !empty($mo['default'])) ? $mo['default'] : NULL;
					$ug = (isset($mo['global']) OR isset($ml['global'][$module]));
					$m_global = (isset($mo['global']) AND is_array($mo['global'])) ? $mo['global'] : array();
					$s_global = (isset($ml['global'][$module]) AND isset($ml['global'][$module]['default'])) ?
									$ml['global'][$module]['default'] : array();
					$global = array_merge($s_global, $m_global);
					$global = empty($global) ? ($ug ? TRUE : NULL) : $global;
					$params['_ptt'] = self::$_ptt;
					$params['_tpl'] = self::$_tpl;
					SG_Module::factory($module)->initVars('sg_' . $uniq, $params, $defaults, $global, self::$_pid);
					$init = TRUE;
					break;
				}
			}
			
			if (!$init) {
				if (isset($ml['global'][$module])) {
					$mo = $ml['global'][$module];
					$params = (isset($mo['params']) AND !empty($mo['params'])) ? $mo['params'] : NULL;
					$defaults = (isset($mo['default']) AND !empty($mo['default'])) ? $mo['default'] : NULL;
					SG_Module::factory($module)->initVars('sg_', $params, $defaults, NULL, NULL);
				}
			}
		}
		
		return SG_Module::factory($module);
	}
	
	public static function getGModule($module)
	{
		if (!SGP_Module::factory($module)->inited()) {
			$ml = sgp_options();
			foreach ($ml as $tab => $opt) {
				if (isset($opt['modules'][$module])) {
					$mo = $opt['modules'][$module];
					$params = (isset($mo['params']) AND !empty($mo['params'])) ? $mo['params'] : NULL;
					$defaults = (isset($mo['default']) AND !empty($mo['default'])) ? $mo['default'] : NULL;
					SGP_Module::factory($module)->initVars($params, $defaults);
				}
			}
		}
		
		return SGP_Module::factory($module);
	}

}
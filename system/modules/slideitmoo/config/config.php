<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2013 
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

$GLOBALS['TL_HOOKS']['parseBackendTemplate'][] = array('slideItHelper', 'checkExtensions');

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['slideIt'] = array(
    'slideItStart' => 'slideItStart',
    'slideItEnd'   => 'slideItEnd'
);

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['slideItMoo'] = 'slideItModule';
?>
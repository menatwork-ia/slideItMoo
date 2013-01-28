<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2013 
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_article']['config']['oncopy_callback'][] = array('slideItHelper', 'onArticleCopyCallback');

?>
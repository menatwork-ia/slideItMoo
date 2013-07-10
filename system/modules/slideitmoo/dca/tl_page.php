<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2013
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_page']['config']['oncopy_callback'][] = array('slideItHelper', 'onPageCopyCallback');
?>
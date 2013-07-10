<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2013
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Register the classes
 */
ClassLoader::addClasses(array
    (
    'slideItEnd'    => 'system/modules/slideitmoo/slideItEnd.php',
    'slideItModule' => 'system/modules/slideitmoo/slideItModule.php',
    'slideItMoo'    => 'system/modules/slideitmoo/slideItMoo.php',
    'slideItHelper' => 'system/modules/slideitmoo/slideItHelper.php',
    'slideItStart'  => 'system/modules/slideitmoo/slideItStart.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
    (
    'mod_slideItMoo'  => 'system/modules/slideitmoo/templates',
    'moo_slideItMoo'  => 'system/modules/slideitmoo/templates',
    'ce_slideItEnd'   => 'system/modules/slideitmoo/templates',
    'ce_slideItStart' => 'system/modules/slideitmoo/templates',
));

<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2013 
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['si_includeElements'] = array('Select elements', 'If javascript is deactivated, save your changes before changing the order.');
$GLOBALS['TL_LANG']['tl_module']['si_elements'] = array('Element', '');

$GLOBALS['TL_LANG']['tl_module']['si_itemsVisible'] = array('Number of items display', 'Please enter the number of visible items.');
$GLOBALS['TL_LANG']['tl_module']['si_elementsSlide'] = array('Number of items slided', 'Please enter the number of items to slide at once.');
$GLOBALS['TL_LANG']['tl_module']['si_itemsDimension'] = array('The height and width of an item', 'Value in px.');
$GLOBALS['TL_LANG']['tl_module']['si_itemsMargin'] = array('Element margin', 'Value in px.');
$GLOBALS['TL_LANG']['tl_module']['si_startIndex'] = array('Start index', 'Start the slideshow from a another position.');
$GLOBALS['TL_LANG']['tl_module']['si_duration'] = array('Effect duration', 'Value in milliseconds.');
$GLOBALS['TL_LANG']['tl_module']['si_autoEffectTransition'] = array('Extended Effects', 'Based on the mootools Fx.Transitions library');
$GLOBALS['TL_LANG']['tl_module']['si_effectTransition'] = array('Effect transition', 'See http://mootools.net/docs/core/Fx/Fx.Transitions for examples.');
$GLOBALS['TL_LANG']['tl_module']['si_effectEase'] = array('Ease', 'For a natural tweening.');
$GLOBALS['TL_LANG']['tl_module']['si_itemsSelector'] = array('Optional CSS class', 'Allows the user to enter an optional CSS class for the items in the slider.');
$GLOBALS['TL_LANG']['tl_content']['si_responsive'] = array('Activate responsive slider', 'Set the slider responsive with flexible width.');
$GLOBALS['TL_LANG']['tl_module']['si_elementDirection'] = array('Reverse element moves', 'Run the slideshow backwards.');
$GLOBALS['TL_LANG']['tl_module']['si_verticalSlide'] = array('Vertical slider', 'Run the slideshow vertically.');
$GLOBALS['TL_LANG']['tl_module']['si_autoSlideDefault'] = array('Set auto sliding on', 'The slideshow starts automatically.');
$GLOBALS['TL_LANG']['tl_module']['si_autoSlide'] = array('Rotation interval', 'Value in milliseconds.');
$GLOBALS['TL_LANG']['tl_module']['si_showControls'] = array('Display navigation', 'Allows the user to control the slideshow.');
$GLOBALS['TL_LANG']['tl_module']['si_mouseWheelNav'] = array('Activate mousewheel nav', 'Slideshow using the mousewheel navigation.');
$GLOBALS['TL_LANG']['tl_module']['si_templateDefault'] = array('Activate template', 'Apply the included standard skin.');
$GLOBALS['TL_LANG']['tl_module']['si_cssTemplate'] = array('CSS-Template', 'The design of the slideshow can be adjusted in the template.');
$GLOBALS['TL_LANG']['tl_module']['si_showBullets'] = array('Activate bullets', 'Check here to enable element positions.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['siInclude_legend']    = 'Include elements';
$GLOBALS['TL_LANG']['tl_module']['siGenerel_legend']    = 'General settings';
$GLOBALS['TL_LANG']['tl_module']['siDimensions_legend'] = 'Dimensions';
$GLOBALS['TL_LANG']['tl_module']['siEffect_legend']     = 'Effects';
$GLOBALS['TL_LANG']['tl_module']['siAuto_legend']       = 'Element moves';
$GLOBALS['TL_LANG']['tl_module']['siControls_legend']   = 'Navigation';
$GLOBALS['TL_LANG']['tl_module']['siTemplate_legend']   = 'Templates';
?>
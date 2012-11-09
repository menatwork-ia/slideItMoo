<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  MEN AT WORK 2012
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_content']['si_itemsVisible'] = array('Number of items display', 'Please enter the number of visible items.');
$GLOBALS['TL_LANG']['tl_content']['si_elementsSlide'] = array('Number of items slided', 'Please enter the number of items to slide at once.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsDimension'] = array('The height and width of an item', 'Value in px.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsMargin'] = array('Element margin', 'Value in px.');
$GLOBALS['TL_LANG']['tl_content']['si_startIndex'] = array('Start index', 'Start the slideshow from a another position.');
$GLOBALS['TL_LANG']['tl_content']['si_duration'] = array('Effect duration', 'Value in milliseconds.');
$GLOBALS['TL_LANG']['tl_content']['si_autoEffectTransition'] = array('Extended Effects', 'Based on the mootools Fx.Transitions library');
$GLOBALS['TL_LANG']['tl_content']['si_effectTransition'] = array('Effect transition', 'See http://mootools.net/docs/core/Fx/Fx.Transitions for examples.');
$GLOBALS['TL_LANG']['tl_content']['si_effectEase'] = array('Ease', 'For a natural tweening.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsSelector'] = array('Optional CSS class', 'Allows the user to enter an optional CSS class for the items in the slider.');
$GLOBALS['TL_LANG']['tl_content']['si_responsive'] = array('Activate responsive slider', 'Set the slider responsive with flexible width.');
$GLOBALS['TL_LANG']['tl_content']['si_elementDirection'] = array('Reverse element moves', 'Run the slideshow backwards.');
$GLOBALS['TL_LANG']['tl_content']['si_verticalSlide'] = array('Vertical slider', 'Run the slideshow vertically.');
$GLOBALS['TL_LANG']['tl_content']['si_autoSlideDefault'] = array('Set auto sliding on', 'The slideshow starts automatically.');
$GLOBALS['TL_LANG']['tl_content']['si_autoSlide'] = array('Rotation interval', 'Value in milliseconds.');
$GLOBALS['TL_LANG']['tl_content']['si_showControls'] = array('Display navigation', 'Allows the user to control the slideshow.');
$GLOBALS['TL_LANG']['tl_content']['si_mouseWheelNav'] = array('Activate mousewheel nav', 'Slideshow using the mousewheel navigation.');
$GLOBALS['TL_LANG']['tl_content']['si_templateDefault'] = array('Activate template', 'Apply the included standard skin.');
$GLOBALS['TL_LANG']['tl_content']['si_cssTemplate'] = array('CSS-Template', 'The design of the slideshow can be adjusted in the template.');
$GLOBALS['TL_LANG']['tl_content']['si_showBullets'] = array('Activate bullets', 'Check here to enable element positions.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['siGenerel_legend'] = 'General settings';
$GLOBALS['TL_LANG']['tl_content']['siDimensions_legend'] = 'Dimensions';
$GLOBALS['TL_LANG']['tl_content']['siEffect_legend'] = 'Effects';
$GLOBALS['TL_LANG']['tl_content']['siAuto_legend'] = 'Element moves';
$GLOBALS['TL_LANG']['tl_content']['siControls_legend'] = 'Navigation';
$GLOBALS['TL_LANG']['tl_content']['siTemplate_legend'] = 'Templates';


?>
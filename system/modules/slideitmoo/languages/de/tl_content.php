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
$GLOBALS['TL_LANG']['tl_content']['si_itemsVisible'] = array('Anzahl der sichtbaren Elemente', 'Geben Sie bitte die Anzahl der sichtbaren Elemente an.');
$GLOBALS['TL_LANG']['tl_content']['si_elementsSlide'] = array('Anzahl der zu verschiebenden Elemente', 'Geben Sie bitte die Anzahl der Elemente an die einem Durchlauf verschoben werden.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsDimension'] = array('Breite und Höhe eines Elements', 'Angabe in px.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsMargin'] = array('Elementabstand', 'Angabe in px.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsSelector'] = array('Optionale CSS-Klasse', 'Ermöglicht die Eingabe einer optionalen CSS-Klasse für die Elemente im Slider.');
$GLOBALS['TL_LANG']['tl_content']['si_startIndex'] = array('Startindex', 'Ermöglicht den Start der Slideshow von einer anderen Position.');
$GLOBALS['TL_LANG']['tl_content']['si_duration'] = array('Effektdauer', 'Angabe in Millisekunden.');
$GLOBALS['TL_LANG']['tl_content']['si_autoEffectTransition'] = array('Effektbewegung aktivieren', 'Basierend auf der Mootools Fx.Transitions Bibliothek.');
$GLOBALS['TL_LANG']['tl_content']['si_effectTransition'] = array('Effektbewegung', 'Siehe http://mootools.net/docs/core/Fx/Fx.Transitions für Beispiele.');
$GLOBALS['TL_LANG']['tl_content']['si_effectEase'] = array('Ease', 'Slideshow Effekt weicher darstellen.');
$GLOBALS['TL_LANG']['tl_content']['si_elementDirection'] = array('Slideshow umkehren', 'Die Slideshow rückwärts laufen lassen.');
$GLOBALS['TL_LANG']['tl_content']['si_verticalSlide'] = array('Vertikal sliden', 'Die Slideshow vertikal ablaufen lassen.');
$GLOBALS['TL_LANG']['tl_content']['si_autoSlideDefault'] = array('Autoplay aktivieren', 'Slideshow automatisch durchlaufen lassen.');
$GLOBALS['TL_LANG']['tl_content']['si_autoSlide'] = array('Einblendungsdauer', 'Angabe in Millisekunden.');
$GLOBALS['TL_LANG']['tl_content']['si_showControls'] = array('Navigation aktivieren', 'Ermöglicht dem Nutzer die Slideshow zu steuern.');
$GLOBALS['TL_LANG']['tl_content']['si_mouseWheelNav'] = array('Scroll-Navigation aktivieren', 'Die Slideshow mithilfe der mittleren Maustaste steuern.');
$GLOBALS['TL_LANG']['tl_content']['si_templateDefault'] = array('Template aktivieren', 'Das mitgelieferte Standarddesign anwenden.');
$GLOBALS['TL_LANG']['tl_content']['si_cssTemplate'] = array('CSS-Template', 'Die Gestaltung der Slideshow kann über das Template angepasst werden.');
$GLOBALS['TL_LANG']['tl_content']['si_showBullets'] = array('Positionselemente aktivieren', 'Wählen Sie diese Option, um Positionselemente zu aktivieren.');
$GLOBALS['TL_LANG']['tl_content']['si_skipInlineStyles'] = array('Inlinestyles entfernen', 'Wählen Sie diese Option, um zu verhindern das via Javascript Styles gesetzt werden.');
$GLOBALS['TL_LANG']['tl_content']['si_skipNavSize'] = array('Navigationstyles entfernen', 'Wählen Sie diese Option, um zu verhindern das Styles für die Navigation gesetzt werden.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['siGenerel_legend']	 = 'Allgemeine Einstellungen';
$GLOBALS['TL_LANG']['tl_content']['siDimensions_legend'] = 'Abmessungen';
$GLOBALS['TL_LANG']['tl_content']['siEffect_legend']	 = 'Effekte';
$GLOBALS['TL_LANG']['tl_content']['siAuto_legend']		 = 'Elementbewegungen';
$GLOBALS['TL_LANG']['tl_content']['siControls_legend']	 = 'Navigation';
$GLOBALS['TL_LANG']['tl_content']['siTemplate_legend']	 = 'Templates';
?>
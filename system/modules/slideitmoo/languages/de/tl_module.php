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
$GLOBALS['TL_LANG']['tl_module']['si_includeElements'] = array('Eingebundene Elemente', 'Wenn JavaScript deaktiviert ist, speichern Sie unbedingt Ihre Änderungen, bevor Sie die Reihenfolge ändern.');
$GLOBALS['TL_LANG']['tl_module']['si_elements'] = array('Element', '');
$GLOBALS['TL_LANG']['tl_module']['si_itemsVisible'] = array('Anzahl der sichtbaren Elemente', 'Geben Sie bitte die Anzahl der sichtbaren Elemente an.');
$GLOBALS['TL_LANG']['tl_module']['si_elementsSlide'] = array('Anzahl der zu verschiebenden Elemente', 'Geben Sie bitte die Anzahl der Elemente an die einem Durchlauf verschoben werden.');
$GLOBALS['TL_LANG']['tl_module']['si_itemsDimension'] = array('Breite und Höhe eines Elements', 'Angabe in px.');
$GLOBALS['TL_LANG']['tl_module']['si_itemsMargin'] = array('Elementabstand', 'Angabe in px.');
$GLOBALS['TL_LANG']['tl_module']['si_itemsSelector'] = array('Optionale CSS-Klasse', 'Ermöglicht die Eingabe einer optionalen CSS-Klasse für die Elemente im Slider.');
$GLOBALS['TL_LANG']['tl_module']['si_responsive'] = array('Responsiven Slider aktivieren', 'Stellt den Slider auf eine flexible Breite um.');
$GLOBALS['TL_LANG']['tl_module']['si_startIndex'] = array('Startindex', 'Ermöglicht den Start der Slideshow von einer anderen Position.');
$GLOBALS['TL_LANG']['tl_module']['si_duration'] = array('Effektdauer', 'Angabe in Millisekunden.');
$GLOBALS['TL_LANG']['tl_module']['si_autoEffectTransition'] = array('Effektbewegung aktivieren', 'Basierend auf der Mootools Fx.Transitions Bibliothek.');
$GLOBALS['TL_LANG']['tl_module']['si_effectTransition'] = array('Effektbewegung', 'Siehe http://mootools.net/docs/core/Fx/Fx.Transitions für Beispiele.');
$GLOBALS['TL_LANG']['tl_module']['si_effectEase'] = array('Ease', 'Slideshow Effekt weicher darstellen.');
$GLOBALS['TL_LANG']['tl_module']['si_elementDirection'] = array('Slideshow umkehren', 'Die Slideshow rückwärts laufen lassen.');
$GLOBALS['TL_LANG']['tl_module']['si_verticalSlide'] = array('Vertikal sliden', 'Die Slideshow vertikal ablaufen lassen.');
$GLOBALS['TL_LANG']['tl_module']['si_autoSlideDefault'] = array('Autoplay aktivieren', 'Slideshow automatisch durchlaufen lassen.');
$GLOBALS['TL_LANG']['tl_module']['si_autoSlide'] = array('Einblendungsdauer', 'Angabe in Millisekunden.');
$GLOBALS['TL_LANG']['tl_module']['si_showControls'] = array('Navigation aktivieren', 'Ermöglicht dem Nutzer die Slideshow zu steuern.');
$GLOBALS['TL_LANG']['tl_module']['si_mouseWheelNav'] = array('Scroll-Navigation aktivieren', 'Die Slideshow mithilfe der mittleren Maustaste steuern.');
$GLOBALS['TL_LANG']['tl_module']['si_templateDefault'] = array('Template aktivieren', 'Das mitgelieferte Standarddesign anwenden.');
$GLOBALS['TL_LANG']['tl_module']['si_cssTemplate'] = array('CSS-Template', 'Die Gestaltung der Slideshow kann über das Template angepasst werden.');
$GLOBALS['TL_LANG']['tl_module']['si_showBullets'] = array('Positionselemente aktivieren', 'Wählen Sie diese Option, um Positionselemente zu aktivieren.');
$GLOBALS['TL_LANG']['tl_module']['si_skipInlineStyles'] = array('Inlinestyles entfernen', 'Wählen Sie diese Option, um zu verhindern das via Javascript Styles gesetzt werden.');
$GLOBALS['TL_LANG']['tl_module']['si_skipNavSize'] = array('Navigationstyles entfernen', 'Wählen Sie diese Option, um zu verhindern das Styles für die Navigation gesetzt werden.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['siInclude_legend']    = 'Eingebundene Elemente';
$GLOBALS['TL_LANG']['tl_module']['siGenerel_legend']    = 'Allgemeine Einstellungen';
$GLOBALS['TL_LANG']['tl_module']['siDimensions_legend'] = 'Abmessungen';
$GLOBALS['TL_LANG']['tl_module']['siEffect_legend']     = 'Effekte';
$GLOBALS['TL_LANG']['tl_module']['siAuto_legend']       = 'Elementbewegungen';
$GLOBALS['TL_LANG']['tl_module']['siControls_legend']   = 'Navigation';
$GLOBALS['TL_LANG']['tl_module']['siTemplate_legend']   = 'Templates';
?>
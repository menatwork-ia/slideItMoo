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
$GLOBALS['TL_LANG']['tl_content']['si_itemsVisible'] = array('Nombre d\'éléments visibles', 'Veuillez, s\'il vous plaît, indiquer le nombre d\'éléments visibles.');
$GLOBALS['TL_LANG']['tl_content']['si_elementsSlide'] = array('Nombre d\'éléments slidés', 'Veuillez, s\'il vous plaît, entrer le nombre d\'éléments à slider en même temps.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsDimension'] = array('Largeur et hauteur d\'un élément', 'Valeur en px.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsMargin'] = array('Marge de l\'élément', 'Valeur en px.');
$GLOBALS['TL_LANG']['tl_content']['si_itemsSelector'] = array('Classe CSS optionnelle', 'Permet de saisir une classe CSS optionnelle pour les éléments du slide.');
$GLOBALS['TL_LANG']['tl_content']['si_startIndex'] = array('Index de départ', 'Permet de lancer le diaporama à partir d\'une position différente.');
$GLOBALS['TL_LANG']['tl_content']['si_duration'] = array('Durée de l\'effet', 'Valeur en milliseconde.');
$GLOBALS['TL_LANG']['tl_content']['si_autoEffectTransition'] = array('Activer l\'effet de transition', 'Basé sur la librairie Mootools Fx.Transitions.');
$GLOBALS['TL_LANG']['tl_content']['si_effectTransition'] = array('Effet de transition', 'Voir: http://mootools.net/docs/core/Fx/Fx.Transitions pour les exemples.');
$GLOBALS['TL_LANG']['tl_content']['si_effectEase'] = array('Ease', 'Fonction de timing.');
$GLOBALS['TL_LANG']['tl_content']['si_elementDirection'] = array('Inverser le déplacement de l\'élément', 'Exécuter le diaporama en arrière.');
$GLOBALS['TL_LANG']['tl_content']['si_verticalSlide'] = array('Slide vertical', 'Activer le diaporama vertical.');
$GLOBALS['TL_LANG']['tl_content']['si_autoSlideDefault'] = array('Activer l\'autoplay', 'Le diaporama démarre automatiquement.');
$GLOBALS['TL_LANG']['tl_content']['si_autoSlide'] = array('Intervalle de rotation', 'Valeur en milliseconde.');
$GLOBALS['TL_LANG']['tl_content']['si_showControls'] = array('Afficher la navigation', 'Permet à l\'utilisateur de contrôler le diaporama.');
$GLOBALS['TL_LANG']['tl_content']['si_mouseWheelNav'] = array('Activer la navigation avec la molette de souris', 'Utiliser la molette de souris pour la navigation.');
$GLOBALS['TL_LANG']['tl_content']['si_templateDefault'] = array('Activer les templates', 'Appliquer un design standard inclus.');
$GLOBALS['TL_LANG']['tl_content']['si_cssTemplate'] = array('Template CSS', 'Le design du diaporama peut être ajusté dans le template.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['siGenerel_legend'] = 'Paramètres généraux';
$GLOBALS['TL_LANG']['tl_content']['siDimensions_legend'] = 'Dimensions';
$GLOBALS['TL_LANG']['tl_content']['siEffect_legend'] = 'Effets';
$GLOBALS['TL_LANG']['tl_content']['siAuto_legend'] = 'Déplacement des éléments';
$GLOBALS['TL_LANG']['tl_content']['siControls_legend'] = 'Navigation';
$GLOBALS['TL_LANG']['tl_content']['siTemplate_legend'] = 'Templates';


?>
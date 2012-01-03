<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
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
 * @package    slideItMoo
 * @license    GNU/LGPL 
 * @filesource
 */

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['slideItMoo'] = '{title_legend},name,headline,type;{siInclude_legend},si_includeElements;{siGenerel_legend},si_itemsVisible,si_elementsSlide,si_startIndex,si_itemsSelector;{siDimensions_legend},si_itemsDimension,si_itemsMargin;{siEffect_legend},si_duration,si_autoEffectTransition;{siAuto_legend:hide},si_elementDirection,si_verticalSlide,si_autoSlideDefault;{siControls_legend:hide},si_showControls,si_mouseWheelNav;{siTemplate_legend:hide},si_templateDefault;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

// extend selector
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_autoSlideDefault';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_templateDefault';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_autoEffectTransition';

// extend subpalettes
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_autoSlideDefault'] = 'si_autoSlide';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_templateDefault'] = 'si_cssTemplate';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_autoEffectTransition'] = 'si_effectTransition,si_effectEase';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['si_includeElements'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_includeElements'],
    'inputType' => 'multiColumnWizard',
    'exclude' => true,
    'eval' => array
	(
		'width' => '100%',
		'columnFields' => array
		(
			'url' => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_module']['si_elements'],
				'exclude' => true,
				'inputType' => 'select',
				'options_callback' => array('tl_module_si', 'getContentElements'),
				'eval' => array('style' => 'width:590px')
			),
		)
	)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsVisible'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_itemsVisible'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => true, 'maxlength' => '4', 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_elementsSlide'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_elementsSlide'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => true, 'maxlength' => '4', 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_startIndex'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_startIndex'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsSelector'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_itemsSelector'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('maxlength' => '200', 'rgxp' => 'extnd', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsDimension'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_itemsDimension'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => true, 'multiple' => true, 'size' => 2, 'rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsMargin'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_itemsMargin'],
    'inputType' => 'trbl',
    'options' => array('px'),
    'exclude' => true,
    'eval' => array('rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_duration'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_duration'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => true, 'maxlength' => '6', 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoEffectTransition'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_autoEffectTransition'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('submitOnChange' => true, 'tl_class' => 'clr w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_effectTransition'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_effectTransition'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => array('Quad', 'Cubic', 'Quart', 'Quint', 'Sine', 'Expo', 'Circ', 'Bounce', 'Back', 'Elastic'),
    'eval' => array('tl_class' => 'clr w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_effectEase'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_effectEase'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => array('In', 'Out', 'InOut'),
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_elementDirection'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_elementDirection'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_verticalSlide'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_verticalSlide'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoSlideDefault'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_autoSlideDefault'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('submitOnChange' => true, 'tl_class' => 'm12 w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoSlide'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_autoSlide'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('maxlength' => '10', 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_showControls'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_showControls'],
    'default' => 0,
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_mouseWheelNav'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_mouseWheelNav'],
    'default' => 0,
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_templateDefault'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_templateDefault'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('submitOnChange' => true, 'tl_class' => 'clr w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_cssTemplate'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_cssTemplate'],
    'default' => 'slideitmoo_horizontal',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array('tl_module_si', 'loadCssFiles'),
    'eval' => array('tl_class' => 'w50')
);

/**
 * Erweiterung für die tl_module-Klasse
 */
class tl_module_si extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
    /**
     * read all available css-files and return them as an array
     * @return array
     */
    public function loadCssFiles()
    {

        $arrFiles = scan(TL_ROOT . '/plugins/slideitmoo/css/');
        $arrCss = array();
        foreach ($arrFiles as $k => $file)
        {
            if (strtolower(substr($file, -3) == "css"))
            {
                $tmp = substr($file, 0, strlen($file) - 4);
                $arrCss[$tmp] = $tmp;
            }
        }
        return $arrCss;
    }
	
	/**
	 * Get all content elements and return them as array (content element alias)
	 * @return array
	 */
	public function getContentElements()
	{
		$this->import('String');

		$arrPids = array();
		$arrAlias = array();

		if (!$this->User->isAdmin)
		{
			foreach ($this->User->pagemounts as $id)
			{
				$arrPids[] = $id;
				$arrPids = array_merge($arrPids, $this->getChildRecords($id, 'tl_page'));
			}

			if (empty($arrPids))
			{
				return $arrAlias;
			}

			$objAlias = $this->Database->prepare("SELECT c.id, c.pid, c.type, (CASE c.type WHEN 'module' THEN m.name WHEN 'form' THEN f.title WHEN 'table' THEN c.summary ELSE c.headline END) AS headline, c.text, a.title FROM tl_content c LEFT JOIN tl_article a ON a.id=c.pid LEFT JOIN tl_module m ON m.id=c.module LEFT JOIN tl_form f on f.id=c.form WHERE a.pid IN(". implode(',', array_map('intval', array_unique($arrPids))) .") AND c.id!=? ORDER BY a.title, c.sorting")
									   ->execute($this->Input->get('id'));
		}
		else
		{
			$objAlias = $this->Database->prepare("SELECT c.id, c.pid, c.type, (CASE c.type WHEN 'module' THEN m.name WHEN 'form' THEN f.title WHEN 'table' THEN c.summary ELSE c.headline END) AS headline, c.text, a.title FROM tl_content c LEFT JOIN tl_article a ON a.id=c.pid LEFT JOIN tl_module m ON m.id=c.module LEFT JOIN tl_form f on f.id=c.form WHERE c.id!=? ORDER BY a.title, c.sorting")
									   ->execute($this->Input->get('id'));
		}

		while ($objAlias->next())
		{
			$arrHeadline = deserialize($objAlias->headline, true);

			if (isset($arrHeadline['value']))
			{
				$headline = $this->String->substr($arrHeadline['value'], 32);
			}
			else
			{
				$headline = $this->String->substr(preg_replace('/[\n\r\t]+/', ' ', $arrHeadline[0]), 32);
			}

			$text = $this->String->substr(strip_tags(preg_replace('/[\n\r\t]+/', ' ', $objAlias->text)), 32);
			$strText = $GLOBALS['TL_LANG']['CTE'][$objAlias->type][0] . ' (';

			if ($headline != '')
			{
				$strText .= $headline . ', ';
			}
			elseif ($text != '')
			{
				$strText .= $text . ', ';
			}

			$key = $objAlias->title . ' (ID ' . $objAlias->pid . ')';
			$arrAlias[$key][$objAlias->id] = $strText . 'ID ' . $objAlias->id . ')';
		}

		return $arrAlias;
	}
	
}

?>
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
 * Table tl_module 
 */

/**
 * Palettes 
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['slideItMoo'] = '{title_legend},name,headline,type;{siInclude_legend},si_includeElements;{siGenerel_legend},si_itemsVisible,si_elementsSlide,si_startIndex,si_itemsSelector;{siDimensions_legend},si_itemsDimension,si_itemsMargin;{siEffect_legend},si_duration,si_autoEffectTransition;{siAuto_legend:hide},si_verticalSlide,si_autoSlideDefault;{siControls_legend:hide},si_showControls,si_mouseWheelNav,si_showBullets;{siTemplate_legend:hide},si_templateDefault;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Selector 
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_autoSlideDefault';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_templateDefault';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_autoEffectTransition';

/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_autoSlideDefault'] = 'si_autoSlide,si_elementDirection';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_templateDefault'] = 'si_cssTemplate';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_autoEffectTransition'] = 'si_effectTransition,si_effectEase';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['si_includeElements'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_includeElements'],
    'inputType' => 'multiColumnWizard',
    'exclude' => true,
    'eval' => array(
        'width' => '100%',
        'columnFields' => array(
            'url' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_module']['si_elements'],
                'exclude' => true,
                'inputType' => 'select',
                'options_callback' => array('tl_module_si', 'getContentElements'),
                'eval' => array(
                    'style' => 'width:590px'
                )
            ),
        )
    )
);

// Set chosen if we have a contao version 2.11
if (version_compare(VERSION, "2.11", ">="))
        $GLOBALS['TL_DCA']['tl_module']['fields']['si_includeElements']['eval']['columnFields']['url']['eval']['chosen'] = true;

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsVisible'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_itemsVisible'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => true, 'maxlength' => '4', 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_elementsSlide'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_elementsSlide'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => true, 'maxlength' => '4', 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_startIndex'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_startIndex'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsSelector'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_itemsSelector'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('maxlength' => '200', 'rgxp' => 'extnd', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsDimension'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_itemsDimension'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => true, 'multiple' => true, 'size' => 2, 'rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsMargin'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_itemsMargin'],
    'inputType' => 'trbl',
    'options' => array('px'),
    'exclude' => true,
    'eval' => array('rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_duration'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_duration'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => true, 'maxlength' => '6', 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoEffectTransition'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_autoEffectTransition'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('submitOnChange' => true, 'tl_class' => 'w50 m12')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_effectTransition'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_effectTransition'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => array('Quad', 'Cubic', 'Quart', 'Quint', 'Sine', 'Expo', 'Circ', 'Bounce', 'Back', 'Elastic'),
    'eval' => array('tl_class' => 'clr w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_effectEase'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_effectEase'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => array('In', 'Out', 'InOut'),
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_verticalSlide'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_verticalSlide'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('submitOnChange' => true, 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoSlideDefault'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_autoSlideDefault'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('submitOnChange' => true, 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoSlide'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_autoSlide'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('maxlength' => '10', 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_elementDirection'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_elementDirection'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50 m12')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_showControls'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_showControls'],
    'default' => 0,
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_mouseWheelNav'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_mouseWheelNav'],
    'default' => 0,
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_showBullets'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_showBullets'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('tl_class' => 'clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_templateDefault'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_templateDefault'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => array('submitOnChange' => true, 'tl_class' => 'clr w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_cssTemplate'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['si_cssTemplate'],
    'default' => 'slideitmoo_horizontal',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array('tl_module_si', 'loadCssFiles'),
    'eval' => array('tl_class' => 'w50')
);

/**
 * Class tl_module_si
 *
 * @copyright  MEN AT WORK 2012 
 * @package    slideitmoo
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
        $this->import('String');
    }

    /**
     * Get all content elements and return them as array (content element alias)
     * 
     * @return array
     */
    public function getContentElements()
    {        
        $arrPids = array();
        $arrAlias = array();

        $strQuery = "SELECT c.id, c.pid, c.type, 
                (CASE c.type WHEN 'module' THEN m.name WHEN 'form' THEN f.title WHEN 'table' THEN c.summary ELSE c.headline END) AS headline, 
                c.text, a.title
            FROM tl_content c 
            LEFT JOIN tl_article a 
            ON a.id = c.pid 
            LEFT JOIN tl_module m 
            ON m.id = c.module 
            LEFT JOIN tl_form f 
            ON f.id = c.form\n";
        
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

            $strQuery .= "WHERE a.pid 
                IN(" . implode(',', array_map('intval', array_unique($arrPids))) . ") 
                AND c.id != ? 
                ORDER BY a.title, c.sorting";
        }
        else
        {
            $strQuery .= "WHERE c.id != ? 
                ORDER BY a.title, c.sorting";
        }
        
        $objAlias = $this->Database
                    ->prepare($strQuery)
                    ->execute($this->Input->get('id'));

        while ($objAlias->next())
        {
            $arrHeadline = deserialize($objAlias->headline, true);

            if (isset($arrHeadline['value']))
            {
                $strHeadline = $this->String->substr($arrHeadline['value'], 32);
            }
            else
            {
                $strHeadline = $this->String->substr(preg_replace('/[\n\r\t]+/', ' ', $arrHeadline[0]), 32);
            }

            $strText = $this->String->substr(strip_tags(preg_replace('/[\n\r\t]+/', ' ', $objAlias->text)), 32);
            
            $arrTitle = array();            
            $arrTitle[] = $GLOBALS['TL_LANG']['CTE'][$objContentElem->type][0] . ' (';            
            
            if ($strHeadline != '' && $strHeadline != 'NULL')
            {
                $arrTitle[] = $strHeadline . ', ';
            }
            elseif ($strText != '' && $strText != 'NULL')
            {
                $arrTitle[] = $strText . ', ';
            }
            
            $arrTitle[] = 'ID ' . $objAlias->id . ')';
            $arrAlias[$objAlias->title . ' (ID ' . $objAlias->pid . ')'][$objAlias->id] = implode('', $arrTitle);
        }

        return $arrAlias;
    }
    
    /**
     * Read all available css-files and return them as an array
     * 
     * @param DC_Table $dc
     * @return array 
     */
    public function loadCssFiles(DC_Table $dc)
    {
        return slideItHelper::getInstance()->loadCssFiles($dc);
    }    
}

?>
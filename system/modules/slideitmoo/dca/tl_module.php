<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2013
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

if(tl_module_si::isActive())
{

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['slideItMoo'] = '{title_legend},name,headline,type;{siInclude_legend},si_includeElements;{siGenerel_legend},si_itemsVisible,si_elementsSlide,si_startIndex,si_itemsSelector,si_responsive;{siDimensions_legend},' . ((!tl_module_si::isResponsive()) ? 'si_itemsDimension,' : '') . 'si_itemsMargin;{siEffect_legend},si_duration,si_autoEffectTransition;{siAuto_legend:hide},si_verticalSlide,si_autoSlideDefault;{siControls_legend:hide},si_showControls,si_mouseWheelNav,si_showBullets;{siTemplate_legend:hide},si_templateDefault;{protected_legend:hide},protected;{expert_legend:hide},si_skipInlineStyles,si_skipNavSize,guests,cssID,space';

/**
 * Selector
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_autoSlideDefault';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_templateDefault';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'si_autoEffectTransition';

/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_autoSlideDefault']     = 'si_autoSlide,si_elementDirection';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_templateDefault']      = 'si_cssTemplate';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['si_autoEffectTransition'] = 'si_effectTransition,si_effectEase';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['si_includeElements'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_includeElements'],
    'inputType'                     => 'multiColumnWizard',
    'exclude'                       => true,
    'eval' => array
    (
        'width'                     => '100%',
        'columnFields' => array
        (
            'url' => array
            (
                'label'             => &$GLOBALS['TL_LANG']['tl_module']['si_elements'],
                'exclude'           => true,
                'inputType'         => 'select',
                'options_callback'  => array('tl_module_si', 'getContentElements'),
                'eval' => array
                (
                    'style'         => 'width:590px',
                    'chosen'        => true
                )
            ),
        )
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsVisible'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_itemsVisible'],
    'inputType'                     => 'text',
    'exclude'                       => true,
    'eval' => array
    (
        'mandatory'                 => true,
        'maxlength'                 => '4',
        'rgxp'                      => 'digit',
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_elementsSlide'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_elementsSlide'],
    'inputType'                     => 'text',
    'exclude'                       => true,
    'eval' => array
    (
        'mandatory'                 => true,
        'maxlength'                 => '4',
        'rgxp'                      => 'digit',
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_startIndex'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_startIndex'],
    'inputType'                     => 'text',
    'exclude'                       => true,
    'eval' => array
    (
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsSelector'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_itemsSelector'],
    'inputType'                     => 'text',
    'exclude'                       => true,
    'eval' => array
    (
        'maxlength'                 => '200',
        'rgxp'                      => 'extnd',
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_responsive'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_responsive'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'save_callback'                 => array(array('tl_module_si', 'siResponsiveSaveCallback')),
    'eval' => array
    (
        'submitOnChange'            => true,
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsDimension'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_itemsDimension'],
    'inputType'                     => 'text',
    'exclude'                       => true,
    'eval' => array
    (
        'mandatory'                 => true,
        'multiple'                  => true,
        'size'                      => 2,
        'rgxp'                      => 'digit',
        'nospace'                   => true,
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsMargin'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_itemsMargin'],
    'inputType'                     => 'trbl',
    'options'                       => array('px'),
    'exclude'                       => true,
    'eval' => array
    (
        'rgxp'                      => 'digit',
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_duration'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_duration'],
    'inputType'                     => 'text',
    'exclude'                       => true,
    'eval' => array
    (
        'mandatory'                 => true,
        'maxlength'                 => '6',
        'rgxp'                      => 'digit',
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoEffectTransition'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_autoEffectTransition'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval' => array
    (
        'submitOnChange'            => true,
        'tl_class'                  => 'w50 m12'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_effectTransition'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_effectTransition'],
    'inputType'                     => 'select',
    'exclude'                       => true,
    'options'                       => array('Quad', 'Cubic', 'Quart', 'Quint', 'Sine', 'Expo', 'Circ', 'Bounce', 'Back', 'Elastic'),
    'eval' => array
    (
        'tl_class'                  => 'clr w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_effectEase'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_effectEase'],
    'inputType'                     => 'select',
    'exclude'                       => true,
    'options'                       => array('In', 'Out', 'InOut'),
    'eval'                          => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_verticalSlide'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_verticalSlide'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval' => array
    (
        'submitOnChange'            => true,
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoSlideDefault'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_autoSlideDefault'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval' => array
    (
        'submitOnChange'            => true,
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_autoSlide'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_autoSlide'],
    'inputType'                     => 'text',
    'exclude'                       => true,
    'eval' => array
    (
        'maxlength'                 => '10',
        'rgxp'                      => 'digit',
        'tl_class'                  => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_elementDirection'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_elementDirection'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval'                          => array('tl_class' => 'w50 m12')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_showControls'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_showControls'],
    'default'                       => 0,
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval'                          => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_mouseWheelNav'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_mouseWheelNav'],
    'default'                       => 0,
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval'                          => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_showBullets'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_showBullets'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval'                          => array('tl_class' => 'm12 w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_templateDefault'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_templateDefault'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval' => array
    (
        'submitOnChange'            => true,
        'tl_class'                  => 'm12 w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_cssTemplate'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_cssTemplate'],
    'default'                       => 'slideitmoo_horizontal',
    'exclude'                       => true,
    'inputType'                     => 'select',
    'options_callback'              => array('tl_module_si', 'loadCssFiles'),
    'eval'                          => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_skipInlineStyles'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_skipInlineStyles'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval'                          => array('tl_class' => 'm12 w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['si_skipNavSize'] = array
(
    'label'                         => &$GLOBALS['TL_LANG']['tl_module']['si_skipNavSize'],
    'inputType'                     => 'checkbox',
    'exclude'                       => true,
    'eval'                          => array('tl_class' => 'm12 w50')
);

}

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

    public static function isActive()
    {
        if(!Database::getInstance()->fieldExists('si_responsive', 'tl_module')) {
            $strUrl = Environment::getInstance()->base . 'contao/main.php?do=repository_manager&update=database';
            $_SESSION['TL_INFO']['slideItMoo'] = sprintf($GLOBALS['TL_LANG']['MSC']['si_update'], $strUrl);
            return false;
        }

        if(Input::getInstance()->get('do') != 'themes' ||
           Input::getInstance()->get('table') != 'tl_module' ||
           !Input::getInstance()->get('id'))
        {
            return false;
        }


        return true;
    }

    /**
     * Check if current content element is responsive
     *
     * @return boolean
     */
    public static function isResponsive()
    {
        $objResult = Database::getInstance()
                ->prepare("SELECT si_responsive as isResponsive FROM tl_module WHERE id = ?")
                ->execute(Input::getInstance()->get('id'));

        return $objResult->isResponsive;
    }

    public function siResponsiveSaveCallback($val, DataContainer $dc)
    {
        if ($val)
        {
            $GLOBALS['TL_DCA']['tl_module']['fields']['si_itemsDimension']['eval']['mandatory'] = false;
        }

        return $val;
    }

    /**
     * Get all content elements and return them as array (content element alias)
     *
     * @return array
     */
    public function getContentElements()
    {
        $arrPids  = array();
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
                $arrPids   = array_merge($arrPids, $this->getChildRecords($id, 'tl_page'));
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

            $arrTitle   = array();
            $arrTitle[] = $GLOBALS['TL_LANG']['CTE'][$objContentElem->type][0] . ' (';

            if ($strHeadline != '' && $strHeadline != 'NULL')
            {
                $arrTitle[] = $strHeadline . ', ';
            }
            elseif ($strText != '' && $strText != 'NULL')
            {
                $arrTitle[] = $strText . ', ';
            }

            $arrTitle[]                                                                 = 'ID ' . $objAlias->id . ')';
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
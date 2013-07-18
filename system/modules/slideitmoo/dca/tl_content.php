<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2013
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

if(tl_content_si::isActive())
{

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['slideItStart'] = '{type_legend},type,headline;{siGenerel_legend},si_itemsVisible,si_elementsSlide,si_startIndex,si_itemsSelector,si_responsive;{siDimensions_legend},' . ((!tl_content_si::isResponsive()) ? 'si_itemsDimension,' : '') . 'si_itemsMargin;{siEffect_legend},si_duration,si_autoEffectTransition;{siAuto_legend:hide},si_verticalSlide,si_autoSlideDefault;{siControls_legend:hide},si_showControls,si_mouseWheelNav,si_showBullets;{siTemplate_legend:hide},si_templateDefault;{expert_legend:hide},si_skipInlineStyles,si_skipNavSize,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['slideItEnd']   = '{type_legend},type;';

/**
 * Selector
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'si_autoSlideDefault';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'si_templateDefault';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'si_autoEffectTransition';

/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['si_autoSlideDefault']     = 'si_autoSlide,si_elementDirection';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['si_templateDefault']      = 'si_cssTemplate';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['si_autoEffectTransition'] = 'si_effectTransition,si_effectEase';

/**
 * Callbacks
 */
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('tl_content_si', 'siWrite');
$GLOBALS['TL_DCA']['tl_content']['config']['ondelete_callback'][] = array('tl_content_si', 'siDelete');

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['si_itemsVisible'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_itemsVisible'],
    'inputType'             => 'text',
    'exclude'               => true,
    'eval' => array
    (
        'mandatory'         => true,
        'maxlength'         => '4',
        'rgxp'              => 'digit',
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_elementsSlide'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_elementsSlide'],
    'inputType'             => 'text',
    'exclude'               => true,
    'eval' => array
    (
        'mandatory'         => true,
        'maxlength'         => '4',
        'rgxp'              => 'digit',
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_startIndex'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_startIndex'],
    'inputType'             => 'text',
    'exclude'               => true,
    'eval' => array
    (
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_itemsSelector'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_itemsSelector'],
    'inputType'             => 'text',
    'exclude'               => true,
    'eval' => array
    (
        'maxlength'         => '200',
        'rgxp'              => 'extnd',
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_responsive'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_responsive'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'save_callback' => array
    (
        array('tl_content_si', 'siResponsiveSaveCallback')
    ),
    'eval' => array
    (
        'submitOnChange'    => true,
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_itemsDimension'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_itemsDimension'],
    'inputType'             => 'text',
    'exclude'               => true,
    'eval' => array
    (
        'mandatory'         => true,
        'multiple'          => true,
        'size'              => 2,
        'rgxp'              => 'digit',
        'nospace'           => true,
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_itemsMargin'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_itemsMargin'],
    'inputType'             => 'trbl',
    'options'               => array('px'),
    'exclude'               => true,
    'eval' => array
    (
        'rgxp'              => 'digit',
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_duration'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_duration'],
    'inputType'             => 'text',
    'exclude'               => true,
    'eval' => array
    (
        'mandatory'         => true,
        'maxlength'         => '6',
        'rgxp'              => 'digit',
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_autoEffectTransition'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_autoEffectTransition'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval' => array
    (
        'submitOnChange'    => true,
        'tl_class'          => 'w50 m12'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_effectTransition'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_effectTransition'],
    'inputType'             => 'select',
    'exclude'               => true,
    'options'               => array('Quad', 'Cubic', 'Quart', 'Quint', 'Sine', 'Expo', 'Circ', 'Bounce', 'Back', 'Elastic'),
    'eval' => array
    (
        'tl_class'          => 'clr w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_effectEase'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_effectEase'],
    'inputType'             => 'select',
    'exclude'               => true,
    'options'               => array('In', 'Out', 'InOut'),
    'eval'                  => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_verticalSlide'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_verticalSlide'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval' => array
    (
        'submitOnChange'    => true,
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_autoSlideDefault'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_autoSlideDefault'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval' => array
    (
        'submitOnChange'    => true,
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_autoSlide'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_autoSlide'],
    'inputType'             => 'text',
    'exclude'               => true,
    'eval' => array
    (
        'maxlength'         => '10',
        'rgxp'              => 'digit',
        'tl_class'          => 'w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_elementDirection'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_elementDirection'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval'                  => array('tl_class' => 'w50 m12')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_showControls'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_showControls'],
    'default'               => 0,
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval'                  => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_mouseWheelNav'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_mouseWheelNav'],
    'default'               => 0,
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval'                  => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_showBullets'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_showBullets'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval'                  => array('tl_class' => 'm12 w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_templateDefault'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_templateDefault'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval' => array
    (
        'submitOnChange'    => true,
        'tl_class'          => 'm12 w50'
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_cssTemplate'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_cssTemplate'],
    'default'               => 'slideitmoo_horizontal',
    'exclude'               => true,
    'inputType'             => 'select',
    'options_callback'      => array('tl_content_si', 'loadCssFiles'),
    'eval'                  => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_skipInlineStyles'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_skipInlineStyles'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval'                  => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['si_skipNavSize'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_content']['si_skipNavSize'],
    'inputType'             => 'checkbox',
    'exclude'               => true,
    'eval'                  => array('tl_class' => 'w50')
);

}

/**
 * Class tl_content_si
 *
 * @copyright  MEN AT WORK 2012
 * @package    slideitmoo
 */
class tl_content_si extends Backend
{

    public static function isActive()
    {
        if(!Database::getInstance()->fieldExists('si_responsive', 'tl_content')) {
            $strUrl = Environment::getInstance()->base . 'contao/main.php?do=repository_manager&update=database';
            $_SESSION['TL_INFO']['slideItMoo'] = sprintf($GLOBALS['TL_LANG']['MSC']['si_update'], $strUrl);
            return false;
        }

        if(Input::getInstance()->get('do') != 'article' ||
           Input::getInstance()->get('table') != 'content' ||
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
                ->prepare("SELECT si_responsive as isResponsive FROM tl_content WHERE id = ?")
                ->execute(Input::getInstance()->get('id'));

        return $objResult->isResponsive;
    }

    public function siResponsiveSaveCallback($val, DataContainer $dc)
    {
        if ($val)
        {
            $GLOBALS['TL_DCA']['tl_content']['fields']['si_itemsDimension']['eval']['mandatory'] = false;
        }

        return $val;
    }

    /**
     * Write or update the content elements
     *
     * @param DC_Table $dc
     */
    public function siWrite(DC_Table $dc)
    {
        $id = $dc->id;

        // Get elements from database
        $objElement = $this->Database->prepare("SELECT * FROM tl_content WHERE id=?")
                ->execute($id)
                ->fetchAssoc();

        // Check if id is set
        if ($objElement['si_containerId'] == "")
        {
            // Get existing id´s and create new
            $objSlider = $this->Database->prepare('SELECT *, CAST(SUBSTRING_INDEX(si_containerId, "_", -1) AS UNSIGNED ) as counter FROM tl_content WHERE type = "slideItStart" AND id != ? ORDER BY counter desc LIMIT 0,1')
                    ->execute($id)
                    ->fetchAssoc();

            if ($objSlider == "")
            {
                // Set first slider id
                $objElement['si_containerId'] = "slider_1";
            }
            else
            {
                // Get highest id and set new container Id
                $sliderId                     = explode("_", $objSlider['si_containerId']);
                $objElement['si_containerId'] = "slider_" . ($sliderId[1] + 1);
            }

            // Update containerId
            $this->Database->prepare("UPDATE tl_content SET si_containerId = ? WHERE id = ?")
                    ->execute($objElement['si_containerId'], $id);
        }

        // Check childs
        if ($objElement['si_children'] == "" && $objElement['type'] == 'slideItStart')
        {
            // Create slideItEnd
            $result = $this->Database->prepare('INSERT INTO tl_content (pid, tstamp, sorting,  type, si_containerId, si_children) VALUES (?,?,?,"slideItEnd",?,?)')
                    ->execute($objElement['pid'], time(), ($objElement['sorting'] + 1), $objElement['si_containerId'], $id);

            // Update element
            $this->Database->prepare("UPDATE tl_content SET si_children = ? WHERE id=?")
                    ->execute($result->insertId, $id);
        }
    }

    /**
     * Delete slider element and his childs
     *
     * @param DC_Table $dc
     */
    public function siDelete(DC_Table $dc)
    {
        /**
         * Get content element to delete
         */
        $objDelRec = $this->Database->prepare("SELECT * FROM tl_content WHERE id = ?")
                ->execute($dc->id)
                ->fetchAssoc();

        /**
         * Check if content element type is slideItStart or slideItEnd
         */
        if ($objDelRec['type'] == 'slideItStart' || $objDelRec['type'] == 'slideItEnd')
        {
            /**
             * On delete, delete all child too
             */
            $eraseId = ($objDelRec['si_children'] != "") ? $objDelRec['si_children'] : false;

            if ($eraseId)
            {
                $this->Database->prepare("DELETE FROM tl_content WHERE id = ?")
                        ->execute($eraseId);
            }
        }
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
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
 * Class slideItModule
 */
class slideItModule extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_slideItMoo';

    /**
     * Configuration array
     * @var type
     */
    protected $_arrConf = array();

    /**
     * Initialize the object
     *
     * @param Database_Result $objElement
     * @param string $strColumn
     */
    public function __construct($objElement, $strColumn = 'main')
    {
        $arrConf        = $objElement->fetchAllAssoc();
        $this->_arrConf = $arrConf[0];
        parent::__construct($objElement, $strColumn);
    }

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate           = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . $GLOBALS['TL_LANG']['MOD']['slideitmoo'][0] . ' ###';

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate module
     */
    protected function compile()
    {
        $this->_arrConf['si_containerId'] = "slider_" . $this->id;

        $strContentElements = '';
        $arrIncludeElements = deserialize($this->si_includeElements);
        foreach ($arrIncludeElements as $element)
        {
            $strContentElements .= $this->getContentElement($element['url']);
        }

        $this->Template->si_contentElements = $strContentElements;
        $this->Template->si_containerId     = $this->_arrConf['si_containerId'];
        $objSlider                          = new slideItMoo($this->_arrConf);
        $this->Template->script             = $objSlider->parse();
    }

}

?>
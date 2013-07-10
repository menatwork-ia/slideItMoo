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
 * Class slideItStart
 */
class slideItStart extends ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_slideItStart';

    /**
     * Configuration array
     * @var type
     */
    protected $_arrConf = array();

    /**
     * Object with helper functions
     * @var slideItHelper
     */
    protected $_objHelper;

    /**
     * Initialize the object
     *
     * @param object
     * @return string
     */
    public function __construct($objElement)
    {
        $this->_objHelper = slideItHelper::getInstance();
        $arrConf          = $objElement->row();
        $this->_arrConf   = $arrConf;
        parent::__construct($objElement);
    }

    /**
     * Display a wildcard in the back end
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate           = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . $GLOBALS['TL_LANG']['CTE']['slideItStart'][0] . ' ###';

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate module
     */
    protected function compile()
    {
        $this->_objHelper->setSliderConfig($this->_arrConf);

        $objSlider              = new slideItMoo($this->_arrConf);
        $this->Template->script = $objSlider->parse();
    }

}

?>
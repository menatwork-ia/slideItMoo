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
 * Class slideItEnd
 */
class slideItEnd extends ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_slideItEnd';

    /**
     * Object with helper functions
     * @var slideItHelper
     */
    protected $_objHelper;

    /**
     * Contians slider id to getting start tag config
     * @var string
     */
    protected $_strSliderId;

    /**
     * Initialize the object
     *
     * @param object
     * @return string
     */
    public function __construct($objElement)
    {
        $this->_objHelper   = slideItHelper::getInstance();
        $this->_strSliderId = $objElement->si_containerId;
        parent::__construct($objElement);
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

            if (version_compare(VERSION, 3, '<'))
            {
                $objTemplate->wildcard = '### ' . $GLOBALS['TL_LANG']['CTE']['slideItEnd'][0] . ' ###';
            }

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate module
     */
    protected function compile()
    {
        $this->Template->startTag = $this->_objHelper->getSliderConfig($this->_strSliderId);
        $this->Template->id       = "slider";
    }

}

?>
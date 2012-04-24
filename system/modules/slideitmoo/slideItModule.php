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
 * Class slideItModule 
 *
 * @copyright  MEN AT WORK 2012 
 * @package    slideitmoo
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
    public function __construct(Database_Result $objElement, $strColumn = 'main')
    {
        $arrConf = $objElement->fetchAllAssoc();
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
            $objTemplate = new BackendTemplate('be_wildcard');
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
        $this->Template->si_containerId = $this->_arrConf['si_containerId'];
        $objSlider = new slideItMoo($this->_arrConf);
        $this->Template->script = $objSlider->parse();
    }

}

?>
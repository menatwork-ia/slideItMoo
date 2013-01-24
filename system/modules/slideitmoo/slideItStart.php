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
 * Class slideItStart 
 *
 * @copyright  MEN AT WORK 2012 
 * @package    slideitmoo
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
     * Initialize the object
     * 
     * @param object
     * @return string
     */
    public function __construct(Database_Result $objElement)
    {
        $arrConf        = $objElement->fetchAllAssoc();
        $this->_arrConf = $arrConf[0];
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
        $objSlider              = new slideItMoo($this->_arrConf);
        $this->Template->script = $objSlider->parse();
    }

}

?>
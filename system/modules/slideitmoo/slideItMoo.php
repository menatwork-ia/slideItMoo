<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
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
 * @license    GNU/GPL 2
 * @filesource
 */

/**
 * Class SlideItMoo
 * 
 * @copyright  Cliff Parnitzky 2012 <mail@cliff-parnitzky.de>
 * @copyright  MEN AT WORK 2012
 * @package    slideitmoo
 */
class slideItMoo
{
    /**
     * Configuration
     * @var array
     */
    protected $_arrConf = array();
    
    /**
     * Object with helper functions
     * @var slideItHelper
     */
    protected $_objHelper;

    /**
     * Template
     * @var string
     */
    protected $_strTemplate = 'moo_slideItMoo';    

    /**
     * Initialize the object
     */
    public function __construct($arrAttributes)
    {
        $this->_objHelper = slideItHelper::getInstance();
        $this->addAttributes($arrAttributes);
    }

    /**
     * Set a parameter
     * 
     * @param string
     * @param mixed
     * @throws Exception
     */
    public function __set($strKey, $varValue)
    {
        switch ($strKey)
        {
            case 'itemsDimension':
                $arrDimensions = deserialize($varValue);
                $this->width        = $arrDimensions[0];
                $this->itemHeight   = $arrDimensions[1];
                break;
            case 'itemsMargin':
                $arrMargin = deserialize($varValue);
                $this->marginTop    = (($arrMargin['top'] != '') ? $arrMargin['top'] : 0);
                $this->marginRight  = (($arrMargin['right'] != '') ? $arrMargin['right'] : 0);
                $this->marginBottom = (($arrMargin['bottom'] != '') ? $arrMargin['bottom'] : 0);
                $this->marginLeft   = (($arrMargin['left'] != '') ? $arrMargin['left'] : 0);
                $this->marginUnit   = $arrMargin['unit'];
                break;
            case 'itemsSelector':
                $this->_arrConf[$strKey] = (($varValue != '') ? $varValue : 'block');
                break;
            default:
                $this->_arrConf[$strKey] = $varValue;
                break;                
        }
    }

    /**
     * Return a parameter
     * 
     * @return string
     * @throws Exception
     */
    public function __get($strKey)
    {
        return $this->_arrConf[$strKey];
    }
    
    /**
    * Take an associative array and add it to the object's attributes
     * 
    * @param array
    */
    public function addAttributes($mixedAttributes)
    {
        if(is_array($mixedAttributes))
        {
            foreach ($mixedAttributes as $key => $value)
            {      
                if(substr($key, 0, 3) ==  'si_')
                {
                    $key = substr($key, 3);
                }
                $this->$key = $value;
            }
        }          
    }    

    /**
     * Create slider and return it as string
     * 
     * @return string
     */
    public function parse()
    {
        // Include JS and CSS
        if($this->cssTemplate && $this->templateDefault) 
        {
            $this->_objHelper->insertJsCss($this->cssTemplate, $this->templateDefault);
        }
        $this->_objHelper->insertJsCss();
        
        $this->itemWidth = $this->width + $this->marginRight + $this->marginLeft;
        $this->navFwd = "'." . $this->containerId . "_fwd'";
        $this->navBk = "'." . $this->containerId . "_bk'";
        $this->containerChildsId = '#' . $this->containerId . ' .' . $this->itemsSelector;
        
        // Create slider array
        $arrSlider = array(
            'itemWidth'         => $this->itemWidth,
            'itemHeight'        => $this->itemHeight,
            'showControls'      => (($this->showControls) ? 1 : 0),
            'overallContainer'  => "'" . $this->containerId . "'",
            'elementScrolled'   => "'" . $this->containerId . "_inner'",
            'thumbsContainer'   => "'" . $this->containerId . "_items'",		
            'itemsVisible'      => $this->itemsVisible,
            'elemsSlide'        => $this->elementsSlide,
            'duration'          => $this->duration,
            'itemsSelector'     => "'." . $this->itemsSelector . "'"
        );
        
        if($this->showControls)
        {
            $arrSlider['navs'] = array(
                'fwd'   => $this->navFwd,
                'bk'    => $this->navBk
            );
        }
        
        if($this->startIndex) 
        {
            $arrSlider['startIndex'] = $this->startIndex;
        }
        
        if($this->autoSlideDefault)
        {
            $arrSlider['autoSlide'] = $this->autoSlide;
        }
        
        if($this->showBullets)
        {
            $arrSlider['showBullets'] = 'true';
        }
        
        if($this->mouseWheelNav)
        {
            $arrSlider['mouseWheelNav'] = 'true';        
        }
        
        if($this->autoSlideDefault && $this->elementDirection) $arrSlider['direction'] = -1;
        if($this->verticalSlide) $arrSlider['slideVertical'] = 'true';
        if($this->autoEffectTransition)
            $arrSlider['transition'] = "Fx.Transitions." . $this->effectTransition . ".ease" . $this->effectEase;
        
        // Create Childs array
        $arrChilds = array(
            'marginTop'     => "'" . $this->marginTop . $this->marginUnit . "'",
            'marginRight'   => "'" . $this->marginRight . $this->marginUnit . "'",
            'marginBottom'  => "'" . $this->marginBottom . $this->marginUnit . "'",
            'marginLeft'    => "'" . $this->marginLeft . $this->marginUnit . "'",
            'width'         => "'" . $this->width . "px'"
        );
        
        // Create Template
        $objTemplate = new FrontendTemplate($this->_strTemplate);        
        $objTemplate->containerId       = $this->containerId;
        $objTemplate->itemsSelector     = $this->itemsSelector;        
        $objTemplate->itemsVisible      = $this->itemsVisible;
        $objTemplate->showControls      = $this->showControls;
        $objTemplate->navFwd            = $this->navFwd;
        $objTemplate->navBk             = $this->navBk;
        $objTemplate->scrollSize        = $this->itemsVisible * $this->itemWidth;
        $objTemplate->itemWidth         = $this->itemWidth;
        $objTemplate->arrSlider         = $arrSlider;
        $objTemplate->containerChildsId = $this->containerChildsId;
        $objTemplate->arrChilds         = $arrChilds;
        return $objTemplate->parse();
    }
    
}

?>
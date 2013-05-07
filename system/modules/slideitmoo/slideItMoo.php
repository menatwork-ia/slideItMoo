<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2013 
 * @package    slideitmoo
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Class SlideItMoo
 * 
 * @copyright  Cliff Parnitzky 2012
 */
class slideItMoo
{

    /**
     * Configuration
     * @var array
     */
    protected $_arrConf = array();

    /**
     * Slider
     * @var array
     */
    protected $_arrSlider = array();

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
                $arrDimensions           = deserialize($varValue);
                $this->width             = $arrDimensions[0];
                $this->height            = $arrDimensions[1];
                break;
            case 'itemsMargin':
                $arrMargin               = deserialize($varValue);
                $this->marginsIsSet      = TRUE;
                $this->marginTop         = (($arrMargin['top'] != '') ? $arrMargin['top'] : 0);
                $this->marginRight       = (($arrMargin['right'] != '') ? $arrMargin['right'] : 0);
                $this->marginBottom      = (($arrMargin['bottom'] != '') ? $arrMargin['bottom'] : 0);
                $this->marginLeft        = (($arrMargin['left'] != '') ? $arrMargin['left'] : 0);
                $this->marginUnit        = $arrMargin['unit'];
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
        if (is_array($mixedAttributes))
        {
            foreach ($mixedAttributes as $key => $value)
            {
                if (substr($key, 0, 3) == 'si_')
                {
                    $key        = substr($key, 3);
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
        // Set all nessesary values that are not given to default
        $this->_setDefault();

        // Include JS and CSS
        if ($this->cssTemplate && $this->templateDefault)
        {
            $this->_objHelper->insertJsCss($this->cssTemplate, $this->templateDefault);
        }

        $this->_objHelper->insertJsCss();

        // Fill slider array
        $this->_arrSlider = array_merge($this->_arrSlider, array(
            'itemWidth'        => $this->itemWidth,
            'itemHeight'       => $this->itemHeight,
            'showControls'     => (($this->showControls) ? true : false),
            'overallContainer' => $this->containerId,
            'elementScrolled'  => $this->containerId . "_inner",
            'thumbsContainer'  => $this->containerId . "_items",
            'itemsVisible'     => $this->itemsVisible,
            'elemsSlide'       => $this->elementsSlide,
            'itemsSelector'    => "." . $this->itemsSelector,
            'skipInlineStyles' => $this->skipInlineStyles,
            'skipNavSize'      => $this->skipNavSize,
            'isResponsive'     => $this->responsive
                ));

        if ($this->showControls)
        {
            $this->_arrSlider['navs'] = array(
                'fwd' => $this->navFwd,
                'bk'  => $this->navBk
            );
        }

        if ($this->duration)
        {
            $this->_arrSlider['duration'] = intval($this->duration);
        }

        // Look for startIndex set by post or get
        $intPostIndex = Input::getInstance()->post('startIndex');
        $intGetIndex = Input::getInstance()->get('startIndex');
        if($intPostIndex || $intGetIndex)
        {
            $this->_arrSlider['startIndex'] = (($intPostIndex) ? $intPostIndex : $intGetIndex);
        }
        else if ($this->startIndex)
        {
            $this->_arrSlider['startIndex'] = $this->startIndex;
        }
        
        if ($this->autoSlideDefault && $this->autoSlide)
        {
            $this->_arrSlider['autoSlide'] = intval($this->autoSlide);
        }

        if ($this->autoSlideDefault && $this->elementDirection)
        {
            $this->_arrSlider['direction'] = ($this->elementDirection == -1) ? -1 : 1;
        }

        if ($this->showBullets)
        {
            $this->_arrSlider['showBullets'] = 'true';
        }

        if ($this->mouseWheelNav)
        {
            $this->_arrSlider['mouseWheelNav'] = 'true';
        }

        if ($this->verticalSlide)
        {
            $this->_arrSlider['slideVertical'] = true;
        }

        if ($this->autoEffectTransition && $this->effectTransition && $this->effectEase)
        {
            $this->_arrSlider['transition'] = "Fx.Transitions." . $this->effectTransition . ".ease" . $this->effectEase;
        }

        if ($this->onChange)
        {
            $this->_arrSlider['onChange'] = $this->onChange;
        }

        // Create Childs array
        $arrChilds = array(
            'marginTop'    => $this->marginTop . $this->marginUnit,
            'marginRight'  => $this->marginRight . $this->marginUnit,
            'marginBottom' => $this->marginBottom . $this->marginUnit,
            'marginLeft'   => $this->marginLeft . $this->marginUnit,
        );

        if ($this->verticalSlide)
        {
            $arrChilds['height'] = $this->height . "px";
        }
        else
        {
            $arrChilds['width'] = $this->width . "px";
        }

        // Create Template
        $objTemplate                    = new FrontendTemplate($this->_strTemplate);
        $objTemplate->containerId       = $this->containerId;
        $objTemplate->itemsSelector     = $this->itemsSelector;
        $objTemplate->itemsVisible      = $this->itemsVisible;
        $objTemplate->showControls      = $this->showControls;
        $objTemplate->navFwd            = $this->navFwd;
        $objTemplate->navBk             = $this->navBk;
        $objTemplate->scrollSize        = $this->itemsVisible * $this->itemWidth;
        $objTemplate->itemWidth         = $this->itemWidth;
        $objTemplate->arrSlider         = $this->_arrSlider;
        $objTemplate->containerChildsId = $this->containerChildsId;
        $objTemplate->arrChilds         = $arrChilds;
        return $objTemplate->parse();
    }

    /**
     * Set all nessesary values that are not given to default
     */
    protected function _setDefault()
    {
        // If templateDefault is true but no cssTemplate is given,
        // set "slideitmoo_horizontal" as default
        if ($this->templateDefault && !$this->cssTemplate)
        {
            $this->cssTemplate = 'slideitmoo_horizontal';
        }

        // If no margins are specifyte set all to zero
        if (!$this->marginsIsSet)
        {
            $this->itemsMargin = array('top'    => 0, 'right'  => 0, 'bottom' => 0, 'left'   => 0, 'unit'   => 'px');
        }

        // Set item selectors
        if (!$this->itemsSelector)
        {
            $this->itemsSelector = '';
        }

        // Set visible items
        if (!$this->itemsVisible)
        {
            $this->itemsVisible = 1;
        }

        // Set elements to slide
        if (!$this->elementsSlide)
        {
            $this->elementsSlide = 1;
        }

        // Set item width
        $this->itemWidth = $this->width + $this->marginRight + $this->marginLeft;

        // Set item height
        $this->itemHeight = $this->height + $this->marginTop + $this->marginBottom;

        // set forward navigation selector
        $this->navFwd = "." . $this->containerId . "_fwd";

        // set backward navigation selector
        $this->navBk = "." . $this->containerId . "_bk";

        // Set css path to items
        $this->containerChildsId = '#' . $this->containerId . ' .' . $this->itemsSelector;

        $this->skipInlineStyles = ($this->skipInlineStyles) ? true : false;

        $this->skipNavSize = ($this->skipNavSize) ? true : false;

        $this->responsive = ($this->responsive && !$this->skipInlineStyles) ? true : false;
    }

}

?>
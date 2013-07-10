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
 * Class slideItStart 
 */
class slideItHelper extends Backend
{

    /**
     * Current object instance (Singleton)
     * @var slideItHelper
     */
    protected static $_objInstance = NULL;

    /**
     * Contains all start slider config arrays
     * @var array 
     */
    protected $_arrSliderConfigs = array();

    /**
     * Prevent constructing the object (Singleton)
     */
    protected function __construct()
    {
        if (strlen($GLOBALS['TL_CONFIG']['dbUser']) > 0)
            parent::__construct();
    }

    /**
     * Prevent cloning of the object (Singleton)
     */
    final private function __clone(){}

    /**
     * Get instanz of the object (Singelton) 
     *
     * @return slideItHelper 
     */
    public static function getInstance()
    {
        if (self::$_objInstance == NULL)
        {
            self::$_objInstance = new slideItHelper();
        }
        return self::$_objInstance;
    }

    /**
     * Set start slider config
     * 
     * @param array $arrConfig
     */
    public function setSliderConfig($arrConfig)
    {
        $this->_arrSliderConfigs[$arrConfig['si_containerId']] = $arrConfig;
    }

    /**
     * Get start slider config
     * 
     * @param string $strId
     * @return array/null
     */
    public function getSliderConfig($strId)
    {
        if (array_key_exists($strId, $this->_arrSliderConfigs))
        {
            return $this->_arrSliderConfigs[$strId];
        }
        return null;
    }

    /**
     * Check the required extensions and files
     * 
     * @param string $strContent
     * @param string $strTemplate
     * @return string
     */
    public function checkExtensions($strContent, $strTemplate)
    {
        if (!strlen($GLOBALS['TL_CONFIG']['dbUser']) > 0)
            return;

        if ($strTemplate == 'be_main')
        {
            if (!is_array($_SESSION["TL_INFO"]))
            {
                $_SESSION["TL_INFO"] = array();
            }

            // Required extensions
            $arrRequiredExtensions = array(
                'MultiColumnWizard' => 'multicolumnwizard'
            );

            // Check for required extensions
            foreach ($arrRequiredExtensions as $key => $val)
            {
                if (!in_array($val, $this->Config->getActiveModules()))
                {
                    $_SESSION["TL_INFO"] = array_merge($_SESSION["TL_INFO"], array($val => 'Please install the required extension <strong>' . $key . '</strong>'));
                }
                else
                {
                    if (is_array($_SESSION["TL_INFO"]) && key_exists($val, $_SESSION["TL_INFO"]))
                    {
                        unset($_SESSION["TL_INFO"][$val]);
                    }
                }
            }
        }

        return $strContent;
    }

    /**
     * Insert nessesary JS and CSS files
     * 
     * @param type $cssTemplate
     * @param type $templateDefault 
     */
    public function insertJsCss($cssTemplate = FALSE, $templateDefault = FALSE)
    {
        $strPath = TL_SCRIPT_URL . 'system/modules/slideitmoo/html/js/source/';

        $GLOBALS['TL_JAVASCRIPT']['slideItMoo']         = $strPath . 'slideitmooFramework.js';
        $GLOBALS['TL_JAVASCRIPT']['extendedSlideItMoo'] = $strPath . 'slideitmoo.js';
        $GLOBALS['TL_JAVASCRIPT']['powertools']         = $strPath . 'powertools-1.2.0.js';

        if ($templateDefault)
        {
            $GLOBALS['TL_CSS'][] = TL_SCRIPT_URL . 'system/modules/slideitmoo/html/css/' . $cssTemplate . '.css';
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
        $arrFiles = scan(TL_ROOT . '/system/modules/slideitmoo/html/css/');
        $arrCss   = array();
        foreach ($arrFiles as $k => $file)
        {
            if (strtolower(substr($file, -3) == "css"))
            {
                $tmp = substr($file, 0, strlen($file) - 4);
                if ($dc->activeRecord->si_verticalSlide)
                {
                    if (stristr($tmp, 'horizontal'))
                        continue;
                }
                else
                {
                    if (stristr($tmp, 'vertical'))
                        continue;
                }
                $arrCss[$tmp] = $tmp;
            }
        }
        return $arrCss;
    }

    // Copy callbacks ----------------------------------------------------------

    /**
     * Function for global tl_page oncopy callback
     * $GLOBALS['TL_DCA']['tl_page']['config']['oncopy_callback']
     * 
     * @param integer $intId
     * @param DataContainer $dc 
     */
    public function onPageCopyCallback($intId, DataContainer $dc)
    {
        if (!$this->Input->get('childs'))
        {
            $objArticle = $this->Database
                    ->prepare("SELECT id FROM tl_article WHERE pid = ?")
                    ->execute($intId);

            if ($objArticle->numRows > 0)
            {
                while ($objArticle->next())
                {
                    $this->updateContentElem($objArticle->id);
                }
            }
        }
        else if ($this->Input->get('childs') == 1)
        {
            $arrPages = $this->getChildRecords($intId, 'tl_page');

            foreach ($arrPages as $intId)
            {
                $objArticle = $this->Database
                        ->prepare("SELECT id FROM tl_article WHERE pid=?")
                        ->execute($intId);

                if ($objArticle->numRows > 0)
                {
                    while ($objArticle->next())
                    {
                        $this->updateContentElem($objArticle->id);
                    }
                }
            }
        }
    }

    /**
     * Function for global tl_article oncopy callback
     * $GLOBALS['TL_DCA']['tl_article']['config']['oncopy_callback']
     * 
     * @param integer $intId
     * @param DataContainer $dc 
     */
    public function onArticleCopyCallback($intId, DataContainer $dc)
    {
        $this->updateContentElem($intId);
    }

    /**
     * Repair copied module specific content elements
     * 
     * @param integer $intId 
     */
    protected function updateContentElem($intId)
    {
        // Check if is slideItStart element
        $objStartSlideContent = $this->Database
                ->prepare("SELECT * FROM tl_content WHERE pid = ? AND type = 'slideItStart'")
                ->limit(1)
                ->execute($intId);

        if ($objStartSlideContent->numRows == 0)
        {
            return;
        }

        $arrSets = array();

        // Get highest id and set new container Id 
        $objSlider = $this->Database->prepare('SELECT *, CAST(SUBSTRING_INDEX(si_containerId, "_", -1) AS UNSIGNED ) as counter FROM tl_content WHERE type = "slideItStart" ORDER BY counter desc LIMIT 0,1')
                ->execute()
                ->fetchAssoc();

        $sliderId       = explode("_", $objSlider['si_containerId']);
        $strNewSliderId = "slider_" . ($sliderId[1] + 1);

        // Get appendant slideItEnd element
        $objEndSlideContent = $this->Database
                ->prepare("SELECT * FROM tl_content WHERE pid = ? AND type = 'slideItEnd' AND si_containerId = ?")
                ->execute($objStartSlideContent->pid, $objStartSlideContent->si_containerId);

        // Set slideItStart update array
        $arrSets[$objStartSlideContent->id] = array('si_containerId' => $strNewSliderId, 'si_children'    => $objEndSlideContent->id);

        // Set slideItEnd update array
        $arrSets[$objEndSlideContent->id] = array('si_containerId' => $strNewSliderId, 'si_children'    => $objStartSlideContent->id);

        if (count($arrSets) > 0)
        {
            foreach ($arrSets As $intId => $arrSet)
                $this->Database
                        ->prepare("UPDATE tl_content %s WHERE id = ?")
                        ->set($arrSet)
                        ->execute($intId);
        }
    }

}

?>
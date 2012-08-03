<?php

if (!defined('TL_ROOT'))
    die('You cannot access this file directly!');

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
class slideItHelper extends Backend
{

    /**
     * Current object instance (Singleton)
     * @var slideItHelper
     */
    protected static $_objInstance = NULL;

    /**
     * Prevent constructing the object (Singleton)
     */
    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * Prevent cloning of the object (Singleton)
     */
    final private function __clone()
    {
        
    }

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
     * Check the required extensions and files
     * @param string $strContent
     * @param string $strTemplate
     * @return string
     */
    public function checkExtensions($strContent, $strTemplate)
    {
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

            // Required files
            $arrRequiredFiles = array(
                'slideItMooFramework' => 'plugins/slideitmoo/LICENSE.txt'
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

            // Check for required files
            foreach ($arrRequiredFiles as $key => $val)
            {
                if (!file_exists(TL_ROOT . '/' . $val))
                {
                    $_SESSION["TL_INFO"] = array_merge($_SESSION["TL_INFO"], array($val => 'Please install the required file/extension <strong>' . $key . '</strong>'));
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
        $GLOBALS['TL_JAVASCRIPT']['slideItMoo']         = TL_PLUGINS_URL . 'plugins/slideitmoo/js/1.3.0/slideitmoo.js';
        $GLOBALS['TL_JAVASCRIPT']['extendedSlideItMoo'] = TL_SCRIPT_URL . 'system/modules/slideitmoo/html/js/slideitmoo.js';

        if ($templateDefault)
        {
            $GLOBALS['TL_CSS'][] = TL_PLUGINS_URL . 'plugins/slideitmoo/css/' . $cssTemplate . '.css';
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
        $arrFiles = scan(TL_ROOT . '/plugins/slideitmoo/css/');
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
        
        $sliderId                     = explode("_", $objSlider['si_containerId']);
        $strNewSliderId = "slider_" . ($sliderId[1] + 1);

        // Get appendant slideItEnd element
        $objEndSlideContent = $this->Database
                ->prepare("SELECT * FROM tl_content WHERE pid = ? AND type = 'slideItEnd' AND si_containerId = ?")
                ->execute($objStartSlideContent->pid, $objStartSlideContent->si_containerId);
        
        // Set slideItStart update array
        $arrSets[$objStartSlideContent->id] = array('si_containerId' => $strNewSliderId, 'si_children' => $objEndSlideContent->id);
        
        // Set slideItEnd update array
        $arrSets[$objEndSlideContent->id] = array('si_containerId' => $strNewSliderId, 'si_children' => $objStartSlideContent->id);
        
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
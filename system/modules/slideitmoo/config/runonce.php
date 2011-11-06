<?php

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
 * @copyright  MEN AT WORK 2011 
 * @package    slideItMoo
 * @license    GNU/LGPL 
 * @filesource
 */

// Be silenced
@error_reporting(0);
@ini_set("display_errors", 0);

/**
 * Runonce Job
 */
class runonceJob extends Backend
{

    //- Vars -------------------------------------------------------------------

    protected $arrValues;

    //- Core Functions ---------------------------------------------------------

    public function __construct()
    {
        // Call parent
        parent::__construct();

        // Imports
        $this->import("Database");

        // Init vars
        $this->arrValues = array();
    }

    /**
     * Run job
     */
    public function run()
    {
        try
        {
            // Check if we have to run this job
            if ($this->checkDatabase())
            {
                // Load values
                $this->loadValues();
                // Cheange tables
                $this->alertTables();
                // Save values back to database
                $this->saveValues();
            }
        }
        catch (Exception $exc)
        {
            // Write log 
            $this->log("Error by updating tables for slideItMoo", "slideItMoo Runonce", TL_ERROR);
        }
    }

    //- Helper Functions -------------------------------------------------------

    /**
     * Check if we have to run this job. 
     * 
     * @return boolean
     */
    protected function checkDatabase()
    {
        if ($this->Database->fieldExists('si_itemsMargin', 'tl_content', true))
        {
            $objResult = $this->Database->prepare("SHOW COLUMNS FROM tl_content LIKE 'si_itemsMargin'")
                    ->execute()
                    ->next();

            if ($objResult->Type == "blob")
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Load and update values
     */
    protected function loadValues()
    {
        $objResult = $this->Database->prepare("SELECT `id`, `si_itemsMargin` FROM tl_content WHERE `si_itemsMargin` != NULL OR `si_itemsMargin` != ''")->execute();

        while ($objResult->next())
        {
            $arrMargin = deserialize($objResult->si_itemsMargin);
            $arrNewMargin = array("bottom" => '', "left" => '', "right" => '', "top" => '', "unit" => "px");

            if (is_array($arrMargin))
            {
                $arrNewMargin["left"] = $arrMargin[0];
                $arrNewMargin["right"] = $arrMargin[1];

                $this->arrValues[$objResult->id] = array("si_itemsMargin" => serialize($arrNewMargin));
            }
        }
    }

    /**
     * Save values back to database
     */
    protected function saveValues()
    {
        foreach ($this->arrValues as $key => $value)
        {
            $this->Database->prepare("UPDATE `tl_content` %s WHERE id=?")->set($value)->execute($key);
        }
    }

    /**
     * Change table
     */
    protected function alertTables()
    {
        $this->Database->query("ALTER TABLE `tl_content` CHANGE `si_itemsMargin` `si_itemsMargin` blob NULL;");
    }

}

// Run once
$objRunonceJob = new runonceJob();
$objRunonceJob->run();

?>

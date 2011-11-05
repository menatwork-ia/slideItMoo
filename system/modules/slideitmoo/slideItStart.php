<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * @copyright  MEN AT WORK 2011 
 * @package    slideItMoo
 * @license    GNU/LGPL 
 * @filesource
 */


/**
 * Class slideItStart 
 *
 * @copyright  MEN AT WORK 2011 
 * @package    Controller
 */
class slideItStart extends ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_slideItStart';

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### '.$GLOBALS['TL_LANG']['CTE']['slideItStart'][0].' ###';
			
			return $objTemplate->parse();
		}

		return parent::generate();
	}
	
	/**
	 * Generate module
	 */
	protected function compile()
	{
		/**
		 * Insert JS and CSS Code
		 */
		if (version_compare(VERSION . '.' . BUILD, '2.10.0', '<'))
		{
			$GLOBALS['TL_JAVASCRIPT'][] = 'plugins/slideitmoo/js/1.2.5/slideitmoo_src.js';
		}
		else
		{
			$GLOBALS['TL_JAVASCRIPT'][] = TL_PLUGINS_URL . 'plugins/slideitmoo/js/1.3.0/slideitmoo_src.js';
		}
		if ($this->si_templateDefault) 
		{
		if (version_compare(VERSION . '.' . BUILD, '2.10.0', '<'))
		{
			$GLOBALS['TL_CSS'][] = 'plugins/slideitmoo/css/' . $this->si_cssTemplate . '.css';
		}
		else 
		{
			$GLOBALS['TL_CSS'][] = TL_PLUGINS_URL . 'plugins/slideitmoo/css/' . $this->si_cssTemplate . '.css';
			}
		}
		
		$dimensions = deserialize($this->si_itemsDimension);
		$this->Template->si_itemsWidth = $dimensions[0];
		$this->Template->si_itemsHeight = $dimensions[1];
		
		$margin = deserialize($this->si_itemsMargin);
		$this->Template->si_itemsMarginTop = $margin['top'];
		$this->Template->si_itemsMarginRight = $margin['right'];
		$this->Template->si_itemsMarginBottom = $margin['bottom'];
		$this->Template->si_itemsMarginLeft = $margin['left'];
		$this->Template->si_itemsMarginUnit = $margin['unit'];
		
		$this->Template->si_itemsOverallWidth = $this->Template->si_itemsWidth + $margin[0] + $margin[1];

	}
}

?>
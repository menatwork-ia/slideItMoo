-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
	`si_containerId` varchar(255) NOT NULL default '',
	`si_children` varchar(255) NOT NULL default '',
	`si_itemsVisible` varchar(255) NOT NULL default '',
	`si_elementsSlide` varchar(255) NOT NULL default '',
	`si_itemsSelector` varchar(255) NOT NULL default '',
	`si_duration` varchar(255) NOT NULL default '',
	`si_autoEffectTransition` char(1) NOT NULL default '',
	`si_effectTransition` varchar(64) NOT NULL default '',
	`si_effectEase` varchar(64) NOT NULL default '',
	`si_autoSlide` varchar(255) NOT NULL default '',
	`si_autoSlideDefault` char(1) NOT NULL default '',
	`si_templateDefault` char(1) NOT NULL default '',
	`si_itemsDimension` varchar(255) NOT NULL default '',
	`si_itemsMargin` varchar(255) NOT NULL default '',
	`si_cssTemplate` varchar(255) NOT NULL default '',
	`si_showControls` char(1) NOT NULL default ''
	`si_mouseWheelNav` char(1) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

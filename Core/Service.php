<?php

/**
 * imva.biz Devloper's Guide
 *
 *
 *
 * For redistribution in the provider's network only.
 *
 * Weitergabe außerhalb des Anbieternetzwerkes verboten.
 *
 * This software is intellectual property of imva.biz respectively of its author and is protected
 * by copyright law. This software product is provided "as it is" with no guarantee.
 * You are free to use this software and to modify it in order to fit your requirements.
 * Any modification, copying, redistribution, transmission outsitde of the provider's platforms
 * is a violation of the license agreement and will be prosecuted by civil and criminal law.
 * By applying and using this software product, you agree to the terms and conditions of use.
 *
 * Diese Software ist geistiges Eigentum von imva.biz respektive ihres Autors und ist durch das
 * Urheberrecht geschützt. Diese Software wird ohne irgendwelche Garantien und "wie sie ist"
 * angeboten.
 * Sie sind berechtigt, diese Software frei zu nutzen und auf Ihre Bedürfnisse anzupassen.
 * Jegliche Modifikation, Vervielfältigung, Redistribution, Übertragung zum Zwecke der
 * Weiterentwicklung außerhalb der Netzwerke des Anbieters ist untersagt und stellt einen Verstoß
 * gegen die Lizenzvereinbarung dar.
 * Mit der Übernahme dieser Software akzeptieren Sie die zwischen Ihnen und dem Herausgeber
 * festgehaltenen Bedingungen. Der Bruch dieser Bedingungen kann Schadensersatzforderungen nach
 * sich ziehen.
 *
 * (EULA-13/7-OS)
 *
 * (c) 2013-2016 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5-20/4/13
 * v 2.0.0
 */

namespace Imva\DevelopersGuide\Core;

use OxidEsales\Eshop\Core\DatabaseProvider;
use \OxidEsales\Eshop\Core\Registry;

class Service extends \OxidEsales\Eshop\Core\Model\BaseModel
{
	public $sModuleId		=	null;							// Module ID, for later usage in imva_services
	public $sModuleVersion	=	null;							// Module Version (for template)
	public $oThisModule		=	null;							// oxModule instance for this module

	/**
	 * Construct
	 * 
	 * @param null
	 * @return null
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->sModuleId = 'imva.biz/developersguide';
		
		// Get the module version
		$this->oThisModule = oxNew('oxModule');
		$this->oThisModule->load($this->sModuleId);
		$this->sModuleVersion = $this->oThisModule->getInfo('version');
	}

	/**
	 * A small configuration getter, returns the configuration value of the module setting(s).
	 * 
	 * @param null
	 * @return boolean
	 */
	public function askMe()
	{
		return Registry::getConfig()->getConfigParam('imva_devguide_requestonaction');
	}

	/**
	 * Is auto-reactivation enabled?
	 * 
	 * @param null
	 * @return boolean
	 */
	public function isAutoRevive()
	{
		return Registry::getConfig()->getConfigParam('imva_devguide_enableautorevive');
	}

    /**
     * Check whether to auto-revive of 3rd party modules
     *
     * @return boolean
     */
	public function revive3rdParty()
	{
		return Registry::getConfig()->getConfigParam('imva_devguide_revive3rdparty');
	}
	
	/**
	 * POST/GET parameter getter
	 * 
	 * @param string
	 * @return string
	 */
	public function getP($sString = '')
	{
		return Registry::getConfig()->getRequestParameter($sString);
	}
	
	/**
	 * Name of the current class
	 * For usage with forms.
	 * 
	 * @param null
	 * @return string
	 */
	public function getCurrentCl()
	{
		return Registry::getConfig()->getActiveView()->getClassName();
	}
	
	/**
	 * Determines, wheather this installation has subshops.
	 * @see As seen in imva_service
	 * 
	 * @param null
	 * @return boolean
	 */
	public function hasSubshops()
	{
	    $iShops = DatabaseProvider::getDb()->getOne("SELECT COUNT(`OXID`) FROM `oxshops`;");
		if ($iShops > 1){
			return true;
		}
		
		return false;
	}

	/**
	 * Get hyperlinks for footer
	 * 
	 * @param string
	 * @return string
	 */
	public function getFooterLink($sInfo)
	{
		$aUrls = array(
            'manuf'		=>	'https://imva.biz?ref=devguide',
            'manual'	=>	'https://www.ackis-oxid.de/tag/developers-guide/',
		);
		
		return $aUrls[$sInfo];
	}
}

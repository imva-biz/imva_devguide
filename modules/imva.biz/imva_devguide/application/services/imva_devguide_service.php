<?php

/**
 * imva.biz Developer's Guide
 * 
 * 
 * 
 * For redistribution in the provicer's network only.
 *
 * Weitergabe außerhalb des Anbieternetzwerkes verboten.
 *
 *
 *
 * This software is intellectual property of imva.biz respectively of its author and is protected
 * by copyright law. This software product is provided "as it is" with no guarantee.
 *
 * You are free to use this software and to modify it in order to fit your requirements.
 *
 * Any modification, copying, redistribution, transmission outsitde of the provider's platforms
 * is a violation of the license agreement and will be prosecuted by civil and criminal law.
 *
 * By applying and using this software product, you agree to the terms and conditions of use.
 *
 *
 *
 * Diese Software ist geistiges Eigentum von imva.biz respektive ihres Autors und ist durch das
 * Urheberrecht geschützt. Diese Software wird ohne irgendwelche Garantien und "wie sie ist"
 * angeboten.
 *
 * Sie sind berechtigt, diese Software frei zu nutzen und auf Ihre Bedürfnisse anzupassen.
 *
 * Jegliche Modifikation, Vervielfältigung, Redistribution, Übertragung zum Zwecke der
 * Weiterentwicklung außerhalb der Netzwerke des Anbieters ist untersagt und stellt einen Verstoß
 * gegen die Lizenzvereinbarung dar.
 *
 * Mit der Übernahme dieser Software akzeptieren Sie die zwischen Ihnen und dem Herausgeber
 * festgehaltenen Bedingungen. Der Bruch dieser Bedingungen kann Schadensersatzforderungen nach
 * sich ziehen.
 *
 *
 *
 * (EULA-13/7)
 * 
 * 
 *
 * (c) 2013 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5-8/1
 * v 0.8
 *
 */

class imva_devguide_service extends oxbase
{
	public $sModuleVersion = '';		// Module Version (for template)
	public $oConf = null;				// oxconfig
	
	
	
	/**
	 * Construct
	 * 
	 * @param null
	 * @return null
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->oConf = $this->getConfig();
		
		// Get the module version
		$oTmpModuleObj = oxNew('oxmodule');
		$oTmpModuleObj->load('imva_devguide');
		$this->sModuleVersion = $oTmpModuleObj->getInfo('version');
	}

	
	
	/**
	 * A small configuration getter, returns the configuration value of the module setting(s).
	 * 
	 * @param null
	 * @return boolean
	 */
	public function askMe()
	{
		$blReturn = $this->oConf->getConfigParam('imva_devguide_requestonaction');
		return $blReturn;
	}
	
	
	
	/**
	 * CONFIG/POST/GET/REQUEST parameter getter
	 * 
	 * @param string
	 * @return string
	 */
	public function getP($sString = '')
	{
		return $this->oConf->getRequestParameter($sString);
	}
	
	
	
	/**
	 * Name of the current class
	 * For use with forms.
	 * 
	 * @param null
	 * @return string
	 */
	public function getCurrentCl()
	{
		return oxConfig::getInstance()->getActiveView()->getClassName();
	}
	
	
	
	/**
	 * Shop edition
	 * Multishop feature for Enterprise Edition only
	 * 
	 * @param null
	 * @return string
	 */
	public function isEE()
	{
		if (oxConfig::getInstance()->getActiveShop()->oxshops__oxedition->value == 'EE'){
			return true;
		}
		return false;
	}
}
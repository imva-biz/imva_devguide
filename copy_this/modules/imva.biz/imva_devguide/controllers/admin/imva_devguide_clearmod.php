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
 * 13/7/5-15/11/22
 * v 0.9.21
 *
 */

class imva_devguide_clearmod extends imva_devguide_base
{

	

	public $thirdPartyRevive		=	false;
	public $aRevived3rdPartyModules	=	null;
	
	
	
	/**
	 * Init
	 * 
	 * Provide Service.
	 * @param null
	 * @return null
	 */
	public function init()
	{
		parent::init();
		
		// Determine, whether dialogues are enabled and confirmed OR not enabled
		if (($this->oServ->askMe() and $this->oServ->getP('blconfirm'))
				or ($this->oServ->askMe() !== true and $this->oServ->getP('blconfirm') == null))
		{
			
			$this->blSuccess = false;
			
			// Call clear function
			if ($this->oServ->getP('shops') == 'all')
			{
				$this->_clearModuleCache();
				$this->blAllcleared = true;
			}
			else
			{
				$this->_clearModuleCache($this->sShopId);
			}
			
			// auto-revive modules
			if ($this->oServ->isAutoRevive())
			{
				$this->_revive();
			}
		}
	}
	
	
	
	/**
	 * Render
	 * 
	 * @return string
	 */	
	public function render()
	{
		parent::render();		
		return 'imva_devguide_clearmod.tpl';
	}
	
	
	
	/**
	 * Generates an unique identifier for database entries.
	 * 
	 * @param null
	 * @return string
	 */
	private function genId()
	{
		return oxUtilsObject::getInstance()->generateUId();
	}
	
	
	
	/**
	 * Clear module cache
	 * Cleans all module configuration entries from the database.
	 * Use with shop ID to clear only modules for a certain subshop (OXID EE only).
	 * No shop ID bypassed expects 
	 * 
	 * @param string
	 * @return null
	 */
	private function _clearModuleCache($sShopId = '')
	{		
		$oDb = oxDb::getDb();
		
		$aModuleCfgFields = array(
				'aDisabledModules',
				'aModuleFiles',
				'aModules',
				'aModuleVersions',
				'aModuleTemplates',
				'aModuleEvents',
				'aModulePaths'
		);
		
		foreach ($aModuleCfgFields as $sField){
			$oDb->startTransaction();
			
			$sSelect = 'delete from oxconfig where oxvarname = "'.$sField.'"';
		
			// empty if all subshops were selected
			if ($sShopId){
				$sSelect .= ' and oxshopid = "'.$sShopId.'"';
			}
			
			$sSelect .= ';';
			
			$oDb->execute($sSelect);
			$oDb->commitTransaction();
		}
		
		
		
		// Clear oxtplblocks from module settings
		$sSelect = 'delete from oxtplblocks';

		// empty if all subshops were selected
		if ($sShopId){
			$sSelect .= ' where oxshopid = "'.$sShopId.'"';
		}
		
		$sSelect .= ';';
		$oDb->execute($sSelect);
		
		$this->_pause();
		
		// Cleanup cached configuration
		$this->_clearCachedConfig();
	}
	
	
	
	/**
	 * Revives the Devguide Module by using the Module Installer
	 * 
	 * @param null
	 * @return null
	 */
	private function _revive()
	{		
	    $this->blSuccess = $this->_activateModule('imva_devguide');
	    
	    if ($this->oServ->revive3rdParty()){
	    	
	    	$this->_clearModuleCache('oxbaseshop'); // --> bringt nichts, wenn Drittanbietermodule aktiviert werden sollen
	    	$this->_activateModule('imva_devguide');
	    	
	    	$aReviveThese = $this->oServ->oConf->getConfigParam('imva_devguide_3rdpartymdllist');
	    	
	    	foreach ($aReviveThese as $sModuleID){
	    		$this->_pause();
	    		$this->_activateModule($sModuleID);
	    	}
	    	
	    	$this->thirdPartyRevive = true;
	    }
	}
	
	
	
	/**
	 * Revives a given module using the Module Installer
	 * 
	 * @param string
	 * @return boolean
	 */
	private function _activateModule($sModuleId)
	{
		$oModule = oxNew('oxModule');
		$oModule->load($sModuleId);
		if ($oModule){
		    $oModuleCache = oxNew('oxModuleCache', $oModule);
		    $oModuleInstaller = oxNew('oxModuleInstaller', $oModuleCache);	    
		    $oModuleInstaller->activate($oModule);
		    
		    $this->_pause();
		    
		    unset ($oModule,$oModuleCache,$oModuleInstaller);
		    
		    $blRtn = true;
		}
		else{
			$blRtn = false;
		}
		
		return $blRtn;
	}
	
	
	
	/**
	 * Clears the cached module configuration from shop's compile directory.
	 * 
	 * @param null
	 * @return boolean
	 */
	private function _clearCachedConfig()
	{		
		$aFileSuffixes = array('adisabledmodules','amodulepaths','amodulefiles','amodules');	// Suffixes of cache files.
		$sPath = oxRegistry::getConfig()->getConfigParam('sCompileDir');
		
		foreach ($aFileSuffixes as $sFileSuffix){
			$sFileName = 'config.'.$this->sShopId.'.'.$sFileSuffix.'.txt';	// Naming shape of cache files.
		
			if (file_exists($sPath.$sFileName))
			{
				@unlink($sPath.$sFileName);
			}
		}
		
		$this->_pause();
	}
	
	
	
	/**
	 * Force pause for 0.25 seconds.
	 * (e.g. to make sure all files have been deleted)
	 * 
	 * @param null
	 * @return null
	 */
	private function _pause()
	{
		usleep(250000);
	}
}

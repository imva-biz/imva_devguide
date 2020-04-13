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
 * (c) 2013-2020 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5-20/4/10
 * v 2.0.0
 */

namespace Imva\DevelopersGuide\Controller\Admin;

use \OxidEsales\Eshop\Core\Registry;

class ModulesCleaner extends BaseController
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
		if (($this->getDevguideService()->askMe()
                and $this->getDevguideService()->getP('blconfirm'))
                    or ($this->getDevguideService()->askMe() !== true
                        and $this->getDevguideService()->getP('blconfirm') == null))
		{
			
			$this->blSuccess = false;
			
			// Call clear function
			if ($this->getDevguideService()->getP('shops') == 'all'){
				$this->_clearModuleCache();
				$this->blAllcleared = true;
			}
			else{
				$this->_clearModuleCache($this->sShopId);
			}
			
			// auto-revive modules
			if ($this->getDevguideService()->isAutoRevive()){
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
        $Db = oxDb::getDb(oxDb::FETCH_MODE_ASSOC);

        $aModuleCfgFields = array(
            'aDisabledModules',
            'aModuleFiles',
            'aModules',
            'aModuleVersions',
            'aModuleTemplates',
            'aModuleEvents',
            'aModulePaths'
        );

        foreach ($aModuleCfgFields as $sField) {
            $Db->startTransaction();

            $sSelect = "DELETE FROM `oxconfig` WHERE `OXVARNAME` = '" . $sField . "'";

            // empty if all subshops were selected
            if ($sShopId) {
                $sSelect .= " AND `OXSHOPID` = '" . $sShopId . "'";
            }

            $sSelect .= ";";

            $Db->execute($sSelect);
            $Db->commitTransaction();
        }


        // Clear oxtplblocks from module settings
        $sSelect = "DELETE FROM `oxtplblocks`";

        // empty if all subshops were selected
        if ($sShopId) {
            $sSelect .= " WHERE `OXSHOPID` = '".$sShopId."'";
        }

        $sSelect .= ';';
		$Db->execute($sSelect);

        // Cleanup cached configuration
        $this->_clearCachedConfig();

        //if ($this->getDevguideService()->isAutoRevive()) {

            // Restore blocks
            $Db->startTransaction();
            $restoreBlocks = "
                REPLACE INTO `oxtplblocks` (`OXID`, `OXACTIVE`, `OXSHOPID`, `OXTEMPLATE`, `OXBLOCKNAME`, `OXPOS`, `OXFILE`, `OXMODULE`) VALUES
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_devguide_confirm',	1,	'View/Block/imva_devguide_dialogue.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_devguide_footer',	1,	'View/Block/imva_devguide_footer.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_devguide_header',	1,	'View/Block/imva_devguide_header.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_devguide_confirm',	1,	'View/Block/imva_devguide_dialogue.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_devguide_footer',	1,	'View/Block/imva_devguide_footer.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_devguide_header',	1,	'View/Block/imva_devguide_header.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_clearmod.tpl', 'imva_devguide_confirm',	1,	'View/Block/imva_devguide_dialogue.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_clearmod.tpl', 'imva_devguide_footer',	1,	'View/Block/imva_devguide_footer.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_clearmod.tpl', 'imva_devguide_header',	1,	'View/Block/imva_devguide_header.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_main.tpl', 'imva_devguide_footer',	1,	'View/Block/imva_devguide_footer.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_main.tpl', 'imva_devguide_header',	1,	'vView/Block/imva_devguide_header.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_logviewer.tpl', 'imva_devguide_footer',	1,	'View/Block/imva_devguide_footer.tpl',	'imva_devguide'),
                ('".$this->genId()."', 1, '".$sShopId."', 'imva_devguide_logviewer.tpl', 'imva_devguide_header',	1,	'View/Block/imva_devguide_header.tpl',	'imva_devguide');
            ";
            

            $Db->execute($restoreBlocks);
            $Db->commitTransaction();

            // Restore module config.
            $DevguideConfigurations = array(
                'aModulePaths' => array(
                    'imva_devguide' => 'imva.biz/imva_devguide',
                ),
                'aModuleTemplates' => array(
                    'imva_devguide' => array(
                        'imva_devguide_clearmod.tpl'		=>	'imva.biz/developersguide/View/Admin/tpl/imva_devguide_clearmod.tpl',
                        'imva_devguide_cleartemp.tpl'		=>	'imva.biz/developersguide/View/Admin/tpl/imva_devguide_cleartemp.tpl',
                        'imva_devguide_logviewer.tpl'		=>	'imva.biz/developersguide/View/Admin/tpl/imva_devguide_logviewer.tpl',
                        'imva_devguide_main.tpl'			=>	'imva.biz/developersguide/View/Admin/tpl/imva_devguide_main.tpl',
                        'imva_devguide_rebuildviews.tpl'	=>	'imva.biz/developersguide/View/Admin/tpl/imva_devguide_rebuildviews.tpl',
                        'imva_devguide_cancelled.tpl'		=>	'imva.biz/developersguide/View/Admin/tpl/inc/imva_devguide_cancelled.tpl',
                        'imva_devguide_redo.tpl'			=>	'imva.biz/developersguide/View/Admin/tpl/inc/imva_devguide_redo.tpl',
                    ),
                ),
                'aDisabledModules' => array(),
                'aModuleFiles' => array(
                    'imva_devguide' =>
                        //@Todo
                        array(
                            'base' => 'imva.biz/developersguide/Controllers/Admin/imva_devguide_base.php',
                            'service' => 'imva.biz/developersguide/core/imva_devguide_service.php',
                            'base' => 'imva.biz/developersguide/core/imva_devguide_basefunctions.php',
                            'clearmod' => 'imva.biz/developersguide/Controllers/Admin/imva_devguide_clearmod.php',
                            'cleartemp' => 'imva.biz/developersguide/Controllers/Admin/imva_devguide_cleartemp.php',
                            'logviewer' => 'imva.biz/developersguide/Controllers/Admin/imva_devguide_logviewer.php',
                            'main' => 'imva.biz/developersguide/Controllers/Admin/imva_devguide_main.php',
                            'viewsRebuilder' => 'imva.biz/developersguide/Controllers/Admin/imva_devguide_rebuildviews.php',
                        ),
                ),
                'aModuleEvents' => array(),
                'aModuleVersions' => array(
                    'imva_devguide' => '1.0.0',
                ),
                'aModules' => array(
                    'oxviewconfig' => 'imva.biz/developersguide/core/imva_devguide_oxviewconfig',
                ),
            );

            $shopId = Registry::getConfig()->getActiveShop()->getId();

            foreach ($DevguideConfigurations as $DevguideConfig => $item) {
                $SqlStatement = "
                    REPLACE INTO `oxconfig` (`OXID`, `OXSHOPID`, `OXVARNAME`, `OXVARTYPE`, `OXVARVALUE`)
                    VALUES (
                        '".md5('imva'.$DevguideConfig.$shopId.'24486')."',
                        '".$shopId."',
                        '".$DevguideConfig."',
                        'aarr',
                        ENCODE('".addslashes(serialize($DevguideConfigurations[$DevguideConfig]))."',
                        '".Registry::getConfig()->getConfk."')
                    );
                ";

                $Db->execute($SqlStatement);
            }

            $this->blSuccess = true;
//        }
		
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
	    if ($this->getDevguideService()->revive3rdParty()){

            // @ToDo: Not helpful when attempting to activate 3rd party modules
            $this->_clearModuleCache(Registry::getConfig()->getActiveShop()->getId());

	    	$aReviveThese = Registry::getConfig()->getConfigParam('imva_devguide_3rdpartymdllist');

	    	foreach ($aReviveThese as $sModuleID){
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
		    $oModuleInstaller = oxNew('oxModuleInstaller');
		    $oModuleInstaller->deactivate($oModule);
		    $oModuleInstaller->activate($oModule);
		    unset($oModule, $oModuleCache, $oModuleInstaller);
		    
		    return true;
		}
		
		return false;
	}
	
	
	
	/**
	 * Clears the cached module configuration from shop's compile directory.
	 * 
	 * @param null
	 * @return boolean
	 */
	private function _clearCachedConfig()
	{
        // Suffixes of cache files.
	    $aFileSuffixes = array(
		    'adisabledmodules',
            'amodulepaths',
            'amodulefiles',
            'amodules'
        );

		$compileDir = Registry::getConfig()->getConfigParam('sCompileDir');
		
		foreach ($aFileSuffixes as $sFileSuffix){
			$sFileName = 'config.'.$this->sShopId.'.'.$sFileSuffix.'.txt';	// Naming shape of cache files.
		
			if (file_exists($compileDir.$sFileName))
			{
				@unlink($compileDir.$sFileName);
			}
		}
	}
}

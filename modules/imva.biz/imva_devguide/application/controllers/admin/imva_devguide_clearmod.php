<?php

/**
 * imva.biz Developer's Guide
 * Main Class
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
 * (EULA-13/7-OS)
 * 
 * 
 *
 * (c) 2013-2014 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5-14/2/11
 * v 0.8.5
 *
 */

class imva_devguide_clearmod extends oxAdminView
{
	private $_sShopId	=	null;								// The shop ID. Prepared for usage in EE (maybe soon)
	public $blSuccess	=	false;								// Successful?
	public $blFail		=	false;								// Failure
	public $blAllcleared=	false;								// Status
	public $oServ		=	null;								// Devguide Service
	
	
	
	/**
	 * Construct
	 * 
	 * Provice Service.
	 * @param null
	 * @return null
	 */
	public function init()
	{
		parent::init();
		$this->oServ = oxNew('imva_devguide_service');			// Service
		$this->_sShopId = oxRegistry::getConfig()->getShopId();	// Fill (sub)-shop ID
	}
	
	
	
	/**
	 * Render
	 * @return string
	 */	
	public function render()
	{
		parent::render();
		
		// Determine, whether dialogues are enabled and confirmed OR not enabled
		if (($this->oServ->askMe() and $this->oServ->getP('blconfirm')) or ($this->oServ->askMe() !== true and $this->oServ->getP('blconfirm') == null)){
			
			$this->blSuccess = false;
			
			// Call clear function
			if ($this->oServ->getP('shops') == 'all'){
				$this->_clearModuleCache();
				$this->blAllcleared = true;
			}
			else{
				$this->_clearModuleCache(oxRegistry::getConfig()->getShopId());
			}
			
			if ($this->oServ->isAutoRevive()){
				$this->_reviveDevguide();
			}
		}
		
		if ($this->blSuccess and $this->blFail){
			echo 'ERROR_PARADOX';
		}
		
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
		// Clear oxconfig from module settings 
		$sSelect = 'delete from oxconfig where oxvarname in ("aDisabledModules","aLegacyModule","aModuleFiles","aModulePaths","aModules","aModuleTemplates")';

		if ($sShopId){
			$sSelect .= ' and oxshopid = "'.$sShopId.'"';
		}
		
		$sSelect .= ';';
		oxDb::getDb(true)->execute($sSelect);
		
		
		
		// Clear oxtplblocks from module settings
		$sSelect = 'delete from oxtplblocks';
				
		if ($sShopId){
			$sSelect .= ' where oxshopid = "'.$sShopId.'"';
		}
		
		$sSelect .= ';';
		oxDb::getDb(true)->execute($sSelect);
		
		
		
		// Cleanup cached configuration
		$this->_clearCachedConfig();
	}
	
	
	
	/**
	 * Revives the Devguide Module by updating the database
	 * 
	 * @param null
	 * @return null
	 */
	private function _reviveDevguide()
	{
		// Insert into oxconfig
		$sSelectHead = "INSERT INTO `oxconfig` (`OXID`, `OXSHOPID`, `OXMODULE`, `OXVARNAME`, `OXVARTYPE`, `OXVARVALUE`, `OXTIMESTAMP`) VALUES ";

		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModules', 'aarr', 0x4dbaeb2d768d, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleFiles', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989301e2665d92c9b9aeaa0809915a69e35a1beb72bf57e40852ad3afe3193e109b6418c78226be107ec14781e20d88b893749d2b734a56eb2c184680de313668086025b8d38fd5c4985424bb7358ba114953c706935cf5ec5388d794019fa711e60022b013a3650cdfe5b0b21961d31e5216e2070cc8b2718c9ec1b597ae6a111a501ac1aaae03c421bb8793f2bb18362ef04b10709e62fac9198f6b11b6ede49004b0978da05d0c59dc0805b7b663f3ce40035549831d25e3b7a50013b9ec74843a11cef1b721e416b4368e84e3c329ba920e28b292ce8fc92bdba20fc1e3e142c6bd530cf6cb3363cc99486f6a6f5426c1b1e413ee3f4595915dfd998fb98b5f8f3797ac452cf8b9a86896091724a0c8e2680316284c20570e35bb6caf9cc4b80cd954400f0428d09a876b14072cbb7a4df22d76a4b4b94c16dc2056d7dcd9344f559a54037437af3b58bb80c7d0c767995852d2f6baecee0ae4e4aaae3f3e07e996df3b8cd7a91e04368402fc4b9a91f9fe14701c744b67209e45fc720db2f2dd568e2cce25e2dc5c1e2718f64d502d5e2a46a87ae280e39829de525c3af46ea0d7360d90608e5096847b6f3d2192d1453d890864efa9858e8a20fda3b2deae101dd809d1bce34c1dd153f2f706fcd6f23351b0d788367eb66a557c33dbd29eb074d9f8180cee3fd2045bf3bee68f75b9203f427398cb22491ee048ea7e500c27589127191ee59c0c99ba42c6bc71c537e36f730861f311fa99429b5d48d2b5350f7c484b9b60fcb1421fba95a20e98308c63cbf237dc1d69fe9b767cf2d01d132df46687fa488, '');";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aLegacyModules', 'aarr', 0x307865386533, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aDisabledModules', 'arr', 0x4dbab5257eed47fec7dfa51955520539b3d3ec97a4fa8ea89db6b1fcd57bca92f14a035636800beda6558543bd13f745e891fa081fbb2dbbaef4bc626328e88a2fa573e8ee11b18b8b6a19cfaa29b873017a35d2a333c211be1323b0855d2ff242dbdfc3a03d34d597b81ae13c0fabad8c4f871576c92881f541c1366b5022b380b8aac9838e9b2f62a9cb9aecd6ff59f1984ecd78e14227f0fc194df73eb514c72465bb67f06d7a022ee379d371ed421e3c898ae5a35a8759dde0a4cce184576d36ccca4100ead363a1866bc4610ad53132d4c7, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleTemplates', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989301e2c05c93c8b8af1a0a0b93586be15819e970bd55e60a50af77721f70a6aa501e8fdfbb8449478112c74946191d0f1229990863c3bddc846166075d0523df036c192b71492cc4d3faf9b1d55a9f4fdd973d2169dd61d8ffd2f7dc0638d743cee7839f0670cb39cb1341d4010528a0c0b1990364ad6aecd5c1837c7448e450505ca21626d53d03dbd024a3cb39f1d8f5fe1f683ec845a292d6b8ff55327a2ea78281f112eeb7493ac028b09ae1707a9fa7d694c1230b5d6835f015eaffcc5153a085034efe58ecebafbd1e8e9cdd2f05c3f840d20d52e329f375da5deb1521bc1b977790fd0a9d7ba618bb961e88143866c48680e02092ad459bfd8e04a6264eaecb3a444c44218c7fb2e922a1f58a2ba799a46cfcb49334af86a3d3b1fafad93a951d591718ca5043495e4b81ea053acfdaab9c07eb23247c7560064ca5972de4481631e538d0b7248ee70306eed8787a855945a280d2f9af81abf7fcc4341ba18dd6b6c15f137fa53338180b167eb42d865cb9fb107678e239e64e70ad9e4e86690797d19756d61912118f5b2422e017cbdf0746980c379c43b40e3d440d4c42fe20af5d48fd830d00f6af370cf619a219085b267b693fa66584486467d096dc5dc5b47f3e2fdd9168092ae327d36bd6f9071b64, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModulePaths', 'aarr', 0x4dba8e247f475c3ce01f911a9b2cd17d76045561e679f382f8cfe576ddae995c12d298715dae120418b5c2841a7085cf165ea6b1fe74d2823c9f741dd7eb3e9e55d5941047cc18ba6a5f0d944b3fd892a8f818f931f850c19b75993d1a80307769d6c9397c4925e3216f2624d37ace409c55bb477bc48e96b8640201a595f16b8d646484139c831e8cf025337ef6dc30dd5da1d2983fd01f80ea1344e2f31f305ca60864058878ff705c918cd86d793029230705d5541dc60a66349f46dc9c9e4b5945040fd5792f177198fc7ea363bd4340ee26928e9894ff45b529c798599cba2c5f5fbefe25b850774fa70f67a85d965e6babcebff25433ac34a9224ed76881b2641d976ba0853cea06cc57faa4cc613c75a3017e0b5e87e686b55ed1e03872f2b16f9183e6af7bbf5564917ccaa43a75df43c96a6b0b61b7fd40f1e34bb2f9b0bf710bea64bef0d30939dfd2495589c0b47c35e2ebb458323242069b040a11d35875e2ad24d93d75602bfb0f4e6df9a922f87fac715b5a188a4a9d9005e75a3faf42e96e37aafdb2eafaf69bfb4abd61d4a083272b106434a6cbcad230b8f05dea4a48cc182f313d53d8d828695998b5e86b16ae1ec08df49017fd19d44c9f675d, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);		

		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleVersions', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989364f0744fe9749e846441099484, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);

		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleEvents', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f59893a4bbfe, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		
		// Insert into oxtplblocks
		$sSelectHead = "INSERT INTO `oxtplblocks` (`OXID`, `OXACTIVE`, `OXSHOPID`, `OXTEMPLATE`, `OXBLOCKNAME`, `OXPOS`, `OXFILE`, `OXMODULE`, `OXTIMESTAMP`) VALUES ";
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_footer', '1', 'views/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_header', '1', 'views/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_devguide_confirm', '1', 'views/blocks/dialogue.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_footer', '1', 'views/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_header', '1', 'views/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);

		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_devguide_confirm', '1', 'views/blocks/dialogue.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_main.tpl', 'imva_footer', '1', 'views/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_main.tpl', 'imva_header', '1', 'views/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_footer', '1', 'views/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_header', '1', 'views/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_devguide_confirm', '1', 'views/blocks/dialogue.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		// Set Success Flag
		$this->blSuccess = true;
	}
	
	
	
	/**
	 * Clears the cached module configuration from shop cache directory.
	 * 
	 * @param null
	 * @return boolean
	 */
	private function _clearCachedConfig()
	{		
		$aFileSuffixes = array('adisabledmodules','amodulepaths','amodulefiles','amodules');	// Suffixes of cache files.
		$sPath = oxRegistry::getConfig()->getConfigParam('sCompileDir');
		
		foreach ($aFileSuffixes as $sFileSuffix){
			$sFileName = 'config.'.$this->_sShopId.'.'.$sFileSuffix.'.txt';	// Naming shape of cache files.
		
			if (file_exists($sPath.$sFileName)){
				@unlink($sPath.$sFileName);
			}
		}
	}
}
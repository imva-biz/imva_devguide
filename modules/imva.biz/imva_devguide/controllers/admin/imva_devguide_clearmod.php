<?php

/**
 * imva.biz Developer's Guide
 * Main Class
 * 
 * 
 * 
 * For redistribution in the provider's network only.
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
 * (c) 2013-2015 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5-15/10/18
 * v 0.9.12
 *
 */

class imva_devguide_clearmod extends imva_devguide_base
{

	
	
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
		$this->_sShopId = oxRegistry::getConfig()->getShopId();	// Fill (sub)-shop ID
	}
	
	
	
	/**
	 * Render
	 * 
	 * @return string
	 */	
	public function render()
	{
		parent::render();
		
		// Determine, whether dialogues are enabled and confirmed OR not enabled
		if (($this->oServ->askMe() and $this->oServ->getP('blconfirm')) or ($this->oServ->askMe() !== true and $this->oServ->getP('blconfirm') == null))
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
				$this->_clearModuleCache(oxRegistry::getConfig()->getShopId());
			}
			
			if ($this->oServ->isAutoRevive())
			{
				$this->_reviveDevguide();
			}
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

		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModules', 'aarr', 0x4dba322c774f5434e51c9234d0980afb913095046e7c5c88f9569f37b72b8d4d1b15c651abb3e2e64194ec3f903d9a728693959ca9069a1dc9be098c60f434c50dced50833d5fa7ab9e2eb344697f2db34b0baf664d13460, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);

		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModulePaths', 'aarr', 0x4dba8e247f475c8d05109e1594670eefd018882da10a87a4eda0cfb00724b37b7483835d51cc1fe2464340982c9dcb9562f83299ba5fa02216cf6bb2b160fd9a03f79ffe93c51a7140532dfe83cec6dd9bc0b0c32b9a0f69873e115ece2d5f29284d6b7aed5fc456b2068aa1fb688ff6005e6c1675ca8098b6cd090ae33a24e3cddfe3be950d1c2333fbb43823e66b5827d2135a3d0d59308c9dba2b8247659409d1da25c793251a0f7b9b38854c8a9252dcf0649153ff9f5bb2e8a3cbe632b86e352c75b042eeac7f3a0c742f6454df6a4c4c35dc18cb427b2d7f64b579219f9162ceedfb689302e620bd9658a73ae9693e7c52c88e85fd1b4e492591b782ad7d3cec1fbc91198fad436d329871a94c916766371c9b74798d52859ca57b7bcc45cf07a30f5531624929fdaaa50994720aa513be49370eff15727b701fdd5a8e822be17e04bdb09ea560cf7ab37470c4a751f66f26540957f9efbf8440e362025be0cbf49e002784cdb0d88256b88bd19706cafaa7f4d0224d224b7b9e75a78369ef92c70e8467f0365d316f8c19cc42b569dc19d228241f9c3667ea8124978cb34239c715ee52599a918a67e17f7c35e5d1986f220ab499119e7c43f282df0ddd716f95e7939385352309a3, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleEvents', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989301e2e558970fa9, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleFiles', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989301e24c5f90cbbb1d2c0001995261eb5213e37ab75fec005aa54f77b13df8a75f2e453b7ab1958c5dc5d770aeb217d8fcb5030ab002ff437f6195bfb0f29f9457dd538a284ea0e5c3f7f35e5a83f8925e4debee18ec85bc6f3f113837e843355ede29c5fb3cad9ea6b4d79d7692fc254c24831293312f908c67f73b4238d6f5106fab3746c6d09f4177976d96684f9479fe72e7cdbaffe7acab259100148a3801edfb23a8efd9028bc34302f8d0e1bad0381dbce739d531c88546456a1ce2ee1ceacf787e5cc9ace6a2b0138391d02208cef54ddf005fee24fe78d750e65235aa320e894bd26d84b76118926ea58039ef03c95284b7d72cd52af51196de29f696fb5ba62060544bc33aae071ac825463e24ea8201b452c43e7d919feda64a570d532ba496f10f49b0b0c9f42e12cd65b291c4595f113411f632445368d821b979c9e7f7b86ee056d304c59c80d1e8d57b2bcb9c11c5c7efa71d15207581ba097c9fdfe9f186a2447fa96947b51a71d15ba1faa163762380fd9aae83eb59e93894dd3d6f84813f652a3369479a26ff0e7654693903a4d3d41fa47fba83610d845f8b02b463233a9f2138fe190f8ebaed953ccd001b7eed7660ed06047908d3b326ad1ccc29228ab1944155d46bdd11a3fbbf6bcb01710f705f32f07876210c97d53c6dbd1f0915cc743b18a0b31416de5ad2c8c26faf2499b8ede699f78a311d996c076930bceb05a696e0aa05b38ad2c1ea06848120333b15e3793e8947ddaf1348471ce7a775f5439a373c7c0cab0697ef6addf557930f025a9a736b538a8dfc93919e925616ce47df3c4c0086c420e567cb27de37e5419fbb7ae1729897841a3ee3641b056eca4008cd4aeb731ce25948fe7c9800cc06b8d9b13b144f05073d1ffc7d03217731c8acf316b44cb63a23de037676b299e2389ecedfa8261dff02864edff20b962db3c83b0be00d7d7ea6ee315f7c3cc4d526cbe9d4cde7193b560a30ed30f82575a703c76e78828191451db254b0, '');";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aDisabledModules', 'arr', 0x4dbab5257eed47fec7dfa5a8b05d0a36bc98330502e653e4dac5c5dac014e0542bc02971fbcb0ae66a0320bd3e7f3aaeabb7fb892948f7cce3ea55a137a0e6db7ef422bfbe41e1db4c3447dc50a96566410ef6a6d434669183994e9ae9194092714caaee9088effc6c1269167d1a3ee3cd07cf3561d8756c37002446cce60952fe861930c447b1861ac7a5f4dae02b39ba305b9029e80839f99ec9c1cac20a99cf5aa5c013a09af6ddcf64dfa5079b348b03c6fa0f61b6b62f3a428d7da930b60e40531219c31f3f0782c313e19a4b4b63e2aece5841d35f711b94882c865888e4, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleTemplates', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989301e24c5f90cbbbacb80d0c945f6ce65f1eee77ba52e10d57a87ba245bacb0502199093f5f5882d0c6b5728da8e4d76bac2d39fcd1f679e17e064d8e6459027aefaf7c261b7ce535b5156299b6ec0b897d1d8c53ac051ca3782764f16f57e116f0d244a6c4873edf8e513cd181c31b9d9a8801a1db572f4cdd99b646c50fc484844ba0e3ecd251bc3c8c81f6994e13d13e15c8fe707a705bb9443ec77b7a8ecc6a68e0a01cc20633b6162fe60b371615eaf34d55b789cc2716ba7136ff1981852ecd1a88677ca872edb94efba83c01b964d0f0abb2b55053578f06bebadb34e38f8a927612ac4f4439d6099ed09f2163ac65ebc1c7558a8c908fe75fdb4b88aa903af14c87c1ade557e5ccbfbf8367ef200ff221c82c4b947b0f4a9d901e341d9be214a0efe4c8307a687b85d30a2f4195a63c7e29adfb509d5ec021b44e2a968cab18a9c685b00840f6a0d67eba8be7b929afcd647ade528d76ab693f1e3d237475ade8017cad7b27168c9ba4810a1abdb5a45c1ad66f2c2518d914c43d8a9eea3f70db5aaf4ca29b55d645a3ef5f735a2f62912a93213c11a5395ef576287319d14001e211bff080651baeb764d86246280405e237e6c3aa360814d6162d593d958c0b17a3b2ad8946d0c2fe622d66ed3fc02dd7485c7015f8c84008de4390275138ed8260b67620685d6c1d278e37d15933611bb24197a50dfdd0612260b938ac701ba9fcb669ff6eccb1caa317243098cf5fb990835496b87d1af2bb4d80af0d99bc7c4ededc12fafc8b1e273be6043de26f78f7e2c3adfb3442bc2f5fc3fc949f9d75a6aa557a40a7a36b0e0fcfab87ad72f87764631259c5ecb2c077b1d9d4f54f73d09451911388efa57d865cf9fc0eba23650e5e22f9714da7890299785dd933a1076a5b6e1afb103cd53ef2ff4ee49b82b20e5570be9903e60084ae6cce7d2fa24390387133d8072bc43bc78fec8a395ef770ac00e08ad3889012db8a6d203cffc88d2fd4f98e6da31290e62e8f8ff84a7f2112cddab9e33d429bbb17fd1383f24965b5b6ff67537920b0617d86cf0902f04232068e8, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);

		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleVersions', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989364f03e4cea779dbc66f42a97e0e0, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);

		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aLegacyModules', 'aarr', 0x307865386533, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		
		// Insert into oxtplblocks
		$sSelectHead = "INSERT INTO `oxtplblocks` (`OXID`, `OXACTIVE`, `OXSHOPID`, `OXTEMPLATE`, `OXBLOCKNAME`, `OXPOS`, `OXFILE`, `OXMODULE`, `OXTIMESTAMP`) VALUES ";
		

		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_main.tpl', 'imva_devguide_footer', '1', 'views/blocks/imva_devguide_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_main.tpl', 'imva_devguide_header', '1', 'views/blocks/imva_devguide_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_devguide_footer', '1', 'views/blocks/imva_devguide_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_devguide_header', '1', 'views/blocks/imva_devguide_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_devguide_confirm', '1', 'views/blocks/imva_devguide_dialogue.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_devguide_footer', '1', 'views/blocks/imva_devguide_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_devguide_header', '1', 'views/blocks/imva_devguide_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);

		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_devguide_confirm', '1', 'views/blocks/imva_devguide_dialogue.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_devguide_footer', '1', 'views/blocks/imva_devguide_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_devguide_header', '1', 'views/blocks/imva_devguide_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_devguide_confirm', '1', 'views/blocks/imva_devguide_dialogue.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_logviewer.tpl', 'imva_devguide_footer', '1', 'views/blocks/imva_devguide_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '.$this->_sShopId.', '".$this->_sShopId."', 'imva_devguide_logviewer.tpl', 'imva_devguide_header', '1', 'views/blocks/imva_devguide_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		// Set Success Flag
		$this->blSuccess = true;
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
			$sFileName = 'config.'.$this->_sShopId.'.'.$sFileSuffix.'.txt';	// Naming shape of cache files.
		
			if (file_exists($sPath.$sFileName))
			{
				@unlink($sPath.$sFileName);
			}
		}
	}
}
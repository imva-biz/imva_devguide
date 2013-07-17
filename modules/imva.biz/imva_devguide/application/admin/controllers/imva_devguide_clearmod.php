<?php

/**
 * imva.biz Developer's Guide
 * Main Class
 * 
 * Redistribution permitted.
 *
 * Weitergabe verboten.
 *
 *
 * This Software is intellectual property of imva.biz respectively of its author and is protected
 * by copyright law. This software product is open-source, but not freeware.
 *
 * Any unauthorized use of this software product - usage without a valid license,
 * modification, copying, redistribution, transmission is a violation of the license agreement
 * and will be prosecuted by civil and criminal law.
 *
 * By applying and using this software product, you agree to the terms and condition of usage and
 * furthermore agree, not to share information, source codes, technologies, credentials and addresses
 * of any kind.
 *
 *
 * Mit der Übernahme dieser Software akzeptieren Sie die zwischen Ihnen und dem Herausgeber
 * festgehaltenen Bedingungen und wahren Stillschweigen über die Ihnen zugänglich gemachten
 * Informationen, Quellcodes, Technologien, Zugangsdaten und Adressen jeglicher Art.
 * Der Bruch dieser Bedingungen kann Schadensersatzforderungen nach sich ziehen.
 *
 * (c) 2013 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5-15
 * v 0.7.1
 *
 */

class imva_devguide_clearmod extends oxAdminView
{
	private $_sTemplate = 'imva_devguide_clearmod.tpl';		// Template
	private $_oConfig2 = null;								// Config object
	private $_sShopId = 'oxbaseshop';						// The shop ID. Prepared for usage in EE (maybe soon)
	private $_blIsSuccessful = false;						// Successful?
	
	
	
	/**
	 * Construct
	 */
	public function __construct()
	{
		// Fill config
		$this->_oConfig2 = $this->getConfig();
		
		// Fill shop ID
		$this->_sShopId = $this->_oConfig2->getActiveShop()->getId();
	}
	
	
	
	
	/**
	 * Render
	 * @return string
	 */	
	public function render()
	{
		parent::render();
		
		// Multishop feature for Enterprise Edition only
		if ($this->_oConfig2->getEdition() == 'EE'){
			$this->_aViewData['blIsEE'] = true;
		}
		
		// Call clear function
		if ($this->_oConfig2->getRequestParameter('shops') == 'all'){
			$this->_clearModuleCache();
			$this->_aViewData['allcleared'] = true;
		}
		else{
			$this->_clearModuleCache($this->_sShopId);
		}
		
		$this->_reviveDevguide();
		
		$this->_aViewData['success'] = $this->_blIsSuccessful;
		
		return $this->_sTemplate;
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
	}
	
	
	
	/**
	 * Revives the Devguide Module by updateing the database
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
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleFiles', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989301e2c05c93c8b81e2f03029a5162e85110e079b45cef0359a67e7b1679e5ba4233720e67ac889140d8ca6db3af0ac5e1a81e17ad1fe25e627c88a2adce906b4eed424233147d57cb315a5f86dbc843379874afdac2b269cd76506764de393b3d5fd478fd709aea2aa8d8dc0ea39b7e3746f487d8bc16d03b7ee59e9e3413ec03bf5d1273090fea5ceb4a3e37dab130b84b306f695072d2302592431939c270976d72dbbc4887f2cadf8703d2e0b18aa85822721ec5cba8799a685bdea03b1bea42721c3483f9aff430a8d1d91a4938cf6dade63fad808e164cad39f1736197f70591c1b36d7326e5cc3a201b98db96a8750a2cd142c9367b2ca0465217aa008be0dd64f4040c69c4c0d0aa61e2b6c968e4dae72fbff7d077ecc5e090f2b9b99a79d65e1a545b8913000a1d08c2a946798c99e8df44ab9626acb08c08a30a61d5ce6c6816ae1e8ee9d8b07a37e3e5f296d070866145c929495551011898ce9f9635deb5d6e2263333846a61e3ebd4dd7e1cbc774d78e9a394bcc01219ea41296383f064a3a236a6ffa65d19340617ce103e667a34fe6b109b2c08b6ccce70f1bba722c56cab5a51184037aa5b7eb5e1afdba74a3265c6ec7eb6ed55dc45af68b8db0a5fff41004bf804400c62a16d859c70a850baff570ebaa3d165d276, '');";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aLegacyModules', 'aarr', 0x307865386533, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aDisabledModules', 'arr', 0x4dba32cb77d662d5907531ebe71f65fccc2e26c25a152ab2d798ebb1d049bd0176a5f25837a5f9620cc1773d3273fcf7b2fa24e875e28efaeafc117f3cad83c721a456add2ba2478032c73ce1279d9a7c63cec83e41bed55f044adbae21d17616005fe3fa8cc793b72885245a91909e3407b9a1ed88b59b86a0e01cab49c36358479515274a661392e00398d47417c35a30b923e57156f2ab85d7a355dd55e5e1a031c2d94dce1cd7e6f93c5f5981d51fb8e4366d1846cb226e7a453cb1950e9cc92c51567fe8a46064e5c74fdc9798f14749dc2592f4d18c1109f70198677ca17d62579ea168fcc6399437b78b66efeea1f415ac0868d5c1441a56171511d39380ceba55d8d32077847445a0c13f4728b50eefd06790ce8ede1815112390ebde281adbe1e5c73c991dbc0d0d92accec778b5e5b13a484581ce930b7855380ad612fdff5388d1b68d01ab20e7cae2d763233f5a1f768adb4795e9154824e871789135a6bfb5f6bcc36cf506a0df90993c58577cc864ad9bbeae34062c6a5721eafa97568714617d48798ee792a6e3c608a0cef671137a988678957f377a68b9716036d4850bc583b74053e606a7a88e0cc575d41ead9ac68de0a17425fee884214f855c732a168a4a1bd7014e880cf935f6881d033f2d84d13039ba881d0be6d5d365314cdd17440ec53b2827c60, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleTemplates', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989301e2c05c93c8b8af1a0a0b93586be15819e970bd55e60a50af77721f70a6aa501e8fdfbb8449478112c74946191d0f1229990863c3bddc846166075d0523df036c192b71492cc4d3faf9b1d55a9f4fdd973d2169dd61d8ffd2f7dc0638d743cee7839f0670cb39cb1341d4010528a0c0b1990364ad6aecd5c1837c7448e450505ca21626d53d03dbd024a3cb39f1d8f5fe1f683ec845a292d6b8ff55327a2ea78281f112eeb7493ac028b09ae1707a9fa7d694c1230b5d6835f015eaffcc5153a085034efe58ecebafbd1e8e9cdd2f05c3f840d20d52e329f375da5deb1521bc1b977790fd0a9d7ba618bb961e88143866c48680e02092ad459bfd8e04a6264eaecb3a444c44218c7fb2e922a1f58a2ba799a46cfcb49334af86a3d3b1fafad93a951d591718ca5043495e4b81ea053acfdaab9c07eb23247c7560064ca5972de4481631e538d0b7248ee70306eed8787a855945a280d2f9af81abf7fcc4341ba18dd6b6c15f137fa53338180b167eb42d865cb9fb107678e239e64e70ad9e4e86690797d19756d61912118f5b2422e017cbdf0746980c379c43b40e3d440d4c42fe20af5d48fd830d00f6af370cf619a219085b267b693fa66584486467d096dc5dc5b47f3e2fdd9168092ae327d36bd6f9071b64, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModulePaths', 'aarr', 0x4dba32ab76d7c8ce5252f1dfe4d11b2888ebf17bac57a9cffdfd92e55a416852b8466ac310ced77be57f977af5d49f853804ebb4cc034105d36e7ab74319401135de264a2c12f8d033fc4cd04392c5cd2d9355f79b6c136d7515928f40ebfcece2fea47fce134e3dc1057f87923ec6ed810a3e2c36ca24024add4e61ae27ab0053078efbef626cf7a8d73684f7a8cc66a04b0e95eeee5689b59a48eba585dc4eabc4e987f77c41c57ef6057e512a1230907267d013b15269b513e8b63c970e232a524ded128052d1e2438336f78b9671fdf8ced771ee25e37b38881538d76c40ccfa6c2f55415b8c5cc3588d82916655ca09ae6c6ed197897402c2931d5b10fece6b4d734a50f50faaa5cda655ba9cb88915029a254744d1dcff55f9520e2345810a210386e0282c01d855eab249974e5eeb32cb278b42c64ebe4d18983fde05f701c6f7d2c6d2d8f106cc23f757dd75032f3fcb272ed8c10c9a8921f7d8b98d15e4b86a95fc9661d1dbc87cea3f33b7fcb94e467326c00373c64b4a7d2470d812c09b8167b452c58e38b8c65644e86b995d26cb625f8b3de19e39de2bce9b4a986506b3d0c531061814cd74fa0aa8c70eed919db3a994e4b4eb3728482406e96c7724cf9a8137efa62120080b53923fd2a8db274ecb3a549b4dcd51f8000b110b452067bea207359228aa255c5e035a67326f6f558e7c82762e3b858d726680260d2fee2a79bc2c9fbb63be7e733145ad496aba45c9f6ea3708e804327e8b166735e307f3d7331c2a8b832eb9ac3cff36e504ed80f861eac7b17dce6561ae82a8560afbbccb658c189c562b724eab5a14eb5696214fc1b24cb3adc384609139a91731049cd7600728f439ca5c963f104146017eb189493a6b7e34aba260bf8fdb00a76275e3bfc4af97da6a4cf33cc120e661f98e51909787dceb4c53dd36b87dd5807378fdee83210cca677dc1f521c71bd40cf69c5f120d324580f46f12b0f343a2386d88fe0591f14909624fac5f78f2a90e850bc870409c703e9665637f7de05e81e1eaa5b209b92eae410fc4d90d8eb93dfe1b410f883bce52ba6319dbae84bd892d37664c39e579c6d850d70d2572a8c231b27d2dc3c3491d179abff6af937e378edf5a10e67cb5e3938cdf8f1d1f4548283f174451714aa6969ea141a0632d21e42f5106611ceaa8da582c9359f046114dd6adcbdf0b746d481dba93bb3221c50cdbf5f424c58a7970066d0af24fc56a482f01bc0717c225529f8e2ba7e0c27a2bf352ebbe50518648f5bd66b9f12458e0cabb018156ea2e01b804082c0620ec80ce8c7984c0b25a04d01891cf1f96e2f60d99, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		
		// Insert into oxtplblocks
		$sSelectHead = "INSERT INTO `oxtplblocks` (`OXID`, `OXACTIVE`, `OXSHOPID`, `OXTEMPLATE`, `OXBLOCKNAME`, `OXPOS`, `OXFILE`, `OXMODULE`, `OXTIMESTAMP`) VALUES ";
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_footer', '1', 'out/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_header', '1', 'out/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);		
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_footer', '1', 'out/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_header', '1', 'out/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_main.tpl', 'imva_footer', '1', 'out/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_main.tpl', 'imva_header', '1', 'out/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_footer', '1', 'out/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_header', '1', 'out/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		// Set Success Flag
		$this->_blIsSuccessful = true;
	}
}
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
 * (c) 2013 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5-8/14
 * v 0.8.1
 *
 */

class imva_devguide_clearmod extends oxAdminView
{
	private $_sTemplate	=	'imva_devguide_clearmod.tpl';			// Template
	private $_sShopId	=	'oxbaseshop';							// The shop ID. Prepared for usage in EE (maybe soon)
	public $blSuccess	=	false;									// Successful?
	public $blFail		=	false;									// Failure
	public $blAllcleared=	false;									// Status
	public $oServ		=	null;									// Devguide Service
	
	
	
	/**
	 * Construct
	 * 
	 * Provice Service.
	 * @param null
	 * @return null
	 */
	public function __construct()
	{
		parent::__construct();
		$this->oServ = oxNew('imva_devguide_service');					// Service
		$this->_sShopId = $this->getConfig()->getActiveShop()->getId();	// Fill (sub)-shop ID
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
				$this->_clearModuleCache($this->_sShopId);
			}
			
			$this->_reviveDevguide();
		}
		
		if ($this->blSuccess and $this->blFail){
			echo 'ERROR_PARADOX';
		}
		
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
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aDisabledModules', 'arr', 0x4dba32cb77d662d5907531ebe71f65fccc2e26c25a152ab2d798ebb1d049bd0176a5f25837a5f9620cc1773d3273fcf7b2fa24e875e28efaeafc117f3cad83c721a456add2ba2478b22971cc107bdba5c41fd86eafb31c2930a31b889e7ac751dcbc833bcd87c5e76fdf3d25df52e574ef12a7f1fdcc2907c6261d44e5667d24cded31cbd629e568003484e6f279bc138dcb9f58622a8948b79928cc158d27c1719185a2108d8748a2fa26709fca1be0a659e73529cde4cebb8e85cd449d0134f3a36fba9d6144a6137e311aebdfcd8e387370a90a73ba5e00590b10c10d55eba43f173c2ce2968bca5178baaca52b05b074290736c1c7488b2a65de113c2d8326222a0f446ed76472b15b8742ac6255beea3af05dadbecef97eea91ad59638d589f837fb445902cf2d136cf0464c27953bd568fc7fe51ebe2fdafdc45ece0c05195c1dbf927028b3579b8f86373637ea616c2ae230df462c91285cbe98e3877e423e075d59ec1d5d52a3360fbe6d4dd861655fcc59ebae33d520b7659ceb2a1cfc445d26f68d67e9e7b0b1a209823bdc4e97d4420d37da03859e1f46339e057a9630078eaa276fade1cdd8509707eff1119f2d0caeb01bc5054c6f5fffa1729d44735aa021b768a601769f70de3c56540b5cf1fa3d3eb81c7c7c67a3588a9f1353c5d20290567031aaaa89e6bb17b25cc2e, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleTemplates', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989301e2c05c93c8b8af1a0a0b93586be15819e970bd55e60a50af77721f70a6aa501e8fdfbb8449478112c74946191d0f1229990863c3bddc846166075d0523df036c192b71492cc4d3faf9b1d55a9f4fdd973d2169dd61d8ffd2f7dc0638d743cee7839f0670cb39cb1341d4010528a0c0b1990364ad6aecd5c1837c7448e450505ca21626d53d03dbd024a3cb39f1d8f5fe1f683ec845a292d6b8ff55327a2ea78281f112eeb7493ac028b09ae1707a9fa7d694c1230b5d6835f015eaffcc5153a085034efe58ecebafbd1e8e9cdd2f05c3f840d20d52e329f375da5deb1521bc1b977790fd0a9d7ba618bb961e88143866c48680e02092ad459bfd8e04a6264eaecb3a444c44218c7fb2e922a1f58a2ba799a46cfcb49334af86a3d3b1fafad93a951d591718ca5043495e4b81ea053acfdaab9c07eb23247c7560064ca5972de4481631e538d0b7248ee70306eed8787a855945a280d2f9af81abf7fcc4341ba18dd6b6c15f137fa53338180b167eb42d865cb9fb107678e239e64e70ad9e4e86690797d19756d61912118f5b2422e017cbdf0746980c379c43b40e3d440d4c42fe20af5d48fd830d00f6af370cf619a219085b267b693fa66584486467d096dc5dc5b47f3e2fdd9168092ae327d36bd6f9071b64, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModulePaths', 'aarr', 0x4dba32ab76d7c8ce5252f1dfe4d11b2888ebf17bac57a9cffdfd92e55a416852b8466ac310ced77be57f977af5d49f853804ebb4cc034105d36e7ab74319401135de264a2c12f8d033fc4cd04392c5cd2d9355f79b6c136d7515928f40ebfcece2fea47fce134e3dc1057f87923ec6ed810a3e2c36ca24024a6c4b63ac25a9025105adcf0229c406d417d1326ecefc9a5dce77133cfd1d1c10ee31df91b1e868d74ecbcd597d9f613e586bdda320105a5c1101582efa9009ce989dd6be93f6c819425b02c7358b93b65b05996df9b3dc04c0bc85665af238a1a33073cb0502b1f201ad8e98171b928d06dad765851e2aab89204c1cc53fd1d33857c1c78977703011be05be5dfdb80c08b5a6b967d0c3b06647c5db54dea7a4c129124c2a6b25f8cf14c96042bd3b156d77b9d1fc41ad30dee30ea6852cb331e938d1a1f9971bed53f237fadf6c234cd3963742758e16b6f9dca512ff1d4002453859a7aa77b3d409694ee3166b7f49325556588e6454b9333e8a4fe58cd969947f8a553dce23e7a4a06b9aaaca2c13120a7701a7ade1e9911a083c3215a634c2d25e61af5acb15c52bbb27842539c44ab6910d3eda09302cd9f5a9fba0249cf289d306fad03c309ca485fb40b662060c28ff4a47ade38c64bbdb71f3d6ccf408816fb25b38142704326b16f1f2658623e680c0153c628baa002a19b036d9452b17c49f7eced3d35d3be5666d7d6cab2ae66f56ad1a15c0965493a6c311d70cdc786e55d95fe856f227291747b7cc0354707ed473029762a38e40f0895ec2add6da1a9b50699f87b39b7e6de3bba748f189155bada1bd29d082064b996565b1816904a93601bd793eeef7ccbabf3940a07f40f1e64e2f692cd7da66747bfe7552633a27b19751f050cabd4bca5cce48aae1bedc99ec64f61a523c487dc107030cc293a08d5b6743bdd435f2509ef21e24a0b7d81709120204f95c67198e3ad31915ed2b513b53f9a49f03b918949e3320b23da08e8742e87679275af8981d9fa2186ad0efce0f0cdf76eb7a4874493d7b36845d9e41082550926d93c47f266b31296f81b789b193276d7318f4a6668375fd16f18f245d48ad96aa65f4f780b3b276357da71c2655a6bd2ea564cb9537546bc8c3e100b134fc4faf1504c3d43b06ea756fa861828990bda534068ef531713596b20c6a19f480372e65bcda6b0cf242ad523548023ee3091b278b982b1aec6973973b56de6225d2cb9ad7367dc53f50b5d64fa7f454b0afa5159b06ad34fd21f777ddd7711823dc6f90d291916b616c8cf18b5d342f215123458b705724f7586d8272e8a2962395c587c29fd87aad1f35410569, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);		

		$sSelect = "('".$this->genId()."', '".$this->_sShopId."', '', 'aModuleVersions', 'aarr', 0x4dba322c774f5434e31d93d69a8ad6f167b2af82484a81f5989364f0744fe9749e8464f60b9686, '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		
		// Insert into oxtplblocks
		$sSelectHead = "INSERT INTO `oxtplblocks` (`OXID`, `OXACTIVE`, `OXSHOPID`, `OXTEMPLATE`, `OXBLOCKNAME`, `OXPOS`, `OXFILE`, `OXMODULE`, `OXTIMESTAMP`) VALUES ";
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_footer', '1', 'out/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_header', '1', 'out/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_cleartemp.tpl', 'imva_devguide_confirm', '1', 'out/blocks/dialogue.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_footer', '1', 'out/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_header', '1', 'out/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);

		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_clearmod.tpl', 'imva_devguide_confirm', '1', 'out/blocks/dialogue.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_main.tpl', 'imva_footer', '1', 'out/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_main.tpl', 'imva_header', '1', 'out/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_footer', '1', 'out/blocks/imva_footer.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_header', '1', 'out/blocks/imva_header.tpl', 'imva_devguide', '')";
		oxDb::getDb(true)->execute($sSelectHead.$sSelect);
		
		$sSelect = "('".$this->genId()."', '1', '".$this->_sShopId."', 'imva_devguide_rebuildviews.tpl', 'imva_devguide_confirm', '1', 'out/blocks/dialogue.tpl', 'imva_devguide', '')";
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
		$sPath = $this->getConfig()->getConfigParam('sCompileDir');
		
		foreach ($aFileSuffixes as $sFileSuffix){
			$sFileName = 'config.'.$this->_sShopId.'.'.$sFileSuffix.'.txt';	// Naming shape of cache files.
		
			if (file_exists($sPath.$sFileName)){
				@unlink($sPath.$sFileName);
			}
		}
	}
}
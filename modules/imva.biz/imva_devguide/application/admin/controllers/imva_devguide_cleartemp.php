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
 * 13/7/5-8
 * v 0.5
 *
 */

class imva_devguide_cleartemp extends oxAdminView
{
	private $_sTemplate = 'imva_devguide_cleartemp.tpl';	// Template
	private $_blIsSuccessful = false;						// Successful?
	
	
	
	/**
	 * Render
	 * @return string
	 */	
	public function render()
	{
		parent::render();		
		$this->_clearTemp();
		
		$this->_aViewData['success'] = $this->_blIsSuccessful;
		
		return $this->_sTemplate;
	}
	
	
	
	/**
	 * Delete contents from /tmp/
	 * 
	 * @param null
	 * @return null
	 */
	private function _clearTemp()
	{
		// Compile dir
		$sTempDir = $this->getConfig()->getConfigParam('sCompileDir');
		
		// tmp
		$this->_clearDir($sTempDir);
		
		// tmp/smarty
		$this->_clearDir($sTempDir.'/smarty/');
		
		// Create new .htaccess
		$oFile = fopen($sTempDir.'/.htaccess','w+');
		fwrite($oFile,'Deny From All');
		fclose($oFile);
		
		// Set Success Flag
		$this->_blIsSuccessful = true;
	}
	
	
	
	/**
	 * Clear directory
	 * 
	 * @param string
	 * @return null
	 */
	private function _clearDir($sPath)
	{
		if (is_dir($sPath)){
			if ($oDirH = opendir($sPath)){
				while (($sFile = readdir($oDirH)) !== false){
					if ($sFile != '.' and $sFile != '..'){ // don't do for . and ..
						@unlink($sPath.$sFile); // suppress warnings
					}
				}
				closedir($oDirH);
			}
		}
	}
}
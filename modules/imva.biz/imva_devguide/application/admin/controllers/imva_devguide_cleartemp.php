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
 * Mit der �bernahme dieser Software akzeptieren Sie die zwischen Ihnen und dem Herausgeber
 * festgehaltenen Bedingungen und wahren Stillschweigen �ber die Ihnen zug�nglich gemachten
 * Informationen, Quellcodes, Technologien, Zugangsdaten und Adressen jeglicher Art.
 * Der Bruch dieser Bedingungen kann Schadensersatzforderungen nach sich ziehen.
 *
 * (c) 2013 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5
 * v 0.1
 *
 */

class imva_devguide_cleartemp extends oxAdminView
{
	private $_sTemplate = 'imva_devguide_cleartemp.tpl';		// Template
	private $_oSvc = null;
	
	
	
	/**
	 * Render
	 * @return string
	 */	
	public function render()
	{
		parent::render();		
		$this->_clearTemp();
		$this->_aViewConfig['success'] = true;
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
		$sTempDir = $this->getConfig()->getConfigParam('sCompileDir').'/';
		
		// Delete files from temp dir
		$aFiles = glob($sTempDir);		
		foreach ($aFiles as $sFile){
			unlink($sTempDir.$sFile);
		}
		
		// Create new .htaccesss
		$oFileSerice = oxNew('imva_fileservice');
		$oFileService->load($sTempDir.'.htaccess');
		$oFileService->writeFile('Deny From All');
	}
}
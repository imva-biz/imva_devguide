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

class imva_devguide_rebuildviews extends oxAdminView
{
	private $_sTemplate = 'imva_devguide_rebuildviews.tpl';	// Template
	private $_blIsSuccessful = false;						// Successful?
	
	
	
	/**
	 * Render
	 * @return string
	 */	
	public function render()
	{
		parent::render();
		$this->_rebuildViews();
		
		$this->_aViewData['success'] = $this->_blIsSuccessful;
		
		return $this->_sTemplate;
	}
	
	
	
	/**
	 * Rebuild Views
	 * 
	 * @param null
	 * @return null
	 */
	private function _rebuildViews()
	{
        if (oxRegistry::getSession()->getVariable('malladmin')){
			$oMetaData = oxNew('oxDbMetaDataHandler');
			$this->_blIsSuccessful = $oMetaData->updateViews();	// Set Success Flag
        }
	}
}
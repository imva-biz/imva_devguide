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
 * 13/7/5-31
 * v 0.8
 *
 */

class imva_devguide_rebuildviews extends oxAdminView
{
	public $blSuccess	=	false;							// Successful?
	public $blFail		=	false;							// Failure
	public $oServ		=	null;							// Devguide Service
	
	
	
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
		$this->oServ = oxNew('imva_devguide_service');				// Service
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
			$this->_rebuildViews();
		}

		if ($this->blSuccess and $this->blFail){
			echo 'ERROR_PARADOX';
		}
		
		return 'imva_devguide_rebuildviews.tpl';
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
			$this->blSuccess = $oMetaData->updateViews();	// Set Success Flag
        }else{
        	$this->blFail = true;							// On failure
        }
	}
}
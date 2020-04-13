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
 * 13/7/5-20/4/13
 * v 2.0.0
 */

namespace Imva\DevelopersGuide\Controller\Admin;

class BaseController extends \OxidEsales\Eshop\Application\Controller\Admin\AdminContent
{
	public $sShopId			=	null;								// The shop ID. Prepared for usage in EE
	public $blSuccess		=	false;								// Successful?
	public $blFail			=	false;								// Failure
	public $blAllcleared	=	false;								// Status
	private $_oServ			=	null;								// Devguide Service

	/**
	 * Init
	 *
	 * Provice Service.
	 * @param null
	 * @return null
	 */
	public function init()
	{
		parent::init();
		$this->sShopId = \OxidEsales\Eshop\Core\Registry::getConfig()->getShopId();	// Fill (sub)-shop ID
	}

    /**
     * Devguide Service getter.
     *
     * @return service
     */
	public function getDevguideService()
    {
        if ($this->_oServ === null)
        {
            $this->_oServ = oxNew(\Imva\DevelopersGuide\Core\Service::class);
        }
        return $this->_oServ;
    }

	/**
	 * Render
	 * 
	 * @return string
	 */
	public function render()
	{
		parent::render();

		if ($this->blSuccess and $this->blFail)
		{
			echo 'ERROR_PARADOX';
		}
		
		if ($this->getDevguideService()->getP('blCancelled'))
		{
			$this->blCancelled = true;
		}
	}
}
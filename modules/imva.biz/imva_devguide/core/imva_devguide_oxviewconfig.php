<?php

/**
 * imva.biz Developer's Guide
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
 * 15/1/25
 * v 0.9.11
 *
 */

class imva_devguide_oxviewconfig extends imva_devguide_oxviewconfig_parent
{
    /**
     * Returns the path of a module file. Fix: Make it work for HTTPS.
     * 
     * @param string $sModule
     * @param string $sFile
     */
	
	public function getModuleUrl($sModule, $sFile = '')
    {
		$sUrl = parent::getModuleUrl($sModule, $sFile);
		
		// The patch. Pull request created. See @https://github.com/bertrandjackermann/oxideshop_ce/compare/oxbertrand-oxidce
		if (($this->getConfig()->getConfigParam('sAdminSSLURL') != null) && ($this->isAdmin())){
			$sUrl = str_replace('http:','https:',$sUrl);
		}
		
		return $sUrl;
    }
}
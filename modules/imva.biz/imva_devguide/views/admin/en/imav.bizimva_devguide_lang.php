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
 * (c) 2013-2014 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/7/5-15/1/18
 * v 0.9.2
 *
 */

$sLangName  = "English";
$aLang = array(
		'charset'										=>	'UTF-8',
		
		// Group
		'imva_modules_group'							=>	'imva.biz modules',
		'imva_services_information'						=>	'Information',
	
		// Titles
		'imva_devguide'									=>	'Developer&rsquo;s Guide',
		'imva_devguide_cleartemp'						=>	'Clear cache',
		'imva_devguide_rebuildviews'					=>	'Rebuild Views',
		'imva_devguide_clearmod'						=>	'Reset modules',
		'imva_devguide_logviewer'						=>	'View logfiles',
		
		// Configuration
		'SHOP_MODULE_GROUP_imva_devguide_behaviour'		=>	'Behaviour',
		'SHOP_MODULE_imva_devguide_requestonaction'		=>	'Ask me before running a task',
		'SHOP_MODULE_imva_devguide_enableautorevive'	=>	'Re-activate this module after resetting the whole module configuration.',
		'SHOP_MODULE_GROUP_imva_devguide_logging'		=>	'Logging',
		'SHOP_MODULE_imva_devguide_enablelogging'		=>	'Log events and actions',
		
		// Dialogue
		'IMVA_DEVGUIDE_CONFIRM'							=>	'Are you sure?',
		'IMVA_DEVGUIDE_CONFIRM_YES'						=>	'Yes',
		'IMVA_DEVGUIDE_CONFIRM_CANCEL'					=>	'Cancel',
		'IMVA_DEVGUIDE_CANCELLED'						=>	'The procedure has been cancelled.',
		'IMVA_DEVGUIDE_REDO'							=>	'Redo',
		
		// Main View
		'IMVA_DEVGUIDE_CLEARMOD_ALL'					=>	'... in all subshops',
		'IMVA_DEVGUIDE_MAIN_INTRO'						=>	'This module gives you quick access to functions that developers
															might need often.',
		'IMVA_DEVGUIDE_MAIN_NODIALOGUE'					=>	'Be aware that all actions are performed immediately and without callback.',
		'IMVA_DEVGUIDE_MAIN_WITHDIALOGUE'				=>	'All actions have to be confirmed.',
		'IMVA_DEVGUIDE_MAIN_BEHAVIOUR'					=>	'In order to change this behaviour, open
															<i>Extensions&rarr;Modules&rarr;Settings</i>
															and change the option',
		
		// Views
		'IMVA_DEVGUIDE_TITLE'							=>	'imva.biz: &quot;Entwicklungshelfer&quot;',
		'IMVA_DEVGUIDE_CLEARMOD_NOREVIVE'				=>	'Re-activation after resetting is disabled, so this line is the last output of this module.
															This behaviour is completely normal in this case.',
		'IMVA_DEVGUIDE_CLEARMOD_CLEARED'				=>	'All modules have been reset;',
		'IMVA_DEVGUIDE_CLEARMOD_CLEARALL'				=>	'Reset in all subshops.',
		'IMVA_DEVGUIDE_CLEARMOD_CLEAREDALL'				=>	'All modules have been reset;',
		'IMVA_DEVGUIDE_CLEARMOD_RESTORED'				=>	'the &quot;Entwicklungshelfer&quot; module has been re-activated.',
		'IMVA_DEVGUIDE_CLEARMOD_FAIL'					=>	'Could not reset the module configuration.',
		'IMVA_DEVGUIDE_CLEARTEMP_CLEARED'				=>	'Template cache (tmp/ directory) has been cleared.',
		'IMVA_DEVGUIDE_CLEARTEMP_FAIL'					=>	'Error clearing /tmp/. Check the permissions.',
		'IMVA_DEVGUIDE_RV_CLEARED'						=>	'Database views have been rebuilt.',
		'IMVA_DEVGUIDE_RV_FAIL'							=>	'Error rebuilding database views. It this persists, either a database
															table may be missing or the database structure is damaged.',
		'IMVA_DEVGUIDE_LOGVIEWER_CLEARFILE'				=>	'Clear',
		'IMVA_DEVGUIDE_LOGVIEWER_ELMISSEMPTY'			=>	'The selected file is empty.',
		'IMVA_DEVGUIDE_LOGVIEWER_FAIL'					=>	'Cannot read the selected file.
															It either does not exist or access was denied.',
		
		// Footer
		'IMVA_DEVGUIDE_MANUAL'							=>	'User manual',
		'IMVA_DEVGUIDE_FOOTER_DONATE1'					=>	'Was this module helpful for you? Maybe you want to consider a ',
		'IMVA_DEVGUIDE_FOOTER_DONATE2'					=>	'donation',
		'IMVA_DEVGUIDE_FOOTER_DONATE3'					=>	'? ;-)',
		
);
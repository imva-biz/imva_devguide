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
 * 13/7/5-17/3/18
 * v 0.10
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
        'imva_devguide_cleartemp'                       =>  'Clear compile dir',
		'imva_devguide_rebuildviews'                    =>	'Rebuild views',
		'imva_devguide_clearmod'                        =>	'Reset modules',
		'imva_devguide_logviewer'                       =>	'View logfiles',
		
		// Configuration
		'SHOP_MODULE_GROUP_imva_devguide_behaviour'		=>	'Behaviour',
		'SHOP_MODULE_imva_devguide_requestonaction'		=>	'Ask me before running a task',
		'SHOP_MODULE_imva_devguide_enableautorevive'	=>	'Enable the auto-revive feature',
		'HELP_SHOP_MODULE_imva_devguide_enableautorevive'=>	'<i>Alpha!</i> Re-activates this module after resetting the whole module configuration.',
		'SHOP_MODULE_imva_devguide_revive3rdparty'		=>	'Also reactivate the following modules if they exist:',
		'HELP_SHOP_MODULE_imva_devguide_revive3rdparty'	=>	'In case this feature causes malfunction, disable the auto-revive feature.',
		'SHOP_MODULE_imva_devguide_3rdpartymdllist'		=>	'Enter one module ID per line in order to use auto-revive.',
		'HELP_SHOP_MODULE_imva_devguide_3rdpartymdllist'=>	'A module&rsquo;s ID can be found in its metadata.php file. The ID does not necessarily equal
															the directory name!',
		'SHOP_MODULE_GROUP_imva_devguide_logging'		=>	'Logging',
		'SHOP_MODULE_imva_devguide_enablelogging'		=>	'Log events and actions',
		'SHOP_MODULE_GROUP_imva_devguide_settings'		=>	'Further settings',
		'SHOP_MODULE_imva_devguide_pathtoerrorlog'		=>	'Absolute path to the error.log file of the webserver or any other text-formatted logfile',
		
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
		'SHOP_MODULE_GROUP_imva_devguide_settings'		=>	'More settings',
		'SHOP_MODULE_imva_devguide_pathtoerrorlog'		=>	'Absolute path to the webserver\'s error.log file',
		
		// Views
		'IMVA_DEVGUIDE_TITLE'							=>	'imva.biz: &quot;Entwicklungshelfer&quot;',
		'IMVA_DEVGUIDE_CLEARMOD_NOREVIVE'				=>	'Re-activation after resetting is disabled, so this line is the last output of this module.
															This behaviour is completely normal in this case.
															',
		'IMVA_DEVGUIDE_CLEARMOD_CLEARED'				=>	'All modules in the active shop have been reset;',
		'IMVA_DEVGUIDE_CLEARMOD_CLEARALL'				=>	'Reset in all subshops.',
		'IMVA_DEVGUIDE_CLEARMOD_CLEAREDALL'				=>	'All modules have been reset;',
		'IMVA_DEVGUIDE_CLEARMOD_RESTORED'				=>	'the &quot;Entwicklungshelfer&quot; module has been re-activated.',
		'IMVA_DEVGUIDE_CLEARMOD_REVIVED3RDPARTY'		=>	'Drittanbietermodule wurden ebenfalls reaktiviert.',
		'IMVA_DEVGUIDE_CLEARMOD_FAIL'					=>	'Could not reset the module configuration.',
		'IMVA_DEVGUIDE_CLEARMOD_NO3RDPARTY'				=>	'The selected 3rd party modules were not reactivated.',
		'IMVA_DEVGUIDE_CLEARTEMP_DESCR'					=>	'This option will clear the Smarty template cache and the database cache.',
		'IMVA_DEVGUIDE_CLEARTEMP_CLEARED'				=>	'Template cache (tmp/ directory) has been cleared.',
		'IMVA_DEVGUIDE_CLEARTEMP_FAIL'					=>	'Error clearing /tmp/. Check the permissions.',
		'IMVA_DEVGUIDE_CLEARMOD_WARNING'				=>	'This option will disable all modules and reset the configuration.',
		'IMVA_DEVGUIDE_RV_DESCR'						=>	'Rebuilds the database view tables so taht new fields can be accessed through models.',
		'IMVA_DEVGUIDE_RV_CLEARED'						=>	'Database views have been rebuilt.',
		'IMVA_DEVGUIDE_RV_FAIL'							=>	'Error rebuilding database views. It this persists, either a database
															table may be missing or the database structure is damaged.
															',
		'IMVA_DEVGUIDE_LOGVIEWER_CLEARFILE'				=>	'Clear',
		'IMVA_DEVGUIDE_LOGVIEWER_ELMISSEMPTY'			=>	'The selected file is empty.',
		'IMVA_DEVGUIDE_LOGVIEWER_NOTCONF'				=>	'Not configured. Open the module configuration in
															<i>Extensions &raquo; Modules &raquo; Settings</i>
															and enter the path to the error.log file.',
		'IMVA_DEVGUIDE_LOGVIEWER_FAIL'					=>	'Cannot read the selected file.
															It either does not exist or access was denied.',
		
		// Footer
		'IMVA_DEVGUIDE_MANUAL'							=>	'User manual',
		
);

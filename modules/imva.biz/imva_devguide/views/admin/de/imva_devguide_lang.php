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
 * 13/7/5-15/1/25
 * v 0.9.11
 *
 */

$sLangName  = "Deutsch";
$aLang = array(
		'charset'										=>	'UTF-8',
		
		// Group
		'imva_modules_group'							=>	'imva.biz-Module',
		'imva_services_information'						=>	'Informationen',
	
		// Titles
		'imva_devguide'									=>	'Entwicklungshelfer',
		'imva_devguide_cleartemp'						=>	'Cache leeren',
		'imva_devguide_rebuildviews'					=>	'Views neu aufbauen',
		'imva_devguide_clearmod'						=>	'Module zur&uuml;cksetzen',
		'imva_devguide_logviewer'						=>	'Logfiles ansehen',
		
		// Configuration
		'SHOP_MODULE_GROUP_imva_devguide_behaviour'		=>	'Verhalten',
		'SHOP_MODULE_imva_devguide_requestonaction'		=>	'Vor dem Durchf&uuml;hren einer Aktion fragen',
		'SHOP_MODULE_imva_devguide_enableautorevive'	=>	'Nach dem Zur&uuml;cksetzen der Modulkonfiguration dieses Modul reaktivieren',
		'SHOP_MODULE_GROUP_imva_devguide_logging'		=>	'Aufzeichnen',
		'SHOP_MODULE_imva_devguide_enablelogging'		=>	'Durchgef&uuml;hrte Aktionen und Ereignisse aufzeichnen',
		'SHOP_MODULE_GROUP_imva_devguide_settings'		=>	'Weitere Einstellungen',
		'SHOP_MODULE_imva_devguide_pathtoerrorlog'		=>	'Absoluter Pfad zur error.log-Datei des Webservers',
		
		// Dialogue
		'IMVA_DEVGUIDE_CONFIRM'							=>	'Sind Sie sicher?',
		'IMVA_DEVGUIDE_CONFIRM_YES'						=>	'Ja',
		'IMVA_DEVGUIDE_CONFIRM_CANCEL'					=>	'Abbrechen',
		'IMVA_DEVGUIDE_CANCELLED'						=>	'Die Aktion wurde abgebrochen.',
		'IMVA_DEVGUIDE_REDO'							=>	'Wiederholen',
		
		// Main View
		'IMVA_DEVGUIDE_CLEARMOD_ALL'					=>	'... in allen Subshops',
		'IMVA_DEVGUIDE_MAIN_INTRO'						=>	'Dieses Modul erm&ouml;glicht den schnellen Zugriff auf Funktionen, die Sie als
															Entwickler h&auml;ufig brauchen.',
		'IMVA_DEVGUIDE_MAIN_NODIALOGUE'					=>	'Bedenken Sie, dass alle Aktionen sofort und ohne R&uuml;ckfrage ausgef&uuml;hrt
															werden.',
		'IMVA_DEVGUIDE_MAIN_WITHDIALOGUE'				=>	'Bevor eine Aktion durchgef&uuml;hrt wird, wird eine R&uuml;ckfrage angezeigt.',
		'IMVA_DEVGUIDE_MAIN_BEHAVIOUR'					=>	'Um dieses Verhalten zu &auml;ndern, &ouml;ffnen Sie
															<i>Erweiterungen&rarr;Module&rarr;Einstellungen</i>
															und &auml;ndern Sie die Einstellung',
		
		// Views
		'IMVA_DEVGUIDE_TITLE'							=>	'imva.biz: &bdquo;Entwicklungshelfer&rdquo;',
		'IMVA_DEVGUIDE_CLEARMOD_NOREVIVE'				=>	'Die automatische Reaktivierung des Moduls ist nicht aktiv, daher erfolgen
															unterhalb dieser Zeile keine weiteren Ausgaben. In diesem Fall ist dieses
															Verhalten v&ouml;llig normal.',
		'IMVA_DEVGUIDE_CLEARMOD_CLEARED'				=>	'Alle Module im gew&auml;hlten Shop wurden zur&uuml;ckgesetzt;',
		'IMVA_DEVGUIDE_CLEARMOD_CLEARALL'				=>	'Auf alle Subshops anwenden.',
		'IMVA_DEVGUIDE_CLEARMOD_CLEAREDALL'				=>	'Alle Module in allen Shops wurden zur&uuml;ckgesetzt;',
		'IMVA_DEVGUIDE_CLEARMOD_RESTORED'				=>	'das Modul &bdquo;Entwicklungshelfer&rdquo; wurde automatisch reaktiviert.',
		'IMVA_DEVGUIDE_CLEARMOD_FAIL'					=>	'Die Modulkonfiguration konnte nicht zur&uuml;ckgesetzt werden.',
		'IMVA_DEVGUIDE_CLEARTEMP_DESCR'					=>	'Hierdurch werden der Smarty-Template- und der Datenbank-Cache geleert.',
		'IMVA_DEVGUIDE_CLEARTEMP_CLEARED'				=>	'Der Smarty-Template- und der Datenbank-Cache (tmp/-Verzeichnis) wurden geleert.',
		'IMVA_DEVGUIDE_CLEARTEMP_FAIL'					=>	'Fehler beim Leeren von /tmp/. Schreibrechte pr&uuml;fen.',
		'IMVA_DEVGUIDE_CLEARMOD_WARNING'				=>	'Hierdurch werden alle Module deaktiviert und die Konfiguration zurückgesetzt.',
		'IMVA_DEVGUIDE_RV_DESCR'						=>	'Generiert die Datenbank-Views, sodass neu angelegte Felder von Models angesprochen werden können.',
		'IMVA_DEVGUIDE_RV_CLEARED'						=>	'Die Datenbankviews wurden neu aufgebaut.',
		'IMVA_DEVGUIDE_RV_FAIL'							=>	'Fehler beim Neugenerieren der Datenbankviews. Falls dieses Problem wiedeholt,
															auftritt, wurde m&ouml;glicherweise eine Tabelle nicht gefunden oder die Struktur
															ist fehlerhaft.',
		'IMVA_DEVGUIDE_LOGVIEWER_CLEARFILE'				=>	'Datei leeren',
		'IMVA_DEVGUIDE_LOGVIEWER_ELMISSEMPTY'			=>	'Die gewählte Datei ist leer.',
		'IMVA_DEVGUIDE_LOGVIEWER_NOTCONF'				=>	'Nicht konfiguriert. Öffnen Sie die Moduleinstellungen unter
															<i>Erweiterungen&rarr;Module&rarr;Einstellungen</i>
															und geben Sie den Pfad zur Datei error.log ein.',
		'IMVA_DEVGUIDE_LOGVIEWER_FAIL'					=>	'Die gewählte Datei kann nicht gelesen werden.
															Möglicherweise existiert sie nicht oder der Zugriff wurde verweigert.',
		
		// Footer
		'IMVA_DEVGUIDE_MANUAL'							=>	'Benutzerhandbuch',
		
);
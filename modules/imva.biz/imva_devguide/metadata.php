<?php

/**
 * imva.biz Devloper's Guide
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
 * (EULA-13/7)
 *
 *
 *
 * (c) 2013 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/2/8-8/14
 * v 0.8.1
 *
 */

$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
	'id'			=> 'imva_devguide',
	'title'			=> '<img src="../modules/imva.biz/imva_devguide/out/src/imva-Logo-12.png" alt=".iI" title="imva.biz" /> Developer\'s Guide',
	'description'	=> array(
		'en'	=>	'<p>imva.biz Developer\'s Guide supports developers in their work on the shop by providing one-click quick
			access to often executed actions.<br />This module extends the shop admin with a new menu and does not affect the
			regular shop operation.</p>',
		'de'	=>	'<p>Developer\'s Guide, der &bdquo;Entwicklungshelfer&rdquo; unterst&uuml;tzt Entwickler bei der Arbeit am Shop,
			indem er h&auml;ufig durchgef&uuml;hrte Aktionen mit nur einem Klick ausf&uuml;hrt.<br />Dieses Modul erweitert den Shop-Admin um
			ein zus&auml;tzliches Men&uuml;. Das Modul hat keinen Einfluss auf den regul&auml;ren Shopbetrieb.</p>',
	),
	'thumbnail'		=> 'out/src/imva-Logo-90.png',
	'version'		=> '0.8.1',
	'author'		=> 'Johannes Ackermann',
	'url'			=> 'http://imva.biz',
	'email' 		=> 'imva@imva.biz',
	'extend'		=> array(
	),
	'files' => array(
		'imva_devguide_service'				=>	'imva.biz/imva_devguide/application/services/imva_devguide_service.php',
		'imva_devguide_main'				=>	'imva.biz/imva_devguide/application/admin/controllers/imva_devguide_main.php',
		'imva_devguide_clearmod'			=>	'imva.biz/imva_devguide/application/admin/controllers/imva_devguide_clearmod.php',
		'imva_devguide_cleartemp'			=>	'imva.biz/imva_devguide/application/admin/controllers/imva_devguide_cleartemp.php',
		'imva_devguide_rebuildviews'		=>	'imva.biz/imva_devguide/application/admin/controllers/imva_devguide_rebuildviews.php',
	),
	'templates'	=>	array(
		'imva_devguide_main.tpl'			=>	'imva.biz/imva_devguide/application/admin/views/imva_devguide_main.tpl',
		'imva_devguide_clearmod.tpl'		=>	'imva.biz/imva_devguide/application/admin/views/imva_devguide_clearmod.tpl',
		'imva_devguide_cleartemp.tpl'		=>	'imva.biz/imva_devguide/application/admin/views/imva_devguide_cleartemp.tpl',
		'imva_devguide_rebuildviews.tpl'	=>	'imva.biz/imva_devguide/application/admin/views/imva_devguide_rebuildviews.tpl',
	),
	'blocks'	=>	array(
		array(
    		'template' => 'imva_devguide_main.tpl',
    		'block'    => 'imva_header',
    		'file'     => 'out/blocks/imva_header.tpl'
    	),
		array(
    		'template' => 'imva_devguide_main.tpl',
    		'block'    => 'imva_footer',
    		'file'     => 'out/blocks/imva_footer.tpl'
    	),
    	array(
    		'template' => 'imva_devguide_clearmod.tpl',
    		'block'    => 'imva_header',
			'file'     => 'out/blocks/imva_header.tpl'
    	),
    	array(
    		'template' => 'imva_devguide_clearmod.tpl',
    		'block'    => 'imva_footer',
    		'file'     => 'out/blocks/imva_footer.tpl'
    	),
    	array(
			'template' => 'imva_devguide_clearmod.tpl',
			'block'    => 'imva_devguide_confirm',
			'file'     => 'out/blocks/dialogue.tpl'
    	),
		array(
    		'template' => 'imva_devguide_cleartemp.tpl',
    		'block'    => 'imva_header',
    		'file'     => 'out/blocks/imva_header.tpl'
    	),
		array(
    		'template' => 'imva_devguide_cleartemp.tpl',
    		'block'    => 'imva_footer',
    		'file'     => 'out/blocks/imva_footer.tpl'
    	),
    	array(
			'template' => 'imva_devguide_cleartemp.tpl',
			'block'    => 'imva_devguide_confirm',
			'file'     => 'out/blocks/dialogue.tpl'
    	),
		array(
    		'template' => 'imva_devguide_rebuildviews.tpl',
    		'block'    => 'imva_header',
    		'file'     => 'out/blocks/imva_header.tpl'
    	),
		array(
    		'template' => 'imva_devguide_rebuildviews.tpl',
    		'block'    => 'imva_footer',
    		'file'     => 'out/blocks/imva_footer.tpl'
    	),
    	array(
			'template' => 'imva_devguide_rebuildviews.tpl',
			'block'    => 'imva_devguide_confirm',
			'file'     => 'out/blocks/dialogue.tpl'
    	),
    ),
    'settings'	=>	array(
    	array(
    		'group'			=>	'imva_devguide_behaviour',
    		'name'			=>	'imva_devguide_requestonaction',
    		'type'			=>	'bool',
    		'value'			=>	true,
    		'position'		=>	1,
    	),
    	/*
    	array(
			'group'			=>	'imva_devguide_logging',
			'name'			=>	'imva_devguide_enablelogging',
			'type'			=>	'bool',
			'value'			=>	false,
			'position'		=>	1,
    	),
    	*/
    ),
);
<?php

/**
 * IMVA Devloper's Guide
 *
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
 * (c) 2012-2013 imva.biz, Johannes Ackermann, ja@imva.biz
 * @author Johannes Ackermann
 *
 * 13/2/8-7/15
 * v 0.7.1
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
	'version'		=> '0.7.1',
	'author'		=> 'Johannes Ackermann',
	'url'			=> 'http://imva.biz',
	'email' 		=> 'imva@imva.biz',
	'extend'		=> array(
	),
	'files' => array(
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
    		'template' => 'imva_devguide_rebuildviews.tpl',
    		'block'    => 'imva_header',
    		'file'     => 'out/blocks/imva_header.tpl'
    	),
		array(
    		'template' => 'imva_devguide_rebuildviews.tpl',
    		'block'    => 'imva_footer',
    		'file'     => 'out/blocks/imva_footer.tpl'
    	),
    ),
);
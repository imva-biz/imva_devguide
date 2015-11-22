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
 * 13/2/8-15/11/21
 * v 0.9.21
 *
 */

$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
		'id'			=> 'imva_devguide',
		'title'			=> array(
				'de'	=>	'<img src="../modules/imva.biz/imva_devguide/out/img/imva-Logo-12.png" alt=".iI" title="imva.biz" /> Entwicklungshelfer',
				'en'	=>	'<img src="../modules/imva.biz/imva_devguide/out/img/imva-Logo-12.png" alt=".iI" title="imva.biz" /> Developer&rsquo;s Guide',
		),
		'description'	=> array(
				'en'	=>	'<p>imva.biz Developer&rsquo;s Guide (also named <i>Entwicklungshelfer</i>, &quot;development aid worker&quot;)
					supports developers in their work on the shop by providing one-click quick
					access to often executed actions. Very useful for module and template development!<br>
					This module extends the shop admin with a new menu and does not affect the
					regular shop operation.<br>
					We recommend you to keep dialogues enabled when using the module in a <b>production environment</p> or even better, not to
					enable this module.</p>.
					<a href="https://github.com/OXID-eSales/oxideshop_ce/pull/208">Technical details</a>.</p>',
				'de'	=>	'<p>Der Entwicklungshelfer unterst&uuml;tzt OXID-Entwickler bei der Arbeit am Shop,
					indem er bei der Modul- und Templateentwicklung h&auml;ufig ben&ouml;tigte Aktionen mit nur einem Klick ausf&uuml;hrt.<br>
					Dieses Modul erweitert den Shop-Admin um
					ein zus&auml;tzliches Men&uuml;. Das Modul hat keinen Einfluss auf den regul&auml;ren Shopbetrieb.<br>
					Wir empfehlen, im <b>Produktivbetrieb</b> zumindest die R&uuml;ckfragen aktiviert zu lassen, besser jedoch, das Modul nicht
					zu aktivieren.</p>',
		),
		'thumbnail'		=> 'out/img/imva-Logo-90.png',
		'version'		=> '0.9.21',
		'author'		=> 'Johannes Ackermann',
		'url'			=> 'http://imva.biz',
		'email' 		=> 'imva@imva.biz',
		'files'		=> array(
				// functions used by all module classes
				'imva_devguide_base'				=>	'imva.biz/imva_devguide/controllers/admin/imva_devguide_base.php',
				'imva_devguide_service'				=>	'imva.biz/imva_devguide/core/imva_devguide_service.php',
				
				// controllers
				'imva_devguide_clearmod'			=>	'imva.biz/imva_devguide/controllers/admin/imva_devguide_clearmod.php',
				'imva_devguide_cleartemp'			=>	'imva.biz/imva_devguide/controllers/admin/imva_devguide_cleartemp.php',
				'imva_devguide_logviewer'			=>	'imva.biz/imva_devguide/controllers/admin/imva_devguide_logviewer.php',
				'imva_devguide_main'				=>	'imva.biz/imva_devguide/controllers/admin/imva_devguide_main.php',
				'imva_devguide_rebuildviews'		=>	'imva.biz/imva_devguide/controllers/admin/imva_devguide_rebuildviews.php',
		),
		'extend'		=> array(
				// patch
				'oxviewconfig'						=>	'imva.biz/imva_devguide/core/imva_devguide_oxviewconfig',
		),
	    'events'       => array(
	    ),
		'templates'	=>	array(
				// views w/ controllers
				'imva_devguide_clearmod.tpl'		=>	'imva.biz/imva_devguide/views/admin/tpl/imva_devguide_clearmod.tpl',
				'imva_devguide_cleartemp.tpl'		=>	'imva.biz/imva_devguide/views/admin/tpl/imva_devguide_cleartemp.tpl',
				'imva_devguide_logviewer.tpl'		=>	'imva.biz/imva_devguide/views/admin/tpl/imva_devguide_logviewer.tpl',
				'imva_devguide_main.tpl'			=>	'imva.biz/imva_devguide/views/admin/tpl/imva_devguide_main.tpl',
				'imva_devguide_rebuildviews.tpl'	=>	'imva.biz/imva_devguide/views/admin/tpl/imva_devguide_rebuildviews.tpl',
					
				// snippets
				'imva_devguide_cancelled.tpl'		=>	'imva.biz/imva_devguide/views/admin/tpl/inc/imva_devguide_cancelled.tpl',
				'imva_devguide_redo.tpl'			=>	'imva.biz/imva_devguide/views/admin/tpl/inc/imva_devguide_redo.tpl',
		),
		'blocks'	=>	array(
				array(
			    		'template' => 'imva_devguide_logviewer.tpl',
			    		'block'    => 'imva_devguide_header',
			    		'file'     => 'views/blocks/imva_devguide_header.tpl'
		    	),
				array(
			    		'template' => 'imva_devguide_logviewer.tpl',
			    		'block'    => 'imva_devguide_footer',
			    		'file'     => 'views/blocks/imva_devguide_footer.tpl'
		    	),
					
				array(
			    		'template' => 'imva_devguide_main.tpl',
			    		'block'    => 'imva_devguide_header',
			    		'file'     => 'views/blocks/imva_devguide_header.tpl'
		    	),
				array(
			    		'template' => 'imva_devguide_main.tpl',
			    		'block'    => 'imva_devguide_footer',
			    		'file'     => 'views/blocks/imva_devguide_footer.tpl'
		    	),
					
		    	array(
			    		'template' => 'imva_devguide_clearmod.tpl',
			    		'block'    => 'imva_devguide_header',
						'file'     => 'views/blocks/imva_devguide_header.tpl'
		    	),
		    	array(
			    		'template' => 'imva_devguide_clearmod.tpl',
			    		'block'    => 'imva_devguide_footer',
			    		'file'     => 'views/blocks/imva_devguide_footer.tpl'
		    	),
		    	array(
						'template' => 'imva_devguide_clearmod.tpl',
						'block'    => 'imva_devguide_confirm',
						'file'     => 'views/blocks/imva_devguide_dialogue.tpl'
		    	),
					
				array(
			    		'template' => 'imva_devguide_cleartemp.tpl',
			    		'block'    => 'imva_devguide_header',
			    		'file'     => 'views/blocks/imva_devguide_header.tpl'
		    	),
				array(
			    		'template' => 'imva_devguide_cleartemp.tpl',
			    		'block'    => 'imva_devguide_footer',
			    		'file'     => 'views/blocks/imva_devguide_footer.tpl'
		    	),
		    	array(
						'template' => 'imva_devguide_cleartemp.tpl',
						'block'    => 'imva_devguide_confirm',
						'file'     => 'views/blocks/imva_devguide_dialogue.tpl'
		    	),
					
				array(
			    		'template' => 'imva_devguide_rebuildviews.tpl',
			    		'block'    => 'imva_devguide_header',
			    		'file'     => 'views/blocks/imva_devguide_header.tpl'
		    	),
				array(
			    		'template' => 'imva_devguide_rebuildviews.tpl',
			    		'block'    => 'imva_devguide_footer',
			    		'file'     => 'views/blocks/imva_devguide_footer.tpl'
		    	),
		    	array(
						'template' => 'imva_devguide_rebuildviews.tpl',
						'block'    => 'imva_devguide_confirm',
						'file'     => 'views/blocks/imva_devguide_dialogue.tpl'
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
		    	array(
						'group'			=>	'imva_devguide_behaviour',
						'name'			=>	'imva_devguide_enableautorevive',
						'type'			=>	'bool',
						'value'			=>	true,
						'position'		=>	2,
		    	),
		    	array(
						'group'			=>	'imva_devguide_behaviour',
						'name'			=>	'imva_devguide_revive3rdparty',
						'type'			=>	'bool',
						'value'			=>	true,
						'position'		=>	3,
		    	),
		    	array(
						'group'			=>	'imva_devguide_behaviour',
						'name'			=>	'imva_devguide_3rdpartymdllist',
						'type'			=>	'arr',
						'value'			=>	'',
						'position'		=>	4,
		    	),
		    	array(
						'group'			=>	'imva_devguide_settings',
						'name'			=>	'imva_devguide_pathtoerrorlog',
						'type'			=>	'str',
						'value'			=>	'/var/log/apache2/error.log',
						'position'		=>	1,
		    	),
	    ),
);
[{block name='imva_header'}][{/block}]

<h1>[{oxmultilang ident='IMVA_DEVGUIDE_TITLE'}]</h1>
<p>[{oxmultilang ident='IMVA_DEVGUIDE_MAIN_INTRO'}]</p>

[{if $oView->oServ->askMe()}]
	[{oxmultilang ident='IMVA_DEVGUIDE_MAIN_WITHDIALOGUE'}]
[{else}]
	[{oxmultilang ident='IMVA_DEVGUIDE_MAIN_NODIALOGUE'}]
[{/if}]
<br>[{oxmultilang ident='IMVA_DEVGUIDE_MAIN_BEHAVIOUR'}]
<i>[{oxmultilang ident='SHOP_MODULE_imva_devguide_requestonaction'}]</i>.
</p>

<ul>
	<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_cleartemp">[{oxmultilang ident='imva_devguide_cleartemp'}]</a></li>
	<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_rebuildviews">[{oxmultilang ident='imva_devguide_rebuildviews'}]</a></li>
	<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_clearmod">[{oxmultilang ident='imva_devguide_clearmod'}]</a></li>
	[{if $oView->oServ->hasSubshops()}]
	<ul>
		<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_clearmod&amp;shops=all">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_ALL'}]</a></li>
	</ul>
	[{/if}]
	<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_logviewer">[{oxmultilang ident='imva_devguide_logviewer'}]</a></li>
</ul>

[{block name='imva_footer'}][{/block}]
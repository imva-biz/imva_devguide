[{block name='imva_header'}][{/block}]
<div class="content">

<h1>[{oxmultilang ident='IMVA_DEVGUIDE_TITLE'}]</h1>
<p>[{oxmultilang ident='IMVA_DEVGUIDE_MAIN_INTRO'}]</p>

<ul>
	<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_cleartemp">[{oxmultilang ident='imva_devguide_cleartemp'}]</a></li>
	<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_rebuildviews">[{oxmultilang ident='imva_devguide_rebuildviews'}]</a></li>
	<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_clearmod">[{oxmultilang ident='imva_devguide_clearmod'}]</a></li>
	[{if !blIsEE}]
	<ul>
		<li><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_clearmod&amp;shops=all">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_ALL'}]</a></li>
	</ul>
	[{/if}]
</ul>

</div>
[{block name='imva_footer'}][{/block}]
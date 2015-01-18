[{block name='imva_header'}][{/block}]

<h1>[{oxmultilang ident='imva_devguide_clearmod'}]</h1>

[{if !$oView->oServ->isAutoRevive()}]
	[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_NOREVIVE'}]
[{/if}]

[{if $oView->blSuccess}]
	[{if $oView->blAllcleared}]
		<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEAREDALL'}] [{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_RESTORED'}]</p>
	[{else}]
		<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEARED'}] [{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_RESTORED'}]</p>
		[{if $oView->oServ->hasSubshops()}]
			<p><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_clearmod&amp;shops=all&amp;blconfirm=true">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEARALL'}]</a></p>
		[{/if}]
	[{/if}]
[{else}]	
	[{if !$oView->oServ->getP('confirm')}]
		[{block name='imva_devguide_confirm'}][{/block}]
	[{/if}]
[{/if}]

[{if $oView->blFail}]
	<p class="msg err">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_FAIL'}]</p>
[{/if}]

[{block name='imva_footer'}][{/block}]
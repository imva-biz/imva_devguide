[{block name="imva_devguide_header"}][{/block}]
<h1>[{oxmultilang ident='imva_devguide_clearmod'}]</h1>

[{if $oView->blCancelled}]
	[{include file='imva_devguide_cancelled.tpl'}]
[{else}]
	[{if !$DevguideService->isAutoRevive()}]
		[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_NOREVIVE'}]
	[{/if}]
	
	[{if $oView->blSuccess}]
		[{if $oView->blAllcleared}]
			<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEAREDALL'}] [{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_RESTORED'}]</p>
		[{else}]
			<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEARED'}] [{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_RESTORED'}]</p>
			[{if $DevguideService->hasSubshops()}]
				<p><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_clearmod&amp;shops=all&amp;blconfirm=true">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEARALL'}]</a></p>
			[{/if}]
		[{/if}]
		
		[{if $oView->thirdPartyRevive}]
			<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_REVIVED3RDPARTY'}]
			</p>
		[{else}]
			<p class="msg wrn">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_NO3RDPARTY'}]</p>
		[{/if}]
		
		[{include file='imva_devguide_redo.tpl'}]
	[{else}]
		[{if !$DevguideService->getP('confirm')}]
			<p class="msg wrn">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_WARNING'}]</p>
			[{block name='imva_devguide_confirm'}][{/block}]
		[{/if}]
	[{/if}]
	
	[{if $oView->blFail}]
		<p class="msg err">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_FAIL'}]</p>
	[{/if}]
[{/if}]

[{block name="imva_devguide_footer"}][{/block}]

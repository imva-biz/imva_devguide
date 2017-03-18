[{block name="imva_devguide_header"}][{/block}]

<h1>[{oxmultilang ident='imva_devguide_rebuildviews'}]</h1>

[{if $oView->blCancelled}]
	[{include file='imva_devguide_cancelled.tpl'}]
[{else}]
	[{if $oView->blSuccess}]
		<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_RV_CLEARED'}]</p>
		[{include file='imva_devguide_redo.tpl'}]
	[{else}]	
		[{if !$DevguideService->getP('confirm')}]
			[{block name='imva_devguide_confirm'}][{/block}]
		[{/if}]
	[{/if}]
	
	[{if $oView->blFail}]
		<p class="msg err">[{oxmultilang ident='IMVA_DEVGUIDE_RV_FAIL'}]</p>
	[{/if}]
[{/if}]

[{block name="imva_devguide_footer"}][{/block}]

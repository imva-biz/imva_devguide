[{block name='imva_header'}][{/block}]

<h1>[{oxmultilang ident='imva_devguide_cleartemp'}]</h1>

[{if $oView->blSuccess}]
	<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARTEMP_CLEARED'}]</p>
[{else}]	
	[{if !$oView->oServ->getP('confirm')}]
		[{block name='imva_devguide_confirm'}][{/block}]
	[{/if}]
[{/if}]

[{if $oView->blFail}]
	<p class="msg err">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARTEMP_FAIL'}]</p>
[{/if}]

[{block name='imva_footer'}][{/block}]
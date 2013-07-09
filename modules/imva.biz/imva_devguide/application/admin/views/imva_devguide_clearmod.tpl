[{block name='imva_header'}][{/block}]
<div class="content">

[{if $success}]
	[{if $allcleared}]
		<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEAREDALL'}] [{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_RESTORED'}]</p>
	[{else}]
		<p class="msg suc">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEARED'}] [{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_RESTORED'}]</p>
		[{if !blIsEE}]<p><a href="[{$oViewConf->getSelfLink()}]cl=imva_devguide_clearmod&amp;shops=all">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_CLEARALL'}]</a></p>[{/if}]
	[{/if}]
[{else}]
	<p class="msg err">[{oxmultilang ident='IMVA_DEVGUIDE_CLEARMOD_FAIL'}]</p>
[{/if}]

</div>
[{block name='imva_footer'}][{/block}]
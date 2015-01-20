[{block name='imva_header'}][{/block}]

<h1>[{oxmultilang ident='IMVA_DEVGUIDE_TITLE'}]</h1>

<h2>EXCEPTION_LOG.txt</h2>
[{if $oView->showExceptionlog()}]
	<a class="btn green" style="position: relative; top: -30px; left: 220px;"
		href="[{$oViewConf->getSelfLink()}]cl=[{$oView->oServ->getCurrentCl()}]&amp;blconfirm=true">
			[{oxmultilang ident='IMVA_DEVGUIDE_LOGVIEWER_CLEARFILE'}]
	</a>
	
	<div class="y_scroll" style="height: 300px; border: 2px solid #333; pading: 8px;">
		<pre class="mg_10">[{$oView->showExceptionlog()}]</pre>
	</div>
[{else}]
	<p>[{oxmultilang ident='IMVA_DEVGUIDE_LOGVIEWER_ELMISSEMPTY'}]</p>
[{/if}]

<hr>

<h2>error.log</h2>
[{if $oView->showErrorlog()}]	
	<div class="y_scroll" style="height: 300px; border: 2px solid #333; pading: 8px;">
		<pre class="mg_10">[{$oView->showErrorlog()}]</pre>
	</div>
[{else}]
	<p>[{oxmultilang ident='IMVA_DEVGUIDE_LOGVIEWER_FAIL'}]</p>
[{/if}]


[{block name='imva_footer'}][{/block}]
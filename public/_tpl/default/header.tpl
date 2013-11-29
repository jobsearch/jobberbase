<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>{if $seo_title}{$seo_title}{else}{$html_title}{/if}</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
    <meta name="description" content="{if $seo_desc}{$seo_desc}{else}{$meta_description}{/if}" />
    <meta name="keywords" content="{if $seo_keys}{$seo_keys}{else}{$meta_keywords}{/if}" />
	<link rel="shortcut icon" href="{$BASE_URL}favicon.ico" type="image/x-icon" />
	{if $CURRENT_PAGE == '' || $CURRENT_PAGE != 'jobs'}
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="{$BASE_URL}rss/all/" />
	{else}
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="{$BASE_URL}rss/{$current_category}/" />
	{/if}
	<link rel="stylesheet" href="{$BASE_URL}_tpl/{$THEME}/css/screen.css" type="text/css" media="screen" />
	<script src="{$BASE_URL}js/jquery.js" type="text/javascript"></script>
	{if $editor}
	<script src="{$BASE_URL}js/tiny_mce/tiny_mce.js" type="text/javascript"></script>
	{/if}
</head>

<body>
	<div id="container">
		{if $smarty.session.status neq ''}
			<div id="status">
				{$smarty.session.status}
			</div><!-- #status -->
		{/if}
		<div id="header">
			<h1 id="logo"><a href="{$BASE_URL}" title="{$translations.header.title}" style="background:url({$BASE_URL}img.php?q=site_logo) no-repeat !important;">{$translations.header.name}</a></h1>
			<ul id="top">
				{if $navigation.primary != ''}
					{section name=tmp loop=$navigation.primary}
						{if $smarty.const.ENABLE_NEW_JOBS || (!$smarty.const.ENABLE_NEW_JOBS && $navigation.primary[tmp].url != 'post')}
							{if $i==1}<li>&bull;</li>{/if}
							<li><a href="{if $navigation.primary[tmp].outside != 1}{$BASE_URL}{/if}{$navigation.primary[tmp].url}/" title="{$navigation.primary[tmp].title}" >{$navigation.primary[tmp].name}</a></li>
							{assign var=i value=1}
						{/if}
					{/section}
				{/if}
			</ul>
			<div id="the_feed">
				<a href="{$BASE_URL}rss/all/" title="{$translations.header.rss_title}"><img src="{$BASE_URL}_tpl/{$THEME}/img/bt-rss.png" alt="{$translations.header.rss_alt}" /></a>
			</div>
		</div><!-- #header -->
		
		<div id="box">
			<div id="search">
				<form id="search_form" method="post" action="{$BASE_URL}search/">
					<fieldset>
						<div>
							<input type="text" name="keywords" id="keywords" maxlength="30" value="{if $keywords}{$keywords}{else}{$translations.search.default}{/if}" />
							<span id="indicator" style="display: none;"><img src="{$BASE_URL}_tpl/{$THEME}/img/ajax-loader.gif" alt="" /></span>
						</div>
						<div><label class="suggestionTop">{$translations.search.example}</label></div>
					</fieldset>
				</form>
			</div><!-- #search -->
			{if $smarty.const.ENABLE_NEW_JOBS}
			<div class="addJob">
				<a class="postJobBtn" href="{$BASE_URL}post/"><span>{$translations.search.submit}</span></a>
			</div><!-- .addJob -->
			{/if}
		</div><!-- #box -->
		
    <div id="categs-nav">
    	<ul>
			{section name=tmp loop=$categories_with_jobs}
        <li id="{$categories_with_jobs[tmp].var_name}" {if $current_category == $categories_with_jobs[tmp].var_name}class="selected"{/if}><a href="{$BASE_URL}{$URL_JOBS}/{$categories_with_jobs[tmp].var_name}/" title="{$categories_with_jobs[tmp].name}"><span>{$categories_with_jobs[tmp].name}</span><span class="cnr">&nbsp;</span></a></li>
      {/section}
			</ul>
	</div><!-- #categs-nav -->
	<div class="clear"></div>
		
	<div id="sidebar">
		{include file="sidebar.tpl"}
	</div><!-- #sidebar -->

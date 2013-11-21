{include file="header.tpl"}
		
		<div id="content">
			<div id="job-listings">
				{if $jobs}
				  {if count($types) gt 1}
				    <div id="sort-by-type">
				      {$translations.category.display_only}&nbsp; 
					      {section name=tmp loop=$types}
						     <a href="{$BASE_URL}{$URL_JOBS_AT_COMPANY}/{$company_var_name}/{$types[tmp].var_name}/" title="{$current_company} {$types[tmp].name}"><img src="{$BASE_URL}_tpl/{$THEME}/img/icon-{$types[tmp].var_name}.png" alt="{$types[tmp].name} {$translations.companies.jobs_at} {$current_company}" /></a>
				      	{/section}
				     </div><!-- #sort-by-type -->
					{/if}
        {/if}
				<h2>
					{if $current_company}{$translations.companies.jobs_at} {$current_company}{else}{$translations.companies.jobs_at_undisclosed}{/if}
				</h2>
				{include file="posts-loop.tpl"}
			</div><!-- #job-listings -->
		</div><!-- #content -->

{include file="footer.tpl"}
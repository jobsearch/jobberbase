<?php
$type_var_name = '';
	$type_id = 0;
	$typeName = null;
  $paginatorLink = '';
 
  
	$sanitizer = new Sanitizer();
	
	$sql = 'SELECT DISTINCT company FROM '.DB_PREFIX.'jobs';
	$comps = $db->QueryArray($sql);
	if($id === 'undisclosed')
	{
		$company = '';
	}
	else
	{
		$company = false;
		foreach ($comps as $comp)
		{
			if ($sanitizer->sanitize_title_with_dashes($comp['company']) === $id)
			{
				$company = $comp['company'];
				break;
			}
		}
	}
if ($extra)
	{
		$type_var_name = $extra;
	}
	if ($type_var_name != '')
	{
		$type_id = get_type_id_by_varname($type_var_name);
	}
	if ($type_id)
	{
	  $jobsCount =  $job->CountJobsOfCompany($company, $type_id);
	  $typeName = get_type_name_by_id($type_id);
   }
  else
	{
	  $jobsCount =  $job->CountJobsOfCompany($company, null);
   }
	  $paginatorLink = BASE_URL . URL_JOBS_AT_COMPANY . "/$id/";
	
	if (!empty($type_var_name))
	{
		$paginatorLink .= "$type_var_name/";
	}
	if ($company !== false)
	{
$paginator = new Paginator($jobsCount, JOBS_PER_PAGE, @$_REQUEST['p']);
	$paginator->setLink($paginatorLink);
	$paginator->paginate();
	
	$firstLimit = $paginator->getFirstLimit();
	$lastLimit = $paginator->getLastLimit();
 	$the_jobs = array();
	$the_jobs = $job->ApiGetJobsByCompany($type_id, $company, false, false, $firstLimit, JOBS_PER_PAGE);

	$smarty->assign('jobs', $the_jobs);
	$company = stripslashes($company);
	$smarty->assign('current_company', $company);
	$smarty->assign("pages", $paginator->pages_link);
    $smarty->assign('types', get_types_with_jobs(false,false,$company,false));
 	$smarty->assign('jobs_count', $jobsCount);
 	$smarty->assign('type_id', $type_id);
    $smarty->assign('company_var_name', $id);
	

		$html_title = $translations['companies']['are_you_looking'] . ' ' . $company . '?';
		$meta_description = $translations['companies']['meta_part1'] . ' ' . $company . '! ' . $translations['companies']['meta_part2'];
		$template = 'company.tpl';
	}
	else
	{
		// Copied from index.php
		header("HTTP/1.1 404 Not Found");
		// TO-DO: add suggestion if no trailing slash supplied
		$html_title = 'Page unavailable / ' . SITE_NAME;
		$template = 'error.tpl';
	}
?>

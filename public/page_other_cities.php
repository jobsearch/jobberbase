<?php
$type_var_name = '';
	$type_id = 0;
	$typeName = null;
  $typeName = '';
  $paginatorLink = '';
	if ($id)
	{
		$type_var_name = $id;
	}
	
	if ($type_var_name != '')
	{
		$type_id = get_type_id_by_varname($type_var_name);
	}
	if ($type_id)
	{
	$jobCount =  $job->GetJobsCountForCity(null, $type_id);
			$typeName = get_type_name_by_id($type_id);

	}
	else
	{
	$jobCount =  $job->GetJobsCountForCity(0, null);
	}
	$paginatorLink = BASE_URL . "jobs-in-other-cities/";
	
	if (!empty($type_var_name)){
		$paginatorLink .= "$type_var_name/";
		}
	$paginator = new Paginator($jobCount, JOBS_PER_PAGE, @$_REQUEST['p']);
	$paginator->setLink($paginatorLink);
	$paginator->paginate();
	
	$firstLimit = $paginator->getFirstLimit();
	$lastLimit = $paginator->getLastLimit();
	
	$the_jobs = array();
	$the_jobs = $job->GetPaginatedJobsForOtherCities($type_id, $firstLimit, JOBS_PER_PAGE);
	$smarty->assign("pages", $paginator->pages_link);
    $smarty->assign("city_id", null);
	$smarty->assign('jobs', $the_jobs);
    $smarty->assign('types', get_types_with_jobs(false,0,false,false));

	$smarty->assign('seo_title', 'Jobs in other cities');
	$smarty->assign('seo_desc', '');
	$smarty->assign('seo_keys', '');
	
	$template = 'other-cities-jobs-header.tpl';
?>
<?php
	$category == '';
	$category_var_name = $id;
	$category = get_category_by_var_name($category_var_name);
	
	$category_id = $category['id'];
	
	$type_var_name = $extra;
	$type_id = get_type_id_by_varname($type_var_name);
	
	$jobsCount = 0;
	$typeName = null;
		$typeName = '';
if ($id == null || $category == '') 
  {
        redirect_to(BASE_URL . 'page-unavailable/', 301);
        exit;
  }
	if ($type_id)
	{
		$jobsCount =  $job->CountJobs($id, $type_id);
		$typeName = get_type_name_by_id($type_id); 
	}
	else
	{
		$jobsCount =  $job->CountJobs($id);
	}
	
	$paginatorLink = BASE_URL . URL_JOBS . "/$category_var_name/";

	if (!empty($type_var_name)){
		$paginatorLink .= "$type_var_name/";
		}
	$paginator = new Paginator($jobsCount, JOBS_PER_PAGE, @$_REQUEST['p']);
	$paginator->setLink($paginatorLink);
	$paginator->paginate();
	
	$firstLimit = $paginator->getFirstLimit();
	$lastLimit = $paginator->getLastLimit();
	
	$the_jobs = $job->GetPaginatedJobsForCategory($category_id, $firstLimit, JOBS_PER_PAGE, $type_id);

	$smarty->assign("pages", $paginator->pages_link);
	
	$smarty->assign('jobs', $the_jobs);
	$smarty->assign('jobs_count', $jobsCount);
  $smarty->assign("typename", $typeName);
  $smarty->assign('types', get_types_with_jobs($category_id,false,false,false));

	$smarty->assign('current_category', $category_var_name);
	$smarty->assign('current_category_name', $category['name']);

	$smarty->assign('seo_title', empty($category['title']) ? $category['name'] : $category['title']);
	$smarty->assign('seo_desc', $category['description']);
	$smarty->assign('seo_keys', $category['keywords']);

	$template = 'category.tpl';
?>
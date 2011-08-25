<?php
// add unique page settings:
$page_title = 'Elements: Edit Element';
$page_tips = 'None yet.';

if (!$request_parameters) {
	header('Location: ' . ADMIN_WWW_BASE_PATH . '/elements/view/');
}

$page_request = new CASHRequest(
	array(
		'cash_request_type' => 'element', 
		'cash_action' => 'getelement',
		'element_id' => $request_parameters[0]
	)
);

if ($page_request->response['status_uid'] == 'element_getelement_200') {
	
	$elements_data = getElementsData();
	$effective_user = getPersistentData('cash_effective_user');
	
	if ($page_request->response['payload']['user_id'] == $effective_user) {
		$page_title = 'Elements: Edit “' . $page_request->response['payload']['name'] . '”';
	} else {
		header('Location: ' . ADMIN_WWW_BASE_PATH . '/elements/view/');
	}
} else {
	header('Location: ' . ADMIN_WWW_BASE_PATH . '/elements/view/');
}
?>
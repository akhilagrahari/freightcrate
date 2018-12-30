<?php
$data =  $_POST['data'];
$totalCount = $_POST['totalDataCount'];

$title = [];
foreach ($data as $key => $value) {
	// var_dump($value['urlData']);
	array_push($title, get_title($value['urlData'],'title'));
}

function get_title($url, $tagname){
  $fileContent = file_get_contents($url);
  if(strlen($fileContent)>0){
    $fileContent = trim(preg_replace('/s+/', ' ', $fileContent)); 
    preg_match("/\<{$tagname}\>(.*)\<\/{$tagname}\>/",$fileContent,$title); 
    return $title[1];
  }
}

function calulatePercentage($totalCount,$validUrlCount){
	$percent = $validUrlCount/$totalCount;
	return $percent_friendly = number_format( $percent * 100, 2 ) . '%'.' Completed';
}

$response['error'] = false;
$response['data'] = $title;
$response['message'] = calulatePercentage($totalCount,count($data));
echo json_encode($response);
?>
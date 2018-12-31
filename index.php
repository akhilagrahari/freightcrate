<?php
$data =  $_POST['data'];
$totalCount = $_POST['totalDataCount'];

$title = [];
foreach ($data as $key => $value) {
	array_push($title, get_title($value['urlData'],'title'));
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function get_title($url, $tagname){
  $fileContent = file_get_contents(addhttp($url));
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

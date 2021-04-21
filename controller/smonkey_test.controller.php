<?php
Tools::loadInclude('httpclient', 'Requests');

// Requests::register_autoloader();

$token = 'bearer NFth5L5Sh2XJpPbloCfOpER3J.uJ2b97.t-cFQqSwO7L-zrAnP0t3kk23SX8aZ69.3PYbRBuCXLuAbVEeMUvCklm68iXOrapZpOzobaN0ph8paEnXszBqHxL.3s6x-HG';
$end_point = 'https://api.surveymonkey.net/v3/surveys';
$data = ['title' => 'Remote creted survey'];
$header = ['Content-Type' => 'application/json','Authorization' => $token];
$response = Requests::post($end_point, $header, json_encode($data));

var_dump($response->body);


//
// $curl = curl_init();
//
// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.surveymonkey.net/v3/surveys",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS =>"{\n    \"title\": \"Remote created survey\"\n}",
//   CURLOPT_HTTPHEADER => array(
//     "Content-Type: application/json",
//     "Authorization: PKVayrFpSOQeXu-37Ev0Z9frSMlkMbVY6jVy7deS6U4BNL4EVIhgfAcSJgCJIDbJWdodOgM8FCpRxVOm4P2Bk99dWHeC1El9x7CetNQw12aBV73n3Bqxcg1UjVnTllfO"
//   ),
// ));
//
// $response = curl_exec($curl);
//
// curl_close($curl);
// echo $response;


// function runSurvey($accessToken, $apiKey, $endPoint, $action) {
//
//    $baseUrl = 'https://api.surveymonkey.com';
//    $endpoint = '/v2/surveys/get_survey_list?api_key=' . $apiKey;
//
//    $fields = array(
//      'fields' => array(
//        'title','analysis_url','date_created','date_modified'
//      )
//    );
//
//    $fieldsString = json_encode($fields);
//
//    $requestHeaders = array(
//       'Content-Type: application/json',
//       'Authorization: Bearer ' . $accessToken,
//       'Content-Length: ' . strlen($fieldsString)
//    );
//
//    $ch  = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $baseUrl . $endpoint);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $action);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
//
//    $result = curl_exec($ch);
//
//    curl_close($ch);
//
// }

 ?>

<?php
ini_set('display_errors', 1);
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, X-Requested-With');

try{
    $curl = curl_init('https://www.x-rates.com/table/?from=PKR&amount=1');
if ($curl === false) {
    echo('failed to initialize');
}
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.224 Safari/534.10');
$html = curl_exec($curl);


if (!$html) {
    //die("something's wrong!");
    throw new Exception(curl_error($curl), curl_errno($curl));
}
//var_dump(strlen($data));
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$scores = array();
$table = $xpath->query('/html[1]/body[1]/div[2]/div[1]/div[3]/div[1]/div[1]/div[1]/div[1]/table[2]');
$rows = $table->length;
$elLevel = $table->item(0);
$htmlString = $dom->saveHTML($table->item(0));
curl_close($curl);
$r  = array(
    'isError' => false,
    'errorCode' => '',
    'errorMessage' => '',
    'html' => $htmlString
);
echo(json_encode($r));

}
catch(Exception $e) {
        $r  = array(
            'isError' => true,
            'errorCode' => $e->getCode(),
            'errorMessage' => $e->getMessage(),
            'html' => '<p style="color: red">An error occurred</p>'
        );
        echo(json_encode($r));
}
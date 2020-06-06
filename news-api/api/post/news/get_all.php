<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.php';
include_once '../../../models/news.php';

try {
    $database = new Database();
    $db = $database->connect();

    $news = new News($db);

    $res = $news->get_all();
    $num = $res->rowCount();

    $news_arr = array();

    if ($num > 0) {

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $news_item = array(
                'idx' => $news_id,
                'title' => $news_title,
                'desc' => $news_description
            );
            array_push($news_arr, $news_item);
        }
    } else {
    }
    $resp = array(
        'iserror' => false,
        'error' => "",
        'data' => $news_arr
    );
    echo json_encode($resp);
} catch (Exception $e) {
    $resp = array(
        'iserror' => true,
        'error' => $e->getMessage()
    );
    echo json_encode($resp);
}

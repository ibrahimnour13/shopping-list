<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

require "./app/config.php";
require_once "./app/lists.php";

$method = $_SERVER['REQUEST_METHOD'];
$listsModel = new Lists();

if ($method == "GET"){
    retrieve_lists($listsModel);
}
else if ($method == "POST"){
    $endpoint = $_SERVER['PATH_INFO'];
    $refresh = True;

    if ($endpoint == "/add-list"){
        $lists = $listsModel->addList($_POST['name'], $_POST['desc']);
    }
    else if ($endpoint == "/delete-list"){
        $lists = $listsModel->deleteList($_POST['delete_list']);
    }
    else if ($endpoint == "/add-item"){
        $lists = $listsModel->addItem($_POST['add_item'],$_POST['item_name'], $_POST['item_quantity']);
    }
    else if ($endpoint == "/delete-item"){
        $lists = $listsModel->deleteItem($_POST['list'], $_POST['item']);
    }
    else {
        echo "Invalid path";
        $refresh = False;
    }

    if ($refresh) { header("Location: http://localhost:3000"); }
}
else {
    echo "Invalid method";
}


function retrieve_lists($listsModel){
    $lists = $listsModel->getLists();

    for ($x = 0; $x < count($lists); $x++) {
        $name = $lists[$x]['name'];
        $items = $listsModel->getItems($name);
        $lists[$x]['items'] = $items;
    }

    $jsonResponse = json_encode($lists);
    echo $jsonResponse;
}
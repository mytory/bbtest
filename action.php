<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=moneybook', 'root');
}catch(PDOException $e){
    echo $e->getMessage();
}

function add_colon_to_key($arr){
    $new_arr = array();
    foreach ($arr as $key => $value) {
        $new_arr[':' . $key] = $value;
    }

    return $new_arr;
}

$request = json_decode(file_get_contents('php://input'), true);

switch($_SERVER['REQUEST_METHOD']){
    case 'GET' :
        // return
        $sql = 'select * from breakdown';
        $result = $dbh->query($sql);
        echo json_encode($result->fetchAll());
        break;

    case 'POST' :
        // insert
        try {
            $sql = 'insert into breakdown set content = :content, category = :category, amount = :amount, date = :date';
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $mapped = add_colon_to_key($request);
            unset($mapped[':id']);
            $result = $sth->execute($mapped);
            if($result == false){
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
                echo $sth->errorCode();
            }else{
                $request['id'] = $dbh->lastInsertId();
                echo json_encode($request);
            }
        }catch(PDOException $e){
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            echo $e->getMessage();
        }
        break;

    case 'PUT' :
        // update
        echo json_encode($request);
        break;

    case 'DELETE' :
        // delete
        echo json_encode($request);
        break;


}
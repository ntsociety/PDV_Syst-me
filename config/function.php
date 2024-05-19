<?php
include 'dbconnect.php';
session_start();
// input field validation
function validate($inputData)
{
    global $db_connect;
    $validatedData = mysqli_real_escape_string($db_connect, $inputData);
    return trim($validatedData);
}

// redirect from one page to another page with message
function redirect($url, $status, $isSuccess = true, $isAdminUrl = true)
{
    if ($isSuccess) {
        $_SESSION["status"] = $status;
    } else {
        $_SESSION["error"] = $status;
    }
    if ($isAdminUrl) {
        $link = "/pdv-systeme/admin/$url";
    } else {
        $link = $url;
    }
    header("location: $link");
    exit(0);
}

// display message or status after any process
function alertMessage()
{
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-success" id="status_alert" role="alert">' . $_SESSION['status'] . '</div>';
        unset($_SESSION['status']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-warning" id="status_alert" role="alert">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
}

// insert record
function insert($tableName, $data)
{
    global $db_connect;
    $table = validate($tableName);
    $columns = array_keys($data);
    $values = array_values($data);
    $finalColumns = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";
    $query = "INSERT into $table ($finalColumns) values ($finalValues)";
    $result = mysqli_query($db_connect, $query);
    return $result;
}
// update record
function update($tableName, $id, $data)
{
    global $db_connect;
    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";
    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }
    $finalUpdateDataString = substr(trim($updateDataString), 0, -1);
    $query = "UPDATE $table set  $finalUpdateDataString where id = '$id'";
    $result = mysqli_query($db_connect, $query);
    return $result;
}
// get all data record
function getAll($tableName, $status = NULL)
{
    global $db_connect;
    $table = validate($tableName);
    $status = validate($status);

    if ($status == "status") {
        $query = "SELECT * from $table where status = 0";
    } else {
        $query = "SELECT * from $table ";
    }
    return mysqli_query($db_connect, $query);
}
// get by id data record
function getById($tableName, $id)
{
    global $db_connect;
    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * from $table where id = '$id' limit 1";
    $result = mysqli_query($db_connect, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => "Enregistrement trouvé"
            ];
            return $response;
        } else {
            $response = [
                'status' => 404,
                'message' => "Pas de données trouvés"
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => "Quelques choses s'est mal passés"
        ];
        return $response;
    }
}

// delete record
function destroy($tableName, $id)
{
    global $db_connect;
    $table = validate($tableName);
    $id = validate($id);
    $query = "DELETE from $table where id ='$id' limit 1";
    $result = mysqli_query($db_connect, $query);
    return $result;
}

// checkParametId
function checkParametId($type)
{
    if (isset($_GET[$type])) {
        if ($_GET[$type] != "") {
            return validate($_GET[$type]);
        } else {
            return '<h5>Pas de Id trouvé</h5>';
        }
    } else {
        return '<h5>Pas de Id donné</h5>';
    }
}

// json response
function jsonResponse($status, $status_type, $message)
{
    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
// dd
function dd($elemet)
{

    return var_dump($elemet);
}
function getCount($tableName)
{
    global $db_connect;
    $table = validate($tableName);
    $query = "SELECT * from $table";
    $query_run = mysqli_query($db_connect, $query);
    if ($query_run) {
        $totalCount = mysqli_num_rows($query_run);
        return $totalCount;
    } else {
        return "Quelques choses s'est mal passés";
    }
}

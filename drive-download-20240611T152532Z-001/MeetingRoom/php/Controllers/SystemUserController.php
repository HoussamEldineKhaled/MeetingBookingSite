<?php
require '../PDO.php'; 
require '../models/SystemUser.php'; 
require '../services/SystemUserServices.php'; 
class SystemUserController {
    private $SystemUserService;

    public function __construct($pdo) {
        $this->SystemUserService = new SystemUserServices($pdo);
    }

    public function getAllUsers() {
        $users = $this->SystemUserService->getAllUsers();
        header('Content-Type: application/json');
        echo json_encode($users);
    }
    public function getUserById() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['Id'];
        $users = $this->SystemUserService->getUserById($id);
        header('Content-Type: application/json');
        echo json_encode($users);
    }
}


    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $success = $this->SystemUserService->createUser($data);
            if ($success) {
                echo json_encode(array('message' => 'User created successfully'));
            } else {
                echo json_encode(array('error' => 'Failed to create User'));
            }
        }
    }
    public function deleteUser(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['Id'];
            $company = $this->SystemUserService->deleteUser($id);
            header('Content-Type: application/json');
            echo json_encode($company);
        }
    }
    

public function Login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        $result = $this->SystemUserService->login($data);

        if (isset($result['success'])) {
            echo json_encode(array('message' => $result['success']));
        } elseif (isset($result['error'])) {
            echo json_encode(array('error' => $result['error']));
        } else {
            echo json_encode(array('error' => 'Unknown error occurred'));
        }
    }
}

}
$controller = new SystemUserController($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $controller->createUser();
    } else if (isset($_POST['action']) && $_POST['action'] === 'getById') { 
        $controller->getUserById();
    } else if (isset($_POST['action']) && $_POST['action'] === 'login') { 
            $controller->Login();
    }
    else if(isset($_POST['action']) && $_POST['action']==='delete'){
        $controller->deleteUser();
    }
    else{
        $controller->getAllUsers();
    }
}
?>

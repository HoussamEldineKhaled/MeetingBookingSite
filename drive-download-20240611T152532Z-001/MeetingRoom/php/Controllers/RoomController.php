<?php
require '../PDO.php'; 
require '../models/Room.php'; 
require '../services/RoomServices.php'; 
class RoomController {
    private $roomService;

    public function __construct($pdo) {
        $this->roomService = new RoomServices($pdo);
    }

    public function getAllRooms() {
        $rooms = $this->roomService->getAllRooms();
        header('Content-Type: application/json');
        echo json_encode($rooms);
    }
    public function getRoomById(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['Id'];
            $meeting = $this->roomService->getRoomById($id);
            header('Content-Type: application/json');
            echo json_encode($meeting);
    }
}
public function deleteRoom(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['Id'];
        $company = $this->roomService->deleteRoom($id);
        header('Content-Type: application/json');
        echo json_encode($company);
    }
}

    public function createRoom() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $success = $this->roomService->createRoom($data);
            if ($success) {
                echo json_encode(array('message' => 'Room created successfully'));
            } else {
                echo json_encode(array('error' => 'Failed to create room'));
            }
        }
    }
}

$controller = new RoomController($conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $controller->createRoom();
    }  else if (isset($_POST['action']) && $_POST['action'] === 'getById') { 
        $controller->getRoomById();
    }
    else if (isset($_POST['action']) && $_POST['action'] === 'delete') { 
        $controller->deleteRoom();
    } 
        else {
            $controller->getAllRooms();
        }
}  

?>

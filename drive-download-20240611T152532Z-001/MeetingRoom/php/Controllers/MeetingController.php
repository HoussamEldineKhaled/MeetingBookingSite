<?php
require '../PDO.php'; 
require '../models/Meeting.php'; 
require '../services/MeetingServices.php'; 
class MeetingController {
    private $meetingService;

    public function __construct($pdo) {
        $this->meetingService = new MeetingServices($pdo); 
    }

    public function getAllMeetings() {
        $meetings = $this->meetingService->getAllMeetings();
        header('Content-Type: application/json');
        echo json_encode($meetings);
    }

    public function getMeetingById() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['Id'];
            $meeting = $this->meetingService->getMeetingById($id);
            header('Content-Type: application/json');
            echo json_encode($meeting);
        }
    }

    public function createMeeting() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $result = $this->meetingService->createMeeting($data);

            if (isset($result['success'])) {
                echo json_encode(array('message' => $result['success']));
            } elseif (isset($result['error'])) {
                echo json_encode(array('error' => $result['error']));
            } else {
                echo json_encode(array('error' => 'Unknown error occurred'));
            }
        }
    }
    public function deleteMeeting(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['Id'];
            $company = $this->meetingService->deleteMeeting($id);
            header('Content-Type: application/json');
            echo json_encode($company);
        }
    }
    public function getMeetingByManager(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST["Id"];
            $company = $this->meetingService->getMeetingByManager($id);
            header('Content-Type: application/json');
            echo json_encode($company);
        }
    }
}

$meetingController = new MeetingController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $meetingController->createMeeting();
    } else if (isset($_POST['action']) && $_POST['action'] === 'getById') {
        $meetingController->getMeetingById();
    } else if (isset($_POST['action']) && $_POST['action'] === 'getByManager') {
        $meetingController->getMeetingByManager();
    }
    else if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $meetingController->deleteMeeting();
    }
     else {
        $meetingController->getAllMeetings();
    }
}
?>

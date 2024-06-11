<?php
class MeetingServices {
    private $meeting;

    public function __construct($pdo) {
        $this->meeting = new Meeting($pdo);
    }

    public function getAllMeetings() {
        try {
            return $this->meeting->getAllMeetings();
        } catch (PDOException $e) {
            return ["error" => "An error occurred while fetching Meetings: " . $e->getMessage()];
        }
    }
    public function getMeetingByManager($id){
        try {
            return $this->meeting->getMeetingByManager($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while fetching meeting: " . $e->getMessage()];
        }
    }
    public function getMeetingByOtherManagers($id){
        try {
            return $this->meeting->getMeetingByOtherManagers($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while fetching meeting: " . $e->getMessage()];
        }
    }
    public function getMeetingById($id) {
        try {
            return $this->meeting->getMeetingById($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while fetching meeting: " . $e->getMessage()];
        }
    }

    public function createMeeting($data) {
        try {
            $result = $this->meeting->createMeeting($data);
            if ($result) {
                return ["success" => "Meeting created successfully."];
            } else {
                return ["error" => "Meeting creation failed."];
            }
        } catch (PDOException $e) {
            return ["error" => "An error occurred while creating meeting: " . $e->getMessage()];
        }
    }
    public function deleteMeeting($id){
        try {
            return $this->meeting->deleteMeeting($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while deleting meeting: " . $e->getMessage()];
        }
    }
}

?>
<?php
class RoomServices {
    private $room;

    public function __construct($pdo) {
        $this->room = new Room($pdo);
    }

    public function getAllRooms() {
        try{
        return $this->room->getAllRooms();
        }
        catch (PDOException $e) {
            return ["error" => "An error occurred while fetching rooms: " . $e->getMessage()];
        }
    }

    public function createRoom($data) {
        try {
            $result =$this->room->createRoom($data);
            if ($result) {
                return ["success" => "Room created successfully."];
            } else {
                return ["error" => "Room creation failed."];
            }
        } catch (PDOException $e) {
            return ["error" => "An error occurred while creating Room: " . $e->getMessage()];
        }
    }
    public function getRoomById($id){
        try{
        return $this->room->getRoomById($id);
        }
        catch (PDOException $e) {
            return ["error" => "An error occurred while fetching Room: " . $e->getMessage()];
        }

    }
    public function getRoomByCompany($id){
        try{
        return $this->room->getRoomByCompany($id);
        }
        catch (PDOException $e) {
            return ["error" => "An error occurred while fetching Room: " . $e->getMessage()];
        }

    }
    public function deleteRoom($id){
        try {
            return $this->room->deleteRoom($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while deleting room: " . $e->getMessage()];
        }
    }
}
?>

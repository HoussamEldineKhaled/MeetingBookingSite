<?php
class Meeting{
 private $pdo;
    
 public function __construct($pdo) {
     $this->pdo = $pdo;
 }
 
 public function getAllMeetings() {
     $query = "SELECT * FROM Meeting";
     $stmt = $this->pdo->query($query);
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
 public function getMeetingByManager($id){
    $query = "SELECT * FROM Meeting WHERE MeetingManagerId= :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
 public function getMeetingById($id) {
    $query = "SELECT * FROM Meeting WHERE ReservationId = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 public function createMeeting($data) {
    $StartTime = $data['StartTime'];
    $EndTime = $data['EndTime'];
    $RelatedRoom = $data['RelatedRoom'];
    $getRoom = "SELECT RoomId FROM Room WHERE RoomLocation = :RelatedRoom";
    $stmt2 = $this->pdo->prepare($getRoom);
    $stmt2->bindParam(':RelatedRoom', $RelatedRoom);
    $stmt2->execute();
    $result = $stmt2->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        return false;
    }

    $roomId = $result['RoomId'];
    $NumberAttendees=$data['NumberOfAttendees'];
    $Status=$data['MeetingStatus'];
    //$duration=$data['Duration'];
    $Manager=$data['MeetingManagerId'];
    $query = "INSERT INTO Meeting(StartTime, EndTime, RelatedRoom, NumberOfAttendees, MeetingStatus, MeetingManagerId) VALUES (:StartTime,:EndTime,:RelatedRoom,:NumberAttendees,:MeetingStatus,:Manager)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':StartTime', $StartTime);
    $stmt->bindParam(':EndTime', $EndTime);
    $stmt->bindParam(':RelatedRoom', $roomId);
    $stmt->bindParam(':NumberAttendees', $NumberAttendees);
    $stmt->bindParam(':MeetingStatus', $Status);
    $stmt->bindParam(':Manager', $Manager);
    return $stmt->execute();
}
public function deleteMeeting($id){
    $sql = "DELETE FROM Meeting WHERE ReservationId = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
 }
}

?>
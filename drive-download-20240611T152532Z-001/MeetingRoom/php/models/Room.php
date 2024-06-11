<?php
class Room{
 private $pdo;
    
 public function __construct($pdo) {
     $this->pdo = $pdo;
 }
 
 public function getAllRooms() {
     $query = "SELECT * FROM Room";
     $stmt = $this->pdo->query($query);
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
 public function getRoomById($id) {
    $query = "SELECT * FROM Room WHERE RoomId = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function createRoom($data) {
    $roomLocation = $data['RoomLocation'];
    $roomCapacity = $data['RoomCapacity'];
    $roomDescription = $data['RoomDescription'];
    $companyName = $data['CompanyName'];
    
    $getCompany = "SELECT * FROM Company WHERE CompanyName = :companyName";
    $stmt2 = $this->pdo->prepare($getCompany);
    $stmt2->bindParam(':companyName', $companyName);
    $stmt2->execute();
    $result = $stmt2->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        return false;
    }

    $relatedCompany = $result['CompanyId'];
    $query = "INSERT INTO Room (RoomLocation, RoomCapacity, RoomDescription, RelatedCompany) VALUES (:roomLocation, :roomCapacity, :roomDescription, :relatedCompany)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':roomLocation', $roomLocation);
    $stmt->bindParam(':roomCapacity', $roomCapacity);
    $stmt->bindParam(':roomDescription', $roomDescription);
    $stmt->bindParam(':relatedCompany', $relatedCompany);
    return $stmt->execute();
}
public function deleteRoom($id){
    $sql = "DELETE FROM Room WHERE RoomId = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
 }


}
?>
<?php
class Company{
 private $pdo;
    
 public function __construct($pdo) {
     $this->pdo = $pdo;
 }
 
 public function getAllCompanies() {
     $query = "SELECT * FROM Company";
     $stmt = $this->pdo->query($query);
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
 public function getCompanyById($id) {
    $query = "SELECT * FROM Company WHERE CompanyId = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 public function createCompany($data){
  
    $CompanyName=$data['CompanyName'];
    $CompanyDescription=$data['CompanyDescription'];
    $Email=$data['CompanyEmail'];
    $logo=$data['CompanyLogo'];
    $active=$data['CompanyActive'];
    $query='INSERT INTO Company(CompanyName, CompanyDescription, CompanyEmail, CompanyLogo, CompanyActive) VALUES (:CompanyName, :CompanyDescription, :Email, :logo, :active)';
    $stmt=$this->pdo->prepare($query);
    $stmt->bindParam(':CompanyName',$CompanyName);
    $stmt->bindParam(':CompanyDescription',$CompanyDescription);
    $stmt->bindParam(':Email',$Email);
    $stmt->bindParam(':logo',$logo);
    $stmt->bindParam(':active',$active);
    return $stmt->execute();


 }
 public function deleteCompany($id){
    $sql = "DELETE FROM Company WHERE CompanyId = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
 }
}
?>
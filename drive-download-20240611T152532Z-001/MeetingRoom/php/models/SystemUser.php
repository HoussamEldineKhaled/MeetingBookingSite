<?php
class SystemUser{
    private $pdo;
    public function __construct($PDO){
        $this->pdo=$PDO;
    }
    public function getAllUsers(){
        $query = "SELECT * FROM SystemUser";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserById($id) {
        $query = "SELECT * FROM SystemUser WHERE Id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function createUser($data) {
        $Name = $data['Name'];
        $Birth = $data['Birth'];
        $Gender = $data['Gender'];
        $Email = $data['Email'];
        $Password = $data['Password'];
        $Role = $data['Role'];
        $CompanyName = $data['Company'];
    
        
    
        $getCompany = "SELECT * FROM Company WHERE CompanyName = :companyName";
        $stmt2 = $this->pdo->prepare($getCompany);
        $stmt2->bindParam(':companyName', $CompanyName);
        $stmt2->execute();
        $result = $stmt2->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            return ["error" => "Company not found"];
        }
    
        $relatedCompany = $result['CompanyId'];
   
      
        $query = 'INSERT INTO SystemUser(UserName, Birth, Gender, Email, UserPassword, UserRole, CompanyId) VALUES (:UName, :Birth, :Gender, :Email, :Passwordd, :Rolee, :CompanyId)';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':UName', $Name);
        $stmt->bindParam(':Birth', $Birth);
        $stmt->bindParam(':Gender', $Gender);
        $stmt->bindParam(':Email', $Email);
        $stmt->bindParam(':Passwordd', $Password);
        $stmt->bindParam(':Rolee', $Role);
        $stmt->bindParam(':CompanyId', $relatedCompany);

    
    
        
        return $stmt->execute();
            
    }
    
    
     public function Login($data) {
        $email = $data['Email'];
        $pass = $data['Password'];
    
       
        
    
        $query = "SELECT Id FROM SystemUser WHERE Email = :email AND UserPassword = :pass";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteUser($id){
        $sql = "DELETE FROM SystemUser WHERE Id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
     }
    


}
?>
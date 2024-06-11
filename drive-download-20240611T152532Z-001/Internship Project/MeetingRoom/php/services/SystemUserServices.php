<?php
class SystemUserServices {
    private $SystemUser;

    public function __construct($pdo) {
        $this->SystemUser = new SystemUser($pdo);
    }

    public function getAllUsers() {
        try {
            return $this->SystemUser->getAllUsers();
        } catch (PDOException $e) {
            return ["error" => "An error occurred while fetching Users: " . $e->getMessage()];
        }
    }

    public function getUserById($id) {
        try {
            return $this->SystemUser->getUserById($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while fetching User: " . $e->getMessage()];
        }
    }

    public function createUser($data) {
        try {
            $result = $this->SystemUser->createUser($data);
            if ($result) {
                return ["success" => "User created successfully."];
            } else {
                return ["error" => "User creation failed."];
            }
        } catch (PDOException $e) {
            return ["error" => "An error occurred while creating User: " . $e->getMessage()];
        }
    }
    public function Login($data) {
        try {
            $result = $this->SystemUser->Login($data);
    
            if ($result) {
                
                if (isset($result['Id'])) {
                    session_start();
                    
                    $_SESSION['Id'] = $result['Id'];
                    
                    if (isset($result['UserName'])) {
                        $_SESSION['UserName'] = $result['UserName'];
                    }
                    
                    if (isset($result['UserRole'])) {
                        $_SESSION['UserRole'] = $result['UserRole'];
                    }
                    if (isset($result['UserRole'])) {
                        $_SESSION['UserRole'] = $result['UserRole'];
                    }
                    if (isset($result['CompanyId'])) {
                        $_SESSION['UserCompany'] = $result['CompanyId'];
                    }
                return ["success" => "".$result['UserRole']];


            } 
            
        }else {
                return ["error" => "Login failed."];
            }
        } catch (PDOException $e) {
            return ["error" => "An error occurred while logging in: " . $e->getMessage()];
        }
    }
    public function deleteUser($id){
        try {
            return $this->SystemUser->deleteUser($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while deleting User: " . $e->getMessage()];
        }
    }
    }


?>
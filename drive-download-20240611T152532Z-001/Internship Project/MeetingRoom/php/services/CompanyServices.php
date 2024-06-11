<?php
class CompanyServices {
    private $company;

    public function __construct($pdo) {
        $this->company = new Company($pdo);
    }

    public function getAllCompanies() {
        try {
            return $this->company->getAllCompanies();
        } catch (PDOException $e) {
            return ["error" => "An error occurred while fetching Companies: " . $e->getMessage()];
        }
    }

    public function getCompanyById($id) {
        try {
            return $this->company->getCompanyById($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while fetching company: " . $e->getMessage()];
        }
    }
    

    public function createCompany($data) {
        try {
            $result = $this->company->createCompany($data);
            if ($result) {
                return ["success" => "Company created successfully."];
            } else {
                return ["error" => "Company creation failed."];
            }
        } catch (PDOException $e) {
            return ["error" => "An error occurred while creating Company: " . $e->getMessage()];
        }
    }
    public function deleteCompany($id){
        try {
            return $this->company->deleteCompany($id);
        } catch (PDOException $e) {
            return ["error" => "An error occurred while deleting company: " . $e->getMessage()];
        }
    }
}
?>
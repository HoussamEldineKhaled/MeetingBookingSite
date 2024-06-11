<?php
require '../PDO.php'; 
require '../models/Company.php'; 
require '../services/CompanyServices.php'; 
class CompanyController {
    private $companyService;

    public function __construct($pdo) {
        $this->companyService = new CompanyServices($pdo); 
    }

    public function getAllCompanies() {
        $companies = $this->companyService->getAllCompanies();
        header('Content-Type: application/json');
        echo json_encode($companies);
    }

    public function getCompanyById() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['Id'];
            $company = $this->companyService->getCompanyById($id);
            header('Content-Type: application/json');
            echo json_encode($company);
        }
    }

    public function createCompany() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $success = $this->companyService->createCompany($data);
            if ($success) {
                echo json_encode(array('message' => 'Company created successfully'));
            } else {
                echo json_encode(array('error' => 'Failed to create Company'));
            }
        }
    }

    public function deleteCompany(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['Id'];
            $company = $this->companyService->deleteCompany($id);
            header('Content-Type: application/json');
            echo json_encode($company);
        }
    }
}


$companyController = new CompanyController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $companyController->createCompany();
    } else if (isset($_POST['action']) && $_POST['action'] === 'getById') {
        $companyController->getCompanyById();
    } else if (isset($_POST['action'])&& $_POST['action']==='delete'){
        $companyController->deleteCompany();
    }  
    else {
        $companyController->getAllCompanies();
    }
}
?>

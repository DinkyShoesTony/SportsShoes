<?php
/**
 * Class to to handle Employee data
 */
class Employees
{
    /**
     * Returns and array of employees
     *
     * @return array
     */
    public static function getEmployees(): array
    {
        $pdo = Database::getInstance();

        $employees = [];

        $q = "SELECT
					employee.firstname, employee.lastname, employee_email.email_address, company.company_name
				FROM
					company_employees
					INNER JOIN company ON (company_employees.company_id = company.company_id)
					INNER JOIN employee_email ON (employee_email.email_id = company_employees.email_id)
					INNER JOIN employee ON (employee.employee_id = company_employees.employee_id)";

        $sth = $pdo->prepare($q);

        $sth->execute();

        $employees = $sth->fetchAll(PDO::FETCH_OBJ);

        return $employees;
    }

    /**
     * Add a new employee to the company_employees table
     *
     * @param integer $companyId
     * @param string $firstName
     * @param string $lastName
     * @param string $emailAddress
     * @throws Exception
     * @return integer
     */
    public static function addCompanyEmployee(
        $companyId,
        $firstName,
        $lastName,
        $emailAddress): int {
        $companyEmployeeId = 0;

        $pdo = Database::getInstance();

        $emailId = Employees::addEmail($emailAddress);

        if (!$emailId) {
            throw new Exception("Failed when saving email");
        }

        $employeeId = Employees::addEmployee($firstName, $lastName);

        if (!$employeeId) {
            throw new Exception("Failed generating employee record");
        }

        if ($companyId && is_numeric($companyId)) {

            // Dies the company exist?
            if (!Company::getCompany($companyId)) {
                throw new Exception("Company {$companyId} does not exist in the database");
            }

            $q = "INSERT INTO company_employees (company_id, email_id, employee_id)
					VALUES (:company_id, :email_id, :employee_id)";

            $sth = $pdo->prepare($q);

            $sth->bindParam(":company_id", $companyId);
            $sth->bindParam(":email_id", $emailId);
            $sth->bindParam(":employee_id", $employeeId);

            $sth->execute();

            $companyEmployeeId = $pdo->lastInsertId();
        }

        return $companyEmployeeId;
    }

    /**
     * saves an employee name to the data base
     *
     * @param string $firstName
     * @param string $lastName
     * @throws Exception
     * @return integer
     */
    public static function addEmployee($firstName, $lastName): int
    {
        $employeeId = 0;

        if (empty($firstName) || strlen($firstName) >= 100) {
            throw new Exception("You must provide a valid first name between 1 and 100 characters");
        }

        if (empty($lastName) || strlen($lastName) >= 100) {
            throw new Exception("You must provide a valid last name between 1 and 100 characters");
        }

        $q = "INSERT INTO
					employee (firstname, lastname)
				VALUES (:firstname, :lastname)";

        $pdo = Database::getInstance();

        try {

            $sth = $pdo->prepare($q);

            $sth->bindParam(':firstname', $firstName, PDO::PARAM_STR);

            $sth->bindParam(':lastname', $lastName, PDO::PARAM_STR);

            $sth->execute();

            $employeeId = $pdo->lastInsertId();

        } catch (Exception $e) {

            throw $e;
        }

        return $employeeId;
    }

    /**
     * Saves email to database - the email must not already exist in the database
     *
     * @param string $emailAddress
     * @throws Exception
     * @return integer
     */
    public static function addEmail($emailAddress): int
    {
        $email_id = 0;

        // is it a valid email address
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email provided is invalid");
        }

        $q = "INSERT INTO
					employee_email (email_address)
				VALUES (:email_address)";

        $pdo = Database::getInstance();

        try {

            $sth = $pdo->prepare($q);

            $sth->bindParam(':email_address', $emailAddress, PDO::PARAM_STR);

            $sth->execute();

            $email_id = $pdo->lastInsertId();

        } catch (Exception $e) {

            throw $e;
        }

        return $email_id;
    }
}

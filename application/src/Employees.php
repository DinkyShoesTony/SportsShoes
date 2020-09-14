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

        return $employees;
    }
}

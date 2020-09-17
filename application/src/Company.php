<?php
/**
 * Class to to handle Employee data
 */
class Company
{
    /**
     * Returns and array of employees
     *
     * @return array
     */
    public static function getAllCompanies(): array
    {
        $pdo = Database::getInstance();

        $companies = [];

        $q = "SELECT
					company_id, company_name, company_location, company_domain
				FROM company;";

        $sth = $pdo->prepare($q);

        $sth->execute();

        $companies = $sth->fetchAll(PDO::FETCH_OBJ);

        return $companies;
    }

    /**
     * Adds a new company to the database
     * tuple $companyName and $companyLocation must be unique
     *
     * @param string $companyName
     * @param string $companyLocation
     *
     * @throws Exception
     * @return integer
     */
    public static function addCompany($companyName, $companyLocation): int
    {
        $companyId = 0;

        // Sanity?
        if (empty($companyName) || empty($companyLocation)) {
            throw new Exception('You must provide both a company name and a company location');
        }

        // Size?
        if (strlen($companyName) >= 120 || strlen($companyLocation) >= 120) {
            throw new Exception('Company name and a company location must be fewer then 120 characters');
        }

        $q = "INSERT INTO
				company (company_name, company_location)
			  VALUES
			  	(:company_name, :company_location);";

        $pdo = Database::getInstance();

        try {

            $sth = $pdo->prepare($q);

            $sth->bindParam(':company_name', $companyName, PDO::PARAM_STR);

            $sth->bindParam(':company_location', $companyLocation, PDO::PARAM_STR);

            $sth->execute();

            $companyId = $pdo->lastInsertId();

        } catch (Exception $e) {

            throw $e;
        }

        return $companyId;
    }

    /**
     * Returns company data
     *
     * @param string $companyId
     * @return object
     */
    public static function getCompany($companyId)
    {
        $pdo = Database::getInstance();

        $q = "SELECT company_id, company_name, company_location
				 FROM company
				 WHERE company_id = ? LIMIT 1";

        $sth = $pdo->prepare($q);

        $sth->execute([$companyId]);

        return $sth->fetch(PDO::FETCH_OBJ);
    }
}

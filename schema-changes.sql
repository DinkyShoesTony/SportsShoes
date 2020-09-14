-- Normalise the database - Create table to store realtionships
CREATE TABLE `company_employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `email_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=') ENGINE=InnoDB DEFAULT CHARSET=utf8;';

--  Add a company_id to the company
ALTER TABLE `company` ADD `company_id` INT  UNSIGNED  NOT NULL  AUTO_INCREMENT  PRIMARY KEY  AFTER `company_name`;

-- Add domains so we can reliably link the the email table
ALTER TABLE `SportsShoesTest`.`company` ADD COLUMN `company_domain` varchar(255) NULL COMMENT '';
UPDATE `SportsShoesTest`.`company` SET `company_domain` = 'Sportsshoes.com' WHERE `company_id` = '1';
UPDATE `SportsShoesTest`.`company` SET `company_domain` = 'b-sporting-ltd.com' WHERE `company_id` = '2';

-- Copy relationshiops to the 
INSERT INTO company_employees (employee_id, company_id, email_id) SELECT
	employee_id, company_id, email_id
FROM
	`SportsShoesTest`.employee
	INNER JOIN employee_email ON (LOWER(CONCAT(SUBSTRING(employee.firstname, 1, 1), ".", employee.lastname)) = SUBSTRING_INDEX(employee_email.email_address, "@", 1))
	LEFT JOIN company ON (SUBSTRING_INDEX(employee_email.email_address, "@", -1) like concat("%", LOWER(company.company_domain), "%"))

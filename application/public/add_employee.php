<?php
require_once __DIR__ . "/../init/database.php";
require_once __DIR__ . "/../src/Company.php";
require_once __DIR__ . "/../src/Employees.php";

// Handle for submission actions
$errors = "";

if (!empty($_POST["submit"]) && $_POST["submit"] == "Add") {

    $pdo = Database::getInstance();
    $pdo->beginTransaction();
    try {
        Employees::addCompanyEmployee(
            trim($_POST["company_id"]),
            trim($_POST['firstname']),
            trim($_POST['lastname']),
            trim($_POST['email_address'])
        );
        $pdo->commit();
    } catch (PDOException $e) {

        // OPTIONAL: sanitize DB errors to increase security
        $pdo->rollback();
        $errors = "Unknown database error has occurred.  Possible duplicate entry.";

    } catch (Exception $e) {

        // Error when trying to save to database.
        // Capture the error and roll back the transaction
        $pdo->rollback();
        $errors = $e->getMessage();
    }
}

$companies = Company::getAllCompanies();

$employees = Employees::getEmployees();

?>
<html>

    <head>
        <title>SportsShoes.com PHP Test</title>
        <link rel="stylesheet" type="text/css" href="css/default.css" media="screen" />
    </head>

    <body>
        <?php include 'includes/header.inc.php';?>
        <div class="content">
            <h1>Add Employee</h1>
            <form method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?=$employee->company_name?></td>
                            <td><?=$employee->firstname?></td>
                            <td><?=$employee->lastname?></td>
                            <td><?=$employee->email_address?></td>
                            <td></td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="5" class="error"><?=!empty($errors) ? $errors : "&nbsp;";?></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="company_id">
                                    <?php foreach ($companies as $company): ?>
                                    <option value="<?=$company->company_id?>"><?=$company->company_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </td>
                            <td><input type="text" name="firstname"></td>
                            <td><input type="text" name="lastname"></td>
                            <td><input type="text" name="email_address"></td>
                            <td><input type="submit" name='submit' value="Add" class="button"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <!-- <script src="js/scripts.js"></script> -->
    </body>
</html>
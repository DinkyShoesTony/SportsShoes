<?php
require_once __DIR__ . "/../init/database.php";
require_once __DIR__ . "/../src/Company.php";

// Handle for submission actions
$errors = "";

if (!empty($_POST["submit"]) && $_POST["submit"] == "Add") {

    try {
        Company::addCompany(trim($_POST["company_name"]), trim($_POST['company_location']));

    } catch (Exception $e) {

        // Error when trying to save company to database. Capture the error.
        $errors = $e->getMessage();
    }
}

$companies = Company::getAllCompanies();

?>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/default.css" media="screen" />
        <title>SportsShoes.com PHP Test</title>
    </head>

    <body>
        <?php include 'includes/header.inc.php';?>
        <div class="content">
            <h1>Add Company</h1>
            <form method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Company Location</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($companies as $company): ?>
                        <tr>
                            <td><?=$company->company_name;?></td>
                            <td><?=$company->company_location;?></td>
                            <td></td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="3" class='error'><?=!empty($errors) ? $errors : "&nbsp;";?></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="company_name"></td>
                            <td><input type="text" name="company_location"></td>
                            <td><input type="submit" name="submit" value="Add" class="button"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <!-- <script src="js/scripts.js"></script> -->
    </body>
</html>
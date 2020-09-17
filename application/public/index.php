<?php
require_once __DIR__ . "/../init/database.php";
require_once __DIR__ . "/../src/Employees.php";

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
            <h1>Employees</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Company</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?=$employee->firstname;?></td>
                        <td><?=$employee->lastname;?></td>
                        <td><?=$employee->company_name;?></td>
                        <td><?=$employee->email_address;?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <!-- <script src="js/scripts.js"></script> -->
    </body>

</html>
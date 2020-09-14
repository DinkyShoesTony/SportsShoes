<html>

    <head>
        <title>SportsShoes.com PHP Test</title>
        <link rel="stylesheet" type="text/css" href="css/default.css" media="screen" />
    </head>

    <body>
        <?php include 'includes/header.inc.php'; ?>
        <div class="content">
            <h1>Add Employee</h1>
            <form>
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
                        <tr>
                            <td>
                                <select name="company_id">
                                    <option value=""></option>
                                </select>
                            </td>
                            <td><input type="text" name="firstname"></td>
                            <td><input type="text" name="lastname"></td>
                            <td><input type="text" name="email_address"></td>
                            <td><input type="submit" value="Add" class="button"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <script src="js/scripts.js"></script>
    </body>

</html>
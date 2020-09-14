<html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/default.css" media="screen" />
        <title>SportsShoes.com PHP Test</title>
    </head>

    <body>
        <?php include 'includes/header.inc.php'; ?>
        <div class="content">
            <h1>Add Company</h1>
            <form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Company Location</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="company_name"></td>
                            <td><input type="text" name="company_location"></td>
                            <td><input type="submit" value="Add" class="button"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <script src="js/scripts.js"></script>
    </body>

</html>
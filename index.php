<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        if (isset($_GET['page'])) {

            if ($_GET['page'] == 'add') {
                require_once("pages/add_perturbation.php");
            }
        }

    ?>
</body>
</html>


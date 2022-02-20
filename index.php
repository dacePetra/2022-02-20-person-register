<?php
require_once 'vendor/autoload.php';
?>
    <html lang="en">
    <head>
        <title>Registry</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1>Feel lucky?</h1>
    <div>
        <h2>Register now to win free TESLA!</h2>
        <p>Fill in the data!</p>
        <form method="post">
            <input type="text" name="name" placeholder="Name"><br><br>
            <input type="text" name="surname" placeholder="Surname"><br><br>
            <input type="text" name="personalcode" placeholder="Personal code"><br><br>
            <button type="submit" name="submit">SUBMIT</button>
        </form>
    </div>
    <div>
        <table>
            <tr>
                <th>Nr.</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Personal code</th>
            </tr>
            <?php
            $connection = new App\DBConnect();
            $i = 1;
            foreach ($connection->connect()->iterateAssociativeIndexed(
                'SELECT id, name, surname, personalcode FROM register') as $id => $entry): ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $entry['name']; ?></td>
                    <td><?php echo $entry['surname']; ?></td>
                    <td><?php echo substr($entry['personalcode'], 0, 4) . "..."; ?></td>
                </tr>
                <?php $i++;
            endforeach; ?>
        </table>
    </div>
    </body>
    </html>
<?php

if (isset($_POST["submit"])) {
    // Getting the data
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $personalCode = $_POST["personalcode"];

    // Instantiate RegistryContr class
    $registry = new App\RegistryContr($name, $surname, $personalCode);

    // Running error handlers and person registration
    $registry->registerPerson();

    // Going back
    header("location: ../index.php?successfulregistration");
}

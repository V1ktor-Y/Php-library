<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alexandria</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/style.css">

    <!-- Import google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luxurious+Roman&display=swap" rel="stylesheet">
</head>

<body>
    <div class="bg"></div>
    <div class="title-card"><a href="home.php">LIBRARY OF ALEXANDRIA</a></div>
    <div class="dropdown-create">
        <button class="dropbtn">Create</button>
        <div class="dropdown-content">
            <a href="./createAuthor.php">Author</a>
            <a href="./createBook.php">Book</a>
            <a href="./createBorrow.php">Borrow</a>
            <a href="./createEmployee.php">Employee</a>
            <a href="./createGenre.php">Genre</a>
            <a href="./createPosition.php">Position</a>
            <a href="./createClient.php">Client</a>
        </div>
    </div>

    <div class="dropdown-update">
        <button class="dropbtn">Update</button>
        <div class="dropdown-content">
            <a href="../Update/updateAuthor.php">Author</a>
            <a href="../Update/updateBook.php">Book</a>
            <a href="../Update/updateBorrow.php">Borrow</a>
            <a href="../Update/updateEmployee.php">Employee</a>
            <a href="../Update/updateGenre.php">Genre</a>
            <a href="../Update/updatePosition.php">Position</a>
            <a href="../Update/updateClient.php">Client</a>
        </div>
    </div>

    <div class="dropdown-delete">
        <button class="dropbtn">Delete</button>
        <div class="dropdown-content">
            <a href="../Delete/deleteAuthor.php">Author</a>
            <a href="../Delete/deleteBook.php">Book</a>
            <a href="../Delete/deleteBorrow.php">Borrow</a>
            <a href="../Delete/deleteEmployee.php">Employee</a>
            <a href="../Delete/deleteGenre.php">Genre</a>
            <a href="../Delete/deletePosition.php">Position</a>
            <a href="../Delete/deleteClient.php">Client</a>
        </div>
    </div>

    <div class="dropdown-read">
        <button class="dropbtn">Search</button>
        <div class="dropdown-content">
            <a href="../Read/read.php">Query</a>
        </div>
    </div>

    <div class="grid">
        <div class="grid-elem">
            <h2>Employee</h2>
            <form method="post">
                First Name <input type="text" name="fn"><br>
                Last Name <input type="text" name="ln"><br>
                Position <select name="position" class="select-button">
                    <?php
                    $serverName = "localhost";
                    $userName = "root";
                    $password = "";
                    $dbName = "alexandria";

                    if (!$dbConn = mysqli_connect($serverName, $userName, $password, $dbName)) {
                        die("Could not connect to db<br>" . mysqli_connect_error());
                    }
                    if (!mysqli_select_db($dbConn, $dbName)) {
                        die("Could not select db<br>" . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM positions";
                    $result = mysqli_query($dbConn, $sql);
                    while ($elem = mysqli_fetch_array($result)) {
                        $id = $elem["PositionId"];
                        $pn = $elem["Position"];

                        echo "<option class='select-button' value='$id'>$pn</option>";
                    }
                    ?>
                </select><br>
                Phone Number <input type="text" name="pn"><br>
                Email <input type="text" name="email"><br>

                <br><input type="submit" class="submit-button"><br>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fn = $_POST["fn"];
                $ln = $_POST["ln"];
                $position = $_POST["position"];
                $pn = $_POST["pn"];
                $email = $_POST["email"];
                if (!$fn || !$ln || !$pn || !$position || !$email) {
                    die("Please fill in all fields");
                }
                include '../../Private/CRUD/create.php';
                add_employee($fn, $ln, $email, $pn, $position);
                echo "Employee created";
            }
            ?>
        </div>
    </div>

</body>

</html>
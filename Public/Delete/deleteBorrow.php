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
            <a href="../Create/createAuthor.php">Author</a>
            <a href="../Create/createBook.php">Book</a>
            <a href="../Create/createBorrow.php">Borrow</a>
            <a href="../Create/createEmployee.php">Employee</a>
            <a href="../Create/createGenre.php">Genre</a>
            <a href="../Create/createPosition.php">Position</a>
            <a href="../Create/createClient.php">Client</a>
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
            <a href="./deleteAuthor.php">Author</a>
            <a href="./deleteBook.php">Book</a>
            <a href="./deleteBorrow.php">Borrow</a>
            <a href="./deleteEmployee.php">Employee</a>
            <a href="./deleteGenre.php">Genre</a>
            <a href="./deletePosition.php">Position</a>
            <a href="./deleteClient.php">Client</a>
        </div>
    </div>

    <div class="dropdown-read">
        <button class="dropbtn">Search</button>
        <div class="dropdown-content">
            <a href="../Read/read.php">Query</a>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        if (!$id) {
            die("Please fill in all fields");
        }
        include '../../Private/CRUD/delete.php';
        delete_borrow($id);
    }
    ?>
    <div class="grid">
        <div class="grid-elem">
            <h2>Delete Borrow</h2>
            <form method="post">
                Borrow <select name="id" class="select-button">
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
                    $sql = "SELECT * FROM borrows";
                    $result = mysqli_query($dbConn, $sql);
                    while ($elem = mysqli_fetch_array($result)) {
                        $id = $elem["BorrowId"];
                        $client = $elem["ClientId"];
                        $date = $elem["ReturnDate"];

                        echo "<option class='select-button' value='$id'>Client Id: $client | Return Date: $date</option>";
                    }
                    ?>
                </select><br>
                <br><input type="submit" class="submit-button"><br>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo "Borrow deleted";
                }
                ?>
            </form>

        </div>
    </div>

</body>

</html>
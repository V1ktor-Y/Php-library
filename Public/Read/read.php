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
            <a href="./read.php">Query</a>
        </div>
    </div>

    <div class="grid">
        <div class="grid-elem">
            <h2>Select Query</h2>
            <form method="post">
                <input type="radio" class='select-button' name="query" value='1'>Books by reader
                <select name="client_id" class="select-button">
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
                    $sql = "SELECT * FROM clients";
                    $result = mysqli_query($dbConn, $sql);
                    while ($elem = mysqli_fetch_array($result)) {
                        $id = $elem["ClientId"];
                        $fn = $elem["FirstName"];
                        $ln = $elem["LastName"];
                        echo "<option class='select-button' value='$id'>$fn $ln</option>";
                    }
                    ?>
                </select>
                <br>
                <input type="radio" class='select-button' name="query" value='2'>Unreturned Book <br>
                <input type="radio" class='select-button' name="query" value='3'>Available Books <br>
                <input type="radio" class='select-button' name="query" value='4'>Top Three Books <br>
                <input type="radio" class='select-button' name="query" value='5'>Borrowed In Period
                Lower:<input type="date" class="select-button" name="lower">
                Upper:<input type="date" class="select-button" name="upper">
                <br>
                <input type="radio" class='select-button' name="query" value='6'>Most Active Readers <br>
                </select><br>
                <br><input type="submit" class="submit-button"><br>

            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include '../../Private/CRUD/read.php';
                $index = $_POST["query"];
                if (!$index) {
                    die("Please select which query you would like to perform");
                }
                $result;
                $res;
                switch ($index) {
                    case 1:
                        $client_id = $_POST["client_id"];
                        if (!$client_id) {
                            die("Please select reader");
                        }
                        $result = get_books_by_reader($client_id);

                        $res = "<div style='overflow:auto; height: 200px'><p>";
                        while ($row = mysqli_fetch_array($result)) {
                            $res .= $row['FirstName'] . ' ' . $row['LastName'] . ' | ' . $row['Title'] . "<br>";
                        }
                        $res .= "</p></div>";

                        break;
                    case 2:
                        $result = get_unreturned_books();

                        $res = "<div style='overflow:auto; height: 200px'><p>";
                        while ($row = mysqli_fetch_array($result)) {
                            $res .= $row['Title'] . "<br>";
                        }
                        $res .= "</p></div>";

                        break;
                    case 3:
                        $result = get_available_books();

                        $res = "<div style='overflow:auto; height: 200px'><p>";
                        while ($row = mysqli_fetch_array($result)) {
                            $res .= $row['Title'] . "<br>";
                        }
                        $res .= "</p></div>";

                        break;
                    case 4:
                        $result = get_top_three_books();

                        $res = "<div style='overflow:auto; height: 200px'><p>";
                        while ($row = mysqli_fetch_array($result)) {
                            $res .= $row['Title'] . " | Times Borrowed: " . $row['TimesBorrowed'] . "<br>";
                        }
                        $res .= "</p></div>";

                        break;
                    case 5:
                        $lower = $_POST["lower"];
                        $upper = $_POST["upper"];
                        if (!$lower || !$upper) {
                            die("Please select time frame");
                        }
                        $result = get_borrowed_books_for_period($lower, $upper);

                        $res = "<div style='overflow:auto; height: 200px'><p>";
                        while ($row = mysqli_fetch_array($result)) {
                            $res .= $row['Title'] . " | Return Date: " . $row['ReturnDate'] . "<br>";
                        }

                        break;
                    case 6:
                        $result = get_most_active_readers();

                        $res = "<div style='overflow:auto; height: 200px'><p>";
                        while ($row = mysqli_fetch_array($result)) {
                            $res .= $row['FirstName'] . $row['LastName'] . " | Books borrowed: " . $row['order_count'] . "<br>";
                        }

                        break;
                }
                echo $res;
            }
            ?>
        </div>
    </div>

</body>

</html>
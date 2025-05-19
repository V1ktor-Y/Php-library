<?php
function get_books_by_reader(int $id)
{
    //include '../Misc/config.php'; 
    // ^^ Gives error ^^ "Failed to open stream: No such file or directory in..."
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
    $sql = "SELECT clients.FirstName, clients.LastName, books.Title
    FROM ((borrows
    INNER JOIN clients ON borrows.ClientId=clients.ClientId)
    INNER JOIN books ON borrows.BookId=books.BookId)
    WHERE clients.ClientId=$id";

    $result = mysqli_query($dbConn, $sql);
    return $result;
}

function get_unreturned_books()
{
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
    ;
    $sql = "SELECT books.*, borrows.ReturnDate
    FROM books
    INNER JOIN borrows ON books.BookId = borrows.BookId
    WHERE books.isAvailable = 0
    ORDER BY borrows.ReturnDate ASC;";
    $result = mysqli_query($dbConn, $sql);
    return $result;
}

function get_available_books()
{
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
    ;
    $sql = "SELECT *
    FROM books
    WHERE isAvailable=1
    ORDER BY TimesBorrowed DESC";
    $result = mysqli_query($dbConn, $sql);
    return $result;
}

function get_top_three_books()
{
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

    $sql = "SELECT *
    FROM books
    ORDER BY TimesBorrowed DESC
    LIMIT 3";
    $result = mysqli_query($dbConn, $sql);
    return $result;
}

function get_borrowed_books_for_period(string $lower, string $upper)
{
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
    ;
    $sql = "SELECT sub.Title, sub.ReturnDate 
    FROM(SELECT books.Title, borrows.ReturnDate FROM books INNER JOIN borrows ON books.BookId=borrows.BookId) AS sub
    WHERE sub.ReturnDate > '$lower' AND sub.ReturnDate < '$upper'
    ORDER BY sub.ReturnDate ASC";
    $result = mysqli_query($dbConn, $sql);
    return $result;
}

function get_most_active_readers()
{
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
    ;
    $sql = "SELECT clients.ClientId, clients.FirstName, clients.LastName, COUNT(borrows.ClientId) AS order_count
    FROM clients
    JOIN borrows ON clients.ClientId = borrows.ClientId
    GROUP BY clients.ClientId, clients.FirstName, clients.LastName
    ORDER BY order_count DESC";
    $result = mysqli_query($dbConn, $sql);
    return $result;
}
?>
<?php
function get_books_by_reader()
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
    INNER JOIN books ON borrows.BookId=books.BookId)";
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
    FROM(SELECT * FROM books INNER JOIN borrows ON books.BookId=borrows.BookId)
    WHERE books.isAvailable=false 
    ORDER BY borrows.ReturnDate ASC";
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
    WHERE isAvailable=true
    ORDER BY TimesBorrowed DESC";
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
    ;
    $sql = "SELECT *
    FROM books
    ORDER BY TimesBorrowed DESC
    LIMIT 3";
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
    $sql = "SELECT books.*, borrows.ReturnDate 
    FROM(SELECT * FROM books INNER JOIN borrows ON books.BookId=borrows.BookId)
    WHERE borrows.ReturnDate > STR_TO_DATE('$lower', '%YYYY-%MM-%DD') AND borrows.ReturnDate < STR_TO_DATE('$upper', '%YYYY-%MM-%DD')";
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
}
?>
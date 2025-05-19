<?php
function delete_author(int $author_id)
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
    $sql = "DELETE FROM authors WHERE AuthorId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete author " . mysqli_error($dbConn));
    }
}
function delete_genre(int $genre_id)
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
    $sql = "DELETE FROM genres WHERE GenreId=$genre_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete genre " . mysqli_error($dbConn));
    }
}
function delete_position(int $position_id)
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
    $sql = "DELETE FROM positions WHERE PositionId=$position_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete position " . mysqli_error($dbConn));
    }
}
function delete_borrow(int $borrow_id)
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
    $sql = "SELECT BookId FROM borrows WHERE BorrowId=$borrow_id";
    $result = mysqli_query($dbConn, $sql);
    $book_id = mysqli_fetch_array($result)["BookId"];
    if (!$result) {
        die("Could not delete borrow " . mysqli_error($dbConn));
    }
    $sql = "DELETE FROM borrows WHERE BorrowId=$borrow_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete borrow " . mysqli_error($dbConn));
    }
    $sql = "UPDATE books SET IsAvailable=1  WHERE BookId=$book_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not Borrow " . mysqli_error($dbConn));
    }
}
function delete_client(int $client_id)
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
    $sql = "DELETE FROM clients WHERE ClientId=$client_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete client " . mysqli_error($dbConn));
    }
}
function delete_employee(int $employee_id)
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
    $sql = "DELETE FROM employees WHERE EmployeeId=$employee_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete employee " . mysqli_error($dbConn));
    }
}
function delete_book_authors(int $book_id, int $author_id)
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
    $sql = "DELETE FROM book_authors WHERE BookId=$book_id AND AuthorId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete author " . mysqli_error($dbConn));
    }
}
function delete_book(int $book_id)
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
    $sql = "DELETE FROM books WHERE BookId=$book_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete book " . mysqli_error($dbConn));
    }
    while ($result = mysqli_query($dbConn, "DELETE FROM book_authors WHERE BookId=$book_id"))
        ;
}
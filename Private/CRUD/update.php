<?php
function update_author(int $author_id, string $first_name, string $last_name)
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
    $sql = "UPDATE authors SET FirstName='$first_name', LastName='$last_name' WHERE AuthorId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update author " . mysqli_error($dbConn));
    }
}
function update_genre(int $genre_id, string $genre_name)
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
    $sql = "UPDATE genres SET GenreName='$genre_name' WHERE GenreId=$genre_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update genre " . mysqli_error($dbConn));
    }
}
function update_position(int $position_id, string $position_name)
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
    $sql = "UPDATE positions SET PositionName='$position_name' WHERE PositionId=$position_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update position " . mysqli_error($dbConn));
    }
}
function update_employee(int $employee_id, string $first_name, string $last_name, string $email, string $phone_number, int $position_id)
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
    $sql = "UPDATE employees SET FirstName='$first_name', LastName='$last_name', Email='$email', PhoneNumber='$$phone_number', PositionId=$position_id WHERE EmployeeId=$employee_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update employee " . mysqli_error($dbConn));
    }
}
function update_client(int $client_id, string $first_name, string $last_name, string $email, string $phone_number)
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
    $sql = "UPDATE clients SET FirstName='$first_name', LastName='$last_name', Email='$email', PhoneNumber='$$phone_number' WHERE ClientId=$client_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update client " . mysqli_error($dbConn));
    }
}
function update_borrow(int $borrow_id, int $book_id, int $client_id, int $employee_id, string $borrow_date, string $return_date)
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
    $sql = "UPDATE borrows SET BookId=$book_id, ClientId=$client_id, EmployeeId=$employee_id, BorrowDate='$borrow_date', ReturnDate='$return_date' WHERE BorrowId=$borrow_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update borrow " . mysqli_error($dbConn));
    }
}
function update_book_author(int $author_id, int $book_id)
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
    $sql = "UPDATE book_authors SET AuthorId=$author_id, BookId=$book_id WHERE BookId=$book_id AND AuthorId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update author " . mysqli_error($dbConn));
    }
}
function update_book(int $book_id, string $title, int $year, string $publisher, int $genre_id, int $times_borrowed, array $authors)
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
    $sql = "UPDATE books SET Title='$title', Publisher='$publisher', PublishYear=$year, GenreId=$genre_id, TimesBorrowed=$times_borrowed WHERE BookId=$book_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update book " . mysqli_error($dbConn));
    }
    foreach ($authors as $author_id) {
        update_book_author($author_id, $book_id);
    }
}
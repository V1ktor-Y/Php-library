<?php

function add_author(string $first_name, string $last_name): void
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
    $sql = "INSERT INTO authors(FirstName, LastName) VALUES('$first_name', '$last_name')";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not add Author " . mysqli_error($dbConn));
    }
}
function add_genre(string $genre_name): void
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
    $sql = "INSERT INTO genres(GenreName) VALUES('$genre_name')";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not add Genre " . mysqli_error($dbConn));
    }
}
function add_position(string $position_name): void
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
    $sql = "INSERT INTO positions(Position) VALUES('$position_name')";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not add Position " . mysqli_error($dbConn));
    }
}
function add_client(string $first_name, string $last_name, string $email, string $phone_number): void
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
    $sql = "INSERT INTO clients(FirstName, LastName, Email, PhoneNumber) VALUES('$first_name', '$last_name', '$email', '$phone_number')";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not add Client " . mysqli_error($dbConn));
    }
}
// User will be able to select position from a drop down menu which will then be processed into position_id.
function add_employee(string $first_name, string $last_name, string $email, string $phone_number, int $position_id): void
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
    $sql = "INSERT INTO clients(FirstName, LastName, Email, PhoneNumber, PositionId) VALUES('$first_name', '$last_name', '$email', '$phone_number', $position_id)";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not add Employee " . mysqli_error($dbConn));
    }
}
function add_book_authors(int $book_id, int $author_id)
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
    $sql = "INSERT INTO book_authors(BookId, AuthorId) VALUES($book_id, $author_id)";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not add BookAuthor " . mysqli_error($dbConn));
    }
}
function add_book(string $title, int $year, string $publisher, int $genre_id, int $times_borrowed, array $authors): void
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
    $sql = "INSERT INTO books(Title, PublishYear, Publisher, GenreId, TimesBorrowed) VALUES('$title', $year, '$publisher', $genre_id, $times_borrowed)";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not add Employee " . mysqli_error($dbConn));
    }
    // add bookAuthors
    foreach ($authors as $author_id) {
        add_book_authors(mysqli_insert_id($dbConn), $author_id);
    }
}
function add_borrow(int $book_id, int $client_id, int $employee_id, string $return_date)
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
    $sql = "INSERT INTO borrows(BookId, ClientId, EmployeeId, ReturnDate) VALUES($book_id, $client_id, $employee_id, STR_TO_DATE('$return_date', '%YYYY-%MM-%DD'))";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not Borrow " . mysqli_error($dbConn));
    }
}
<?php
function update_author(int $author_id, string $first_name, string $last_name)
{
    include("../Misc/config.php");
    $sql = "UPDATE authors SET FirstName='$first_name', LastName='$last_name' WHERE AuthorId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update author " . mysqli_error($dbConn));
    }
}

function update_genre(int $genre_id, string $genre_name)
{
    include("../Misc/config.php");
    $sql = "UPDATE genres SET GenreName='$genre_name' WHERE GenreId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update genre " . mysqli_error($dbConn));
    }
}
function update_position(int $position_id, string $position_name)
{
    include("../Misc/config.php");
    $sql = "UPDATE positions SET PositionName='$position_name', LastName='$last_name' WHERE PositionId=$position_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update position " . mysqli_error($dbConn));
    }
}
function update_employee(int $employee_id, string $first_name, string $last_name, string $email, string $phone_number, int $position_id)
{
    include("../Misc/config.php");
    $sql = "UPDATE employees SET FirstName='$first_name', LastName='$last_name', Email='$email', PhoneNumber='$$phone_number', PositionId=$position_id WHERE EmployeeId=$employee_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update employee " . mysqli_error($dbConn));
    }
}
function update_client(int $client_id, string $first_name, string $last_name, string $email, string $phone_number)
{
    include("../Misc/config.php");
    $sql = "UPDATE clients SET FirstName='$first_name', LastName='$last_name', Email='$email', PhoneNumber='$$phone_number' WHERE ClientId=$client_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update client " . mysqli_error($dbConn));
    }
}
function update_burrow(int $borrow_id, int $book_id, int $client_id, int $employee_id)
{
    include("../Misc/config.php");
    $sql = "UPDATE borrows SET BookId=$book_id, ClientId=$client_id, EmployeeId=$employee_id WHERE BorrowId=$borrow_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update borrow " . mysqli_error($dbConn));
    }
}
function update_book_author(int $author_id, int $book_id)
{
    include("../Misc/config.php");
    $sql = "UPDATE book_authors SET AuthorId=$author_id, BookId=$book_id WHERE BookId=$book_id AND AuthorId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update author " . mysqli_error($dbConn));
    }
}

function update_book(int $book_id, string $title, int $year, string $publisher, int $genre_id, int $times_borrowed, bool $is_available, array $authors)
{
    include("../Misc/config.php");
    $sql = "UPDATE books SET Title='$title', Publisher='$last_name', PublishYear=$year, GenreId=$genre_id, TimesBorrowed=$times_borrowed, IsAvailable=$is_available WHERE BookId=$book_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not update book " . mysqli_error($dbConn));
    }
    foreach ($authors as $author_id) {
        update_book_author($author_id, $book_id);
    }
}
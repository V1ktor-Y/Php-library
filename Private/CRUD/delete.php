<?php
function delete_author(int $author_id)
{
    include("../Misc/config.php");
    $sql = "DELETE FROM authors WHERE AuthorId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete author " . mysqli_error($dbConn));
    }
}
function delete_genre(int $genre_id)
{
    include("../Misc/config.php");
    $sql = "DELETE FROM genres WHERE GenreId=$genre_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete genre " . mysqli_error($dbConn));
    }
}
function delete_position(int $position_id)
{
    include("../Misc/config.php");
    $sql = "DELETE FROM positions WHERE PositionId=$position_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete position " . mysqli_error($dbConn));
    }
}
function delete_borrow(int $borrow_id)
{
    include("../Misc/config.php");
    $sql = "DELETE FROM borrows WHERE BorrowId=$borrow_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete borrow " . mysqli_error($dbConn));
    }
}
function delete_client(int $client_id)
{
    include("../Misc/config.php");
    $sql = "DELETE FROM clients WHERE ClientId=$client_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete client " . mysqli_error($dbConn));
    }
}
function delete_employee(int $employee_id)
{
    include("../Misc/config.php");
    $sql = "DELETE FROM employees WHERE EmployeeId=$employee_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete employee " . mysqli_error($dbConn));
    }
}
function delete_book_authors(int $book_id, int $author_id)
{
    include("../Misc/config.php");
    $sql = "DELETE FROM book_authors WHERE BookId=$book_id AND AuthorId=$author_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete author " . mysqli_error($dbConn));
    }
}
function delete_book(int $book_id)
{
    include("../Misc/config.php");
    $sql = "DELETE FROM books WHERE BookId=$book_id";
    $result = mysqli_query($dbConn, $sql);
    if (!$result) {
        die("Could not delete book " . mysqli_error($dbConn));
    }
    while ($result = mysqli_query($dbConn, "DELETE FROM book_authors WHERE BookId=$book_id"))
        ;
}
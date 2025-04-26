<?php
include("./config.php");

$genre_sql = "CREATE TABLE genres(
    GenreId INTEGER AUTO_INCREMENT,
    GenreName VARCHAR(30) NOT NULL,
    PRIMARY KEY(GenreId)
    )ENGINE=INNODB DEFAULT CHARSET=utf8";

$genre_res = mysqli_query($dbConn, $genre_sql);
if (!$genre_res) {
    die("Could not create genres table" . mysqli_error($dbConn));
}


$books_sql = "CREATE TABLE books(
    BookId INTEGER AUTO_INCREMENT,
    Title VARCHAR(60) NOT NULL,
    PublishYear INTEGER NOT NULL,
    Publisher VARCHAR(30) NOT NULL,
    GenreId INTEGER NOT NULL,
    TimesBorrowed INTEGER UNSIGNED DEFAULT(0),
    IsAvailable BOOLEAN DEFAULT(1), 
    PRIMARY KEY(BookId),
    FOREIGN KEY(GenreId) REFERENCES genres(GenreId)
    ) ENGINE=INNODB DEFAULT CHARSET=utf8";

$books_result = mysqli_query($dbConn, $books_sql);
if (!$books_result) {
    die("Could not create books table<br>" . mysqli_error($dbConn));
}

echo "Created books table<br>";

$employee_sql = "CREATE TABLE employees(
    EmployeeId INTEGER AUTO_INCREMENT,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    Position VARCHAR(40) NOT NULL,
    PhoneNumber VARCHAR(20) NOT NULL,
    Email VARCHAR(30) NOT NULL,
    PRIMARY KEY(EmployeeId)
    )ENGINE=INNODB DEFAULT CHARSET=utf8";

$employee_result = mysqli_query($dbConn, $employee_sql);
if (!$employee_result) {
    die("Could not create employees table<br>" . mysqli_error($dbConn));
}

echo "Created employees table<br>";

$client_sql = "CREATE TABLE clients(
    ClientId INTEGER AUTO_INCREMENT,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    PhoneNumber VARCHAR(20) NOT NULL,
    Email VARCHAR(30) NOT NULL,
    PRIMARY KEY(ClientId)
    ) ENGINE=INNODB DEFAULT CHARSET=utf8";

$client_result = mysqli_query($dbConn, $client_sql);
if (!$client_result) {
    die("Could not create clients table" . mysqli_error($dbConn));
}

echo "Created clients table<br>";

$borrow_sql = "CREATE TABLE borrows(
    BorrowId INTEGER AUTO_INCREMENT,
    BookId INTEGER NOT NULL,
    ClientId INTEGER NOT NULL,
    EmployeeId INTEGER NOT NULL,
    BorrowDate DATE DEFAULT CURRENT_DATE(),
    ReturnDate DATE NOT NULL,
    PRIMARY KEY (BorrowId),
    FOREIGN KEY (BookId) REFERENCES books(BookId),
    FOREIGN KEY (ClientId) REFERENCES clients(ClientId),
    FOREIGN KEY (EmployeeId) REFERENCES employees(EmployeeId)
) ENGINE=INNODB DEFAULT CHARSET=utf8";

$borrow_result = mysqli_query($dbConn, $borrow_sql);
if (!$borrow_result) {
    die("Could not create borrow table<br>" . mysqli_error($dbConn));
}

echo "Created borrows table<br>";

$author_sql = "CREATE TABLE authors(
   AuthorId INTEGER AUTO_INCREMENT,
   FirstName VARCHAR(20) NOT NULL,
   LastName VARCHAR(20),
   PRIMARY KEY(AuthorId)
   ) ENGINE=INNODB DEFAULT CHARSET=utf8 ";

$authors_res = mysqli_query($dbConn, $author_sql);
if (!$authors_res) {
    die("Could not create authors table" . mysqli_error($dbConn));
}

$bookAuthors_sql = "CREATE TABLE book_authors(
    BookId INTEGER NOT NULL,
    AuthorId INTEGER NOT NULL,
    FOREIGN KEY (BookId) REFERENCES books(BookId),
    FOREIGN KEY (AuthorId) REFERENCES authors(AuthorId)
    ) ENGINE=INNODB DEFAULT CHARSET=utf8";

$bookAuthor_result = mysqli_query($dbConn, $bookAuthors_sql);
if (!$bookAuthor_result) {
    die("Could not create book_authors table" . mysqli_error($dbConn));
}


mysqli_close($dbConn);
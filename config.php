<?php
  const DBHOST = 'remotemysql.com';        // Database Hostname
  const DBUSER = 'TK1e63o82L';             // MySQL Username
  const DBPASS = 'sAJ9k6SVba';                 // MySQL Password
  const DBNAME = 'TK1e63o82L';  // MySQL Database name

  // Data Source Network
  $dsn = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME . '';

  // Connection Variable
  // $conn = null;

  // // Connect Using PDO (PHP Data Output)
  // try {
    $conn = new PDO($dsn, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  // } catch (PDOException $e) {
  //   die('Error : ' . $e->getMessage());
  // }
?>
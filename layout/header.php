<?php require_once("./storage/db.php") ?>
<?php require_once ("./storage/student_crud.php") ?>
<?php require_once("./storage/class_crud.php") ?>
<?php require_once("./storage/teacher_crud.php") ?>
<?php require_once("./storage/batch_crud.php") ?>
<?php require_once("./storage/student_batch_crud.php") ?>
<?php require_once("./storage/attendence_crud.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./asset/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./asset/css/style.css">
    <script defer src="./asset/js/bootstrap.js"></script>
</head>
<body>
    <div class="main">
        <?php require_once ("./layout/sidebar.php")?>
        <div class="content">
            <nav class="bg-white d-flex p-3 justify-content-between ">  
                <div>
                    <form method="post">
                        <div class="d-flex search">
                            <i class="bi bi-search me-2"></i>
                            <input type="text" name="search" placeholder="Search" />    
                        </div>
                    </form>              
                </div>

                <div>
                    <div class="dropdown">
                        <div type="button" data-bs-toggle="dropdown">
                        <img class="profile" src="./asset/img/images.jpg">
                        </div>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Profile</a></li>
                          <li><a class="dropdown-item" href="#">Logout</a></li>
                         
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="page p-4">
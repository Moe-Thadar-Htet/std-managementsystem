<?php require_once ("./layout/header.php") ?>
<?php if (isset($_POST["search"])){
  echo "student batch list";
}
?>


<h2>Student List in <?= $_GET["class"] ?></h2>
<div class="card">
<div class="card-header d-flex justify-content-end">

<?php

$now= new DateTime("now");
$end_date= get_batch_end_date_id($mysqli,$_GET["batch_id"]);
$end= implode($end_date);
$compare_date = new DateTime($end);
$start = get_batch_start_date_id($mysqli, $_GET["batch_id"]);
$start_date = $start["start_date"];
$addedTwoWeek = date('Y-m-d H:i:s', strtotime($start_date . ' + 14 days'));

if($now<$compare_date){ ?>
    <a href="./add_attendence_batch.php?batch_id=<?= $_GET["batch_id"]?>" class="btn btn-info me-3">Attendence</a>

    <?php }?>
    <a href="./add_student_batch.php?batch_id=<?= $_GET["batch_id"] ?>&class=<?= $_GET["class"] ?>" class="btn btn-success"> Add Student</a>
    
    <!-- php if ($now < $addedTwoWeek) {
            <div class="btn btn-success" onclick="location.replace('add_student_with_batch_id.php?batch_id=?= $batch_id; ?>')">Add Student</div>
        php } -->
</div>
<div class="card-body">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $student_list= get_all_student_with_batch_id($mysqli,$_GET["batch_id"]);?>
                <?php $i=1;?>
                <?php while($student=$student_list->fetch_assoc()){ ?>
                <tr>
                    <td><?= $i?></td>
                    <td><?= $student["student_name"]?></td>
                    <td><?= $student["student_address"]?></td>
                    <td><?= $student["student_age"]?></td>
                    <td><?= $student["student_email"]?></td>
                    <td>
                    <a class="btn btn-primary btn-sm" href="./add_student.php?student_id=<?= $student['student_id']?>"><i class="bi bi-pen"></i></a>
                    <button class="btn btn-danger btn-sm ms-2 " data-bs-toggle="modal" data-bs-target="#exampleModal"  id="<?=$student_batch_id ?>"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>

                <?php $i++;}?>

            </tbody>
            </table>
    </div>
</div>
<div class="modal fade "  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModallabel">Are you sure!</h1>
                <div class="btn-close" data-bs-dismiss="modal"></div>
            </div>
            <div class="modal-body">
                Do you want to delete this student?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="<?=$student_batch_id ?>">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php require_once("./layout/footer.php")?>
<?php require_once("./layout/header.php")?>
<?php if (isset($_POST["search"])){
  echo "student detail batch list";
}
?>

<h2>student detail list</h2>
<div class="card">
    <div class="card-body">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Batch</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Attendence</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $detail_list = get_batch_with_student_id($mysqli,$_GET["student_id"]);?>
                <?php $i = 1;?>
                <?php while ($detail = $detail_list->fetch_assoc()) { ?>             
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $detail["batch_name"] ?></td>
                    <td><?= $detail["class_name"] ?></td>
                    <td><?= $detail["teacher_name"] ?></td>
                    <td> <a class="btn btn-primary btn-sm" href="./student_attendence.php?student_batch_id=<?= $detail["student_batch_id"]?>">Attendence</a></td>
                </tr>                  
                <?php $i++;
                } ?>    
            </tbody>
        </table>
    </div>
</div>

<?php require_once("./layout/footer.php")?>
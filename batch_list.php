<?php require_once ("./layout/header.php") ?>

<?php if (isset($_POST["search"])){
  echo "batch list";
}
?>

<?php
if(isset($_GET["delete_id"])){
   $batch_id=$_GET["delete_id"];
   if(!delete_batch($mysqli, $batch_id)){
    echo "Cannot delete the batch!";
   }
}


?>

<h2>Batch List</h2>
<div class="card">
    <div class="card-header d-flex justify-content-end">
        <a href="./add_batch.php" class="btn btn-secondary"> Add New Batch</a>
    </div>
    <div class="card-body">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Batch Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Fees</th>
                    <th>Description</th>
                    <th>Teacher</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $batch_list = get_all_batch_join($mysqli);?>
                <?php $i = 1;?>
                <?php while ($batch = $batch_list->fetch_assoc()) {
                    ?>             
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $batch["batch_name"] ?></td>
                    <td><?= date("Y-m-d", strtotime($batch["start_date"])) ?></td>
                    <td><?= date("Y-m-d", strtotime($batch["end_date"])) ?></td>
                    <td><?= $batch["fees"] ?></td>
                    <td><?= $batch["description"] ?></td>
                    <td><?= $batch["teacher_name"] ?></td>
                    <td><?= $batch["class_name"] ?></td>
                    <td>
                      <a class="btn btn-sm btn-secondary" href="./student_batch_list.php?batch_id=<?= $batch["batch_id"] ?>&class=<?= $batch["class_name"] ?>"><i class="bi bi-list"></i></a>
                      <a class="btn btn-sm btn-primary ms-2" href="./add_batch.php?batch_id=<?= $batch["batch_id"] ?>"><i class="bi bi-pen"></i></a>
                      <button class="btn btn-sm btn-danger ms-2 confirmDelete" data-id="<?= $batch["batch_id"] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>                  
                <?php $i++;
                } ?>  
            </tbody>
        </table>
    </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade modal-sm" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you want to delete this batch?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="deleted">Delete</button>
      </div>
    </div>
  </div>
</div>
<script> 
    let deleteId =undefined;
    let confirmBtn = document.querySelectorAll(".confirmDelete");
    let deleted = document.querySelector("#deleted");
    confirmBtn.forEach(element => {
    element.addEventListener("click",()=>{
          deleteId = element.getAttribute('data-id')
    })
});
deleted.addEventListener("click",()=>{
    location.replace("./batch_list.php?delete_id="+deleteId);
})
</script>
<?php require_once ("./layout/footer.php") ?>
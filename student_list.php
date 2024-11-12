<?php require_once ("./layout/header.php") ?>

<?php if (isset($_GET["delete_id"])) {
    $student_id = $_GET["delete_id"];
    if(!delete_student($mysqli,$student_id)){
        echo "Can't delete this student";
    }

   
}?>


<?php
    if(isset($_POST['search'])){
        echo "Student List"; 
    }
?>
<h2>Student List</h2>
<div class="card">
    <div class="card-header d-flex justify-content-end">
        <a href="./add_student.php" class="btn btn-secondary"> Add New Student</a>
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
                    <th>Action<th>
                </tr>
            </thead>
            <tbody>
                <?php $student_list = get_all_student($mysqli);$i = 1;?>
                <?php while ($student = $student_list->fetch_assoc()) { ?>             
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $student["student_name"] ?></td>
                    <td><?= $student["student_address"] ?></td>
                    <td><?= $student["student_age"] ?></td>
                    <td><?= $student["student_email"] ?></td>
                    <td>
                        <a class="btn btn-info btn-sm" href="./student_detail_batch_list.php?student_id=<?= $student["student_id"]?>">Detail</a>
                        <a class="btn btn-primary btn-sm ms-2" href="./add_student.php?student_id=<?= $student["student_id"]?>"><i class="bi bi-pen"></i></a>
                        <button class="btn btn-danger btn-sm ms-2 confirmDelete" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $student["student_id"]?>"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>                  
                <?php $i++;
                } ?>    
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
                Do you want to delete this class?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleted">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteId = undefined;
    let confirmBtn = document.querySelectorAll(".confirmDelete");
    let deleted = document.querySelector("#deleted");
    confirmBtn.forEach(element=>{
        element.addEventListener("click",()=>{
            deleteId = element.getAttribute('data-id')
            console.log(deleteId);
    })
});
deleted.addEventListener("click",()=>{
    location.replace("./student_list.php?delete_id="+deleteId);
})
</script>
<?php require_once("./layout/footer.php")?>
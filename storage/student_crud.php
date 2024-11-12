<?php

function add_student($mysqli, $student_name, $student_address, $student_age, $student_email)
{
    $sql = "INSERT INTO `student` (`student_name`,`student_address`,`student_age`,`student_email`) VALUES ('$student_name','$student_address','$student_age','$student_email')";
    return $mysqli->query($sql);
}

function get_all_student($mysqli)
{
    $sql = "SELECT * FROM `student`";
    return $mysqli->query($sql);
}

function get_student_id($mysqli, $student_id)
{
    $sql = "SELECT * FROM `student` WHERE `student_id`=$student_id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}
function get_last_student($mysqli)
{
    $sql = "SELECT * FROM `student` WHERE `student_id`=(SELECT MAX(`student_id`) FROM `student`)";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function get_all_student_with_batch_id($mysqli, $batch_id)
{
    $sql = "SELECT st.*,sb.student_batch_id FROM `student_batch`sb INNER JOIN `student`st ON sb.student_id=st.student_id WHERE sb.batch_id=$batch_id";
    return $mysqli->query($sql);
}

function get_all_student_without($mysqli,$batch_id)
{
    $sql="SELECT * FROM `student` WHERE `student_id` NOT IN (SELECT `student_id` FROM `student_batch` WHERE `batch_id`=$batch_id)";
    return $mysqli -> query($sql);
}

function get_all_student_attendence($mysqli, $batch_id)
{
    $date = date("Y-m-d");
    $sql = "SELECT st.*,sb.student_batch_id,a.leave,a.present,a.date,a.attendence_id FROM `student_batch` sb INNER JOIN `student` st ON sb.student_id=st.student_id LEFT JOIN `attendence` a ON a.student_batch_id=sb.student_batch_id  WHERE sb.`batch_id`=$batch_id AND a.`date`='$date'";
    return $mysqli->query($sql);
}

function filter_by_mame_email_search($mysqli,$search)
{
    $sql = " SELECT * FROM `student` WHERE `student_name` LIKE '%$search%' or `student_email` LIKE '%$search%'";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function update_student($mysqli, $student_id, $student_name, $student_address, $student_age, $student_email)
{
    $sql = "UPDATE  `student` SET `student_name`='$student_name', `student_address`='$student_address', `student_age`='$student_age', `student_email`='$student_email' WHERE `student_id`='$student_id'";
    return  $mysqli->query($sql);
}
    
function delete_student($mysqli, $student_id)
{
    $sql = "DELETE FROM `student` WHERE `student_id`='$student_id'";
    return  $mysqli->query($sql);
} 
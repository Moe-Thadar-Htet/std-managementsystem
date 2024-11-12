<?php

function present_attendence($mysqli,$attendence_id)
{
    $sql = "UPDATE `attendence` SET `present`= 1,`leave`= 0 WHERE `attendence_id`=$attendence_id";
    return $mysqli->query($sql);
}
function leave_attendence($mysqli,$attendence_id)
{
    $sql = "UPDATE `attendence` SET `leave`=1,`present`=0 WHERE `attendence_id`=$attendence_id";
    return $mysqli->query($sql);
}
function  absent_attendence($mysqli,$student_batch_id)
{
    $sql="INSERT INTO `attendence` (`leave`, `present`,`date`,`student_batch_id`) VALUES (0,0,NOW(),$student_batch_id)";
    return $mysqli->query($sql);
}

function absent_attendence_update($mysqli, $attendence_id)
{
    $sql = "UPDATE `attendence` SET `present`=0, `leave`=0 WHERE `attendence_id`=$attendence_id";
    return $mysqli->query($sql);
}

function get_all_attendence($mysqli)
{
    $sql = "SELECT * FROM `attendence`";
    return $mysqli->query($sql);
}

function get_attendence_with_student_batch($mysqli,$student_batch_id)
{
    $sql = "SELECT * FROM `attendence` WHERE `student_batch_id`=$student_batch_id";
    return $mysqli->query($sql);
}

function get_attendence_id($mysqli, $attendence_id)
{
    $sql = "SELECT * FROM `attendence` WHERE `attendence_id`=$attendence_id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function delete_attendence($mysqli, $attendence_id) 
{
    $sql = "DELETE  FROM `attendence` WHERE `attendence_id`=$attendence_id";
    return $mysqli->query($sql);
} 
function delete_attendence_with_student_batch_id($mysqli,$student_batch_id) 
{
    $sql = "DELETE  FROM `attendence` WHERE `student_batch_id`=$student_batch_id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
} 
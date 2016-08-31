<?php
/**
 * Created by PhpStorm.
 * User: zh
 * Date: 15-10-29
 * Time: 下午8:50
 */


include_once('../bin/Mysql.php');
$sql = new Mysql();
$date = $sql->getDate("SELECT * FROM member ");


foreach ($date as $row) {
    $id=$row['member_id'];
//    switch ($row['job_title']) {
//        case "技术运营":
//            $row['job_title'] = '技术运维';
//            break;
//        default:
//            break;
//    }
//    $job = $row['job_title'];
//
//
//    $sql->run("update member set job_title ='$job'   where member_id='$id'");
    $self =  htmlspecialchars($sql->safe_string($row['self_intro']));
    $sql->run("update member set self_intro ='$self'   where member_id='$id'");
}
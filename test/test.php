<?php
/**
 * Created by PhpStorm.
 * User: zh
 * Date: 15-10-27
 * Time: 下午11:05
 */
require '../vendor/autoload.php';
include_once('../bin/Mysql.php');
use Overtrue\Pinyin\Pinyin;
$sql = new Mysql();
Pinyin::set('delimiter','');
Pinyin::set('accent',false); // 设置 中文转拼音 类库, 无分隔，无音调

$date = $sql->getDate("SELECT * FROM member ");


foreach($date as $row )
{
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $student_id =$row['id_number'];
    $year_level = $row['year_level'];
    $id = $row['member_id'];
    $name_pinyin = Pinyin::trans($firstname.$lastname); // 获取拼音
    $year = substr($student_id,2,2);
    $url = "http://7xjlp0.com1.z0.glb.clouddn.com/".$year.'_'.$name_pinyin.".jpg";


    if($lastname=='煜堃')
    {
        $url = "http://7xjlp0.com1.z0.glb.clouddn.com/".$year.'_'.'zhangyukun'.".jpg";
    } // 堃字无法转换，特殊处理一下


    $sql->run("update member set portrait='$url'   where member_id='$id'");


}

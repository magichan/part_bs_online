<?php
/**
 * Created by PhpStorm.
 * User: zh
 * Date: 15-10-23
 * Time: 下午8:06
 * // 获取提交的信息，并且检验 url 可访问否
 */

include_once('../checksession.php');
require_once('../bin/Mysql.php');
$sql = new Mysql();
$member_id = $sql->safe_string($_POST['member_id']);
$website =$sql->safe_string($_POST['website']);
$facebook =$sql->safe_string($_POST['facebook']);
$github =$sql->safe_string($_POST['github']);
$dribbble =$sql->safe_string($_POST['dribbble']);
$linkedin =$sql->safe_string($_POST['linkedin']);
$weibo =$sql->safe_string($_POST['weibo']);
$twitter  =$sql->safe_string($_POST['twitter']);
$instagram =$sql->safe_string($_POST['instagram']);
$wechat =$sql->safe_string($_POST['wechat']);
$qq = $sql->safe_string($_POST['qq']);

$row = $sql->getLine("SELECT * FROM social_info WHERE member_id='$member_id'");
if(!$row)
{
    $sql->run("INSERT INTO social_info (member_id) VALUES ('$member_id')"); // 建立一条数据
}

$sql->run("UPDATE `social_info` SET `website`='$website', `github`='$github', `dribbble`='$dribbble', `linkedin`='$linkedin', `weibo`='$weibo'
,`twitter`='$twitter', `instagram`='$instagram', `facebook`='$facebook', `wechat`='$wechat' ,qq='$qq' WHERE member_id='$member_id'");


header('location:../dashboard.php');



<?php
/**
 * Created by PhpStorm.
 * User: zh
 * Date: 15-10-25
 * Time: 下午5:16
 * 显示我的借阅关系,我借的图书,借我图书
 * 可能的话提供一个提醒机制
 * 借我的图书未完成
 * 和之前的历史记录
 */
// 展示自己的书籍,自己借出的书,和自己借入的书
include_once('checksession.php');
require_once('./bin/Mysql.php');
require_once('./bin/output.php');
//$_SESSION['mem_id']='leozhang';
$username = $_SESSION['mem_id'];
$sql = new Mysql();

output_header();
output_top_bar("myborrow");
?>

<?php
// 正在借阅的图书
$borrowing_book = $sql->getDate("SELECT  book.book_title AS title , member.firstname AS firstname,member.lastname AS lastname , member.id_number AS id_number , borrow.date_borrow AS date_borrow , borrow.due_date AS due_date
    FROM  borrowdetails JOIN borrow ON borrowdetails.borrow_id = borrow.borrow_id
   JOIN book_entity ON borrowdetails.book_entity_id = book_entity.id
 JOIN member ON book_entity.member_id=member.member_id
 JOIN book ON borrowdetails.book_id=book.book_id
  WHERE borrow.member_id IN ( SELECT member_id  FROM member WHERE member.username='$username')
    AND  borrow_status='pending'   ");

//
//书的实体 信息
//书的拥有者的信息
// 判断 借书者是否为 本人
// 判断 该书的 状态

?>

<div class="container">
    <div class="margin-top">
        <div class="row">
            <div class="span12">
                <div class="panel-heading"></div>
                <div class="panel-heading"></div>
                <div class="panel-heading"></div>
                <div class="panel panel-warning">
                    <!-- Default panel contents -->
                    <div class="panel-heading">已借图书查看</div>

                    <!-- Table -->
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="example">
                        <thead>
                        <tr>
                            <th>图书名</th>
                            <th>借阅人</th>
                            <th>学号</th>
                            <th>借书时间</th>
                            <th>截止时间</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if ($borrowing_book) {
                            foreach ($borrowing_book as $row_result) {
                                ?>

                                <tr>


                                    <td><?php echo $row_result['title'] ?></td>
                                    <td><?php echo $row_result['firstname'] . " " . $row_result['lastname'] ?></td>
                                    <td><?php echo $row_result['id_number'] ?></td>
                                    <td><?php echo $row_result['date_borrow'] ?></td>
                                    <td><?php echo $row_result['due_date'] ?></td>


                                </tr>


                                <!-- while 循环结束 -->
                            <?php }
                        }
                        ?>


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>

<?php
// 被借阅的图书
$borrowed_book = $sql->getDate("SELECT  book.book_title AS title , member.firstname AS firstname,member.lastname AS lastname , member.id_number AS id_number , borrow.date_borrow AS date_borrow , borrow.due_date AS due_date
    FROM  borrowdetails JOIN borrow ON borrowdetails.borrow_id = borrow.borrow_id
   JOIN book_entity ON borrowdetails.book_entity_id = book_entity.id
 JOIN member ON book_entity.member_id=member.member_id
 JOIN book ON borrowdetails.book_id=book.book_id
  WHERE borrow.member_id IN ( SELECT member_id  FROM member WHERE member.username='$username')
    AND  borrow_status='pending' ");
?>

<div class="container">
    <div class="margin-top">
        <div class="row">
            <div class="span12">
                <div class="panel-heading"></div>
                <div class="panel-heading"></div>
                <div class="panel-heading"></div>
                <div class="panel panel-warning">
                    <!-- Default panel contents -->
                    <div class="panel-heading">借书图书查看</div>

                    <!-- Table -->
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="example">
                        <thead>
                        <tr>
                            <th>图书名</th>
                            <th>借阅人</th>
                            <th>学号</th>
                            <th>借书时间</th>
                            <th>截止时间</th>
                            <th>是否超期</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if ($borrowing_book) {
                            foreach ($borrowing_book as $row_result) {
                                ?>

                                <tr>


                                    <td><?php echo $row_result['title'] ?></td>
                                    <td><?php echo $row_result['firstname'] . " " . $row_result['lastname'] ?></td>
                                    <td><?php echo $row_result['id_number'] ?></td>
                                    <td><?php echo $row_result['date_borrow'] ?></td>
                                    <td><?php echo $row_result['due_date'] ?></td>


                                </tr>


                                <!-- while 循环结束 -->
                            <?php }
                        }
                        ?>


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- 被借阅的图书-->


<?php
$borrowing_book = $sql->getDate("SELECT  book.book_title AS title , member.firstname AS firstname,member.lastname AS lastname , member.id_number AS id_number , borrow.date_borrow AS date_borrow , borrowdetails.date_return AS date_return
    FROM  borrowdetails JOIN borrow ON borrowdetails.borrow_id = borrow.borrow_id
   JOIN book_entity ON borrowdetails.book_entity_id = book_entity.id
 JOIN member ON book_entity.member_id=member.member_id
 JOIN book ON borrowdetails.book_id=book.book_id
  WHERE borrow.member_id IN ( SELECT member_id  FROM member WHERE member.username='$username')
    AND ( borrow_status='returned' OR borrow_status='sure')   ");

//
//书的实体 信息
//书的拥有者的信息
// 判断 借书者是否为 本人
// 判断 该书的 状态

?>

<div class="container">
    <div class="margin-top">
        <div class="row">
            <div class="span12">
                <div class="panel-heading"></div>
                <div class="panel-heading"></div>
                <div class="panel-heading"></div>
                <div class="panel panel-warning">
                    <!-- Default panel contents -->
                    <div class="panel-heading">已还图书查看</div>

                    <!-- Table -->
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="example">
                        <thead>
                        <tr>
                            <th>图书名</th>
                            <th>借阅人</th>
                            <th>学号</th>
                            <th>借书时间</th>
                            <th>还书时间</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if ($borrowing_book) {
                            foreach ($borrowing_book as $row_result) {
                                ?>

                                <tr>


                                    <td><?php echo $row_result['title'] ?></td>
                                    <td><?php echo $row_result['firstname'] . " " . $row_result['lastname'] ?></td>
                                    <td><?php echo $row_result['id_number'] ?></td>
                                    <td><?php echo $row_result['date_borrow'] ?></td>
                                    <td><?php echo $row_result['date_return'] ?></td>


                                </tr>


                                <!-- while 循环结束 -->
                            <?php }
                        }
                        ?>


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>




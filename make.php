<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予定を合わせて帳っ!!</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<?php
session_start();
include 'ChromePhp.php';
echo '<form method="post" action="" style="display: inline">';
echo '<br/>';

echo 'イベント名  <input name="eventname" type="text"><br/><br/>';
echo '<br/>';

echo '日にち  <input class="date" name="date0" type="text"><br/>';

echo '<br/><br/><br/>';
echo '<button id="decide" style="width:50px">決定</button>';
echo '</form>';

echo '<span>ㅤㅤ</span>'; //空白文字を入れていい感じにボタンの間をあける
echo '<button id="add" style="width:50px">add</button>';
?>
</body>
</html>

<script>
    $(function(){
        var i=0;
        $('#add').click(function(){
            i++;
            $('.date:last').after('<br/><br/>日にち  <input class="date" name="data'+ i +'" type="text">');
        });
    });
</script>

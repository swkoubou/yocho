<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予定を合わせて帳っ!!</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="stylesheet">
    <script src="make.js"></script>
    <style>
        div{
            text-align:center;
            background-image: url("img/tag.png");
            width:500px;
            height:460px;
            top: 0;
            bottom: 250px;
            left: 0;
            right: 0;
            position: absolute;
            margin: auto;
        }
    </style>
</head>
<body background="img/corkboard.png">
<div>
<?php
echo '<form method="post" action="/GitHub/yocho/api/registration.php" style="display: inline">';
echo '<br/><br><br/>';

echo 'ㅤイベント名  <input name="eventname" type="text"><br/><br/>';
echo '<br/>';

echo 'ㅤ参加者選択 <br/>ㅤ<select class="select" multiple="multiple"><br/>';
echo 'ㅤㅤ</select><br/><br/>';
//echo '<input type="text" class="select">';
echo '<br/>';

echo 'ㅤ<span style="color:red">*日時記入例: <b>2016/8/6</b>ㅤorㅤ<b>2016-8-7</b></span><br/>';
echo 'ㅤ締め切り日時  <input name="closedate" type="text"><br/><br/>';
//echo '<br/>';

echo 'ㅤ開催日時  <input class="date" name="date0" type="text">';

echo '<br/><br/><br/>';
echo 'ㅤ<button id="decide" style="width:50px">決定</button>';
echo '</form>';

echo '<span>ㅤㅤ</span>'; //空白文字を入れていい感じにボタンの間をあける
echo '<button id="add" style="width:50px">add</button><br/><br/>';

$error = '';
$date = '';
if(!isset($_POST['eventname'])){
    $error =  'イベント名を入力してください';
}
else if(!isset($_POST['closedate'])){
    $error =  '締め切り日時を入力してください';
}
else if(isset($_POST)){
    $datearray = [];
    foreach($_POST as $value){
        if($value == $_POST['eventname'] || $value == $_POST['closedate'])
            continue;
        $datearray[] = $value;
    }
    $date=json_encode($datearray);
}
?>

</div>
</body>
</html>


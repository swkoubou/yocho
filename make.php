<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予定を合わせて帳っ!!</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>
<body>

<?php
require_once 'api/get_users.php';
echo '<form method="post" action="" style="display: inline">';
echo '<br/>';
echo ' イベント名  <input name="eventname" type="text"><br/><br/>';
echo '<br/>';
echo ' 締め切り日時  <input name="closedate" type="text"><br/><br/>';
echo '<br/>';
echo '日にち記入例: 2016/8/6ㅤorㅤ2016-8-7<br/>';
echo '日にち  <input class="date" name="date0" type="text">';
echo '<br/><br/><br/>';
echo '<button id="decide" style="width:50px">決定</button>';
echo '</form>';
echo '<span>ㅤㅤ</span>'; //空白文字を入れていい感じにボタンの間をあける
echo '<button id="add" style="width:50px">add</button>';
$error = '';
if(!isset($_POST['eventname'])){
    $error =  'イベント名を入力してください';
}
else if(!isset($_POST['closedate'])){
    $error =  '締め切り日時を入力してください';
}
else if(isset($_POST)){
    $datearray = [];
//    $length=0;
//    foreach($_POST as $value){
//        $length++;
//    }
//    for($i=0; $i < $length-1; $i++){
//        $datearray[$i] = $_POST[strval($i)];
//    }
    foreach($_POST as $value){
        if($value == $_POST['eventname'] || $value == $_POST['closedate'])
            continue;
        $datearray[] = $value;
    }
    $date=json_encode($datearray);
}
?>
</body>
</html>

<script>
    $(function(){
        var i=0;
        $('#add').click(function(){
            i++;
            $('.date:last').after('<br/><br/>日にち  <input class="date" name="date'+ i +'" type="text">');
        });
    });
    var datearray = JSON.parse('<?php echo  $date; ?>');
    console.log(datearray);
    var correctdate = [];
    var length = 0;
    for(var i=0; i<datearray.length; i++){
        var isdate = new Date(datearray[i]);
        console.log('isdate='+isdate);
        if(isdate != 'Invalid Date'){
            correctdate[length] = isdate.getFullYear() + '年' + isdate.getMonth() + '月' + isdate.getDate() + '日';
            length++;
            console.log(correctdate[length]);
        }
    }
    console.log('correct='+correctdate);
</script>

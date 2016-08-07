<?php
require __DIR__.'/php/config.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予定を合わせて帳っ!!</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="make.js"></script>

    <style>
        #div{
            text-align:center;
            left: 0;
            right: 0;
            position: absolute;
            margin: auto;
            padding: 20px;
            background: url(img/top.png), url(img/bottom.png), url(img/roop.png);
            background-position: top center, bottom center, top center;
            background-repeat: no-repeat, no-repeat, repeat-y;
            background-size: 500px auto, 500px auto, 500px auto;
        }
    </style>
</head>
<body background="img/corkboard.png">
<div id="div">
<?php
echo '<form id="form" method="post" action="'.Config::$ROOT.'/api/registration.php" style="display: inline">';
echo '<br/><br><br/>';

echo 'ㅤイベント名  <input id="eventname" name="eventname" type="text"><br/><br/>';
echo '<br/>';

echo 'ㅤ参加者選択 <br/>ㅤ<select class="select" multiple="multiple"><br/>';
echo 'ㅤㅤ</select><br/><br/>';
//echo '<input type="text" class="select">';
echo '<br/>';

echo 'ㅤ<span style="color:red">*日時記入例: <b>2016/8/6</b>ㅤorㅤ<b>2016-8-7</b></span><br/>';
echo 'ㅤ締め切り日時  <input id="closedate" name="closedate" type="text"><br/><br/>';

echo 'ㅤㅤㅤ広報日時 <input class="date" name="date0" type="text">';

echo '<br/><br/><br/>';
echo '</form>';
//echo 'ㅤ<button id="decide" style="width:50px">決定</button>';
echo '<input id="decide" type="submit" style="width:50px" value="送信" onclick="check()">';


echo '<span>ㅤㅤ</span>'; //空白文字を入れていい感じにボタンの間をあける
echo '<button id="add" style="width:50px">追加</button>';
echo '<span>ㅤㅤ</span>'; //空白文字を入れていい感じにボタンの間をあける

$date = '';
if(isset($_POST)){
    $datearray = [];
    foreach($_POST as $value){
        if($value == $_POST['eventname'] || $value == $_POST['closedate'])
            continue;
        $datearray[] = $value;
    }
    $date=json_encode($datearray);
}
?>
<button onclick="location.href='index.html'">戻る</button>
</div>
</body>
</html>
<script>


    //年月日をいい感じに取り出す
    var datearray = JSON.parse('<?php echo  $date; ?>');
    var correctdate = [];
    var length = 0;
    for(var i=0; i<datearray.length; i++){
        var isdate = new Date(datearray[i]);
        if(isdate != 'Invalid Date'){
            correctdate[length] = isdate.getFullYear() + '年' + isdate.getMonth() + '月' + isdate.getDate() + '日';
            length++;
        }
    }
    console.log(correctdate);
</script>

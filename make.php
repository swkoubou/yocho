<<<<<<< HEAD
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予定を合わせて帳っ!!</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="stylesheet">
</head>
<body>

<?php
echo '<form method="post" action="/GitHub/yocho/api/registration.php" style="display: inline">';
echo '<br/>';

echo ' イベント名  <input name="eventname" type="text"><br/><br/>';
echo '<br/>';

echo '参加者選択 <br/><select class="select" multiple="multiple"><br/>';
echo '</select><br/><br/>';
//echo '<input type="text" class="select">';
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
</body>
</html>

<script>
    $(function(){
        //ボタン押したら階層追加
        var i=0;
        $('#add').click(function(){
            i++;
            $('.date:last').after('<br/><br/>日にち  <input class="date" name="date'+ i +'" type="text">');
        });

        var name = [];
        var id = [];
        // Ajax通信を開始する
        $.ajax({
            url: 'api/get_users.php',
            type: 'post', // getかpostを指定(デフォルトは前者)
            dataType: 'json', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる

            success: function(response) {
                for(var i=0; i < response.length; i++){
                    name[i] = response[i]['name'];
                    id[i] = response[i]['id'];
                }
                console.log('name='+name);
                for(var i=0; i<name.length; i++){
                    $('.select').append('<option>'+name[i]+'</option>');
                }
            }
        });
    });

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
</script>
=======
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
echo '<form method="post" action="/GitHub/yocho/api/registration.php" style="display: inline">';
echo '<br/>';
echo ' イベント名  <input name="eventname" type="text"><br/><br/>';
echo '<br/>';
echo ' 締め切り日時  <input name="closedate" type="text"><br/><br/>';
echo '<br/>';
echo '日にち記入例: 2016/8/6ㅤorㅤ2016-8-7<br/>';
echo '日にち  <input class="date" name="date0" type="text">';
echo '<br/><br/><br/>';
echo '<button type="submit" id="decide" style="width:50px">決定</button>';
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
</script>
>>>>>>> 7955248c691a661d5391bfe3630ccbf542643f25

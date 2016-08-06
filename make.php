<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予定を合わせて帳っ!!</title>
</head>
<body>
</body>
</html>

<?php
echo '<form method="post" action="">';
echo '<br/>';

echo 'イベント名  <input name="eventname" type="text"><br/><br/>';
echo '<br/>';

echo "<select name='month'>";
for ($i = 1; $i <= 12; $i++) {
    echo "<option>".$i;
}
echo "</select> 月　";

echo "<select name='day'>";
for ($i = 1; $i <= 31; $i++) {
    echo "<option>".$i;
}
echo "</select> 日　";

echo '<br/>';
echo '</form>'
?>
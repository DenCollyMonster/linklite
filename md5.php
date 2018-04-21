<?php
$hash = '';
if(isset($_GET['text'])) {
    $hash = md5($_GET['text']);
}

?>
<!doctype html>
<html>
<head>
    <title>MD5-hashing</title>
</head>
<body>
    <form method="get">
        <label>Введите строку для вычисления MD5-sum:
            <input type="text" name="text">
        </label><br>
        <label>Hash строки<?php if(isset($_GET['text'])) { echo ' <span style="color:blue;">"' . $_GET['text'] . '"</span>'; } ?>:
            <input type="text" name="hash" value="<?php echo $hash; ?>">
        </label><br>
        <input type="submit" value="Расчитать Hash!">
    </form>
</body>
</html>
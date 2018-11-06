<?php
require_once 'config.php';
require_once 'function.php';
try {
    $pdo = new pdo('mysql:host='.$config['mysql_host'].';dbname='.$config['mysql_datebase'], $config['mysql_user'], $config['mysql_password']);
} catch (PDOException $e){
    echo 'Ошибка при подключении к базе данных';
    exit();
}
$template = '';
$r_time = time() + 3600 * 24;
$r_D = date('j', $r_time);
$r_M = date('n', $r_time);
$back = $r_time - 3600 * 24;
$go = $r_time + 3600 * 24;
$r_W = date('N', $r_time);
$name_M = '';
$admin = '';
if(isset($_COOKIE['admin']) && $_COOKIE['admin'] == $config['admin_password']) $admin = '<a href="admin.php" class="admin">Админ панель</a>';
$name_M = name_mouth($r_M);
$name_week = name_week($r_W);
if(!isset($_COOKIE['user']) && !isset($_GET['gdz']) && !isset($_GET['date']))
{
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE ip=:ip");
    $stmt->execute([':ip' => $_SERVER['REMOTE_ADDR']]);
    if($stmt->rowCount() == 0) {
        $rand = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $cookie = '';
        $i = 0;
        while ($i != 32) {
            $cookie .= $rand[mt_rand(0, 61)];
            $i++;
        }
        setcookie('user', $cookie, time() + 3600 * 8760);
        $stmt = $pdo->prepare("INSERT INTO `users` (cookie, open, click, ip) VALUES (:cookie, 1, 0, :ip)");
        $stmt->execute([':cookie' => $cookie, ':ip' => $_SERVER['REMOTE_ADDR']]);
    }
    else
    {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        setcookie('user', $user['cookie'], time() + 3600 * 8760);
        $stmt = $pdo->prepare("UPDATE `users` SET `open`=:opn WHERE `ip`=:ip");
        $stmt->execute([':opn' => ++$user['open'], ':ip' => $user['ip']]);
    }
}
elseif(isset($_COOKIE['user']) && !isset($_GET['gdz']) && !isset($_GET['date']))
{
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `cookie`=:cookie");
    $stmt->execute([':cookie' => $_COOKIE['user']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("UPDATE `users` SET `open`=:opn WHERE `cookie`=:cookie");
    $stmt->execute([':opn' => ++$user['open'], ':cookie' => $_COOKIE['user']]);
}
if(isset($_GET['gdz']))
{
    if(isset($_COOKIE['user']))
    {
        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `cookie`=:cookie");
        $stmt->execute([':cookie' => $_COOKIE['user']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("UPDATE `users` SET `click`=:opn WHERE `cookie`=:cookie");
        $stmt->execute([':opn' => ++$user['click'], ':cookie' => $_COOKIE['user']]);
    }
    $smtp = $pdo->prepare("SELECT * FROM `gdz` WHERE `id`=:id LIMIT 1");
    $smtp->execute([':id' => $_GET['gdz']]);
    $gdz = $smtp->fetch(PDO::FETCH_ASSOC);
    $name_leasson = name_leasson($gdz['id_leasson']);
    if($gdz['gdz_link'] != NULL) $gdz_link = '<a class="gdz-link" href="'.$gdz['gdz_link'].'"><div class="gdz-div">'.'Открыть ГДЗ'.'</div></a>';
    if($gdz['gdz_img'] != NULL) $gdz_img = '<figure><img src="'.$gdz['gdz_img'].'"></figure>';
    if($gdz['gdz_text'] != NULL) $gdz_text = '<p class="gdz-text">'.$gdz['gdz_text'].'</p>';
    $r_time = $gdz['date'];
    $r_D = date('j', $r_time);
    $r_M = date('n', $r_time);
    $template = str_replace(['{%NAME_LEASSON%}', '{%GDZ_LINK%}', '{%GDZ_IMG%}', '{%GDZ_TEXT%}'], [$name_leasson, $gdz_link, $gdz_img, $gdz_text], file_get_contents('template/gdz.tpl'));
    $complite_template = str_replace(['{%TITLE%}', '{%DATE_LEASSON%}', '{%BACK%}', '{%GO%}', '{%ADMIN%}', '{%WEEK_LEASSON%}'], ['8A - ГДЗ', $r_D . ' ' . $name_M, '1', $go, $admin, $name_week], file_get_contents('template/header.tpl')) .
        $template .
        file_get_contents('template/footer.tpl');
    exit($complite_template);

}
if(isset($_GET['date']))
{
    if($_GET['date'] != '1') {
        $r_time = $_GET['date'];
        $back = $_GET['date'] - (3600 * 24);
        $go = $_GET['date'] + (3600 * 24);
        $r_D = date('j', $_GET['date']);
        $r_M = date('n', $_GET['date']);
        $r_W = date('N', $_GET['date']);
        $name_week = name_week($r_W);
        $name_M = name_mouth($r_M);
    }
}
$smtp = $pdo->prepare("SELECT * FROM `gdz` WHERE `date_M`=:date_m AND `date_D`=:date_d LIMIT 6");
$smtp->execute([':date_m' => $r_M, ':date_d' => $r_D]);
if($smtp->rowCount() != 0) {
    while ($row = $smtp->fetch(PDO::FETCH_ASSOC)) {
        $name_leasson = '';
        $name_leasson = name_leasson($row['id_leasson']);
        if ($row['gdz_text'] != NULL || $row['gdz_img'] != NULL) {
            $template .= str_replace(['{%NAME_LEASSON%}', '{%TOPIC_LEASSON%}', '{%DZ_LEASSON%}', '{%PHP_SELF%}', '{%GDZ_LEASSON%}'], [$name_leasson, $row['gdz_topic'], $row['gdz_gdz'], $_SERVER['PHP_SELF'], $row['id']], file_get_contents('template/section.tpl'));
        } elseif($row['gdz_text'] == NULL && $row['gdz_img'] == NULL && $row['gdz_link'] != NULL) {
            $template .= str_replace(['{%NAME_LEASSON%}', '{%TOPIC_LEASSON%}', '{%DZ_LEASSON%}', '{%GDZ_LINK%}'], [$name_leasson, $row['gdz_topic'], $row['gdz_gdz'], $row['gdz_link']], file_get_contents('template/section_gdz.tpl'));
        }
        elseif ($row['gdz_text'] == NULL && $row['gdz_img'] == NULL && $row['gdz_link'] == NULL)
        {
            $template .= str_replace(['{%NAME_LEASSON%}', '{%TOPIC_LEASSON%}', '{%DZ_LEASSON%}'], [$name_leasson, $row['gdz_topic'], $row['gdz_gdz']], file_get_contents('template/section_gdz_not.tpl'));
        }
    }
    $complite_template = str_replace(['{%TITLE%}', '{%DATE_LEASSON%}', '{%BACK%}', '{%GO%}', '{%ADMIN%}', '{%WEEK_LEASSON%}'], ['8A - ГДЗ', $r_D . ' ' . $name_M, $back, $go, $admin, $name_week], file_get_contents('template/header.tpl')) .
        $template .
        file_get_contents('template/footer.tpl');
}
else {
    $complite_template = str_replace(['{%TITLE%}', '{%DATE_LEASSON%}', '{%BACK%}', '{%GO%}', '{%ADMIN%}', '{%WEEK_LEASSON%}'], ['8A - ГДЗ', $r_D . ' ' . $name_M, $back, $go, $admin, $name_week], file_get_contents('template/header.tpl')) .
        file_get_contents('template/not_found.tpl') .
        file_get_contents('template/footer.tpl');
}
exit($complite_template);
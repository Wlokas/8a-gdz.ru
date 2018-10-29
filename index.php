<?php
require_once 'config.php';
try {
    $pdo = new pdo('mysql:host='.$config['mysql_host'].';dbname='.$config['mysql_datebase'], $config['mysql_user'], $config['mysql_password']);
} catch (PDOException $e){
    echo 'Ошибка при подключении к базе данных';
    exit();
}
$template = '';
$r_time = time() + 3600 * 24;
$r_D = date('d', $r_time);
$r_M = date('m', $r_time);
$name_M = '';
switch ($r_M)
{
    case 1: $name_M = 'Января'; break;
    case 2: $name_M = 'Февраля'; break;
    case 3: $name_M = 'Марта'; break;
    case 4: $name_M = 'Апреля'; break;
    case 5: $name_M = 'Мая'; break;
    case 6: $name_M = 'Июня'; break;
    case 7: $name_M = 'Июля'; break;
    case 8: $name_M = 'Августа'; break;
    case 9: $name_M = 'Сентября'; break;
    case 10: $name_M = 'Октября'; break;
    case 11: $name_M = 'Ноября'; break;
    case 12: $name_M = 'Декабря'; break;
}
$smtp = $pdo->prepare("SELECT * FROM `gdz` WHERE `date_M`=:date_m AND `date_D`=:date_d LIMIT 6");
$smtp->execute([':date_m' => $r_M, ':date_d' => $r_D]);
while($row = $smtp->fetch(PDO::FETCH_ASSOC))
{
    $name_leasson = '';
    switch ($row['id_leasson'])
    {
        case 0: $name_leasson = 'Русский язык'; break;
        case 1: $name_leasson = 'Алгебра'; break;
        case 2: $name_leasson = 'Физика'; break;
        case 3: $name_leasson = 'Английский язык'; break;
    }
    $template .= str_replace(['{%NAME_LEASSON%}', '{%TOPIC_LEASSON%}', '{%DZ_LEASSON%}', '{%PHP_SELF%}', '{%GDZ_LEASSON%}'], [$name_leasson, $row['gdz_topic'], $row['gdz_gdz'], $_SERVER['PHP_SELF'], $row['id']], file_get_contents('template/section.tpl'));
}
$complite_template = str_replace(['{%TITLE%}', '{%DATE_LEASSON%}'], ['8A - ГДЗ', $r_D.' '.$name_M], file_get_contents('template/header.tpl')).
                    $template.
                    file_get_contents('template/footer.tpl');
exit($complite_template);
<?php
require_once 'config.php';
try {
    $pdo = new pdo('mysql:host='.$config['mysql_host'].';dbname='.$config['mysql_datebase'], $config['mysql_user'], $config['mysql_password']);
} catch (PDOException $e){
    echo 'Ошибка при подключении к базе данных';
    exit();
}
$gdz_link = '';
$gdz_text = '';
$gdz_img = '';
$dz = '';

if(isset($_COOKIE['adminpass']) && $_COOKIE['adminpass'] == '7s382s33')
{
    $r_time = time() + 3600 * 24;
    $t_date = date('20y-m-d', $r_time);
    if(isset($_POST['leasson']))
    {
        $id_leasson = $_POST['leasson'][0];
        $gdz_topic = $_POST['topic'];
        $dz = $_POST['dz'];
        if(isset($_POST['gdz_link']) && !empty($_POST['gdz_link'])) $gdz_link = $_POST['gdz_link'];
        if(isset($_POST['gdz_text']) && !empty($_POST['gdz_text'])) $gdz_text = nl2br($_POST['gdz_text']);;
        if(isset($_POST['gdz_img']) && isset($_FILES['gdz_img']))
        {
        $file_name = 'img/'.$_FILES['gdz_img']['name'];
        move_uploaded_file($_FILES['gdz_img']['tmp_name'], $file_name);
        $gdz_img = 'img/'.$_FILES['gdz_img']['name'];
        }
        if(isset($_POST['gdz_link']) && !empty($_POST['gdz_link'])) $gdz_link = $_POST['gdz_link'];
        $date =  explode('-',$_POST['date']);
        $mouth = $date[1];
        $day = $date[2];
        $timestamp = strtotime($date[2].'-'.$date[1].'-'.$date[0]);
            $smtp = $pdo->prepare("INSERT INTO `gdz` (id_leasson, gdz_text, gdz_topic, gdz_gdz, gdz_img, gdz_link, date, date_D, date_M) VALUES (:id_leasson, :gdz_text, :gdz_topic, :gdz_gdz, :gdz_img, :gdz_link, :gdz_date, :date_D, :date_M)");
            $smtp->execute([':id_leasson' => $id_leasson, ':gdz_text' => $gdz_text, ':gdz_topic' => $gdz_topic, ':gdz_gdz' => $dz, ':gdz_img' => $gdz_img, ':gdz_link' => $gdz_link, ':gdz_date' => $timestamp, ':date_D' => $day, ':date_M' => $mouth]);
        echo 'Готово!';
    }
exit(str_replace('{%DATE%}',$t_date,file_get_contents('template/admin.tpl')));
}
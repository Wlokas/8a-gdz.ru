<?php
function name_leasson($id_leasson = 0)
{
    $name_leasson = '';
    switch ($id_leasson) {
        case 0:
            $name_leasson = 'Русский язык';
            break;
        case 1:
            $name_leasson = 'Литература';
            break;
        case 2:
            $name_leasson = 'Алгебра';
            break;
        case 3:
            $name_leasson = 'Геометрия';
            break;
        case 4:
            $name_leasson = 'Информатика';
            break;
        case 5:
            $name_leasson = 'Обществознание';
            break;
        case 6:
            $name_leasson = 'История';
            break;
        case 7:
            $name_leasson = 'История СПБ';
            break;
        case 8:
            $name_leasson = 'География';
            break;
        case 9:
            $name_leasson = 'Физика';
            break;
        case 10:
            $name_leasson = 'Химия';
            break;
        case 11:
            $name_leasson = 'Биология';
            break;
        case 12:
            $name_leasson = 'Музыка';
            break;
        case 13:
            $name_leasson = 'ИЗО';
            break;
        case 14:
            $name_leasson = 'Физкультура';
            break;
        case 15:
            $name_leasson = 'ОБЖ';
            break;
        case 16:
            $name_leasson = 'Технология';
            break;
        case 17:
            $name_leasson = 'Англ. Яз (1 группа)';
            break;
        case 18:
            $name_leasson = 'Англ. Яз (2 группа)';
            break;
    }
    return $name_leasson;
}

function name_mouth($r_M) {
    $name_M = '';
    switch ($r_M) {
        case 1:
            $name_M = 'Января';
            break;
        case 2:
            $name_M = 'Февраля';
            break;
        case 3:
            $name_M = 'Марта';
            break;
        case 4:
            $name_M = 'Апреля';
            break;
        case 5:
            $name_M = 'Мая';
            break;
        case 6:
            $name_M = 'Июня';
            break;
        case 7:
            $name_M = 'Июля';
            break;
        case 8:
            $name_M = 'Августа';
            break;
        case 9:
            $name_M = 'Сентября';
            break;
        case 10:
            $name_M = 'Октября';
            break;
        case 11:
            $name_M = 'Ноября';
            break;
        case 12:
            $name_M = 'Декабря';
            break;
    }
    return $name_M;
}

function name_week($week)
{
    $name_week = '';
    switch ($week) {
        case 1:
            $name_week = 'Пн';
            break;
        case 2:
            $name_week = 'Вт';
            break;
        case 3:
            $name_week = 'Ср';
            break;
        case 4:
            $name_week = 'Чт';
            break;
        case 5:
            $name_week = 'Пт';
            break;
        case 6:
            $name_week = 'Сб';
            break;
        case 7:
            $name_week = 'Вс';
            break;
    }
    return $name_week;
}
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
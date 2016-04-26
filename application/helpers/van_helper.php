<?php
function rus_date() {
// Перевод
    $translate = array(
        "am" => "дп",
        "pm" => "пп",
        "AM" => "ДП",
        "PM" => "ПП",
        "Monday" => "Понедельник",
        "Mon" => "Пн",
        "Tuesday" => "Вторник",
        "Tue" => "Вт",
        "Wednesday" => "Среда",
        "Wed" => "Ср",
        "Thursday" => "Четверг",
        "Thu" => "Чт",
        "Friday" => "Пятница",
        "Fri" => "Пт",
        "Saturday" => "Суббота",
        "Sat" => "Сб",
        "Sunday" => "Воскресенье",
        "Sun" => "Вс",
        "January" => "Января",
        "Jan" => "Янв",
        "February" => "Февраля",
        "Feb" => "Фев",
        "March" => "Марта",
        "Mar" => "Мар",
        "April" => "Апреля",
        "Apr" => "Апр",
        "May" => "Мая",
        "May" => "Мая",
        "June" => "Июня",
        "Jun" => "Июн",
        "July" => "Июля",
        "Jul" => "Июл",
        "August" => "Августа",
        "Aug" => "Авг",
        "September" => "Сентября",
        "Sep" => "Сен",
        "October" => "Октября",
        "Oct" => "Окт",
        "November" => "Ноября",
        "Nov" => "Ноя",
        "December" => "Декабря",
        "Dec" => "Дек",
        "st" => "ое",
        "nd" => "ое",
        "rd" => "е",
        "th" => "ое"
    );
    // если передали дату, то переводим ее
    if (func_num_args() > 1) {
        $timestamp = func_get_arg(1);
        return strtr(date(func_get_arg(0), $timestamp), $translate);
    } else {
// иначе текущую дату
        return strtr(date(func_get_arg(0)), $translate);
    }
}

function allNewsTime(){
    //Воскресенье, 17 Апреля 2016
    //setlocale(LC_ALL, 'ru_RU.UTF-8');
    //echo strftime('%S', time());
    $monthes = array(
        1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
        5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
        9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
    );
    $days = array(
        'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
        'Четверг', 'Пятница', 'Суббота'
    );
    return $days[(date('w'))].', '.date('d').' '.$monthes[(date('n'))].' '.date('Y');
}

function getAge($y, $m, $d){ // в качестве параметров будут год, месяц и день
    if($m > date('m') || $m == date('m') && $d > date('d'))
        return (date('Y') - $y - 1); // если ДР в этом году не было, то ещё -1
    else
        return (date('Y') - $y); // если ДР в этом году был, то отнимаем от этого года год рождения
}

function generate_password($number){
    $arr1 = array(
        'a','b','c','d','e','f',
        'g','h','i','j','k','l',
        'm','n','o','p','r','s',
        't','u','v','x','y','z',
        'A','B','C','D','E','F',
        'G','H','I','J','K','L',
        'M','N','O','P','R','S',
        'T','U','V','X','Y','Z',
        '1','2','3','4','5','6',
        '7','8','9','0','.',',',
        '(',')','[',']','!','?',
        '&','^','%','@','*','$',
        '<','>','/','|','+','-',
        '{','}','`','~');
    $arr = array(
        'a','b','c','d','e','f',
        'g','h','i','j','k','l',
        'm','n','o','p','r','s',
        't','u','v','x','y','z',
        'A','B','C','D','E','F',
        'G','H','I','J','K','L',
        'M','N','O','P','R','S',
        'T','U','V','X','Y','Z',
        '1','2','3','4','5','6',
        '7','8','9','0');
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
        // Вычисляем случайный индекс массива
        $index = rand(0, count($arr) - 1);
        $pass .= $arr[$index];
    }
    return $pass;
}

function btn($model, $item, $params = false){
/*
 *  <?=btn('reviews', ['active' => $row['offon'], 'name' => ['off', 'on'], 'status' => ['danger', 'primary'], 'size' => 'xs']);?>
 *  size = lg, sm, xs, можно не указывать (ms)
 *  name = ['on', 'off']
 *  active = номер активного элемента
 *  status = цвет или свойство элемента
 * */

    $name  = $model.'['.$item.']';//Пр: users[login]
    $name2 = $model.'_'.$item;    //Пр: users_login

    $size = false;
    if($params['size'] != false)  $size = ' btn-group-'.$params['size'];

    $rez = '<div class="btn-group'.$size.' '.$name2.'" role="group" aria-label="...">';

    $n = 0;
    foreach($params['name'] as $row){
        $status = $params['status'][$params['active']];

        if($params['active'] != $n)
            $status = 'default';

        $rez .= '<button type="button" class="btn btn-'.$status.'">'.$row.'</button>';
        $n++;
    }

    $rez .= '</div>';

    if($params['ajax']){
        $rez .= '<script>
    $(".'.$name2.'").click(function(){
        console.log("dsds");
    });

</script>';
    }



    return $rez;
}

function translit($str){

    $tr = array(
        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
        "Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
        "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
        "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
        "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
        " "=> "-", "."=> "", "/"=> "-"
    );

    if (preg_match('/[^A-Za-z0-9_\-]/', $str)) {
        $str = strtr($str,$tr);
        $str = preg_replace('/[^A-Za-z0-9_\-]/', '', $str);
        $str=preg_replace("/[\-]{2,}/", "-", $str);
    }

    return $str;
}

function russian_date(){
    $aMonth = array('января', 'февраля', 'марта', 'апреля', 'Мая', 'Июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
    $week = ["Monday" => "Понедельник", "Tuesday" => "Вторник", "Wednesday" => "Среда", "Thursday" => "Четверг", "Friday" => "Пятница", "Saturday" => "Суббота", "Sunday" => "Воскресенье",];

    $tt = explode('.', date('l.d.n.Y'));
    //первый вариант
    $data = $week[$tt[0]].', '.$tt[1].' '.$aMonth[$tt[2]-1].' '.$tt[3];
    //второй вариант
    //$data = $week[date('l')].', '.date('d').' '.$aMonth[date('n')-1].' '.date('Y');

    return $data;
}

function input($model, $item, $params = false){
    /*
     * $model  - имя таблицы в базе, с маленькой буквы;
     * $item   - имя поля;
     * $params - дополнительные параметры;
     *
     * placeholder - по умолчанию = показывает "название поля" (Пр: ['placeholder' => false(прятать)/true(показывать)] || ['placeholder']);
     * label - по умолчанию ['label' => true]
     * vh - вертикаль/горизонталь ['vh' => [4, 8]]
     * textarea -
     *
     */

    $name  = $model.'['.$item.']';//Пр: users[login]
    $name2 = $model.'_'.$item;    //Пр: users_login
    $nameModel = $model.'_model'; //полное имя модели Пр: users_model
    $CI = & get_instance();
    $CI->load->model($nameModel);
    $arrItem = $CI->$nameModel->items($item);//массив значений поля(ключи смотреть в модели)

    /*********set_value*********************************************/
    if($id = $CI->uri->segment(3))
        $value = Model::read(strtolower($model), ['where' => ['id' => $id]])[$item];
    else
        $value = null;
    if(function_exists('set_value') && set_value($name) != '')
        $value = set_value($name);
    /*********set_value_THE_END**************************************/

    /*********placeholder***************************************/
    if(isset($params['placeholder']))
        if(!$params['placeholder'])
            $placeholder = false;
        else
            $placeholder = 'placeholder="'.$arrItem['name'].'"';
    else
        $placeholder = 'placeholder="'.$arrItem['name'].'"';
    /*********placeholder_THE_END*******************************/

    $required = false;
    $flex = false;

    if(isset($params['vh']) && $params['vh']) $flex .= 'style="display: flex;"';

    $tt  = '<div class="form-group" '.$flex.'>';

    if(isset($params['vh']) && $params['vh']) $tt .= '<style> .control-label {  margin-bottom: 0;   padding-top: 7px;   text-align: right; } </style>';

    if(isset($params['label']) && $params['label'] || !isset($params['label'])){
        if(!isset($params['vh']))
            $tt .= '<label for="'.$name2.'">'.$arrItem['name'].$required.'</label>';
        else
            $tt .= '<label for="'.$name2.'" class="col-sm-'.$params['vh'][0].' control-label" style="padding-left: 0;">'.$arrItem['name'].$required.'</label>';
    }

    if(isset($params['vh']) && $params['vh']) $tt .= '<div class="col-sm-'.$params['vh'][1].'" style="padding: 0px;">';

    /*********TYPE**************/
    switch($arrItem['type']){
        case 'captcha':
            $tt .= '<input type="'.$arrItem['type'].'" class="form-control" id="'.$name2.'" name="'.$name.'" value="" style="width: 100px; float: left; margin-right: 10px;">';
            $tt .= '<img alt="" style="width: 120px; height: 34px; border: 0;" src="'.Ci::captcha().'" id="Imageid">';
            $tt .= '<i class="fa fa-refresh captcha" style="font-size: 24px; cursor: pointer; position: absolute; margin: 5px 0 0 10px;"></i>';
            break;
        case 'password':
            $value = '';
            $tt .= '<input type="'.$arrItem['type'].'" class="form-control" id="'.$name2.'" name="'.$name.'" value="'.$value.'" '.$placeholder.'>';
            break;
        case 'select':
            if(isset($params['select']['empty']))
                $firstOption = '<option value="0">'.$params['select']['empty'].'</option>';
            else
                $firstOption = false;
            $option = false;
            if(isset($params['select']['option'])){
                if(isset($params['select']['key'])){
                    foreach($params['select']['option'] as $options){
                        $option .= '<option value="'.$options[$params['select']['key'][0]].'">'.$options[$params['select']['key'][1]].'</option>';
                    }
                }else{
                    foreach($params['select']['option'] as $key => $value){
                        $option .= '<option value="'.$key.'">'.$value.'</option>';
                    }
                }
            }
            $tt .= '<select class="form-control" id="'.$name2.'" name="'.$name.'">'.$firstOption.$option.'</select>';
            break;
        case 'textarea':
            $tt .= '<textarea class="form-control" id="'.$name2.'" name="'.$name.'" '.$placeholder.'>'.$value.'</textarea>';

            if(isset($params['textarea']['ckeditor']) && $params['textarea']['ckeditor']){
                $tt .= '<script src="/js/lib/ckeditor/ckeditor.js"></script>';

                if(isset($params['textarea']['ckeditor']['config']) && $params['textarea']['ckeditor']['config']){
                    $config = ', customConfig: "'.$params['textarea']['ckeditor']['config'].'"';
                }else
                    $config = false;

                $tt .= '<script>CKEDITOR.replace("'.$name2.'", {
             filebrowserUploadUrl: "/js/lib/ckeditor/upload.php"
            '.$config.'});</script>';
            }
            break;
        default:
            $tt .= '<input type="'.$arrItem['type'].'" class="form-control" id="'.$name2.'" name="'.$name.'" value="'.$value.'" '.$placeholder.'>';
            break;
    }
    /*********TYPE_THE_END******/


    /*if($arrItem['type'] == 'textarea'){
        $tt .= '<textarea class="form-control" id="'.$name2.'" name="'.$name.'" '.$placeholder.'>'.$value.'</textarea>';

        if(isset($params['textarea']['ckeditor']) && $params['textarea']['ckeditor']){
            $tt .= '<script src="/jslib/ckeditor/ckeditor.js"></script>';

            if(isset($params['textarea']['ckeditor']['config']) && $params['textarea']['ckeditor']['config']){
                $config = ', customConfig: "'.$params['textarea']['ckeditor']['config'].'"';
            }else
                $config = false;

            $tt .= '<script>CKEDITOR.replace("'.$name2.'", {
             filebrowserUploadUrl: "/jslib/ckeditor/upload.php"
            '.$config.'});</script>';
        }
    }else{
        if($arrItem['type'] == 'captcha'){
            $tt .= '<input type="'.$arrItem['type'].'" class="form-control" id="'.$name2.'" name="'.$name.'" value="" style="width: 100px; float: left; margin-right: 10px;">';
            $tt .= '<img alt="" style="width: 120px; height: 34px; border: 0;" src="'.Ci::captcha().'" id="Imageid">';
            $tt .= '<i class="fa fa-refresh captcha" style="font-size: 24px; cursor: pointer; position: absolute; margin: 5px 0 0 10px;"></i>';
        }else
            $tt .= '<input type="'.$arrItem['type'].'" class="form-control" id="'.$name2.'" name="'.$name.'" value="'.$value.'" '.$placeholder.'>';

    }*/

    if(function_exists('form_error'))
        $tt .= form_error($name);

    if(isset($params['vh']) && $params['vh']) $tt .= '</div>';

    $tt .= '</div>';
    echo $tt;
}

function fioD($id, $full = false){
    /*
     * обязательно указываем
     * фамилия - fname
     * имя - name
     * отчество - oname
     * */
    //return CI::user($id)['fname'];

    //CI::user($id)->prizvische
    //$CI = & get_instance();
    //$CI->load->model('main_model');
    //$user = $CI->main_model->read('users', ['id' => $id]);
    //$rez = $user->prizvische.' '.mb_substr($user->imja, 0, 1, 'utf-8').'.'.mb_substr($user->otchestvo, 0, 1, 'utf-8').'.';
    if(isset(CI::user($id)['fname']) || isset(CI::user($id)['name']) || isset(CI::user($id)['oname'])){
        if($full)
            $rez = CI::user($id)['fname'].' '.CI::user($id)['name'].' '.CI::user($id)['oname'];
        else
            $rez = CI::user($id)['fname'].' '.mb_substr(CI::user($id)['name'], 0, 1, 'utf-8').'.'.mb_substr(CI::user($id)['oname'], 0, 1, 'utf-8').'.';
        return $rez;
    }else
        return 'd/n';

}

function vanDate(){
    /* П'ятниця - 11.09.2015 */
    $date = array("Monday" => "Понеділок", "Mon" => "Пн", "Tuesday" => "Вівторок", "Tue" => "Вт", "Wednesday" => "Середа", "Wed" => "Ср", "Thursday" => "Четвер", "Thu" => "Чт", "Friday" => "П'ятниця", "Fri" => "Пт", "Saturday" => "Субота", "Sat" => "Сб", "Sunday" => "Неділя", "Sun" => "Вс", "January" => "Января", "Jan" => "Янв", "February" => "Февраля", "Feb" => "Фев", "March" => "Марта", "Mar" => "Мар", "April" => "Апреля", "Apr" => "Апр", "May" => "Мая", "May" => "Мая", "June" => "Июня", "Jun" => "Июн", "July" => "Июля", "Jul" => "Июл", "August" => "Августа", "Aug" => "Авг", "September" => "Сентября", "Sep" => "Сен", "October" => "Октября", "Oct" => "Окт", "November" => "Ноября", "Nov" => "Ноя", "December" => "Декабря", "Dec" => "Дек");

    $date_day = date("l");
    foreach($date as $key=>$value){ if($date_day == $key){ $date_dd = $value; } }
    return $date_dd.date(' - j.m.Y');
}

function arrayFilter($arr1, $arr2){
    /*
     * обрезать массив
     * массив ($arr1) фильтруется по данным ($arr2)
     * $arr1 = ['a' => 1, 'b' => 2, 'c' => 3];
     * $arr2 = ['a', 'b'];
     * $rez = ['a' => 1, 'b' => 2];
     */
    $rez = [];
    foreach($arr2 as $row){
        $rez[$row] = $arr1[$row];
    }
    return $rez;
}

function role($name){
    //$arr = ['root' => 'Супер Администратор', 'admin' => 'Администратор', 'user' => 'Пользователь', 'expert' => 'Спортивный консультант'];
    $arr = [0 => 'Пользователь', 1 => 'Спортивный консультант'];
    return $arr[$name];
}
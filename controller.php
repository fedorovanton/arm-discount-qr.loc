<?php

session_start();

// подключение модели
require_once 'functions.php';
require_once 'model.php';

// страница по умолчанию
$view = empty($_GET['view']) ? 'menu' : $_GET['view'];

switch($view){
    case('menu'):
        if(isset($_POST['enter'])){
            $name = $_POST['name'];
            $pass = $_POST['pass'];
            auth($name, $pass);
        }
        if(isset($_POST['reg'])){
            $name = $_POST['name'];
            $pass = $_POST['pass'];
            reg($name, $pass);
            redirect();
        }
        break;

    case('adm_main'):

        break;

    case('adm_add'):
        $li1 = "class=active";

        // добавление скидки
        if(isset($_POST['add'])){
            insert_discounts($_POST['name'], $_POST['value']);
            redirect();
        }
        break;

    case('adm_view'):
        $li2 = "class=active";
        $discounts = select_table('discounts');

        // редактирование скидки
        if(isset($_POST['upd'])){
            update_discounts($_POST['discount_id'], $_POST['name'], $_POST['value']);
            redirect();
        }

        // удаление скидки
        if(isset($_POST['del'])){
            delete_discounts($_POST['discount_id']);
            redirect();
        }
        break;

    case('adm_generate_qr'):
        $li3 = "class=active";

        /* Блок для работы библиотеки QR-генерации*/
        // подключение библиотеки создания QR-кода
        include "qr/qrlib.php";

        $PNG_TEMP_DIR = 'qr/temp/';
        $PNG_WEB_DIR = 'qr/temp/';

        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);


        $filename = $PNG_TEMP_DIR.'test.png';

        //processing form input
        //remember to sanitize user input in real-life solution !!!
        $errorCorrectionLevel = 'H';
        if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
            $errorCorrectionLevel = $_REQUEST['level'];

        $matrixPointSize = 6;
        if (isset($_REQUEST['size']))
            $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


        if (isset($_REQUEST['user_id']) and isset($_REQUEST['discount_id'])) {

            //it's very important!
            /*if (trim($_REQUEST['data']) == '')
                die('data cannot be empty! <a href="?">back</a>');
            */

            // склеить пользователя и название скидки
            $dataRequest = "user_id".$_REQUEST['user_id']."-discount_id".$_REQUEST['discount_id'];

            // user data
            $filename = $PNG_TEMP_DIR.'test'.md5($dataRequest.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
            QRcode::png($dataRequest, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

            //display generated file
            //echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';

        } else {
            /*
            //default data
            echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';
            QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);

            //display generated file
            echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';
            */
        }
        /* Блок для работы библиотеки QR-генерации*/

        $discounts = select_table('discounts');
        $users = select_table('users');

        if(isset($_REQUEST['add'])){
            insert_user_discount($_REQUEST['user_id'], $_REQUEST['discount_id'], $filename);
        }
        break;

    case('adm_view_qr'):
        $li4 = "class=active";
        $users_discounts = select_users_discounts();

        if(isset($_POST['del'])){
            delete_users_discounts($_POST['user_discount_id']);
            redirect();
        }
        break;

    case('usr_view_qr'):
        $users_discounts = select_users_discounts_usr($_SESSION['auth']['user_id']);

        break;

    default:
        // если из адресной строки получено имя несуществуюшего шаблона
        $view = 'menu';
        break;
}

// подключение вида
require_once 'index_main.php';

?>
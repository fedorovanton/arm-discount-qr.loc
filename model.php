<?php
/* Авторизоваться */
function auth($name, $pass){
    $query = "SELECT user_id, name, password, access
                FROM users
                WHERE name = '$name'
                AND password = '$pass'
                LIMIT 1";
    $res = mysql_query($query) or die(mysql_error());
    if(mysql_num_rows($res) == 1){
        // если авторизация успешна
        $row = mysql_fetch_row($res);
        $_SESSION['auth']['user_id'] = $row[0];
        $_SESSION['auth']['name'] = $row[1];
        $_SESSION['auth']['pass'] = $row[2];
        $_SESSION['auth']['access'] = $row[3];
        if($_SESSION['auth']['access'] == 2){
            header('location: ?view=adm_main');
        } elseif($_SESSION['auth']['access'] == 1) {
            header('location: ?view=usr_view_qr');
        }
    } else {
        // если неверен логин/пароль
        $_SESSION['auth']['access_id'] = -1;
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Такого пользователя нет либо ввели неправильные данные.</div>";
    }
}
/* Авторизоваться */

/* Зарегестрироваться */
function reg($name, $pass){
    $query = "INSERT INTO users (name, password)
                VALUES ('$name', '$pass')";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info' style='margin-top: 10px;'>Вы зарегестрированы. Имя $name, пароль $pass</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Ошибка при регистрации.</div>";
    }
}
/* Зарегестрироваться */

/* Добавление скидки */
function insert_discounts($name, $value){
    $query = "INSERT INTO discounts (name, value)
                VALUES ('$name', '$value')";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info' style='margin-top: 10px;'>Скидка добавлена</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Скидка добавлена</div>";
    }
}
/* Добавление скидки */

/* Выборка из таблицы */
function select_table($table){
    $query = "SELECT * FROM $table";
    $res = mysql_query($query);
    $arr = array();
    while ($row = mysql_fetch_assoc($res)){
        $arr[] = $row;
    }

    return $arr;
}
/* Выборка из таблицы */

/* Редактирование скидки */
function update_discounts($discount_id, $name, $value){
    $query = "UPDATE discounts
                SET name = '$name', value = '$value'
                WHERE discount_id = $discount_id ";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info' style='margin-top: 10px;'>Скидка изменена</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Ошибка при изменении скидки</div>";
    }
}
/* Редактирование скидки */

/* Удаление записи из таблицы*/
function delete_discounts($discount_id){
    $query = "DELETE FROM discounts
                WHERE discount_id = $discount_id ";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info' style='margin-top: 10px;'>Скидка удалена</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Ошибка при удалении скидки</div>";
    }
}
/* Удаление записи из таблицы*/

/* Добавление записи в таблицу СкидкаПользователь*/
function insert_user_discount($user_id, $discount_id, $filename){
    $query = "INSERT INTO users_discounts (user_id, discount_id, code)
                VALUES ($user_id, $discount_id, '$filename')";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info' style='margin-top: 10px;'>QR-код сгенерирован</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Ошибка при генерации QR-кода</div>";
    }
}
/* Добавление записи в таблицу СкидкаПользователь*/

/* Получение данных из таблицы СкидкаПользователь */
function select_users_discounts(){
    $query = "SELECT users_discounts.user_discount_id,
                (SELECT users.name FROM users WHERE users.user_id = users_discounts.user_id) as user_name,
                (SELECT discounts.name FROM discounts WHERE discounts.discount_id = users_discounts.discount_id) as discount_name,
                users_discounts.code
                  FROM users_discounts";
    $res = mysql_query($query);
    $arr = array();
    while ($row = mysql_fetch_assoc($res)){
        $arr[] = $row;
    }

    return $arr;
}
/* Получение данных из таблицы СкидкаПользователь */

/* Удаление записи из СкидкаПользователь */
function delete_users_discounts($user_discount_id){
    $query = "DELETE FROM users_discounts
                WHERE user_discount_id = $user_discount_id";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info' style='margin-top: 10px;'>QR-скидка удалена</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Ошибка при удалении QR-скидки</div>";
    }
}
/* Удаление записи из СкидкаПользователь */

/* Просмотр скидок по конкретному пользователю */
function select_users_discounts_usr($user_id){
    $query = "SELECT users_discounts.user_discount_id,
                (SELECT users.name FROM users WHERE users.user_id = users_discounts.user_id) as user_name,
                (SELECT discounts.name FROM discounts WHERE discounts.discount_id = users_discounts.discount_id) as discount_name,
                users_discounts.code
                  FROM users_discounts
                  WHERE users_discounts.user_id = $user_id ";
    $res = mysql_query($query);
    $arr = array();
    while ($row = mysql_fetch_assoc($res)){
        $arr[] = $row;
    }

    return $arr;
}
/* Просмотр скидок по конкретному пользователю */
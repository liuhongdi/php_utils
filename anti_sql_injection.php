<?php
/**
 * Created by PhpStorm.
 * User: liuhongdi
 * Date: 19-6-10
 * Time: 上午9:00
 *
 * 过滤参数中的sql关键字
 * 用来防止sql注入
 *
 *
 */


class anti_sql_injection {

    var $arr_ignore_path;

    //construct

    function __construct(){

        //the path will be ignore,
        //such as alipay callback,weixin pay call back;

        $this->arr_ignore_path = array("alipayreturn","alipaynotify");
    }

    /*
     * filter $_GET,$_POST,
     * page_path: the url be access
     * return:none,
     * because:filter the $_GET,$_POST,
     * */
    function filter_get_post($page_path) {

        if (!in_array($page_path,$this->arr_ignore_path)) {
            $arr_bad = array("'",';',' WHERE ',' END ',' DUAL ',' FUNCTION ',' INT ',' NOT ',' NULL ',' LIMIT ',' REPLACE ',' IN ',' BOOLEAN ',' MODE ',' CASE ',' WHEN ',' LIKE ',' AS ',' UNION ',' ALL ','INFORMATION_SCHEMA',' BETWEEN ','and ','and(','or ','or(','sleep','copy','drop','sysdate','now()','from(','create','xor','select','update','delete','insert','count','/*','*/');
            $_GET = str_ireplace($arr_bad, '', $_GET);
            $_POST = str_ireplace($arr_bad, '', $_POST);

            foreach ($_GET as $k => $one)
            {
                $_GET[$k] = strip_tags($one);
            }

            foreach ($_POST as $k2 => $one2)
            {
                $_POST[$k2] = strip_tags($one2);
            }
        }
        
    }

}
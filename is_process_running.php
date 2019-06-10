<?php
/**
 * Created by PhpStorm.
 * User: liuhongdi
 * Date: 19-6-10
 * Time: 上午10:04
 *
 * 判断一个进程是否正在进行
 *
 */

class is_process_running {

    //construct

    function __construct(){

    }

    /*
     * get is a process is running
     *
     * prog_name: the program name,
     * example: /data/soft/etcd-v3.3.10-linux-amd64/etcd
     *          php-fpm
     *          nginx
     *
     * return: boolean: true: is running
     *                  false: not running
     */

    function is_a_process_running($prog_name) {

        $cmd = "ps -auxfww";
        $ret = shell_exec($cmd." 2>&1");

        $count = substr_count($ret, $prog_name);

        if ($count > 1) {
            return true;
        } else {
            return false;
        }

    }

}
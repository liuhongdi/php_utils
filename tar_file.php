<?php
/**
 * Created by PhpStorm.
 * User: liuhongdi
 * Date: 19-6-10
 * Time: 上午10:18
 *
 * 把文件打包进tar文件中
 *
 */

class tar_file {

    //construct

    function __construct(){

    }

    /*
     * pack a file into a tar
     *
     * param:tarpath: full path of tar file
     *       filepath: full path of file will go into tarball
     * return: if ==""  success
     *         else is error message
    */


    function tar_one_file($tarpath,$filepath)
    {
        $basename = basename($filepath);
        $dirname  = dirname($filepath);

        //添加文件到tar ball
        if (!is_file($tarpath))
        {
            $cmd_param = "cPf";
        }
        else
        {
            $cmd_param = "rPf";
        }

        //tar命令行，并运行

        $cmd_tar = "/bin/tar -".$cmd_param." ".$tarpath." -C ".$dirname." ".$basename;
        $ret_tar = shell_exec($cmd_tar." 2>&1");

        return $ret_tar;
    }


    /*
     * make a tar file by arr
     *
     * $tarfile:full path of tar file
     * $arr_file: array,all is full path of file
     *
     * return:if =="" success
     *        else is error message
     * */

    function make_a_tar_file_by_arr($tarfile,$arr_file)
    {
        //check dir

        // dir of tar file ,dir must is exist
        $curdir = dirname($tarfile);
        if (!is_dir($curdir))
        {
            @system("mkdir -p ".$curdir);
            chmod($curdir,0777);
        }


        foreach($arr_file as $kv => $onefile)
        {
            $ret = $this->tar_one_file($tarfile,$onefile);
            if ($ret != "") {
                return $ret;
            }
        }
        
        return "";
    }

}

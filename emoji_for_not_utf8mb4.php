<?php
/**
 * Created by PhpStorm.
 * User: liuhongdi
 * Date: 19-6-9
 * Time: 下午12:59
 *
 * 如果mysql数据库的字符集不是utf8mb4,则数据库中不能直接保存emoji字符
 *
 * 在写入数据库之前，执行emoji_to_str($emoji_string)，
 * 在从数据库读出text之后，执行:str_to_emoji($str)
 *
 * 这样就可以保存到字符集不是utf8mb4的mysql数据库了
 */

class emoji_for_not_utf8mb4
{
     // construct
     public function __construct(){

     }

    /*
     * read from mysql,
     * transmit  string to emoji
     * param:  str: the string will display
     * return: string after replace str to emoji
     *
    */

    public function str_to_emoji($str){

        preg_match_all('/\[\[EMOJI:(.*?)\]\]/',$str,$arr_content);

        foreach($arr_content[0] as $k=>$v){

            $emoji = $this->str2emoji($v);

            $str = str_replace($v,$emoji,$str);
        }

        return $str;
    }



    private function str2emoji($str) {

        $str = str_replace("[[EMOJI:", "", $str);
        $str = str_replace("]]", "", $str);
        $emoji = rawurldecode($str);

        return $emoji;
    }


    /*
     * before insert to mysql,
     * transmit emoji to string
     * param:emoji_string: the string include emoji
     * return: string after replace emoji
     * */

    public function emoji_to_str($emoji_string){

        $strEncode = '';
        $length = mb_strlen($emoji_string,'utf-8');
        for ($i=0; $i < $length; $i++) {
            $_tmpStr = mb_substr($emoji_string,$i,1,'utf-8');
            if(strlen($_tmpStr) >= 4){
                $strEncode .= '[[EMOJI:'.rawurlencode($_tmpStr).']]';
            }else{
                $strEncode .= $_tmpStr;
            }
        }
        return $strEncode;
    }


}



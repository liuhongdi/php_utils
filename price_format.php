<?php
/**
 * Created by PhpStorm.
 * User: liuhongdi
 * Date: 19-6-9
 * Time: 下午1:50
 *
 * get formatted price
 *
 * example:
 *
 * 15.65-->15.65
 * 15.60-->15.6
 * 15.00-->15
 *
 */

class price_format{

    //construct

    public function __construct(){

    }

    /*
     *
     * 得到价格的格式
     * param: price: the price will be format
     *
     * return:formatted price
     * */
    public function get_price_format($price)
    {
        $price_final = "";

        $arr_p = explode(".",$price);

        if (isset($arr_p[1]))
        {
            $xiaoshu = $arr_p[1];
            $len = strlen($xiaoshu);
            //长度是否大于2?如果大于2时，截取
            if ($len > 2)
            {
                $xiaoshu = substr($xiaoshu,0,2);
                $len = 2;
            }
            //
            if ($len == 2)
            {
                //先判断末位
                $is_last_digit = 0;
                $is_first_digit = 0;
                $last = substr($xiaoshu,1,1);
                if ($last == '0')
                {
                    $is_last_digit = 0;
                }
                else
                {
                    $is_last_digit = 1;
                }
                //再判断首位
                $first = substr($xiaoshu,0,1);
                if ($first == '0')
                {
                    $is_first_digit = 0;
                }
                else
                {
                    $is_first_digit = 1;
                }

                //进行处理
                if ($is_last_digit == 0 && $is_first_digit==0)
                {
                    $price_final = $arr_p[0];
                }
                else if ($is_last_digit == 0 && $is_first_digit==1)
                {
                    $price_final = $arr_p[0].".".$first;
                }
                else
                {
                    $price_final = $arr_p[0].".".$xiaoshu;
                }
            }

            if ($len == 1)
            {
                if ($xiaoshu == '0')
                {
                    $price_final = $arr_p[0];
                }
                else
                {
                    $price_final = $arr_p[0].".".$xiaoshu;
                }
            }

            if ($len == 0)
            {
                $price_final = $arr_p[0];
            }
        }
        else
        {
            $price_final = $price;
        }

        return $price_final;
    }
}




# php_utils

简繁体转换,emoji for not utf8mb4,price format，... 


# 1,emoji_for_not_utf8mb4.php功能：

如果mysql数据库的字符集不是utf8mb4,则数据库中不能直接保存emoji字符

 在写入数据库之前，执行emoji_to_str($emoji_string)，
 
 在从数据库读出text之后，执行:str_to_emoji($str)
 
 这样emoji就可以保存到字符集不是utf8mb4的mysql数据库了
 
# 2,jianti_fanti_charset.php功能：

 实现简繁体中文字符集的转换
 
# 3,price_format.php功能:

 对传入的商品价格参数做格式化:
 
 主要是去掉小数点末尾的0
 
 例子：
 
15.65-->15.65

15.60-->15.6

15.00-->15

# 4,anti_sql_injection.php功能：

对接收到的参数进行过滤，避免sql注入等安全问题

# 5,tar_file.php功能：

把文件打包进tar文件 

# 6,is_process_running.php功能:

判断一个程序是否正在执行?


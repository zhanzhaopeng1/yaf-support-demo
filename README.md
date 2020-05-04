# yaf-support-demo

描述
----
````
yaf-support的demo 
````

步骤
----
```` PHP 
1、git clone 
2、进入nginx/www/yaf-support-demo 下执行 composer install
3、docker-compose up -d
4、修改database.ini下的数据库信息、user表中必须有api_token字段
5、访问 http://127.0.0.1:8000/test/test?age=12&name=123
````

## 准备工作

### 环境

> PHP > 7.1  
  MySQL > 5.5  
  Redis > 2.8
### 安装 Laravel5.7

> composer create-project laravel/laravel Laravel --prefer-dist "5.7.*"

### 创建数据库



```
CREATE TABLE `users` (
    `id` INT UNSIGNED NOT NULL PRIMARY KEY auto_increment COMMENT '主键ID',
    `name` VARCHAR ( 12 ) NOT NULL COMMENT '用户名称',
    `password` VARCHAR ( 80 ) NOT NULL COMMENT '密码',
    `last_token` text COMMENT '登陆时的token',
    `status` TINYINT NOT NULL DEFAULT 0 COMMENT '用户状态 -1代表已删除 0代表正常 1代表冻结',
    `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT '创建时间',
`updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT '修改时间' 
) ENGINE = INNODB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
```

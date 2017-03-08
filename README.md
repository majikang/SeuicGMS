## Seuic GMS

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

General management system based on the Laravel PHP Framework

### Features

* 日志管理（Log Manager）
* 用户验证（Auth Manager）
* 用户管理（User Manager）
* 角色与权限管理（Roles & Permissions Manager）
* 模型视图分层，代码层解耦（Repository && Presenters && Services）
* 数据备份（Data Backup）
* 计划任务（Planning Task )
* 操作记录分析（Operation Log Analysis )

### Requirements

- **PHP : 5.6.15**
- **Laravel : 5.1.***
- **Composer**

### My Development Environment

#### Homestead/Docker
- PHP - 5.6.15
- Redis - 3.0.5
- Nginx - 1.8.0
- MySQL - 5.7.9

### Installation

1. **`git clone https://github.com/majikang/SeuicGMS.git`**
2. **`cd SeuicGMS-master`**
3. **`sudo chmod -R 777 storage/`**
4. **`sudo composer install`**
5. **`sudo npm install`**
6. **`sudo vi .env`**
7. **`gulp`**
8. **`php artisan migrate:refresh --seed`**
9. **`php artisan serve`**
10. **`gulp watch`**

> 默认账号: mjk@qq.com / admin@qq.com 密码: 123456

### Plugin
- [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) laravel-ide-helper
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) debugbar页面调试工具
- [arcanedev/log-viewer](https://packagist.org/packages/arcanedev/log-viewer) 日志文件记录
- [laravelcollective/html](https://laravelcollective.com/docs/5.0/html)   Forms & HTML 组件
- [zizaco/entrust](https://github.com/Zizaco/entrust)  基于RBAC的权限验证
- [mews/captcha](https://github.com/mewebstudio/captcha) 验证码
- [orangehill/iseed](https://github.com/orangehill/iseed) 数据库数据导出

### License

[MIT License](http://opensource.org/licenses/MIT)


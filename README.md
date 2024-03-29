# 说明

这是一个 imi MQTT 项目开发骨架项目，你可以基于这个项目来开发你的项目。

imi 框架：<https://www.imiphp.com>

imi 文档：<https://doc.imiphp.com>

## 安装

创建项目：`composer create-project imiphp/project-mqtt:~2.1.0`

## 配置

### 项目命名空间

默认是 `ImiApp`，可以在 `composer.json` 中修改：

* `autoload.psr-4.ImiApp`

* `imi.namespace`

然后替换代码中的命名空间即可。

### 运行配置

项目配置目录：`config`

MQTT 服务器配置目录：`MQTTServer/config` 和 `MQTTSServer/config`

## 启动命令

在本项目目录中，执行命令：`vendor/bin/imi-swoole swoole/start`

## 权限

`.runtime` 目录需要有可写权限

## 生产环境

**关闭热更新：**`config/beans.php` 中 `hotUpdate.status` 设为 `false`

## 代码质量

### 格式化代码

内置 `php-cs-fixer`，统一代码风格。

配置文件 `.php-cs-fixer.php`，可根据自己实际需要进行配置，文档：<https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/config.rst>

**格式化项目：** `./vendor/bin/php-cs-fixer fix`

**格式化指定文件：** `./vendor/bin/php-cs-fixer fix test.php`

### 代码静态分析

内置 `phpstan`，可规范代码，排查出一些隐藏问题。

配置文件 `phpstan.neon`，可根据自己实际需要进行配置，文档：<https://phpstan.org/config-reference>

**分析项目：** `./vendor/bin/phpstan`

**分析指定文件：** `./vendor/bin/phpstan test.php`

### 测试用例

内置 `phpunit`，可以实现自动化测试。

**文档：**<https://phpunit.readthedocs.io/en/9.5/>

**测试用例 demo：**`tests/Module/Test/TestServiceTest.php`

**运行测试用例：**`composer test`

# 说明

此项目仅帮你实现协议解析，并未实现业务逻辑，需要自行实现订阅和发布消息的逻辑。

imi 框架：https://www.imiphp.com

## 安装

### 方法一

* git 拉取下本项目

* 在本项目目录中，执行命令：`composer update`

### 方法二

* `composer create-project imiphp/project-mqtt`

## 启动命令

在本项目目录中，执行命令：`vendor/bin/imi-swoole swoole/start`

## 权限

`.runtime` 目录需要有可写权限

# swoft-rabc
swoft-rabc是一款简单高效的后台权限管理系统，使用swoft,d2admin构建。

# 技术选型
### 后端
* swoft
* php7.2.x
* MySQL 5.7.x,Redis
### 前端
* elementUI
* d2admin
* Apexcharts图表

[前端地址](https://github.com/nilocsu/swoft-rbac-vue.git)

### 权限控制
使用权限注解控制：菜单权限控制(RequiresPermissions)、 角色权限控制注解(RequiresRoles)
我们可以在Controller的方法上通过自定义权限注解进行权限控制，菜单权限控制用RequiresPermissions注解，比如下面这个方法只有当用户拥有user:add权限才能访问：
```php
    /**
     * @RequestMapping(route="admin", method={RequestMethod::POST})
     * @RequiresPermissions(value={"user:add"})
     * @param Request $request
     * @return array
     */
    public function addUser(Request $request)
    {
        ....
    }
```
当用户没有user:add权限时，系统将抛出UnauthorizedException异常，由HttpExceptionHandler捕获，返回403状态码。
提供的权限注解可以参考：
```php
    /**
     * 表示当前Subject需要角色admin和user。  
     * @RequiresRoles(value={"admin", "user"}, logical= Logical.AND)  
     * 表示当前Subject需要权限user:a或user:b。
     * @RequiresPermissions (value={"user:a", "user:b"}, logical= Logical.OR)
     */
    public function functionName(Request $request)
    {
        ....
    }
```

### 功能模块
```
├─系统管理
│  ├─用户管理
│  ├─角色管理
│  ├─菜单管理
│  ├─部门管理
├─系统监控
   ├─Redis监控
   ├─系统日志
   ├─登录日志
   └─系统信息
      └─服务器信息
```
### 安装
```bash
git clone https://github.com/wjkang/d2-admin-server.git
composer install
```
* 配置数据库
```bash
cp .env.example .env
```
```dotenv
# HTTP
HTTP_PORT = 

# Database Master nodes
DB_DSN =
DB_USERNAME =
DB_PASSWORD =
```
* 运行
```dotenv
php bin/swoft http:start
```

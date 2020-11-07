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
       // ....
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
        //....
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

### 图片预览
<img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev.png?raw=true" width="50%"/><img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev-%E6%9C%8D%E5%8A%A1%E5%99%A8%E4%BF%A1%E6%81%AF.png?raw=true" width="50%"/>
<img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev-Redis%E7%9B%91%E6%8E%A7.png?raw=true" width="50%"/><img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev-%E7%94%A8%E6%88%B7%E7%AE%A1%E7%90%86.png?raw=true" width="50%"/>
<img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev-%E7%99%BB%E5%BD%95%E6%97%A5%E5%BF%97.png?raw=true" width="50%"/><img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev-%E7%B3%BB%E7%BB%9F%E6%97%A5%E5%BF%97.png?raw=true" width="50%"/>
<img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev-%E8%8F%9C%E5%8D%95%E7%AE%A1%E7%90%86.png?raw=true" width="50%"/><img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev-%E8%A7%92%E8%89%B2%E7%AE%A1%E7%90%86.png?raw=true" width="50%"/>
<img src="https://github.com/nilocsu/swoft-rbac/blob/master/images/D2Admin-Dev-%E9%83%A8%E9%97%A8%E7%AE%A1%E7%90%86.png?raw=true" width="50%" />


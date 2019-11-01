# swoft-rabc
swoft-rabc是一款简单高效的后台权限管理系统，使用swoft,d2admin构建。

# 技术选型
### 后端
swoft
php7.2.x
MySQL 5.7.x,Redis
### 前端
elementUI
d2admin
Apexcharts图表

# 权限控制
使用注解控制
我们可以在Controller的方法上通过自定义权限注解进行权限控制，比如下面这个方法只有当用户拥有user:add权限才能访问：
```php
    /**
     * @RequestMapping(route="admin", method={RequestMethod::POST})
     * @RequiresPermissions(value={"user:add"})
     * @Log("新增用户")
     * @Validate(validator="AdminValidator")
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
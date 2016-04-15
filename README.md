# MXAPPMP
## 安装
1. `/storage` 及 `/bootstrap/cache` 拥有读写权限
2. 根目录下执行 `composer install` 可能需要安装`composer`
3. 复制一份 `.env.default` 放在根目录，命名为 `.env` ；修改里面的数据库配置,并创建数据库
4. 执行 `php artisan key:generate` 用于重置 `.env` 中的 `APP_KEY`
5. 执行 `php artisan migrate` 创建表及默认账号
6. 用 `admin` `123456` 登录即可

##关于补丁安全策略
参考:[点击这里](http://blog.cnbang.net/tech/2879/)

使用补丁前请添加rsa秘钥 `app/Library/rsa_key/rsa_private_key.pem`

__注意：数据库中的md5_rsa储存前经过__`base64 encode`
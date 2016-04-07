# MXAPPMP
1. /storage 及 /bootstrap/cache 拥有读写权限
2. 根目录下执行 composer install 可能需要安装composer
3. 复制一份 .env.default 放在根目录，命名为 .env ；修改里面的数据库配置,并创建数据库
4. 执行 php artisan key:generate 用于重置 .env 中的 APP_KEY
5. 执行 php artisan migrate --seed 创建表及填充数据
6. 用 admin 123456 登录即可

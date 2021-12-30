# 彰化縣學校參訪媒合平台
##安裝：
* 下載 git clone https://git.chc.edu.tw/school_visit/visit.git
* 安裝vendor套件 composer install
* 更改目錄權限 chmod 777 -R ./storage ./bootstrap/cache
* 複製.env檔 cp .env.example .env
* 產生金鑰 php artisan key:generate
* 手動新增一個名為 visit 的資料庫
* 修改 .env 裡的預設值及資料庫資料
* 依設計單產生資料表 php artisan migrate
* 初始新增資料表的資料 php db:seed
# 目前功能
* 使用 [fontawesome](https://fontawesome.com/icons?d=gallery) 字型
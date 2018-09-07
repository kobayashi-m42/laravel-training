-- 'laravel_training' というユーザー名のユーザーを '(YourPassword999)' というパスワードで作成
-- データベース 'laravel_training' への権限を付与
CREATE DATABASE laravel_training;
CREATE USER laravel_training@localhost IDENTIFIED WITH mysql_native_password BY '(YourPassword999)';
GRANT ALL ON laravel_training.* TO 'laravel_training'@'localhost';


-- 'laravel_training' というユーザー名のユーザーを '(YourPassword999)' というパスワードで作成
-- データベース 'laravel_training' への権限を付与
CREATE DATABASE laravel_training;
CREATE USER laravel_training@localhost IDENTIFIED WITH mysql_native_password BY '(YourPassword999)';
GRANT ALL ON laravel_training.* TO 'laravel_training'@'localhost';

-- 'laravel_training_test' というユーザー名のユーザーを '(YourPassword999)' というパスワードで作成
-- データベース 'laravel_training_test' への権限を付与
CREATE DATABASE laravel_training_test;
CREATE USER laravel_training_test@localhost IDENTIFIED WITH mysql_native_password BY '(YourPassword999)';
GRANT ALL ON laravel_training_test.* TO 'laravel_training_test'@'localhost';

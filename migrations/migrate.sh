echo "
      drop database if exists phpforum;
      create database if not exists phpforum;
      use phpforum;
      source /var/www/html/site/migrations/category.sql
      source /var/www/html/site/migrations/user.sql
      source /var/www/html/site/migrations/question.sql
      source /var/www/html/site/migrations/rating.sql
      source /var/www/html/site/migrations/answer.sql
      " | mysql -u root -p && echo "All migrations were applied successfully"
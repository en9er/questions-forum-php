echo "
      drop database if exists phpforum;
      create database if not exists phpforum;
      use phpforum;
      source /var/www/html/site/migrations/category.sql
      source /var/www/html/site/migrations/user.sql
      source /var/www/html/site/migrations/question.sql
      source /var/www/html/site/migrations/rating.sql
      source /var/www/html/site/migrations/answer.sql

      INSERT INTO user(email, login, name,  md5PasswordHash) VALUES('frendjoy55@gmail.com', 'en9er', 'Rinat Kubanov', 'd56b699830e77ba53855679cb1d252da');
      INSERT INTO user(email, login, name, md5PasswordHash) VALUES('example@gmail.com', 'exuser', 'Example User', 'd56b699830e77ba53855679cb1d252da');
      INSERT INTO category(categoryId, categoryName) VALUES(1, 'Physics');
      INSERT INTO category(categoryId, categoryName) VALUES(2, 'Sport');
      INSERT INTO question(questionId, question, categoryId, askedById) VALUES(1, 'This is my first question', '1', '2');
      INSERT INTO question(questionId, question, categoryId, askedById) VALUES(2, 'This is en9er question', '2', '1');
      INSERT INTO answer(answerId, assignedToQuestionId, answerText, answeredById) VALUES(1, '2', 'Idk rly but i hope this will help you https://youtube.com', '2');
      " | mysql -u root -p && echo "All migrations were applied successfully"
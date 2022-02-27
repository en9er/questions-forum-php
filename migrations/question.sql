CREATE TABLE IF NOT EXISTS `question` (
    `questionId` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `question` VARCHAR(512) NOT NULL,
    `userId`  INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`questionId`),
    FOREIGN KEY (userId) REFERENCES user(userId)
);
CREATE TABLE IF NOT EXISTS `question` (
    `questionId` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `question` VARCHAR(512) NOT NULL,
    `categoryId` INT(10) UNSIGNED NOT NULL,
    `askedById`  INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`questionId`),
    FOREIGN KEY (askedById) REFERENCES user(userId),
    FOREIGN KEY (categoryId) REFERENCES category(categoryId)
);
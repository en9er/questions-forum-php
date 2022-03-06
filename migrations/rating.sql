CREATE TABLE IF NOT EXISTS `rating` (
    `ratingId` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `value` INT CHECK (value BETWEEN 0 AND 10),
    `userId` INT(10) UNSIGNED NOT NULL,
    `questionId` INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`ratingId`),
    FOREIGN KEY (userId) REFERENCES user(userId),
    FOREIGN KEY (questionId) REFERENCES question(questionId)
);
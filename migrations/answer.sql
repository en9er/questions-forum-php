CREATE TABLE IF NOT EXISTS `answer` (
    `answerId` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `assignedToQuestionId` INT(10) UNSIGNED NOT NULL,
    `answerText` VARCHAR(512) NOT NULL,
    `answeredById`  INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`answerId`),
    FOREIGN KEY (answeredById) REFERENCES user(userId),
    FOREIGN KEY (assignedToQuestionId) REFERENCES question(questionId)
);
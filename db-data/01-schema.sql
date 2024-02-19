DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS matches;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS custom_quizzes;
DROP TABLE IF EXISTS custom_questions;

CREATE TABLE `users` (
                        `id_user` BIGINT AUTO_INCREMENT PRIMARY KEY,
                        `username` VARCHAR(30) NOT NULL,
                        `email` VARCHAR(100) NOT NULL,
                        `password` VARCHAR(40) NOT NULL,
                        `points` INT DEFAULT 0,
                        `quizzes_resolved` INT DEFAULT 0
);

CREATE TABLE `followers` (
                            `id_user_follow` BIGINT,
                            `id_user_followed` BIGINT,
                            PRIMARY KEY (`id_user_follow`, `id_user_followed`),
                            FOREIGN KEY (`id_user_follow`) REFERENCES `users`(`id_user`) ON DELETE CASCADE,
                            FOREIGN KEY (`id_user_followed`) REFERENCES `users`(`id_user`) ON DELETE CASCADE
);

CREATE TABLE `custom_quizzes` (
                          `id_quiz` BIGINT AUTO_INCREMENT PRIMARY KEY,
                          `n_questions` INT,
                          `clock` INT,
                          `time` INT CHECK (time >= 5),
                          `fk_id_user` BIGINT,
                          FOREIGN KEY (`fk_id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE
);


CREATE TABLE `matches` (
                         `id_user` BIGINT,
                         `id_custom_quiz` BIGINT,
                         `right_answers` INT,
                         PRIMARY KEY (`id_user`, `id_custom_quiz`),
                         FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`),
                         FOREIGN KEY (`id_custom_quiz`) REFERENCES `custom_quizzes`(`id_quiz`) ON DELETE CASCADE
);

CREATE TABLE `likes` (
                         `id_like` BIGINT AUTO_INCREMENT PRIMARY KEY,
                         `fk_id_user` BIGINT,
                         `fk_id_quiz` BIGINT,
                         FOREIGN KEY (`fk_id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE,
                         FOREIGN KEY (`fk_id_quiz`) REFERENCES `custom_quizzes`(`id_quiz`) ON DELETE CASCADE,
                         UNIQUE KEY `unique_like_user_quiz` (`fk_id_user`, `fk_id_quiz`)
);


CREATE TABLE `custom_questions` (
                                    `id_question` BIGINT AUTO_INCREMENT PRIMARY KEY,
                                    `title` VARCHAR(60),
                                    `option_a` VARCHAR(30),
                                    `option_b` VARCHAR(30),
                                    `option_c` VARCHAR(30),
                                    `correct_option` VARCHAR(30),
                                    `points` INT,
                                    `fk_id_quiz` BIGINT,
                                    FOREIGN KEY (`fk_id_quiz`) REFERENCES `custom_quizzes`(`id_quiz`) ON DELETE CASCADE
);

-- QUESTIONS FROM APP

DROP TABLE IF EXISTS questions;

CREATE TABLE `questions`
(
    `id_question`    BIGINT AUTO_INCREMENT PRIMARY KEY,
    `title`          VARCHAR(60),
    `option_a`       VARCHAR(30),
    `option_b`       VARCHAR(30),
    `option_c`       VARCHAR(30),
    `correct_option` VARCHAR(30),
    `points`         INT
);

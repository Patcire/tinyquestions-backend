DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS users_plays_matches;
DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS matches;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS quizzes;
DROP TABLE IF EXISTS custom_quizzes;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS random_quiz_has_random_question;


CREATE TABLE `users` (
            `id_user` BIGINT AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(30) UNIQUE NOT NULL,
            `email` VARCHAR(100) UNIQUE NOT NULL,
            `password` VARCHAR(200) NOT NULL,
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


CREATE TABLE `quizzes` (
          `id_quiz` BIGINT AUTO_INCREMENT PRIMARY KEY,
          `number_questions` INT NOT NULL,
          `clock` BOOLEAN NOT NULL,
          `time` INT CHECK (time >= 5),
          `type` VARCHAR(20),
          CONSTRAINT quiz_type_check CHECK (type IN ('custom', 'random'))

);

CREATE TABLE `custom_quizzes` (
           `id_quiz` BIGINT PRIMARY KEY,
           `quiz_name` VARCHAR(40) NOT NULL,
           `fk_id_user` BIGINT,
           FOREIGN KEY (id_quiz) REFERENCES quizzes(id_quiz),
           FOREIGN KEY (`fk_id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE
);

CREATE TABLE `random_quizzes` (
              `id_quiz` BIGINT PRIMARY KEY,
              `mode` VARCHAR(20),
              CONSTRAINT mode_check CHECK (
                  mode IN ('quick', 'random', 'explod')),
              FOREIGN KEY (id_quiz) REFERENCES quizzes(id_quiz)
);


CREATE TABLE `matches` (

       `id_match` BIGINT AUTO_INCREMENT PRIMARY KEY ,
       `isMultiplayer` boolean NOT NULL,
       `fk_id_quiz` BIGINT,
       `winner` VARCHAR(30),
       `number_players` VARCHAR(30),
       FOREIGN KEY (`fk_id_quiz`) REFERENCES `quizzes`(`id_quiz`) ON DELETE SET NULL

);


CREATE TABLE `likes` (
     `id_like` BIGINT AUTO_INCREMENT PRIMARY KEY,
     `fk_id_user` BIGINT,
     `fk_id_quiz` BIGINT,
     FOREIGN KEY (`fk_id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE,
     FOREIGN KEY (`fk_id_quiz`) REFERENCES `custom_quizzes`(`id_quiz`) ON DELETE CASCADE,
     UNIQUE KEY `unique_like_user_quiz` (`fk_id_user`, `fk_id_quiz`)
);

CREATE TABLE `users_plays_matches` (
        #  user can be delete, but no their matches,
        #  so i create anew id for the match
       `id_user_plays_match` BIGINT PRIMARY KEY  AUTO_INCREMENT,
       `id_user` BIGINT,
       `id_match` BIGINT,
        `date` TIMESTAMP,
        `points` INT,
       `answers` JSON,
       CONSTRAINT unique ck_user_match (id_match, id_user),
       FOREIGN KEY (id_match) REFERENCES matches(id_match),
       FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE SET NULL

);

CREATE TABLE `questions`
(
    `id_question`    BIGINT AUTO_INCREMENT PRIMARY KEY,
    `title`          VARCHAR(60) NOT NULL,
    `option_a`       VARCHAR(30) NOT NULL,
    `option_b`       VARCHAR(30) NOT NULL,
    `option_c`       VARCHAR(30) NOT NULL,
    `correct_option` VARCHAR(30) NOT NULL,
    `isCustom` boolean NOT NULL ,
    `points`   INT,
    `fk_id_quiz` BIGINT NULL,
    CONSTRAINT correct_option_check CHECK (
        correct_option IN (option_a, option_b, option_c)),
    FOREIGN KEY (`fk_id_quiz`) REFERENCES `custom_quizzes`(`id_quiz`) ON DELETE CASCADE

);


CREATE TABLE `random_quiz_has_random_question` (
        `id_quiz` BIGINT ,
        `id_question` BIGINT,
        FOREIGN KEY (`id_quiz`) REFERENCES `quizzes`(`id_quiz`) ON DELETE CASCADE,
        FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`) ON DELETE CASCADE

);






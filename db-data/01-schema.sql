DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS matches;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS custom_quizzes;
DROP TABLE IF EXISTS custom_questions;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS multiplayer_matches;
DROP TABLE IF EXISTS singleplayer_matches;
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
          `quiz_name` VARCHAR(40) NOT NULL,
          `number_questions` INT NOT NULL,
          `clock` BOOLEAN NOT NULL,
          `time` INT CHECK (time >= 5),
          `fk_id_user` BIGINT,
          FOREIGN KEY (`fk_id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE
);

CREATE TABLE `custom_quizzes` (
           `id_quiz` BIGINT PRIMARY KEY,
           `fk_id_user` BIGINT,
           FOREIGN KEY (id_quiz) REFERENCES quizzes(id_quiz),
           FOREIGN KEY (`fk_id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE
);

CREATE TABLE `matches` (

       `id_match` BIGINT AUTO_INCREMENT PRIMARY KEY ,
       `type` VARCHAR(20),
       `fk_id_quiz` BIGINT,
       FOREIGN KEY (`fk_id_quiz`) REFERENCES `quizzes`(`id_quiz`),
       CONSTRAINT type_check CHECK (type IN ('single', 'multi'))

);

CREATE TABLE `multiplayer_matches` (

       `id_match` BIGINT PRIMARY KEY ,
       `winner` VARCHAR(30),
       `number_players` INT CHECK ( number_players <= 8),
       FOREIGN KEY (`id_match`) REFERENCES `matches` (`id_match`)
);

CREATE TABLE `singleplayer_matches` (

    `id_match` BIGINT PRIMARY KEY ,
    `mode` VARCHAR(30),
    CONSTRAINT mode_check CHECK (mode IN ('quick', 'mirror', 'explod')),
    FOREIGN KEY (`id_match`) REFERENCES `matches` (`id_match`)
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
       `id_user_plays_match` BIGINT PRIMARY KEY  AUTO_INCREMENT, #  user can be delete, but no they matches
       `id_user` BIGINT,
       `id_match` BIGINT,
        `date` TIMESTAMP,
        `points` INT,
       `responses` JSON,
       CONSTRAINT unique _user_match (id_match, id_user),
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
    `points`         INT,
    type VARCHAR(20),
    CONSTRAINT quest_type_check CHECK (type IN ('custom', 'random')),
    CONSTRAINT correct_option_check CHECK (
        correct_option IN (option_a, option_b, option_c))
);


CREATE TABLE `custom_questions` (
    `id_question` BIGINT PRIMARY KEY,
    `fk_id_quiz` BIGINT,
    FOREIGN KEY (`id_question`) REFERENCES `questions`(`id_question`) ON DELETE CASCADE,
    FOREIGN KEY (`fk_id_quiz`) REFERENCES `custom_quizzes`(`id_quiz`) ON DELETE CASCADE

);



CREATE TABLE `random_quiz_has_random_question` (
        `id_quiz` BIGINT PRIMARY KEY,
        `id_question` BIGINT,
        FOREIGN KEY (`id_quiz`) REFERENCES `quizzes`(`id_quiz`) ON DELETE CASCADE,
        FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`) ON DELETE CASCADE

);






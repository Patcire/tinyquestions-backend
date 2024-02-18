DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS matches;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS quizzes;
DROP TABLE IF EXISTS custom_quizzes;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS quiz_has_questions;

CREATE TABLE users (
                       id_user BIGINT PRIMARY KEY AUTO_INCREMENT,
                       username VARCHAR(30)  UNIQUE,
                       email VARCHAR(100) UNIQUE,
                       password VARCHAR(40),
                       points INT,
                       quizzes_resolved INT
);

CREATE TABLE quizzes (
                         id_quiz BIGINT PRIMARY KEY AUTO_INCREMENT,
                         n_questions INT,
                         type ENUM('custom', 'quick', 'mirror', 'exploding', 'zen'),
                         clock BOOL,
                         time INT
);

CREATE TABLE questions (
                           id_question BIGINT PRIMARY KEY AUTO_INCREMENT,
                           title VARCHAR(60) UNIQUE,
                           option_a VARCHAR(30),
                           option_b VARCHAR(30),
                           option_c VARCHAR(30),
                           correct_option VARCHAR(30),
                           points INT
);

CREATE TABLE custom_quizzes (
                                id_quiz BIGINT PRIMARY KEY,
                                clock BOOL,
                                time INT,
    fk_id_user BIGINT,
    FOREIGN KEY (fk_id_user) REFERENCES users(id_user)
);

CREATE TABLE quiz_has_questions (
                                    id_quiz BIGINT,
                                    id_question BIGINT,
                                    PRIMARY KEY (id_quiz, id_question),
                                    FOREIGN KEY (id_quiz) REFERENCES quizzes(id_quiz),
                                    FOREIGN KEY (id_question) REFERENCES questions(id_question)
);

CREATE TABLE followers (
                           id_user_follow BIGINT,
                           id_user_followed BIGINT,
                           PRIMARY KEY (id_user_follow, id_user_followed),
                           FOREIGN KEY (id_user_follow) REFERENCES users(id_user),
                           FOREIGN KEY (id_user_followed) REFERENCES users(id_user)
);

CREATE TABLE matches (
                         id_user BIGINT,
                         id_quiz BIGINT,
                         right_answers INT,
                         PRIMARY KEY (id_user, id_quiz),
                         FOREIGN KEY (id_user) REFERENCES users(id_user),
                         FOREIGN KEY (id_quiz) REFERENCES quizzes(id_quiz)
);

CREATE TABLE likes (
                       id_user BIGINT,
                       id_quiz BIGINT,
                       PRIMARY KEY (id_user, id_quiz),
                       FOREIGN KEY (id_user) REFERENCES users(id_user),
                       FOREIGN KEY (id_quiz) REFERENCES quizzes(id_quiz)
);

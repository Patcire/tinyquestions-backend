INSERT INTO questions (id_question, title, option_a, option_b, option_c, correct_option, points) VALUES
(1, 'Director of "Lost in Translation"?', 'Sofia Coppola', 'Quentin Tarantino', 'Christopher Nolan', 'Sofia Coppola', 10),
(2, '2014 Best Picture indie?', 'Moonlight', 'Boyhood', 'La La Land', 'Moonlight', 10),
(3, 'Greta Gerwig''s debut?', 'Lady Bird', 'Little Women', 'Frances Ha', 'Lady Bird', 10),
(4, 'Director of "The Hurt Locker"?', 'Kathryn Bigelow', 'Ava DuVernay', 'Patty Jenkins', 'Kathryn Bigelow', 10),
(5, 'Band behind "Vespertine"?', 'Björk', 'Radiohead', 'Arcade Fire', 'Björk', 10),
(6, 'Lorde''s real name?', 'Ella Marija Lani Yelich', 'Stefani Joanne Angelina', 'Robyn Rihanna Fenty', 'Ella Marija Lani Yelich', 10),
(7, 'The National''s lead vocalist?', 'Matt Berninger', 'Thom Yorke', 'Brandon Flowers', 'Matt Berninger', 10),
(8, 'Caroline Polachek most viral song?', 'Hurting My Feelings', 'Door', 'sunset', 'Hurting My Feelings', 10),
(9, '1988 Summer Olympics host?', 'South Korea', 'United States', 'Australia', 'South Korea', 10),
(10, '2006 FIFA World Cup winner?', 'Italy', 'Brazil', 'Germany', 'Italy', 10),
(11, 'Sport associated with "slam dunk"?', 'Basketball', 'Football', 'Tennis', 'Basketball', 10),
(12, '"The Greatest" in boxing?', 'Muhammad Ali', 'Mike Tyson', 'Floyd Mayweather Jr.', 'Muhammad Ali', 10),
(13, 'First female UK Prime Minister?', 'Margaret Thatcher', 'Theresa May', 'Angela Merkel', 'Margaret Thatcher', 10),
(14, 'Year of the Berlin Wall fall?', '1989', '1991', '1987', '1989', 10),
(15, 'Longest US president term?', 'Franklin D. Roosevelt', 'George Washington', 'Abraham Lincoln', 'Franklin D. Roosevelt', 10),
(16, 'USSR leader during Cuban Missile Crisis?', 'Nikita Khrushchev', 'Leonid Brezhnev', 'Joseph Stalin', 'Nikita Khrushchev', 10),
(17, 'Current German Chancellor?', 'Olaf Scholz', 'Angela Merkel', 'Emmanuel Macron', 'Olaf Scholz', 10),
(18, 'First female Brazilian President?', 'Dilma Rousseff', 'Cristina Fernandez de Kirchner', 'Michelle Bachelet', 'Dilma Rousseff', 10),
(19, '"Libertarianism" political ideology?', 'Ltd government intervention', 'Strong government control', 'Totalitarianism', 'Lmtd government intervention', 10),
(20, '44th US President?', 'Barack Obama', 'Donald Trump', 'George W. Bush', 'Barack Obama', 10),
(21, 'Actor: Tony Stark in MCU?', 'Robert Downey Jr.', 'Chris Hemsworth', 'Chris Evans', 'Robert Downey Jr.', 10),
(22, '"Queen of Pop"?', 'Madonna', 'Beyoncé', 'Rihanna', 'Madonna', 10),
(23, 'Oscar winner for "La La Land"?', 'Emma Stone', 'Natalie Portman', 'Jennifer Lawrence', 'Emma Stone', 10),
(24, 'Singer-songwriter of "25" (2015)?', 'Adele', 'Taylor Swift', 'Beyoncé', 'Adele', 10),
(25, 'Water chemical symbol?', 'H2O', 'CO2', 'NaCl', 'H2O', 10),
(26, '"Red Planet"?', 'Mars', 'Venus', 'Jupiter', 'Mars', 10),
(27, 'Australia capital city?', 'Canberra', 'Sydney', 'Melbourne', 'Canberra', 10),
(28, '"To Kill a Mockingbird" author?', 'Harper Lee', 'John Steinbeck', 'Ernest Hemingway', 'Harper Lee', 10);

-- the other tables

-- Insertar usuarios
INSERT INTO users (username, email, password, points, quizzes_resolved)
VALUES
    ('usuario1', 'usuario1@example.com', 'contraseña1', 100, 5),
    ('usuario2', 'usuario2@example.com', 'contraseña2', 75, 3),
    ('usuario3', 'usuario3@example.com', 'contraseña3', 50, 2);

-- Insertar seguidores
INSERT INTO followers (id_user_follow, id_user_followed)
VALUES
    (1, 2),
    (1, 3),
    (2, 1),
    (3, 1);

-- Insertar cuestionarios personalizados
INSERT INTO custom_quizzes (id_quiz, n_questions, clock, time, fk_id_user)
VALUES
    (1, 10, 60, 10, 1),
    (2, 8, 45, 8, 2),
    (3, 12, 90, 15, 3);

-- Insertar partidas
INSERT INTO matches (id_user, id_custom_quiz, right_answers)
VALUES
    (1, 1, 8),
    (1, 2, 6),
    (2, 1, 7),
    (3, 3, 10);

-- Insertar likes
INSERT INTO likes (id_user, id_quiz)
VALUES
    (1, 2),
    (1, 3),
    (2, 1),
    (3, 1);

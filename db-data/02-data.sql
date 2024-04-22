INSERT INTO users (username, email, password, points, quizzes_resolved)
VALUES  ('pepepepe', 'pepe@gmail.com', 'pepepepe', 100, 3),
        ('usuario2', 'usuario2@example.com', 'password2', 50, 1),
        ('usuario3', 'usuario3@example.com', 'password3', 75, 2),
        ('usuario4', 'usuario4@example.com', 'password4', 200, 5),
        ('usuario5', 'usuario5@example.com', 'password5', 150, 4);

INSERT INTO followers (id_user_follow, id_user_followed)
VALUES
    (1, 2),
    (1, 3),
    (2, 3),
    (4, 1),
    (5, 2);

INSERT INTO quizzes (quiz_name, number_questions, clock, time, fk_id_user)
VALUES
    ('Quiz1', 10, TRUE, 10, 1),
    ('Quiz2', 15, FALSE, NULL, 2),
    ('Quiz3', 20, TRUE, 15, 4);

INSERT INTO matches (type, fk_id_quiz)
VALUES
    ('single', 1),
    ('multi', 2),
    ('single', 3),
    ('multi', 1),
    ('single', 2);

INSERT INTO custom_quizzes (id_quiz, fk_id_user)
VALUES
    (1, 1),
    (2, 2),
    (3, 4);


INSERT INTO multiplayer_matches (id_match, winner, number_players)
VALUES
    (4, 'usuario4', 4),
    (5, 'usuario2', 6);


INSERT INTO singleplayer_matches (id_match, mode)
VALUES
    (1, 'quick'),
    (3, 'mirror'),
    (5, 'explod');

INSERT INTO likes (fk_id_user, fk_id_quiz)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);


INSERT INTO users_plays_matches (id_user, id_match)
VALUES
    (1, 1),
    (2, 1),
    (3, 2),
    (4, 3),
    (5, 4);

INSERT INTO questions (title, option_a, option_b, option_c, correct_option, points, type)
VALUES
('Director of "Lost in Translation"?', 'Sofia Coppola', 'Quentin Tarantino', 'Christopher Nolan', 'Sofia Coppola', 10, 'random'),
('2014 Best Picture indie?', 'Moonlight', 'Boyhood', 'La La Land', 'Moonlight', 10, 'random'),
('Greta Gerwig''s debut?', 'Lady Bird', 'Little Women', 'Frances Ha', 'Lady Bird', 10, 'random'),
('Director of "The Hurt Locker"?', 'Kathryn Bigelow', 'Ava DuVernay', 'Patty Jenkins', 'Kathryn Bigelow', 10, 'random'),
('Band behind "Vespertine"?', 'Björk', 'Radiohead', 'Arcade Fire', 'Björk', 10, 'random'),
('"Lorde" real name?', 'Ella Marija Lani Yelich', 'Stefani Joanne Angelina', 'Robyn Rihanna Fenty', 'Ella Marija Lani Yelich', 10, 'random'),
('The National''s lead vocalist?', 'Matt Berninger', 'Thom Yorke', 'Brandon Flowers', 'Matt Berninger', 10, 'random'),
('Caroline Polachek most viral song?', 'Hurting My Feelings', 'Door', 'sunset', 'Hurting My Feelings', 10, 'random'),
('1988 Summer Olympics host?', 'South Korea', 'United States', 'Australia', 'South Korea', 10, 'random'),
( '2006 FIFA World Cup winner?', 'Italy', 'Brazil', 'Germany', 'Italy', 10, 'random'),
( 'Sport associated with "slam dunk"?', 'Basketball', 'Football', 'Tennis', 'Basketball', 10, 'random'),
( '"The Greatest" in boxing?', 'Muhammad Ali', 'Mike Tyson', 'Floyd Mayweather Jr.', 'Muhammad Ali', 10, 'random'),
( 'First female UK Prime Minister?', 'Margaret Thatcher', 'Theresa May', 'Angela Merkel', 'Margaret Thatcher', 10, 'random'),
( 'Year of the Berlin Wall fall?', '1989', '1991', '1987', '1989', 10, 'random'),
( 'Longest US president term?', 'Franklin D. Roosevelt', 'George Washington', 'Abraham Lincoln', 'Franklin D. Roosevelt', 10, 'random'),
( 'USSR leader during Cuban Missile Crisis?', 'Nikita Khrushchev', 'Leonid Brezhnev', 'Joseph Stalin', 'Nikita Khrushchev', 10, 'random'),
( 'Current German Chancellor?', 'Olaf Scholz', 'Angela Merkel', 'Emmanuel Macron', 'Olaf Scholz', 10, 'random'),
( 'First female Brazilian President?', 'Dilma Rousseff', 'Cristina Fernandez de Kirchner', 'Michelle Bachelet', 'Dilma Rousseff', 10, 'random'),
( '"Libertarianism" political ideology?', 'Ltd government intervention', 'Strong government control', 'Totalitarianism', 'Ltd government intervention', 10, 'random'),
( '44th US President?', 'Barack Obama', 'Donald Trump', 'George W. Bush', 'Barack Obama', 10, 'random'),
( 'Actor: Tony Stark in MCU?', 'Robert Downey Jr.', 'Chris Hemsworth', 'Chris Evans', 'Robert Downey Jr.', 10, 'random'),
( '"Queen of Pop"?', 'Madonna', 'Beyonce', 'Rihanna', 'Madonna', 10, 'random'),
( 'Oscar winner for "La La Land"?', 'Emma Stone', 'Natalie Portman', 'Jennifer Lawrence', 'Emma Stone', 10, 'custom'),
( 'Singer-songwriter of "25" (2015)?', 'Adele', 'Taylor Swift', 'Beyonce', 'Adele', 10, 'custom'),
( 'Water chemical symbol?', 'H2O', 'CO2', 'NaCl', 'H2O', 10, 'custom'),
( '"Red Planet"?', 'Mars', 'Venus', 'Jupiter', 'Mars', 10, 'custom'),
( 'Australia capital city?', 'Canberra', 'Sydney', 'Melbourne', 'Canberra', 10, 'custom'),
( '"To Kill a Mockingbird" author?', 'Harper Lee', 'John Steinbeck', 'Ernest Hemingway', 'Harper Lee', 10, 'custom'),
('Painter known for "The Two Fridas"', 'Georgia OKeeffe', 'Frida Kahlo', 'Tamara de Lempicka', 'Tamara de Lempicka', 10, 'random'),
('Singer known for "Rehab"', 'Adele', 'Amy Winehouse', 'Taylor Swift', 'Amy Winehouse', 10, 'random'),
('Director of "The Hurt Locker"', 'Kathryn Bigelow', 'Ava DuVernay', 'Patty Jenkins', 'Kathryn Bigelow', 10, 'random'),
('Singer-songwriter known for "Jolene"', 'Dolly Parton', 'Carole King', 'Joan Baez', 'Dolly Parton', 10, 'random'),
('Artist known for "The Dinner Party"', 'Louise Bourgeois', 'Yayoi Kusama', 'Judy Chicago', 'Yayoi Kusama', 10, 'random'),
('Actress known for "Breakfast at Tiffanys"', 'Audrey Hepburn', 'Marilyn Monroe', 'Grace Kelly', 'Audrey Hepburn', 10, 'random'),
('Painter known for "Ophelia"', 'Georgia OKeeffe', 'Frida Kahlo', 'John Singer Sargent', 'Frida Kahlo', 10, 'random'),
('Singer known for "Rolling in the Deep"', 'Adele', 'Amy Winehouse', 'Taylor Swift', 'Adele', 10, 'random'),
('Director of "Carol"', 'Todd Haynes', 'J. Dacorneau', 'Francis Ford Coppola', 'Todd Haynes', 10, 'random'),
('Singer-songwriter known for "Wuthering Heights"', 'Bjork', 'Kate Bush', 'Sia', 'Kate Bush', 10, 'random'),
('Artist known for "My Bed"', 'Yayoi Kusama', 'Tracey Emin', 'Banksy', 'Tracey Emin', 10, 'random'),
('Actress known for "Monster"', 'Charlize Theron', 'Meryl Streep', 'Angelina Jolie', 'Charlize Theron', 10, 'random'),
('Painter known for "The Persistence of Memory"', 'Georgia OKeeffe', 'Frida Kahlo', 'Salvador Dali', 'Salvador Dali', 10, 'random'),
('Singer known for "Big Yellow Taxi"', 'Joni Mitchell', 'Carole King', 'Janis Joplin', 'Joni Mitchell', 10, 'random'),
('Director of "American Psycho"', 'Kathryn Bigelow', 'Sofia Coppola', 'Mary Harron', 'Mary Harron', 10, 'custom'),
('Singer-songwriter known for "Pagan Poetry"', 'Bjork', 'Kate Bush', 'Sia', 'Bjork', 10, 'custom'),
('Artist known for "Love Is What You Want"', 'Yayoi Kusama', 'Tracey Emin', 'Agnes Martin', 'Tracey Emin', 10, 'custom'),
('Actress of "Mad Max: Fury Road"', 'Charlize Theron', 'Meryl Streep', 'Angelina Jolie', 'Charlize Theron', 10, 'custom'),
('Artist of Self Portrait with Thorn Necklace and Hummingbird', 'Georgia OKeeffe', 'Frida Kahlo', 'Tamara de Lempicka', 'Frida Kahlo', 10, 'custom'),
('Singer known for "River"', 'Joni Mitchell', 'Carole King', 'Janis Joplin', 'Joni Mitchell', 10, 'custom'),
('Novel known for "Strangers on a Train"', 'Rebecca', 'Psycho', 'Strangers on a Train', 'Strangers on a Train', 10, 'custom'),
('Singer-songwriter known for "Running Up That Hill"', 'Bjork', 'Kate Bush', 'Sia', 'Kate Bush', 10, 'custom'),
('Artist known for "Spiral Jetty"', 'Yayoi Kusama', 'Tracey Emin', 'Agnes Martin', 'Agnes Martin', 10, 'custom'),
('Actress known for "The Devil Wears Prada"', 'Anne Hathaway', 'Meryl Streep', 'Julia Roberts', 'Meryl Streep', 10, 'custom'),
('Beach house bloom album year"', '2012', '2008', '2019', '2012', 10, 'custom'),
('Singer known for "From the Choirgirl Hotel"', 'Tori Amos', 'PJ Harvey', 'Alanis Morissette', 'Tori Amos', 10, 'custom'),
('Director of "American Psycho"', 'Kathryn Bigelow', 'Sofia Coppola', 'Mary Harron', 'Mary Harron', 10, 'custom'),
('Singer-songwriter known for "Army of Me"', 'Bjork', 'Kate Bush', 'Sia', 'Bjork', 10, 'custom');

-- insert custom questions of custom quizzes
INSERT INTO custom_questions (id_question, fk_id_quiz)
VALUES
(56, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3);




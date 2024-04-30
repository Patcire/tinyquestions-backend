INSERT INTO users (username, email, password, points, quizzes_resolved) VALUES
        ('usuario1', 'usuario1@example.com', 'contraseña1', 0, 0),
        ('usuario2', 'usuario2@example.com', 'contraseña2', 0, 0);

INSERT INTO quizzes (number_questions, clock, time, type) VALUES
  (10, TRUE, 60, 'custom'),
  (5, FALSE, NULL, 'random');

INSERT INTO custom_quizzes (id_quiz, quiz_name, fk_id_user) VALUES
(1, 'My Custom Quiz 1', 1),
(2, 'My Custom Quiz 2', 2);

INSERT INTO random_quizzes (id_quiz, mode) VALUES
    (2, 'quick');

INSERT INTO questions (title, option_a, option_b, option_c, correct_option, isCustom, points, fk_id_quiz)
VALUES
('Director of "Lost in Translation"?', 'Sofia Coppola', 'Quentin Tarantino', 'Christopher Nolan', 'Sofia Coppola', 0, 10, NULL),
('2014 Best Picture indie?', 'Moonlight', 'Boyhood', 'La La Land', 'Moonlight', 0, 10, NULL),
('Greta Gerwig''s debut?', 'Lady Bird', 'Little Women', 'Frances Ha', 'Lady Bird', 0, 10, NULL),
('Director of "The Hurt Locker"?', 'Kathryn Bigelow', 'Ava DuVernay', 'Patty Jenkins', 'Kathryn Bigelow', 0, 10, NULL),
('Band behind "Vespertine"?', 'Björk', 'Radiohead', 'Arcade Fire', 'Björk', 0, 10, NULL),
('"Lorde" real name?', 'Ella Marija Lani Yelich', 'Stefani Joanne Angelina', 'Robyn Rihanna Fenty', 'Ella Marija Lani Yelich', 0, 10, NULL),
('The National''s lead vocalist?', 'Matt Berninger', 'Thom Yorke', 'Brandon Flowers', 'Matt Berninger', 0, 10, NULL),
('Caroline Polachek most viral song?', 'Hurting My Feelings', 'Door', 'sunset', 'Hurting My Feelings', 0, 10, NULL),
('1988 Summer Olympics host?', 'South Korea', 'United States', 'Australia', 'South Korea', 0, 10, NULL),
('2006 FIFA World Cup winner?', 'Italy', 'Brazil', 'Germany', 'Italy', 0, 10, NULL),
('Sport associated with "slam dunk"?', 'Basketball', 'Football', 'Tennis', 'Basketball', 0, 10, NULL),
('"The Greatest" in boxing?', 'Muhammad Ali', 'Mike Tyson', 'Floyd Mayweather Jr.', 'Muhammad Ali', 0, 10, NULL),
('First female UK Prime Minister?', 'Margaret Thatcher', 'Theresa May', 'Angela Merkel', 'Margaret Thatcher', 0, 10, NULL),
('Year of the Berlin Wall fall?', '1989', '1991', '1987', '1989', 0, 10, NULL),
('Longest US president term?', 'Franklin D. Roosevelt', 'George Washington', 'Abraham Lincoln', 'Franklin D. Roosevelt', 0, 10, NULL),
('USSR leader during Cuban Missile Crisis?', 'Nikita Khrushchev', 'Leonid Brezhnev', 'Joseph Stalin', 'Nikita Khrushchev', 0, 10, NULL),
('Current German Chancellor?', 'Olaf Scholz', 'Angela Merkel', 'Emmanuel Macron', 'Olaf Scholz', 0, 10, NULL),
('First female Brazilian President?', 'Dilma Rousseff', 'Cristina Fernandez de Kirchner', 'Michelle Bachelet', 'Dilma Rousseff', 0, 10, NULL),
('"Libertarianism" political ideology?', 'Ltd government intervention', 'Strong government control', 'Totalitarianism', 'Ltd government intervention', 0, 10, NULL),
('44th US President?', 'Barack Obama', 'Donald Trump', 'George W. Bush', 'Barack Obama', 0, 10, NULL),
('Actor: Tony Stark in MCU?', 'Robert Downey Jr.', 'Chris Hemsworth', 'Chris Evans', 'Robert Downey Jr.', 0, 10, NULL),
('"Queen of Pop"?', 'Madonna', 'Beyonce', 'Rihanna', 'Madonna', 0, 10, NULL),
('Oscar winner for "La La Land"?', 'Emma Stone', 'Natalie Portman', 'Jennifer Lawrence', 'Emma Stone', 0, 10, NULL),
('Singer-songwriter of "25" (2015)?', 'Adele', 'Taylor Swift', 'Beyonce', 'Adele', 0, 10, NULL),
('Water chemical symbol?', 'H2O', 'CO2', 'NaCl', 'H2O', 0, 10, NULL),
('"Red Planet"?', 'Mars', 'Venus', 'Jupiter', 'Mars', 0, 10, NULL),
('Australia capital city?', 'Canberra', 'Sydney', 'Melbourne', 'Canberra', 0, 10, NULL),
('"To Kill a Mockingbird" author?', 'Harper Lee', 'John Steinbeck', 'Ernest Hemingway', 'Harper Lee', 0, 10, NULL),
('Painter known for "The Two Fridas"', 'Georgia OKeeffe', 'Frida Kahlo', 'Tamara de Lempicka', 'Tamara de Lempicka', 0, 10, NULL),
('Singer known for "Rehab"', 'Adele', 'Amy Winehouse', 'Taylor Swift', 'Amy Winehouse', 0, 10, NULL),
('Director of "The Hurt Locker"', 'Kathryn Bigelow', 'Ava DuVernay', 'Patty Jenkins', 'Kathryn Bigelow', 0, 10, NULL),
('Singer-songwriter known for "Jolene"', 'Dolly Parton', 'Carole King', 'Joan Baez', 'Dolly Parton', 0, 10, NULL),
('Artist known for "The Dinner Party"', 'Louise Bourgeois', 'Yayoi Kusama', 'Judy Chicago', 'Yayoi Kusama', 0, 10, NULL),
('Actress known for "Breakfast at Tiffanys"', 'Audrey Hepburn', 'Marilyn Monroe', 'Grace Kelly', 'Audrey Hepburn', 0, 10, NULL),
('Painter known for "Ophelia"', 'Georgia OKeeffe', 'Frida Kahlo', 'John Singer Sargent', 'Frida Kahlo', 0, 10, NULL),
('Singer known for "Rolling in the Deep"', 'Adele', 'Amy Winehouse', 'Taylor Swift', 'Adele', 0, 10, NULL),
('Director of "Carol"', 'Todd Haynes', 'J. Dacorneau', 'Francis Ford Coppola', 'Todd Haynes', 0, 10, NULL),
('Singer-songwriter known for "Wuthering Heights"', 'Bjork', 'Kate Bush', 'Sia', 'Kate Bush', 0, 10, NULL),
('Artist known for "My Bed"', 'Yayoi Kusama', 'Tracey Emin', 'Banksy', 'Tracey Emin', 0, 10, NULL),
('Actress known for "Monster"', 'Charlize Theron', 'Meryl Stre

ep', 'Angelina Jolie', 'Charlize Theron', 0, 10, NULL),
('Painter known for "The Persistence of Memory"', 'Georgia OKeeffe', 'Frida Kahlo', 'Salvador Dali', 'Salvador Dali', 0, 10, NULL),
('Singer known for "Big Yellow Taxi"', 'Joni Mitchell', 'Carole King', 'Janis Joplin', 'Joni Mitchell', 0, 10, NULL),
('Director of "American Psycho"', 'Kathryn Bigelow', 'Sofia Coppola', 'Mary Harron', 'Mary Harron', 1, 10, 1),
('Singer-songwriter known for "Pagan Poetry"', 'Bjork', 'Kate Bush', 'Sia', 'Bjork', 1, 10, 1),
('Artist known for "Love Is What You Want"', 'Yayoi Kusama', 'Tracey Emin', 'Agnes Martin', 'Tracey Emin', 1, 10, 1),
('Actress of "Mad Max: Fury Road"', 'Charlize Theron', 'Meryl Streep', 'Angelina Jolie', 'Charlize Theron', 1, 10, 1),
('Artist of Self Portrait with Thorn Necklace and Hummingbird', 'Georgia OKeeffe', 'Frida Kahlo', 'Tamara de Lempicka', 'Frida Kahlo', 1, 10, 1),
('Singer known for "River"', 'Joni Mitchell', 'Carole King', 'Janis Joplin', 'Joni Mitchell', 1, 10, 1),
('Novel known for "Strangers on a Train"', 'Rebecca', 'Psycho', 'Strangers on a Train', 'Strangers on a Train', 1, 10, 1),
('Singer-songwriter known for "Running Up That Hill"', 'Bjork', 'Kate Bush', 'Sia', 'Kate Bush', 1, 10, 1),
('Artist known for "Spiral Jetty"', 'Yayoi Kusama', 'Tracey Emin', 'Agnes Martin', 'Agnes Martin', 1, 10, 1),
('Actress known for "The Devil Wears Prada"', 'Anne Hathaway', 'Meryl Streep', 'Julia Roberts', 'Meryl Streep', 1, 10, 1),
('Beach house bloom album year"', '2012', '2008', '2019', '2012', 1, 10, 1),
('Singer known for "From the Choirgirl Hotel"', 'Tori Amos', 'PJ Harvey', 'Alanis Morissette', 'Tori Amos', 1, 10, 1),
('Director of "American Psycho"', 'Kathryn Bigelow', 'Sofia Coppola', 'Mary Harron', 'Mary Harron', 1, 10, 1),
('Singer-songwriter known for "Army of Me"', 'Bjork', 'Kate Bush', 'Sia', 'Bjork', 1, 10, 1);





CREATE DATABASE IF NOT EXISTS movie_recommender;

USE movie_recommender;

CREATE TABLE movies (

    id INT AUTO_INCREMENT PRIMARY KEY,

    title VARCHAR(150) NOT NULL,

    main_tag VARCHAR(50) NOT NULL,

    subtag_1 VARCHAR(50) NOT NULL,

    subtag_2 VARCHAR(50) NOT NULL

);
INSERT INTO movies
(title, main_tag, subtag_1, subtag_2)
VALUES

('Interestelar', 'ficcao', 'espaco', 'drama'),

('Batman: O Cavaleiro das Trevas', 'acao', 'crime', 'heroi'),

('Titanic', 'romance', 'drama', 'historico'),

('John Wick', 'acao', 'crime', 'vinganca'),

('Gravidade', 'ficcao', 'espaco', 'sobrevivencia'),

('Vingadores', 'acao', 'heroi', 'ficcao'),

('O Poderoso Chefao', 'crime', 'drama', 'mafia'),

('La La Land', 'romance', 'musical', 'drama'),

('Alien', 'terror', 'ficcao', 'espaco'),

('Gladiador', 'acao', 'historico', 'drama');
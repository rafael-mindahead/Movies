CREATE DATABASE IF NOT EXISTS movie_recommender
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE movie_recommender;

DROP TABLE IF EXISTS movies;

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    main_tag VARCHAR(50) NOT NULL,
    subtag_1 VARCHAR(50) NOT NULL,
    subtag_2 VARCHAR(50) NOT NULL
);

INSERT INTO movies (title, main_tag, subtag_1, subtag_2) VALUES
('Interestelar', 'ficcao', 'espaco', 'drama'),
('A Origem', 'ficcao', 'suspense', 'mente'),
('Matrix', 'ficcao', 'acao', 'tecnologia'),
('Blade Runner 2049', 'ficcao', 'drama', 'futuro'),
('Duna', 'ficcao', 'aventura', 'espaco'),
('Gravidade', 'ficcao', 'espaco', 'sobrevivencia'),
('Alien', 'terror', 'ficcao', 'espaco'),
('Aliens', 'acao', 'ficcao', 'espaco'),
('O Exterminador do Futuro 2', 'acao', 'ficcao', 'futuro'),
('De Volta para o Futuro', 'ficcao', 'comedia', 'viagem_no_tempo'),

('Batman: O Cavaleiro das Trevas', 'acao', 'crime', 'heroi'),
('Batman Begins', 'acao', 'heroi', 'crime'),
('Vingadores', 'acao', 'heroi', 'ficcao'),
('Vingadores: Ultimato', 'acao', 'heroi', 'drama'),
('Homem de Ferro', 'acao', 'heroi', 'tecnologia'),
('Capitao America: O Soldado Invernal', 'acao', 'heroi', 'espionagem'),
('Homem-Aranha 2', 'acao', 'heroi', 'drama'),
('Logan', 'acao', 'heroi', 'drama'),
('Mad Max: Estrada da Furia', 'acao', 'aventura', 'pos_apocaliptico'),
('John Wick', 'acao', 'crime', 'vinganca'),

('John Wick 2', 'acao', 'crime', 'vinganca'),
('Missao Impossivel: Efeito Fallout', 'acao', 'espionagem', 'aventura'),
('007: Cassino Royale', 'acao', 'espionagem', 'crime'),
('Gladiador', 'acao', 'historico', 'drama'),
('Top Gun: Maverick', 'acao', 'drama', 'aviacao'),
('Resgate do Soldado Ryan', 'guerra', 'drama', 'historico'),
('Falcao Negro em Perigo', 'guerra', 'acao', 'historico'),
('1917', 'guerra', 'drama', 'historico'),
('Dunkirk', 'guerra', 'suspense', 'historico'),
('Coracao Valente', 'historico', 'acao', 'drama'),

('O Poderoso Chefao', 'crime', 'drama', 'mafia'),
('O Poderoso Chefao 2', 'crime', 'drama', 'mafia'),
('Os Bons Companheiros', 'crime', 'drama', 'mafia'),
('Scarface', 'crime', 'drama', 'mafia'),
('Os Infiltrados', 'crime', 'suspense', 'drama'),
('Pulp Fiction', 'crime', 'comedia', 'drama'),
('Seven', 'suspense', 'crime', 'misterio'),
('Zodiaco', 'suspense', 'crime', 'misterio'),
('Ilha do Medo', 'suspense', 'misterio', 'drama'),
('Garota Exemplar', 'suspense', 'crime', 'drama'),

('O Silencio dos Inocentes', 'suspense', 'crime', 'terror'),
('Prisioneiros', 'suspense', 'crime', 'drama'),
('Amnesia', 'suspense', 'misterio', 'mente'),
('O Sexto Sentido', 'suspense', 'terror', 'misterio'),
('Corra!', 'terror', 'suspense', 'misterio'),
('O Iluminado', 'terror', 'suspense', 'psicologico'),
('Invocacao do Mal', 'terror', 'sobrenatural', 'suspense'),
('Hereditario', 'terror', 'psicologico', 'drama'),
('O Exorcista', 'terror', 'sobrenatural', 'drama'),
('It: A Coisa', 'terror', 'sobrenatural', 'drama'),

('Titanic', 'romance', 'drama', 'historico'),
('Diario de uma Paixao', 'romance', 'drama', 'emocional'),
('La La Land', 'romance', 'musical', 'drama'),
('Antes do Amanhecer', 'romance', 'drama', 'dialogo'),
('Orgulho e Preconceito', 'romance', 'drama', 'historico'),
('Questao de Tempo', 'romance', 'comedia', 'viagem_no_tempo'),
('Simplesmente Amor', 'romance', 'comedia', 'drama'),
('500 Dias com Ela', 'romance', 'comedia', 'drama'),
('Nasce uma Estrela', 'romance', 'musical', 'drama'),
('Brilho Eterno de uma Mente sem Lembrancas', 'romance', 'ficcao', 'drama'),

('Forrest Gump', 'drama', 'romance', 'historico'),
('Um Sonho de Liberdade', 'drama', 'crime', 'amizade'),
('Clube da Luta', 'drama', 'suspense', 'psicologico'),
('O Pianista', 'drama', 'guerra', 'historico'),
('Whiplash', 'drama', 'musica', 'psicologico'),
('A Espera de um Milagre', 'drama', 'crime', 'sobrenatural'),
('Beleza Americana', 'drama', 'psicologico', 'familia'),
('Manchester a Beira-Mar', 'drama', 'familia', 'emocional'),
('Moonlight', 'drama', 'familia', 'identidade'),
('O Lobo de Wall Street', 'drama', 'comedia', 'crime'),

('Superbad', 'comedia', 'amizade', 'adolescente'),
('Se Beber Nao Case', 'comedia', 'amizade', 'aventura'),
('As Branquelas', 'comedia', 'crime', 'familia'),
('Todo Mundo em Panico', 'comedia', 'terror', 'parodia'),
('Escola de Rock', 'comedia', 'musica', 'familia'),
('O Virgem de 40 Anos', 'comedia', 'romance', 'amizade'),
('Pequena Miss Sunshine', 'comedia', 'drama', 'familia'),
('O Grande Lebowski', 'comedia', 'crime', 'misterio'),
('Feitico do Tempo', 'comedia', 'romance', 'fantasia'),
('Debi e Loide', 'comedia', 'aventura', 'amizade'),

('O Senhor dos Aneis: A Sociedade do Anel', 'fantasia', 'aventura', 'guerra'),
('O Senhor dos Aneis: As Duas Torres', 'fantasia', 'aventura', 'guerra'),
('O Senhor dos Aneis: O Retorno do Rei', 'fantasia', 'aventura', 'guerra'),
('Harry Potter e a Pedra Filosofal', 'fantasia', 'aventura', 'magia'),
('Harry Potter e o Prisioneiro de Azkaban', 'fantasia', 'aventura', 'magia'),
('Piratas do Caribe', 'aventura', 'fantasia', 'comedia'),
('Jurassic Park', 'aventura', 'ficcao', 'sobrevivencia'),
('Indiana Jones e os Cacadores da Arca Perdida', 'aventura', 'acao', 'historico'),
('King Kong', 'aventura', 'drama', 'fantasia'),
('As Aventuras de Pi', 'aventura', 'drama', 'sobrevivencia'),

('Toy Story', 'animacao', 'aventura', 'comedia'),
('Toy Story 3', 'animacao', 'drama', 'aventura'),
('Procurando Nemo', 'animacao', 'aventura', 'familia'),
('Os Incriveis', 'animacao', 'acao', 'familia'),
('Ratatouille', 'animacao', 'comedia', 'familia'),
('Up: Altas Aventuras', 'animacao', 'aventura', 'drama'),
('Wall-E', 'animacao', 'ficcao', 'romance'),
('Divertida Mente', 'animacao', 'familia', 'drama'),
('Homem-Aranha no Aranhaverso', 'animacao', 'acao', 'heroi'),
('O Rei Leao', 'animacao', 'drama', 'familia');

CREATE INDEX idx_movies_main_tag ON movies(main_tag);
CREATE INDEX idx_movies_subtag_1 ON movies(subtag_1);
CREATE INDEX idx_movies_subtag_2 ON movies(subtag_2);

ALTER TABLE movies ADD COLUMN poster_path VARCHAR(255) NULL;
UPDATE movies SET poster_path = 'images/movies/interestelar.jpg' WHERE title = 'Interestelar';
UPDATE movies SET poster_path = 'images/movies/a-origem.jpg' WHERE title = 'A Origem';
UPDATE movies SET poster_path = 'images/movies/matrix.jpg' WHERE title = 'Matrix';
UPDATE movies SET poster_path = 'images/movies/blade-runner-2049.jpg' WHERE title = 'Blade Runner 2049';
UPDATE movies SET poster_path = 'images/movies/duna.jpg' WHERE title = 'Duna';
UPDATE movies SET poster_path = 'images/movies/gravidade.jpg' WHERE title = 'Gravidade';
UPDATE movies SET poster_path = 'images/movies/alien.jpg' WHERE title = 'Alien';
UPDATE movies SET poster_path = 'images/movies/aliens.jpg' WHERE title = 'Aliens';
UPDATE movies SET poster_path = 'images/movies/o-exterminador-do-futuro-2.jpg' WHERE title = 'O Exterminador do Futuro 2';
UPDATE movies SET poster_path = 'images/movies/de-volta-para-o-futuro.jpg' WHERE title = 'De Volta para o Futuro';

UPDATE movies SET poster_path = 'images/movies/batman-o-cavaleiro-das-trevas.jpg' WHERE title = 'Batman: O Cavaleiro das Trevas';
UPDATE movies SET poster_path = 'images/movies/batman-begins.jpg' WHERE title = 'Batman Begins';
UPDATE movies SET poster_path = 'images/movies/vingadores.jpg' WHERE title = 'Vingadores';
UPDATE movies SET poster_path = 'images/movies/vingadores-ultimato.jpg' WHERE title = 'Vingadores: Ultimato';
UPDATE movies SET poster_path = 'images/movies/homem-de-ferro.jpg' WHERE title = 'Homem de Ferro';
UPDATE movies SET poster_path = 'images/movies/capitao-america-o-soldado-invernal.jpg' WHERE title = 'Capitao America: O Soldado Invernal';
UPDATE movies SET poster_path = 'images/movies/homem-aranha-2.jpg' WHERE title = 'Homem-Aranha 2';
UPDATE movies SET poster_path = 'images/movies/logan.jpg' WHERE title = 'Logan';
UPDATE movies SET poster_path = 'images/movies/mad-max-estrada-da-furia.jpg' WHERE title = 'Mad Max: Estrada da Furia';
UPDATE movies SET poster_path = 'images/movies/john-wick.jpg' WHERE title = 'John Wick';

UPDATE movies SET poster_path = 'images/movies/john-wick-2.jpg' WHERE title = 'John Wick 2';
UPDATE movies SET poster_path = 'images/movies/missao-impossivel-efeito-fallout.jpg' WHERE title = 'Missao Impossivel: Efeito Fallout';
UPDATE movies SET poster_path = 'images/movies/007-cassino-royale.jpg' WHERE title = '007: Cassino Royale';
UPDATE movies SET poster_path = 'images/movies/gladiador.jpg' WHERE title = 'Gladiador';
UPDATE movies SET poster_path = 'images/movies/top-gun-maverick.jpg' WHERE title = 'Top Gun: Maverick';
UPDATE movies SET poster_path = 'images/movies/resgate-do-soldado-ryan.jpg' WHERE title = 'Resgate do Soldado Ryan';
UPDATE movies SET poster_path = 'images/movies/falcao-negro-em-perigo.jpg' WHERE title = 'Falcao Negro em Perigo';
UPDATE movies SET poster_path = 'images/movies/1917.jpg' WHERE title = '1917';
UPDATE movies SET poster_path = 'images/movies/dunkirk.jpg' WHERE title = 'Dunkirk';
UPDATE movies SET poster_path = 'images/movies/coracao-valente.jpg' WHERE title = 'Coracao Valente';

UPDATE movies SET poster_path = 'images/movies/o-poderoso-chefao.jpg' WHERE title = 'O Poderoso Chefao';
UPDATE movies SET poster_path = 'images/movies/o-poderoso-chefao-2.jpg' WHERE title = 'O Poderoso Chefao 2';
UPDATE movies SET poster_path = 'images/movies/os-bons-companheiros.jpg' WHERE title = 'Os Bons Companheiros';
UPDATE movies SET poster_path = 'images/movies/scarface.jpg' WHERE title = 'Scarface';
UPDATE movies SET poster_path = 'images/movies/os-infiltrados.jpg' WHERE title = 'Os Infiltrados';
UPDATE movies SET poster_path = 'images/movies/pulp-fiction.jpg' WHERE title = 'Pulp Fiction';
UPDATE movies SET poster_path = 'images/movies/seven.jpg' WHERE title = 'Seven';
UPDATE movies SET poster_path = 'images/movies/zodiaco.jpg' WHERE title = 'Zodiaco';
UPDATE movies SET poster_path = 'images/movies/ilha-do-medo.jpg' WHERE title = 'Ilha do Medo';
UPDATE movies SET poster_path = 'images/movies/garota-exemplar.jpg' WHERE title = 'Garota Exemplar';

UPDATE movies SET poster_path = 'images/movies/o-silencio-dos-inocentes.jpg' WHERE title = 'O Silencio dos Inocentes';
UPDATE movies SET poster_path = 'images/movies/prisioneiros.jpg' WHERE title = 'Prisioneiros';
UPDATE movies SET poster_path = 'images/movies/amnesia.jpg' WHERE title = 'Amnesia';
UPDATE movies SET poster_path = 'images/movies/o-sexto-sentido.jpg' WHERE title = 'O Sexto Sentido';
UPDATE movies SET poster_path = 'images/movies/corra.jpg' WHERE title = 'Corra!';
UPDATE movies SET poster_path = 'images/movies/o-iluminado.jpg' WHERE title = 'O Iluminado';
UPDATE movies SET poster_path = 'images/movies/invocacao-do-mal.jpg' WHERE title = 'Invocacao do Mal';
UPDATE movies SET poster_path = 'images/movies/hereditario.jpg' WHERE title = 'Hereditario';
UPDATE movies SET poster_path = 'images/movies/o-exorcista.jpg' WHERE title = 'O Exorcista';
UPDATE movies SET poster_path = 'images/movies/it-a-coisa.jpg' WHERE title = 'It: A Coisa';

UPDATE movies SET poster_path = 'images/movies/titanic.jpg' WHERE title = 'Titanic';
UPDATE movies SET poster_path = 'images/movies/diario-de-uma-paixao.jpg' WHERE title = 'Diario de uma Paixao';
UPDATE movies SET poster_path = 'images/movies/la-la-land.jpg' WHERE title = 'La La Land';
UPDATE movies SET poster_path = 'images/movies/antes-do-amanhecer.jpg' WHERE title = 'Antes do Amanhecer';
UPDATE movies SET poster_path = 'images/movies/orgulho-e-preconceito.jpg' WHERE title = 'Orgulho e Preconceito';
UPDATE movies SET poster_path = 'images/movies/questao-de-tempo.jpg' WHERE title = 'Questao de Tempo';
UPDATE movies SET poster_path = 'images/movies/simplesmente-amor.jpg' WHERE title = 'Simplesmente Amor';
UPDATE movies SET poster_path = 'images/movies/500-dias-com-ela.jpg' WHERE title = '500 Dias com Ela';
UPDATE movies SET poster_path = 'images/movies/nasce-uma-estrela.jpg' WHERE title = 'Nasce uma Estrela';
UPDATE movies SET poster_path = 'images/movies/brilho-eterno-de-uma-mente-sem-lembrancas.jpg' WHERE title = 'Brilho Eterno de uma Mente sem Lembrancas';

UPDATE movies SET poster_path = 'images/movies/forrest-gump.jpg' WHERE title = 'Forrest Gump';
UPDATE movies SET poster_path = 'images/movies/um-sonho-de-liberdade.jpg' WHERE title = 'Um Sonho de Liberdade';
UPDATE movies SET poster_path = 'images/movies/clube-da-luta.jpg' WHERE title = 'Clube da Luta';
UPDATE movies SET poster_path = 'images/movies/o-pianista.jpg' WHERE title = 'O Pianista';
UPDATE movies SET poster_path = 'images/movies/whiplash.jpg' WHERE title = 'Whiplash';
UPDATE movies SET poster_path = 'images/movies/a-espera-de-um-milagre.jpg' WHERE title = 'A Espera de um Milagre';
UPDATE movies SET poster_path = 'images/movies/beleza-americana.jpg' WHERE title = 'Beleza Americana';
UPDATE movies SET poster_path = 'images/movies/manchester-a-beira-mar.jpg' WHERE title = 'Manchester a Beira-Mar';
UPDATE movies SET poster_path = 'images/movies/moonlight.jpg' WHERE title = 'Moonlight';
UPDATE movies SET poster_path = 'images/movies/o-lobo-de-wall-street.jpg' WHERE title = 'O Lobo de Wall Street';

UPDATE movies SET poster_path = 'images/movies/superbad.jpg' WHERE title = 'Superbad';
UPDATE movies SET poster_path = 'images/movies/se-beber-nao-case.jpg' WHERE title = 'Se Beber Nao Case';
UPDATE movies SET poster_path = 'images/movies/as-branquelas.jpg' WHERE title = 'As Branquelas';
UPDATE movies SET poster_path = 'images/movies/todo-mundo-em-panico.jpg' WHERE title = 'Todo Mundo em Panico';
UPDATE movies SET poster_path = 'images/movies/escola-de-rock.jpg' WHERE title = 'Escola de Rock';
UPDATE movies SET poster_path = 'images/movies/o-virgem-de-40-anos.jpg' WHERE title = 'O Virgem de 40 Anos';
UPDATE movies SET poster_path = 'images/movies/pequena-miss-sunshine.jpg' WHERE title = 'Pequena Miss Sunshine';
UPDATE movies SET poster_path = 'images/movies/o-grande-lebowski.jpg' WHERE title = 'O Grande Lebowski';
UPDATE movies SET poster_path = 'images/movies/feitico-do-tempo.jpg' WHERE title = 'Feitico do Tempo';
UPDATE movies SET poster_path = 'images/movies/debi-e-loide.jpg' WHERE title = 'Debi e Loide';

UPDATE movies SET poster_path = 'images/movies/o-senhor-dos-aneis-a-sociedade-do-anel.jpg' WHERE title = 'O Senhor dos Aneis: A Sociedade do Anel';
UPDATE movies SET poster_path = 'images/movies/o-senhor-dos-aneis-as-duas-torres.jpg' WHERE title = 'O Senhor dos Aneis: As Duas Torres';
UPDATE movies SET poster_path = 'images/movies/o-senhor-dos-aneis-o-retorno-do-rei.jpg' WHERE title = 'O Senhor dos Aneis: O Retorno do Rei';
UPDATE movies SET poster_path = 'images/movies/harry-potter-e-a-pedra-filosofal.jpg' WHERE title = 'Harry Potter e a Pedra Filosofal';
UPDATE movies SET poster_path = 'images/movies/harry-potter-e-o-prisioneiro-de-azkaban.jpg' WHERE title = 'Harry Potter e o Prisioneiro de Azkaban';
UPDATE movies SET poster_path = 'images/movies/piratas-do-caribe.jpg' WHERE title = 'Piratas do Caribe';
UPDATE movies SET poster_path = 'images/movies/jurassic-park.jpg' WHERE title = 'Jurassic Park';
UPDATE movies SET poster_path = 'images/movies/indiana-jones-e-os-cacadores-da-arca-perdida.jpg' WHERE title = 'Indiana Jones e os Cacadores da Arca Perdida';
UPDATE movies SET poster_path = 'images/movies/king-kong.jpg' WHERE title = 'King Kong';
UPDATE movies SET poster_path = 'images/movies/as-aventuras-de-pi.jpg' WHERE title = 'As Aventuras de Pi';

UPDATE movies SET poster_path = 'images/movies/toy-story.jpg' WHERE title = 'Toy Story';
UPDATE movies SET poster_path = 'images/movies/toy-story-3.jpg' WHERE title = 'Toy Story 3';
UPDATE movies SET poster_path = 'images/movies/procurando-nemo.jpg' WHERE title = 'Procurando Nemo';
UPDATE movies SET poster_path = 'images/movies/os-incriveis.jpg' WHERE title = 'Os Incriveis';
UPDATE movies SET poster_path = 'images/movies/ratatouille.jpg' WHERE title = 'Ratatouille';
UPDATE movies SET poster_path = 'images/movies/up-altas-aventuras.jpg' WHERE title = 'Up: Altas Aventuras';
UPDATE movies SET poster_path = 'images/movies/wall-e.jpg' WHERE title = 'Wall-E';
UPDATE movies SET poster_path = 'images/movies/divertida-mente.jpg' WHERE title = 'Divertida Mente';
UPDATE movies SET poster_path = 'images/movies/homem-aranha-no-aranhaverso.jpg' WHERE title = 'Homem-Aranha no Aranhaverso';
UPDATE movies SET poster_path = 'images/movies/o-rei-leao.jpg' WHERE title = 'O Rei Leao';
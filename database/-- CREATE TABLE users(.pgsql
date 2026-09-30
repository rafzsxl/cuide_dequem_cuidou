-- CREATE TABLE users(
--     id SERIAL PRIMARY KEY,
--     email VARCHAR(255),
--     password VARCHAR(255),
--     nome VARCHAR(255),
--     nascimento DATE,
--     ADMIN BOOLEAN
-- );

-- CREATE TABLE voluntarios(
--     id SERIAL PRIMARY KEY,
--     cpf VARCHAR(14),
--     telefone VARCHAR(20),
--     data_volun timestamp,
--     user_id INT,
--     CONSTRAINT fk_users FOREIGN KEY (user_id)
--     REFERENCES users(id)
-- );

-- CREATE TABLE campanhas(
--     id SERIAL PRIMARY KEY, 
--     titulo VARCHAR(255),
--     descricao TEXT,
--     url_imagem VARCHAR(255),
--     data_criacao timestamp,
--     user_id INT,
--     CONSTRAINT fk_users FOREIGN KEY (user_id)
--     REFERENCES users(id)
-- );


-- CREATE TABLE doacoes(
--     id SERIAL PRIMARY KEY,
--     valor DECIMAL,
--     data timestamp,
--     id_volun INT,
--     CONSTRAINT fk_voluntarios FOREIGN KEY (id_volun)
--     REFERENCES voluntarios(id)    
-- );

-- INSERT INTO users VALUES (0, 'adm@gmail.com', 'adm123', 'Administrador', '05/01/2010', TRUE);

-- -- SELECT * FROM users;
-- -- SELECT * FROM voluntarios;
-- -- SELECT * FROM campanhas;
-- -- SELECT * FROM doacoes;

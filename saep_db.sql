CREATE DATABASE saep_db;

USE saep_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,        
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);


CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cnpj VARCHAR(255) NOT NULL,           
    responsavel VARCHAR(100),
    telefone VARCHAR(20),
    email VARCHAR(100),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);


CREATE TABLE salas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    capacidade INT NOT NULL,
    localizacao VARCHAR(100),
    empresa_id INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_salas_empresa
        FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);


CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME NOT NULL,
    responsavel VARCHAR(100),
    descricao VARCHAR(255),
    sala_id INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_agendamentos_sala
        FOREIGN KEY (sala_id) REFERENCES salas(id)
);


CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_last_activity_index (last_activity)
);


USE saep_db;

-- Senha de todos os usuários de teste: 123456
INSERT INTO usuarios
(nome, email, senha, created_at, updated_at)
VALUES
('Administrador',    'admin@saep.com',    SHA2('123456', 256), NOW(), NOW()),
('Carlos Oliveira',  'carlos@saep.com',   SHA2('123456', 256), NOW(), NOW()),
('Mariana Santos',   'mariana@saep.com',  SHA2('123456', 256), NOW(), NOW()),
('Fernanda Lima',    'fernanda@saep.com', SHA2('123456', 256), NOW(), NOW());


INSERT INTO empresas
(nome, cnpj, responsavel, telefone, email, created_at, updated_at)
VALUES
('Alfa Tecnologia LTDA',  '12345678000190', 'João da Silva',   '(16) 99999-1111', 'contato@alfatec.com.br',  NOW(), NOW()),
('Beta Consultoria ME',   '98765432000155', 'Maria Oliveira',  '(16) 98888-2222', 'contato@betacon.com.br',  NOW(), NOW()),
('Gama Treinamentos S/A', '11222333000181', 'Carlos Santos',   '(16) 97777-3333', 'contato@gamatrein.com.br',NOW(), NOW()),
('Delta Coworking EIRELI','55666777000144', 'Ana Souza',       '(16) 96666-4444', 'contato@deltacow.com.br', NOW(), NOW());

INSERT INTO salas
(nome, capacidade, localizacao, empresa_id, created_at, updated_at)
VALUES
('Sala Executiva A',   10, 'Bloco A - 1º andar', 1, NOW(), NOW()),
('Sala de Reunião B',   8, 'Bloco A - 2º andar', 1, NOW(), NOW()),
('Auditório Central',  60, 'Bloco B - Térreo',   2, NOW(), NOW()),
('Sala de Treinamento',25, 'Bloco B - 1º andar', 3, NOW(), NOW()),
('Espaço Criativo',    15, 'Bloco C - 3º andar', 4, NOW(), NOW());

INSERT INTO agendamentos
(data, hora_inicio, hora_fim, responsavel, descricao, sala_id, created_at, updated_at)
VALUES
('2026-10-05', '08:00:00', '10:00:00', 'João da Silva',  'Reunião de alinhamento do projeto',  1, NOW(), NOW()),
('2026-10-05', '14:00:00', '16:00:00', 'Maria Oliveira', 'Apresentação de resultados',         3, NOW(), NOW()),
('2026-10-06', '09:00:00', '12:00:00', 'Carlos Santos',  'Treinamento de novos colaboradores', 4, NOW(), NOW()),
('2026-10-07', '10:30:00', '11:30:00', 'Ana Souza',      'Entrevistas de seleção',             5, NOW(), NOW()),
('2026-10-08', '13:00:00', '17:00:00', 'João da Silva',  'Workshop de inovação',               2, NOW(), NOW()),
('2026-10-09', '08:30:00', '09:30:00', 'Mariana Santos', 'Reunião mensal de diretoria',        1, NOW(), NOW());


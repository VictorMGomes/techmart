CREATE TABLE IF NOT EXISTS usuarios 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS produtos 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL
);

INSERT INTO usuarios 
  (nome, email, senha)
VALUES
    ('Luiz', 'luiz@techmart.com', '5f36e59804895e9e784714154c9b5d86'),
    ('Rodrigo', 'rodrigo@techmart.com', '68ff4a8e8e599b637b9a83e1ad2db3b6');

INSERT INTO produtos 
  (nome, descricao, preco)
VALUES
    ('Poco x5 PRO 5G', 'Smartphone custo benefício', 1599.99),
    ('iPhone 15 PRO', 'Smartphone top de linha', 8500.00);

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
    ('Luiz', 'luiz@techmart.com', 'e10adc3949ba59abbe56e057f20f883e'),
    ('Rodrigo', 'rodrigo@techmart.com', 'e10adc3949ba59abbe56e057f20f883e');

INSERT INTO produtos 
  (nome, descricao, preco)
VALUES
    ('Poco x5 PRO 5G', 'Smartphone custo benefício', 1599.99),
    ('iPhone 15 PRO', 'Smartphone top de linha', 8500.00);

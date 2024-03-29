# TechMart API Rest

Repositório do teste de seleção Desenvolvedor(a) Back End SonarTrade

## Introdução

API de CRUD de produtos de uma empresa de comércio eletrônico

## Recursos

API, Autenticação, Cache

## Requisitos

Docker

## Configuração

[Instruções para executar este projeto]

### Passo 1: Clonar o Repositório
git clone https://github.com/VictorMGomes/techmart.git

cd techmart

### Passo 2: Configurar as váriaveis para configuração do ambiente LAMP dockerizado
cp .env.example .env

### Passo 3: Configurar as váriaveis de ambiente da API
cp app/config/env/config.ini.example app/config/env/config.ini

### Passo 4: Levantar o ambiente dockerizado
docker-compose up -d

## Uso
[Endpoints da API e exemplos de solicitação]

### Gerar um token
curl -X POST http://localhost/api/gerar-token -H "Content-Type: application/json" -d '{"email": "luiz@techmart.com", "senha": "123456"}'

### Criar um produto (Substitua o token)
curl -X POST http://localhost/api/produtos -H "Content-Type: application/json" -H "Authorization: Bearer SEU_TOKEN_AQUI" -d '{"nome": "Nome do Produto", "descricao": "Descrição do Produto", "preco": 19.99}'

### Listar todos os produtos (Substitua o token)
curl -X GET http://localhost/api/produtos -H "Authorization: Bearer SEU_TOKEN_AQUI"

### Obter um produto específico (Substitua o ID e token)
curl -X GET http://localhost/api/produtos/ID -H "Authorization: Bearer SEU_TOKEN_AQUI"

### Atualizar um produto (Substitua o ID, token e os valores do payload)
curl -X PUT http://localhost/api/produtos/ID -H "Content-Type: application/json" -H "Authorization: Bearer SEU_TOKEN_AQUI" -d '{"nome": "Novo Nome", "descricao": "Nova Descrição", "preco": 29.99}'

### Excluir um produto (Substitua o ID e token)
curl -X DELETE http://localhost/api/produtos/ID -H "Authorization: Bearer SEU_TOKEN_AQUI"

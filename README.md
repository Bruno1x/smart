# Projeto Web de Vendas

Sistema de gerenciamento de vendas com frontend em Vue.js (Vite) e backend em Laravel.

## Funcionalidades

- Cadastro de Produtos
  - ID
  - Descrição
  - Marca
  - Valor
  - Alteração e exclusão de produtos diretamente da tabela

- Cadastro de Marcas
  - Cadastrar e listar marcas
  - Edição e exclusão de marcas

- Tela de Vendas
  - Seleção de cliente e produtos
  - Adição de itens à venda com quantidade
  - Cálculo automático do subtotal e total
  - Registro da venda no banco de dados
  - Listagem de todas as vendas com: ID, Cliente, Data, Total e Detalhes dos Itens

---

## Estrutura de Pastas
backend/
├── app/
├── database/
├── ...
frontend/ # Projeto Vue.js com Vite
├── src/
│ ├── components/
│ ├── services/
│ ├── views/
├── vite.config.js
├── routes/
├── public/


## Como rodar o projeto

### Backend (Laravel)

1. Acesse a pasta do backend:

```bash
cd backend
Instale as dependências:

bash
Copiar
Editar
composer install
Crie o arquivo .env com base no exemplo:

bash
Copiar
Editar
cp .env.example .env
Configure o banco de dados no arquivo .env.

Gere a chave da aplicação:

bash
Copiar
Editar
php artisan key:generate
Rode as migrations e os seeders:

bash
Copiar
Editar
php artisan migrate --seed
Inicie o servidor backend:

bash
Copiar
Editar
php artisan serve
Backend rodando em: http://127.0.0.1:8000

Frontend (Vue + Vite)
Acesse a pasta do frontend:

bash
Copiar
Editar
cd frontend
Instale as dependências:

bash
Copiar
Editar
npm install
Inicie o frontend:

bash
Copiar
Editar

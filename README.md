# To-Do List Application

Este projeto é composto por dois módulos: um backend desenvolvido em Laravel e um frontend desenvolvido em VueJS. Juntos, eles formam uma aplicação completa de gerenciamento de tarefas.

---

## Backend (Laravel)

### Descrição

A API foi desenvolvida utilizando o framework Laravel, implementando autenticação com JWT e um banco de dados SQL Server para gerenciar usuários e tarefas.

---

### Requisitos

- PHP >= 8.1
- Composer
- Banco de Dados SQL Server
- Laravel Framework

---

### Configuração do Ambiente

1. **Instale as Dependências**:

   ```
   composer install *Se necessário rodar composer update*
   ```

2. **Configure o Arquivo `.env`**:

   ```
   cp .env.example .env
   ```

3. **Edite o Arquivo `.env`**:

   ```
   nano .env
   ```

   Configure as variáveis:

   ```
   DB_CONNECTION=sqlsrv
   DB_HOST=127.0.0.1
   DB_PORT=1433
   DB_DATABASE=todo_db
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha

   JWT_SECRET=chave_secreta
   ```

4. **Gere a Chave JWT**:

   ```
   php artisan jwt:secret
   ```

5. **Execute as Migrations**:

   ```
   php artisan migrate
   ```

6. **Inicie o Servidor de Desenvolvimento**:
   ```
   php artisan serve
   ```

---
## Testes

### Backend

1. **Execute os Testes**:

   ```
   php artisan test
   ```

2. **Cobertura dos Testes**:
   - Registro de usuários.
   - Login com credenciais válidas e inválidas.
   - Criação, edição e exclusão de tarefas.

---

## Documentação da API

### Autenticação

#### Registro

- **URL**: `/api/register`
- **Método**: `POST`
- **Body**:
  ```json
  {
    "name": "User Name",
    "email": "user@example.com",
    "password": "password",
    "password_confirmation": "password"
  }
  ```

#### Login

- **URL**: `/api/login`
- **Método**: `POST`
- **Body**:
  ```json
  {
    "email": "user@example.com",
    "password": "password"
  }
  ```

#### Logout

- **URL**: `/api/logout`
- **Método**: `POST`
- **Headers**:
  ```json
  {
    "Authorization": "Bearer <token>"
  }
  ```

### Tarefas

#### Listar Tarefas

- **URL**: `/api/tasks`
- **Método**: `GET`
- **Headers**:
  ```json
  {
    "Authorization": "Bearer <token>"
  }
  ```

#### Criar Tarefa

- **URL**: `/api/tasks`
- **Método**: `POST`
- **Body**:
  ```json
  {
    "title": "Task Title",
    "description": "Task Description"
  }
  ```

#### Atualizar Tarefa

- **URL**: `/api/tasks/{id}`
- **Método**: `PUT`
- **Body**:
  ```json
  {
    "title": "Updated Title",
    "description": "Updated Description",
    "completed": true
  }
  ```

#### Excluir Tarefa

- **URL**: `/api/tasks/{id}`
- **Método**: `DELETE`
- **Headers**:
  ```json
  {
    "Authorization": "Bearer <token>"
  }
  ```

---

## Observações

1. Certifique-se de que o backend esteja rodando em `http://localhost:8000` antes de iniciar o frontend.
2. Utilize o comando `yarn run serve` no frontend para iniciar o servidor local.

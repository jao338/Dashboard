## Processos de instalação

1. **Copiar o arquivo `.env.example`**

    - Execute:
      ```bash
      cp .env.example .env
      ```
    - Ou copie e renomeie manualmente.
    - Certifique-se de que o arquivo `.env` esteja na raiz do projeto.

   **Nota:**
   Caso o projeto não consiga se conectar ao banco de dados, altere no `.env`:
    ```env
    SESSION_DRIVER=database
    ```
   para:
    ```env
    SESSION_DRIVER=file
    ```

---

2. **Subir os containers com Docker**

    ```bash
    docker-compose up -d
    ```

   Saída esperada:
    ```
    Creating application ... done
    Creating mssql       ... done
    Creating nginx       ... done
    ```

   > Neste projeto, o banco de dados SQL Server é criado automaticamente por um script chamado durante o processo de inicialização do container `mssql`.  
   > Nenhum comando manual via sqlcmd é necessário.

---

3. **Verificar se os containers estão ativos**

    ```bash
    docker ps
    ```

   Saída aproximada:
    ```
    mcr.microsoft.com/mssql/server:2022-latest   ...   Up ...   0.0.0.0:1433->1433/tcp     mssql
    application                                  ...   Up ...   0.0.0.0:9090->9000/tcp     application
    nginx:alpine                                 ...   Up ...   0.0.0.0:80->80/tcp         nginx
    ```

   Se algum container não estiver ativo, revise o arquivo `docker-compose.yml`.

---

4. **Acessar o container da aplicação (PHP)**

    ```bash
    docker-compose exec application bash
    ```

---

5. **Instalar dependências**

   Dentro do container:

    ```bash
    composer install
    ```

---

6. **Gerar a chave da aplicação**

    ```bash
    php artisan key:generate
    ```

   Verifique no `.env` se `APP_KEY` foi preenchida.

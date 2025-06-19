
## Processos de instalação

1. **Copiar o arquivo `.env.example`**

    - Execute o comando:
      ```bash
      cp .env.example .env
      ```
    - Ou copie e cole manualmente, depois renomeie o arquivo para `.env`.
    - Certifique-se de que o arquivo `.env` esteja localizado na raiz do projeto.

   **Nota:**
    - Se o projeto não se conectar a um banco de dados, altere a seguinte linha no arquivo `.env`:
      ```env
      SESSION_DRIVER=database
      ```
      para:
      ```env
      SESSION_DRIVER=file
      ```

2. **Subir os containers com Docker**

    - Use o comando:
      ```bash
      docker-compose up -d
      ```
    - A saída esperada deve ser:
      ```
      Creating application ... done
      Creating nginx       ... done
      ```

3. **Verificar se os containers estão ativos**

    - Execute o comando:
      ```bash
      docker ps
      ```
    - O retorno deve ser algo semelhante a:
      ```
      b8ada4398ad0   mcr.microsoft.com/mssql/server:2022-latest   "/opt/mssql/bin/laun…"   28 minutes ago   Up 28 minutes   0.0.0.0:1433->1433/tcp, :::1433->1433/tcp     mssql
      f4314d6923ee   application                                  "docker-php-entrypoi…"   28 minutes ago   Up 28 minutes   0.0.0.0:9090->9000/tcp, [::]:9090->9000/tcp   application
      fb468a52c3b9   nginx:alpine                                 "/docker-entrypoint.…"   28 minutes ago   Up 28 minutes   0.0.0.0:80->80/tcp, :::80->80/tcp             nginx
      ```
    - Caso algum container esteja faltando, revise o arquivo `docker-compose.yml` para identificar possíveis problemas.

4. **Acessar o container do PHP**

    - Use o comando:
      ```bash
      docker-compose exec application bash
      ```

5. **Instalar as dependências do projeto**

    - Dentro do container, execute:
      ```bash
      composer install
      ```

6. **Criar a chave da aplicação (APP_KEY)**

    - Ainda dentro do container, gere a chave da aplicação com o comando:
      ```bash
      php artisan key:generate
      ```
    - Verifique no arquivo `.env` se a variável `APP_KEY` foi preenchida corretamente.


7. **Criar base de dados**

    -  Acessa um container temporário com as ferramentas de linha de comando do SQL Server: 
   ```bash
    docker run -it --rm --network dashboard_laravel_app mcr.microsoft.com/mssql-tools /bin/bash
   ```
   - Dentro do container, inicia o cliente SQLCMD para conexão com o SQL Server.
   ```bash
    /opt/mssql-tools/bin/sqlcmd -S mssql -U sa -P "senha_da_base_dados"
   ```
   - "-S mssql": O nome do serviço/container do banco (como definido no docker-compose.yml).
   - "-U sa": Usuário administrador do SQL Server.
   - "-P ...": A senha do usuário sa (definida na variável SA_PASSWORD no docker-compose e que deve ser a mesma do .env).
   - Dentro do container, vamos criar uma base de dados:
   ```
    CREATE DATABASE dashboard;
    GO
   ```
   - Para ter certeza que o comando anterior funcionou, vamos listar as bases de dados dentro do nosso container, para isso rode o comando:
   ```
    SELECT name FROM sys.databases;
    GO
   ```
   - Por fim, rode:
   ```
    EXIT
   ```
   - Todos os comandos SQL anteriores devem ser escritos e depois usa-se o "GO" para executá-los.
   - Fora do container, vamos executar o container do php e rodar as migrations:
   ```
    docker exec -it application php artisan migrate
   ```
   - O resultado deve ser algo como: 
   ```
    INFO  Preparing database.
    Creating migration table ........................................................................................................... 23.74ms DONE
    
    INFO  Running migrations.
    
    0001_01_01_000000_create_users_table ............................................................................................... 30.94ms DONE
    0001_01_01_000001_create_cache_table ............................................................................................... 19.14ms DONE
    0001_01_01_000002_create_jobs_table ................................................................................................ 23.34ms DONE
    2024_12_28_152313_create_personal_access_tokens_table .............................................................................. 15.79ms DONE
    2025_06_17_create_categories_table .................................................................................................. 9.21ms DONE
    2025_06_17_create_genres_table ..................................................................................................... 10.00ms DONE
    2025_06_17_create_tags_table ........................................................................................................ 9.68ms DONE
   ```


8. **Acessar a aplicação**

    - Abra o navegador e acesse:
      ```
      http://localhost
      ```
    - A página de boas-vindas do Laravel deve ser exibida.


9. **Possíveis problemas com permissões**

    - Caso enfrente problemas relacionados a permissões de criação, alteração ou visualização de arquivos, execute:
       ```bash
       sudo chown $USER:$USER ./
       ```

    - Caso encontre problemas com as permissões das pastas de storage, execute:
      ```bash
      docker-compose exec application bash
      ```
    - Dentro do container, rode os seguintes comandos:
      ```bash
      chmod -R 775 storage bootstrap/cache
      chown -R www-data:www-data storage bootstrap/cache
      ```




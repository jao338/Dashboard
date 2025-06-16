
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
      bf205d57c37c   nginx:alpine   "/docker-entrypoint.…"   2 days ago   Up 21 minutes   0.0.0.0:80->80/tcp, :::80->80/tcp           nginx
      842fa3b6d4ac   application    "docker-php-entrypoi…"   2 days ago   Up 21 minutes   0.0.0.0:9000->9000/tcp, :::9000->9000/tcp   application
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

7. **Acessar a aplicação**

    - Abra o navegador e acesse:
      ```
      http://localhost
      ```
    - A página de boas-vindas do Laravel deve ser exibida.

    8. **Problemas com permissões**

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


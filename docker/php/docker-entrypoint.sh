#!/bin/sh

# Espera o SQL Server ficar pronto
echo "Aguardando o SQL Server iniciar..."
sleep 15

# Tenta criar o banco se não existir
#echo "Verificando/criando banco..."
#/opt/mssql-tools/bin/sqlcmd -S mssql -U sa -P "Junin@Padaria123" -Q "IF NOT EXISTS (SELECT name FROM sys.databases WHERE name = N'dashboard') CREATE DATABASE dashboard"

# Rodar as migrations
echo "Executando migrations..."
php artisan migrate --force

# Executa o comando original do container (ex: php-fpm)
exec "$@"

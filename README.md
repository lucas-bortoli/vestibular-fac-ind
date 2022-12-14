![Screenshot da página de participante](https://i.imgur.com/w7GkjNH.png)

# Setup aplicação
## Instalar Docker
Faça a instalação do Docker seguindo as instruções oficiais.

## Criar a imagem da aplicação
```sh
docker build -t vestibular .
```
## Credenciais
O sistema exige algumas Credenciais configuradas para funcionar corretamente, com destaque ao sistema de e-mails. De modo geral, as variáveis exemplificadas no código SQL a seguir devem estar presentes no banco de dados da aplicação.

## Executar aplicação
```sh
docker run -d --name vestibular -p 80:80 vestibular
```

Esse comando executa a aplicação. O parâmetro `-p 80:80` mapeia a porta do container para a porta do host, assim deixando acessível seu servidor externalmente.

# Persistência de dados
A aplicação faz o controle da persistência do banco de dados através do volume `/data`, acessível pelo container. Seu banco de dados é armazenado em `/data/database.sqlite`.

# Dicas
- Puxar um arquivo do container:
    ```sh
    docker cp vestibular:/data/database.sqlite .
    ```
- Dados preenchidos no arquivo `default_db.sql` do repositório
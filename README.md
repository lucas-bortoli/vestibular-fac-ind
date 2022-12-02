# Setup aplicação
- Instalar Docker;
- Criar a imagem da aplicação:
    ```sh
    docker build -t vestibular .
    ```
- Executar aplicação:
    ```sh
    docker run -d -p 80:80 vestibular
    ```
    Esse comando executa a aplicação. O parâmetro `-p 80:80` mapeia a porta do container para a porta do host, assim deixando acessível seu servidor externalmente.

# Persistência de dados
A aplicação faz o controle da persistência do banco de dados através do volume `/data`, acessível pelo container. Seu banco de dados é armazenado em `/data/database.sqlite`.
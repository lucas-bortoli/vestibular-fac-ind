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

# Dicas
- Puxar um arquivo do container:
    ```sh
    docker cp vestibular:/data/database.sqlite .
    ```
- Dados preenchidos:
    ```sql
    INSERT INTO campus (nome) VALUES 
        ('Curitiba - Campus da Indústria'),
        ('Curitiba - CIC'),
        ('Londrina'),
        ('São José dos Pinhais');
        
    INSERT INTO curso (campusId, nome, duracao) VALUES
        (1, 'Design de Moda', 2),
        (1, 'Engenharia Automotiva', 5),
        (1, 'Engenharia de Energias', 5),
        
        (2, 'Automação Industrial', 3),
        (2, 'Engenharia de Produção', 5),
        (2, 'Engenharia de Software', 4),
        (2, 'Engenharia Mecânica', 5),
        (2, 'Engenharia Mecatrônica', 5),
        (2, 'Fabricação Mecânica', 3),
        
        (3, 'Automação Industrial', 3),
        (3, 'Engenharia de Software', 4),
        (3, 'Engenharia Elétrica', 5),
        (3, 'Engenharia Mecânica', 5),
        
        (4, 'Administração', 4),
        (4, 'Ciências Contábeis', 4),
        (4, 'Direito', 5),
        (4, 'Engenharia de Produção', 5),
        (4, 'Engenharia de Software', 4),
        (4, 'Logística', 2),
        (4, 'Pedagogia', 4),
        (4, 'Sistemas de Informação', 4);
    ```
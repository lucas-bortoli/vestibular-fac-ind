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

-- Exemplo de tabela configuração, mudar os placeholders
INSERT INTO config 
    (smtp_host, smtp_port, smtp_encryption_type, smtp_username, smtp_password, smtp_from_address, processo_seletivo_inicio_timestamp, processo_seletivo_fim_timestamp, processo_seletivo_descricao) VALUES
    ('smtp-mail.outlook.com',
    587,
    'STARTTLS',
    'xyz.abc234567890@sesisenaipr.org.br',
    '1234567890password',
    'xyz.abc234567890@sesisenaipr.org.br',
    1671224400,
    1671231600,
    'Seja bem-vindo ao processo seletivo!');
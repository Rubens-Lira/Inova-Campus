# Inova-Campus

O **Inova-Campus** é um projeto desenvolvido para incentivar o empreendedorismo no **IFPE Campus Igarassu**. Através de um sistema online, os usuários poderão cadastrar seus produtos ou serviços com o intuito de divulgar e atrair clientes, promovendo um ambiente de comércio digital local.

## Tecnologias

- **JavaScript**
- **TypeScript**
- **PHP**
- **React**
- **MySQL**

## Descrição

O sistema online oferece diversas funcionalidades, tanto para **vendedores** quanto para **clientes**, a fim de melhorar a experiência de compra e venda dentro da plataforma.

### Funcionalidades

- **Cadastro de Usuários**  
  Permite que vendedores e clientes criem seus perfis para acessar a plataforma, adicionar produtos e realizar compras.
- **Login Seguro**  
  Acesso protegido aos perfis de vendedores e clientes, com personalização das funcionalidades de acordo com o tipo de usuário.
- **Divulgação de Produtos**  
  Ferramentas para os vendedores promoverem seus produtos, aumentando a visibilidade e atraindo mais clientes por meio da plataforma e das redes sociais.
- **Sistema de Fidelidade**  
  Premiação para clientes que acumulam pontos a cada compra, incentivando a lealdade e o retorno contínuo à plataforma.
- **Eventos Semanais**  
  Oportunidades para interação entre vendedores e clientes através de promoções e semana de um produto X (exemplo: Semana do Doce no IFPE!!).
- **Avaliação de Produtos e Serviços**  
  Clientes podem avaliar produtos e serviços, ajudando a melhorar a reputação dos vendedores e orientando futuras compras.
- **Ranking de Vendas**  
  Classificação dos melhores vendedores com base nas vendas realizadas, criando um ambiente competitivo que estimula o crescimento dos empreendedores.
- **Categorias de Produtos**  
  Organização dos produtos em categorias específicas, facilitando a busca e navegação dentro da plataforma.

## Instalação

  Siga esse tuturial https://www.youtube.com/watch?v=UbX-2Xud1JA;
  Após a instalação, crie um banco de dados de dados com:
    Database "Inova_campus"
  Clique no com o botão direito no banco de dados cria e  selecione a o opção *Query SQL*
  Isso abrirá um tela no você deverá colar os dois scripts de tabela:

  -- Criar tabela de usuários
CREATE TABLE inv_users (
    usr_id SERIAL PRIMARY KEY,
    usr_name VARCHAR(100) NOT NULL,
    usr_email VARCHAR(255) NOT NULL,
    usr_password VARCHAR(255) NOT NULL,
    usr_phone VARCHAR(15) NOT NULL,
    usr_img VARCHAR(255) NOT NULL
);

-- Criar tabela de produtos
CREATE TABLE inv_products (
    pdt_id SERIAL PRIMARY KEY,
    pdt_name VARCHAR(255) NOT NULL,
    pdt_unit_price DECIMAL(10,2) NOT NULL, 
    pdt_units INT,
    pdt_img VARCHAR(255) NOT NULL,
    pdt_user INT NOT NULL,
    CONSTRAINT fk_products_users FOREIGN KEY (pdt_user) REFERENCES inv_users(usr_id) ON DELETE CASCADE
);
  
## Desenvolvedores

- [Catarina Silva](mailto:catarinasouzasilvao@gmail.com)
- [Dylan Borges](mailto:dylanborges06@gmail.com)
- [Izabelle Alves](mailto:izabelle.alvesbl@gmail.com)
- [Keila Isabelle](mailto:keiila_isabelle@outlook.com)
- [Laura Esterfani](mailto:lauraestefa4@gmail.com)
- [Rubens Lira](mailto:rubenslira371@gmail.com)


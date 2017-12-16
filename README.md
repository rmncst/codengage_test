# Teste Codengage 

Olá, esse repositório, contem os arqivos fonte relacionados ao teste enviado para mim. 
Abaixo, segue uma breve descrição relacionado ao setup da aplicação no enviroment desejado.
Qualquer dúvida ou problema, basta abrir um `issue` ou simplismente contactar-me através do meu email

A seguir, mais informações.

## Requisitos para a aplicação

A aplicação foi desenvolvida em um ambiente linux, distribuição Debian (9). Contanto que os requisitos abaixo sejam satisfeitos,
a aplicação poderá rodar em ouros  SO's como MAC ou WINDOWS. 

Os seguintes serviços são necessários: 

 - PHP >= 7.0 ( Garantir que o modo cli esteja funcionando ) ;
    - Garabtir que o pacote do composer também esteja disponível;   
 - Acesso a algum servidor MYSQL / MARIADB com permissão de criação de objetos; 
 - GIT (VCS);
 
 
 ## Recuperando o projeto
 
 Para baixar o projeto, basta entrar no diretório desjado em sua máquina , e digitar o seguinte comando:
 
 ````
 rmncst@notrcdeb:~$ cd /path/to/app
 rmncst@notrcdeb:~$ git clone https://github.com/rmncst/codengage_test
 
 ````
 
 Feito isso o projeto será baixado para o destino `/path/to/app`. Após isso, é necessário executar o 
 seguinte comando para atualizar as dependências do projeto:
 
 ````
 rmncst@notrcdeb:~/path/to/app$ composer update 
 
 ````
 
 Após isso, todos os arquivos serão baixados de seus respectivos repositórios para o seu projeto.
 
 ## Preparando o ambiente
 
 Após todo o trabalho anterior, é hora do database. Vamos configurar o usuário de senha da aplicação acessar o banco de dados. 
 Para isso, conecte no servidor MYSQL / MARIADB e execute os seguintes comandos.
 
 ```
 MariaDB [(none)]> create database codengagedb;
 MariaDB [(none)]> grant all privileges on codengagetestdb.* to 'codengageuser'@'%' identified by 'codengagepass';
 MariaDB [(none)]> flush privieges();
``` 
Esses dados de usuário e senha são mantidos no arquivo config/parameters.yml. 
Qualquer alteração necessário, é somente lá que precisa ser alterado

Após isso, vamos criar o banco e as demais classes: 
````
 rmncst@notrcdeb:~/path/to/app$ vendor/bin/doctrine orm:schema-tool:update --force
 rmncst@notrcdeb:~/path/to/app$ vendor/bin/doctrine orm:generate-proxies src/Data/Proxy
`````

Pronto, todo nosso ambiente preparado.

## Iniciando a aplicação

Caso todos os passos deram certo, então este será o mais tranquilo. Entre na pasta public do app e execute o seguinte comando:
````
php -S 127.0.0.1:8000
```

Este comando irá iniciar o web server imbutido do PHP, e caso queira mudar a porta de acesso, e so mudar no comando. 

Pronto, isso é tudo pessoal. Obrigado !

 
 

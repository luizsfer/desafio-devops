# **Desafio DevOps**

## Resumo das atividades

Esse desafio proposto pela [OW Interactive](http://www.owinteractive.com), cujo objetivo é criar e desenvolver uma comunicação entre uma aplicação backend que irá disponibilizar um JSON através de uma URL que será consumido por uma outra aplicação frontend e a mesma deve mostrar esse resultado em um endereço acessível através de um browser.

___

O desafio consiste em três etapas:

### 1 - Backend

#### Proposta de atividade
**Construir um docker com os seguintes requisitos obrigatórios:**

* PHP >= 7.*
    * Bibliotecas que devem ser instaladas no PHP:
bz2, calendar, Core, ctype, curl, date, dom, exif, fileinfo, filter, ftp, gd, gettext, gmp, hash, iconv, imagick, intl, json, libxml, mbstring, mcrypt, mysqli, mysqlnd, openssl, pcntl, pcre, PDO, pdo_mysql, pdo_sqlite, Phar, posix, readline, Reflection, session, shmop, SimpleXML, soap, sockets, SPL, sqlite3, standard, sysvmsg, sysvsem, sysvshm, tokenizer, wddx, xml, xmlreader, xmlwriter, xsl, zip, zlib
* MariaDB >= 10.*
* Redis >= 5.*
* Nginx >= 1.13.*

**A aplicação deve ser acessado a partir do endereço localhost:8000**



1. **Disponibilizar uma página com o resultado do comando phpinfo().**
2. **Criar a aplicação utilizando o framework Laravel.**
3. **O container da aplicação depender do container do banco de dados, então enquanto o container do banco de dados não estiver pronto ou ocorra algum erro na execução o container com a aplicação não poderá ser iniciado.**
4. **No desenvolvimento do JSON disponibilizado utilizar de alguma forma o MariaDB ou Redis.**

#### Resolução aplicada

* Construção de uma aplicação utilizando **docker-compose**, criando um container **NGINX** que servirá de proxy para a aplicação **PHP** que está localizada em um outro container. Outros dois containers possuem uma aplicação **MaridaDB** e outra **Redis**. Essa aplicação também está incluída dentro do **docker-compose** na pasta raiz, que executará os projetos ``backend`` e ``frontend`` uma única vez.

A aplicação **PHP** possui um arquivo ``index.php`` que direciona a outras dois links:
* Um link apontando para um arquivo que possui as informações do ``phpinfo()`` onde existem as descrições dos pacotes instalados.
* Um link apotando para uma classe de conexão ao bando de dados **MariaDB**, que retorna o resultado da conexão ao mesmo.

A aplicação **backend** está assim estruturada:
```
[folder] docker
    [folder] nginx
        [file] default.conf
    [folder] php
        [file] Dockerfile
        [file] www.conf
[file] .env
[file] connect.php
[file] docker-compose.yml
[file] index.php
[file] info.php
```
**Definições dos arquivos**
* docker/nginx/default.conf: 
Configurações do servidor **NGINX** necessárias para preparação do servidor proxy na ação com a aplicação em **PHP**.
* docker/php/Dockerfile:
Documento do tipo **Dockerfile**, necessário para criar a imagem **PHP** utilizada no projeto, essa ``build`` é invocada dentro do arquivo ``docker-compose.yml``.
* docker/php/www.conf
Arquivo de configuração da aplicação **PHP** cujo objetivo é criar parâmetros de permissão de acesso ao arquivo e monitoramento do servidor **NGINX**.
* .env
Arquivo de definições de variáveis de ambiente, local onde armazenamos instruções de acesso ao banco de dados nesse cenário proposto.
* connect.php
Arquivo **PHP** que contém a classe de conexão com o banco de dados da aplicação
* docker-compose.yml
Arquivo do tipo **docker-compose** com as instruções de criação dos containers utilizados nessa aplicação.
* index.php
Arquivo **PHP** com informações da página inicial da aplicação.
* info.php
Arquivo **PHP** que exibe na página as informações de configurações do **PHP**.

**Diferenciais aplicados nesta solução**
* Disponibilizar uma página com o resultado do comando phpinfo().
    * Atendida através do arquivo ``info.php``.
* Criar a aplicação utilizando o framework Laravel.
    * Não atendida.
* O container da aplicação depender do container do banco de dados, então enquanto o container do banco de dados não estiver pronto ou ocorra algum erro na execução o container com a aplicação não poderá ser iniciado.
    * Atendida através da instução ``depends_on`` dentro do arquivo ``docker-compose``.
* No desenvolvimento do JSON disponibilizado utilizar de alguma forma o MariaDB ou Redis.
    * Atendida parcialmente, apenas com o uso do banco **MariaDB**, através do arquivo de configuração ``connect.php``.


### 2 - Frontend

#### Proposta de atividade
**Construir um docker com os seguintes requisitos obrigatórios:**

* Construir um docker com os seguintes requisitos obrigatórios:
    * Node >= 8.*
    * Redis >= 5.*

**A aplicação deve ser acessado a partir do endereço [localhost:3000](http://localhost:3000)**

**Diferenciais:**

<!-- 1. **Criar a aplicação utilizando o framework Nuxt.JS.** -->
1. **Consumir o JSON que vem da aplicação backend utilizando a biblioteca Axios.**
2. **No desenvolvimento do consumo do JSON utilizar de alguma forma o Redis.**

#### Resolução aplicada

* Construção da aplicação **NodeJS** através de container utilizando **docker-compose** e aplicação de um banco de dados **Redis** em um segundo container dentro do mesmo arquivo. Essa aplicação também está incluída dentro do **docker-compose** na pasta raiz, que executará os projetos ``backend`` e ``frontend`` uma única vez.

A aplicação **NodeJS** exibe uma resposta à uma chamada via API que retorna uma mensagem de ``Hello World``.

#### A aplicação Frontend está assim estruturada:

```
[folder] node
    [folder] node-modules
    [file] package-lock.json
    [file] package.json
    [file] server.js
[file] docker-compose.yml
[file] Dockerfile
```

**Definições dos arquivos**
* node-modules
Pasta que contém as bibliotecas necessárias para a execução da aplicação em **NodeJS**.
* package-lock.json
Arquivo interno ao **NodeJS** que contém instruções de funcionamento da aplicação.
* package.json
Arquivo de construção da aplicação, criado através do comando ``npm init``.
* server.js
Arquivo que contém a ``API`` proposta para a execução do projeto ``Frontend``.

**Diferenciais aplicados nesta solução**
* Consumir o JSON que vem da aplicação backend utilizando a biblioteca Axios.
    * Não aplicada.
* No desenvolvimento do consumo do JSON utilizar de alguma forma o Redis.**
    * Não aplicada.
___

### 3 - Documentação

#### Proposta de atividade

Disponibilizar na raiz do projeto um arquivo README.md com as instruções de como rodar o projeto e mais alguma informação se necessário.

**Diferenciais:**

1. **Esperamos que o processo para rodar o projeto seja apenas o comando: \
docker-compose up -d**
2. **Adicionar ao documento README.md o por que usou X tecnologia para criar as aplicações frontend e backend.**

#### Resolução aplicada

Este arquivo visa atender a proposta dessa atividade.

**Diferenciais aplicados nesta solução**

* Esperamos que o processo para rodar o projeto seja apenas o comando: docker-compose up -d

O projeto pode ser executado através dos arquivos ``docker-compose.yml`` dentro de cada aplicação:

**Exemplo:** Para execução isolada do ``Backend``, acessar a pasta raiz da aplicação e executar o comando ``docker-compose up -d`` garante a execução da criação e configurações dos containers.

* Adicionar ao documento README.md o por que usou X tecnologia para criar as aplicações frontend e backend.

    * Para a criação dos containers em ``Backend``, foi utilizado imagens cedidas pela comunidade **DockerHub**:
        * Na aplicação **PHP** foi escolhido a imagem ``7.1.33-fpm-alpine`` que é a última versão que possui suporte ao pacote ``mcrypt`` listado como necessário pela aplicação. O fato de ser utilizado o sistema operacional ``Alpine`` visa a atender aspectos de segurança e efetidade, uma vez que apenas os pacotes mínimos são instalados dentro dessa versão.
        * Para a aplicação ``NGINX`` foi utilizado a imagem versão 1.13.12 que é a versão instável mais recente, atendendo questões de suporte LTS e confiabilidade.
        * O mesmo se aplica na criação da aplicação ``MariaDB`` cuja versão ``latest`` atende ao mesmo parâmetro do container ``NGINX``.
        * A aplicação ``Redis``  traz o uso da versão 12.16 que é a versão mais atual com LTS. 
    * Para a criação dos container em ``Frontend``:
        * A aplicação ``NodeJS`` traz o uso da versão 12.16 que é a versão mais atual com LTS. 
        * A aplicação ``Redis``  traz o uso da versão 12.16 que é a versão mais atual com LTS. 

___

### Agradecimentos

Agradeço à oportunidade enviada pela [Paula Silva](https://www.linkedin.com/in/paula-silva-3938b7158/) e a toda equipe da [OW Interactive](http://www.owinteractive.com) que demonstrou interesse em minhas habilidades. Fiquei muito feliz em executar esse desafio, empolgante e no tempo tecnológico crescente, onde o uso de containers e orquestração demonstra ser uma solução cada vez mais adequada à necessidade do mercado.
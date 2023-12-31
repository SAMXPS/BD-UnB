# BD-UnB
Trabalho final da disciplina de Banco de Dados - Universidade de Brasília - 2023/1

# Informações do Ambiente

Para simplificar o ambiente de execução, usei uma VM na Digital Ocean para desenvolver o trabalho. Não é necessário a VM pra reproduzir, mas achei interessante incluir esses detalhes.

Ambiente de Desenvolvimento:
- IDE: Visual Studio Code
    - extensão: Remote - SSH v0.102.0
    - extensão: Docker v1.25.2
- VM: 2GB 2CPU 25GB SSD (~R$1,08 / dia) (New York)
- Sistema Operacional: Ubuntu 22.04 x64 LTS 

Tutorial sobre docker PHP+MySQL: https://www.section.io/engineering-education/dockerized-php-apache-and-mysql-container-development-environment/

Tutorial sobre instalação do docker Ubuntu 22.04: https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-22-04

# Requisistos para execução do trabalho

## Passo 1. Instalação do docker.

Caso nao tenha o docker instalado, segue como instalar no Ubuntu 22.04.
Enviar um comando por vez.

```
# atualizacao do sistema
sudo apt update

# instalacao de dependencias
sudo apt install apt-transport-https ca-certificates curl software-properties-common -y

# aqui talvez precise de reboot caso o kernel tenha sido atualizado
# opcional: reboot now

# chave do pacote do docker
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# atualizacao dos pkts do ubuntu...
sudo apt update

# aqui podemos ver os candidados pra instalacao do docker
apt-cache policy docker-ce

# deve aparecer algo do tipo, incluindo "jammy" por ser ubuntu 22.04
# docker-ce:
#   Installed: (none)
#   Candidate: 5:24.0.4-1~ubuntu.22.04~jammy

# instalando o docker...
sudo apt install docker-ce -y

# verificando o status do docker
sudo systemctl status docker

# aparece: Active: active (running)
```

Além do docker, será necessário instalar o docker-compose.

```
sudo apt install docker-compose
```

É interessante também remover quaisquer containers do docker que já estejam em execução.

Execute `docker container ls` pra verificar os containers existentes. 

Para remover um container pre-existente, execute `docker container rm <container's name>`. 

# Iniciando os containers

```
docker compose up -d
```

ou (de preferencia)

```
./start.sh
```

# Desligando e limpando os containers

```
docker compose down
```

ou (de preferencia)

```
./stop.sh
```

# Informações de Acesso

Website: porta 8000

PhpMyAdmin: porta 8080

Database: porta 9906

# Importando arquivos SQL para o BD

A importacao de arquivos sql para o BD pode ser feita da seguinte forma:

```
docker exec -i db mysql --default-character-set=utf8 -uroot -proot@pass db_unb < arquivo_sql.sql
```

Porém, já preparei um script `load_db.sh` que importa os arquivos da pasta dados.
- bd_unb_drop_tables -> limpa o BD
- bd_unb_schema      -> esquema do BD
- bd_unb_data        -> dados do BD
    - Aqui contem no minimo 3 dados pra cada tabela.
    - Deixei apenas os departamentos de COMPUTACAO.
    - Existe tb a versao completa na pasta scripts/turmas.sql com TODAS as turmas da UnB (dos CSVs fornecidos pelo professor).

Então, basta executar:

```
./load_db.sh
```

OBS: Testado apenas em ambiente LINUX, talvez seja necessario algum ajuste pequeno para rodar em WINDOWS.

# Usuarios do Sistema

Os seguintes usuarios estao previamente criados:
- login: 1 senha: 1
- login: 2 senha: 2
- login: 3 senha: 3
- login: 99 senha: admin
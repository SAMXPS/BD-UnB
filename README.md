# BD-UnB
Trabalho final da disciplina de Banco de Dados - Universidade de Brasília - 2023/1

# Tutorial de Execução

## Informações do Ambiente

Para simplificar o ambiente de execução, usei uma VM na Digital Ocean para desenvolver o trabalho. Não é necessário a VM pra reproduzir, mas achei interessante incluir esses detalhes.

Ambiente de Desenvolvimento:
- IDE: Visual Studio Code, com extensão Remote SSH
- VM: 1GB 1CPU 25GB SSD (~R$1,08 / dia) (New York)
- Sistema Operacional: Ubuntu 22.04 x64 LTS 

Tutorial sobre docker PHP+MySQL: https://www.section.io/engineering-education/dockerized-php-apache-and-mysql-container-development-environment/

Tutorial sobre instalação do docker Ubuntu 22.04: https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-22-04

## Requisistos para execução do trabalho

### Passo 1. Instalação do docker.

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
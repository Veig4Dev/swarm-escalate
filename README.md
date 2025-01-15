English

🚀 Swarm Escalate - Orchestration with Docker Swarm

Overview

This project implements a scalable environment using Docker Swarm, integrating essential services like MySQL, RabbitMQ, and Prometheus for monitoring. It enables dynamic scalability and easy container management.

🔧 Technologies Used

- Docker Swarm - Container orchestration.
- MySQL 8 - Relational database.
- RabbitMQ - Messaging for asynchronous queues.
- Prometheus - Metrics collection and monitoring.
- MySQL Exporter - Exposing MySQL metrics to Prometheus.

📁 Project Structure

├── docker-compose.yml # Service definitions  
├── logs/ # Logs directory  
├── monitoring/ # Prometheus configuration  
├── mysql-init/ # Database initialization scripts  
├── php/ # PHP application code  
├── prometheus.yml # Prometheus configuration  

How to Run the Project

Initialize Docker Swarm

If Docker Swarm is not activated yet, run:

docker swarm init
Deploy the Services

docker stack deploy -c docker-compose.yml swarm_stack

This command creates the services and networks as defined in the docker-compose.yml.

Service Scaling

To increase the replicas of a service:

docker service scale swarm_stack_mysql=3

This will run 3 instances of MySQL distributed across the cluster.

Monitoring

Access Prometheus at:
http://localhost:9090

RabbitMQ Management is available at:
http://localhost:15672

Logs can be accessed in the logs/ folder.

Remove the Stack

To remove the stack, run:

docker stack rm swarm_stack

Contribution

To contribute, fork the repository and submit a Pull Request.

License

This project is licensed under the MIT License.



Português 
 
 Swarm Escalate - Orquestração com Docker Swarm

 Visão Geral

Este projeto implementa um ambiente escalável usando Docker Swarm, integrando serviços essenciais como MySQL, RabbitMQ e Prometheus para monitoramento. Ele permite escalabilidade dinâmica e fácil gestão dos contêineres.

 Tecnologias Utilizadas

Docker Swarm - Orquestração de contêineres.

MySQL 8 - Banco de dados relacional.

RabbitMQ - Mensageria para filas assíncronas.

Prometheus - Coleta e monitoramento de métricas.

MySQL Exporter - Exposição de métricas do MySQL para o Prometheus.

📁 Estrutura do Projeto

├── docker-compose.yml  # Definição dos serviços
├── logs/               # Diretório de logs
├── monitoring/         # Configuração do Prometheus
├── mysql-init/         # Scripts de inicialização do banco de dados
├── php/                # Código da aplicação PHP
├── prometheus.yml      # Configuração do Prometheus

 Como Rodar o Projeto

 Inicialização do Docker Swarm

Se o Docker Swarm ainda não estiver ativado, execute:

docker swarm init

 Deploy dos Serviços

docker stack deploy -c docker-compose.yml swarm_stack

Isso cria os serviços e redes conforme definido no docker-compose.yml.

 Escalonamento dos Serviços

Para aumentar as réplicas de um serviço:

docker service scale swarm_stack_mysql=3

Isso irá executar 3 instâncias do MySQL distribuídas no cluster.

 Monitoramento

Acesse o Prometheus via http://localhost:9090

O RabbitMQ Management está disponível em http://localhost:15672

Logs podem ser acessados na pasta logs/

 Remoção do Stack

docker stack rm swarm_stack

 Contribuição

Para contribuir, faça um fork do repositório e envie um Pull Request.

 Licença

Este projeto está sob a licença MIT.


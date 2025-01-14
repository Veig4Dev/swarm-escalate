<?php

require 'vendor/autoload.php';

// Biblioteca do RabbitMQ
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$host = 'mysql';
$dbname = 'testdb';
$user = 'user';
$pass = 'password';

try {
    // Conectar ao MySQL
    $pdo = new PDO( "mysql:host=$host;dbname=$dbname", $user, $pass );
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // Criar a tabela caso não exista
    $pdo->exec( "CREATE TABLE IF NOT EXISTS test_data (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message VARCHAR(255) NOT NULL
    )" );

    echo 'Tabela test_data pronta!\n';

    // Conectar ao RabbitMQ
    $connection = new AMQPStreamConnection( 'rabbitmq', 5672, 'guest', 'guest' );
    $channel = $connection->channel();
    $channel->queue_declare( 'test_queue', false, false, false, false );

    echo 'Conectado ao RabbitMQ!\n';

    // Inserir múltiplos registros no banco de dados e enviar para RabbitMQ
    $max = 100000;
    // Número de registros a inserir
    for ( $i = 1; $i <= $max; $i++ ) {

        // Inserir no MySQL
        $stmt = $pdo->prepare( 'INSERT INTO test_data (message) VALUES (:message)' );
        $message = "Teste de escalabilidade {$i}";
        $stmt->execute( [ 'message' => $message ] );

        // Enviar mensagem para RabbitMQ
        $msg = new AMQPMessage( $message );
        $channel->basic_publish( $msg, '', 'test_queue' );

        echo "Inserido no MySQL e enviado ao RabbitMQ: {$message}\n";
    }

    echo 'Processo concluído com sucesso!\n';

    // Fechar conexões
    $channel->close();
    $connection->close();
} catch ( PDOException $e ) {
    echo 'Erro ao conectar ao MySQL: ' . $e->getMessage() . '\n';
} catch ( Exception $e ) {
    echo 'Erro geral: ' . $e->getMessage() . '\n';
}

?>

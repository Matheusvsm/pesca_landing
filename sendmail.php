<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
    $nome     = trim($_POST["nome"]);
    $email    = trim($_POST["email"]);
    $mensagem = trim($_POST["mensagem"]);

    // Verifica se os campos foram preenchidos
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Valida o endereço de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, informe um e-mail válido.";
        exit;
    }

    // Define os parâmetros do email
    $to      = "pescadireta5@gmail.com";
    $subject = "Nova mensagem do formulário de contato";
    $body    = "Você recebeu uma nova mensagem do formulário de contato:\n\n" .
               "Nome: " . $nome . "\n" .
               "Email: " . $email . "\n" .
               "Mensagem:\n" . $mensagem . "\n";

    // Cabeçalhos do email
    $headers  = "From: " . $nome . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Envia o email e verifica se foi enviado com sucesso
    if (mail($to, $subject, $body, $headers)) {
        echo "Obrigado por entrar em contato. Sua mensagem foi enviada com sucesso.";
    } else {
        echo "Houve um problema ao enviar sua mensagem. Por favor, tente novamente mais tarde.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>

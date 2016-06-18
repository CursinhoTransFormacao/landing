<?php
  /* Seguindo as dicas do post no blog http://blog.teamtreehouse.com/create-ajax-contact-form */
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nome = strip_tags(trim($_POST["fale-conosco-nome"]));
      $nome = str_replace(array("\r","\n"),array(" "," "),$nome);
      $telefone = strip_tags(trim($_POST["fale-conosco-telefone"]));
      $telefone = str_replace(array("\r","\n"),array(" "," "),$telefone);
      $email = filter_var(trim($_POST["fale-conosco-email"]), FILTER_SANITIZE_EMAIL);
      $mensagem = trim($_POST["fale-conosco-mensagem"]);

      if (empty($nome) OR empty($telefone) OR empty($mensagem) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
          http_response_code(400);
          echo "Oops! Houve um problema na sua submissão. Por favor complete o formulário e tente novamente!";
          exit;
      }

      $destinatario = "cursinhopopulartrans@gmail.com";

      $assunto = "[FORMULÁRIO-DE-CONTATO] Enviado por $nome";

      $email_conteudo = "Nome: $nome\n";
      $email_conteudo .= "Telefone: $telefone\n\n";
      $email_conteudo .= "Email: $email\n\n";
      $email_conteudo .= "Mensagem:\n$mensagem\n";

      $email_cabecalho = "De: $nome <$email>";

      if (mail($destinatario, $assunto, $email_conteudo, $email_cabecalho)) {
          http_response_code(200);
          echo "Obrigado! Sua mensagem foi enviada com sucesso.";
      } else {
          http_response_code(500);
          echo "Oops! Houve um problema na sua submissão e não pudemos enviar sua mensagem.";
      }
  } else {
      http_response_code(403);
      echo "Houve um problema na sua requisição, por favor tente novamente.";
  }
?>

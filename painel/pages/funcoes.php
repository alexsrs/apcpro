<?php

function obterLinkAnamnese($usuario_id) {
    // Conexão com o banco de dados usando as constantes definidas em config.php
    $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta o último perfil do usuário com base em data_avaliacao
    $sql = "
        SELECT * 
        FROM tb_perfis_usuarios 
        WHERE usuario_id = ? 
        ORDER BY data_avaliacao DESC 
        LIMIT 1
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    $stmt->bind_param('i', $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $perfil = $result->fetch_assoc();
    
    if (!$perfil) {
        return "anamnese-geral"; // Página padrão se não houver perfil
    }
    // Contabiliza quantas condições estão marcadas como true
    $conditionsTrue = 0;
    
    if ($perfil['obesidade']) {
        $conditionsTrue++;
        $link = "anamnese-obesidade";
    }
    if ($perfil['diabetes']) {
        $conditionsTrue++;
        $link = "anamnese-diabetes";
    }
    if ($perfil['hipertensao']) {
        $conditionsTrue++;
        $link = "anamnese-hipertensao";
    }
    if ($perfil['depressao']) {
        $conditionsTrue++;
        $link = "anamnese-depressao";
    }
    if ($perfil['pos_covid']) {
        $conditionsTrue++;
        $link = "anamnese-pos-covid";
    }
    if ($perfil['idoso']) {
        $conditionsTrue++;
        $link = "anamnese-idoso";
    }
    if ($perfil['gestante']) {
        $conditionsTrue++;
        $link = "anamnese-gestante";
    }
    if ($perfil['posparto']) {
        $conditionsTrue++;
        $link = "anamnese-posparto";
    }
    if ($perfil['emagrecer']) {
        $conditionsTrue++;
        $link = "anamnese-emagrecer";
    }
    // Se for idoso, redireciona para anamnese-idoso
    if ($perfil['idoso']) {
        $conditionsTrue++;
        return "anamnese-idoso";
    }
    // Se tiver mais de uma condição verdadeira, redireciona para anamnese-multipla
    if ($conditionsTrue > 1) {
        return "anamnese-multipla";
    }
    // Caso não tenha nenhuma condição marcada, vai para anamnese-geral
    if ($conditionsTrue == 0) {
        return "anamnese-geral";
    }
    return $link ?? "anamnese-geral";
    
    $stmt->close();
    $conn->close();
}
?>

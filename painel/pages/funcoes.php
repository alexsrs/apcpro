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

    // Verifica as condições e retorna o link adequado
    if ($perfil['obesidade']) {
        return "anamnese-obesidade";
    } elseif ($perfil['diabetes']) {
        return "anamnese-diabetes";
    } elseif ($perfil['hipertensao']) {
        return "anamnese-hipertensao";
    } elseif ($perfil['depressao']) {
        return "anamnese-depressao";
    } elseif ($perfil['pos_covid']) {
        return "anamnese-pos-covid";
    } elseif ($perfil['idoso']) {
        return "anamnese-idoso";
    } elseif ($perfil['gestante']) {
        return "anamnese-gestante";
    } elseif ($perfil['posparto']) {
        return "anamnese-posparto";
    } elseif ($perfil['emagrecer']) {
        return "anamnese-emagrecer";
    } else {
        return "anamnese-geral"; // Anamnese geral para não idosos
    }

    $stmt->close();
    $conn->close();
}
?>

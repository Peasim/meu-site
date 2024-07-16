<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["videoFile"]["name"]);
    $uploadOk = 1;
    $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verifica se o arquivo de vídeo é real
    $check = getimagesize($_FILES["videoFile"]["tmp_name"]);
    if ($check !== false) {
        echo "Arquivo é um vídeo - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "O arquivo não é um vídeo.";
        $uploadOk = 0;
    }

    // Verifica se o arquivo já existe
    if (file_exists($targetFile)) {
        echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

    // Verifica o tamanho do arquivo (aqui definido como 100MB)
    if ($_FILES["videoFile"]["size"] > 100000000) {
        echo "Desculpe, o arquivo é muito grande.";
        $uploadOk = 0;
    }

    // Permite apenas certos formatos de arquivo
    if ($videoFileType != "mp4" && $videoFileType != "avi" && $videoFileType != "mov"
    && $videoFileType != "mpeg") {
        echo "Desculpe, apenas arquivos MP4, AVI, MOV e MPEG são permitidos.";
        $uploadOk = 0;
    }

    // Verifica se $uploadOk é setado para 0 por um erro
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi enviado.";
    // Se tudo estiver correto, tenta fazer o upload do arquivo
    } else {
        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
            echo "O arquivo ". htmlspecialchars(basename($_FILES["videoFile"]["name"])) . " foi enviado com sucesso.";
        } else {
            echo "Desculpe, houve um erro ao enviar seu arquivo.";
        }
    }
}
?>

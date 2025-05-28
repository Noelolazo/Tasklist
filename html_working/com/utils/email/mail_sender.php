<?php

function sendMail($url, $receiver, $affair, $body, $attachments) {
    $data = array(
        'receiver' => $receiver,
        'affair' => $affair,
        'body' => $body,
        'attachments' => $attachments
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true // Ignorar errores para poder leer el contenido de respuesta
        ),
    );

    $context  = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    if ($result === FALSE) {
        // Obtener más detalles del error
        $error = error_get_last();
        return false;
    }

    $response = json_decode($result, true);

    if ($response === null) {
        return false;
    }

    return $response['result'];
}

// function readAndRegisterUsers($url) {

//     $options = array(
//         'http' => array(
//             'header'  => "Content-type: application/json\r\n",
//             'method'  => 'GET',
//             'ignore_errors' => true // Ignorar errores para poder leer el contenido de respuesta
//         ),
//     );

//     $context  = stream_context_create($options);
//     $result = @file_get_contents($url, false, $context);

//     if ($result === FALSE) {
//         // Obtener más detalles del error
//         $error = error_get_last();
//         return false;
//     }

//     $response = json_decode($result, true);

//     if ($response === null) {
//         return false;
//     }

//     return $response['resultado'];
// }
?>
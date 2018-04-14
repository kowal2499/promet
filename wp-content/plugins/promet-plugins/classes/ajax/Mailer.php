<?php

namespace Ajax;

class Mailer
{
    public function send_contact_message()
    {
        // filter input data
        $fields = filter_input(INPUT_POST, 'fields', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $args = [
            'name' => filter_var($fields['name'], FILTER_SANITIZE_STRING),
            'email' => filter_var($fields['email'], FILTER_SANITIZE_EMAIL),
            'nip' => filter_var($fields['nip'], FILTER_SANITIZE_STRING),
            'subject' => filter_var($fields['subject'], FILTER_SANITIZE_STRING),
            'body' => filter_var($fields['body'], FILTER_SANITIZE_STRING)
        ];

        $message = 'Wiadomość ze strony www:' . PHP_EOL .
        'Imię i nazwisko nadawcy: ' . $args['name'] . PHP_EOL .
        'Email nadawcy: ' . $args['email'] . PHP_EOL .
        'NIP nadawcy: ' . $args['nip'] . PHP_EOL .
        'Temat wiadomości: ' . $args['subject'] . PHP_EOL .
        '--------------------' . PHP_EOL . PHP_EOL .
        $args['body'];

        $result = wp_mail('roman@erla.pl', 'Wiadomość ze strony www | temat: ' . $args['subject'], $message);
        
        wp_send_json_success($result);
    }
}

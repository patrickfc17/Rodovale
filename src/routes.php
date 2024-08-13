<?php

return [
    '/' => 'ViagensController@index',
    '/viagem' => 'ViagensController@create',
    '/viagem/cadastrar' => 'ViagensController@store',
    '/viagem/:id' => 'ViagensController@edit',
    '/viagem/editar/:id' => 'ViagensController@update',
    '/viagem/deletar/:id' => 'ViagensController@destroy',
];

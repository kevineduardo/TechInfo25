<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during anytime for various
    | messages that we need to display to the user.
    |
    */
    // Sem explicação
    'portal' => 'Portal do Aluno',
    'teacher' => 'Professor',
    'student' => 'Aluno',
    'layout' => [
        'home' => 'Início',
        'tn' => 'Visualizar Navegação',
        'login' => 'Logar',
        'register' => 'Registrar-se',
        'logout' => 'Deslogar-se',
        'email' => 'Endereço de E-mail',
        'password' => 'Senha',
        'cpassword' => 'Confirmação de Senha',
        'remember' => 'Lembre-se de mim',
        'name' => 'Nome',
        'firstname' => 'Nome',
        'lastname' => 'Sobrenome',
        'forgotp' => 'Esqueceu sua senha?',
        'resetp' => 'Resetar Senha',
        'sendresetp' => 'Enviar Link de Recuperação',
        'social' => [
            'fb' => 'Entrar com o Facebook',
        ],
        'agenda' => 'Agenda do Técnico',
        'sagenda' => 'Sem nada na agenda...',
        'galeria' => 'Galeria de Fotos',
        'noticiasp' => 'Notícias Principais',
        'welcome' => 'Seja bem-vindo (a)!',
        'news' => 'Notícias',
        'readmore' => 'Leia mais...',
        'noticia' => 'Notícia',
        'recents' => 'Recentes',
    ],
    'n' => [
        'nr' => 'Sua busca retornou nenhum resultado.',
        'ne' => 'Não existe nenhuma notícia.',
        'np' => 'Você não possui nenhuma notícia.',
    ],
    // Buttons, dude!
    'buttons' => [
        'palunos' => 'Postadas por Alunos',
        'novanoticia' => 'Nova notícia',
        'buscar' => 'Buscar',
		'voltar' => 'Voltar',
    ],
    // Placeholders
    'phs' => [
        'buscar' => 'Buscar notícia...',
    ],
    // Colummns field's name
    'cm' => [
        'title' => 'Título',
        'subtitle' => 'Sub-título',
        'text' => 'Texto',
        'author' => 'Autor',
        'created_at' => 'Data de Criação',
        'updated_at' => 'Data de Atualização',
        'deleted_at' => 'Data de Exclusão',
        'published_at' => 'Data de Publicação',
        'approved' => 'Aprovado',
    ],
    // Basic stuff like yes or no
    'b' => [
        'yes' => 'Sim',
        'no' => 'Não',
    ],
    // Titles
    'titles' => [
        'newnews' => 'Nova notícia',
    ],
    // Form's labels
    'form' => [
        'news' => [
        'title' => 'Título da Notícia',
        'subtitle' => 'Sub-título da Notícia',
        'text' => 'Texto da Notícia',
        ],
        'publish' => [
            'true' => 'Publicar imediatamente',
            'false' => 'Salvar como rascunho',
        ],
        'save' => 'Salvar',
        'errors' => [
            'post' => 'Falha ao postar!',
        ],
        'success' => [
            'post' => [
                'title' => 'Postado com sucesso!',
                'msg' => 'Sua notícia foi enviada.',
            ],
        ],
    ],
    // Menu
    'menu' => [
        'overview' => 'Visão Geral',
        'grades' => 'Notas',
        'homeworks' => 'Trabalhos',
        'news' => 'Notícias',
        'pictures' => 'Fotos',
        // Teachers only from this point
        'users' => 'Usuários',
        'config' => 'Configurações',
    ],
    // Alts for the alt="" attribute
    'alt' => [
        'img' => 'Imagem',
        'css' => 'CSS válido!',
        'acb' => 'Site com acessibilidade!',
        'mathml' => 'MathML válido!',
        'svg' => 'SVG 1.1 válido!',
        'html' => 'HTML 4.01 válido!',
    ],
	// Aprovação
	'aprov' => [
		'a' => 'Publicar',
		'd' => 'Descartar',
		
		'idn' => 'Parametro id não definido.',
		'uer' => 'Erro desconhecido.'
	]
];

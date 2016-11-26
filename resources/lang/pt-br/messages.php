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
        'studentnews' => 'Notícias de Alunos',
        'readmore' => 'Leia mais...',
        'noticia' => 'Notícia',
        'recents' => 'Recentes',
        'users' => 'Usuários',
		'teachers' => 'Docentes',
        'teacher' => 'Professores',
        'coordinator' => 'Coordenadores',
        'calendar' => 'Calendário',

        'contact' => 'Contato',
        'cname' => 'Nome Completo',
        'cemail' => 'E-Mail',
        'cmessage' => 'Mensagem',
        'csubj' => 'Assunto',
        'news' => 'Notícias',
        'map' => 'Mapa',
        'img' => 'Imagens',
    ],
    'n' => [
        'nr' => 'Sua busca retornou nenhum resultado.',
        'ne' => 'Não existe nenhuma notícia.',
        'na' => 'Não existe nenhuma notícia esperando aprovação.',
        'np' => 'Você não possui nenhuma notícia.',
    ],
    'd' => [
        'nd' => 'Não existe nenhuma data marcada.'
    ],
    'u' => [
        'nr' => 'Sua busca retornou nenhum resultado.',
        'ne' => 'Não existe nenhum usuário'
    ],
    // Buttons, dude!
    'buttons' => [
        'palunos' => 'Postadas por Alunos',
        'novanoticia' => 'Nova notícia',
        'novadata' => 'Nova Data',
        'buscar' => 'Buscar',
		'voltar' => 'Voltar',
        'alunosinvite' => 'Alunos Autorizados',
        'novousuario' => 'Novo usuário',
        'palunos_salvar' => 'Salvar & Publicar',
        'palunos_descartar' => 'Descartar',
        'salvarnot' => 'Salvar',
        'deletarnot' => 'Deletar',
        'salvaruser' => 'Salvar',
        'deletaruser' => 'Deletar',
        'salvarcal' => 'Salvar',
        'deletarcal' => 'Deletar',
        'clear' => 'Limpar Campos',
        'send' => 'Enviar',
    ],
    // Placeholders
    'phs' => [
        'buscar' => 'Buscar notícia...',
        'buscaru' => 'Buscar usuário...',
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
        'name' => 'Nome',
        'email' => 'E-mail',
        'registered' => 'Registrado',
        'place' => 'Local',
        'created' => 'Criado por',
        'date' => 'Data',
    ],
    // Basic stuff like yes or no
    'b' => [
        'yes' => 'Sim',
        'no' => 'Não',
    ],
    // Titles
    'titles' => [
        'newnews' => 'Nova notícia',
        'newuser' => 'Novo usuário',
        'editnews' => 'Editar notícia',
        'edituser' => 'Editar usuário',
        'teachers' => 'Perfil do Educador',
        'editcal' => 'Editar Calendário',
        'newcal' => 'Nova Data'
    ],
    // Form's labels
    'form' => [
        'news' => [
        'title' => 'Título da Notícia',
        'subtitle' => 'Sub-título da Notícia',
        'text' => 'Texto da Notícia',
        ],
        'user' => [
        'name' => 'Nome do Usuário',
        'level' => 'Nível de Acesso',
        ],
        'publish' => [
            'true' => 'Publicar imediatamente',
            'false' => 'Salvar como rascunho',
        ],
        'epublish' => [
            'true' => 'Publicado',
            'false' => 'Rascunho',
        ],
        'teacher' => [
            'true' => 'Professor (a)',
            'false' => 'Aluno (a)',
        ],
        'save' => 'Salvar',
        'errors' => [
            'post' => 'Falha ao postar!',
        ],
        'calendar' => [
            'title' => 'Titulo',
            'place' => 'Local',
            'descr' => 'Descrição',
        ],
        'success' => [
            'post' => [
                'title' => 'Postado com sucesso!',
                'msg' => 'Sua notícia foi enviada.',
            ],
            'delete' => [
                'title' => 'Descartado com sucesso!',
                'msg' => 'A notícia foi descartada.',
            ],
            'approved' => [
                'title' => 'Aprovado com sucesso!',
                'msg' => 'A notícia foi aprovada.',
            ],
            'edited' => [
                'title' => 'Editada com sucesso!',
                'msg' => 'A notícia foi editada.',
            ],
        ],
        'success_user' => [
            'edit' => [
                'title' => 'Usuário editado!',
                'msg' => 'O usuário foi editado com sucesso!',
            ],
            'delete' => [
                'title' => 'Usuário deletado!',
                'msg' => 'O usuário foi deletado com sucesso!',
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
];

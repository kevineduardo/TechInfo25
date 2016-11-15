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
    'portal' => 'Portal do Estudante',
    'teacher' => 'Professor (a)',
    'student' => 'Aluno (a)',
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
        'config' => 'Configurações',
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
        'usersinvite' => 'Convite de Usuários',
        'settings' => 'Configurações Gerais',
        'classes' => 'Gerenciar Turmas',
    ],
    'n' => [
        'nr' => 'Sua busca retornou nenhum resultado.',
        'ne' => 'Não existe nenhuma notícia.',
        'na' => 'Não existe nenhuma notícia esperando aprovação.',
        'np' => 'Você não possui nenhuma notícia.',
    ],
    'u' => [
        'nr' => 'Sua busca retornou nenhum resultado.',
        'ne' => 'Não existe nenhum usuário',
    ],
    't' => [
        'nr' => 'Sua busca retornou nenhum resultado.',
        'ne' => 'Não existe nenhuma turma',
    ],
    // Buttons, dude!
    'buttons' => [
        'palunos' => 'Postadas por Alunos',
        'novanoticia' => 'Nova notícia',
        'buscar' => 'Buscar',
		'voltar' => 'Voltar',
        'usersinvite' => 'Convite de Usuários',
        'novousuario' => 'Novo usuário',
        'palunos_salvar' => 'Salvar & Publicar',
        'palunos_descartar' => 'Descartar',
        'salvarnot' => 'Salvar',
        'deletarnot' => 'Deletar',
        'salvaruser' => 'Salvar',
        'deletaruser' => 'Deletar',
        'novoconvite' => 'Novo Convite',
        'deletarconvite' => 'Deletar Convite',
        'novaturma' => 'Nova Turma',
    ],
    // Placeholders
    'phs' => [
        'buscar' => 'Buscar notícia...',
        'buscaru' => 'Buscar usuário...',
        'email_aluno' => 'educando@25dejulho.com',
        'site_name' => 'Tech Info 25',
        'fb_url' => 'https://www.facebook.com/TechInfo25',
        'sfooter' => 'ESCOLA TÉCNICA ESTADUAL 25 DE JULHO <br/>IJUÍ - RS',
        'turma_number' => '121C',
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
        'class' => 'Turma',
        'inityear' => 'Data de Início',
        'resp' => 'Responsável',
    ],
    // Basic stuff like yes or no
    'b' => [
        'yes' => 'Sim',
        'no' => 'Não',
    ],
    // Titles
    'titles' => [
        'newnews' => 'Nova Notícia',
        'newuser' => 'Novo Usuário',
        'editnews' => 'Editar Notícia',
        'edituser' => 'Editar Usuário',
        'deleteinvite' => 'Deletar Convite',
        'newinvite' => 'Novo Convite',
        'newclass' => 'Nova Turma',
        'editclass' => 'Editar Turma',
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
        'email' => 'Email',
        ],
        'userinvite' => [
        'email' => 'Email',
        'class' => 'Turma',
        ],
        'class' => [
        'number' => 'Número',
        'variant' => 'Variante',
        ],
        'settings' => [
        'site_name' => 'Nome do Site',
        'mnt' => 'Manutenção',
        'fb' => 'URL da Página do Facebook',
        'pa' => 'Portal do Estudante (para Alunos)',
        'footer' => 'Footer do Site',
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
            'save' => 'Falha ao salvar!',
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
            'invite' => [
                'title' => 'Usuário convidado!',
                'msg' => 'O usuário foi convidado com sucesso!',
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
        'usersinvite' => 'Convite de Usuários',
        'teacherdashboard' => 'Painel do Professor',
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
    // Dialogs
    'dialog' => [
        'deleteinvite' => 'Você realmente deseja deletar o convite?',
    ],
];

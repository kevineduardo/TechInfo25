<?php

use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
        	'id' => 1,
            'title' => 'Notícias',
            'text' => '',
            'navbar_icon' => 'glyphicon-list-alt',
            'type' => 2,
            'custom_url' => 'notícias',
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 2,
            'title' => 'Fotos',
            'text' => '',
            'navbar_icon' => 'glyphicon-picture',
            'type' => 2,
            'custom_url' => 'fotos',
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 3,
            'title' => 'Histórico da Escola',
            'text' => 'Assim como todo ser humano tem sua história, a escola também tem a sua. História que é construída a cada momento pela comunidade escolar, através de ações e palavras. É uma história vivida, uma história de vida.
Dessa forma, a escola Técnica Estadual 25 de julho de Ijuí – RS tem sua história iniciada em 17 de novembro de 1960, por meio do Decreto de Criação nº 11781, com a denominação de Escola de Ensino Técnico Industrial.
Ao longo dos 50 anos, muito se fez por este estabelecimento. Nele passaram muitos professores e alunos, todos de alguma forma marcaram a sua presença e deram a Escola Técnica Estadual 25 de Julho o perfil que hoje possui.
Atualmente o corpo docente é formado por 115 professores que buscam ampliar os horizontes de aproximadamente 2000 alunos, oportunizando a eles a construção de novos conhecimentos a nível de Educação Básica e Educação Profissional. Neste contexto, a escola conta com o trabalho de 18 funcionários. Durante o ano letivo, a escola busca desenvolver o currículo da Educação Básica - atendendo alunos do Ensino Fundamental (em processo de fechamento) e Ensino Médio diurno - com matrícula por série e Ensino Médio noturno – Matrícula Por Disciplina. Na Educação Profissional temos, os cursos Técnico em Eletrotécnica, Técnico em Mecânica, Técnico em Informática e Técnico em Móveis.
Tanto na Educação Básica como na Profissional, buscamos desenvolver ações cooperativas, conscientes, críticas e criadoras, fundamentadas na realidade e na participação da comunidade escolar, visando a formação integral, onde os valores como a solidariedade, a responsabilidade, o respeito, a ética, a justiça, a afetividade, o diálogo, o espírito crítico e a vida, são a base da prática cotidiana, efetivada através do envolvimento e engajamento de todos na construção coletiva da escola, como espaço de convivência, com possibilidades de experiências e relações que promovam o desenvolvimento integral do sujeito e do grupo em que está inserido.
Para efetivamente atingir o desenvolvimento integral, a escola oportuniza a todos a participação em atividades além da sala de aula, dos muros da escola, abrindo espaços para a Diversidade Cultural com oficinas de Capoeira, de Dança, com eventos como o “25 em Dança” e “Festival de Talentos”, oportunizando a participação dos alunos em Gincanas e o desenvolvimento de Projetos de cunho social, viagens de estudos organizada pelos professores de forma interdisciplinar, participação dos alunos nos Jogos Escolares do RS e dos torneios inter-séries e inter-escolares.
A escola conta ainda, com vários laboratórios de Informática, para a Ed. Básica e Profissional, bem como com laboratórios específicos dentro da área tecnológica de cada curso, onde sempre está presente o desejo de ajudarmos a preparar pessoas para a vida e para o mundo do trabalho.
Nos anos de caminhada da escola muitos foram os alunos do município de Ijuí, da região noroeste colonial, e por que não dizer do Rio Grande do Sul que buscaram e buscam a escola para construir seu aprendizado. A justificativa desta busca é percebida quando alunos da nossa escola conquistam a 1ª ou 2ª colocação no Exame Nacional do Ensino Médio no âmbito das Escola Públicas de Ijuí por anos consecutivos, passando em vestibulares de cursos de difícil ingresso nas Universidades Federais, Estaduais e Particulares do Rio Grande do Sul e do Brasil. Também é percebida a qualidade do ensino quando os alunos e ex-alunos conquistam as melhores colocações em Concursos Públicos de Nível Técnico, ou continuidade de formação profissional e de prática em universidades e empresas no exterior.
Como reconhecimento desse trabalho no mês de junho de 2010, a escola recebeu a visita do Superintendente da Educação Profissional do RS, que juntamente com o Diretor, o Presidente do Conselho Escolar e a Coordenadora de Educação da 36ª CRE, num ato comemorativo assinaram o termo de Adesão ao Centro Estadual de Referência em Educação Profissional.
Muito se fez nos 50 anos de caminhada. Muito continua se fazendo e há muito ainda por fazer. A história continua sendo construída por todos que participam desta caminhada.
• DIREÇÃO
Diretora:
Vice-Diretora Manhã:
Vice-Diretora Tarde: Profª. Marilei Rosanelli Barriquello
Vice-Diretora Noite: Profª. Solange Koltermann',
            'navbar_icon' => 'glyphicon-hand-right',
            'type' => 1,
            'author_id' => 1,
        ]);
		DB::table('pages')->insert([
			'id' => 4,
            'title' => 'O Curso',
            'text' => 'Duração do Curso: 2 anos (4 semestres)
Estágio: 1 semestre
O que faz o Técnico:
Desenvolve sistemas utilizando ambientes de programação diversificados. Utiliza sistemas operacionais e banco de dados. Desenvolve websites para internet. Realiza manutenção de computadores em ambiente local ou em rede. Instalação e configuração de softwares. Implementa, executa diagnóstico e corrige falhas em relevância à redes de computadores.
Coordenadora: Profª. Luciana de Oliveira Ramos. ',
            'navbar_icon' => 'glyphicon-hand-right',
            'type' => 1,
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 5,
            'title' => 'Calendário Escolar',
            'text' => '',
            'navbar_icon' => 'glyphicon-calendar',
            'type' => 2,
            'custom_url' => 'calendário',
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 6,
            'title' => 'Organização Curricular',
            'text' => '',
            'navbar_icon' => 'glyphicon-blackboard',
            'type' => 1,
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 7,
            'title' => 'Docentes',
            'text' => '',
            'navbar_icon' => 'glyphicon-briefcase',
            'type' => 1,
            'custom_url' => 'docentes',
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 8,
            'title' => 'Horários',
            'text' => 'A Escola Técnica Estadual 25 de Julho, funciona nos turnos da Manhã Tarde e Noite, de segunda a sexta-feira e em alguns sábabos préviamente definidos no calendário do ano letivo, nos seguintes horários:
Manhã: 7h30min às 11h45min
Tarde: 13h15min às 17h30min
Noite: 18h50min às 22h45min ',
            'navbar_icon' => 'glyphicon-bell',
            'type' => 1,
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 9,
            'title' => 'Matrículas',
            'text' => '',
            'navbar_icon' => 'glyphicon-send',
            'type' => 2,
            'custom_url' => 'matrículas',
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 10,
            'title' => 'Formulário',
            'text' => '',
            'navbar_icon' => 'glyphicon-envelope',
            'type' => 2,
            'custom_url' => 'contato',
            'author_id' => 1,
        ]);
        DB::table('pages')->insert([
        	'id' => 11,
            'title' => 'Mapa de Localização da Escola',
            'text' => '',
            'navbar_icon' => 'glyphicon-map-marker',
            'type' => 2,
            'custom_url' => 'localização',
            'author_id' => 1,
        ]);
        DB::table('categories')->insert([
        	'id' => 1,
            'name' => 'Início',
            'icon' => 'glyphicon-home',
        ]);
        DB::table('categories')->insert([
        	'id' => 2,
            'name' => 'Institucional',
            'icon' => 'glyphicon-book',
        ]);
        DB::table('categories')->insert([
        	'id' => 3,
            'name' => 'Ensino',
            'icon' => 'glyphicon-education',
        ]);
        DB::table('categories')->insert([
        	'id' => 4,
            'name' => 'Contato',
            'icon' => 'glyphicon-phone-alt',
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 1,
            'category_id' => 1,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 2,
            'category_id' => 1,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 3,
            'category_id' => 2,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 4,
            'category_id' => 2,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 5,
            'category_id' => 2,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 6,
            'category_id' => 3,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 7,
            'category_id' => 3,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 8,
            'category_id' => 3,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 9,
            'category_id' => 3,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 10,
            'category_id' => 4,
        ]);
        DB::table('categories_pages')->insert([
            'page_id' => 11,
            'category_id' => 4,
        ]);
    }
}

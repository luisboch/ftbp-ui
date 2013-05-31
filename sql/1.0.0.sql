create table departamento(
	id serial primary key,
	nome character varying(200) not null,
        data_criacao timestamp not null default now()
);

create table grupos(
        id serial primary key, 
        nome character varying (100) not null,
        data_criacao timestamp not null default now()
);

create table usuarios(
	id serial primary key,
	nome character varying(200) not null,
	email character varying(200) not null,
	senha character varying(200) not null,
	data_criacao timestamp not null default now(),
        grupo_id integer not null,
	departamento_id integer,
        responsavel boolean default false not null,
        tipo_usuario integer not null,
        constraint fk_usuario_departamento foreign key(departamento_id)
            references departamento(id),
        constraint fk_usuario_grupo foreign key(grupo_id)
            references grupos(id)
        
);

create table pesquisa(
	id serial primary key,
	tipo character varying (60) not null,
	entidade_id integer not null,
	titulo character varying (300) not null,
	descricao character varying (500) not null,
	link character varying (500) not null
);

create table palavras_chave(
	pesquisa_id integer not null,
	palavra character varying(100) not null,
	constraint fk_palavra_pesquisa foreign key(pesquisa_id) 
		references pesquisa(id)
);

create index idx_pesquisa_tipo_entidade on pesquisa (tipo, entidade_id);
create index idx_pesquisa_palavra on palavras_chave (palavra);

create table notificacoes(
	id serial primary key,
	usuario_id integer not null,
	descricao character varying (1000) not null,
	excluida boolean not null default false,
	visualizada boolean not null default false,
	data timestamp not null, 
	data_expiracao timestamp not null,
	data_criacao timestamp not null default now(),
        link character varying (1000) not null,
	constraint fk_notificacao_usuario foreign key(usuario_id)
	references usuarios(id)
);
create table area_curso
(
  id serial primary key,
  nome character varying(200) not null,
  data_criacao timestamp not null default now()
);

create table aviso
(
  id serial not null,
  titulo character varying(200) not null,
  descricao character varying(1000) not null,
  data_criacao timestamp without time zone not null DEFAULT now(),
  usuario_id integer not null,
  excluida boolean,
  constraint avisos_pkey primary key(id),
  constraint fk_usuario foreign key(usuario_id)
      references usuarios (id) 
);

create table aviso_destinatario
(
  aviso_id integer not null,
  usuario_id integer not null,
  lido boolean default false,
  excluida boolean default false,
  constraint pk_aviso_destinatario primary key(aviso_id, usuario_id),
  constraint fk_aviso foreign key(aviso_id)
      references aviso (id),
  constraint fk_destinatario_usuario foreign key(usuario_id)
      references usuarios (id) 
);

create table requisicoes
(
  id serial not null,
  titulo character varying(500) not null,
  descricao text not null,
  usuario_id integer not null,
  criado_por integer not null,
  data_criacao timestamp without time zone not null default now(),
  status character varying(50),
  prioridade character varying(15),
  fechado_por integer,
  data_fechamento timestamp,
  constraint requisicoes_pkey primary key(id),
  constraint fk_usuario_requisicao foreign key(usuario_id)
      references usuarios (id),
  constraint fk_usuario_requisicao_criador foreign key(criado_por)
      references usuarios (id),
  constraint fk_usuario_requisicao_fechado_por foreign key(fechado_por)
      references usuarios (id)
);

create table requisicoes_iteracoes(
	requisicao_id integer not null,
	usuario_id integer not null,
	mensagem text not null,
	data_criacao timestamp default now() not null,
	constraint fk_iteracao_requisicao
		foreign key(requisicao_id)
		references requisicoes(id),
	constraint fk_iteracao_usuario
		foreign key(usuario_id)
		references usuarios(id)
);

create table curso
(
  id serial not null,
  nome character varying(200) not null,
  descricao character varying(1000) not null,
  data_vestibular date,
  coordenador character varying(200),
  email character varying(200),
  corpo_docente character varying(1000),
  publico_alvo character varying(200),
  valor real,
  duracao real,
  videoapres character varying(5000) not null,
  areacurso_id integer,
  nivelgraduacao character varying(200),
  contatosecretaria character varying(200),
  credito integer,
  data_criacao timestamp not null default now(),
  excluida boolean,
  acessos integer not null default 0,
  constraint curso_pkey primary key(id),
  constraint curso_areacurso_id_fkey foreign key(areacurso_id)
      references area_curso (id) 
);

create table curso_arquivos(
    curso_id integer not null,
    departamento_id integer not null, 
    descricao character varying (200) not null,
    caminho character varying (200) not null,
    data_upload timestamp not null default now(),
    usuario_id integer not null, 
    constraint arquivo_curso foreign key (curso_id) 
        references curso(id),
    constraint arquivo_departamento foreign key (departamento_id) 
        references departamento(id),
    constraint arquivo_usuario foreign key (usuario_id) 
        references usuarios(id),
    constraint pk_cursos_arquivos primary key(curso_id, departamento_id, caminho)
);

create table evento
(
  id serial not null,
  titulo character varying(200) not null,
  data_criacao timestamp not null default now(),
  descricao character varying(4000) not null,
  data timestamp without time zone,
  local character varying(200),
  contato character varying(200),
  excluida boolean,
  constraint pk_evento_id primary key(id)
);

create table grupo_acesso(
	grupo_id integer not null,
	acesso integer not null, 
	escrita boolean not null default false,
	constraint pk_grupo_acesso primary key (grupo_id, acesso),
	constraint fk_grupo_gacesso foreign key (grupo_id)
		references grupos(id)
);
 
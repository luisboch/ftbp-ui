create table departamento(
	id serial primary key,
	nome character varying(200),
        data_criacao timestamp not null default now()
);

create table usuarios(
	id serial primary key,
	nome character varying(200) not null,
	email character varying(200) not null,
	senha character varying(200) not null,
	data_criacao timestamp not null default now(),
	departamento_id integer,
        responsavel boolean default false not null,
        tipo_usuario integer not null,
        constraint fk_usuario_departamento foreign key (departamento_id)
        references departamento(id)
        
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
	constraint fk_palavra_pesquisa foreign key (pesquisa_id) 
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
	constraint fk_notificacao_usuario foreign key (usuario_id)
	references usuarios(id)
);

create table nivel_curso(
	id serial primary key,
	nome character varying(200),
        data_criacao timestamp not null default now()
);


create table area_curso
(
  id serial primary key,
  nome character varying(200),
  data_criacao timestamp not null default now()
);
CREATE TABLE aviso
(
  id serial NOT NULL,
  titulo character varying(200) NOT NULL,
  descricao character varying(1000) NOT NULL,
  data_criacao timestamp without time zone NOT NULL DEFAULT now(),
  usuario_id integer NOT NULL,
  excluida boolean,
  CONSTRAINT avisos_pkey PRIMARY KEY (id),
  CONSTRAINT fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE aviso_destinatario
(
  aviso_id integer NOT NULL,
  usuario_id integer NOT NULL,
  lido boolean default false,
  excluida boolean default false,
  CONSTRAINT pk_aviso_destinatario PRIMARY KEY (aviso_id, usuario_id),
  CONSTRAINT fk_aviso FOREIGN KEY (aviso_id)
      REFERENCES aviso (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_destinatario_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

create table requisicoes
(
  id serial NOT NULL,
  titulo character varying(500) NOT NULL,
  descricao text NOT NULL,
  usuario_id integer NOT NULL,
  criado_por integer NOT NULL,
  data_criacao timestamp without time zone NOT NULL DEFAULT now(),
  status character varying(50),
  prioridade character varying(15),
  constraint requisicoes_pkey PRIMARY KEY (id),
  constraint fk_usuario_requisicao foreign key (usuario_id)
      references usuarios (id) 
  constraint fk_usuario_requisicao_criador foreign key (criado_por)
      references usuarios (id)
);

create table requisicoes_iteracoes(
	requisicao_id integer not null,
	usuario_id integer not null,
	mensagem text not null,
	data_criacao timestamp default now() not null,
	constraint fk_iteracao_requisicao
		foreign key (requisicao_id)
		references requisicoes(id),
	constraint fk_iteracao_usuario
		foreign key (usuario_id)
		references usuarios(id)
);
CREATE TABLE curso
(
  id serial NOT NULL,
  nome character varying(200) NOT NULL,
  descricao character varying(1000) NOT NULL,
  data_vestibular date,
  coordenador character varying(200),
  email character varying(200),
  corpo_docente character varying(1000),
  publico_alvo character varying(200),
  valor real,
  duracao real,
  videoapres character varying(5000) NOT NULL,
  areacurso_id integer,
  nivelgraduacao character varying(200),
  contatosecretaria character varying(200),
  excluida boolean,
  CONSTRAINT curso_pkey PRIMARY KEY (id),
  CONSTRAINT curso_areacurso_id_fkey FOREIGN KEY (areacurso_id)
      REFERENCES area_curso (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
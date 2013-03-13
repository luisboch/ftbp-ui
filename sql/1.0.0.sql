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
	departamento_id integer not null,
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

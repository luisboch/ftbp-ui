create table grupo(
	id serial primary key,
	nome  character varying(200),
	data_criacao timestamp
);

create table usuarios(
	id serial primary key,
	nome character varying(200),
	email character varying(200),
	senha character varying(200),
	data_criacao timestamp not null default now(),
	grupo_id integer,
	constraint fk_usu_grupo foreign key (grupo_id)
		references grupo(id)
);
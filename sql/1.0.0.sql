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

create table nivel_curso(
	id serial primary key,
	nome character varying(200),
        data_criacao timestamp not null default now()
);
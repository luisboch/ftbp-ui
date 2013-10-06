-- Drop old columns
alter table curso drop column coordenador; 
alter table curso drop column email;
alter table curso drop column credito;
alter table curso drop column contatosecretaria;

-- Create new columns
alter table curso add column coordenador_id integer;
alter table curso add column contato_id integer;
alter table curso add constraint fk_contato foreign key (contato_id)
	references usuarios(id);
alter table curso add constraint fk_coordenador foreign key (coordenador_id)
	references usuarios(id);

alter table evento drop column contato;
alter table evento add column contato_id integer;
alter table evento add constraint fk_evt_contato foreign key (contato_id)
	references usuarios(id);


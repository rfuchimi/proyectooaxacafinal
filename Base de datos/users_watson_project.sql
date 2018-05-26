create table users (
	id int auto_increment primary key,
    email varchar(120) not null,
    password varchar(32) not null,
    persona_id int not null,
    foreign key (persona_id) references cat_persona(per_id)
);


insert into 
cat_persona(per_nombre, per_apellidoPaterno, per_apellidoMaterno, per_fechaNacimiento, per_sexo, per_curp, per_rfc, per_tipo, per_numeroTelefono)
values('Daniel', 'Vásquez', 'Pinacho', '1992-05-29', 'H', 'VAPD920529HOCSN06', 'RFC', 'F', 00);

insert into
	users(email, password, persona_id)
values
	('daniel.pinacho@gmail.com', '762e0cd5f1b0cd72e27dccf6b7ca2053', 1501);
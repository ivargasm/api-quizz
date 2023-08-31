create table degrees(
	id int not null auto_increment,
	code varchar(50) not null,
	description varchar(250) not null,
	created_at date,
	updated_at date,
	constraint pk_degree_id primary key (id)
);

create table roles(
    id int not null auto_increment,
    description varchar(250) not null,
    created_at date,
    updated_at date,
    constraint pk_role_id primary key (id)
);

create table users(
	id int not null auto_increment
    email varchar(250) not null,
    password varchar(250) not null,
    role_id int not null,
    created_at date,
    updated_at date,
    constraint pk_user_id primary key (id),
    constraint fk_user_role foreign key (role_id) references roles(id)
);

create table topics(
    id int not null auto_increment,
    description varchar(500) not null,
    degree_id int not null,
    created_at date,
    updated_at date,
    constraint pk_topic_id primary key (id),
    constraint fk_topic_degree foreign key (degree_id) references degrees(id)
)

create table questions(
    id int not null auto_increment,
    description varchar(500) not null,
    code varchar(500),
    degree_id int not null,
    topic_id int not null,
    partial int,
    user_id int not null,
    created_at date,
    updated_at date,
    constraint pk_question_id primary key (id),
    constraint fk_question_degree foreign key (degree_id) references degrees(id),
    constraint fk_question_user foreign key (user_id) references users(id),
    constraint fk_question_topic foreign key (topic_id) references topics(id)
);

create table answers(
    id int not null auto_increment,
    description varchar(500) not null,
    correct_answer bool not null,
    question_id int not null,
    user_id int not null,
    created_at date,
    updated_at date,
    constraint pk_answer_id primary key (id),
    constraint fk_answer_question foreign key (question_id) references questions(id),
    constraint fk_answer_user foreign key (user_id) references users(id)
);


-- carga de datos
-- roles
insert into roles(description, created_at, updated_at) values('admin', now(), now());

-- users
insert into users(email, password, role_id, created_at, updated_at)
values('ivargasm@hotmail.com', 'ivSm7018', 1, now(), now());

-- degrees
insert into degrees(code, description, created_at, updated_at)
values('LD', 'Derecho', now(), now());

-- topics
insert into topics(description, degree_id, created_at, updated_at)
values('Derecho Administrativo', 1, now(), now());

-- questions
insert into questions(description, degree_id, topic_id, partial, user_id, created_at, updated_at)
values('¿Menciona en donde y en qué siglo surge el estudio del Derecho Administrativo como?', 1, 1, 1, 1, now(), now());

insert into questions(description, degree_id, topic_id, partial, user_id, created_at, updated_at)
values('¿De acuerdo con la ley, menciona cual es la fuente inobjetable?', 1, 1, 1, 1, now(), now());

-- answers
insert into answers(description, correct_answer, question_id, user_id, created_at, updated_at)
values('Siglo XIX en Francia', 1, 1, 1, now(), now());

insert into answers(description, correct_answer, question_id, user_id, created_at, updated_at)
values('Siglo XIX en España', 0, 1, 1, now(), now());

insert into answers(description, correct_answer, question_id, user_id, created_at, updated_at)
values('Siglo XX en Francia', 0, 1, 1, now(), now());

insert into answers(description, correct_answer, question_id, user_id, created_at, updated_at)
-- values('La Jurisprudencia', 0, 2, 1, now(), now());
-- values('La ley', 1, 2, 1, now(), now());
-- values('La Costumbre', 0, 2, 1, now(), now());
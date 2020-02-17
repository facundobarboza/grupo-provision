------------------------------------------------------------------- ESQUEMAS
-------------------------------------------------------------------
CREATE SCHEMA sitio_recibo_sueldo_digital
  AUTHORIZATION projekt;


------------------------------------------------------------------- TABLAS
-------------------------------------------------------------------
-- sitio_recibo_sueldo_digital

-- DROP TABLE sitio_recibo_sueldo_digital.bruteforce_ip;
CREATE TABLE sitio_recibo_sueldo_digital.bruteforce_ip
(
  id serial NOT NULL,
  ip_address character varying(16) NOT NULL DEFAULT '0'::character varying,
  last_activity integer NOT NULL DEFAULT 0,
  blocked boolean NOT NULL DEFAULT false,
  fails smallint NOT NULL DEFAULT 0,
  CONSTRAINT id_bruteforce_ip PRIMARY KEY (id),
  CONSTRAINT unica_ip UNIQUE (ip_address)
)
WITHOUT OIDS;
ALTER TABLE sitio_recibo_sueldo_digital.bruteforce_ip OWNER TO projekt;


-- DROP TABLE sitio_recibo_sueldo_digital.sesion;
CREATE TABLE sitio_recibo_sueldo_digital.sesion
(
  session_id character varying(40) NOT NULL DEFAULT '0'::character varying,
  ip_address character varying(16) NOT NULL DEFAULT '0'::character varying,
  user_agent character varying(120) NOT NULL,
  last_activity integer NOT NULL DEFAULT 0,
  user_data text NOT NULL DEFAULT ''::text,
  CONSTRAINT pk_sesion PRIMARY KEY (session_id),
  CONSTRAINT last_activity_positivo CHECK (last_activity >= 0)
)
WITHOUT OIDS;
ALTER TABLE sitio_recibo_sueldo_digital.sesion OWNER TO projekt;


-- DROP TABLE sitio_recibo_sueldo_digital.contrasenia;
CREATE TABLE sitio_recibo_sueldo_digital.contrasenia
(
  id_legajo serial NOT NULL,
  contrasenia text NOT NULL,
  CONSTRAINT pk_contrasenia PRIMARY KEY (id_legajo)
)
WITHOUT OIDS;
ALTER TABLE sitio_recibo_sueldo_digital.contrasenia OWNER TO projekt;


-- DROP TABLE sitio_recibo_sueldo_digital.log;
CREATE TABLE sitio_recibo_sueldo_digital.log
(
  id serial NOT NULL,
  fecha timestamp without time zone NOT NULL DEFAULT now(),
  id_legajo integer NOT NULL,
  id_tipo_log smallint NOT NULL,
  CONSTRAINT pk_log PRIMARY KEY (id)
)
WITHOUT OIDS;
ALTER TABLE sitio_recibo_sueldo_digital.log OWNER TO projekt;


-- DROP TABLE sitio_recibo_sueldo_digital.tipo_log;
CREATE TABLE sitio_recibo_sueldo_digital.tipo_log
(
  id smallint NOT NULL,
  nombre character varying(200) NOT NULL,
  CONSTRAINT pk_tipo_log PRIMARY KEY (id)
)
WITHOUT OIDS;
ALTER TABLE sitio_recibo_sueldo_digital.tipo_log OWNER TO projekt;


-- DROP TABLE sitio_recibo_sueldo_digital.captcha;
CREATE TABLE sitio_recibo_sueldo_digital.captcha
(
  captcha_id bigserial NOT NULL,
  captcha_time integer NOT NULL,
  ip_address character varying(16) NOT NULL DEFAULT 0,
  word character varying(20) NOT NULL,
  CONSTRAINT pk_captcha PRIMARY KEY (captcha_id)
)
WITHOUT OIDS;
ALTER TABLE sitio_recibo_sueldo_digital.captcha
  OWNER TO projekt;


------------------------------------------------------------------- RESTRICCIONES
-------------------------------------------------------------------
-- sitio_recibo_sueldo_digital
ALTER TABLE sitio_recibo_sueldo_digital.log
ADD CONSTRAINT fk_tipo_log FOREIGN KEY (id_tipo_log)
REFERENCES sitio_recibo_sueldo_digital.tipo_log (id)
ON UPDATE CASCADE ON DELETE RESTRICT;


------------------------------------------------------------------- DATOS Y SECUENCIAS
-------------------------------------------------------------------
-- sitio_recibo_sueldo_digital
INSERT INTO sitio_recibo_sueldo_digital.tipo_log (id, nombre) VALUES (1, 'Iniciar Sesión');
INSERT INTO sitio_recibo_sueldo_digital.tipo_log (id, nombre) VALUES (2, 'Cerrar Sesión');
INSERT INTO sitio_recibo_sueldo_digital.tipo_log (id, nombre) VALUES (3, 'Actualizar perfil');
INSERT INTO sitio_recibo_sueldo_digital.tipo_log (id, nombre) VALUES (4, 'Descargar recibo de sueldo');

/*
INSERT INTO permiso.usuario
(alias, contrasenia, nombre, apellido, email, id_grupo, vigencia)
VALUES
('admin', '$2a$08$cpRBqNLEA4vIOKHpF7uEWOcVe6O0TbR5DVvtlVP3U0AIxzM2x07n6', 'admin', 'admin', 'admin@email.com', 2, 't');
INSERT INTO permiso.usuario
(alias, contrasenia, nombre, apellido, email, id_grupo, vigencia)
VALUES
('programador', '$2a$08$iQlvO80nibw3Z.dRPMLLbe4oqC/otVe84/cB.nx1po0IHYFT.NqHu', 'Programador', 'Programador', 'programador@email.com', 1, 't');
*/
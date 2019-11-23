CREATE OR REPLACE FUNCTION generar_movilizaciones(id integer, type integer,
  presupuesto integer, asistencia integer, comuna varchar, ong varchar, proy_name varchar, content varchar)
RETURNS void AS
$$
BEGIN
    IF type < 1 THEN
            INSERT INTO movilizacion (id, presupuesto, tipo) VALUES (id, presupuesto, 'marcha');
            INSERT INTO movilizacionmarcha (id, asistencia, lugar) VALUES (id, asistencia, comuna);
            INSERT INTO convocan (id_movilizacion, nombre_ong, nombre_proyecto, fecha) VALUES (id, ong, proy_name, CURRENT_DATE + 90);
    ELSE
            INSERT INTO movilizacion (id, presupuesto, tipo) VALUES (id, presupuesto, 'redes sociales');
            INSERT INTO movilizacionredes (id, tipo_contenido, duracion) VALUES (id, content, 90);
            INSERT INTO convocan (id_movilizacion, nombre_ong, nombre_proyecto, fecha) VALUES (id, ong, proy_name, CURRENT_DATE);
    END IF;
END
$$ language plpgsql;

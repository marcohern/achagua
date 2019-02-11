-- YEAR, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year, i.state_id AS sid, s.name AS state, 
SUM(i.amount) AS incidents, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice

FROM states s
LEFT JOIN incidents_summary i ON s.id = i.state_id
WHERE i.event_date = '2003-01-01'
GROUP BY sid, state;

-- STATE, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year,
SUM(i.amount) AS incidents, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i
INNER JOIN states s ON s.id = i.state_id
WHERE s.id = 27
GROUP BY year
;

-- STATE, YEAR, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year,
SUM(i.amount) AS incidents, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice

FROM incidents_summary i
WHERE i.state_id = 47
GROUP BY year
ORDER BY year DESC
LIMIT 10
;

-- STATE DETAILS, INCIDENTS
-- EXPLAIN
SELECT i.city_id AS cid, c.name AS city,
SUM(i.amount) AS incidents, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice

FROM incidents_summary i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE i.state_id = 47
GROUP BY cid, city
;

-- STATE DETAILS, YEAR, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year,
	i.city_id AS cid, c.name AS city,
SUM(i.amount) AS incidents, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE i.state_id = 47 AND i.event_date = '2004-01-01'
GROUP BY year,
-- 	sid, state,
    cid, city
    
;

-- CITY DETAILS, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year,
--     i.state_id AS sid, s.name AS state,
--     i.city_id AS cid, c.name AS city,
--     i.lat AS lat, i.lng AS lng,
SUM(i.amount) AS incidents, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE c.id = 47001
GROUP BY year
-- 	sid, state,
--  cid, city
-- 	lat, lng
;

-- CITY DETAILS, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) as year, 
SUM(i.amount) AS incidents, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE i.city_id = 47001
GROUP BY year
-- 	sid, state,
--  cid, city
-- 	lat, lng
;
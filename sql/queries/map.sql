-- YEAR, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year, i.state_id AS sid, s.name AS state, SUM(i.amount) AS incidents,
SUM(i.v_psicoemocional) AS v_ps, SUM(i.v_sexual) AS v_sx, SUM(i.v_fisica) AS v_fs,
SUM(i.v_economica) AS v_ec, SUM(i.v_patrimonial) AS v_pt, SUM(i.v_multiple) AS v_mu,
SUM(i.v_feminicidio) AS v_fm, SUM(i.justice) AS justice

FROM states s
LEFT JOIN incidents_summary i ON s.id = i.state_id
WHERE i.event_date = '2003-01-01'
GROUP BY sid, state;

-- STATE, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year,
SUM(i.amount) AS incidents, 
SUM(i.v_psicoemocional) AS v_ps, SUM(i.v_sexual) AS v_sx, SUM(i.v_fisica) AS v_fs,
SUM(i.v_economica) AS v_ec, SUM(i.v_patrimonial) AS v_pt, SUM(i.v_multiple) AS v_mu,
SUM(i.v_feminicidio) AS v_fm, SUM(i.justice) AS justice

FROM incidents_summary i
INNER JOIN states s ON s.id = i.state_id
WHERE s.id = 27
GROUP BY year
;

-- STATE, YEAR, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year,
SUM(i.amount) AS incidents,
SUM(i.v_psicoemocional) AS v_ps, SUM(i.v_sexual) AS v_sx, SUM(i.v_fisica) AS v_fs,
SUM(i.v_economica) AS v_ec, SUM(i.v_patrimonial) AS v_pt, SUM(i.v_multiple) AS v_mu,
SUM(i.v_feminicidio) AS v_fm, SUM(i.justice) AS justice

FROM incidents_summary i
WHERE i.state_id = 47
GROUP BY year
ORDER BY year DESC
LIMIT 10
;

-- STATE DETAILS, INCIDENTS
-- EXPLAIN
SELECT i.city_id AS cid, c.name AS city,
SUM(i.amount) AS incidents,
SUM(i.v_psicoemocional) AS v_ps, SUM(i.v_sexual) AS v_sx, SUM(i.v_fisica) AS v_fs,
SUM(i.v_economica) AS v_ec, SUM(i.v_patrimonial) AS v_pt, SUM(i.v_multiple) AS v_mu,
SUM(i.v_feminicidio) AS v_fm, SUM(i.justice) AS justice

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
SUM(i.amount) AS incidents, SUM(i.v_psicoemocional) AS v_ps, SUM(i.v_sexual) AS v_sx, SUM(i.v_fisica) AS v_fs,
SUM(i.v_economica) AS v_ec, SUM(i.v_patrimonial) AS v_pt, SUM(i.v_multiple) AS v_mu,
SUM(i.v_feminicidio) AS v_fm, SUM(i.justice) AS justice
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
SUM(i.amount) AS incidents, SUM(i.v_psicoemocional) AS v_ps, SUM(i.v_sexual) AS v_sx, SUM(i.v_fisica) AS v_fs,
SUM(i.v_economica) AS v_ec, SUM(i.v_patrimonial) AS v_pt, SUM(i.v_multiple) AS v_mu,
SUM(i.v_feminicidio) AS v_fm, SUM(i.justice) AS justice
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
SUM(i.amount) AS incidents, SUM(i.v_psicoemocional) AS v_ps, SUM(i.v_sexual) AS v_sx, SUM(i.v_fisica) AS v_fs,
SUM(i.v_economica) AS v_ec, SUM(i.v_patrimonial) AS v_pt, SUM(i.v_multiple) AS v_mu,
SUM(i.v_feminicidio) AS v_fm, SUM(i.justice) AS justice
FROM incidents_summary i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE i.city_id = 47001
GROUP BY year
-- 	sid, state,
--  cid, city
-- 	lat, lng
;
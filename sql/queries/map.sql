-- YEAR, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year, i.state_id AS sid, s.name AS state, COUNT(*) AS incidents
FROM incidents i
INNER JOIN states s ON s.id = i.state_id
WHERE i.event_date = '2004-01-01'
GROUP BY sid, state
;

-- STATE, INCIDENTS
-- EXPLAIN
SELECT i.state_id AS sid, s.name AS state, COUNT(*) AS incidents
FROM incidents i
INNER JOIN states s ON s.id = i.state_id
GROUP BY sid, state
;

-- STATE, YEAR, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year, COUNT(*) AS incidents
FROM incidents i
INNER JOIN states s ON s.id = i.state_id
WHERE s.id = 47
GROUP BY year
;

-- STATE DETAILS, INCIDENTS
-- EXPLAIN
SELECT i.city_id AS cid, c.name AS city, COUNT(*) AS incidents
FROM incidents i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE i.state_id = 47
GROUP BY cid, city
;

-- STATE DETAILS, YEAR, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year,
-- 	   i.state_id AS sid, s.name AS state,
       i.city_id AS cid, c.name AS city,
       i.lat AS lat, i.lng AS lng,
       COUNT(*) AS incidents
FROM incidents i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE i.state_id = 47 AND i.event_date = '2004-01-01'
GROUP BY year,
-- 	sid, state,
    cid, city,
    lat, lng
;

-- CITY DETAILS, INCIDENTS
-- EXPLAIN
SELECT YEAR(i.event_date) AS year,
--     i.state_id AS sid, s.name AS state,
--     i.city_id AS cid, c.name AS city,
--     i.lat AS lat, i.lng AS lng,
       COUNT(*) AS incidents
FROM incidents i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE c.id = 47001
GROUP BY year
-- 	sid, state,
--  cid, city
-- 	lat, lng
;
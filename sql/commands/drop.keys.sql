-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
-- Drop all the existing Foreign Key Constraints
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

ALTER TABLE incidents DROP FOREIGN KEY FK_incidents_city_id;

ALTER TABLE cities DROP FOREIGN KEY FK_cities_state_id;

ALTER TABLE states DROP FOREIGN KEY FK_states_country_id;


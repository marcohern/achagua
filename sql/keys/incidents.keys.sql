

ALTER TABLE incidents
ADD CONSTRAINT FK_incidents_city_id
    FOREIGN KEY (city_id)
    REFERENCES cities(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
;



ALTER TABLE incidents
ADD CONSTRAINT FK_incidents_state_id
    FOREIGN KEY (state_id)
    REFERENCES states(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
;

ALTER TABLE incidents
ADD CONSTRAINT FK_incidents_country_id
    FOREIGN KEY (country_id)
    REFERENCES countries(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
;

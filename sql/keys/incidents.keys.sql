

ALTER TABLE incidents
ADD CONSTRAINT FK_incidents_city_id
    FOREIGN KEY (city_id)
    REFERENCES cities(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
;



ALTER TABLE cities
ADD CONSTRAINT FK_cities_state_id
    FOREIGN KEY (state_id)
    REFERENCES states(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
;


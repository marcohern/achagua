
ALTER TABLE states
ADD CONSTRAINT FK_states_country_id
    FOREIGN KEY (country_id)
    REFERENCES countries(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
;


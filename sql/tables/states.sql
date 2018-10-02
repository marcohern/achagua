
DROP TABLE IF EXISTS states;

CREATE TABLE states (
    id INT NOT NULL PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    country_id INT NOT NULL
);


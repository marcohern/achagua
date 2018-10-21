
DROP TABLE IF EXISTS states;

CREATE TABLE states (
    id         INT           NOT NULL PRIMARY KEY,
    name       VARCHAR(128)  NOT NULL,
    country_id INT           NOT NULL,
    lat        DECIMAL(12,9) NOT NULL DEFAULT 0.0,
    lng        DECIMAL(12,9) NOT NULL DEFAULT 0.0,
    zoom       DECIMAL(12,9) NOT NULL DEFAULT 0.0
);


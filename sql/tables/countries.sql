
DROP TABLE IF EXISTS countries;

CREATE TABLE countries (
    id   INT          NOT NULL PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    code CHAR(2)      NOT NULL UNIQUE,
    lat        DECIMAL(12,9) NOT NULL DEFAULT 0.0,
    lng        DECIMAL(12,9) NOT NULL DEFAULT 0.0,
    zoom       DECIMAL(12,9) NOT NULL DEFAULT 0.0
);


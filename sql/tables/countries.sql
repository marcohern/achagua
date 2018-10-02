
DROP TABLE IF EXISTS countries;

CREATE TABLE countries (
    id   INT          NOT NULL PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    code CHAR(2)      NOT NULL UNIQUE
);


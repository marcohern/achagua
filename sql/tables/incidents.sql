
DROP TABLE IF EXISTS incidents;

CREATE TABLE incidents (
    id         INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
    vbg        VARCHAR(16)   NOT NULL DEFAULT '',
    event_date DATETIME      NOT NULL,
    lat        DECIMAL(12,9) NOT NULL DEFAULT 0.0,
    lng        DECIMAL(12,9) NOT NULL DEFAULT 0.0,
    state_id   INT           NOT NULL,
    city_id    INT           NOT NULL,
    justice    MEDIUMTEXT    NOT NULL,
    created    DATETIME      NOT NULL,
    updated    DATETIME          NULL
);


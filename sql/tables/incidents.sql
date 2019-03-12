
DROP TABLE IF EXISTS incidents;

CREATE TABLE incidents (
    id         INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
    vbg        SET(
        'PSICOEMOCIONAL', 'SEXUAL'   ,
        'FISICA'        , 'ECONOMICA',
        'PATRIMONIAL'   , 'MULTIPLE' ,
        'FEMINICIDIO'
    )   NOT NULL,
    event_date DATETIME      NOT NULL,
    lat        DECIMAL(12,9) NOT NULL DEFAULT 0.0,
    lng        DECIMAL(12,9) NOT NULL DEFAULT 0.0,
    country_id INT           NOT NULL,
    state_id   INT           NOT NULL,
    city_id    INT           NOT NULL,
    justice    TINYINT       NOT NULL,
    created    DATETIME      NOT NULL,
    updated    DATETIME          NULL,

    INDEX IX_incidents_yscvj (event_date, state_id, city_id, vbg, justice)
);


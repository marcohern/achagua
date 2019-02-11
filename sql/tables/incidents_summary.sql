
DROP TABLE IF EXISTS incidents_summary;

CREATE TABLE incidents_summary(
    id         INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,

    event_date DATETIME      NOT NULL,
    state_id   INT           NOT NULL,
    city_id    INT           NOT NULL,

    amount     INT           NOT NULL DEFAULT 0,
    
    violencia_psicologica   INT           NOT NULL DEFAULT 0,
    violencia_sexual        INT           NOT NULL DEFAULT 0,
    violencia_patrimonial_economica INT   NOT NULL DEFAULT 0,
    violencia_simbolica     INT           NOT NULL DEFAULT 0,
    acoso_hostigamiento     INT           NOT NULL DEFAULT 0,
    violencia_domestica     INT           NOT NULL DEFAULT 0,
    violencia_laboral       INT           NOT NULL DEFAULT 0,
    violencia_obstetrica    INT           NOT NULL DEFAULT 0,
    violencia_mediatica     INT           NOT NULL DEFAULT 0,
    violencia_institucional INT           NOT NULL DEFAULT 0,

    justice    INT           NOT NULL DEFAULT 0,

    INDEX IX_incidents_summary_yscvj (event_date, state_id, city_id)
);


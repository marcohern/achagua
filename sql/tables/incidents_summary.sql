
DROP TABLE IF EXISTS incidents_summary;

CREATE TABLE incidents_summary(
    id         INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,

    event_date DATETIME      NOT NULL,
    state_id   INT           NOT NULL,
    city_id    INT           NOT NULL,

    amount     INT           NOT NULL DEFAULT 0,
    mult       INT           NOT NULL DEFAULT 0,
    
    v_psicoemocional INT     NOT NULL DEFAULT 0,
    v_sexual         INT     NOT NULL DEFAULT 0,
    v_fisica         INT     NOT NULL DEFAULT 0,
    v_economica      INT     NOT NULL DEFAULT 0,
    v_patrimonial    INT     NOT NULL DEFAULT 0,
    v_multiple       INT     NOT NULL DEFAULT 0,
    v_feminicidio    INT     NOT NULL DEFAULT 0,

    justice    INT           NOT NULL DEFAULT 0,

    INDEX IX_incidents_summary_yscvj (event_date, state_id, city_id)
);


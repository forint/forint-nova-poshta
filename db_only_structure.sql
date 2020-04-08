CREATE TABLE IF NOT EXISTS `nova_poshta`
(
    `id`             int(11)      NOT NULL AUTO_INCREMENT,
    `ip_address`     varchar(255) NOT NULL,
    `start_date`     TIMESTAMP    NOT NULL,
    `end_date`       TIMESTAMP    NOT NULL,
    `diff_date`      int(11)      NOT NULL,
    `execution_time` float(10,10)      NOT NULL,
    `created`        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_general_ci;
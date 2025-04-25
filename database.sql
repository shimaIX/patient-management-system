CREATE DATABASE db_pms;

USE db_pms;

CREATE TABLE IF NOT EXISTS `tbl_patient` (
    `patient_id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `address` TEXT NOT NULL,
    PRIMARY KEY (patient_id)
);
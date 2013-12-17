DROP TABLE schedules
ALTER TABLE  `events` DROP  `schedule_id`
ALTER TABLE  `events` ADD  `name` VARCHAR( 30 ) NOT NULL ,
ADD  `description` TEXT NULL ,
ADD  `date_time` DATETIME NOT NULL ,
ADD  `location` VARCHAR( 100 ) NULL ,
ADD  `created` DATETIME NOT NULL ,
ADD  `modified` DATETIME NOT NULL

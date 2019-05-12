DROP TABLE IF EXISTS `phones`;
DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` ( 
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
    `first_name` VARCHAR(255) NOT NULL , 
    `last_name` VARCHAR(255) NOT NULL , 
    `gender` TINYINT(1) NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `phones` ( 
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , 
    `contact_id` INT UNSIGNED NOT NULL , 
    `phone` VARCHAR(255) NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `phones` 
    ADD CONSTRAINT `phones_contact_id_foreign` 
    FOREIGN KEY (`contact_id`) REFERENCES `contacts`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE;
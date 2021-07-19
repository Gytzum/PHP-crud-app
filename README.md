# PHP CRUD APPLICATION
![CSS-CODE](https://img.shields.io/badge/CSS-CODE-orange)
![HTML-CODE](https://img.shields.io/badge/HTML-CODE-blue)
![PHP-CODE](https://img.shields.io/badge/PHP-CODE-9cf)
![MYSQL-CODE](https://img.shields.io/badge/MYSQL-CODE-yellow)
## This is my second project built in PHP

## CRUD APP features
* See the projects and employees on the data table
* Add new records
* Delete records (Deleting project, employees assigned to that project are deleted too, projects can exist without employees)
* Edit button that allows change name and assign employees to project

## Requirements For Installation
* Integrated development environment (IDE) application
* MySQL WorkBench
* AMPPS or XAMMP

## Installation
* Clone repository to AMPPS or XAMPPS root folder 
* Create MySQL Connection with following information :
    * servername -> localhost  
    * username -> root  
    * password -> mysql  
* Import SQL_dump.sql into MySQL Workbench     
  * or  
* Follow steps bellow : 
```sql
/*! 1 Step */
CREATE DATABASE  IF NOT EXISTS `crud_app`;
USE `crud_app`;

/*! 2 Step */
CREATE TABLE `employees` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  `Project_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proj_id` (`Project_id`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`Project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

/*! 3 Step */
INSERT INTO `employees` VALUES (1,'Maryte',6),(64,'PETRAS',6),(90,'Jonas',8),(91,'Jonukas',6);

/*! 4 Step */
CREATE TABLE `projects` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

/*! 5 Step */
INSERT INTO `projects` VALUES (6,'New York Subway System'),(7,'THE BIG DIG'),(8,'Three Gorges Dam'),(9,'International Space Station');
```
* Open the path where you can launch php interpreter, e.g. http//localhost/browser


## Author
Gytautas [Github](https://github.com/Gytzum) , [LinkedIn](https://www.linkedin.com/in/gytautas-zumaras-4ab552210/)

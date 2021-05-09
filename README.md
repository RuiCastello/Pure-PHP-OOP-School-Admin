# Pure-PHP-OOP-School-Admin
Simple school admin panel, built to refresh my coding skills using just PHP, in a OOP-style.

[DEMO](https://demos.canalfoto.org/php-school-admin/) 

# How-to
- Create a new DB in mysql
- Edit DB.php and add the respective mysql credentials

- Run the following SQL code in your favourite mysql software (phpmyadmin for eg):
```
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `Nif` varchar(15) NOT NULL,
  `Tipo` varchar(15) NOT NULL DEFAULT 'Aluno',
  `Pessoa_Obj` text,
  `Nome` varchar(45) NOT NULL DEFAULT 'Matematica',
  PRIMARY KEY (`Nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilizador`
--

DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `last_token` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_2` (`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilizador`
--

INSERT INTO `utilizador` (`ID`, `username`, `password`, `last_token`) VALUES
(1, 'admin', 'admin', ''),
(2, 'user', '1234', '');
COMMIT;
```

- Visit the website and try out the following login credentials:
> user: user  
> pass: 1234  

<br />

> user: admin  
> pass: admin  

 
$sql = 'CREATE TABLE `users` ('
        . ' `ID` INT NOT NULL AUTO_INCREMENT, '
        . ' `username` VARCHAR(20) NOT NULL, '
        . ' `fname` VARCHAR(20) NOT NULL, '
        . ' `lname` VARCHAR(20) NOT NULL, '
        . ' `email` VARCHAR(50) NOT NULL, '
        . ' `password` VARCHAR(30) NOT NULL, '
        . ' `useragent` VARCHAR(50) NOT NULL, '
        . ' `IP` VARCHAR(15) NOT NULL, '
        . ' `joindate` DATE NOT NULL, '
        . ' `homepage` VARCHAR(100) NOT NULL, '
        . ' `fav1` VARCHAR(100) NOT NULL, '
        . ' `fav2` VARCHAR(100) NOT NULL, '
        . ' `fav3` VARCHAR(100) NOT NULL, '
        . ' `fav4` VARCHAR(100) NOT NULL, '
        . ' `fav5` VARCHAR(100) NOT NULL, '
        . ' `theme` VARCHAR(20) NOT NULL,'
        . ' PRIMARY KEY (`ID`),'
        . ' UNIQUE (`username`, `email`)'
        . ' )'
        . ' TYPE = myisam'; 


CREATE TABLE users (ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username TEXT, fname TEXT, lnameTEXT, email TEXT, password TEXT, useragent TEXT, IP TEXT, joindate DATE, homepage TEXT, fav1 TEXT, fav2TEXT, fav3 TEXT, fav4 TEXT, fav5 TEXT, theme TEXT);
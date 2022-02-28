<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u641509200_full');
define('DB_PASSWORD', 'Dobe1523!');
define('DB_NAME', 'u641509200_yard');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//DB SETUP QUERY (RUN THIS IN DB TO SETUP ALL THE TABLES)

/*
CREATE TABLE `upcoming_deliveries` (  `id` int(11) NOT NULL,  `datetime` datetime NOT NULL DEFAULT current_timestamp(),  `usr` int(11) NOT NULL,  `opt_in` int(1) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;ALTER TABLE `upcoming_deliveries`  ADD PRIMARY KEY (`id`);ALTER TABLE `upcoming_deliveries`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;CREATE TABLE `users` (  `id` int(11) NOT NULL,  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,  `type` int(1) NOT NULL,  `created_at` datetime DEFAULT current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;ALTER TABLE `users`  ADD PRIMARY KEY (`id`),  ADD UNIQUE KEY `username` (`username`);ALTER TABLE `users`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
*/
?>
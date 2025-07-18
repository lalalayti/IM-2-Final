-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+deb12u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2025 at 07:42 PM
-- Server version: 10.11.11-MariaDB-0+deb12u1
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library management`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `isbn` char(13) NOT NULL,
  `date_published` date NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `book_synopsis` text DEFAULT NULL,
  `book_cover` varchar(80) DEFAULT NULL,
  `book_cover_small` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `isbn`, `date_published`, `book_title`, `book_author`, `book_synopsis`, `book_cover`, `book_cover_small`) VALUES
(1, '9780142437209', '1954-06-25', 'Animal Farm', 'George Orwell', 'A political satire where farm animals revolt against their human farmer, only to face new forms of tyranny.', 'https://covers.openlibrary.org/b/isbn/9780142437209-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780142437209-M.jpg'),
(2, '9780061120084', '1960-07-11', 'To Kill a Mockingbird', 'Harper Lee', 'A story of racial injustice and the loss of innocence in a small Southern town.', 'https://covers.openlibrary.org/b/isbn/9780061120084-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780061120084-M.jpg'),
(3, '9780547928227', '1937-09-21', 'The Hobbit', 'J.R.R. Tolkien', 'Bilbo Baggins embarks on an adventure with dwarves and a wizard to reclaim a stolen treasure.', 'https://covers.openlibrary.org/b/isbn/9780547928227-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780547928227-M.jpg'),
(4, '9780743273565', '1925-04-10', 'The Great Gatsby', 'F. Scott Fitzgerald', 'A tale of wealth, love, and the American Dream in the Roaring Twenties.', 'https://covers.openlibrary.org/b/isbn/9780743273565-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780743273565-M.jpg'),
(5, '9780141439600', '1813-01-28', 'Pride and Prejudice', 'Jane Austen', 'A romantic novel exploring love, class, and societal expectations in 19th-century England.', 'https://covers.openlibrary.org/b/isbn/9780141439600-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141439600-M.jpg'),
(6, '9780141187761', '1949-06-08', '1984', 'George Orwell', 'A dystopian novel about totalitarianism and surveillance in a controlled society.', 'https://covers.openlibrary.org/b/isbn/9780141187761-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141187761-M.jpg'),
(7, '9780062315007', '1818-01-01', 'Frankenstein', 'Mary Shelley', 'A scientist creates a monstrous creature, exploring themes of ambition and humanity.', 'https://covers.openlibrary.org/b/isbn/9780062315007-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780062315007-M.jpg'),
(8, '9780140449266', '1869-01-01', 'War and Peace', 'Leo Tolstoy', 'A sweeping epic of love, war, and society during Napoleon’s invasion of Russia.', 'https://covers.openlibrary.org/b/isbn/9780140449266-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780140449266-M.jpg'),
(9, '9780679720201', '1851-10-18', 'Moby-Dick', 'Herman Melville', 'A whaling captain’s obsessive quest for revenge against a giant white whale.', 'https://covers.openlibrary.org/b/isbn/9780679720201-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780679720201-M.jpg'),
(10, '9780141439471', '1847-10-01', 'Jane Eyre', 'Charlotte Brontë', 'An orphaned governess finds love and independence in a mysterious estate.', 'https://covers.openlibrary.org/b/isbn/9780141439471-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141439471-M.jpg'),
(11, '9780553211405', '1860-01-01', 'Great Expectations', 'Charles Dickens', 'A young orphan’s journey through life, shaped by wealth, love, and betrayal.', 'https://covers.openlibrary.org/b/isbn/9780553211405-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780553211405-M.jpg'),
(12, '9780142437247', '1850-08-01', 'The Scarlet Letter', 'Nathaniel Hawthorne', 'A woman faces societal judgment for her sin in Puritan New England.', 'https://covers.openlibrary.org/b/isbn/9780142437247-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780142437247-M.jpg'),
(13, '9780140449334', '1866-01-01', 'Crime and Punishment', 'Fyodor Dostoevsky', 'A man grapples with guilt and morality after committing a murder.', 'https://covers.openlibrary.org/b/isbn/9780140449334-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780140449334-M.jpg'),
(14, '9780060850524', '1951-06-16', 'The Catcher in the Rye', 'J.D. Salinger', 'A rebellious teenager navigates angst and alienation in New York City.', 'https://covers.openlibrary.org/b/isbn/9780060850524-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780060850524-M.jpg'),
(15, '9780143105954', '1884-12-10', 'Adventures of Huckleberry Finn', 'Mark Twain', 'A boy and a runaway slave journey down the Mississippi River.', 'https://covers.openlibrary.org/b/isbn/9780143105954-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780143105954-M.jpg'),
(16, '9780141439747', '1815-12-01', 'Emma', 'Jane Austen', 'A young woman’s matchmaking schemes lead to love and self-discovery.', 'https://covers.openlibrary.org/b/isbn/9780141439747-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141439747-M.jpg'),
(17, '9780140449723', '1865-01-01', 'Alice’s Adventures in Wonderland', 'Lewis Carroll', 'A girl falls into a fantastical world of peculiar characters and adventures.', 'https://covers.openlibrary.org/b/isbn/9780140449723-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780140449723-M.jpg'),
(18, '9780141439662', '1847-12-01', 'Wuthering Heights', 'Emily Brontë', 'A dark tale of love, revenge, and obsession on the Yorkshire moors.', 'https://covers.openlibrary.org/b/isbn/9780141439662-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141439662-M.jpg'),
(19, '9780140449136', '1831-01-01', 'The Hunchback of Notre-Dame', 'Victor Hugo', 'A tragic story of love and fate set in medieval Paris.', 'https://covers.openlibrary.org/b/isbn/9780140449136-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780140449136-M.jpg'),
(20, '9780141439518', '1861-01-01', 'Little Women', 'Louisa May Alcott', 'The lives and loves of four sisters growing up during the Civil War.', 'https://covers.openlibrary.org/b/isbn/9780141439518-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141439518-M.jpg'),
(21, '9780142437346', '1897-05-01', 'Dracula', 'Bram Stoker', 'A gothic horror tale of a vampire’s quest for power and blood.', 'https://covers.openlibrary.org/b/isbn/9780142437346-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780142437346-M.jpg'),
(22, '9780141439587', '1838-04-01', 'Oliver Twist', 'Charles Dickens', 'An orphan navigates a harsh world of crime and poverty in London.', 'https://covers.openlibrary.org/b/isbn/9780141439587-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141439587-M.jpg'),
(23, '9780140449686', '1878-01-01', 'Anna Karenina', 'Leo Tolstoy', 'A tragic story of love, infidelity, and societal pressures in Russia.', 'https://covers.openlibrary.org/b/isbn/9780140449686-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780140449686-M.jpg'),
(24, '9780141439679', '1890-01-01', 'The Picture of Dorian Gray', 'Oscar Wilde', 'A man’s portrait ages while he remains youthful, revealing his moral decay.', 'https://covers.openlibrary.org/b/isbn/9780141439679-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141439679-M.jpg'),
(25, '9780142437254', '1903-01-01', 'The Call of the Wild', 'Jack London', 'A dog’s journey from domestication to survival in the wild Yukon.', 'https://covers.openlibrary.org/b/isbn/9780142437254-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780142437254-M.jpg'),
(26, '9780140449242', '1880-01-01', 'The Brothers Karamazov', 'Fyodor Dostoevsky', 'A family saga exploring faith, morality, and human nature.', 'https://covers.openlibrary.org/b/isbn/9780140449242-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780140449242-M.jpg'),
(27, '9780143104889', '1929-01-01', 'A Farewell to Arms', 'Ernest Hemingway', 'A love story set against the backdrop of World War I.', 'https://covers.openlibrary.org/b/isbn/9780143104889-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780143104889-M.jpg'),
(28, '9780142437179', '1900-01-01', 'Lord Jim', 'Joseph Conrad', 'A sailor’s quest for redemption after abandoning a sinking ship.', 'https://covers.openlibrary.org/b/isbn/9780142437179-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780142437179-M.jpg'),
(29, '9780140449303', '1835-01-01', 'Don Quixote', 'Miguel de Cervantes', 'A delusional knight embarks on chivalric adventures in Spain.', 'https://covers.openlibrary.org/b/isbn/9780140449303-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780140449303-M.jpg'),
(30, '9780141439846', '1899-01-01', 'Heart of Darkness', 'Joseph Conrad', 'A journey into the Congo reveals the horrors of colonialism.', 'https://covers.openlibrary.org/b/isbn/9780141439846-L.jpg', 'https://covers.openlibrary.org/b/isbn/9780141439846-M.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book_reviews`
--

CREATE TABLE `book_reviews` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT 0,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_reviews`
--

INSERT INTO `book_reviews` (`user_id`, `book_id`, `rating`, `comment`) VALUES
(1, 1, 5, 'A brilliant satire on power and corruption.'),
(2, 1, 4, 'Really enjoyed the animal allegory, but it felt a bit heavy at times.'),
(3, 2, 5, 'A must-read for its powerful message on justice.'),
(4, 2, 3, 'Good story, but the pacing was slow for me.'),
(5, 3, 4, 'Fun adventure, great for fantasy lovers.'),
(6, 3, 5, 'Loved Bilbo’s journey and the world-building!'),
(7, 4, 4, 'Beautifully written, but the characters felt distant.'),
(8, 4, 5, 'A tragic yet captivating take on the American Dream.'),
(9, 5, 5, 'Elizabeth Bennet is such a strong character!'),
(10, 5, 4, 'Enjoyed the romance, but some parts were too wordy.'),
(11, 6, 5, 'Chilling and relevant even today.'),
(12, 6, 4, 'A bit depressing but very thought-provoking.'),
(13, 7, 4, 'Fascinating exploration of science and morality.'),
(14, 7, 3, 'Interesting but felt outdated in parts.'),
(15, 8, 5, 'Epic and beautifully written, a masterpiece.'),
(16, 8, 4, 'Long but rewarding read.'),
(17, 9, 3, 'Hard to get through, but the themes were deep.'),
(18, 9, 4, 'Ahab’s obsession was gripping.'),
(19, 10, 5, 'Jane’s resilience is inspiring!'),
(20, 10, 4, 'Great story, but the romance felt rushed.'),
(21, 11, 4, 'Dickens’ storytelling is unmatched.'),
(22, 11, 3, 'Good but too many coincidences.'),
(23, 12, 4, 'Hester’s strength was moving.'),
(24, 12, 5, 'A powerful commentary on society.'),
(25, 13, 5, 'Raskolnikov’s guilt was portrayed so vividly.'),
(26, 13, 4, 'Deep and philosophical, but dense.'),
(27, 14, 4, 'Holden’s voice is so unique.'),
(28, 14, 3, 'Relatable but a bit aimless.'),
(29, 15, 5, 'Huck’s journey is unforgettable.'),
(30, 15, 4, 'Fun and heartfelt, great adventure.');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `item_status` enum('reserved','checked-out','available') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `book_id`, `date_added`, `item_status`) VALUES
(1, 1, '2023-01-01', 'reserved'),
(2, 1, '2023-01-01', 'reserved'),
(3, 2, '2023-01-02', 'available'),
(4, 2, '2023-01-02', 'available'),
(5, 3, '2023-01-03', 'reserved'),
(6, 3, '2023-01-03', 'available'),
(7, 4, '2023-01-04', 'available'),
(8, 4, '2023-01-04', 'available'),
(9, 5, '2023-01-05', 'available'),
(10, 5, '2023-01-05', 'available'),
(11, 6, '2023-01-06', 'available'),
(12, 6, '2023-01-06', 'available'),
(13, 7, '2023-01-07', 'available'),
(14, 7, '2023-01-07', 'available'),
(15, 8, '2023-01-08', 'available'),
(16, 8, '2023-01-08', 'available'),
(17, 9, '2023-01-09', 'available'),
(18, 9, '2023-01-09', 'available'),
(19, 10, '2023-01-10', 'available'),
(20, 10, '2023-01-10', 'available'),
(21, 11, '2023-01-11', 'available'),
(22, 11, '2023-01-11', 'available'),
(23, 12, '2023-01-12', 'available'),
(24, 12, '2023-01-12', 'available'),
(25, 13, '2023-01-13', 'available'),
(26, 13, '2023-01-13', 'available'),
(27, 14, '2023-01-14', 'available'),
(28, 14, '2023-01-14', 'available'),
(29, 15, '2023-01-15', 'available'),
(30, 15, '2023-01-15', 'available'),
(31, 16, '2023-01-16', 'available'),
(32, 16, '2023-01-16', 'available'),
(33, 17, '2023-01-17', 'available'),
(34, 17, '2023-01-17', 'available'),
(35, 18, '2023-01-18', 'available'),
(36, 18, '2023-01-18', 'available'),
(37, 19, '2023-01-19', 'available'),
(38, 19, '2023-01-19', 'available'),
(39, 20, '2023-01-20', 'available'),
(40, 20, '2023-01-20', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `reading_lists`
--

CREATE TABLE `reading_lists` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reading_lists`
--

INSERT INTO `reading_lists` (`user_id`, `book_id`) VALUES
(1, 2),
(1, 3),
(1, 5),
(2, 1),
(2, 4),
(2, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 10),
(4, 11),
(4, 12),
(5, 13),
(5, 14),
(5, 15),
(6, 16),
(6, 17),
(6, 18),
(7, 19),
(7, 20),
(7, 21),
(8, 22),
(8, 23),
(8, 24),
(9, 25),
(9, 26),
(9, 27),
(10, 28),
(10, 29),
(10, 30),
(11, 1),
(11, 2),
(11, 3),
(12, 4),
(12, 5),
(12, 6),
(13, 7),
(13, 8),
(13, 9),
(14, 10),
(14, 11),
(14, 12),
(15, 13),
(15, 14),
(15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_reserved` date NOT NULL,
  `reservation_start` date NOT NULL,
  `reservation_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `account_type` enum('regular','administrator') NOT NULL DEFAULT 'regular'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `middle_name`, `email`, `password`, `account_type`) VALUES
(1, 'John', 'Smith', 'Michael', 'john.smith@email.com', 'password123', 'regular'),
(2, 'Emma', 'Johnson', 'Rose', 'emma.johnson@email.com', 'securepass', 'regular'),
(3, 'Michael', 'Brown', 'James', 'michael.brown@email.com', 'mypassword', 'administrator'),
(4, 'Sarah', 'Davis', 'Elizabeth', 'sarah.davis@email.com', 'pass4321', 'regular'),
(5, 'David', 'Wilson', 'Lee', 'david.wilson@email.com', 'david2025', 'regular'),
(6, 'Laura', 'Martinez', 'Ann', 'laura.martinez@email.com', 'laura789', 'regular'),
(7, 'James', 'Taylor', 'Robert', 'james.taylor@email.com', 'taylorpass', 'regular'),
(8, 'Emily', 'Anderson', 'Jane', 'emily.anderson@email.com', 'emily456', 'regular'),
(9, 'William', 'Thomas', 'Edward', 'william.thomas@email.com', 'willpass', 'regular'),
(10, 'Sophie', 'Jackson', 'Marie', 'sophie.jackson@email.com', 'sophie321', 'regular'),
(11, 'Daniel', 'White', 'Paul', 'daniel.white@email.com', 'daniel987', 'regular'),
(12, 'Olivia', 'Harris', 'Grace', 'olivia.harris@email.com', 'olivia654', 'regular'),
(13, 'Thomas', 'Lewis', 'Henry', 'thomas.lewis@email.com', 'thomas123', 'regular'),
(14, 'Ava', 'Walker', 'Lynn', 'ava.walker@email.com', 'avapass', 'regular'),
(15, 'Charles', 'Hall', 'David', 'charles.hall@email.com', 'charles789', 'administrator'),
(16, 'Mia', 'Allen', 'Kate', 'mia.allen@email.com', 'miapass', 'regular'),
(17, 'Joseph', 'Young', 'Mark', 'joseph.young@email.com', 'joseph456', 'regular'),
(18, 'Isabella', 'King', 'Rose', 'isabella.king@email.com', 'isabella321', 'regular'),
(19, 'Robert', 'Wright', 'John', 'robert.wright@email.com', 'robert987', 'regular'),
(20, 'Charlotte', 'Scott', 'Eve', 'charlotte.scott@email.com', 'charlotte654', 'regular'),
(21, 'Henry', 'Green', 'Adam', 'henry.green@email.com', 'henry123', 'regular'),
(22, 'Amelia', 'Baker', 'Clare', 'amelia.baker@email.com', 'ameliapass', 'regular'),
(23, 'George', 'Adams', 'Luke', 'george.adams@email.com', 'george789', 'regular'),
(24, 'Harper', 'Nelson', 'Faith', 'harper.nelson@email.com', 'harper456', 'regular'),
(25, 'Edward', 'Carter', 'Sam', 'edward.carter@email.com', 'edward321', 'regular'),
(26, 'Evelyn', 'Mitchell', 'Joy', 'evelyn.mitchell@email.com', 'evelyn987', 'regular'),
(27, 'Alexander', 'Perez', 'Dean', 'alexander.perez@email.com', 'alex654', 'regular'),
(28, 'Grace', 'Roberts', 'May', 'grace.roberts@email.com', 'grace123', 'regular'),
(29, 'Jack', 'Turner', 'Neil', 'jack.turner@email.com', 'jackpass', 'regular'),
(30, 'Lily', 'Phillips', 'Beth', 'lily.phillips@email.com', 'lily789', 'regular'),
(31, 'a', 'a', 'a', 'a@a.com', 'a', 'regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `reading_lists`
--
ALTER TABLE `reading_lists`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD CONSTRAINT `book_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `book_reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `reading_lists`
--
ALTER TABLE `reading_lists`
  ADD CONSTRAINT `reading_lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reading_lists_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`item_id`);
COMMIT;

create table `fine` (
fine_id int not null primary key,
user_id int not null,
reservation_id int not null,
amount int not null,
date_issued date not null,
due_date date not null,
return_date date not null,
status varchar(30) not null default 'lacking'
);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

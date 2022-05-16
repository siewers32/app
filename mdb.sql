-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 mei 2022 om 09:43
-- Serverversie: 10.4.21-MariaDB-log
-- PHP-versie: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `movie`
--

CREATE TABLE `movie` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `year` varchar(45) DEFAULT NULL,
  `picture` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `movie`
--

INSERT INTO `movie` (`movie_id`, `title`, `year`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Tokyo Story', '1953', 'tokyo-story.jpg', NULL, NULL),
(2, 'Sunrise', '1927', 'sunrise.jpg', NULL, NULL),
(3, 'A Space Odyssey', '1968', 'space.jpg', NULL, NULL),
(4, 'The Searchers', '1956', 'searchers.jpg', NULL, NULL),
(5, 'Man With a Movie Camera', '1929', 'man-with-moviecamera.jpg', NULL, NULL),
(6, 'The Passion of Joan of Arc', '1927', 'joan-of-arc.jpg', NULL, NULL),
(7, '8&#189', '1963', '8-and-a-half.jpg', NULL, NULL),
(8, 'Battleship Potemkin', '1925', 'potemkin.jpg', NULL, NULL),
(9, 'L\'Atalante', '1934', 'latalante.jpg', NULL, NULL),
(10, 'Breathless', '1960', 'breathless.jpg', NULL, NULL),
(11, 'Apocalypse Now', '1979', 'apocalypse-now.jpg', NULL, NULL),
(12, 'Late Spring', '1949', 'late-spring.jpg', NULL, NULL),
(13, 'Au Hasard Balthazar', '1966', 'au-hasard-balthazar.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rating`
--

CREATE TABLE `rating` (
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `rating`
--

INSERT INTO `rating` (`user_id`, `movie_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(1, 2, 3, NULL, NULL),
(2, 1, 1, NULL, NULL),
(2, 2, 4, NULL, NULL),
(2, 5, 3, NULL, NULL),
(2, 7, 4, NULL, NULL),
(3, 1, 3, NULL, NULL),
(3, 2, 4, NULL, NULL),
(3, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(180) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'janjaap@siewers.org', '$2y$10$XLkW5j83sR4nXRhBGbGFFuwhu1TGeczHhb2q2i6NfIUxNyYdoTx.q', NULL, NULL),
(2, 'klaus@enk.nl', '$2y$10$ROVR/xml4E1Rqu0lGIR62uOo1cFnSg339GVuMWvUiACJr2LHnXvle', NULL, NULL),
(3, 'truus@kok.nl', '$2y$10$i4cUTpz6/8m3I19JPXGhDOfFVmB2THZFVchTA8uvOuBH4SOirD2Em', NULL, NULL),
(4, 'janjaap@siekjhkjhers.org', 'kjhkjhkj', '2022-04-12 14:53:38', NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexen voor tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`user_id`,`movie_id`),
  ADD KEY `fk_rating_movie_idx` (`movie_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rating_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

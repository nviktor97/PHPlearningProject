-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Sze 04. 09:43
-- Kiszolgáló verziója: 10.4.22-MariaDB
-- PHP verzió: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `formtest`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job`
--

CREATE TABLE `job` (
  `id` int(5) NOT NULL,
  `names` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `comment` varchar(500) COLLATE utf8_hungarian_ci NOT NULL,
  `worktype` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `experience` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `salary` int(100) NOT NULL,
  `diploma` tinyint(1) NOT NULL,
  `userid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `job`
--

INSERT INTO `job` (`id`, `names`, `email`, `website`, `comment`, `worktype`, `experience`, `salary`, `diploma`, `userid`) VALUES
(79, 'Los Pollos Hermanos', 'lospolos@gmail.com', 'www.lph.com', 'Chicken!', 'remote', 'one', 300000, 1, 2),
(80, 'Wayland', 'wayland@gmail.com', 'www.wayland.com', 'Hi!', 'onsite', 'two', 1000000, 2, 1),
(81, 'Tesla2', 'tesla2@outlook.com', 'www.tes2.com', 'Hi!', 'onsite', 'one', 300000, 1, 3),
(82, 'Tesla2', 'tesla2@outlook.com', 'www.tes2.com', 'Hi!', 'onsite', 'one', 300000, 1, 3),
(83, 'Alma', 'al@gmail.com', 'www.al.com', 'Howdy!', 'hybrid', 'two', 400000, 1, 3),
(84, 'Tesla3', 'tesla3@outlook.com', 'www.tes3.com', 'S', 'remote', 'two', 300000, 1, 3),
(85, 'TeslaTwo', 'teslatw@outlook.com', 'www.testw.com', 'Hi!', 'hybrid', 'two', 300000, 2, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobid`
--

CREATE TABLE `jobid` (
  `jobid` int(5) NOT NULL,
  `languageid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `jobid`
--

INSERT INTO `jobid` (`jobid`, `languageid`) VALUES
(79, 3),
(80, 5),
(81, 3),
(81, 4),
(82, 3),
(82, 4),
(83, 1),
(83, 2),
(83, 3),
(83, 4),
(83, 5),
(84, 1),
(85, 5);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `languages`
--

CREATE TABLE `languages` (
  `id` int(5) NOT NULL,
  `name` varchar(10) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `languages`
--

INSERT INTO `languages` (`id`, `name`) VALUES
(1, 'Java'),
(2, 'C'),
(3, 'c++'),
(4, 'c#'),
(5, 'python');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `submits`
--

CREATE TABLE `submits` (
  `id` int(5) NOT NULL,
  `username` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `aimid` int(5) NOT NULL,
  `ownerid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `submits`
--

INSERT INTO `submits` (`id`, `username`, `filename`, `aimid`, `ownerid`) VALUES
(1, 'nviktor97', 'Nemethy_Viktor_CV.pdf', 78, 1),
(2, 'nviktor97', 'Nemethy_Viktor_CV.pdf', 78, 1),
(3, 'nviktor97', 'Nemethy-Viktor-CV (1).pdf', 78, 1),
(4, 'nviktor97', 'jelentkezokertesitesePTIMSc 2022szeptember.pdf', 78, 1),
(5, '', '008_Oklevelszerzes_hataridon_belul.pdf', 79, 2),
(6, 'nviktor97', '91 Az egészségügyi szolgáltatási járulék 20220119.pdf', 79, 2),
(7, 'nviktor97', 'Nemethy_Viktor_CV_EN.pdf', 79, 2),
(8, 'nviktor97', 'Nemethy_Viktor_CV_EN.pdf', 79, 2),
(9, 'nviktor97', 'Nemethy_Viktor_CV_HU.pdf', 79, 2),
(10, 'nviktor97', 'Nemethy_Viktor_CV (3).pdf', 80, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'nviktor97', '$2y$10$VGrbWYybQ51TWy6/68eE4ODI/hs./FaFyBnT.Wwq8PFKNvd/Ip4BS', '2022-07-13 16:21:40'),
(2, 'hanzee', '$2y$10$P5yi6xNvMkAuc88KvQe//.XUWcIRbpO1f.fbOE1rLsyql.fyU0ZJ.', '2022-07-19 14:29:51'),
(3, 'bela', '$2y$10$50TGc7G5aXwF/tb0rTdq1OGWqtVCRiWm.SzMky9TxM10ZK6lQ16ha', '2022-09-03 18:56:06'),
(4, 'beee', '$2y$10$rvj7xKAwxk99LWO0W9z9oeFoO3G1O.m9V3YjeGwg2E/qiQmmIOGtm', '2022-09-04 09:15:38');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- A tábla indexei `jobid`
--
ALTER TABLE `jobid`
  ADD KEY `jobid` (`jobid`),
  ADD KEY `languageid` (`languageid`);

--
-- A tábla indexei `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `submits`
--
ALTER TABLE `submits`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `job`
--
ALTER TABLE `job`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT a táblához `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `submits`
--
ALTER TABLE `submits`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `jobid`
--
ALTER TABLE `jobid`
  ADD CONSTRAINT `jobid_ibfk_2` FOREIGN KEY (`languageid`) REFERENCES `languages` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `jobid_ibfk_3` FOREIGN KEY (`jobid`) REFERENCES `job` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

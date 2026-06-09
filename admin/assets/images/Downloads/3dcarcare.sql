-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 12:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3dcarcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gallery_1` varchar(255) DEFAULT NULL,
  `gallery_2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `heading`, `slug`, `description`, `image`, `gallery_1`, `gallery_2`) VALUES
(1, 'Paint Protection Film (PPF)', 'paint-protection-film-ppf', '<p class=\"\\\" service-details__text-2\\\"\"=\"\" style=\"\\\" margin:\"=\"\" 20px=\"\" 0px=\"\" 41px;=\"\" color:=\"\" rgb(88,=\"\" 91,=\"\" 107);=\"\" font-family:=\"\" inter,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\\\"=\"\">Paint Protection Film (PPF) is a high-quality, transparent polyurethane film designed to protect your car\'s paint from everyday damage. At 3D Car Care Mayapuri, our advanced PPF acts as an invisible shield that safeguards your vehicle from scratches, stone chips, swirl marks, road debris, UV rays, and minor impactsâ€”keeping your car looking new for years.<br><span style=\"\\\" background-color:\"=\"\" transparent;\\\"=\"\"><br>Our premium self-healing PPF technology allows light scratches to disappear with heat, maintaining a smooth and flawless finish over time. The film enhances gloss without altering your car\'s original color and helps preserve factory paint, which significantly improves long-term value and resale potential.</span></p><p class=\"\\\" service-details__text-2\\\"\"=\"\" style=\"\\\" margin:\"=\"\" 20px=\"\" 0px=\"\" 41px;=\"\" color:=\"\" rgb(88,=\"\" 91,=\"\" 107);=\"\" font-family:=\"\" inter,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\\\"=\"\"><span style=\"\\\" background-color:\"=\"\" transparent;\\\"=\"\">PPF is ideal for high-impact areas such as bumpers, bonnets, fenders, mirrors, door edges, and full-body coverage. Installed by trained professionals with precision and care, our PPF ensures seamless application, durability, and long-lasting protection even in tough Indian driving conditions.</span></p>', '../uploads/image_69958e9a7b1f41.58841707.webp', '../uploads/gallery_1_69958e9a7b3101.92125185.webp', '../uploads/gallery_2_69958e9a7b3a12.42674127.webp'),
(3, 'Graphene Coating', 'graphene-coating', '<p>Graphene coating is the next evolution in automotive paint protection, offering superior durability and heat resistance compared to traditional coatings. Our graphene coating service creates a strong, slick protective layer that reduces water spots, resists dust buildup, and protects against UV rays and oxidation. Ideal for Indian weather conditions, graphene coating ensures long-lasting shine and easier maintenance for your vehicle.</p>', '../uploads/image_699593125ce457.93270294.webp', '', ''),
(4, 'Ceramic Coating', 'ceramic-coating', '<p>Ceramic coating provides a hard, protective layer that bonds with your carâ€™s paint to deliver deep gloss, hydrophobic properties, and long-term protection. At <strong data-start=\\\"1384\\\" data-end=\\\"1408\\\">3D Car Care Mayapuri</strong>, our ceramic coating service protects your vehicle from environmental damage, fading, chemical stains, and light scratches. It also makes washing easier by preventing dirt and grime from sticking to the surface.</p>', '../uploads/image_69959524598ec0.67836203.webp', '', ''),
(5, 'Leather Coating', 'leather-coating', '<p>Leather coating is specially designed to protect your carâ€™s leather seats and interiors from stains, spills, fading, and daily wear. Our leather coating service forms an invisible breathable layer that keeps the leather soft while preventing cracking and discoloration. This treatment helps maintain the premium look and comfort of your carâ€™s interior for years.</p>', '../uploads/image_6995952cedb073.72485460.webp', '', ''),
(6, 'Interior Detailing', 'interior-detailing', '<p>Interior detailing is a deep-cleaning process that restores freshness, hygiene, and comfort inside your vehicle. Our interior detailing service includes thorough vacuuming, shampooing of seats and carpets, dashboard and trim cleaning, leather conditioning, and odor removal. At <strong data-start=\\\"2325\\\" data-end=\\\"2349\\\">3D Car Care Mayapuri</strong>, we ensure your carâ€™s interior looks, feels, and smells like new.</p>', '../uploads/image_69959535efdff4.29540254.webp', '', ''),
(7, 'Exterior Detailing', 'exterior-detailing', '<p data-start=\\\"2449\\\" data-end=\\\"2808\\\">Exterior detailing focuses on restoring and enhancing your carâ€™s outer appearance. This service includes foam wash, paint decontamination, polishing, scratch reduction, tire and alloy cleaning, and protective finishing. Our expert exterior detailing process removes dirt, oxidation, and minor imperfections, giving your vehicle a glossy, showroom-like finish.</p>', '../uploads/image_6995953f90ebc0.48277288.webp', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'jatinkundara101@gmail.com', '$2y$10$dXhwhqEkhrXaOi0U.eHZRusPxE9Iw/0MDkBpiDEyHOZuaiSMZCX6a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

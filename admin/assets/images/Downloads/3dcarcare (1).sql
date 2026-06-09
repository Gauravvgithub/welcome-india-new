-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2026 at 01:46 PM
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
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `heading`, `slug`, `description`, `image`) VALUES
(2, 'Why Paint Protection Film (PPF) Is a Smart Investment for Your Car', 'why-paint-protection-film-ppf-is-a-smart-investment-for-your-car', 'Paint Protection Film (PPF) acts as an invisible shield that protects your carâ€™s paint from scratches, stone chips, swirl marks, and environmental damage.', '../uploads/image_6998031c9fd540.14921714.webp');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `sulg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `heading`, `sulg`) VALUES
(4, 'Exterior', 'exterior'),
(5, 'Interior', 'interior'),
(6, 'Coatings', 'coatings'),
(7, 'Compounds & Polishes', 'compounds-&-polishes'),
(8, 'Accessories', 'accessories');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `sulg` varchar(255) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gallery_1` varchar(255) DEFAULT NULL,
  `gallery_2` varchar(255) DEFAULT NULL,
  `gallery_3` varchar(255) DEFAULT NULL,
  `gallery_4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `heading`, `sulg`, `category`, `short_desc`, `description`, `image`, `gallery_1`, `gallery_2`, `gallery_3`, `gallery_4`) VALUES
(1, 'Test 3D GLW Series SiO2 Ceramic Trim Restore', 'test-3d-glw-series-sio2-ceramic-trim-restore', 7, 'test The 3D GLW Series SiO2 Ceramic Trim Restore is designed to rejuvenate and protect your vehicle\\\'s plastic trim. Our innovative formula is engineered to restore and repair the effects of UV and elemental oxidation. Revitalize plastic trim and add a layer of hydrophobic protection with Ceramic Trim Restore.', '<p style=\"\\\"padding:\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\"></p><h4 class=\"\\\"\\\"\">Product Details</h4>test The 3D GLW Series SiO2 Ceramic Trim Restore is a transformative product engineered to breathe new life into your vehicle\\\'s plastic trim. Over time, plastic trim can lose its luster, succumbing to the wear and tear of the elements, leaving it dull and faded.<p></p><p style=\"\\\"padding:\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\">As you apply it, you\\\'re not merely restoring; you\\\'re rejuvenating. The SiO2 Ceramic technology works its magic, reinvigorating plastic surfaces and imparting an ultra-dark, showroom-worthy finish. Yet, this product doesn\\\'t stop at aesthetics.</p><p style=\"\\\"padding:\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\">It\\\'s not just about appearance; it\\\'s about protection. The 3D GLW Series SiO2 Ceramic Trim Restore also adds a layer of hydrophobic protection, ensuring that your trim remains shielded from the elements. Water and contaminants will bead up and roll off, leaving your plastic trim not only looking revitalized but also safeguarded against continued elemental damage. The dry-to-the-touch formula is easy to apply and gets deep into the surface to bring the black trim color back to life, without any greasiness.</p>', '../uploads/image_699821c8f332a7.26219570.webp', '../uploads/gallery_1_6997ee6c2f9865.09362375.webp', '../uploads/gallery_2_6997ee6c2f98b8.31987818.webp', '../uploads/gallery_3_6997ee6c2f9906.16831970.webp', ''),
(4, 'Test 3D GLW Series SiO2 Ceramic Trim Restore', 'test-3d-glw-series-sio2-ceramic-trim-restore', 7, 'test The 3D GLW Series SiO2 Ceramic Trim Restore is designed to rejuvenate and protect your vehicle\\\'s plastic trim. Our innovative formula is engineered to restore and repair the effects of UV and elemental oxidation. Revitalize plastic trim and add a layer of hydrophobic protection with Ceramic Trim Restore.', '<p><p></p><p></p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\"></p><h4 class=\"\\\" \\\"\"=\"\">Product Details</h4>test The 3D GLW Series SiOâ‚‚ Ceramic Trim Restore is a transformative product engineered to breathe new life into your vehicle\'s plastic trim. Over time, plastic trim can lose its luster, succumbing to the wear and tear of the elements, leaving it dull and faded.</p><p><p><br></p><p></p><p></p><p></p><p></p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\">As you apply it, you\'re not merely restoring; you\'re rejuvenating. The SiOâ‚‚ ceramic technology works its magic, reinvigorating plastic surfaces and imparting an ultra-dark, showroom-worthy finish. Yet, this product doesn\'t stop at aesthetics.</p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\"><br></p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\">It\'s not just about appearance; it\'s about protection. The 3D GLW Series SiOâ‚‚ Ceramic Trim Restore also adds a layer of hydrophobic protection, ensuring that your trim remains shielded from the elements. Water and contaminants will bead up and roll off, leaving your plastic trim not only looking revitalized but also safeguarded against continued elemental damage. The dry-to-the-touch formula is easy to apply and gets deep into the surface to bring the black trim color back to life without any greasiness.</p><p></p><p></p></p>', '../uploads/image_699821ba7ea6e5.12118348.webp', '../uploads/gallery_1_6997ee6c2f9865.09362375.webp', '../uploads/gallery_2_6997ee6c2f98b8.31987818.webp', '../uploads/gallery_3_699821ba7eb002.33032764.webp', ''),
(5, '3D GLW Series SiO2 Ceramic Trim Restore', '3d-glw-series-sio2-ceramic-trim-restore', 4, 'The 3D GLW Series SiO2 Ceramic Trim Restore is designed to rejuvenate and protect your vehicle\\\'s plastic trim. Our innovative formula is engineered to restore and repair the effects of UV and elemental oxidation. Revitalize plastic trim and add a layer of hydrophobic protection with Ceramic Trim Restore.', '<h4 style=\"\\\" class=\"\">Product Details</h4><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\"><br></p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\">The 3D GLW Series SiOâ‚‚ Ceramic Trim Restore is a transformative product engineered to breathe new life into your vehicle\'s plastic trim. Over time, plastic trim can lose its luster, succumbing to the wear and tear of the elements, leaving it dull and faded.</p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\"><br></p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\">As you apply it, you\'re not merely restoring; you\'re rejuvenating. The SiOâ‚‚ ceramic technology works its magic, reinvigorating plastic surfaces and imparting an ultra-dark, showroom-worthy finish. Yet, this product doesn\'t stop at aesthetics.</p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\"><br></p><p style=\"\\\" padding:\"=\"\" 0px;=\"\" margin-right:=\"\" margin-bottom:=\"\" 1rem;=\"\" margin-left:=\"\" font-family:=\"\" helvetica;=\"\" line-height:=\"\" 1.5;=\"\" font-size:=\"\" 17px;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(56,=\"\" 56,=\"\" 56);\\\"=\"\">It\'s not just about appearance; it\'s about protection. The 3D GLW Series SiOâ‚‚ Ceramic Trim Restore also adds a layer of hydrophobic protection, ensuring that your trim remains shielded from the elements. Water and contaminants will bead up and roll off, leaving your plastic trim not only looking revitalized but also safeguarded against continued elemental damage. The dry-to-the-touch formula is easy to apply and gets deep into the surface to bring the black trim color back to life without any greasiness.</p>', '../uploads/image_69982da0841d50.00377405.webp', '../uploads/gallery_1_69982da0841f46.04707755.webp', '../uploads/gallery_2_69982da0841f91.58430759.webp', '../uploads/gallery_3_69982da0841fb4.08076715.webp', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_inquiry`
--

CREATE TABLE `product_inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `review` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `review`) VALUES
(4, 'Rahul Verma', 'Business Owner, New Delhi', 'Excellent service and top-quality work. I got Paint Protection Film installed and the finish is flawless. The team explained everything clearly and delivered exactly what they promised.'),
(5, 'Ankit Sharma', 'IT Professional, Gurgaon', 'Iâ€™m extremely happy with the ceramic coating done on my car. The shine is amazing and maintenance has become very easy. Highly recommended for premium car care services.'),
(6, 'Sandeep Khanna', 'Car Enthusiast, Noida', 'Professional team with great attention to detail. Interior and exterior detailing were done perfectly. My car looks and feels like new again.'),
(7, 'Neha Malhotra', 'Marketing Manager, Delhi', 'The staff is polite, knowledgeable, and very transparent about pricing. I opted for graphene coating and the results exceeded my expectations.'),
(8, 'Vikram Singh', 'Operations Manager, Faridabad', 'From booking to delivery, the entire process was smooth. Quality workmanship and genuine products. Definitely my go-to car care studio in Mayapuri.');

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
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `product_inquiry`
--
ALTER TABLE `product_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_inquiry`
--
ALTER TABLE `product_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

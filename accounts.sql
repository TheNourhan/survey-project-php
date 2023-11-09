-- phpMyAdmin SQL Dump
-- version 5.2.0
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounts`
--

-- --------------------------------------------------------

--
-- بنية الجدول `options`
--

CREATE TABLE `options` (
  `option_id` mediumint(9) NOT NULL,
  `question_id` mediumint(9) NOT NULL,
  `option_text` varchar(100) NOT NULL,
  `selection_ratio` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `option_text`, `selection_ratio`) VALUES
(578, 159, 'php', 2),
(579, 159, 'JavaScript', 0),
(580, 159, 'c++', 0),
(581, 159, 'c#', 0),
(582, 160, 'My desire to learn it', 1),
(583, 160, 'to get a job', 1),
(584, 160, 'Increase knowledge of web languages', 0),
(585, 160, 'keep up to date', 0),
(586, 161, 'Yes', 0),
(587, 161, 'i don&#039;t have the skill', 0),
(588, 161, 'middle', 0),
(589, 161, 'never', 1),
(590, 162, 'less than a month', 0),
(591, 162, 'year', 2),
(592, 162, 'Between 6 months and a year', 0),
(593, 162, 'More than a year', 0),
(594, 163, 'Yes', 0),
(595, 163, 'no', 0),
(596, 163, 'To some extent', 0),
(597, 163, 'Enough to be professional', 1),
(598, 164, 'c++', 1),
(599, 164, 'c#', 0),
(600, 164, 'java', 0),
(601, 164, 'python', 1),
(602, 165, 'c++', 0),
(603, 165, 'c#', 0),
(604, 165, 'jave', 0),
(605, 165, 'python', 2),
(606, 166, 'Yes', 0),
(607, 166, 'No', 1),
(608, 166, 'maybe', 0),
(609, 166, 'i already work', 1),
(610, 167, 'c++', 0),
(611, 167, 'c#', 0),
(612, 167, 'java', 1),
(613, 167, 'python', 0),
(614, 168, 'Yes', 1),
(615, 168, 'No', 1),
(616, 168, 'Sometimes', 0),
(617, 168, 'Just enough', 0),
(622, 170, 'Good', 1),
(623, 170, 'Excellent', 0),
(624, 170, 'Bad', 0),
(625, 170, 'Very bad', 0),
(626, 171, 'Yes', 0),
(627, 171, 'No', 1),
(628, 171, 'sometimes', 0),
(629, 171, 'mostly', 0),
(630, 172, 'more than five years', 0),
(631, 172, 'Almost a year and a half', 0),
(632, 172, 'Since the beginning of my studies at the Virtual University', 1),
(633, 172, 'less than one year', 0),
(634, 173, 'Desktop computer', 0),
(635, 173, 'laptop', 0),
(636, 173, 'Smart mobile phone', 1),
(637, 173, 'Tablet computer', 0),
(638, 174, 'Very high and advanced skills', 0),
(639, 174, 'Medium skills that are easy to learn', 0),
(640, 174, 'You don&#039;t need any skill', 0),
(641, 174, 'Depends on experience', 1),
(642, 175, 'synchronous', 0),
(643, 175, 'asynchronous', 0),
(644, 175, 'Both styles', 0),
(645, 175, 'Other', 1),
(646, 176, 'video interviews', 0),
(647, 176, 'Electronic communication with the lecturer using electronic communication methods', 1),
(648, 176, 'Scientific content publications on social media', 0),
(649, 176, 'Electronic libraries and scientific research', 0),
(650, 177, 'I agree', 1),
(651, 177, 'I totally agree', 0),
(652, 177, 'I do not agree', 0),
(653, 177, 'Strongly Disagree', 0),
(654, 178, 'I agree', 0),
(655, 178, 'I totally agree', 0),
(656, 178, 'I do not agree', 1),
(657, 178, 'Strongly Disagree', 0),
(658, 179, 'I agree', 0),
(659, 179, 'I totally agree', 1),
(660, 179, 'I do not agree', 0),
(661, 179, 'Strongly Disagree', 0),
(662, 180, 'Yes', 1),
(663, 180, 'No', 0),
(664, 180, 'To some extent', 0),
(665, 180, 'mostly', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `survey`
--

CREATE TABLE `survey` (
  `survey_id` mediumint(9) NOT NULL,
  `survey_name` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `survey`
--

INSERT INTO `survey` (`survey_id`, `survey_name`, `description`) VALUES
(141, 'programming languages', 'The most common programming languages ​​and their uses.'),
(143, 'E-learning', 'E-learning, its spread, effectiveness and efficiency, and how people deal with it.');

-- --------------------------------------------------------

--
-- بنية الجدول `survey_answers`
--

CREATE TABLE `survey_answers` (
  `answer_id` mediumint(9) NOT NULL,
  `survey_id` mediumint(9) NOT NULL,
  `question_id` mediumint(9) NOT NULL,
  `usere_id` mediumint(9) NOT NULL,
  `option_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `survey_answers`
--

INSERT INTO `survey_answers` (`answer_id`, `survey_id`, `question_id`, `usere_id`, `option_id`) VALUES
(125, 141, 159, 44, 578),
(126, 141, 160, 44, 582),
(127, 141, 162, 44, 591),
(128, 141, 164, 44, 601),
(129, 141, 165, 44, 605),
(130, 141, 166, 44, 607),
(131, 141, 168, 44, 615),
(132, 141, 159, 46, 578),
(133, 141, 160, 46, 583),
(134, 141, 161, 46, 589),
(135, 141, 162, 46, 591),
(136, 141, 163, 46, 597),
(137, 141, 164, 46, 598),
(138, 141, 165, 46, 605),
(139, 141, 166, 46, 609),
(140, 141, 167, 46, 612),
(141, 141, 168, 46, 614),
(142, 143, 170, 44, 622),
(143, 143, 171, 44, 627),
(144, 143, 172, 44, 632),
(145, 143, 173, 44, 636),
(146, 143, 174, 44, 641),
(147, 143, 175, 44, 645),
(148, 143, 176, 44, 647),
(149, 143, 177, 44, 650),
(150, 143, 178, 44, 656),
(151, 143, 179, 44, 659),
(152, 143, 180, 44, 662);

-- --------------------------------------------------------

--
-- بنية الجدول `survey_questions`
--

CREATE TABLE `survey_questions` (
  `question_id` mediumint(9) NOT NULL,
  `survey_id` mediumint(9) NOT NULL,
  `questions_body` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `survey_questions`
--

INSERT INTO `survey_questions` (`question_id`, `survey_id`, `questions_body`) VALUES
(159, 141, 'The most popular programming language in your surroundings?'),
(160, 141, 'Why did you prefer it over other languages?'),
(161, 141, 'Do you have prior knowledge of a programming language?'),
(162, 141, ' How long does it take you to learn a programming language?'),
(163, 141, 'Is it necessary for the programmer to be proficient in English?'),
(164, 141, 'What languages ​​do you recommend for beginners?'),
(165, 141, 'In your opinion, which language will be more widespread in the future?'),
(166, 141, 'Are you thinking of working in a field related to programming languages?'),
(167, 141, 'The most demanded programming languages ​​in the labor market?'),
(168, 141, 'Is mathematics important in learning programming?'),
(170, 143, 'How do you rate the internet quality in your area?'),
(171, 143, 'Do you have a suitable environment for learning at home?'),
(172, 143, 'How long is your experience in e-learning?'),
(173, 143, 'Which of the devices do you prefer to use in your e-learning?'),
(174, 143, 'What level of skills does the learner need to use e-learning techniques?'),
(175, 143, 'What method do you use in your e-learning?'),
(176, 143, 'In your opinion, what are the most effective methods in e-learning?'),
(177, 143, 'E-learning helps in developing the teaching process in educational institutions, and traditional methods can be dispensed with somewhat'),
(178, 143, 'The implementation of e-learning requires organizational changes in educational institutions'),
(179, 143, 'E-learning helps in completing teaching activities faster than the traditional method'),
(180, 143, 'In your opinion, is it possible to dispense with the traditional method of learning and use e-learning?');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `usere_id` mediumint(11) NOT NULL,
  `users_uid` tinytext NOT NULL,
  `users_pwd` longtext NOT NULL,
  `users_email` tinytext NOT NULL,
  `u_type` int(11) NOT NULL DEFAULT 0,
  `users_age` int(255) NOT NULL,
  `users_eduLevel` varchar(50) NOT NULL,
  `users_country` varchar(50) NOT NULL,
  `users_gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`usere_id`, `users_uid`, `users_pwd`, `users_email`, `u_type`, `users_age`, `users_eduLevel`, `users_country`, `users_gender`) VALUES
(44, 'marah', '$2y$10$j1Zg3l9Yx4GHX7zMmc3XfOmSuTs8NkhJffc/hEpLpV9JbswksE86m', 'm@m.com', 0, 18, 'Primary education', 'syria', 'Female'),
(45, 'admin', '$2y$10$J2.oPNPjv2dhBrmVldb5/.9/TrRr09z6zZbWzxiGrALlLa4ujttA.', 'a@z.com', 1, 19, 'Secondary education', 'saudi arabia', 'Male'),
(46, 'inje', '$2y$10$ErXNgla7cBSODORkQNODvu0lkQ8paojS6FAr.1M6GHZdMJ6MgN/MO', 'in@g.com', 0, 20, 'Secondary education', 'syria', 'Female'),
(47, 'lma', '$2y$10$HK4dem3BzmSCiHyK2r9b8uEyqsX4istFfnCDGxkkudtHfrPLU48C2', 'f@h.com', 0, 18, 'Secondary education', 'syria', 'Female'),
(48, 'lfa', '$2y$10$mtdXpo/nN9zbRfUrfa1sQugn3MYyaUYXVoJdT7aekhQ0fihdwDvfm', 'l@m.com', 0, 18, 'Secondary education', 'syria', 'Female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `usere_id` (`usere_id`) USING BTREE,
  ADD KEY `survey_id` (`survey_id`),
  ADD KEY `option_id` (`option_id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usere_id`),
  ADD UNIQUE KEY `usere_id` (`usere_id`),
  ADD UNIQUE KEY `usere_id_2` (`usere_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=666;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `survey_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `survey_answers`
--
ALTER TABLE `survey_answers`
  MODIFY `answer_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `question_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usere_id` mediumint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `survey_questions` (`question_id`);

--
-- القيود للجدول `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD CONSTRAINT `survey_answers_ibfk_1` FOREIGN KEY (`usere_id`) REFERENCES `users` (`usere_id`),
  ADD CONSTRAINT `survey_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `survey_questions` (`question_id`),
  ADD CONSTRAINT `survey_answers_ibfk_3` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`),
  ADD CONSTRAINT `survey_answers_ibfk_4` FOREIGN KEY (`option_id`) REFERENCES `options` (`option_id`);

--
-- القيود للجدول `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD CONSTRAINT `survey_questions_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE DATABASE IF NOT EXISTS `db_contact` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_contact`;

DROP TABLE IF EXISTS `tb_contact`;
CREATE TABLE `tb_contact` (
  `id` int(11) NOT NULL,
  `fldName` varchar(50) NOT NULL,
  `fldEmail` varchar(150) NOT NULL,
  `fldPhone` varchar(15) NOT NULL,
  `fldMessage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `tb_contact`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `tb_contact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
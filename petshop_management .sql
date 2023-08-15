
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calculations_for_pets` (IN `pid` VARCHAR(9), IN `sid` VARCHAR(9),IN `cid` VARCHAR(9))  NO SQL
BEGIN
DECLARE 
 cpid ,csid int DEFAULT 0;
set cpid=(select cost from pets where pet_id=pid);
set csid=(select total from sales where sd_id=sid and cs_id=cid);
set csid=csid+cpid;
update sales set total=csid where sd_id=sid and cs_id=cid;
end$$
DELIMITER ;

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calculations_for_soldpets` (IN `pid` VARCHAR(9), IN `sid` VARCHAR(9),IN `cid` VARCHAR(9))  NO SQL
BEGIN
DECLARE 
 cpid ,csid int DEFAULT 0;
set cpid=(select cost from pets where pet_id=pid);
set csid=(select total from sales where sd_id=sid and cs_id=cid);
set csid=csid-cpid;
update sales set total=csid where sd_id=sid and cs_id=cid;
end$$
DELIMITER ;





-- Table for  `dogs`

CREATE TABLE `dogs` (
  `pet_id` varchar(9) NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL,
  `age` int(11) NOT NULL,
  `fur` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `dogs` (`pet_id`, `weight`, `height`, `age`, `fur`) VALUES
('pd01',  11.3, 30, 2, 'white'),
('pd02',  3.6, 20, 2, 'white'),
('pd03',  12.5, 40, 2, 'gloden'),
('pd04',  11.5, 45, 3, 'black'),
('pd05',  2.6, 20, 5, 'white');


-- Table  for `cats`

CREATE TABLE `cats` (
  `pet_id` varchar(9) NOT NULL,
  `noise` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cats` (`pet_id`, `noise`) VALUES
('pc01',  'moderate'),
('pc02', 'low'),
('pc03',  'moderate'),
('pc04', 'moderate'),
('pc05',  'moderate');


-- Table  for  `customer`

CREATE TABLE `customer` (
  `cs_id` varchar(9) NOT NULL,
  `cs_fname` varchar(10) NOT NULL,
  `cs_mname` varchar(10) NOT NULL,
  `cs_lname` varchar(10) NOT NULL,
  `cs_address` varchar(30) NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `customer` (`cs_id`, `cs_fname`, `cs_mname`, `cs_lname`, `cs_address`,`phone`) VALUES
('cs01', 'Naveen', 'kumar', 'k', 'Mandya', 9900167987),
('cs02', 'manjunath', 'kumar', 'h v', 'BENGALURU', 9966887541),
('cs03', 'pavan', 'chikkanna', 'gowda', 'BENGALURU', 8877547987),
('cs04', 'kushal', 'kumar', 'k', 'BENGALURU', 9988774561),
('cs05', 'ravi', 'shankar', 'c', 'BENGALURU', 6655789470);

-- Table  for `pets`

CREATE TABLE `pets` (
  `pet_id` varchar(9) NOT NULL,
  `pet_category` varchar(15) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `pets` (`pet_id`, `pet_category`, `cost`) VALUES
('pd01', 'bulldog', 8000),
('pd02', 'labrodor', 3000),
('pd03', 'indie', 8500),
('pd04', 'retriever', 15000),
('pd05', 'indie', 3500),
('pc01', 'persian', 2000),
('pc02', 'community', 800),
('pc03', 'bombay', 600),
('pc04', 'community', 800),
('pc05', 'himalayan', 10000);


-- Triggers 

DELIMITER $$
CREATE TRIGGER `check_sold` BEFORE UPDATE ON `pets` FOR EACH ROW BEGIN
DECLARE
 checking int;
 set checking=(select count(*) from sold_pets where pet_id=old.pet_id);
  if (checking > 0) then   
        signal sqlstate '45000' set message_text = 'cannot  update sold pet';
    end if;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `check_soldpets` BEFORE UPDATE ON `pets` FOR EACH ROW BEGIN
DECLARE
 checking int;
 set checking=(select count(*) from sold_pets where pet_id=old.pet_id);
  if (checking > 0) then   
        signal sqlstate '45000' set message_text = 'cannot  update sold pet';
    end if;
END
$$
DELIMITER ;

-- Table  for  `sales`

CREATE TABLE `sales` (
  `sd_id` varchar(9) NOT NULL,
  `cs_id` varchar(9) NOT NULL,
  `date` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `sales` (`sd_id`, `cs_id`, `date`, `total`) VALUES
('sd01', 'cs03', '2018-10-26', 9500),
('sd02', 'cs01', '2018-11-01', 3000),
('sd03', 'cs03', '2018-11-08', 500),
('sd04', 'cs04', '2018-11-15', 12250),
('sd05', 'cs02', '2018-11-17', 9350),
('sd06', 'cs05', '2018-11-20', 1900),
('sd07', 'cs03', '2018-12-08', 10000);

-- Table for `sold_pets`

CREATE TABLE `sold_pets` (
  `sd_id` varchar(9) NOT NULL,
  `cs_id` varchar(9) NOT NULL,
  `pet_id` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `sold_pets` (`sd_id`,`cs_id`,`pet_id`) VALUES
('sd01','cs01', 'pd01'),
('sd02','cs02', 'pd02'),
('sd04','cs03', 'pd04'),
('sd05','cs04', 'pd03'),
('sd06','cs05', 'pc02');



-- Indexes for tables

--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cs_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_id`);




--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sd_id`,`cs_id`),
  ADD KEY `cs_id` (`cs_id`);

--
-- Indexes for table `sold_pets`
--
ALTER TABLE `sold_pets`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `sd_id` (`sd_id`),
   ADD KEY `cs_id` (`cs_id`);


--
-- Constraints for dumped tables
--

--
-- Constraints for table `dogs`
--
ALTER TABLE `dogs`
  ADD CONSTRAINT `dogs_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`) ON DELETE CASCADE;

--
-- Constraints for table `cats`
--
ALTER TABLE `cats`
  ADD CONSTRAINT `cats_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`cs_id`) REFERENCES `customer` (`cs_id`) ON DELETE CASCADE;

--
-- Constraints for table `sold_pets`
--
ALTER TABLE `sold_pets`
  ADD CONSTRAINT `sold_pets_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sold_pets_ibfk_2` FOREIGN KEY (`sd_id`) REFERENCES `sales` (`sd_id`) ON DELETE CASCADE;
  ADD CONSTRAINT `sold_pets_ibfk_3` FOREIGN KEY (`cs_id`) REFERENCES `sales` (`cs_id`) ON DELETE CASCADE;

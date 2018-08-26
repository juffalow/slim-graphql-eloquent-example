CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `author` (`id`, `name`, `last_name`) VALUES
(1, 'John', 'Johnson'),
(2, 'Martin', 'Fowler'),
(3, 'Jason', 'Lengstorf'),
(4, 'Linus', 'Torvalds'),
(5, 'Robert', 'Martin'),
(6, 'Bill', 'Gates'),
(7, 'Felipe', 'Fortes'),
(8, 'Niels', 'Bohr'),
(9, 'Jason', 'Lengstorf'),
(10, 'Jamie', 'Zawinski');

CREATE TABLE `quote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `quote` varchar(255) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (author_id) REFERENCES author(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `quote` (`id`, `author_id`, `quote`) VALUES
(1, 1, 'First, solve the problem. Then, write the code.'),
(2, 2, 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.'),
(3, 3, 'If you stop learning, then the projects you work on are stuck in whatever time period you decided to settle.'),
(4, 4, 'Bad programmers worry about the code. Good programmers worry about the data structures and their relationships.'),
(5, 4, 'Most good programmers do programming not because they expect to get paid or get adulation by the public, but because it is fun to program.'),
(6, 4, 'When you say \'I wrote a program that crashed Windows,\' people just stare at you blankly and say \'Hey, I got those with the system, for free.\''),
(7, 4, 'A computer is like air conditioning - it becomes useless when you open Windows.'),
(8, 4, 'If you think your users are idiots, only idiots will use it.'),
(9, 5, 'You should name a variable using the same care with which you name a first-born child.'),
(10, 6, 'If you are born poor, it is not your mistake, but if you die poor it is your mistake.'),
(11, 6, 'No one will need more than 637Kb of memory for a personal computer.'),
(12, 7, 'Debugging is like being the detective in a crime movie where you are also the murderer.'),
(13, 8, 'An expert is a person who has made all the mistakes that can be made in a very narrow field.'),
(14, 9, 'If you stop learning, then the projects you work on are stuck in whatever time period you decided to settle.'),
(15, 10, 'Some people, when confronted with a problem, think “I know, I’ll use regular expressions.” Now they have two problems.');

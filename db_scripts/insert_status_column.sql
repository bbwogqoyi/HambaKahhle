USE blackpeakltd;
ALTER TABLE booking ADD COLUMN status INT;
ALTER TABLE `booking` MODIFY COLUMN `status` int NOT NULL;

CREATE TABLE booking_status (
statusID INT AUTO_INCREMENT PRIMARY KEY,
short_description VARCHAR(32) NOT NULL UNIQUE,
long_description VARCHAR(256) NOT NULL
);

INSERT INTO booking_status(id, short_description, long_description)
VALUES
(1, 'New' , 'Newly created booking, only visible to the client'),
(2, 'Issued' , 'The client has populated all the necessary information to publish a booking for the company to allocate assets and make arrangements'),
(3, 'Awaiting Confirmation' , 'The client must confirm a booking 3days before its start date. If the client does not confirm the booking then it has to be cancelled'),
(4, 'Finalized' , 'Booking Confirmed, assets allocated and finances are debited'),
(5, 'In Progress' , 'The duration between the start and end date of the booking'),
(6, 'Completed' , 'The booking has ended and all cost of service have been debited'),
(7, 'Cancelled' , 'Either cancelled by admin or client; or the booking was never confirmed within the allowed time period');

ALTER TABLE `booking` ADD FOREIGN KEY (`status`) REFERENCES `booking_status`(`statusID`);
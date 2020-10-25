use blackpeakltd;
-- Note: The date format for mysql insert query is YYYY-MM-DD

INSERT INTO clients (firstName, lastName, contactNumber, email, password)
VALUES 
("Stephannie", "Fleis", "(295) 1398451", "wfleis0@e-recht24.de", "123456"),
("Sisely", "Faulconer", "(218) 9827840", "sfaulconer1@phoca.cz", "123456"),
("Devinne", "Jakucewicz", "(816) 9583653", "djakucewicz2@flickr.com", "123456"),
("Briano", "Pawlowicz", "(368) 3454701", "bpawlowicz3@umn.edu", "123456"),
("Phyllis", "Terry", "(441) 3838453", "pterry4@yolasite.com", "123456"),
("Kienan", "Riha", "(864) 7589189", "kriha5@e-recht24.de", "123456");

INSERT INTO booking 
(initialCollectionPoint, startDate, endDate, trailer, numberOfPassengers, clientID, statusID)
VALUES 
("Wukari", "2020-08-07", "2020-10-07", TRUE, 15, 1, 1),
("Fengshan", "2020-04-22", "2020-10-14", TRUE, 21, 2, 1),
("Gedongmulyo", "2020-04-08", "2020-10-07", TRUE, 12, 3, 1),
("Kyenjojo", "2020-08-07", "2020-10-07", FALSE, 8, 4, 1),
("Tagiura", "2020-11-13", "2021-01-07", FALSE, 3, 5, 1),
("Sabanalarga", "2020-08-07", "2020-10-07", FALSE, 2, 6, 1);

INSERT INTO driver 
(firstName, lastName, dateOFBirth, hometown, contactNumber, email, password)
VALUES 
("Mallorie", "Smieton", "1992-08-09", "Cape Town", "(476) 1280342", "m.smieton@blackpeakltd.co.za", "123456"),
("Gallagher", "Picott", "2000-02-04", "Grahamstown", "(203) 8128812", "g.picott@blackpeakltd.co.za", "123456"),
("Archibald", "Tissier", "2001-06-21", "Johannesburg", "(684) 1478174", "a.tissier@blackpeakltd.co.za", "123456"),
("Carlene", "Sanchiz", "1997-01-12", "Durban", "(189) 4626528", "c.sanchiz@blackpeakltd.co.za", "123456"),
("Regan", "Spillman", "2001-06-20", "East London", "(446) 3526151", "r.spillman@blackpeakltd.co.za", "123456"),
("Alejoa", "Duddell", "1997-10-08", "Kimberley", "(340) 4314005", "a.duddell@blackpeakltd.co.za", "123456");

INSERT INTO employee 
(firstName, lastName, email, password, employeeTypeID)
VALUES 
("Nkosinathi", "Nkomo", "n.nkomo@blackpeakltd.co.za", "123456", 1),
("Andiswa", "Qwaba", "a.qwaba@blackpeakltd.co.za", "123456", 2);

INSERT INTO vehicle 
(registrationNumber, dateOfPurchase, numberOfSeats, make, model, year, licenseCode)
VALUES 
("5NPDH4AE8EH125303", "2020-01-09", 15, "Chevrolet", "Express Passenger", 2018, 3),
("3C6TD5ET8CG453632", "2018-09-30", 5, "Subaru", "Impreza", 2015, 2),
("5N1AA0NC1DN312580", "2015-07-20", 5, "Volkswagen", "Golf 7", 2020, 2),
("1ZVBP8JS1C5665223", "2009-03-17", 12, "Nissan", "NV", 2012, 3),
("WBXPC934X9W965325", "2012-05-18", 16, "Toyota", "Quantum", 2019, 3),
("YBXPC934X9W963325", "2012-05-18", 6, "BMW", "X6", 2019, 3),
("TTXPC934X9W965325", "2012-05-18", 6, "Audi", "Q7", 2019, 3),
("1G6YV36A565629760", "2016-12-02", 5, "Mercedes-Benz", "C-200", 2008, 2),
("1G6YVERTYT5629760", "2016-12-02", 5, "Mercedes-Benz", "C63 AMG", 2008, 2);  

INSERT INTO depot 
(depotName, streetNumber, streetName, town, contactNumber, numberOfBedsAvailable)
VALUES 
("Hamilton Building", 1, "Prince Alfred", "Grahamstown", "0123456789", 15),
("Gallagher Convention Centre", 19, "Richards Drive", "Midrand", "0123456789", 9),
("The Bat Centre", 45, "Small craft harbour", "Durban", "0123456789", 39),
("The Pavilion Clock Tower", 5, "South Arm Road", "Cape Town", "0123456789", 21); 

INSERT INTO driverlicense 
(driverID, licenseCode)
VALUES 
(1, 2),
(2, 2),
(2, 3),
(2, 1),
(3, 2),
(4, 2),
(5, 2),
(5, 4),
(6, 2);
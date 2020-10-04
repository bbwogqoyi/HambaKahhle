use blackpeakltd;
-- Note: The date format for mysql insert query is YYYY-MM-DD

INSERT INTO clients (firstName, lastName, contactNumber, email, password)
VALUES 
("Stephannie", "Fleis", "(295) 1398451", "wfleis0@e-recht24.de", "CLq06KEmk"),
("Sisely", "Faulconer", "(218) 9827840", "sfaulconer1@phoca.cz", "ACP9XMOR"),
("Devinne", "Jakucewicz", "(816) 9583653", "djakucewicz2@flickr.com", "qLcVAsW"),
("Briano", "Pawlowicz", "(368) 3454701", "bpawlowicz3@umn.edu", "7LYRBk1VCeH"),
("Phyllis", "Terry", "(441) 3838453", "pterry4@yolasite.com", "X23tmcflL"),
("Kienan", "Riha", "(864) 7589189", "kriha5@e-recht24.de", "tumrYDM");

INSERT INTO booking 
(initialCollectionPoint, startDate, endDate, numberOfPassengers, clientID, status)
VALUES 
("Wukari", "2020-08-07", "2020-10-07", 15, 1, 1),
("Fengshan", "2020-04-22", "2020-10-14", 21, 2, 1),
("Gedongmulyo", "2020-04-08", "2020-10-07", 12, 3, 1),
("Kyenjojo", "2020-08-07", "2020-10-07", 8, 4, 1),
("Tagiura", "2020-11-13", "2021-01-07", 3, 5, 1),
("Sabanalarga", "2020-08-07", "2020-10-07", 2, 6, 1);

INSERT INTO driver 
(firstName, lastName, dateOFBirth, hometown, contactNumber)
VALUES 
("Mallorie", "Smieton", "1992-08-09", "Cape Town", "(476) 1280342"),
("Gallagher", "Picott", "2000-02-04", "Grahamstown", "(203) 8128812"),
("Archibald", "Tissier", "2001-06-21", "Johannesburg", "(684) 1478174"),
("Carlene", "Sanchiz", "1997-01-12", "Durban", "(189) 4626528"),
("Regan", "Spillman", "2001-06-20", "East London", "(446) 3526151"),
("Alejoa", "Duddell", "1997-10-08", "Kimberley", "(340) 4314005");

INSERT INTO license(licenseCode, description, classification)
VALUES
(1, 'Any motorcycle up to a engine capacity greater than 125 CC. Speed bikes, Touring bikes, Choppers & Cruisers with or without a side car falls into this category' , 'Motorcycles'),
(2, 'Vehicles (except motorcycles) with tare weight of 3 500 kilograms or less; and minibuses, buses and goods vehicles with gross vehicle mass (GVM) of 3 500 kg or less. A trailer with GVM of 750 kg or less may be attached' , 'Light Motor Vehicles'),
(3, 'Vehicles with tare weight between 3 500 kg and 16 000 kg; minibuses, buses and goods vehicles with GVM between 3 500 kg and 16 000 kg. A trailer with GVM of 750 kg or less may be attached' , 'Heavy Motor Vehicles'),
(4, 'Articulated vehicles with gross combination mass (GCM) of between 3 500 kg and 16 000 kg, or less; and vehicles allowed by Code 3 but with a trailer with GVM greater than 750 kg' , 'Combinations & Articulated Vehicles');

INSERT INTO vehicle 
(registrationNumber, dateOfPurchase, numberOfSeats, make, model, year, licenseCode)
VALUES 
("5NPDH4AE8EH125303", "2020-01-09", 15, "Chevrolet", "Express Passenger", 2018, 3),
("3C6TD5ET8CG453632", "2018-09-30", 5, "Subaru", "Impreza", 2015, 2),
("5N1AA0NC1DN312580", "2015-07-20", 5, "Volkswagen", "Golf 7", 2020, 2),
("1ZVBP8JS1C5665223", "2009-03-17", 12, "Nissan", "NV", 2012, 3),
("WBXPC934X9W965325", "2012-05-18", 16, "Toyota", "Quantum", 2019, 3),
("1G6YV36A565629760", "2016-12-02", 5, "Mercedes-Benz", "C-200", 2008, 2);  

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
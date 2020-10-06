USE blackpeakltd;

INSERT INTO license(licenseCode, description, classification)
VALUES
(1, 'Any motorcycle up to a engine capacity greater than 125 CC. Speed bikes, Touring bikes, Choppers & Cruisers with or without a side car falls into this category' , 'Motorcycles'),
(2, 'Vehicles (except motorcycles) with tare weight of 3 500 kilograms or less; and minibuses, buses and goods vehicles with gross vehicle mass (GVM) of 3 500 kg or less. A trailer with GVM of 750 kg or less may be attached' , 'Light Motor Vehicles'),
(3, 'Vehicles with tare weight between 3 500 kg and 16 000 kg; minibuses, buses and goods vehicles with GVM between 3 500 kg and 16 000 kg. A trailer with GVM of 750 kg or less may be attached' , 'Heavy Motor Vehicles'),
(4, 'Articulated vehicles with gross combination mass (GCM) of between 3 500 kg and 16 000 kg, or less; and vehicles allowed by Code 3 but with a trailer with GVM greater than 750 kg' , 'Combinations & Articulated Vehicles');
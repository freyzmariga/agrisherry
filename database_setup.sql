-- ============================================================
-- AGRISHERRY FRUIT SEEDLINGS - Database Setup
-- Run this SQL in phpMyAdmin or MySQL CLI to set up the DB
-- ============================================================

CREATE DATABASE IF NOT EXISTS agrisherry_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE agrisherry_db;

-- Products / Seedlings Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    description TEXT,
    image VARCHAR(255),
    whatsapp_text VARCHAR(300),
    featured TINYINT(1) DEFAULT 0,
    in_stock TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Enquiries / Contact Table
CREATE TABLE IF NOT EXISTS enquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(200),
    phone VARCHAR(30),
    message TEXT NOT NULL,
    status ENUM('new','read','replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Testimonials Table
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    location VARCHAR(150),
    message TEXT NOT NULL,
    rating TINYINT DEFAULT 5,
    approved TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- SEED PRODUCTS DATA
-- ============================================================
INSERT INTO products (name, category, price, description, image, whatsapp_text, featured) VALUES
-- Avocados
('Grafted Hass Avocado', 'Avocados', 150, 'Premium grafted Hass avocado seedlings. High yielding, disease resistant variety. Ready for transplanting.', 'images/avocado.jpg', 'Grafted Hass Avocados @150', 1),
('Grafted Fuerte Avocado', 'Avocados', 150, 'Grafted Fuerte avocado seedlings. Large fruits with excellent taste. Very popular commercial variety.', 'images/avocado.jpg', 'Grafted Fuerte Avocado @150', 1),

-- Passion Fruits
('Grafted Tree Tomato', 'Passion & Specialty', 100, 'Grafted tree tomato (tamarillo). Fast fruiting, high yields. Excellent for juice and fresh consumption.', NULL, 'Grafted Tree Tomato @100', 0),
('Grafted Purple Passion', 'Passion & Specialty', 100, 'Grafted purple passion fruit seedlings. Early fruiting, sweet aromatic fruits.', NULL, 'Grafted Purple Passion @100', 1),
('Yellow Passion', 'Passion & Specialty', 100, 'Yellow passion fruit seedlings. Large fruits, high juice content. Very popular in the market.', NULL, 'Yellow Passion @100', 0),
('Sweet Granadilla', 'Passion & Specialty', 100, 'Sweet granadilla passion fruit. Unique sweet flavor, beautiful orange skin when ripe.', NULL, 'Sweet Granadilla @100', 0),
('Giant Passion', 'Passion & Specialty', 150, 'Giant passion fruit variety. Exceptionally large fruits with great market value.', NULL, 'Giant Passion @150', 0),

-- Citrus
('Grafted Mangoes', 'Mangoes', 150, 'Grafted mango seedlings. Multiple top varieties available. Early bearing, high yields.', NULL, 'Grafted Mangoes @150', 1),
('Grafted Oranges', 'Citrus', 150, 'Grafted orange seedlings. Sweet, juicy fruits. Excellent for fresh consumption and juicing.', NULL, 'Grafted Oranges @150', 0),
('Grafted Tangerines', 'Citrus', 200, 'Grafted tangerine seedlings. Easy to peel, sweet segments. Very popular with children.', NULL, 'Grafted Tangerines @200', 0),
('Grafted Pixie', 'Citrus', 200, 'Grafted Pixie orange. Seedless, easy peel, sweet flavor. Premium variety.', NULL, 'Grafted Pixie @200', 0),
('Rough Lemon', 'Citrus', 100, 'Rough lemon rootstock and fruiting seedlings. Hardy, disease resistant.', NULL, 'Rough Lemon @100', 0),
('Lime Variety', 'Citrus', 250, 'Lime seedlings. Multiple varieties available. Great for cooking and beverages.', NULL, 'Lime Variety @250', 0),
('Blood Orange', 'Citrus', 500, 'Blood orange seedlings. Stunning red flesh, rich flavor. Premium exotic variety.', NULL, 'Blood Orange @500', 1),
('Variegated Lemon', 'Citrus', 500, 'Variegated lemon with striped skin. Ornamental and edible. Very unique variety.', NULL, 'Variegated Lemon @500', 0),
('Meyer Lemon', 'Citrus', 500, 'Meyer lemon - sweeter than regular lemon. Thin skin, very juicy. Highly sought after.', NULL, 'Meyer Lemon @500', 0),
('Hybrid Lemon', 'Citrus', 700, 'Hybrid lemon with superior characteristics. Very high yielding, vigorous grower.', NULL, 'Hybrid Lemon @700', 0),
('Mineola Orange', 'Citrus', 300, 'Mineola orange (Minneola tangelo). Large fruits, rich tangy flavor. Premium quality.', NULL, 'Mineola Orange @300', 0),
('Pomelo', 'Citrus', 300, 'Pomelo seedlings. Largest citrus fruit. Mild, sweet flavor. Great for fresh eating.', NULL, 'Pomelo @300', 0),
('Clementine Orange', 'Citrus', 500, 'Clementine orange. Seedless, easy peel, sweet taste. Popular export variety.', NULL, 'Clementine Orange @500', 0),
('Grapefruit', 'Citrus', 500, 'Grapefruit seedlings. Tangy fresh flavor, high in vitamins. Great for health-conscious consumers.', NULL, 'Grapefruit @500', 0),

-- Guavas
('Guava Red', 'Guavas', 100, 'Red guava seedlings. Sweet, aromatic fruits with pink flesh. Rich in Vitamin C.', NULL, 'Guavas Red @100', 0),
('Guava White', 'Guavas', 100, 'White guava seedlings. Crispy texture, mildly sweet. Great for fresh eating.', NULL, 'Guava White @100', 0),
('Cherry Guava', 'Guavas', 500, 'Cherry guava (Psidium cattleianum). Small, sweet red fruits. Excellent for jams.', NULL, 'Cherry Guava @500', 0),
('Brazilian Cherry', 'Guavas', 500, 'Brazilian cherry (Pitanga). Unique star-shaped fruits, sweet-tart flavor. Very ornamental.', NULL, 'Brazilian Cherry @500', 0),

-- Pawpaw
('Dwarf Pawpaw Malkia F1', 'Pawpaw', 100, 'Dwarf Malkia F1 pawpaw. High yielding, compact plant. Excellent for small farms.', NULL, 'Dwarf Pawpaw Malkia F1 @100', 1),

-- Apples & Temperate
('Grafted Apples to Loquat', 'Apples & Temperate', 400, 'Apple grafted onto loquat rootstock. Adapts well to Kenyan highlands. Delicious fruits.', 'images/apples.jpg', 'Grafted Apples to Loquat @400', 0),
('Grafted Apple to Apple', 'Apples & Temperate', 600, 'Apple on apple rootstock. Pure apple variety. Best for high altitude areas.', 'images/apples3.jpg', 'Grafted Apple to Apple @600', 1),
('Wambugu Apple', 'Apples & Temperate', 1200, 'Wambugu apple - specially bred for Kenyan conditions. No chilling requirement. Fruit at lower altitudes.', NULL, 'Wambugu Apple @1200', 1),
('Pears Variety', 'Apples & Temperate', 350, 'Pear seedlings. Multiple varieties. Juicy, sweet fruits. Suitable for highland areas.', NULL, 'Pears Variety @350', 0),
('Plums Variety', 'Apples & Temperate', 400, 'Plum seedlings. Multiple varieties. Rich flavored stone fruits. Great commercial potential.', NULL, 'Plums Variety @400', 0),
('Peaches Variety', 'Apples & Temperate', 900, 'Peach seedlings. Multiple varieties. Sweet, juicy fruits. Suitable for highland growing.', NULL, 'Peaches Variety @900', 0),

-- Nuts
('Grafted Macadamia Nuts', 'Nuts', 400, 'Grafted macadamia nut trees. High value crop. Early bearing 3-4 years. Excellent for export.', NULL, 'Grafted Macadamia Nuts @400', 1),
('Grafted Cashew Nut', 'Nuts', 500, 'Grafted cashew nut seedlings. High yielding variety. Suitable for coastal and lowland areas.', NULL, 'Grafted Cashew Nut @500', 0),
('Cashew Nut', 'Nuts', 300, 'Cashew nut seedlings (standard). Reliable yielder. Good for drier regions.', NULL, 'Cashew Nut @300', 0),

-- Exotic & Specialty
('Pomegranate (Kukumaga)', 'Exotic', 300, 'Pomegranate seedlings. Ruby red fruits packed with antioxidants. Drought tolerant once established.', NULL, 'Pomegranates @300', 0),
('Kiwi Variety', 'Exotic', 500, 'Kiwi fruit seedlings. Nutritious fruits. Suitable for highland areas with good trellising.', NULL, 'Kiwi variety @500', 0),
('Grapes Table/Wine', 'Exotic', 300, 'Grape vines. Both table and wine varieties available. Excellent for warm, dry areas.', NULL, 'Grapes table/wine @300', 0),
('Jackfruit', 'Exotic', 300, 'Jackfruit seedlings. Largest tree fruit. Sweet pods, very nutritious. Excellent for food security.', NULL, 'Jack fruit @300', 0),
('Fig Tree Variety', 'Exotic', 1000, 'Fig tree seedlings. Multiple varieties. Sweet, nutritious fruits. Good for hot, dry regions.', NULL, 'Fig Tree variety @1000', 0),
('Pepino Melon', 'Exotic', 100, 'Pepino melon seedlings. Unique melon-like flavor. Fast growing, prolific bearer.', NULL, 'Pepino melon @100', 0),
('Moringa', 'Exotic', 300, 'Moringa (Miracle Tree) seedlings. Highly nutritious leaves and seeds. Fast growing.', NULL, 'Moringa @300', 0),
('Soursop', 'Exotic', 350, 'Soursop (Graviola) seedlings. Creamy white flesh. Very popular for juices and health benefits.', NULL, 'Soursop @350', 1),
('Custard Apple', 'Exotic', 300, 'Custard apple seedlings. Creamy, sweet flesh. Unique tropical fruit for home and market.', NULL, 'Custard Apple @300', 0),
('Persimmon Variety', 'Exotic', 1200, 'Persimmon seedlings. Multiple varieties. Honey sweet flavor when ripe. Premium value crop.', NULL, 'Persimmon variety @1200', 0),
('Dragon Fruit Variety', 'Exotic', 500, 'Dragon fruit (pitaya) cuttings/seedlings. Stunning appearance, sweet flesh. High market demand.', NULL, 'Dragon Fruit variety @500', 1),
('Gooseberry', 'Exotic', 300, 'Gooseberry seedlings. Tart-sweet small fruits. Rich in Vitamin C. Great for jams.', NULL, 'Goose berry @300', 0),
('Dwarf Coconut', 'Exotic', 500, 'Dwarf coconut seedlings. Early bearing 3-4 years. Suitable for coastal and warm lowlands.', NULL, 'Dwarf Coconut @500', 0),
('Jabuticaba', 'Exotic', 2000, 'Jabuticaba (Brazilian Grape Tree). Rare tropical fruit growing on the trunk. Unique novelty crop.', NULL, 'Jabuticaba @2000', 0),
('Canistel / Egg Fruit', 'Exotic', 2500, 'Canistel (Egg Fruit) seedlings. Rare tropical fruit with custardy texture. High value novelty.', NULL, 'Canistel/Egg fruit @2500', 0),
('Olive Seedlings', 'Exotic', 1200, 'Olive tree seedlings. Multiple varieties. Long-lived productive trees. Suitable for dry areas.', NULL, 'Olive Seedlings @1200', 0),

-- Berries
('Raspberry Variety', 'Berries', 600, 'Raspberry seedlings. Multiple varieties. Delicious berries. Suitable for highland growing.', NULL, 'Raspberry variety @600', 0),
('Strawberry', 'Berries', 100, 'Strawberry runners/seedlings. High yielding, sweet berries. Great for home and commercial farms.', NULL, 'Strawberry @100', 1),
('Mulberry', 'Berries', 150, 'Mulberry seedlings. Sweet dark berries. Dual purpose - fruits and silkworm feed.', NULL, 'Mulberry @150', 0),
('Blueberry', 'Berries', 2000, 'Blueberry seedlings. Premium superfruit. Suitable for highland areas. High market demand.', NULL, 'Blueberry @2000', 1),
('Zambarau (Java Plum)', 'Berries', 500, 'Zambarau (Java Plum/Jambolan) seedlings. Dark purple fruits. Good for juices and wine.', NULL, 'Zambarau @500', 0),
('White Sapote', 'Exotic', 400, 'White sapote seedlings. Creamy sweet flesh. Rare exotic fruit with growing demand.', NULL, 'White Supporter @400', 0),

-- Bananas
('Cooking Tissue Culture Banana', 'Bananas', 250, 'Cooking tissue culture banana plantlets. Certified disease-free. High yielding variety.', NULL, 'Cooking Tissue culture bananas @250', 0),
('Ripening Tissue Culture Banana', 'Bananas', 250, 'Ripening/sweet tissue culture banana. Disease-free planting material. Excellent yields.', NULL, 'Ripening tissue culture banana @250', 0),
('Sweet Banana', 'Bananas', 250, 'Sweet banana seedlings/suckers. Classic dessert banana. Easy to grow.', NULL, 'Sweet banana @250', 0),
('Kisii Matoke', 'Bananas', 250, 'Kisii matoke highland banana. Staple food variety. Very high yielding.', NULL, 'Kisii matoke @250', 1),
('Plantain', 'Bananas', 500, 'Plantain banana seedlings. Large cooking banana. Excellent food security crop.', NULL, 'Plantain @500', 0);

-- ============================================================
-- SEED TESTIMONIALS
-- ============================================================
INSERT INTO testimonials (name, location, message, rating) VALUES
('James Mwangi', 'Nyeri County', 'I ordered 50 Wambugu Apple seedlings from Agrisherry. Delivery was fast and all seedlings were healthy and well-rooted. Very happy with my purchase!', 5),
('Grace Otieno', 'Kisumu', 'Excellent service! The grafted Hass avocados I received are growing so well. Agrisherry staff gave me great advice on spacing and care. Highly recommended.', 5),
('Peter Kamau', 'Nakuru', 'I have been buying from Agrisherry for 3 years now. Always consistent quality. My blueberry farm is thriving thanks to their quality seedlings.', 5),
('Mary Njeri', 'Meru County', 'The dragon fruit cuttings were fresh and healthy. Started rooting within 2 weeks. Great packaging for long distance delivery.', 5),
('Samuel Ochieng', 'Siaya', 'Ordered strawberry runners and they are all doing great in my greenhouse. Will definitely order more varieties soon.', 5);

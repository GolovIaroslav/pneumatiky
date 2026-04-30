BEGIN;

TRUNCATE TABLE cart_items, carts, order_items, orders, product_images, products, categories, sessions, password_reset_tokens, users RESTART IDENTITY CASCADE;

INSERT INTO categories (id, name, parent_id, created_at, updated_at) VALUES
(1, 'Auto', NULL, NOW(), NOW()),
(2, 'Moto', NULL, NOW(), NOW()),
(3, 'Cyklo', NULL, NOW(), NOW()),
(4, 'Traktorove', NULL, NOW(), NOW()),
(5, 'Pneumatiky', 1, NOW(), NOW()),
(6, 'Pneumatiky', 2, NOW(), NOW()),
(7, 'Pneumatiky', 3, NOW(), NOW()),
(8, 'Pneumatiky', 4, NOW(), NOW());

INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, is_admin) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$8wuzGNNfNK73EFWbTqQ8WO594j7QrwfDpWyGuii//XwkVo60m4dle', NULL, NOW(), NOW(), TRUE),
(2, 'Test User', 'test@example.com', NULL, '$2y$12$PYmY3ydFXtBNJH8iYMrVA.oi3gNUnSUmQVIa1baL4BUMHqLQVzdCC', NULL, NOW(), NOW(), FALSE);

INSERT INTO products (id, category_id, brand, name, description, price, stock, season, has_spikes, width, profile, diameter, created_at, updated_at) VALUES
(1, 5, 'Veltrix', 'Sunpath A1', 'Demo popis produktu pre katalog a detail produktu.', 58.90, 25, 'letne', FALSE, 205, 55, 'R16', NOW(), NOW()),
(2, 5, 'Arqon', 'Helia Pro', 'Demo popis produktu pre katalog a detail produktu.', 114.90, 13, 'letne', FALSE, 225, 45, 'R17', NOW(), NOW()),
(3, 5, 'Cryon', 'Trackflow RS', 'Demo popis produktu pre katalog a detail produktu.', 101.20, 15, 'letne', FALSE, 235, 45, 'R18', NOW(), NOW()),
(4, 5, 'Teronix', 'Driftline X', 'Demo popis produktu pre katalog a detail produktu.', 77.90, 16, 'letne', FALSE, 215, 55, 'R17', NOW(), NOW()),
(5, 5, 'Veltrix', 'Swiftlane GT', 'Demo popis produktu pre katalog a detail produktu.', 173.00, 11, 'letne', FALSE, 245, 40, 'R18', NOW(), NOW()),
(6, 5, 'Arqon', 'Roadcrest V2', 'Demo popis produktu pre katalog a detail produktu.', 72.40, 22, 'letne', FALSE, 195, 65, 'R15', NOW(), NOW()),
(7, 5, 'Cryon', 'Asphalt Edge', 'Demo popis produktu pre katalog a detail produktu.', 109.30, 14, 'letne', FALSE, 225, 50, 'R17', NOW(), NOW()),
(8, 5, 'Teronix', 'Velocity Prime', 'Demo popis produktu pre katalog a detail produktu.', 83.70, 19, 'letne', FALSE, 205, 60, 'R16', NOW(), NOW()),
(9, 5, 'Veltrix', 'Heatline Sport', 'Demo popis produktu pre katalog a detail produktu.', 186.50, 9, 'letne', FALSE, 235, 40, 'R19', NOW(), NOW()),
(10, 5, 'Arqon', 'Tarmac Echo', 'Demo popis produktu pre katalog a detail produktu.', 94.10, 17, 'letne', FALSE, 215, 50, 'R17', NOW(), NOW()),
(11, 5, 'Cryon', 'Drygrip One', 'Demo popis produktu pre katalog a detail produktu.', 69.90, 21, 'letne', FALSE, 195, 55, 'R16', NOW(), NOW()),
(12, 5, 'Teronix', 'Fasttrail S', 'Demo popis produktu pre katalog a detail produktu.', 128.60, 12, 'letne', FALSE, 225, 45, 'R18', NOW(), NOW()),
(13, 5, 'Veltrix', 'Frostpeak N1', 'Demo popis produktu pre katalog a detail produktu.', 96.80, 18, 'zimne', FALSE, 205, 55, 'R16', NOW(), NOW()),
(14, 5, 'Arqon', 'Icegrid N7', 'Demo popis produktu pre katalog a detail produktu.', 129.50, 9, 'zimne', FALSE, 205, 55, 'R16', NOW(), NOW()),
(15, 5, 'Cryon', 'Snowguard X', 'Demo popis produktu pre katalog a detail produktu.', 99.90, 14, 'zimne', FALSE, 195, 65, 'R15', NOW(), NOW()),
(16, 5, 'Teronix', 'Clawline S', 'Demo popis produktu pre katalog a detail produktu.', 139.00, 7, 'zimne', TRUE, 215, 60, 'R16', NOW(), NOW()),
(17, 5, 'Veltrix', 'Nordline Pro', 'Demo popis produktu pre katalog a detail produktu.', 121.80, 10, 'zimne', FALSE, 225, 50, 'R17', NOW(), NOW()),
(18, 5, 'Arqon', 'Blizzard Run', 'Demo popis produktu pre katalog a detail produktu.', 148.90, 8, 'zimne', FALSE, 235, 45, 'R18', NOW(), NOW()),
(19, 5, 'Cryon', 'Winterlock Z', 'Demo popis produktu pre katalog a detail produktu.', 116.40, 11, 'zimne', FALSE, 215, 55, 'R17', NOW(), NOW()),
(20, 5, 'Teronix', 'Coldtrace V', 'Demo popis produktu pre katalog a detail produktu.', 104.20, 13, 'zimne', FALSE, 205, 60, 'R16', NOW(), NOW()),
(21, 5, 'Veltrix', 'Icecraft W', 'Demo popis produktu pre katalog a detail produktu.', 118.70, 12, 'zimne', FALSE, 225, 45, 'R17', NOW(), NOW()),
(22, 5, 'Arqon', 'Snowlane 4D', 'Demo popis produktu pre katalog a detail produktu.', 92.50, 16, 'zimne', FALSE, 195, 65, 'R16', NOW(), NOW()),
(23, 5, 'Cryon', 'Frostline T', 'Demo popis produktu pre katalog a detail produktu.', 110.90, 11, 'zimne', FALSE, 215, 50, 'R17', NOW(), NOW()),
(24, 5, 'Teronix', 'Nordice Max', 'Demo popis produktu pre katalog a detail produktu.', 154.30, 7, 'zimne', FALSE, 235, 45, 'R18', NOW(), NOW()),
(25, 5, 'Veltrix', 'Alltrail 4S', 'Demo popis produktu pre katalog a detail produktu.', 91.40, 20, 'celorocne', FALSE, 195, 65, 'R15', NOW(), NOW()),
(26, 5, 'Arqon', 'Crossseason M', 'Demo popis produktu pre katalog a detail produktu.', 98.60, 17, 'celorocne', FALSE, 205, 55, 'R16', NOW(), NOW()),
(27, 5, 'Cryon', 'Yearway Plus', 'Demo popis produktu pre katalog a detail produktu.', 112.20, 12, 'celorocne', FALSE, 215, 55, 'R17', NOW(), NOW()),
(28, 5, 'Teronix', 'Omnigrip A', 'Demo popis produktu pre katalog a detail produktu.', 119.00, 10, 'celorocne', FALSE, 225, 45, 'R17', NOW(), NOW()),
(29, 5, 'Veltrix', 'Seasonline C', 'Demo popis produktu pre katalog a detail produktu.', 94.70, 15, 'celorocne', FALSE, 195, 60, 'R16', NOW(), NOW()),
(30, 6, 'Veltrix', 'Streetbite M1', 'Demo popis produktu pre katalog a detail produktu.', 84.90, 18, 'letne', FALSE, 120, 70, 'R17', NOW(), NOW()),
(31, 6, 'Arqon', 'Apexrun M2', 'Demo popis produktu pre katalog a detail produktu.', 96.50, 14, 'letne', FALSE, 160, 60, 'R17', NOW(), NOW()),
(32, 6, 'Cryon', 'Raincut M3', 'Demo popis produktu pre katalog a detail produktu.', 109.00, 9, 'zimne', FALSE, 180, 55, 'R17', NOW(), NOW()),
(33, 6, 'Teronix', 'Trailhook M4', 'Demo popis produktu pre katalog a detail produktu.', 92.30, 12, 'celorocne', FALSE, 150, 70, 'R17', NOW(), NOW()),
(34, 6, 'Veltrix', 'Roadpulse M5', 'Demo popis produktu pre katalog a detail produktu.', 118.40, 8, 'letne', FALSE, 190, 50, 'R17', NOW(), NOW()),
(35, 6, 'Arqon', 'Quicklean M6', 'Demo popis produktu pre katalog a detail produktu.', 76.90, 16, 'zimne', FALSE, 110, 80, 'R18', NOW(), NOW()),
(36, 6, 'Cryon', 'Stormgrip M7', 'Demo popis produktu pre katalog a detail produktu.', 102.60, 11, 'letne', FALSE, 170, 60, 'R17', NOW(), NOW()),
(37, 6, 'Teronix', 'Urbanline M8', 'Demo popis produktu pre katalog a detail produktu.', 88.70, 13, 'celorocne', FALSE, 140, 70, 'R17', NOW(), NOW()),
(38, 6, 'Veltrix', 'Cornershift M9', 'Demo popis produktu pre katalog a detail produktu.', 121.50, 9, 'letne', FALSE, 180, 55, 'R18', NOW(), NOW()),
(39, 6, 'Arqon', 'Raceform M10', 'Demo popis produktu pre katalog a detail produktu.', 93.40, 15, 'zimne', FALSE, 120, 70, 'R17', NOW(), NOW()),
(40, 6, 'Cryon', 'Longride M11', 'Demo popis produktu pre katalog a detail produktu.', 99.90, 12, 'celorocne', FALSE, 160, 60, 'R17', NOW(), NOW()),
(41, 7, 'Veltrix', 'Gripnest B1', 'Demo popis produktu pre katalog a detail produktu.', 19.90, 40, 'letne', FALSE, 40, 0, 'R26', NOW(), NOW()),
(42, 7, 'Arqon', 'Urbanroll B2', 'Demo popis produktu pre katalog a detail produktu.', 17.50, 34, 'letne', FALSE, 35, 0, 'R28', NOW(), NOW()),
(43, 7, 'Cryon', 'Trailmesh B3', 'Demo popis produktu pre katalog a detail produktu.', 24.90, 30, 'celorocne', FALSE, 45, 0, 'R27.5', NOW(), NOW()),
(44, 7, 'Teronix', 'Snowloop B4', 'Demo popis produktu pre katalog a detail produktu.', 29.90, 20, 'zimne', TRUE, 42, 0, 'R27.5', NOW(), NOW()),
(45, 7, 'Veltrix', 'Cityfoam B5', 'Demo popis produktu pre katalog a detail produktu.', 16.20, 27, 'letne', FALSE, 32, 0, 'R28', NOW(), NOW()),
(46, 7, 'Arqon', 'Dirtcurl B6', 'Demo popis produktu pre katalog a detail produktu.', 27.40, 19, 'celorocne', FALSE, 50, 0, 'R29', NOW(), NOW()),
(47, 7, 'Cryon', 'Trailpeak B7', 'Demo popis produktu pre katalog a detail produktu.', 26.10, 23, 'letne', FALSE, 47, 0, 'R29', NOW(), NOW()),
(48, 7, 'Teronix', 'Commuter B8', 'Demo popis produktu pre katalog a detail produktu.', 18.60, 31, 'letne', FALSE, 38, 0, 'R28', NOW(), NOW()),
(49, 7, 'Veltrix', 'Mudline B9', 'Demo popis produktu pre katalog a detail produktu.', 28.90, 17, 'celorocne', FALSE, 52, 0, 'R27.5', NOW(), NOW()),
(50, 7, 'Arqon', 'Roadzip B10', 'Demo popis produktu pre katalog a detail produktu.', 15.80, 36, 'letne', FALSE, 30, 0, 'R28', NOW(), NOW()),
(51, 7, 'Cryon', 'Forestgrip B11', 'Demo popis produktu pre katalog a detail produktu.', 27.90, 21, 'celorocne', FALSE, 48, 0, 'R29', NOW(), NOW()),
(52, 8, 'Teronix', 'Fieldtorq T1', 'Demo popis produktu pre katalog a detail produktu.', 219.90, 8, 'celorocne', FALSE, 320, 70, 'R24', NOW(), NOW()),
(53, 8, 'Cryon', 'Furrowmax T2', 'Demo popis produktu pre katalog a detail produktu.', 246.00, 6, 'celorocne', FALSE, 340, 65, 'R28', NOW(), NOW()),
(54, 8, 'Arqon', 'Soilmaster T3', 'Demo popis produktu pre katalog a detail produktu.', 271.50, 5, 'celorocne', FALSE, 360, 70, 'R30', NOW(), NOW()),
(55, 8, 'Veltrix', 'Loadline T4', 'Demo popis produktu pre katalog a detail produktu.', 204.20, 9, 'celorocne', FALSE, 300, 80, 'R24', NOW(), NOW()),
(56, 8, 'Teronix', 'Agroline T5', 'Demo popis produktu pre katalog a detail produktu.', 286.40, 4, 'celorocne', FALSE, 380, 70, 'R30', NOW(), NOW()),
(57, 8, 'Cryon', 'Plowgrip T6', 'Demo popis produktu pre katalog a detail produktu.', 233.70, 7, 'celorocne', FALSE, 320, 85, 'R24', NOW(), NOW()),
(58, 8, 'Arqon', 'Harvestor T7', 'Demo popis produktu pre katalog a detail produktu.', 254.90, 6, 'celorocne', FALSE, 340, 70, 'R28', NOW(), NOW()),
(59, 8, 'Veltrix', 'Farmtrail T8', 'Demo popis produktu pre katalog a detail produktu.', 211.30, 8, 'celorocne', FALSE, 300, 70, 'R24', NOW(), NOW()),
(60, 8, 'Teronix', 'Loadcrest T9', 'Demo popis produktu pre katalog a detail produktu.', 279.20, 5, 'celorocne', FALSE, 360, 65, 'R30', NOW(), NOW()),
(61, 8, 'Cryon', 'Terrahook T10', 'Demo popis produktu pre katalog a detail produktu.', 241.80, 6, 'celorocne', FALSE, 320, 70, 'R28', NOW(), NOW());

WITH product_groups AS (
    SELECT
        p.id,
        parent.name AS parent_name,
        p.season,
        row_number() OVER (PARTITION BY parent.name, p.season ORDER BY p.id) AS rn
    FROM products p
    JOIN categories child ON child.id = p.category_id
    JOIN categories parent ON parent.id = child.parent_id
)
INSERT INTO product_images (product_id, image_path, is_main, created_at, updated_at)
SELECT
    id,
    CASE
        WHEN parent_name = 'Auto' AND season = 'letne' THEN 'images/products/letne' || rn || '.jpg'
        WHEN parent_name = 'Auto' AND season = 'zimne' THEN 'images/products/zimne' || rn || '.jpg'
        WHEN parent_name = 'Auto' AND season = 'celorocne' THEN 'images/products/letne' || (12 + rn) || '.jpg'
        WHEN parent_name = 'Moto' THEN 'images/products/moto' || rn || '.jpg'
        WHEN parent_name = 'Cyklo' THEN 'images/products/bike' || rn || '.jpg'
        WHEN parent_name = 'Traktorove' THEN 'images/products/traktor' || rn || '.jpg'
    END,
    TRUE,
    NOW(),
    NOW()
FROM product_groups;

WITH product_groups AS (
    SELECT
        p.id,
        parent.name AS parent_name
    FROM products p
    JOIN categories child ON child.id = p.category_id
    JOIN categories parent ON parent.id = child.parent_id
),
detail_images AS (
    SELECT *
    FROM (VALUES
        ('bike_detail1.jpg'),
        ('bike_detail2.jpg'),
        ('bike_detail3.jpg'),
        ('bike_detail4.jpg')
    ) AS t(filename)
)
INSERT INTO product_images (product_id, image_path, is_main, created_at, updated_at)
SELECT
    pg.id,
    'images/products/' || d.filename,
    FALSE,
    NOW(),
    NOW()
FROM product_groups pg
CROSS JOIN detail_images d
WHERE pg.parent_name IN ('Moto', 'Cyklo');

WITH product_groups AS (
    SELECT
        p.id,
        parent.name AS parent_name
    FROM products p
    JOIN categories child ON child.id = p.category_id
    JOIN categories parent ON parent.id = child.parent_id
),
detail_images AS (
    SELECT *
    FROM (VALUES
        ('letne_detail1.jpg'),
        ('letne_detail2.jpg'),
        ('letne_detail3.jpg'),
        ('letne_detail4.jpg')
    ) AS t(filename)
)
INSERT INTO product_images (product_id, image_path, is_main, created_at, updated_at)
SELECT
    pg.id,
    'images/products/' || d.filename,
    FALSE,
    NOW(),
    NOW()
FROM product_groups pg
CROSS JOIN detail_images d
WHERE pg.parent_name IN ('Auto', 'Traktorove');

COMMIT;

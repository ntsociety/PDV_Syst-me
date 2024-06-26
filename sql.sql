CREATE TABLE admins (id int(11) PRIMARY KEY AUTO_INCREMENT, 
    name varchar(191), 
    email varchar(191), 
    phone varchar(191) null, 
    password varchar(191), 
    is_ban boolean DEFAULT 0, 
    created_at timestamp DEFAULT CURRENT_TIMESTAMP, 
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP);

CREATE TABLE categories (id int(11) PRIMARY KEY AUTO_INCREMENT, 
    name varchar(191), 
    description varchar(191) null, 
    status boolean DEFAULT 0,  
    created_at timestamp DEFAULT CURRENT_TIMESTAMP, 
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP);

CREATE TABLE supliers (id int(11) PRIMARY KEY AUTO_INCREMENT, 
    name varchar(191), 
    email varchar(191) null,
    phone varchar(191) null, 
    adresse varchar(191) null,   
    created_at timestamp DEFAULT CURRENT_TIMESTAMP, 
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP);

CREATE TABLE produits (id int(11) PRIMARY KEY AUTO_INCREMENT, 
    name varchar(191), 
    description varchar(255) null,
    prix int(11) ,
    quantity int(11),
    category_id int(11) null,
    suplier_id int(11) null,
    status boolean DEFAULT 0,    
    image varchar(191) null,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (suplier_id) REFERENCES supliers(id) ON DELETE CASCADE,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP, 
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP);

CREATE TABLE customers (id int(11) PRIMARY KEY AUTO_INCREMENT, 
    name varchar(191), 
    email varchar(191) null, 
    phone varchar(191) null, 
    adresse varchar(191) null,   
    status boolean DEFAULT 0,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP, 
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP);

CREATE TABLE orders (id int(11) PRIMARY KEY AUTO_INCREMENT, 
    client_id int(11), 
    user_id int(11),
    tracking_no varchar(255) null,
    invoice_no varchar(255) null,
    Prix_total numeric(20) ,
    date_commande date,
    status_commande varchar(100) null,
    payement_mod varchar(100) null,
    FOREIGN KEY (client_id) REFERENCES customers(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES admins(id) ON DELETE CASCADE,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP, 
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP);

CREATE TABLE order_items (id int(11) PRIMARY KEY AUTO_INCREMENT, 
    order_id int(11), 
    prod_id int(11),
    Prix numeric(20),
    quantity int(11),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (prod_id) REFERENCES produits(id) ON DELETE CASCADE,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP, 
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP);
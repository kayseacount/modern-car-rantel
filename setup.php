<?php
require __DIR__ . '/config.php';
$pdo = db();
$adminEmail = 'admin@moderncar.com';
$check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
$check->execute([$adminEmail]);
if (!$check->fetch()) {
    $stmt = $pdo->prepare('INSERT INTO users (name,email,phone,password_hash,role) VALUES (?,?,?,?,?)');
    $stmt->execute(['System Administrator',$adminEmail,'+252630000000',password_hash('Admin123!', PASSWORD_DEFAULT),'admin']);
    $stmt->execute(['Demo Customer','customer@example.com','+252631111111',password_hash('User123!', PASSWORD_DEFAULT),'customer']);
}
$count = (int)$pdo->query('SELECT COUNT(*) FROM cars')->fetchColumn();
if ($count === 0) {
    $cars = [
      ['Toyota Corolla','Sedan',5,35,'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?auto=format&fit=crop&w=900&q=80','Comfortable, reliable and economical for everyday journeys.'],
      ['Toyota Land Cruiser','SUV',7,95,'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?auto=format&fit=crop&w=900&q=80','A spacious SUV for family trips and longer journeys.'],
      ['Hyundai Elantra','Sedan',5,42,'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=900&q=80','Modern styling with a comfortable cabin.'],
      ['Mercedes-Benz E-Class','Luxury',5,120,'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=900&q=80','A refined premium experience for special occasions.'],
      ['Toyota Hiace','Van',12,85,'https://images.unsplash.com/photo-1566933293069-b55c7f326dd4?auto=format&fit=crop&w=900&q=80','Practical people carrier with room for your group.']
    ];
    $stmt=$pdo->prepare('INSERT INTO cars (name,type,seats,price_per_day,image_url,description,available) VALUES (?,?,?,?,?,?,1)');
    foreach($cars as $car) $stmt->execute($car);
}
echo '<h2>Setup completed</h2><p>Demo accounts and sample cars are ready.</p><p><a href="index.php">Open website</a></p><p><strong>Security:</strong> Delete setup.php after running it.</p>';

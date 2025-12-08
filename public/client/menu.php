<?php


require_once "../../Classes/Connection.php";

$db = new Dbh();
$conn = $db->connect();

// Fetch all menu items
$query = "SELECT * FROM menu_items ORDER BY id ASC";
$result = $conn->query($query);

// Categorize
$meals = [];
$snacks = [];
$drinks = [];

while ($row = $result->fetch_assoc()) {
    if ($row['category'] === "Meals") $meals[] = $row;
    if ($row['category'] === "Snacks") $snacks[] = $row;
    if ($row['category'] === "Drinks") $drinks[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu</title>

<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>

<style>
 /* Background Image */
body {
    background: url("../images/back1.jpg") center/cover no-repeat fixed;
    backdrop-filter: brightness(0.8);
}

/* A soft overlay so the text becomes readable */
body::before {
    content: "";
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(4px) brightness(0.7);
    z-index: -1;
}

/* CATEGORY BUTTONS */
.tab-active {
    background: #3671f0ff;
    color: white !important;
    font-weight: bold;
}

/* MENU CARD (bigger & lighter) */
.menu-card {
    background: rgba(255, 255, 255, 0.8);   /* light glass effect */
    border: 2px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(8px);
    border-radius: 20px;
    padding: 20px;
    transition: 0.1s ease;
}

/* Make images bigger and nicer */
.menu-img {
    height: 300px !important;
    object-fit: cover;
    border-radius: 10px;
}

/* Better text colors */
h2 {
    color: #000000ff !important;
}

p {
    color: #000000ff !important;
    font-size: 0.95rem;
}

/* Price color */
.price-tag {
    color: #2563eb;
    font-weight: bold;
    font-size: 1.2rem;
}

/* Fade animation */
.fade {
    animation: fadeIn 0.4s ease;
}
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(10px);}
    to {opacity: 1; transform: translateY(0);}
}

.back-btn {
    margin-top: 80px;  /* adjust higher (negative value = goes up) */
    margin-bottom: 30px;
}

.top-btn {
    margin-top: 40px;
    margin-bottom: 20px;
}
</style>

<script>
function showCategory(cat) {
    // hide all
    document.getElementById("Meals").style.display = "none";
    document.getElementById("Snacks").style.display = "none";
    document.getElementById("Drinks").style.display = "none";

    // show selected
    document.getElementById(cat).style.display = "grid";

    // tab active state
    document.getElementById("btnMeals").classList.remove("tab-active");
    document.getElementById("btnSnacks").classList.remove("tab-active");
    document.getElementById("btnDrinks").classList.remove("tab-active");

    document.getElementById("btn" + cat).classList.add("tab-active");

    // update dynamic button
    updateButton(cat);
}

/* Smooth scroll top */
function scrollTopSmooth() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

/* Change button label depending on active category */
function updateButton(cat) {
    let btn = document.getElementById("dynamicBtn");

    if (cat === "Meals") {
        btn.textContent = "↑ Back to Top";
    } else {
        btn.textContent = "← Back to Home";
    }
}

/* Handle button click: scroll OR switch tab */
function handleButton() {
    let btnText = document.getElementById("dynamicBtn").textContent;

    if (btnText.includes("Top")) {
        scrollTopSmooth();
    } else {
        showCategory("Meals");
        scrollTopSmooth();
    }
}

let selectedItem = 0;

function openQty(id) {
    selectedItem = id;
    document.getElementById("qtyModal").showModal();
}

function pickQty(qty) {
    window.location.href = "add_to_cart.php?id=" + selectedItem + "&qty=" + qty;
}
</script>

</head>

<body>

<div class="max-w-7xl mx-auto mt-10 px-4">

    <h1 class="text-6xl font-bold mb-10 text-white">Our Menu</h1>

    <!-- Category Tabs -->
    <div class="flex gap-3 mb-6 text-white">
        <button id="btnMeals" class="px-5 py-2 rounded-full border tab-active"
                onclick="showCategory('Meals')">Meals</button>

        <button id="btnSnacks" class="px-5 py-2 rounded-full border"
                onclick="showCategory('Snacks')">Snacks</button>

        <button id="btnDrinks" class="px-5 py-2 rounded-full border"
                onclick="showCategory('Drinks')">Drinks</button>
    </div>


    <!-- Meals Section -->
    <div id="Meals" class="grid grid-cols-1 md:grid-cols-3 gap-6 fade">
        <?php foreach ($meals as $row): ?>
        <div class="menu-card p-5 rounded-xl shadow fade">

            <img src="../images/<?= $row['image']; ?>" class="menu-img w-full rounded-md mb-3">

            <h2 class="text-2xl font-bold text-white"><?= $row['name']; ?></h2>
            <p class="text-gray-400 text-sm mb-2"><?= $row['description']; ?></p>

            <p class="font-bold text-lg mb-3 text-blue-400">₱<?= $row['price']; ?></p>

           <button onclick="openQty(<?= $row['id']; ?>)" class="btn btn-primary w-full">
    Add to Cart
</button>

        </div>
        <?php endforeach; ?>
    </div>


    <!-- Snacks Section -->
    <div id="Snacks" class="hidden grid-cols-1 md:grid-cols-3 gap-6 fade">
        <?php foreach ($snacks as $row): ?>
        <div class="menu-card p-5 rounded-xl shadow fade">

            <img src="../images/<?= $row['image']; ?>" class="menu-img w-full rounded-md mb-3">

            <h2 class="text-2xl font-bold text-white"><?= $row['name']; ?></h2>
            <p class="text-gray-400 text-sm mb-2"><?= $row['description']; ?></p>

            <p class="font-bold text-lg mb-3 text-blue-400">₱<?= $row['price']; ?></p>

           <button onclick="openQty(<?= $row['id']; ?>)" class="btn btn-primary w-full">
    Add to Cart
</button>

        </div>
        <?php endforeach; ?>
    </div>


    <!-- Drinks Section -->
    <div id="Drinks" class="hidden grid-cols-1 md:grid-cols-3 gap-6 fade">
        <?php foreach ($drinks as $row): ?>
        <div class="menu-card p-5 rounded-xl shadow fade">

            <img src="../images/<?= $row['image']; ?>" class="menu-img w-full rounded-md mb-3">

            <h2 class="text-2xl font-bold text-white"><?= $row['name']; ?></h2>
            <p class="text-gray-400 text-sm mb-2"><?= $row['description']; ?></p>

            <p class="font-bold text-lg mb-3 text-blue-400">₱<?= $row['price']; ?></p>

          <button onclick="openQty(<?= $row['id']; ?>)" class="btn btn-primary w-full">
    Add to Cart
</button>

        </div>
        <?php endforeach; ?>
    </div>

    <div class="top-btn text-center">
    <button id="dynamicBtn"
        onclick="handleButton()"
        class="px-6 py-3 rounded-full bg-blue-600 hover:bg-blue-700 
               text-white font-semibold shadow-lg hover:shadow-blue-500/50 
               transition duration-300">
        ↑ Back to Top
    </button>
</div>

</div>

<dialog id="qtyModal" class="modal">
  <form method="dialog" class="modal-box bg-white text-black rounded-lg">
    <h3 class="text-xl font-bold mb-4">Select Quantity</h3>

    <div class="grid grid-cols-5 gap-3 mb-6">
      <button type="button" class="btn" onclick="pickQty(1)">1</button>
      <button type="button" class="btn" onclick="pickQty(2)">2</button>
      <button type="button" class="btn" onclick="pickQty(3)">3</button>
      <button type="button" class="btn" onclick="pickQty(4)">4</button>
      <button type="button" class="btn" onclick="pickQty(5)">5</button>
    </div>

    <div class="modal-action">
      <button class="btn">Cancel</button>
    </div>
  </form>
</dialog>

<script>
showCategory('Meals'); // default open
</script>

</body>
</html>
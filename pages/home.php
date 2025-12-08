<?php  
?>  <!DOCTYPE html>  <html lang="en" data-theme="dark">  
<head>  
<meta charset="utf-8"/>  
<meta name="viewport" content="width=device-width,initial-scale=1"/>  
<title>Campus Cafeteria — Welcome</title>  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" />  
<script src="https://cdn.tailwindcss.com"></script>  <style>  
  .color-accent { color: #000000ff; }
  .color-dark-blue { background-color: #4d4e50ff; } 
    
  .unified-bg {  
    background:  url('../public/images/cafe3.jpg') center/cover no-repeat fixed;  
  }  
    
  .hero-section {  
    min-height: 95vh;  
    display: flex;  
    align-items: center;  
    justify-content: center;  
    padding-bottom: 90px;  
    position: relative;  
  }  
  
  .main-container {  
    padding: 3rem 1.5rem;  
    width: 96%;  
    max-width: 1000px;  
    margin: auto;  
  }  
  
  .welcome-text-area {  
    text-shadow: 0 4px 15px rgba(255, 255, 255, 0.37);  
    animation: fadeInScale 1.2s ease-out;  
  }  
    
  @keyframes fadeInScale {  
    from { opacity: 0; transform: scale(0.95); }  
    to { opacity: 1; transform: scale(1); }  
  }  
  
  .role-btn-streamlined {  
    background-color: #e09731ff;
    color: #ffffffff;   
    font-weight: 800;  
    padding: 20px 30px;  
    border-radius: 12px;  
    text-decoration: none;  
    display: flex;  
    flex-direction: column;  
    align-items: center;  
    gap: 8px;  
    transition: all .2s ease;  
    border: 3px solid #cc8d33;  
    min-width: 180px;  
  }  
  
  .role-btn-streamlined:hover {  
    background-color: transparent;  
    color: #cc8d33;  
    transform: scale(1.05);  
    box-shadow: 0 8px 25px rgba(204,141,51,0.6);  
  }  
  
  .admin-btn {  
    background-color: transparent;  
    border: 3px solid rgba(255,255,255,0.4);  
    color: #fff;  
  }  
  .admin-btn:hover {  
    background-color: rgba(255,255,255,0.1);  
    color: #fff;  
    border-color: #fff;  
  }  
    
  .section-padding {  
    padding: 20 1.5rem;  
  }  
  
  .feature-card {  
    background-color: #1f2937;  
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);  
    border-top: 4px solid #cc8d33; 
    transition: background-color 0.3s ease;  
  }  
  .feature-card:hover {  
    background-color: #26344d;   
  }  
  
  .feature-icon {  
    color: #fff;  
    transition: color 0.3s ease;  
  }  
  .feature-card:hover .feature-icon {  
    color: #cc8d33;  
  }  
  
</style>  </head>  <body class="bg-black-900 text-white">  <section class="unified-bg hero-section">  
  <div class="main-container text-center">  <div class="welcome-text-area max-w-5xl mx-auto">  
      
    <h1 class="text-6xl md:text-7xl font-light text-white tracking-wider leading-snug" style="margin:0;">  
        <span class="block text-2xl font-bold uppercase tracking-widest color-accent mb-1">Welcome to</span>  
        The <span class="font-extrabold color-accent">Campus Cafeteria</span> Experience  
    </h1>  

    <p class="text-1xl text-white-200 mt-10 font-medium max-w-5x2 mx-auto">  
        Your fast-track to delicious campus meals. Simply tap, order, and pay for a seamless dining experience.  
    </p>  

    <h2 class="text-lg font-bold text-black-500 mb-8 tracking-widest uppercase mt-12">  
        CHOOSE HOW YOU WANT TO CONTINUE  
    </h2>  
      
    <div class="flex flex-col sm:flex-row justify-center items-center gap-6">  

        <a href="../pages/customer.php" class="role-btn-streamlined">  
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ffffffff" stroke-width="2">  
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/>  
                <path d="M4 20c0-3.3 2.7-6 6-6h4c3.3 0 6 2.7 6 6"/>  
            </svg>  
            <div class="text-xl leading-none">Customer</div>  
            <div class="text-xs font-normal opacity-80">Start Your Order</div>  
        </a>  

        <a href="../pages/admin.php" class="role-btn-streamlined admin-btn">  
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">  
                <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4z"/>  
                <path d="M4 20c0-3.3 2.7-6 6-6h4c3.3 0 6 2.7 6 6"/>  
            </svg>  
            <div class="text-xl leading-none">Admin</div>  
            <div class="text-xs font-normal opacity-80">Access Management</div>  
        </a>  
    </div>  
</div>  
  
<div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-white-400">  
    <p class="text-sm tracking-wider">Scroll Down to Learn More</p>  
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mt-1 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="5">  
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />  
    </svg>  
</div>

  </div>  
</section>  <section class="unified-bg section-padding">  
    <div class="main-container text-center">  
        <h2 class="text-5xl font-bold mb-10 color-accent">Why Use Our System?</h2>  
        <p class="text-lg font-bold text-white-400 mb-12">Designed for students, staff, and cafeteria managers to streamline operations.</p>  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">  
          
        <div class="card feature-card shadow-xl p-10 hover:bg-neutral-700 transition duration-300">  
            <div class="text-center">  
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-4 feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">  
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M12 15l4-4-4-4M12 15l-4-4"/>  
                </svg>  
                <h3 class="text-xl font-bold mb-2">Fast & Secure Ordering</h3>  
                <p class="text-gray-400">Skip the lines and place your order directly on the cafeteria kiosk. Simple checkout and secure payment options.</p>  
            </div>  
        </div>  

        <div class="card feature-card shadow-xl p-8 hover:bg-neutral-700 transition duration-300">  
            <div class="text-center">  
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-4 feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">  
                  <path d="M3 3h18v18H3zM8 8h8v8H8z"/>  
                </svg>  
                <h3 class="text-xl font-bold mb-2">Real-Time Inventory</h3>  
                <p class="text-gray-400">Managers can track stock levels instantly and update menu availability to prevent over-selling and waste.</p>  
            </div>  
        </div>  

        <div class="card feature-card shadow-xl p-8 hover:bg-neutral-700 transition duration-300">  
            <div class="text-center">  
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-4 feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">  
                  <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>  
                </svg>  
                <h3 class="text-xl font-bold mb-2">Order Management</h3>  
                <p class="text-gray-400">Staff receive immediate notifications and a clear dashboard for efficient meal preparation and hand-off.</p>  
            </div>  
        </div>  

    </div>  
</div>

</section>  <footer class="footer footer-center p-4 color-dark-blue text-base-content border-t border-gray-100">  
  <aside>  
    <p class="text-gray-100">Copyright © 2025 - All rights reserved by Campus Cafeteria System.</p>  
  </aside>  
</footer>  </body>  
</html>
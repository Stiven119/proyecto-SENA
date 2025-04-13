document.addEventListener('DOMContentLoaded', function() {
    // Datos de productos con precios en COP (Colombia)
    const products = [
        {
            id: 1,
            name: 'iPhone 15 Pro Max',
            brand: 'apple',
            price: 6999000,
            image: 'assets/iphone-15-pro-max.jpg',
            description: 'El más avanzado iPhone con pantalla Dynamic Island y cámara de 48MP.',
            features: [
                'Pantalla Super Retina XDR de 6.7 pulgadas',
                'Chip A17 Pro con Neural Engine',
                'Sistema de cámara Pro con teleobjetivo de 5x',
                'Resistencia al agua IP68',
                'Hasta 29 horas de reproducción de video'
            ]
        },
        {
            id: 2,
            name: 'Samsung Galaxy S23 Ultra',
            brand: 'samsung',
            price: 5999000,
            image: 'assets/samsung-s23-ultra.jpg',
            description: 'Potente smartphone con S Pen integrado y cámara de 200MP.',
            features: [
                'Pantalla Dynamic AMOLED 2X de 6.8" con 120Hz',
                'Procesador Snapdragon 8 Gen 2',
                'Cámara de 200MP con estabilización óptica',
                'S Pen integrado',
                'Batería de 5000mAh con carga rápida'
            ]
        },
        {
            id: 3,
            name: 'Xiaomi 13 Pro',
            brand: 'xiaomi',
            price: 4999000,
            image: 'assets/xiaomi-13-pro.jpg',
            description: 'Flagship de Xiaomi con pantalla AMOLED 120Hz y carga de 120W.',
            features: [
                'Pantalla AMOLED de 6.73" con 120Hz',
                'Procesador Snapdragon 8 Gen 2',
                'Cámara Leica de 50MP',
                'Carga rápida de 120W',
                'Resistencia al agua IP68'
            ]
        },
        {
            id: 4,
            name: 'iPhone 14',
            brand: 'apple',
            price: 4999000,
            image: 'assets/iphone-14.jpg',
            description: 'Diseño elegante con chip A15 Bionic y excelente duración de batería.',
            features: [
                'Pantalla Super Retina XDR de 6.1"',
                'Chip A15 Bionic con Neural Engine',
                'Sistema de dos cámaras de 12MP',
                'Modo Cine en 4K HDR',
                'Hasta 20 horas de reproducción de video'
            ]
        },
        {
            id: 5,
            name: 'Samsung Galaxy Z Flip5',
            brand: 'samsung',
            price: 5499000,
            image: 'assets/samsung-z-flip5.jpg',
            description: 'Smartphone plegable con pantalla Cover Screen más grande.',
            features: [
                'Pantalla principal Dynamic AMOLED 2X de 6.7"',
                'Pantalla Cover de 3.4"',
                'Procesador Snapdragon 8 Gen 2',
                'Cámara dual de 12MP',
                'Diseño compacto plegable'
            ]
        },
        {
            id: 6,
            name: 'Xiaomi Redmi Note 12 Pro+',
            brand: 'xiaomi',
            price: 1999000,
            image: 'assets/xiaomi-redmi-note-12-pro-plus.jpg',
            description: 'Cámara de 200MP y carga rápida de 120W a un precio increíble.',
            features: [
                'Pantalla AMOLED de 6.67" con 120Hz',
                'Cámara de 200MP con OIS',
                'Carga rápida de 120W',
                'Procesador MediaTek Dimensity 1080',
                'Batería de 5000mAh'
            ]
        }
    ];

    // Formatear precios en COP
    function formatPrice(price) {
        return new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP',
            maximumFractionDigits: 0
        }).format(price);
    }

    // Variables del carrito
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartModal = document.getElementById('cart-modal');
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const cartSubtotalElement = document.getElementById('cart-subtotal');
    const cartShippingElement = document.getElementById('cart-shipping');
    const cartCountElement = document.querySelector('.cart-count');
    const cartIcon = document.getElementById('cart-icon');

    // Variables para autenticación
    const loginModal = document.getElementById('login-modal');
    const registerModal = document.getElementById('register-modal');
    const loginBtn = document.getElementById('login-btn');
    const registerBtn = document.getElementById('register-btn');
    const showRegister = document.getElementById('show-register');
    const showLogin = document.getElementById('show-login');
    const closeAuthButtons = document.querySelectorAll('.close-auth');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const userProfile = document.getElementById('user-profile');
    const usernameDisplay = document.getElementById('username-display');
    const logoutBtn = document.getElementById('logout-btn');
    const mobileLoginBtn = document.getElementById('mobile-login-btn');
    const mobileRegisterBtn = document.getElementById('mobile-register-btn');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    // Elementos de error
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const nameError = document.getElementById('name-error');
    const regEmailError = document.getElementById('reg-email-error');
    const regPasswordError = document.getElementById('reg-password-error');
    const confirmError = document.getElementById('confirm-error');

    // Variables para el slider de ofertas
    const offerSlides = document.querySelectorAll('.offer-slide');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;
    let slideInterval;

    // Modal de producto
    const productModal = document.getElementById('product-modal');
    const productModalBody = document.getElementById('product-modal-body');
    const closeProductModal = document.querySelector('.close-product-modal');

    // Mostrar productos con precios formateados
    function displayProducts(filter = 'all') {
        const productGrid = document.getElementById('product-grid');
        productGrid.innerHTML = '';

        const filteredProducts = filter === 'all' 
            ? products 
            : products.filter(product => product.brand === filter);

        filteredProducts.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            productCard.innerHTML = `
                <div class="product-image">
                    <img src="${product.image}" alt="${product.name}" loading="lazy">
                    <div class="product-badge">Nuevo</div>
                </div>
                <div class="product-info">
                    <h3>${product.name}</h3>
                    <p>${product.description}</p>
                    <span class="product-price">${formatPrice(product.price)}</span>
                    <div class="product-actions">
                        <button class="add-to-cart" data-id="${product.id}">Añadir al carrito</button>
                        <button class="view-details" data-id="${product.id}">Ver detalles</button>
                    </div>
                </div>
            `;
            productGrid.appendChild(productCard);
        });

        // Event listeners para botones
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', addToCart);
        });

        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', showProductDetails);
        });
    }

    // Mostrar detalles del producto
    function showProductDetails(e) {
        const productId = parseInt(e.target.getAttribute('data-id'));
        const product = products.find(p => p.id === productId);
        
        productModalBody.innerHTML = `
            <div class="product-modal-image">
                <img src="${product.image}" alt="${product.name}" loading="lazy">
            </div>
            <div class="product-modal-info">
                <h2>${product.name}</h2>
                <span class="product-modal-brand">${product.brand.charAt(0).toUpperCase() + product.brand.slice(1)}</span>
                <div class="product-modal-price">${formatPrice(product.price)}</div>
                <p class="product-modal-description">${product.description}</p>
                <div class="product-modal-features">
                    <h3>Características principales:</h3>
                    <ul>
                        ${product.features.map(feature => `<li>${feature}</li>`).join('')}
                    </ul>
                </div>
                <div class="product-modal-actions">
                    <button class="add-to-cart primary-btn" data-id="${product.id}">Añadir al carrito</button>
                    <button class="btn secondary-btn close-product-btn">Cerrar</button>
                </div>
            </div>
        `;
        
        productModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        // Agregar evento al botón de añadir al carrito dentro del modal
        productModalBody.querySelector('.add-to-cart').addEventListener('click', addToCart);
        
        // Agregar evento al botón de cerrar
        productModalBody.querySelector('.close-product-btn').addEventListener('click', () => {
            productModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    }

    // Filtrar productos
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            const filter = this.getAttribute('data-filter');
            displayProducts(filter);
        });
    });

    // Validación de email
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    // Validación de contraseña
    function validatePassword(password) {
        return password.length >= 8;
    }

    // Limpiar errores
    function clearErrors() {
        emailError.textContent = '';
        passwordError.textContent = '';
        nameError.textContent = '';
        regEmailError.textContent = '';
        regPasswordError.textContent = '';
        confirmError.textContent = '';
    }

    // Añadir al carrito
    function addToCart(e) {
        const productId = parseInt(e.target.getAttribute('data-id'));
        const product = products.find(p => p.id === productId);
        
        const existingItem = cart.find(item => item.id === productId);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                ...product,
                quantity: 1
            });
        }
        
        updateCart();
        showNotification(`${product.name} añadido al carrito`, 'success');
        saveCartToLocalStorage();
    }

    // Actualizar carrito
    function updateCart() {
        cartItemsContainer.innerHTML = '';
        
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="empty-cart">
                    <i class="fas fa-shopping-basket"></i>
                    <p>Tu carrito está vacío</p>
                    <a href="#productos" class="btn primary-btn">Ver productos</a>
                </div>
            `;
        } else {
            cart.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <div class="cart-item-img">
                        <img src="${item.image}" alt="${item.name}" loading="lazy">
                    </div>
                    <div class="cart-item-info">
                        <h4 class="cart-item-title">${item.name}</h4>
                        <p class="cart-item-price">${formatPrice(item.price * item.quantity)}</p>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn decrease" data-id="${item.id}">-</button>
                            <span>${item.quantity}</span>
                            <button class="quantity-btn increase" data-id="${item.id}">+</button>
                            <button class="cart-item-remove" data-id="${item.id}">Eliminar</button>
                        </div>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItem);
            });
        }
        
        // Calcular totales
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const shipping = subtotal > 2000000 ? 0 : 25000; // Envío gratis para compras mayores a $2,000,000 COP
        const total = subtotal + shipping;
        
        // Actualizar UI
        cartSubtotalElement.textContent = formatPrice(subtotal);
        cartShippingElement.textContent = shipping === 0 ? 'Gratis' : formatPrice(shipping);
        cartTotalElement.textContent = formatPrice(total);
        
        // Actualizar contador
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCountElement.textContent = totalItems;
    }

    // Guardar carrito en localStorage
    function saveCartToLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Mostrar notificación
    function showNotification(message, type = 'success') {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = `notification ${type}`;
        
        // Agregar icono según el tipo
        let icon = '';
        switch(type) {
            case 'success':
                icon = 'fa-check-circle';
                break;
            case 'error':
                icon = 'fa-exclamation-circle';
                break;
            case 'info':
                icon = 'fa-info-circle';
                break;
            case 'warning':
                icon = 'fa-exclamation-triangle';
                break;
            default:
                icon = 'fa-info-circle';
        }
        
        notification.innerHTML = `<i class="fas ${icon}"></i> ${message}`;
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);
        
        setTimeout(() => {
            notification.classList.remove('show');
        }, 5000);
    }

    // Manejar eventos del carrito
    cartItemsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('decrease')) {
            const productId = parseInt(e.target.getAttribute('data-id'));
            const item = cart.find(item => item.id === productId);
            
            if (item.quantity > 1) {
                item.quantity -= 1;
                showNotification('Cantidad reducida', 'info');
            } else {
                cart = cart.filter(item => item.id !== productId);
                showNotification('Producto eliminado', 'error');
            }
            
            updateCart();
            saveCartToLocalStorage();
        }
        
        if (e.target.classList.contains('increase')) {
            const productId = parseInt(e.target.getAttribute('data-id'));
            const item = cart.find(item => item.id === productId);
            item.quantity += 1;
            updateCart();
            showNotification('Cantidad aumentada', 'info');
            saveCartToLocalStorage();
        }
        
        if (e.target.classList.contains('cart-item-remove')) {
            const productId = parseInt(e.target.getAttribute('data-id'));
            const product = products.find(p => p.id === productId);
            cart = cart.filter(item => item.id !== productId);
            updateCart();
            showNotification(`${product.name} eliminado del carrito`, 'error');
            saveCartToLocalStorage();
        }
    });

    // Abrir/cerrar carrito
    cartIcon.addEventListener('click', function() {
        cartModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    document.querySelector('.close-cart').addEventListener('click', function() {
        cartModal.classList.remove('active');
        document.body.style.overflow = 'auto';
    });

    // Procesar pago
    document.querySelector('.checkout-btn').addEventListener('click', function() {
        if (cart.length === 0) {
            showNotification('Tu carrito está vacío', 'error');
        } else {
            // Aplicar descuento si hay más de 2 productos
            let discount = 0;
            if (cart.reduce((sum, item) => sum + item.quantity, 0) > 2) {
                discount = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) * 0.1; // 10% de descuento
                document.querySelector('.discount-row').style.display = 'flex';
                document.getElementById('cart-discount').textContent = `-${formatPrice(discount)}`;
            } else {
                document.querySelector('.discount-row').style.display = 'none';
            }
            
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) - discount;
            const shipping = total > 2000000 ? 0 : 25000;
            const grandTotal = total + shipping;
            
            showNotification(`Compra realizada por ${formatPrice(grandTotal)}. ¡Gracias por tu compra!`, 'success');
            
            // Vaciar carrito
            cart = [];
            updateCart();
            saveCartToLocalStorage();
            cartModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    // Autenticación
    loginBtn.addEventListener('click', function() {
        clearErrors();
        loginModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    registerBtn.addEventListener('click', function() {
        clearErrors();
        registerModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    mobileLoginBtn.addEventListener('click', function(e) {
        e.preventDefault();
        clearErrors();
        loginModal.classList.add('active');
        mobileMenu.classList.remove('active');
        document.body.style.overflow = 'hidden';
    });

    mobileRegisterBtn.addEventListener('click', function(e) {
        e.preventDefault();
        clearErrors();
        registerModal.classList.add('active');
        mobileMenu.classList.remove('active');
        document.body.style.overflow = 'hidden';
    });

    showRegister.addEventListener('click', function(e) {
        e.preventDefault();
        clearErrors();
        loginModal.classList.remove('active');
        registerModal.classList.add('active');
    });

    showLogin.addEventListener('click', function(e) {
        e.preventDefault();
        clearErrors();
        registerModal.classList.remove('active');
        loginModal.classList.add('active');
    });

    closeAuthButtons.forEach(button => {
        button.addEventListener('click', function() {
            loginModal.classList.remove('active');
            registerModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    });

    closeProductModal.addEventListener('click', function() {
        productModal.classList.remove('active');
        document.body.style.overflow = 'auto';
    });

    window.addEventListener('click', function(e) {
        if (e.target === loginModal) {
            loginModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        if (e.target === registerModal) {
            registerModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        if (e.target === productModal) {
            productModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    // Menu móvil
    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('active');
    });

    // Cerrar menú móvil al hacer clic en un enlace
    document.querySelectorAll('.mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
        });
    });

    // Slider de ofertas
    function showSlide(index) {
        offerSlides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % offerSlides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + offerSlides.length) % offerSlides.length;
        showSlide(currentSlide);
    }

    function goToSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
    }

    document.querySelector('.slider-next').addEventListener('click', nextSlide);
    document.querySelector('.slider-prev').addEventListener('click', prevSlide);

    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const slideIndex = parseInt(this.getAttribute('data-slide'));
            goToSlide(slideIndex);
            resetSlideInterval();
        });
    });

    function startSlideInterval() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function resetSlideInterval() {
        clearInterval(slideInterval);
        startSlideInterval();
    }

    // Auto-avance del slider
    startSlideInterval();

    // Pausar slider al interactuar
    const slider = document.querySelector('.offer-slider');
    slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
    slider.addEventListener('mouseleave', startSlideInterval);

    // Formulario de contacto
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();
        showNotification('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.', 'success');
        this.reset();
    });

    // Newsletter
    document.getElementById('newsletter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input').value.trim();
        
        if (!validateEmail(email)) {
            showNotification('Por favor ingresa un correo electrónico válido', 'error');
            return;
        }
        
        let subscribers = JSON.parse(localStorage.getItem('newsletterSubscribers')) || [];
        
        if (subscribers.includes(email)) {
            showNotification('Este correo ya está suscrito', 'warning');
        } else {
            subscribers.push(email);
            localStorage.setItem('newsletterSubscribers', JSON.stringify(subscribers));
            showNotification('¡Gracias por suscribirte a nuestro newsletter!', 'success');
        }
        
        this.reset();
    });

    // Actualizar UI de autenticación
    function updateAuthUI() {
        const loggedIn = document.cookie.includes('loggedIn=true');
        
        if (loggedIn) {
            document.getElementById('login-btn').style.display = 'none';
            document.getElementById('register-btn').style.display = 'none';
            document.getElementById('user-profile').style.display = 'flex';
            
            // Obtener nombre de usuario de la cookie
            const username = document.cookie.split('; ').find(row => row.startsWith('username='));
            if (username) {
                document.getElementById('username-display').textContent = username.split('=')[1];
            }
        } else {
            document.getElementById('login-btn').style.display = 'block';
            document.getElementById('register-btn').style.display = 'block';
            document.getElementById('user-profile').style.display = 'none';
        }
    }

    // Cerrar sesión
    logoutBtn.addEventListener('click', function() {
        document.cookie = 'loggedIn=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        document.cookie = 'username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        updateAuthUI();
        showNotification('Has cerrado sesión correctamente', 'success');
    });

    // Inicializar
    displayProducts();
    showSlide(currentSlide);
    updateAuthUI();
    updateCart();
    
    // Cerrar menú al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!mobileMenu.contains(e.target) && e.target !== mobileMenuBtn) {
            mobileMenu.classList.remove('active');
        }
    });
});
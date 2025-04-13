<?php
session_start();

if(isset($_SESSION['usuario'])){
    header("location: php/bienvenida.php");
    exit(); 
}
?>


<!DOCTYPE html>
<html lang="es-CO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tienda especializada en dispositivos móviles en Bogotá. Encuentra los últimos smartphones de Apple, Samsung y Xiaomi.">
    <title>Mobile Gadget Store - Tecnología en Bogotá</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
</head>
<body>
    <!-- Modales de Autenticación -->
    <div class="auth-modal" id="login-modal">
        <div class="auth-content">
            <span class="close-auth">&times;</span>
            <div class="auth-header">
                <i class="fas fa-lock"></i>
                <h2>Iniciar Sesión</h2>
            </div>
            <form action="php/login_usuario_be.php" method="POST" id="login-form">
                <div class="form-group">
                    <label for="login-email">Correo electrónico</label>
                    <input type="email" id="login-email" placeholder="tucorreo@ejemplo.com" required name="correo">
                    <span class="input-error" id="email-error"></span>
                </div>
                <div class="form-group">
                    <label for="login-password">Contraseña(minimo 8)</label>
                    <input type="password" id="login-password" placeholder="••••••••" required name="contrasena">
                    <span class="input-error" id="password-error"></span>
                </div>
                <button type="submit" class="btn auth-submit">Ingresar</button>
                <p class="auth-switch">¿No tienes cuenta? <a href="#" id="show-register">Regístrate aquí</a></p>
            </form>
        </div>
    </div>

    <div class="auth-modal" id="register-modal">
    <div class="auth-content">
        <span class="close-auth">&times;</span>
        <div class="auth-header">
            <i class="fas fa-user-plus"></i>
            <h2>Crear Cuenta</h2>
        </div>
        <form action="php/registro_usuario_be.php" method="POST" id="register-form">
            <div class="form-group">
                <label for="register-name">Nombre completo</label>
                <input type="text" id="register-name" placeholder="Ej: Juan Pérez" required name="nombre_completo">
                <span class="input-error" id="name-error"></span>
            </div>
            <div class="form-group">
                <label for="register-email">Correo electrónico</label>
                <input type="email" id="register-email" placeholder="tucorreo@ejemplo.com" required name="correo">
                <span class="input-error" id="reg-email-error"></span>
            </div>
            <div class="form-group">
                <label for="register-password">Contraseña (mínimo 8)</label>
                <input type="password" id="register-password" placeholder="••••••••" required minlength="8" name="contrasena">
                <span class="input-error" id="reg-password-error"></span>
            </div>
            <div class="form-group">
                <label for="register-confirm">Confirmar contraseña</label>
                <input type="password" id="register-confirm" placeholder="••••••••" required name="confirmar_contrasena">
                <span class="input-error" id="confirm-error"></span>
            </div>
            <button type="submit" class="btn auth-submit">Registrarse</button>
            <p class="auth-switch">¿Ya tienes cuenta? <a href="#" id="show-login">Inicia sesión aquí</a></p>
        </form>
    </div>
</div>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <i class="fas fa-mobile-alt"></i>
                <h1>MOBILE GADGET STORE</h1>
                <span class="location"><i class="fas fa-map-marker-alt"></i> Bogotá</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#ofertas">Ofertas</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>
            <div class="user-actions">
                <button id="login-btn" class="auth-btn login-btn">
                    <i class="fas fa-sign-in-alt"></i> Ingresar
                </button>
                <button id="register-btn" class="auth-btn register-btn">
                    <i class="fas fa-user-plus"></i> Registro
                </button>
                <div class="user-profile" id="user-profile" style="display: none;">
                    <span class="welcome">Hola, <span id="username-display"></span></span>
                    <button id="logout-btn" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
                <div class="cart-icon" id="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">0</span>
                </div>
            </div>
            <button class="mobile-menu-btn" id="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu">
        <ul>
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#productos">Productos</a></li>
            <li><a href="#ofertas">Ofertas</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#" id="mobile-login-btn">Ingresar</a></li>
            <li><a href="#" id="mobile-register-btn">Registro</a></li>
        </ul>
    </div>

    <!-- Hero Section -->
    <section class="hero" id="inicio">
        <div class="container">
            <div class="hero-content">
                <h2>Tecnología de Vanguardia en Bogotá</h2>
                <p>Los mejores dispositivos móviles con envío rápido en la capital</p>
                <div class="hero-buttons">
                    <a href="#productos" class="btn primary-btn">Explorar Productos</a>
                    <a href="#ofertas" class="btn secondary-btn">Ver Ofertas</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos -->
    <section class="products" id="productos">
        <div class="container">
            <div class="section-header">
                <h2>Nuestra Colección</h2>
                <p>Descubre los dispositivos más avanzados del mercado</p>
            </div>
            <div class="product-filters">
                <button class="filter-btn active" data-filter="all">Todos</button>
                <button class="filter-btn" data-filter="apple">
                    <i class="fab fa-apple"></i> Apple
                </button>
                <button class="filter-btn" data-filter="samsung">
                    <i class="fas fa-mobile"></i> Samsung
                </button>
                <button class="filter-btn" data-filter="xiaomi">
                    <i class="fas fa-bolt"></i> Xiaomi
                </button>
            </div>
            <div class="product-grid" id="product-grid">
                <!-- Productos se cargan dinámicamente -->
            </div>
        </div>
    </section>

    <!-- Ofertas -->
    <section class="offers" id="ofertas">
        <div class="container">
            <div class="section-header">
                <h2>Ofertas Exclusivas</h2>
                <p>Aprovecha nuestros descuentos especiales</p>
            </div>
            <div class="offer-slider">
                <div class="offer-slide active">
                    <div class="offer-badge">-20%</div>
                    <img src="assets/samsung-offer.jpg" alt="Oferta Samsung" loading="lazy">
                    <div class="offer-content">
                        <h3>Semana Samsung</h3>
                        <p>Descuentos especiales en toda la gama Galaxy</p>
                        <a href="#productos" class="btn offer-btn">Ver Productos</a>
                    </div>
                </div>
                <div class="offer-slide">
                    <div class="offer-badge">12 MSI</div>
                    <img src="assets/iphone-offer.jpg" alt="Oferta iPhone" loading="lazy">
                    <div class="offer-content">
                        <h3>iPhone 15 Pro</h3>
                        <p>12 meses sin intereses con tu tarjeta preferida</p>
                        <a href="#productos" class="btn offer-btn">Comprar Ahora</a>
                    </div>
                </div>
                <div class="offer-slide">
                    <div class="offer-badge">-30%</div>
                    <img src="assets/xiaomi-offer.jpg" alt="Oferta Xiaomi" loading="lazy">
                    <div class="offer-content">
                        <h3>Xiaomi Flash Sale</h3>
                        <p>Descuentos increíbles en dispositivos Xiaomi</p>
                        <a href="#productos" class="btn offer-btn">Ver Ofertas</a>
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="slider-prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="slider-next"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="slider-dots">
                    <span class="dot active" data-slide="0"></span>
                    <span class="dot" data-slide="1"></span>
                    <span class="dot" data-slide="2"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>Lo que dicen nuestros clientes</h2>
                <p>Experiencias reales de compradores satisfechos</p>
            </div>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Excelente servicio y entrega rápida. Mi nuevo iPhone llegó en perfecto estado y antes de lo esperado."</p>
                    <div class="testimonial-author">
                        <img src="assets/client1.jpg" alt="Cliente 1" loading="lazy">
                        <div>
                            <h4>Carlos Martínez</h4>
                            <span>Bogotá</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text">"La mejor tienda de dispositivos en Bogotá. Precios competitivos y atención personalizada."</p>
                    <div class="testimonial-author">
                        <img src="assets/client2.jpg" alt="Cliente 2" loading="lazy">
                        <div>
                            <h4>Ana Rodríguez</h4>
                            <span>Chía</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Compré mi Samsung Galaxy aquí y el proceso fue muy sencillo. Definitivamente volveré a comprar."</p>
                    <div class="testimonial-author">
                        <img src="assets/client3.jpg" alt="Cliente 3" loading="lazy">
                        <div>
                            <h4>David González</h4>
                            <span>Soacha</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section class="contact" id="contacto">
        <div class="container">
            <div class="section-header">
                <h2>Contáctanos</h2>
                <p>Estamos aquí para ayudarte</p>
            </div>
            <div class="contact-container">
                <div class="contact-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Ubicación</h3>
                        <p>Carrera 15 # 88-64, Bogotá</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <h3>Teléfono</h3>
                        <p>+57 601 1234567</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <h3>Email</h3>
                        <p>contacto@mobilegadget.co</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <h3>Horario</h3>
                        <p>Lunes a Viernes: 9am - 7pm</p>
                        <p>Sábados: 10am - 3pm</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-store"></i>
                        <h3>Visítanos</h3>
                        <p>Ven a nuestro local y prueba los dispositivos antes de comprar</p>
                    </div>
                </div>
                <form id="contact-form" class="contact-form">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" placeholder="Tu nombre completo" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Asunto</label>
                        <input type="text" id="subject" name="subject" placeholder="¿Cómo podemos ayudarte?">
                    </div>
                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" name="message" placeholder="Escribe tu mensaje aquí..." required></textarea>
                    </div>
                    <button type="submit" class="btn primary-btn">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Mapa -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.785693109158!2d-74.05288892468636!3d4.638385942347493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9a3e0e9b0b1b%3A0x1b8e6d7b1b0e0b1b!2sCarrera%2015%20%2388-64%2C%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1620000000000!5m2!1ses!2sco" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <div class="logo">
                        <i class="fas fa-mobile-alt"></i>
                        <h3>MOBILE GADGET STORE</h3>
                    </div>
                    <p>La mejor selección de dispositivos móviles en Bogotá</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h3>Enlaces Rápidos</h3>
                    <ul>
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#productos">Productos</a></li>
                        <li><a href="#ofertas">Ofertas</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Servicio al Cliente</h3>
                    <ul>
                        <li><a href="#">Preguntas Frecuentes</a></li>
                        <li><a href="#">Envíos y Devoluciones</a></li>
                        <li><a href="#">Garantías</a></li>
                        <li><a href="#">Métodos de Pago</a></li>
                        <li><a href="#">Soporte Técnico</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Newsletter</h3>
                    <p>Suscríbete para recibir ofertas exclusivas</p>
                    <form id="newsletter-form">
                        <input type="email" placeholder="Tu correo electrónico" required>
                        <button type="submit" class="btn primary-btn">Suscribirse</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 Mobile Gadget Store. Todos los derechos reservados.</p>
                <div class="payment-methods">
                    <i class="fab fa-cc-visa" title="Visa"></i>
                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                    <i class="fab fa-cc-amex" title="American Express"></i>
                    <i class="fab fa-cc-diners-club" title="Diners Club"></i>
                    <i class="fab fa-cc-paypal" title="PayPal"></i>
                </div>
            </div>
        </div>
    </footer>

    <!-- Carrito -->
    <div class="cart-modal" id="cart-modal">
        <div class="cart-content">
            <span class="close-cart">&times;</span>
            <div class="cart-header">
                <i class="fas fa-shopping-cart"></i>
                <h2>Tu Carrito</h2>
            </div>
            <div class="cart-items" id="cart-items">
                <div class="empty-cart">
                    <i class="fas fa-shopping-basket"></i>
                    <p>Tu carrito está vacío</p>
                    <a href="#productos" class="btn primary-btn">Ver productos</a>
                </div>
            </div>
            <div class="cart-total">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span id="cart-subtotal">$0</span>
                </div>
                <div class="total-row">
                    <span>Envío:</span>
                    <span id="cart-shipping">$0</span>
                </div>
                <div class="total-row discount-row" style="display: none;">
                    <span>Descuento:</span>
                    <span id="cart-discount">-$0</span>
                </div>
                <div class="total-row grand-total">
                    <span>Total:</span>
                    <span id="cart-total">$0</span>
                </div>
                <button class="btn primary-btn checkout-btn">Proceder al Pago</button>
            </div>
        </div>
    </div>

    <!-- Modal de Producto -->
    <div class="product-modal" id="product-modal">
        <div class="product-modal-content">
            <span class="close-product-modal">&times;</span>
            <div class="product-modal-body" id="product-modal-body">
                <!-- Contenido se carga dinámicamente -->
            </div>
        </div>
    </div>

    <!-- Notificaciones -->
    <div class="notification" id="notification"></div>

    <script src="script.js"></script>
</body>
</html>
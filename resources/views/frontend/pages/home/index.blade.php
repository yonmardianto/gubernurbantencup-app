<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Home | Gubernur Banten Cup 2026</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/homepage.css') }}">
    <meta property="og:title" content="Gubernur Banten Cup 2026">
    <meta property="og:description" content="Gubernur Banten Cup 2026 - Taekwondo Championship 2026 Banten">
    <meta property="og:image" content="{{ asset('frontend/assets/images/flyer.jpeg') }}">
    <meta property="og:url" content="{{ url()->current() }}">

</head>

<body id="body">

    <nav class="navbar">
        <div class="nav-container">
            <a href="#body" class="nav-brand">GUBERNUR BANTEN CUP 2026</a>
            <button class="nav-toggle" aria-label="Toggle menu">☰</button>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/">Home</a></li>
                <li class="nav-item"><a href="#gallery">Gallery</a></li>
                <li class="nav-item"><a href="#contact">Kontak Kami</a></li>
                <li class="nav-item"><a href="#signup-new-section" class="open-signup">Daftar</a></li>
                <li class="nav-item"><a href="#login-section">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Banner Section -->
    <section class="hero">
        <div class="hero-content">

            <div class="hero-image">
                <img src="{{ asset('frontend/assets/images/gubernur.png') }}" alt="Gubernur Banten"
                    class="gubernur-img">
            </div>

            <div class="hero-text">
                <div class="athletes-showcase">
                    <img src="{{ asset('frontend/assets/images/atlet_1.png') }}" class="athlete-img athlete-1" />
                    <img src="{{ asset('frontend/assets/images/atlet_2.png') }}" class="athlete-img athlete-2" />
                </div>
                <img src="{{ asset('frontend/assets/images/tulisan.png') }}" class="tulisan-img">

            </div>

        </div>
    </section>

    <section class="location-section" id="location">
        <div class="container">
            <h2>Event</h2>
            <div class="location-box-wrapper">
                <div class="location-box onlink-to" role="button" tabindex="0">
                    <span class="location-icon"><i class="fa-solid fa-location-dot"></i></span>
                    <p>Indoor Stadium Kelapa Dua Kab Tanggerang</p>
                </div>
                <div class="location-box">
                    <span class="location-icon"><i class="fa-solid fa-calendar"></i></span>
                    <p>30 - 31 Mei 2026</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Content Section -->
    <section class="info-section" id="gallery">
        <div class="container">
            <h2>Gallery</h2>
            <p>Bergabunglah dengan ribuan atlet dalam festival olahraga terbesar di Banten. Kompetisi yang seru dan
                menyenangkan menanti Anda.</p>
            <div class="gallery-img">
                <figure class="gallery-item">
                    <img src="{{ asset('frontend/assets/images/gallery_1.jpeg') }}" alt="Gallery 1"
                        class="gallery-image">
                    <figcaption>Kajati Banten Cup 2025 - 1</figcaption>
                </figure>
                <figure class="gallery-item">
                    <img src="{{ asset('frontend/assets/images/gallery_2.jpeg') }}" alt="Gallery 2"
                        class="gallery-image">
                    <figcaption>Kajati Banten Cup 2025 - 2</figcaption>
                </figure>
                <figure class="gallery-item">
                    <img src="{{ asset('frontend/assets/images/gallery_3.jpeg') }}" alt="Gallery 3"
                        class="gallery-image">
                    <figcaption>Kajati Banten Cup 2025 - 3</figcaption>
                </figure>
                <figure class="gallery-item">
                    <img src="{{ asset('frontend/assets/images/gallery_4.jpeg') }}" alt="Gallery 4"
                        class="gallery-image">
                    <figcaption>Kajati Banten Cup 2025 - 4</figcaption>
                </figure>

                <figure class="gallery-item">
                    <img src="{{ asset('frontend/assets/images/gallery_5.jpeg') }}" alt="Gallery 5"
                        class="gallery-image">
                    <figcaption>Kajati Banten Cup 2025 - 5</figcaption>
                </figure>

            </div>
        </div>
    </section>


    <!-- Login Modal Markup -->
    <div class="modal" id="login-modal" aria-hidden="true">
        <div class="modal-overlay" data-close></div>
        <div class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal-close" aria-label="Close">×</button>
            <div class="modal-content">

                <form class="signup-new-form modal-form" action="#" method="POST" id="formLogin">
                    @csrf

                    <span class="error-message" id="login-error-message"
                        style="color: red; display: none; margin-bottom: 10px;"></span>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan alamat email Anda"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="modal-login-password" name="password"
                                placeholder="Masukkan password Anda" required>

                            <span class="toggle-password" id="loginShowHidePassword"><i class="fas fa-eye"
                                    id="iconLoginPassword"></i>

                        </div>
                    </div>
                    <button type="submit" class="login-btn" id="login-button">Login</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Signup Modal Markup -->
    <div class="modal" id="signup-modal" aria-hidden="true">
        <div class="modal-overlay" data-close></div>
        <div class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal-close" aria-label="Close">×</button>
            <div class="modal-content">

                <form class="signup-new-form modal-form" action="#" method="POST" id="formSignup">
                    @csrf
                    <div class="form-group">
                        <label for="modal-nama" class="required">Nama</label>
                        <input type="text" id="modal-nama" name="name"
                            placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="modal-email" class="required">Email</label>
                        <input type="email" id="modal-email" name="email"
                            placeholder="Masukkan alamat email Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="modal-no-hp" class="required">No. Hp</label>
                        <input type="text" id="no_hp" name="no_hp" placeholder="Masukkan nomor hp Anda"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="modal-club" class="required">Club / Team</label>
                        <input type="text" id="modal-club" name="club" required
                            placeholder="Masukkan nama club Anda">
                    </div>
                    <div class="form-group">
                        <label for="modal-password" class="required">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="modal-signup-password" name="password"
                                placeholder="Masukkan password Anda" required>

                            <span class="toggle-password" id="signUpShowHidePassword"><i class="fas fa-eye"
                                    id="iconSignUpPassword"></i></span>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="modal-confirm-password" class="required">Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="modal-confirm-password" name="password_confirmation"
                                placeholder="Konfirmasi password Anda" required>

                            <span class="toggle-password" onclick="toggleVisibility('modal-confirm-password')"><i
                                    class="fas fa-eye"></i></span>
                        </div>

                    </div>
                    <button type="submit" class="signup-btn">Daftar Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Contact Us Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2>Kontak Kami</h2>
            <p>Punya pertanyaan? Hubungi kami melalui WhatsApp atau Email</p>
            <div class="contact-grid">
                <a href="https://wa.me/6285692887399" target="_blank" class="contact-card whatsapp">
                    <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                    <h3>WhatsApp</h3>
                    <!-- <p>+62 878-9012-3456</p> -->
                </a>
                <a href="mailto:gubernurbantencup@gmail.com" class="contact-card email">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <h3>Email</h3>
                    <!-- <p>info@gubernurbantencup.com</p> -->
                </a>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {

            var btn = document.querySelector('.nav-toggle');
            var menu = document.querySelector('.nav-menu');
            var locationBox = document.querySelector('.onlink-to');

            // Modal: open signup modal when clicking links or open buttons
            var modalSignup = document.getElementById('signup-modal');
            var modalLogin = document.getElementById('login-modal');

            var openSignup = document.querySelectorAll('a[href="#signup-new-section"], .open-signup');
            var closeSignup = document.querySelectorAll('.modal-close, .modal-overlay');

            var formLogin = document.getElementById('formLogin');
            var formSignup = document.getElementById('formSignup');


            var openLogin = document.querySelectorAll('a[href="#login-section"], .open-login');
            var closeLogin = document.querySelectorAll('.modal-close, .modal-overlay');


            $("#loginShowHidePassword").on("click", function(event) {
                event.preventDefault();
                const passwordInput = $("#modal-login-password");
                const iconLoginPassword = $("#iconLoginPassword");

                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    iconLoginPassword.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    passwordInput.attr("type", "password");
                    iconLoginPassword.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });

            $("#signUpShowHidePassword").on("click", function(event) {
                event.preventDefault();
                const passwordInput = $("#modal-signup-password");
                const iconSignUpPassword = $("#iconSignUpPassword");

                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    iconSignUpPassword.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    passwordInput.attr("type", "password");
                    iconSignUpPassword.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });



            if ($('#no_hp').length > 0) {
                $('#no_hp').mask('62890000000000', {
                    translation: {
                        '9': {
                            pattern: /[1-9]/
                        }
                    },
                    onKeyPress: function(value, event, currentValue, selection) {
                        if (currentValue === '628' && event.key === '0') {
                            event.preventDefault();
                            return false;
                        }
                    }
                });
            }

            if (locationBox) {
                locationBox.addEventListener('click', function() {
                    window.open('https://maps.app.goo.gl/NBAiK8TaeX49mV2S8', '_blank');
                });
            }

            if (btn && menu) {
                btn.addEventListener('click', function() {
                    menu.classList.toggle('open');
                });
            }


            function openSignupModal(e) {
                if (e) e.preventDefault();
                if (!modalSignup) return;
                modalSignup.classList.add('open');
                modalSignup.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeSignupModal() {
                if (!modalSignup) return;
                modalSignup.classList.remove('open');
                modalSignup.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                formSignup.reset();
            }

            openSignup.forEach(function(el) {
                el.addEventListener('click', openSignupModal);
            });
            closeSignup.forEach(function(el) {
                el.addEventListener('click', closeSignupModal);
            });





            function openLoginModal(e) {
                if (e) e.preventDefault();
                if (!modalLogin) return;
                modalLogin.classList.add('open');
                modalLogin.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeLoginModal() {
                if (!modalLogin) return;
                modalLogin.classList.remove('open');
                modalLogin.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';

                formLogin.reset();
            }


            openLogin.forEach(function(el) {
                el.addEventListener('click', openLoginModal);
            });
            closeLogin.forEach(function(el) {
                el.addEventListener('click', closeLoginModal);
            });

            // close on Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSignupModal();
                    closeLoginModal();
                }
            });


            //Form Login AJAX Submission
            formLogin.addEventListener('submit', function(e) {

                e.preventDefault();

                var loginButton = document.getElementById('login-button');
                loginButton.disabled = true;
                loginButton.innerText = 'Logging in...';


                var formData = new FormData(this);
                var xhr = new XMLHttpRequest();

                const errorSpan = document.getElementById('login-error-message');
                errorSpan.style.display = 'none';
                errorSpan.innerText = '';

                const csrfToken = document.querySelector('input[name="_token"]')?.value;

                // Replace '/login' with your actual Laravel route
                xhr.open('POST', '{{ route('login') }}', true);

                // Crucial for Laravel: CSRF Token
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('Accept', 'application/json'); // Expect JSON response

                xhr.onload = function() {
                    if (xhr.status === 200) {

                        window.location.href =
                            '{{ route('manager-team.dashboard') }}'; // Redirect to dashboard or desired page
                        closeLoginModal();
                    } else if (xhr.status === 422) {
                        // Validation errors
                        var errors = JSON.parse(xhr.responseText);
                        errorSpan.innerText = errors.message;
                        errorSpan.style.display = 'block';

                        loginButton.disabled = false;
                        loginButton.innerText = 'Login';

                    } else {
                        var response = JSON.parse(xhr.responseText);
                        if (response.message) {
                            errorSpan.innerText = response.message;
                            errorSpan.style.display = 'block';
                        } else {
                            errorSpan.innerText = 'An unexpected error occurred. Please try again.';
                            errorSpan.style.display = 'block';
                        }

                        loginButton.disabled = false;
                        loginButton.innerText = 'Login';
                    }
                };

                xhr.onerror = function() {
                    alert('Network error occurred. Please check your connection.');
                    loginButton.disabled = false;
                    loginButton.innerText = 'Login';
                };

                xhr.send(formData);

            });

            //Form signup AJAX Submission
            formSignup.addEventListener('submit', function(e) {
                e.preventDefault();

                var signupButton = this.querySelector('button[type="submit"]');
                signupButton.disabled = true;
                signupButton.innerText = 'Signing up...';

                var formData = new FormData(this);
                var xhr = new XMLHttpRequest();

                const csrfToken = this.querySelector('input[name="_token"]')?.value;

                // Replace '/register' with your actual Laravel route
                xhr.open('POST', '{{ route('register', ['type' => 'manager-team']) }}', true);

                // Crucial for Laravel: CSRF Token
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('Accept', 'application/json'); // Expect JSON response
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Successful registration
                        window.location.href =
                            '{{ route('manager-team.dashboard') }}'; // Redirect to dashboard or desired page
                        closeSignupModal();
                    } else if (xhr.status === 422) {
                        // Validation errors
                        var errors = JSON.parse(xhr.responseText);
                        var errorMessages = [];
                        for (var key in errors.errors) {
                            if (errors.errors.hasOwnProperty(key)) {
                                errorMessages.push(errors.errors[key].join(' '));
                            }
                        }
                        alert('Registration failed:\n' + errorMessages.join('\n'));

                        signupButton.disabled = false;
                        signupButton.innerText = 'Daftar Sekarang';
                    } else {
                        alert('An unexpected error occurred. Please try again.');

                        signupButton.disabled = false;
                        signupButton.innerText = 'Daftar Sekarang';
                    }
                };

                xhr.onerror = function() {
                    alert('Network error occurred. Please check your connection.');
                    signupButton.disabled = false;
                    signupButton.innerText = 'Daftar Sekarang';
                };

                xhr.send(formData);

            });

        });
    </script>

</body>

</html>

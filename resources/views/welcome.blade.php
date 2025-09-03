<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto de Investigación - Ingeniería de Sistemas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 25%, #6366f1 50%, #8b5cf6 75%, #a855f7 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% {
                transform: translateX(0) translateY(0);
            }

            100% {
                transform: translateX(10px) translateY(10px);
            }
        }

        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            50% {
                transform: translateY(-100px) rotate(180deg);
            }
        }

        .morphing-card {
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform-style: preserve-3d;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .morphing-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .morphing-card:hover::before {
            left: 100%;
        }

        .morphing-card:hover {
            transform: translateY(-20px) rotateX(5deg) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .glow-text {
            text-shadow: 0 0 20px rgba(99, 102, 241, 0.8), 0 0 40px rgba(99, 102, 241, 0.4);
            animation: textGlow 3s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            from {
                text-shadow: 0 0 20px rgba(99, 102, 241, 0.8), 0 0 40px rgba(99, 102, 241, 0.4);
            }

            to {
                text-shadow: 0 0 30px rgba(139, 92, 246, 0.9), 0 0 60px rgba(139, 92, 246, 0.6);
            }
        }

        .holographic-border {
            position: relative;
            background: linear-gradient(45deg, #ff006e, #8338ec, #3a86ff, #06ffa5);
            background-size: 300% 300%;
            animation: gradientShift 4s ease infinite;
            padding: 2px;
            border-radius: 12px;
        }

        .holographic-border::before {
            content: '';
            position: absolute;
            inset: 2px;
            background: white;
            border-radius: 10px;
            z-index: 1;
        }

        .holographic-content {
            position: relative;
            z-index: 2;
            background: white;
            border-radius: 10px;
            padding: 2rem;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .stats-counter {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(135deg, #6366f1, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .liquid-button {
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transition: all 0.3s ease;
        }

        .liquid-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .liquid-button:hover::before {
            left: 100%;
        }

        .liquid-button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }

        .navbar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .project-image {
            transition: all 0.5s ease;
            filter: brightness(0.8) contrast(1.2);
        }

        .project-card:hover .project-image {
            transform: scale(1.1);
            filter: brightness(1) contrast(1.3);
        }

        .tech-icon {
            transition: all 0.3s ease;
        }

        .tech-icon:hover {
            transform: rotateY(360deg) scale(1.2);
            color: #6366f1;
        }

        .pulse-ring {
            content: '';
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid #6366f1;
            border-radius: 50%;
            animation: pulseRing 2s cubic-bezier(0.25, 0, 0, 1) infinite;
        }

        @keyframes pulseRing {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }

            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .testimonial-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-10px) rotateX(5deg);
            background: linear-gradient(135deg, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0.9));
        }

        .three-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .interactive-bg {
            position: relative;
            overflow: hidden;
        }

        .wave-animation {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="rgba(255,255,255,0.1)"></path></svg>') repeat-x;
            animation: wave 10s ease-in-out infinite;
        }

        @keyframes wave {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-50px);
            }
        }

        .typing-animation {
            overflow: hidden;
            border-right: 3px solid #6366f1;
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent;
            }

            50% {
                border-color: #6366f1;
            }
        }

        .matrix-rain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .matrix-column {
            position: absolute;
            top: -100%;
            color: #00ff41;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            animation: matrixFall linear infinite;
        }

        @keyframes matrixFall {
            to {
                top: 100%;
            }
        }

        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899);
            transform-origin: left;
            z-index: 9999;
        }
    </style>
</head>

<body class="font-sans bg-gray-50 overflow-x-hidden">
    <!-- Scroll Progress Indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>

    <!-- Navbar with Glass Effect -->
    <nav class="navbar-glass fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center group cursor-pointer">
                        <div class="relative">
                            <i data-feather="cpu" class="h-8 w-8 text-indigo-600 tech-icon"></i>
                            <div class="pulse-ring absolute inset-0"></div>
                        </div>
                        <span
                            class="ml-2 text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">IIIS</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-indigo-600 font-medium relative group">
                        Inicio
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 transition-all relative group">
                        Investigación
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 transition-all relative group">
                        Proyectos
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 transition-all relative group">
                        Publicaciones
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 transition-all relative group">
                        Contacto
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                    </a>

                    @if (Route::has('login'))

                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="liquid-button bg-indigo-600 text-white px-6 py-2 rounded-full font-medium">
                                Ingresar
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Ingresar</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" href="{{ url('/dashboard') }}"
                                    class="liquid-button bg-indigo-600 text-white px-6 py-2 rounded-full font-medium">
                                    Registrarse
                                </a>
                            @endif
                        @endauth

                    @endif

                </div>
                <div class="md:hidden flex items-center">
                    <button class="text-gray-500 hover:text-gray-900 focus:outline-none tech-icon">
                        <i data-feather="menu" class="h-6 w-6"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Advanced Effects -->
    <section class="hero-gradient pt-32 pb-20 text-white interactive-bg relative min-h-screen flex items-center">
        <div class="floating-particles" id="particlesContainer"></div>
        <canvas class="three-canvas" id="threeCanvas"></canvas>
        <div class="wave-animation"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="md:flex items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
                    <div class="typing-animation mb-6">
                        <h1 class="text-4xl md:text-6xl font-black glow-text">
                            IIIS
                            <br>
                            <span class="text-yellow-300 inline-block transform hover:scale-105 transition-transform">
                                Ingeniería de Sistemas
                            </span>
                        </h1>
                    </div>
                    <p class="text-xl mb-8 opacity-90 transform translate-x-0 transition-all duration-1000"
                        data-aos="fade-up" data-aos-delay="500">
                        🚀 Innovación, tecnología y desarrollo para construir el futuro de los sistemas computacionales.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4" data-aos="fade-up"
                        data-aos-delay="700">
                        <button
                            class="liquid-button bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold hover:shadow-2xl transform hover:scale-105 transition-all group">
                            <span class="flex items-center">
                                ✨ Conoce más
                                <i data-feather="arrow-right"
                                    class="ml-2 h-5 w-5 group-hover:translate-x-2 transition-transform"></i>
                            </span>
                        </button>
                        <button
                            class="liquid-button border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-indigo-600 transition-all group">
                            <i data-feather="play" class="inline mr-2 group-hover:scale-125 transition-transform"></i>
                            Ver demo
                        </button>
                    </div>
                </div>
                <div class="md:w-1/2 relative" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative group">
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-pink-600 to-purple-600 rounded-lg blur-xl opacity-75 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-pulse">
                        </div>
                        <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80"
                            alt="Sistemas computacionales"
                            class="relative rounded-2xl shadow-2xl transform rotate-3 hover:rotate-0 transition-all duration-700 hover:scale-105">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Animated Stats Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="matrix-rain" id="matrixRain"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="p-8 group" data-aos="zoom-in" data-aos-duration="800">
                    <div class="stats-counter mb-4" data-count="15">0</div>
                    <div class="text-gray-600 font-medium group-hover:text-indigo-600 transition-colors">Años de
                        experiencia</div>
                    <div
                        class="w-12 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto mt-2 transform scale-0 group-hover:scale-100 transition-transform">
                    </div>
                </div>
                <div class="p-8 group" data-aos="zoom-in" data-aos-delay="100" data-aos-duration="800">
                    <div class="stats-counter mb-4" data-count="50">0</div>
                    <div class="text-gray-600 font-medium group-hover:text-indigo-600 transition-colors">Proyectos
                        completados</div>
                    <div
                        class="w-12 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto mt-2 transform scale-0 group-hover:scale-100 transition-transform">
                    </div>
                </div>
                <div class="p-8 group" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="800">
                    <div class="stats-counter mb-4" data-count="200">0</div>
                    <div class="text-gray-600 font-medium group-hover:text-indigo-600 transition-colors">Publicaciones
                        científicas</div>
                    <div
                        class="w-12 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto mt-2 transform scale-0 group-hover:scale-100 transition-transform">
                    </div>
                </div>
                <div class="p-8 group" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="800">
                    <div class="stats-counter mb-4" data-count="30">0</div>
                    <div class="text-gray-600 font-medium group-hover:text-indigo-600 transition-colors">Investigadores
                    </div>
                    <div
                        class="w-12 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto mt-2 transform scale-0 group-hover:scale-100 transition-transform">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Research Areas with Holographic Cards -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-indigo-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-4xl font-black text-gray-900 mb-6">Áreas de Investigación</h2>
                <div class="w-32 h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 mx-auto rounded-full">
                </div>
                <p class="text-xl text-gray-600 mt-6 max-w-3xl mx-auto">Exploramos las fronteras de la tecnología para
                    crear soluciones innovadoras</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="holographic-border morphing-card" data-aos="fade-up">
                    <div class="holographic-content">
                        <div class="text-indigo-600 mb-6 flex justify-center">
                            <div class="relative">
                                <i data-feather="cpu" class="h-12 w-12 tech-icon"></i>
                                <div
                                    class="absolute inset-0 bg-indigo-600 rounded-full blur-xl opacity-20 scale-150 animate-pulse">
                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-center">Inteligencia Artificial</h3>
                        <p class="text-gray-600 text-center">Desarrollo de algoritmos avanzados de machine learning y
                            deep learning para resolver problemas complejos del futuro.</p>
                    </div>
                </div>

                <div class="holographic-border morphing-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="holographic-content">
                        <div class="text-indigo-600 mb-6 flex justify-center">
                            <div class="relative">
                                <i data-feather="shield" class="h-12 w-12 tech-icon"></i>
                                <div
                                    class="absolute inset-0 bg-indigo-600 rounded-full blur-xl opacity-20 scale-150 animate-pulse">
                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-center">Ciberseguridad</h3>
                        <p class="text-gray-600 text-center">Investigación en protección de datos, análisis de
                            vulnerabilidades y desarrollo de sistemas de seguridad de próxima generación.</p>
                    </div>
                </div>

                <div class="holographic-border morphing-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="holographic-content">
                        <div class="text-indigo-600 mb-6 flex justify-center">
                            <div class="relative">
                                <i data-feather="cloud" class="h-12 w-12 tech-icon"></i>
                                <div
                                    class="absolute inset-0 bg-indigo-600 rounded-full blur-xl opacity-20 scale-150 animate-pulse">
                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-center">Computación en la Nube</h3>
                        <p class="text-gray-600 text-center">Optimización de arquitecturas distribuidas y desarrollo de
                            servicios escalables en entornos cloud híbridos.</p>
                    </div>
                </div>

                <div class="holographic-border morphing-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="holographic-content">
                        <div class="text-indigo-600 mb-6 flex justify-center">
                            <div class="relative">
                                <i data-feather="database" class="h-12 w-12 tech-icon"></i>
                                <div
                                    class="absolute inset-0 bg-indigo-600 rounded-full blur-xl opacity-20 scale-150 animate-pulse">
                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-center">Big Data & Analytics</h3>
                        <p class="text-gray-600 text-center">Procesamiento inteligente de grandes volúmenes de datos
                            para extracción de conocimiento y predicciones avanzadas.</p>
                    </div>
                </div>

                <div class="holographic-border morphing-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="holographic-content">
                        <div class="text-indigo-600 mb-6 flex justify-center">
                            <div class="relative">
                                <i data-feather="wifi" class="h-12 w-12 tech-icon"></i>
                                <div
                                    class="absolute inset-0 bg-indigo-600 rounded-full blur-xl opacity-20 scale-150 animate-pulse">
                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-center">IoT & Edge Computing</h3>
                        <p class="text-gray-600 text-center">Sistemas embebidos y redes inteligentes de sensores para
                            aplicaciones en ciudades inteligentes y Industry 4.0.</p>
                    </div>
                </div>

                <div class="holographic-border morphing-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="holographic-content">
                        <div class="text-indigo-600 mb-6 flex justify-center">
                            <div class="relative">
                                <i data-feather="bar-chart-2" class="h-12 w-12 tech-icon"></i>
                                <div
                                    class="absolute inset-0 bg-indigo-600 rounded-full blur-xl opacity-20 scale-150 animate-pulse">
                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-center">Visualización Inmersiva</h3>
                        <p class="text-gray-600 text-center">Técnicas avanzadas de realidad virtual y aumentada para
                            representación interactiva de información compleja.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects with Enhanced Effects -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-4xl font-black text-gray-900 mb-6">Proyectos Destacados</h2>
                <div class="w-32 h-2 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 mx-auto rounded-full">
                </div>
                <p class="text-xl text-gray-600 mt-6">Innovaciones que están transformando el mundo</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                <div class="project-card relative rounded-2xl overflow-hidden shadow-2xl group" data-aos="fade-right">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 opacity-20 group-hover:opacity-30 transition-opacity">
                    </div>
                    <img src="https://images.unsplash.com/photo-1517430816045-df4b7ac11c50?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80"
                        alt="Proyecto IA" class="project-image w-full h-80 object-cover">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 p-8 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform">
                        <div class="flex items-center mb-3">
                            <span
                                class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">🤖
                                AI</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Sistema de Reconocimiento Facial Avanzado</h3>
                        <p class="mb-4 opacity-90">Algoritmos de deep learning con precisión del 99.8% para
                            identificación biométrica en tiempo real y detección de emociones.</p>
                        <button
                            class="flex items-center text-blue-300 hover:text-white transition-colors group-hover:translate-x-2 transform transition-transform">
                            Ver detalles
                            <i data-feather="arrow-right" class="ml-2 h-4 w-4"></i>
                        </button>
                    </div>
                </div>

                <div class="project-card relative rounded-2xl overflow-hidden shadow-2xl group" data-aos="fade-left">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-600 opacity-20 group-hover:opacity-30 transition-opacity">
                    </div>
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80"
                        alt="Proyecto Ciberseguridad" class="project-image w-full h-80 object-cover">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 p-8 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform">
                        <div class="flex items-center mb-3">
                            <span
                                class="bg-gradient-to-r from-red-400 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-medium">🛡️
                                Security</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Plataforma de Pentesting Automatizada</h3>
                        <p class="mb-4 opacity-90">Herramientas de inteligencia artificial para pruebas de penetración
                            y análisis de vulnerabilidades en tiempo real.</p>
                        <button
                            class="flex items-center text-red-300 hover:text-white transition-colors group-hover:translate-x-2 transform transition-transform">
                            Ver detalles
                            <i data-feather="arrow-right" class="ml-2 h-4 w-4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button
                    class="liquid-button border-2 border-indigo-600 text-indigo-600 px-8 py-4 rounded-full font-semibold hover:bg-indigo-600 hover:text-white transition-all transform hover:scale-105 group">
                    <i data-feather="grid" class="inline mr-2 group-hover:rotate-12 transition-transform"></i>
                    Ver todos los proyectos
                </button>
            </div>
        </div>
    </section>


    <!-- Formulario para Generar Certificado -->
    @foreach ($certificadosActivos as $certificado)
        <section class="py-24 bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 relative overflow-hidden">
            <div class="max-w-3xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-4xl font-black text-gray-900 mb-6">Generar Certificado</h2>
                    <div
                        class="w-32 h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 mx-auto rounded-full">
                    </div>
                    <p class="text-lg text-gray-600 mt-6">Completa los datos para crear tu certificado personalizado
                    </p>
                </div>

                <form action="{{ route('certificados.estudiantepreviewPDF', $certificado->id) }}" method="POST"
                    class="bg-white shadow-xl rounded-2xl p-8 space-y-6" data-aos="fade-up">
                    <!-- Nombre -->
                    @csrf
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombres</label>
                        <input type="text" id="nombre" name="nombres" required
                            class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
                            placeholder="Ej: Juan Alcachofa" />
                    </div>

                    <div>
                        <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" required
                            class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
                            placeholder="Apellidos completos" />
                    </div>

                    <div>
                        <label for="ci" class="block text-sm font-medium text-gray-700">Carnet</label>
                        <input type="text" id="ci" name="ci" required
                            class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
                            placeholder="Número de carnet" />
                    </div>

                    <div>
                        <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                        <input type="text" id="correo" name="email" required
                            class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
                            placeholder="ejemplo@gmail.com" />
                    </div>

                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700"Número celular</label>
                        <input type="text" id="telefono" name="telefono" required
                            class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
                            placeholder="ej: 78888888" />
                    </div>

                    <!-- Curso -->
                    <div>
                        <label for="curso" class="block text-sm font-medium text-gray-700">Nombre del Curso</label>
                        <input type="text" id="curso" name="curso" required disabled
                            class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
                            value="{{ $certificado->nombre }}" />
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha de Emisión</label>
                        <input type="date" id="fecha" name="fecha_emision" required disabled
                            class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3" />
                    </div>

                    <script>
                        document.getElementById("fecha").value = new Date().toISOString().split("T")[0];
                    </script>


                    <!-- Botón -->
                    <div class="text-center">
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white font-semibold rounded-xl shadow-lg hover:opacity-90 transition duration-200">
                            Generar Certificado
                        </button>
                    </div>




                </form>
            </div>
        </section>
    @endforeach

    {{-- <div class="mt-6 space-y-2">
                <a href="{{ route('admin.certificados.preview-pdf', $certificado->id) }}?nombre_estudiante={{ urlencode($nombreCompleto) }}&top={{ $top ?? 260 }}&left={{ $left ?? 400 }}"
                    target="_blank"
                    class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded">
                    Ver PDF de Prueba
                </a>
            </div> --}}



    <!-- Enhanced Testimonials Section -->
    <section class="py-24 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-4xl font-black text-gray-900 mb-6">Lo Que Dicen Nuestros Colaboradores</h2>
                <div class="w-32 h-2 bg-gradient-to-r from-green-500 via-blue-500 to-purple-500 mx-auto rounded-full">
                </div>
                <p class="text-xl text-gray-600 mt-6">Testimonios de quienes han trabajado con nosotros</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="testimonial-card p-8 rounded-2xl shadow-lg" data-aos="zoom-in">
                    <div class="flex items-center mb-6">
                        <div class="flex text-yellow-400 space-x-1">
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-500">5.0</span>
                    </div>
                    <blockquote class="text-gray-700 mb-6 text-lg italic">
                        "El trabajo del instituto en inteligencia artificial ha revolucionado completamente nuestros
                        procesos de análisis de datos. La precisión y velocidad son extraordinarias."
                    </blockquote>
                    <div class="flex items-center">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Maria Gutierrez"
                                class="h-12 w-12 rounded-full object-cover ring-4 ring-white shadow-lg">
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white">
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="font-bold text-gray-900">Maria Gutierrez</div>
                            <div class="text-sm text-gray-500 flex items-center">
                                <i data-feather="briefcase" class="h-3 w-3 mr-1"></i>
                                CEO, DataTech Solutions
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card p-8 rounded-2xl shadow-lg" data-aos="zoom-in" data-aos-delay="100">
                    <div class="flex items-center mb-6">
                        <div class="flex text-yellow-400 space-x-1">
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-500">5.0</span>
                    </div>
                    <blockquote class="text-gray-700 mb-6 text-lg italic">
                        "La colaboración con los investigadores nos ha permitido desarrollar soluciones de
                        ciberseguridad que están años adelantadas a la competencia."
                    </blockquote>
                    <div class="flex items-center">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos Mendoza"
                                class="h-12 w-12 rounded-full object-cover ring-4 ring-white shadow-lg">
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white">
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="font-bold text-gray-900">Carlos Mendoza</div>
                            <div class="text-sm text-gray-500 flex items-center">
                                <i data-feather="briefcase" class="h-3 w-3 mr-1"></i>
                                CTO, SecureNet Industries
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card p-8 rounded-2xl shadow-lg" data-aos="zoom-in" data-aos-delay="200">
                    <div class="flex items-center mb-6">
                        <div class="flex text-yellow-400 space-x-1">
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                            <i data-feather="star" class="h-5 w-5 fill-current"></i>
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-500">5.0</span>
                    </div>
                    <blockquote class="text-gray-700 mb-6 text-lg italic">
                        "Los proyectos de IoT desarrollados han transformado completamente nuestra infraestructura de
                        ciudades inteligentes. Increíble innovación."
                    </blockquote>
                    <div class="flex items-center">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Laura Fernandez"
                                class="h-12 w-12 rounded-full object-cover ring-4 ring-white shadow-lg">
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white">
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="font-bold text-gray-900">Laura Fernandez</div>
                            <div class="text-sm text-gray-500 flex items-center">
                                <i data-feather="briefcase" class="h-3 w-3 mr-1"></i>
                                Directora, SmartCity Initiative
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action with Particle Effect -->
    <section class="py-24 hero-gradient text-white relative overflow-hidden">
        <div class="floating-particles" id="ctaParticles"></div>
        <div class="wave-animation opacity-30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div data-aos="zoom-in" data-aos-duration="1000">
                <h2 class="text-4xl md:text-5xl font-black mb-8 glow-text">
                    ¿Listo para Revolucionar el Futuro? 🚀
                </h2>
                <p class="text-xl mb-12 max-w-4xl mx-auto opacity-95 leading-relaxed">
                    Únete a nuestra comunidad de visionarios y colabora con nuestros proyectos que están redefiniendo
                    los límites de la tecnología.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <button
                        class="liquid-button bg-white text-indigo-600 px-10 py-5 rounded-full font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all group"
                        data-aos="fade-right" data-aos-delay="200">
                        <span class="flex items-center">
                            💬 Comienza Ahora
                            <i data-feather="arrow-right"
                                class="ml-3 h-5 w-5 group-hover:translate-x-2 transition-transform"></i>
                        </span>
                    </button>
                    <button
                        class="liquid-button border-2 border-white text-white px-10 py-5 rounded-full font-bold text-lg hover:bg-white hover:text-indigo-600 transition-all group"
                        data-aos="fade-left" data-aos-delay="300">
                        <i data-feather="mail" class="inline mr-3 group-hover:scale-125 transition-transform"></i>
                        Enviar Propuesta
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer
        class="bg-gradient-to-br from-gray-900 via-gray-800 to-indigo-900 text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 animate-pulse"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div data-aos="fade-up">
                    <div class="flex items-center mb-6">
                        <div class="relative">
                            <i data-feather="cpu" class="h-10 w-10 text-indigo-400 tech-icon"></i>
                            <div class="pulse-ring absolute inset-0"></div>
                        </div>
                        <span class="ml-3 text-2xl font-bold">IIIS</span>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Instituto de Investigación de Ingeniería de Sistemas - Pioneros en innovación tecnológica y
                        desarrollo de soluciones del mañana.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="text-gray-400 hover:text-indigo-400 transition-all transform hover:scale-125">
                            <i data-feather="facebook" class="h-6 w-6"></i>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-indigo-400 transition-all transform hover:scale-125">
                            <i data-feather="twitter" class="h-6 w-6"></i>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-indigo-400 transition-all transform hover:scale-125">
                            <i data-feather="linkedin" class="h-6 w-6"></i>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-indigo-400 transition-all transform hover:scale-125">
                            <i data-feather="youtube" class="h-6 w-6"></i>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-indigo-400 transition-all transform hover:scale-125">
                            <i data-feather="github" class="h-6 w-6"></i>
                        </a>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-lg font-bold mb-6 text-indigo-300">Enlaces Rápidos</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">🏠
                                Inicio</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">🔬
                                Investigación</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">🚀
                                Proyectos</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">📚
                                Publicaciones</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">📞
                                Contacto</a></li>
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-lg font-bold mb-6 text-indigo-300">Áreas de Expertise</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">🤖
                                Inteligencia Artificial</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">🛡️
                                Ciberseguridad</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">☁️
                                Cloud Computing</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">📊
                                Big Data</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-all hover:translate-x-2 transform inline-block">🌐
                                IoT</a></li>
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-lg font-bold mb-6 text-indigo-300">Contacto</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start group">
                            <i data-feather="map-pin"
                                class="h-5 w-5 text-indigo-400 mr-3 mt-1 group-hover:scale-125 transition-transform"></i>
                            <span class="text-gray-300 group-hover:text-white transition-colors">Av. Universitaria
                                1801<br>Lima, Perú</span>
                        </li>
                        <li class="flex items-center group">
                            <i data-feather="mail"
                                class="h-5 w-5 text-indigo-400 mr-3 group-hover:scale-125 transition-transform"></i>
                            <span
                                class="text-gray-300 group-hover:text-white transition-colors">contacto@iiis.edu.pe</span>
                        </li>
                        <li class="flex items-center group">
                            <i data-feather="phone"
                                class="h-5 w-5 text-indigo-400 mr-3 group-hover:scale-125 transition-transform"></i>
                            <span class="text-gray-300 group-hover:text-white transition-colors">+51 987 654 321</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 mb-4 md:mb-0">
                        © 2025 Instituto de Investigación de Ingeniería de Sistemas. Developer CAARLOZ.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Política de
                            Privacidad</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Términos de
                            Uso</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    @endif
</script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });

        // Initialize Feather Icons
        feather.replace();

        // Scroll Progress Indicator
        window.addEventListener('scroll', () => {
            const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            document.getElementById('scrollIndicator').style.transform = `scaleX(${scrolled / 100})`;
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.backdropFilter = 'blur(20px)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.backdropFilter = 'blur(20px)';
            }
        });

        // Animated Counter
        const observerOptions = {
            threshold: 0.7
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-count'));
                    let current = 0;
                    const increment = target / 100;

                    const updateCounter = () => {
                        if (current < target) {
                            current += increment;
                            counter.textContent = Math.ceil(current) + '+';
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target + '+';
                        }
                    };

                    updateCounter();
                    counterObserver.unobserve(counter);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stats-counter').forEach(counter => {
            counterObserver.observe(counter);
        });

        // Floating Particles
        function createParticles(containerId, particleCount = 50) {
            const container = document.getElementById(containerId);
            if (!container) return;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
                container.appendChild(particle);
            }
        }

        createParticles('particlesContainer');
        createParticles('ctaParticles', 30);

        // Matrix Rain Effect
        function createMatrixRain() {
            const container = document.getElementById('matrixRain');
            if (!container) return;

            const chars = '01';
            const columns = Math.floor(window.innerWidth / 20);

            for (let i = 0; i < columns; i++) {
                const column = document.createElement('div');
                column.className = 'matrix-column';
                column.style.left = i * 20 + 'px';
                column.style.animationDuration = (Math.random() * 3 + 2) + 's';
                column.style.animationDelay = Math.random() * 2 + 's';

                let text = '';
                for (let j = 0; j < 20; j++) {
                    text += chars[Math.floor(Math.random() * chars.length)];
                }
                column.textContent = text;

                container.appendChild(column);
            }
        }

        createMatrixRain();

        // Three.js Background Animation
        let scene, camera, renderer, particles;

        function initThreeJS() {
            const canvas = document.getElementById('threeCanvas');
            if (!canvas) return;

            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            renderer = new THREE.WebGLRenderer({
                canvas: canvas,
                alpha: true
            });
            renderer.setSize(window.innerWidth, window.innerHeight);

            // Create particle system
            const geometry = new THREE.BufferGeometry();
            const particleCount = 1000;
            const positions = new Float32Array(particleCount * 3);

            for (let i = 0; i < particleCount * 3; i++) {
                positions[i] = (Math.random() - 0.5) * 10;
            }

            geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

            const material = new THREE.PointsMaterial({
                color: 0x6366f1,
                size: 0.02,
                transparent: true,
                opacity: 0.6
            });

            particles = new THREE.Points(geometry, material);
            scene.add(particles);

            camera.position.z = 5;

            animate();
        }

        function animate() {
            requestAnimationFrame(animate);

            if (particles) {
                particles.rotation.x += 0.001;
                particles.rotation.y += 0.002;
            }

            renderer.render(scene, camera);
        }

        // Mouse parallax effect
        document.addEventListener('mousemove', (e) => {
            const cards = document.querySelectorAll('.morphing-card');
            const mouseX = e.clientX / window.innerWidth - 0.5;
            const mouseY = e.clientY / window.innerHeight - 0.5;

            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const cardX = (rect.left + rect.width / 2) / window.innerWidth - 0.5;
                const cardY = (rect.top + rect.height / 2) / window.innerHeight - 0.5;

                const deltaX = (mouseX - cardX) * 10;
                const deltaY = (mouseY - cardY) * 10;

                card.style.transform = `perspective(1000px) rotateY(${deltaX}deg) rotateX(${-deltaY}deg)`;
            });
        });

        // Initialize Three.js on load
        window.addEventListener('load', initThreeJS);

        // Handle window resize
        window.addEventListener('resize', () => {
            if (camera && renderer) {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animation
        window.addEventListener('load', () => {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });
    </script>


</body>

</html>

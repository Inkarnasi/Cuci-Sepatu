<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} | CuciSepatu</title> <!-- Dynamic title -->
    <link rel="stylesheet" href="/LandingPage/css/styles.css">
    <link rel="stylesheet" href="/LandingPage/css/blog-detail.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#">CuciSepatu</a>
            </div>
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/blog">Blog</a></li>
            </ul>
        </div>
    </nav>

    <!-- Blog Detail Section -->
    <section class="blog-detail-section">
        <div class="container">
            <div class="blog-detail-content">
                <!-- Dynamic blog title -->
                <h1>{{ $blog->title }}</h1>

                <!-- Dynamic published date, time, and author -->
                <p class="publish-info">
                    Dipublikasikan pada: {{ \Carbon\Carbon::parse($blog->date_publish)->format('d F Y') }}
                    {{ $blog->time_publish }} oleh
                    {{ $blog->user->name }}
                </p>

                <!-- Dynamic blog image with conditional check -->
                <div class="blog-image">
                    @if (Str::startsWith($blog->image_url, ['http://', 'https://']))
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                    @else
                        <img src="{{ asset('storage/' . $blog->image_url) }}" alt="{{ $blog->title }}">
                    @endif
                </div>

                <!-- Dynamic blog description -->
                <div class="blog-body">
                    <p>{!! nl2br(e($blog->description)) !!}</p>
                </div>

                <div class="back-button-container">
                    <a href="{{ route('blog-landingPage') }}" class="back-button">Kembali ke Blog</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <h3 class="footer-logo">CuciSepatu</h3>
                <p class="footer-description">Jasa Cuci Sepatu Modern & Profesional</p>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 achedev. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>

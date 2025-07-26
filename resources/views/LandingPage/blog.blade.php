<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Cuci Sepatu Modern</title>
    <link rel="stylesheet" href="{{ asset('/LandingPage/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/LandingPage/css/blog.css') }}"> <!-- Link ke blog.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#">CuciSepatu</a>
            </div>
            <button class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>
            <ul id="nav-links" class="nav-links">
                <li><a href="{{ route('landingPage') }}">Home</a></li>
                <li><a href="{{ route('landingPage') }}">About</a></li>
                <li><a href="{{ route('landingPage') }}">Services</a></li>
                <li><a href="{{ route('landingPage') }}">Blog</a></li>
                <li><a href="{{ route('landingPage') }}">Tracking</a></li>
                <li><a href="{{ route('landingPage') }}">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Blog List Section -->
    <section id="blog-list" class="blog-list-section">
        <div class="container">
            <h2 class="section-title">Semua Blog Kami</h2>
            <p class="section-description">Temukan artikel terbaru tentang tips merawat sepatu, gaya hidup, dan lainnya
                di sini.</p>

            <!-- Filter Section -->
            <div class="filter-section">
                <form action="{{ route('blog-landingPage') }}" method="GET">
                    <label for="filter-date" class="filter-label">Filter by Tanggal:</label>
                    <div class="filter-wrapper">
                        <input type="date" name="filter_date" id="filter-date" class="filter-input"
                            value="{{ request()->filter_date }}">
                        <button class="filter-btn" type="submit">Filter</button>
                    </div>
                </form>
            </div>
            <!-- Search Form -->
            <section class="search-section">
                <form action="{{ route('blog-landingPage') }}" method="GET" class="search-form" id="search-form">
                    <label for="search-input" class="search-label">Cari Blog:</label>
                    <div class="search-input-container">
                        <input type="text" name="search" id="search-input" class="search-input"
                            placeholder="Cari artikel..." value="{{ request()->search }}">
                        <span id="clear-search" class="clear-icon">&times;</span> <!-- Ikon X untuk menghapus input -->
                        <button type="submit" class="search-btn">Cari</button>
                    </div>
                </form>

                <!-- Badge Section for Multiple Suggestions -->
                @if (!empty($suggestions) && $suggestions->isNotEmpty())
                    <div class="suggestion-badge-container">
                        <span class="suggestion-badge">Mungkin yang Anda maksud:</span>
                        <ul class="suggestion-list">
                            @foreach ($suggestions as $suggestion)
                                <li class="suggestion-item">
                                    <a href="{{ route('blog-landingPage', ['search' => $suggestion['value']]) }}"
                                        class="suggestion-link" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $suggestion['value'] }}">
                                        <span class="suggestion-value">{{ $suggestion['value'] }}</span>
                                        <span class="suggestion-source">{{ $suggestion['source'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </section>




            <div class="blog-content-wrapper">
                <!-- Blog Grid -->
                <div class="blog-grid">
                    @if ($blogs->count())
                        @foreach ($blogs as $blog)
                            <div class="blog-card" data-aos="fade-up">
                                <div class="blog-image">
                                    <img src="{{ $blog->image_url ?? 'https://via.placeholder.com/400x250' }}"
                                        alt="{{ $blog->title }}">
                                </div>
                                <div class="blog-content">
                                    <span
                                        class="blog-category">{{ $blog->category->name_category_blog ?? 'Kategori Tidak Tersedia' }}</span>
                                    <span class="blog-date">
                                        Dipublikasikan:
                                        {{ $blog->date_publish ? \Carbon\Carbon::parse($blog->date_publish)->format('d M Y') : 'Belum Dipublikasikan' }}
                                    </span>
                                    <h3>{{ $blog->title }}</h3>
                                    <p>{{ Str::limit($blog->content, 100) }}</p>
                                    <a href="{{ route('listBlog-detail', $blog->slug) }}" class="read-more-btn">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        @endforeach
                        @php
                            $emptySlots = 6 - ($blogs->count() % 6);
                        @endphp

                        @if ($blogs->count() % 6 != 0)
                            <!-- Cek apakah jumlah kartu tidak kelipatan 6 -->
                            @for ($i = 0; $i < $emptySlots; $i++)
                                <div class="blog-card placeholder"></div> <!-- Placeholder Kartu -->
                            @endfor
                        @endif
                    @else
                        <p>Tidak ada blog yang ditemukan.</p>
                    @endif
                </div>


                <!-- Sidebar for Categories and Popular Posts -->
                <div class="sidebar">
                    <!-- Categories Section -->
                    <!-- Categories Section -->
                    <div class="categories-section">
                        <h3>Kategori</h3>
                        <ul class="category-list">
                            @foreach ($categories as $category)
                                <li><a
                                        href="{{ route('blog-landingPage', ['category' => $category->id]) }}">{{ $category->name_category_blog }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <!-- Popular Posts Section -->
                    <div class="popular-posts-section">
                        <h3>Popular Posts</h3>
                        @foreach ($popularPosts as $post)
                            <a href="{{ route('listBlog-detail', $post->slug) }}" class="popular-post-link">
                                <div class="popular-post-card">
                                    <div class="popular-post-image">
                                        <img src="{{ $post->image_url ?? 'https://via.placeholder.com/100x100' }}"
                                            alt="{{ $post->title }}">
                                    </div>
                                    <div class="popular-post-content">
                                        <span
                                            class="popular-post-category">{{ $post->category->name_category_blog ?? 'Kategori Tidak Tersedia' }}</span>
                                        <!-- Tanggal Popular Post -->
                                        <span class="popular-post-date">
                                            {{ $post->date_publish ? \Carbon\Carbon::parse($post->date_publish)->format('d M Y') : 'Belum Dipublikasikan' }}
                                        </span>
                                        <h4>{{ $post->title }}</h4>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-links">
                {{ $blogs->appends(request()->except(['page', '_token']))->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>


    <!-- Footer Section -->
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const clearIcon = document.getElementById('clear-search');
            const searchForm = document.getElementById('search-form');

            if (clearIcon) {
                clearIcon.addEventListener('click', () => {
                    event.preventDefault();
                    searchInput.value = '';
                    searchInput.focus();
                    clearIcon.style.display = 'none'; // Sembunyikan ikon setelah menghapus
                    searchForm.submit();
                });

                searchInput.addEventListener('input', () => {
                    clearIcon.style.display = searchInput.value ? 'inline' : 'none';
                });
            }
        });
    </script>
</body>

</html>

<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\advice;
use App\Models\category;
use App\Models\category_layanan;
use App\Models\CategoryBlog;
use App\Models\DoorprizeWinner;
use App\Models\Hadiah;
use App\Models\plus_service;
use App\Models\promosi;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{
    public function landingPage()
    {
        $currentDate = date('Y-m-d');
        $advice = Advice::select("nama", "advice")
        ->latest() // Asumsi ada kolom `created_at`
        ->take(3) // Ambil hanya tiga entri
        ->get();
    
        $activePromo = promosi::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->where('status', 'active')
            ->first();
    
        $upcomingPromos = promosi::where('start_date', '>', $currentDate)
            ->where('status', 'upcoming')
            ->get();
    
        $expiredPromos = promosi::where('end_date', '<', $currentDate)
            ->where('status', 'expired')
            ->get();
    
        $categories = category_layanan::where('status_kategori_layanan', 'active')
            ->with(['category' => function ($query) {
                $query->where('status_kategori', 'active');
            }])
            ->get();
    
        $plusService = plus_service::where('status_plus_service', 'active')->get();
    
        $store = Store::first();
        $addressParts = explode(',', $store->address);
    
        return view('LandingPage.index', compact(
            'activePromo',
            'upcomingPromos',
            'expiredPromos',
            'categories',
            'plusService',
            'store',
            'advice'
        ));
    }
    

    public function index(Request $request)
    {
        // Mengambil kategori dari database
        $categories = CategoryBlog::all();

        // Query dasar untuk blog, tambahkan eager loading untuk relasi user dan category
        $blogsQuery = Blog::with('user', 'category')
            ->where('status_publish', 'published');

        // Filter berdasarkan kategori jika ada input category


        $suggestions = [];
        $suggestedSearch = null;

        if ($request->has('search') && $request->search) {
            $searchTerm = strtolower($request->search); // Ubah input pencarian ke lowercase untuk pencocokan yang case-insensitive

            // Mengambil data dari database menggunakan LIKE
            $possibleMatches = Blog::where('title', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('content', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                ->orWhereHas('category', function ($query) use ($searchTerm) {
                    $query->where('name_category_blog', 'LIKE', '%' . $searchTerm . '%');
                })
                ->with('category')
                ->get();

            // Mencocokkan input pencarian dengan kemungkinan hasil
            foreach ($possibleMatches as $match) {
                $suggestions[] = ['value' => $match->title, 'source' => 'title'];
            }

            // Mencocokkan secara manual dengan similar_text dan levenshtein
            $fuzzyMatches = [];
            foreach (Blog::all() as $blog) {
                $titleLower = strtolower($blog->title);

                // Menggunakan similar_text untuk mengecek persentase kemiripan
                similar_text($searchTerm, $titleLower, $percent);
                if ($percent >= 70) { // Ambang batas kemiripan, dapat disesuaikan
                    $fuzzyMatches[] = ['value' => $blog->title, 'source' => 'title (fuzzy match)'];
                }

                // Menggunakan Levenshtein untuk menghitung jarak edit
                $levDistance = levenshtein($searchTerm, $titleLower);
                if ($levDistance <= 3) { // Ambang batas jarak edit, dapat disesuaikan
                    $fuzzyMatches[] = ['value' => $blog->title, 'source' => 'title (levenshtein)'];
                }
            }

            // Gabungkan hasil pencocokan manual dengan suggestions
            $suggestions = collect($suggestions)->merge($fuzzyMatches)->unique('value')->values();

            // Ambil saran pertama jika ada
            if ($suggestions->isNotEmpty()) {
                $suggestedSearch = $suggestions->first();
            }

            // Filter berdasarkan pencarian
            $blogsQuery = Blog::with('user', 'category')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('content', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhereHas('category', function ($query) use ($searchTerm) {
                            $query->where('name_category_blog', 'LIKE', '%' . $searchTerm . '%');
                        });
                })
                ->where('status_publish', 'published');
        } else {
            // Query default jika tidak ada pencarian
            $blogsQuery = Blog::with('user', 'category')
                ->where('status_publish', 'published');
        }

        if ($request->has('category') && $request->category) {
            $blogsQuery->where('category_blog_id', $request->category);
        }

        // Filter berdasarkan tanggal jika ada input filter tanggal
        if ($request->has('filter_date') && $request->filter_date) {
            $blogsQuery->whereDate('date_publish', $request->filter_date);
        }
        // Pagination dengan 6 blog per halaman
        $blogs = $blogsQuery->orderBy('date_publish', 'desc')->paginate(6);
        // dd($blogs);

        // Mengambil 4 popular posts terbaru berdasarkan tanggal publikasi
        $popularPosts = Blog::with('category')
            ->where('status_publish', 'published')
            ->orderBy('date_publish', 'desc')
            ->limit(4)
            ->get();

        return view('LandingPage.blog', compact('blogs', 'categories', 'popularPosts', 'suggestions'));
    }


    public function showBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->published()->first(); // Check if blog is published
        if (!$blog) {
            return redirect()->back()->with('error', 'Blog tidak ditemukan atau belum dipublikasikan');
        }

        return view('LandingPage.detail-blog', compact('blog'));
    }
}

# Đây là đồ án web bán xe.
## Hiện tại đây là code tôi có. 
**Tôi sẽ tổng hợp các file code ở đây cho bạn nắm thông tin dự án của tôi:**

- một folder chứa các hình ảnh tên là "images". chứa ![alt text](/images/qrcode.jpg)
- một file index.html
- một file admin.html
- một file ai_chat.html
- một file detail.html
- một file login.php
- một file logout.php
- một file ai_chat.php
- một file db.php
- một file delete_car.php
- một file edit_car.php
- một file add_car.php
- một file get_cars.php
- một file train_bot.php
- một file save_order.php
- một file manage_orders.php
- một file style.css
- một file schema.sql

### file index.html:
```html
<!doctype html>
<html lang="vi" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SHOWROOM 4TL - Siêu Xe & Xe Sang Đẳng Cấp Hàng Đầu</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
      rel="stylesheet" />

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              brand: {
                50: "#fef2f2",
                100: "#fee2e2",
                500: "#ef4444",
                600: "#dc2626",
                700: "#b91c1c",
                800: "#991b1b",
                900: "#7f1d1d",
              },
            },
            fontFamily: {
              sans: ["Plus Jakarta Sans", "sans-serif"],
              heading: ["Outfit", "sans-serif"],
            },
          },
        },
      };
    </script>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body
    class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 transition-colors duration-300 min-h-screen selection:bg-red-600 selection:text-white">
    <!-- TOP PROMOTION BAR -->
    <div
      class="bg-gradient-to-r from-red-800 via-red-600 to-red-800 text-white text-xs font-semibold py-2 px-4 text-center tracking-wide border-b border-red-500/30 flex items-center justify-center gap-2">
      <span class="inline-block px-2 py-0.5 bg-black/40 rounded-full text-[10px] uppercase font-bold text-yellow-300">
        Ưu Đãi Đặc Biệt
      </span>
      <span>Tặng gói bảo hiểm thân vỏ 2 năm + Gói phủ Ceramic VIP khi cọc xe online trong tháng</span>
      <a href="#car-section" class="underline ml-2 hover:text-yellow-200">Khám Phá Ngay &rarr;</a>
    </div>

    <!-- MAIN HEADER / NAVBAR -->
    <header
      class="sticky top-0 z-40 bg-white/85 dark:bg-slate-950/85 backdrop-blur-xl border-b border-gray-200/80 dark:border-white/10 px-4 md:px-8 py-3.5 transition-all duration-300 shadow-sm dark:shadow-none">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="index.html" class="flex items-center gap-3 group">
          <div
            class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center text-white shadow-lg shadow-red-600/30 group-hover:scale-105 transition duration-300">
            <i class="fa-solid fa-shield-halved text-lg"></i>
          </div>
          <div>
            <div
              class="text-2xl font-black tracking-wider text-slate-900 dark:text-white font-heading leading-none flex items-center gap-1">
              4TL
              <span class="text-red-600 dark:text-red-500">MOTORS</span>
            </div>
            <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 tracking-widest uppercase">
              Supercar & Luxury
            </span>
          </div>
        </a>

        <!-- Navigation Links -->
        <nav class="hidden lg:flex items-center gap-7 text-sm font-semibold text-gray-600 dark:text-gray-300">
          <a
            href="index.html"
            class="text-red-600 dark:text-red-500 hover:text-red-500 transition flex items-center gap-1.5">
            <i class="fa-solid fa-house text-xs"></i>
            Trang Chủ
          </a>
          <a
            href="#car-section"
            class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center gap-1.5">
            <i class="fa-solid fa-car text-xs"></i>
            Bộ Sưu Tập Xe
          </a>
          <a
            href="#loan-calculator"
            class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center gap-1.5">
            <i class="fa-solid fa-calculator text-xs"></i>
            Dự Toán Trả Góp
          </a>
          <!-- Comparison Nav Link -->
          <button
            onclick="toggleCompareModal()"
            class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center gap-1.5 font-semibold text-sm">
            <i class="fa-solid fa-code-compare text-xs text-red-500"></i>
            <span>So Sánh Xe</span>
            <span id="compareNavCount" class="bg-red-600 text-white text-[10px] px-1.5 py-0.2 rounded-full hidden">
              0
            </span>
          </button>
          <button
            onclick="toggleChat()"
            class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center gap-1.5 font-semibold text-sm">
            <i class="fa-solid fa-headset text-xs text-red-500"></i>
            <span>Trợ Lý AI</span>
          </button>
          <a
            href="#services-section"
            class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center gap-1.5">
            <i class="fa-solid fa-award text-xs"></i>
            Dịch Vụ 5 Sao
          </a>
          <a
            href="#map-section"
            class="hover:text-red-600 dark:hover:text-red-400 transition flex items-center gap-1.5">
            <i class="fa-solid fa-map-location-dot text-xs"></i>
            Showroom
          </a>
          <a
            href="admin.html"
            class="text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-yellow-400 transition flex items-center gap-1 text-xs px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10">
            <i class="fa-solid fa-lock text-[10px]"></i>
            Admin
          </a>
        </nav>

        <!-- Right Actions -->
        <div class="flex items-center gap-3">
          <!-- Theme Toggle Button (Dark / Light) -->
          <button
            id="themeToggle"
            type="button"
            title="Chuyển chế độ Sáng / Tối"
            class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 text-amber-500 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-yellow-400 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
            <i id="themeIcon" class="fa-solid fa-sun text-base"></i>
          </button>

          <!-- Hotline VIP Button -->
          <a
            href="tel:0706850014"
            class="shine-hover relative group bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white font-bold px-4 py-2 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-lg shadow-red-600/25 transition">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <i class="fa-solid fa-phone-volume"></i>
            <span class="hidden sm:inline">0706.850.014</span>
            <span class="sm:hidden">Gọi VIP</span>
          </a>
        </div>
      </div>
    </header>

    <!-- HERO SECTION -->
    <section
      class="relative min-h-[580px] lg:min-h-[640px] flex items-center hero-gradient-mesh overflow-hidden border-b border-gray-200 dark:border-white/10 py-12 lg:py-16">
      <!-- Ambient Blur Glows -->
      <div
        class="absolute -top-40 -left-40 w-96 h-96 bg-red-600/10 dark:bg-red-600/15 rounded-full blur-3xl pointer-events-none"></div>
      <div
        class="absolute -bottom-40 -right-40 w-96 h-96 bg-red-500/10 rounded-full blur-3xl pointer-events-none"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
          <!-- Left Hero Content -->
          <div class="lg:col-span-7 space-y-6">
            <div
              class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-500/10 border border-red-500/30 text-red-600 dark:text-red-400 text-xs font-bold uppercase tracking-wider">
              <i class="fa-solid fa-bolt text-red-600 dark:text-red-500"></i>
              <span>Showroom Siêu Xe & Xe Sang Uy Tín Hàng Đầu</span>
            </div>

            <h1
              class="text-4xl sm:text-5xl lg:text-6xl font-black font-heading leading-tight tracking-tight text-slate-900 dark:text-white">
              ĐẲNG CẤP
              <span class="text-gradient-red">THƯỢNG LƯU</span>
              <br />
              BỨT PHÁ MỌI GIỚI HẠN
            </h1>

            <p class="text-gray-600 dark:text-gray-300 text-base sm:text-lg max-w-xl font-normal leading-relaxed">
              Khám phá bộ sưu tập hơn
              <strong class="text-slate-900 dark:text-white">
                50+ siêu xe thể thao, SUV cao cấp & xe điện thế hệ mới
              </strong>
              sẵn sàng bàn giao trong 24h. Cam kết kiểm định 160 bước nghiêm ngặt, hỗ trợ trả góp đến 80%.
            </p>

            <!-- CTAs -->
            <div class="flex flex-wrap items-center gap-4 pt-2">
              <a
                href="#car-section"
                class="bg-red-600 hover:bg-red-700 text-white font-bold px-7 py-3.5 rounded-2xl text-sm shadow-xl shadow-red-600/30 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                <span>Khám Phá Bộ Sưu Tập</span>
                <i class="fa-solid fa-arrow-right"></i>
              </a>
              <a
                href="#loan-calculator"
                class="bg-white hover:bg-gray-100 text-gray-800 dark:bg-slate-900/80 dark:hover:bg-slate-800 dark:text-gray-200 font-bold px-6 py-3.5 rounded-2xl text-sm border border-gray-300 dark:border-white/10 hover:border-red-500/40 transition flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-calculator text-red-600 dark:text-red-400"></i>
                <span>Dự Toán Trả Góp</span>
              </a>
              <button
                onclick="openBookingModal('Tất cả mẫu xe')"
                class="text-xs text-gray-500 hover:text-slate-900 dark:text-gray-400 dark:hover:text-white underline underline-offset-4 transition">
                Đăng ký lái thử tận nhà &rarr;
              </button>
            </div>

            <!-- Trust Stats Bar -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 border-t border-gray-200 dark:border-white/10">
              <div>
                <div class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white font-heading">50+</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Siêu xe có sẵn</div>
              </div>
              <div>
                <div class="text-2xl lg:text-3xl font-black text-red-600 dark:text-red-400 font-heading">100%</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Kiểm định chính hãng</div>
              </div>
              <div>
                <div class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white font-heading">80%</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Hỗ trợ vay trả góp</div>
              </div>
              <div>
                <div class="text-2xl lg:text-3xl font-black text-red-600 dark:text-red-400 font-heading">24/7</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Cứu hộ & Giao xe VIP</div>
              </div>
            </div>
          </div>

          <!-- Right Hero Visual Spotlight -->
          <div class="lg:col-span-5 relative">
            <div
              class="relative rounded-3xl p-2 bg-gradient-to-b from-red-500/20 via-black/5 to-transparent dark:from-red-500/30 dark:via-white/5 shadow-2xl">
              <div
                class="relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-gray-200 dark:border-white/10 group shadow-lg">
                <img
                  src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800"
                  alt="Porsche 911 Carrera S"
                  class="w-full h-80 sm:h-96 object-cover group-hover:scale-105 transition duration-700" />

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/10"></div>

                <!-- Floating Spec Badges -->
                <div class="absolute top-4 left-4 flex gap-2">
                  <span
                    class="bg-red-600 text-white text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider shadow-md">
                    ★ Spotlight Mới Về
                  </span>
                </div>

                <div
                  class="absolute bottom-4 left-4 right-4 p-4 rounded-xl bg-black/70 backdrop-blur-md border border-white/15 text-white">
                  <div class="flex justify-between items-end">
                    <div>
                      <span class="text-xs text-red-400 font-bold uppercase tracking-wider">Porsche Series</span>
                      <h3 class="text-xl font-black text-white">Porsche 911 Carrera S</h3>
                      <p class="text-xs text-gray-300">0-100 km/h: 3.5s | 450 HP | Hộp số PDK 8 cấp</p>
                    </div>
                    <div class="text-right">
                      <span class="text-[10px] text-gray-300 block">Giá niêm yết</span>
                      <span class="text-lg font-black text-red-400">8,5 Tỷ VNĐ</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- BRAND LOGO / QUICK FILTER STRIP -->
    <section
      class="py-6 bg-gray-100/80 dark:bg-slate-950/90 border-b border-gray-200 dark:border-white/10 overflow-x-auto">
      <div
        class="max-w-7xl mx-auto px-4 flex items-center gap-2 sm:gap-3 justify-start md:justify-center min-w-max"
        id="brandPillContainer">
        <!-- Brand pills injected via JavaScript -->
      </div>
    </section>

    <!-- MAIN CAR SHOWROOM & INVENTORY -->
    <main id="car-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
      <!-- Section Header -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
          <span
            class="text-xs font-bold text-red-600 dark:text-red-500 tracking-widest uppercase flex items-center gap-1.5">
            <i class="fa-solid fa-car-side"></i>
            BỘ SƯU TẬP XE 2026
          </span>
          <h2 class="text-3xl sm:text-4xl font-black font-heading mt-1 text-slate-900 dark:text-white">
            DANH SÁCH SIÊU XE & XE SANG SẴN GIAO
          </h2>
          <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 max-w-xl">
            Lựa chọn các siêu phẩm tốc độ, SUV thương gia và xe điện bán chạy nhất hiện nay. Đầy đủ giấy tờ pháp lý, hỗ
            trợ sang tên trọn gói.
          </p>
        </div>

        <div class="flex items-center gap-3">
          <span
            id="carCountBadge"
            class="text-xs font-bold px-3 py-1.5 rounded-xl bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-white/10 shadow-sm">
            Đang hiển thị:
            <strong class="text-red-600 dark:text-red-400">0</strong>
            xe
          </span>
          <button
            onclick="resetAllFilters()"
            class="text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-white underline transition">
            <i class="fa-solid fa-rotate-left mr-1"></i>
            Đặt lại bộ lọc
          </button>
        </div>
      </div>

      <!-- ADVANCED FILTER & SEARCH PANEL -->
      <div class="glass-panel p-5 rounded-3xl space-y-4 shadow-xl border border-gray-200/80 dark:border-white/10">
        <!-- Top Search & Main Dropdowns -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
          <!-- Keyword Search -->
          <div class="relative lg:col-span-2">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-gray-400 text-sm"></i>
            <input
              type="text"
              id="searchInput"
              placeholder="Tìm kiếm theo tên xe, hãng xe (VD: VF3, G63, Porsche)..."
              class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:border-red-500 focus:bg-white dark:focus:bg-slate-900 transition" />
          </div>

          <!-- Brand Select -->
          <div>
            <select
              id="brandFilter"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 transition">
              <option value="">Tất cả thương hiệu</option>
            </select>
          </div>

          <!-- Price Segment Select -->
          <div>
            <select
              id="priceFilter"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 transition">
              <option value="">Tất cả phân khúc giá</option>
              <option value="under-1b">Dưới 1 Tỷ VNĐ</option>
              <option value="1b-3b">1 Tỷ - 3 Tỷ VNĐ</option>
              <option value="3b-8b">3 Tỷ - 8 Tỷ VNĐ</option>
              <option value="over-8b">Trên 8 Tỷ VNĐ (Siêu xe)</option>
            </select>
          </div>

          <!-- Fuel Type Select -->
          <div>
            <select
              id="fuelFilter"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 transition">
              <option value="">Tất cả nhiên liệu</option>
              <option value="Điện">⚡ Xe thuần điện (EV)</option>
              <option value="Xăng">⛽ Xe máy xăng</option>
              <option value="Hybrid">🔋 Xe Hybrid</option>
              <option value="Dầu">🚜 Xe máy dầu (Diesel)</option>
            </select>
          </div>
        </div>

        <!-- Quick Category Tabs & Sort -->
        <div
          class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-gray-200 dark:border-white/10 text-xs">
          <!-- Quick filter tags -->
          <div class="flex flex-wrap items-center gap-2" id="quickFilterTabs">
            <button
              onclick="setCategoryFilter('all', this)"
              class="cat-pill active px-3 py-1.5 rounded-xl font-bold bg-red-600 text-white transition">
              Tất Cả Mẫu Xe
            </button>
            <button
              onclick="setCategoryFilter('electric', this)"
              class="cat-pill px-3 py-1.5 rounded-xl font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-300 border border-gray-200 dark:border-white/10 transition">
              ⚡ Xe Thuần Điện
            </button>
            <button
              onclick="setCategoryFilter('supercar', this)"
              class="cat-pill px-3 py-1.5 rounded-xl font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-300 border border-gray-200 dark:border-white/10 transition">
              🔥 Siêu Xe Tốc Độ
            </button>
            <button
              onclick="setCategoryFilter('luxury_suv', this)"
              class="cat-pill px-3 py-1.5 rounded-xl font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-300 border border-gray-200 dark:border-white/10 transition">
              💎 Xe Sang & SUV
            </button>
          </div>

          <!-- Sort Dropdown -->
          <div class="flex items-center gap-2">
            <span class="text-gray-500 dark:text-gray-400">Sắp xếp:</span>
            <select
              id="sortFilter"
              onchange="filterCars()"
              class="px-3 py-1.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
              <option value="featured">Nổi bật nhất</option>
              <option value="asc">Giá: Thấp đến Cao</option>
              <option value="desc">Giá: Cao đến Thấp</option>
              <option value="name">Tên: A &rarr; Z</option>
            </select>
          </div>
        </div>
      </div>

      <!-- CAR INVENTORY GRID -->
      <div id="carGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
        <!-- Dynamically populated via JavaScript -->
      </div>
    </main>

    <!-- INTERACTIVE INSTALLMENT / LOAN CALCULATOR -->
    <section id="loan-calculator" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div
        class="glass-panel p-6 sm:p-10 rounded-3xl border border-gray-200 dark:border-red-500/20 relative overflow-hidden shadow-2xl">
        <!-- Ambient Glow -->
        <div
          class="absolute -right-20 -bottom-20 w-80 h-80 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="text-center max-w-2xl mx-auto mb-8">
          <span
            class="text-xs font-bold text-red-600 dark:text-red-500 tracking-widest uppercase flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-calculator"></i>
            TÀI CHÍNH THÔNG MINH
          </span>
          <h2 class="text-3xl font-black font-heading mt-1 text-slate-900 dark:text-white">
            DỰ TOÁN TRẢ GÓP XE SHOWROOM 4TL
          </h2>
          <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Chủ động tính toán số tiền trả trước và khoản thanh toán hàng tháng với gói hỗ trợ vay ưu đãi liên kết hơn
            15 ngân hàng hàng đầu.
          </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-center">
          <!-- Inputs column -->
          <div class="lg:col-span-7 space-y-6">
            <!-- Select Car or Custom Price -->
            <div>
              <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-2">
                Chọn mẫu xe cần tính hoặc nhập giá xe
              </label>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <select
                  id="calcCarSelect"
                  onchange="applyCarToCalculator()"
                  class="px-3.5 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                  <option value="">-- Chọn xe có sẵn --</option>
                </select>
                <div class="relative">
                  <input
                    type="number"
                    id="calcPriceInput"
                    value="2000000000"
                    step="50000000"
                    oninput="calculateLoan()"
                    class="w-full px-3.5 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500" />
                  <span class="absolute right-3.5 top-3 text-xs text-gray-400 font-bold">VNĐ</span>
                </div>
              </div>
            </div>

            <!-- Prepayment Percentage Slider -->
            <div class="space-y-2">
              <div class="flex justify-between items-center text-sm font-semibold">
                <span class="text-gray-700 dark:text-gray-300">Tỷ lệ trả trước:</span>
                <span class="text-red-600 dark:text-red-400 font-bold" id="calcDownPercentLabel">
                  20% (
                  <span id="calcDownAmountLabel">400.000.000 VNĐ</span>
                  )
                </span>
              </div>
              <input
                type="range"
                id="calcDownPercent"
                min="10"
                max="80"
                step="5"
                value="20"
                oninput="calculateLoan()"
                class="w-full" />
              <div class="flex justify-between text-[11px] text-gray-400">
                <span>10% (Tối thiểu)</span>
                <span>30%</span>
                <span>50%</span>
                <span>80%</span>
              </div>
            </div>

            <!-- Loan Term Slider -->
            <div class="space-y-2">
              <div class="flex justify-between items-center text-sm font-semibold">
                <span class="text-gray-700 dark:text-gray-300">Thời hạn vay:</span>
                <span class="text-red-600 dark:text-red-400 font-bold" id="calcMonthsLabel">60 tháng (5 năm)</span>
              </div>
              <input
                type="range"
                id="calcMonths"
                min="12"
                max="84"
                step="12"
                value="60"
                oninput="calculateLoan()"
                class="w-full" />
              <div class="flex justify-between text-[11px] text-gray-400">
                <span>1 năm (12T)</span>
                <span>3 năm (36T)</span>
                <span>5 năm (60T)</span>
                <span>7 năm (84T)</span>
              </div>
            </div>

            <!-- Interest Rate Slider -->
            <div class="space-y-2">
              <div class="flex justify-between items-center text-sm font-semibold">
                <span class="text-gray-700 dark:text-gray-300">Lãi suất ước tính:</span>
                <span class="text-red-600 dark:text-red-400 font-bold" id="calcInterestLabel">8.5% / năm</span>
              </div>
              <input
                type="range"
                id="calcInterest"
                min="6.5"
                max="12.0"
                step="0.1"
                value="8.5"
                oninput="calculateLoan()"
                class="w-full" />
            </div>
          </div>

          <!-- Result Dashboard Card -->
          <div
            class="lg:col-span-5 bg-gradient-to-b from-red-50 via-white to-gray-50 dark:bg-gradient-to-b dark:from-red-600/20 dark:via-slate-900 dark:to-slate-900 p-6 sm:p-8 rounded-3xl border border-red-200 dark:border-red-500/30 space-y-6 shadow-xl">
            <div class="border-b border-gray-200 dark:border-white/10 pb-4">
              <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider">
                Ước tính trả hàng tháng (Gốc + Lãi)
              </span>
              <div
                class="text-3xl sm:text-4xl font-black text-red-600 dark:text-red-500 font-heading mt-1"
                id="resMonthlyPayment">
                -- VNĐ
              </div>
              <span class="text-[11px] text-gray-400">*Tính theo phương thức dư nợ giảm dần</span>
            </div>

            <div class="space-y-3 text-sm">
              <div class="flex justify-between text-gray-600 dark:text-gray-300">
                <span>Số tiền vay ngân hàng:</span>
                <strong class="text-slate-900 dark:text-white" id="resLoanAmount">--</strong>
              </div>
              <div class="flex justify-between text-gray-600 dark:text-gray-300">
                <span>Số tiền cần trả trước:</span>
                <strong class="text-slate-900 dark:text-white" id="resDownPayment">--</strong>
              </div>
              <div class="flex justify-between text-gray-600 dark:text-gray-300">
                <span>Tiền gốc trả hàng tháng:</span>
                <strong class="text-slate-900 dark:text-white" id="resMonthlyPrincipal">--</strong>
              </div>
              <div class="flex justify-between text-gray-600 dark:text-gray-300">
                <span>Tiền lãi tháng đầu tiên:</span>
                <strong class="text-slate-900 dark:text-white" id="resMonthlyInterest">--</strong>
              </div>
            </div>

            <div class="pt-2">
              <button
                onclick="requestLoanConsult()"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-2xl text-sm transition shadow-lg shadow-red-600/30 flex items-center justify-center gap-2">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span>Nhận Bảng Tính Chi Tiết Qua Zalo</span>
              </button>
              <p class="text-[11px] text-center text-gray-400 mt-2">
                Duyệt hồ sơ nhanh chóng trong 30 phút, cam kết bảo mật thông tin.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 5-STAR SERVICES & COMMITMENTS -->
    <section id="services-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-center max-w-2xl mx-auto mb-10">
        <span
          class="text-xs font-bold text-red-600 dark:text-red-500 tracking-widest uppercase flex items-center justify-center gap-1.5">
          <i class="fa-solid fa-crown"></i>
          TIÊU CHUẨN 5 SAO
        </span>
        <h2 class="text-3xl font-black font-heading mt-1 text-slate-900 dark:text-white">
          ĐẶC QUYỀN KHI MUA XE TẠI 4TL
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
          Dịch vụ chăm sóc khách hàng toàn diện chuẩn thượng lưu mang lại sự an tâm tuyệt đối.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Service 1 -->
        <div
          class="glass-card p-6 rounded-3xl space-y-3 bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md">
          <div
            class="w-12 h-12 rounded-2xl bg-red-600/10 border border-red-500/20 text-red-600 dark:text-red-500 flex items-center justify-center text-xl">
            <i class="fa-solid fa-clipboard-check"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 dark:text-white">Kiểm Định 160 Điểm</h3>
          <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
            Cam kết văn bản: KHÔNG đâm đụng, KHÔNG ngập nước, máy móc & khung gầm nguyên bản 100%. Cho phép khách hàng
            check hãng toàn quốc.
          </p>
        </div>

        <!-- Service 2 -->
        <div
          class="glass-card p-6 rounded-3xl space-y-3 bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md">
          <div
            class="w-12 h-12 rounded-2xl bg-red-600/10 border border-red-500/20 text-red-600 dark:text-red-500 flex items-center justify-center text-xl">
            <i class="fa-solid fa-truck-ramp-box"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 dark:text-white">Giao Xe Tận Nhà VIP</h3>
          <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
            Đội ngũ xe lồng kín chuyên dụng sẵn sàng giao xe tại cửa nhà khách hàng trên 63 tỉnh thành, tổ chức lễ bàn
            giao hoa & rượu vang trang trọng.
          </p>
        </div>

        <!-- Service 3 -->
        <div
          class="glass-card p-6 rounded-3xl space-y-3 bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md">
          <div
            class="w-12 h-12 rounded-2xl bg-red-600/10 border border-red-500/20 text-red-600 dark:text-red-500 flex items-center justify-center text-xl">
            <i class="fa-solid fa-repeat"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 dark:text-white">Thu Cũ Đổi Mới (Trade-in)</h3>
          <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
            Định giá xe cũ minh bạch và sát giá thị trường nhất. Hỗ trợ khách hàng nâng cấp lên đời siêu xe, xe sang với
            thủ tục chỉ trong 1 ngày.
          </p>
        </div>

        <!-- Service 4 -->
        <div
          class="glass-card p-6 rounded-3xl space-y-3 bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md">
          <div
            class="w-12 h-12 rounded-2xl bg-red-600/10 border border-red-500/20 text-red-600 dark:text-red-500 flex items-center justify-center text-xl">
            <i class="fa-solid fa-screwdriver-wrench"></i>
          </div>
          <h3 class="text-lg font-bold text-slate-900 dark:text-white">Bảo Hành & Spa Chuyên Sâu</h3>
          <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
            Xưởng dịch vụ đạt chuẩn châu Âu, cung cấp gói bảo hành 3 năm, tặng dịch vụ detailing phủ bóng cao cấp và cứu
            hộ miễn phí 24/7.
          </p>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS / KHÁCH HÀNG TIÊU BIỂU -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-center max-w-2xl mx-auto mb-10">
        <span
          class="text-xs font-bold text-red-600 dark:text-red-500 tracking-widest uppercase flex items-center justify-center gap-1.5">
          <i class="fa-solid fa-star text-yellow-400"></i>
          KHÁCH HÀNG NÓI GÌ
        </span>
        <h2 class="text-3xl font-black font-heading mt-1 text-slate-900 dark:text-white">
          SỰ HÀI LÒNG CỦA CÁC CHỦ NHÂN SIÊU XE
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Review 1 -->
        <div
          class="glass-card p-6 rounded-3xl space-y-4 bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md">
          <div class="flex text-yellow-400 text-xs gap-1">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p class="text-xs text-slate-700 dark:text-gray-300 leading-relaxed italic">
            "Tôi vừa nhận chiếc Porsche 911 Carrera S tại Showroom 4TL. Dịch vụ bàn giao xe cực kỳ trang trọng và chuyên
            nghiệp. Thủ tục giấy tờ chỉ mất đúng 2 ngày là có biển số đẹp!"
          </p>
          <div class="flex items-center gap-3 pt-2 border-t border-gray-200 dark:border-white/10">
            <img
              src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100"
              class="w-10 h-10 rounded-full object-cover border border-red-500" />
            <div>
              <h4 class="text-sm font-bold text-slate-900 dark:text-white">Anh Hoàng Nam</h4>
              <span class="text-[11px] text-gray-500 dark:text-gray-400">Chủ nhân Porsche 911 (Quận 2, TP.HCM)</span>
            </div>
          </div>
        </div>

        <!-- Review 2 -->
        <div
          class="glass-card p-6 rounded-3xl space-y-4 bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md">
          <div class="flex text-yellow-400 text-xs gap-1">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p class="text-xs text-slate-700 dark:text-gray-300 leading-relaxed italic">
            "Mua xe VinFast VF3 giao ngay không cần chờ đợi. Các bạn nhân viên tư vấn rất nhiệt tình, hỗ trợ gói sạc và
            giao xe tận nhà tại Vũng Tàu. Rất hài lòng với Showroom 4TL!"
          </p>
          <div class="flex items-center gap-3 pt-2 border-t border-gray-200 dark:border-white/10">
            <img
              src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100"
              class="w-10 h-10 rounded-full object-cover border border-red-500" />
            <div>
              <h4 class="text-sm font-bold text-slate-900 dark:text-white">Chị Mai Phương</h4>
              <span class="text-[11px] text-gray-500 dark:text-gray-400">Chủ nhân VinFast VF3 (Bà Rịa - Vũng Tàu)</span>
            </div>
          </div>
        </div>

        <!-- Review 3 -->
        <div
          class="glass-card p-6 rounded-3xl space-y-4 bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md">
          <div class="flex text-yellow-400 text-xs gap-1">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p class="text-xs text-slate-700 dark:text-gray-300 leading-relaxed italic">
            "G63 AMG mua ở đây chất lượng đúng như cam kết. Hồ sơ trả góp ngân hàng duyệt chỉ trong 1 buổi chiều. Xưởng
            bảo dưỡng chăm sóc xe sạch sẽ và cẩn thận từng chi tiết."
          </p>
          <div class="flex items-center gap-3 pt-2 border-t border-gray-200 dark:border-white/10">
            <img
              src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100"
              class="w-10 h-10 rounded-full object-cover border border-red-500" />
            <div>
              <h4 class="text-sm font-bold text-slate-900 dark:text-white">Anh Quốc Bảo</h4>
              <span class="text-[11px] text-gray-500 dark:text-gray-400">Doanh nhân Bất Động Sản (Quận 7)</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SHOWROOM LOCATION & TEST DRIVE BOOKING -->
    <section id="map-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="glass-panel p-6 sm:p-10 rounded-3xl border border-gray-200 dark:border-white/10 shadow-2xl">
        <div class="grid lg:grid-cols-12 gap-8 items-center">
          <!-- Left Details & Booking Form -->
          <div class="lg:col-span-5 space-y-6">
            <div>
              <span
                class="text-xs font-bold text-red-600 dark:text-red-500 tracking-widest uppercase flex items-center gap-1.5">
                <i class="fa-solid fa-location-dot"></i>
                ĐIỂM HẸN ĐẲNG CẤP
              </span>
              <h3 class="text-2xl sm:text-3xl font-black font-heading mt-1 text-slate-900 dark:text-white">
                SHOWROOM 4TL SÀI GÒN
              </h3>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                Không gian trưng bày đạt tiêu chuẩn đại lý siêu xe quốc tế. Kính mời quý khách đến thưởng thức cà phê
                thượng hạng và trải nghiệm trực tiếp.
              </p>
            </div>

            <!-- Contact Details -->
            <div class="space-y-3 text-xs text-slate-700 dark:text-gray-300">
              <div class="flex items-start gap-3">
                <i class="fa-solid fa-map-pin text-red-600 dark:text-red-500 mt-1"></i>
                <span>99 Nguyễn Lương Bằng, Phường Tân Phú, Quận 7, TP. Hồ Chí Minh</span>
              </div>
              <div class="flex items-center gap-3">
                <i class="fa-solid fa-clock text-red-600 dark:text-red-500"></i>
                <span>Giờ mở cửa: 08:00 - 20:30 (Tất cả các ngày trong tuần)</span>
              </div>
              <div class="flex items-center gap-3">
                <i class="fa-solid fa-phone text-red-600 dark:text-red-500"></i>
                <span>
                  Hotline Bán Hàng:
                  <strong class="text-slate-900 dark:text-white">0706.850.014</strong>
                </span>
              </div>
              <div class="flex items-center gap-3">
                <i class="fa-solid fa-envelope text-red-600 dark:text-red-500"></i>
                <span>Email: contact@showroom4tl.vn</span>
              </div>
            </div>

            <!-- Quick Test Drive Form -->
            <div
              class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-gray-200 dark:border-white/10 space-y-3">
              <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">
                Đăng Ký Lái Thử / Đặt Lịch Xem Xe
              </h4>
              <form onsubmit="handleTestDriveSubmit(event)" class="space-y-2">
                <input
                  type="text"
                  id="driveName"
                  placeholder="Họ và tên của bạn"
                  required
                  class="w-full px-3 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
                <input
                  type="tel"
                  id="drivePhone"
                  placeholder="Số điện thoại liên hệ"
                  required
                  class="w-full px-3 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
                <select
                  id="driveCar"
                  class="w-full px-3 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-red-500">
                  <option value="Chưa chọn xe">Chọn mẫu xe quan tâm</option>
                </select>
                <button
                  type="submit"
                  class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl text-xs transition">
                  Xác Nhận Đặt Lịch Hẹn
                </button>
              </form>
            </div>
          </div>

          <!-- Right Google Maps -->
          <div
            class="lg:col-span-7 h-96 lg:h-[450px] rounded-2xl overflow-hidden border border-gray-200 dark:border-white/10 shadow-inner">
            <iframe
              class="w-full h-full"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3920.023447957643!2d106.71694297590856!3d10.732662959223783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f97463f1e9d%3A0x8ad94d210ff4dd89!2zOTkgTmd1eeG7gW4gTMawxqFuZyBC4bqxbmcsIFTDom4gUGjDuiwgIFF14bqtbiA3LCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s"
              allowfullscreen=""
              loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer
      class="bg-gray-900 dark:bg-slate-950 border-t border-gray-800 dark:border-white/10 pt-16 pb-8 text-gray-400 text-xs">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
          <!-- Col 1: Bio -->
          <div class="lg:col-span-2 space-y-4">
            <a href="index.html" class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-xl bg-red-600 flex items-center justify-center text-white font-bold">
                <i class="fa-solid fa-shield-halved"></i>
              </div>
              <span class="text-xl font-black text-white font-heading tracking-wider">SHOWROOM 4TL</span>
            </a>
            <p class="text-xs leading-relaxed max-w-sm text-gray-400">
              Đại lý độc lập phân phối các dòng siêu xe thể thao, SUV cao cấp và xe điện hàng đầu tại Việt Nam. Cam kết
              chất lượng chuẩn quốc tế, nâng tầm phong cách sống thượng lưu.
            </p>
            <div class="flex items-center gap-3 pt-2">
              <a
                href="#"
                class="w-8 h-8 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center hover:text-red-400 hover:border-red-500 transition">
                <i class="fa-brands fa-facebook-f"></i>
              </a>
              <a
                href="#"
                class="w-8 h-8 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center hover:text-red-400 hover:border-red-500 transition">
                <i class="fa-brands fa-youtube"></i>
              </a>
              <a
                href="#"
                class="w-8 h-8 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center hover:text-red-400 hover:border-red-500 transition">
                <i class="fa-brands fa-tiktok"></i>
              </a>
              <a
                href="#"
                class="w-8 h-8 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center hover:text-red-400 hover:border-red-500 transition">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Col 2: Dòng xe -->
          <div class="space-y-3">
            <h4 class="text-white font-bold uppercase text-xs tracking-wider">Dòng Xe Bán Chạy</h4>
            <ul class="space-y-2">
              <li>
                <a href="#car-section" onclick="filterByBrandQuick('Porsche')" class="hover:text-red-400 transition">
                  Porsche 911 Series
                </a>
              </li>
              <li>
                <a
                  href="#car-section"
                  onclick="filterByBrandQuick('Mercedes-Benz')"
                  class="hover:text-red-400 transition">
                  Mercedes-AMG G63
                </a>
              </li>
              <li>
                <a href="#car-section" onclick="filterByBrandQuick('VinFast')" class="hover:text-red-400 transition">
                  VinFast VF3 & VF8
                </a>
              </li>
              <li>
                <a href="#car-section" onclick="filterByBrandQuick('Ferrari')" class="hover:text-red-400 transition">
                  Ferrari F8 Tributo
                </a>
              </li>
              <li>
                <a href="#car-section" onclick="filterByBrandQuick('BMW')" class="hover:text-red-400 transition">
                  BMW 7-Series
                </a>
              </li>
            </ul>
          </div>

          <!-- Col 3: Dịch vụ -->
          <div class="space-y-3">
            <h4 class="text-white font-bold uppercase text-xs tracking-wider">Dịch Vụ Khách Hàng</h4>
            <ul class="space-y-2">
              <li><a href="#loan-calculator" class="hover:text-red-400 transition">Dự toán trả góp ngân hàng</a></li>
              <li>
                <a href="#services-section" class="hover:text-red-400 transition">Kiểm định 160 bước chính hãng</a>
              </li>
              <li><a href="#map-section" class="hover:text-red-400 transition">Đặt hẹn lái thử tận nơi</a></li>
              <li>
                <a
                  href="#"
                  onclick="alert('Hotline cứu hộ khẩn cấp: 1900.8888 (24/7)')"
                  class="hover:text-red-400 transition">
                  Cứu hộ xe 24/7 toàn quốc
                </a>
              </li>
              <li><a href="admin.html" class="hover:text-yellow-400 transition">Cổng quản trị nội bộ</a></li>
            </ul>
          </div>

          <!-- Col 4: Pháp lý -->
          <div class="space-y-3">
            <h4 class="text-white font-bold uppercase text-xs tracking-wider">Chính Sách & Hỗ Trợ</h4>
            <ul class="space-y-2">
              <li><a href="#" class="hover:text-red-400 transition">Chính sách bảo hành 3 năm</a></li>
              <li><a href="#" class="hover:text-red-400 transition">Cam kết hoàn tiền 100%</a></li>
              <li><a href="#" class="hover:text-red-400 transition">Chính sách bảo mật khách hàng</a></li>
              <li><a href="#" class="hover:text-red-400 transition">Quy trình đặt cọc giữ xe</a></li>
            </ul>
          </div>
        </div>

        <!-- Bottom Copyright -->
        <div
          class="pt-8 border-t border-gray-800 dark:border-white/10 flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left text-gray-500">
          <p>© 2026 SHOWROOM 4TL. Bản quyền phát triển bởi Sinh viên ĐH Văn Lang.</p>
          <div class="flex gap-4">
            <span>Đẳng Cấp • Minh Bạch • Tận Tâm</span>
          </div>
        </div>
      </div>
    </footer>

    <!-- STICKY COMPARISON DOCK (Appears when >= 1 car is selected) -->
    <div
      id="comparisonDock"
      class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-red-500/40 px-5 py-3 rounded-2xl shadow-2xl items-center gap-4 hidden transition-all duration-300"
      style="display: none">
      <div class="flex items-center gap-2" id="compareThumbnails">
        <!-- Selected cars thumbnails -->
      </div>
      <div class="h-6 w-px bg-gray-300 dark:bg-white/20"></div>
      <button
        onclick="openCompareModal()"
        class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-xl text-xs shadow-md transition flex items-center gap-1.5">
        <i class="fa-solid fa-code-compare"></i>
        <span>
          So Sánh Ngay (
          <span id="compareCount">0</span>
          /3)
        </span>
      </button>
      <button
        onclick="clearComparison()"
        title="Xóa tất cả"
        class="text-gray-400 hover:text-red-600 dark:hover:text-white text-xs">
        ✕
      </button>
    </div>

    <!-- MODAL 1: CHI TIẾT XE -->
    <div
      id="detailModal"
      class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 items-center justify-center p-4 overflow-y-auto hidden"
      style="display: none">
      <div
        class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-3xl max-w-3xl w-full p-6 sm:p-8 relative shadow-2xl border border-gray-200 dark:border-white/15 max-h-[90vh] overflow-y-auto space-y-6">
        <button
          onclick="closeModal('detailModal')"
          class="absolute top-5 right-5 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition">
          ✕
        </button>
        <div id="modalContent"></div>
      </div>
    </div>

    <!-- MODAL 2: MÃ QR ĐẶT CỌC (VietQR Style) -->
    <div
      id="qrModal"
      class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 items-center justify-center p-4 hidden"
      style="display: none">
      <div
        class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-3xl max-w-sm w-full p-6 text-center relative shadow-2xl border border-gray-200 dark:border-red-500/30 space-y-4">
        <button
          onclick="closeModal('qrModal')"
          class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition">
          ✕
        </button>

        <div
          class="w-12 h-12 rounded-full bg-red-600/10 dark:bg-red-600/20 text-red-600 dark:text-red-500 mx-auto flex items-center justify-center text-xl">
          <i class="fa-solid fa-qrcode"></i>
        </div>

        <h3 class="text-lg font-black uppercase text-slate-900 dark:text-white font-heading">
          QUÉT MÃ QR ĐẶT CỌC GIỮ XE
        </h3>
        <p class="text-xs text-gray-500 dark:text-gray-300" id="qrCarName">Thanh toán cọc giữ xe tại Showroom 4TL</p>

        <div class="bg-white p-3 rounded-2xl inline-block shadow-lg border border-gray-200">
          <img
            id="qrImage"
            src="images/qrcode.jpg"
            alt="Mã QR Đặt Cọc Showroom 4TL"
            class="w-48 h-48 mx-auto object-contain" />
        </div>

        <div
          class="bg-gray-100 dark:bg-slate-800 p-3 rounded-xl text-left text-xs space-y-1 text-slate-700 dark:text-gray-300 border border-gray-200 dark:border-white/10">
          <div class="flex justify-between">
            <span>Ngân hàng:</span>
            <strong class="text-slate-900 dark:text-white">MB Bank (Quân Đội)</strong>
          </div>
          <div class="flex justify-between">
            <span>Số tài khoản:</span>
            <strong class="text-red-600 dark:text-red-400 font-mono tracking-wider">0706850014</strong>
          </div>
          <div class="flex justify-between">
            <span>Chủ TK:</span>
            <strong class="text-slate-900 dark:text-white">SHOWROOM 4TL AUTO</strong>
          </div>
          <div class="flex justify-between">
            <span>Nội dung CK:</span>
            <strong class="text-amber-600 dark:text-yellow-400 font-mono" id="qrMemo">COC XE 4TL</strong>
          </div>
        </div>

        <div class="space-y-2 text-left">
          <input
            type="text"
            id="qrCustomerName"
            placeholder="Họ tên người chuyển khoản *"
            class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          <input
            type="tel"
            id="qrCustomerPhone"
            placeholder="Số điện thoại xác nhận *"
            class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
        </div>

        <button
          onclick="confirmDepositSuccess()"
          class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-md shadow-red-600/30">
          <i class="fa-solid fa-circle-check mr-1.5"></i>
          Tôi Đã Hoàn Tất Chuyển Khoản
        </button>
      </div>
    </div>

    <!-- MODAL 3: SO SÁNH XE ĐỐI ĐẦU -->
    <div
      id="compareModal"
      class="fixed inset-0 bg-black/85 backdrop-blur-md z-50 items-center justify-center p-4 overflow-y-auto hidden"
      style="display: none">
      <div
        class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-3xl max-w-5xl w-full p-6 sm:p-8 relative shadow-2xl border border-gray-200 dark:border-white/15 max-h-[90vh] overflow-y-auto space-y-6">
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-white/10 pb-4">
          <div>
            <h3 class="text-2xl font-black font-heading text-slate-900 dark:text-white">SO SÁNH THÔNG SỐ XE ĐỐI ĐẦU</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">
              Xem trực quan thông số, phân khúc và mức giá giữa các mẫu xe bạn đang phân vân.
            </p>
          </div>
          <button
            onclick="closeModal('compareModal')"
            class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition">
            ✕
          </button>
        </div>

        <div id="compareTableContainer" class="overflow-x-auto">
          <!-- Injected via JavaScript -->
        </div>
      </div>
    </div>

    <!-- MODAL 4: ĐĂNG KÝ LÁI THỬ / XEM XE -->
    <div
      id="bookingModal"
      class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 items-center justify-center p-4 hidden"
      style="display: none">
      <div
        class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-3xl max-w-md w-full p-6 relative shadow-2xl border border-gray-200 dark:border-white/15 space-y-4">
        <button
          onclick="closeModal('bookingModal')"
          class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition">
          ✕
        </button>
        <h3 class="text-xl font-black font-heading text-slate-900 dark:text-white">ĐĂNG KÝ TRẢI NGHIỆM LÁI THỬ</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400">
          Đội ngũ Showroom 4TL sẽ mang xe đến tận nhà quý khách hoặc chuẩn bị xe sẵn tại showroom.
        </p>

        <form onsubmit="handleModalBooking(event)" class="space-y-3 text-xs">
          <div>
            <label class="block text-gray-600 dark:text-gray-400 mb-1">Mẫu xe chọn lái thử</label>
            <input
              type="text"
              id="modalBookingCar"
              readonly
              class="w-full px-3.5 py-2.5 bg-gray-100 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white font-bold" />
          </div>
          <div>
            <label class="block text-gray-600 dark:text-gray-400 mb-1">Họ và tên của quý khách</label>
            <input
              type="text"
              id="modalBookingName"
              required
              placeholder="Nguyễn Văn A"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>
          <div>
            <label class="block text-gray-600 dark:text-gray-400 mb-1">Số điện thoại liên hệ</label>
            <input
              type="tel"
              id="modalBookingPhone"
              required
              placeholder="0900.xxx.xxx"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>
          <div>
            <label class="block text-gray-600 dark:text-gray-400 mb-1">Thời gian dự kiến</label>
            <input
              type="date"
              id="modalBookingDate"
              required
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>
          <button
            type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-lg shadow-red-600/30">
            Xác Nhận Đăng Ký Lái Thử
          </button>
        </form>
      </div>
    </div>

    <!-- LUXURY FLOATING AI CHATBOT WIDGET -->
    <div class="fixed bottom-6 right-6 z-50">
      <!-- Chat Bubble Button -->
      <button
        id="chatBubbleBtn"
        onclick="toggleChat()"
        type="button"
        aria-label="Mở Trợ lý AI 4TL"
        class="relative pulse-ring w-14 h-14 bg-gradient-to-tr from-red-600 to-red-500 text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition duration-300 group cursor-pointer">
        <i id="chatBubbleIcon" class="fa-solid fa-headset text-2xl group-hover:rotate-12 transition"></i>
        <span
          class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white dark:border-slate-900 rounded-full shadow-sm"></span>
      </button>

      <!-- Chat Window -->
      <div
        id="chatWindow"
        class="hidden absolute bottom-20 right-0 w-[calc(100vw-3rem)] sm:w-96 max-h-[calc(100vh-120px)] bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border border-gray-200 dark:border-white/15 rounded-3xl shadow-2xl overflow-hidden flex flex-col h-[520px] transition-all origin-bottom-right"
        style="display: none">
        <!-- Chat Header -->
        <div
          class="bg-gradient-to-r from-red-700 to-red-600 p-4 text-white flex justify-between items-center shadow-sm">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-white shadow-inner">
              <i class="fa-solid fa-robot"></i>
            </div>
            <div>
              <h4 class="text-sm font-bold leading-tight">4TL AI Assistant</h4>
              <span class="text-[10px] text-red-200 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Trực tuyến 24/7
              </span>
            </div>
          </div>
          <div class="flex items-center gap-1.5">
            <a
              href="ai_chat.html"
              target="_blank"
              title="Mở trang tư vấn AI toàn màn hình"
              class="w-7 h-7 rounded-full bg-black/20 text-white hover:bg-black/40 flex items-center justify-center text-xs transition">
              <i class="fa-solid fa-up-right-from-square text-[10px]"></i>
            </a>
            <button
              onclick="toggleChat()"
              type="button"
              title="Đóng chat"
              class="w-7 h-7 rounded-full bg-black/20 text-white hover:bg-black/40 flex items-center justify-center text-xs transition">
              ✕
            </button>
          </div>
        </div>

        <!-- Chat Suggestions -->
        <div
          class="p-2.5 bg-gray-100/80 dark:bg-slate-950/60 border-b border-gray-200 dark:border-white/10 flex gap-1.5 overflow-x-auto text-[11px] whitespace-nowrap">
          <button
            onclick="quickPrompt('Giá xe VinFast VF3?')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-red-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            ⚡ Giá VF3
          </button>
          <button
            onclick="quickPrompt('Tư vấn xe dưới 2 tỷ')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-red-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            💰 Dưới 2 tỷ
          </button>
          <button
            onclick="quickPrompt('Tư vấn thủ tục trả góp')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-red-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            💳 Trả góp
          </button>
          <button
            onclick="quickPrompt('Đăng ký lái thử xe')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-red-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            🏎️ Lái thử
          </button>
        </div>

        <!-- Chat Messages Box -->
        <div id="chatBox" class="flex-1 p-4 overflow-y-auto space-y-3 text-xs">
          <div
            class="bg-gray-100 dark:bg-slate-800 text-gray-800 dark:text-gray-200 p-3.5 rounded-2xl rounded-tl-none max-w-[85%] self-start border border-gray-200 dark:border-white/10 shadow-sm leading-relaxed">
            👋 Xin kính chào quý khách! Em là Trợ lý AI Showroom 4TL. Em có thể hỗ trợ quý khách tra cứu thông số kỹ
            thuật, bảng giá lăn bánh, chính sách trả góp hay lịch lái thử hôm nay ạ?
          </div>
        </div>

        <!-- Chat Input Form -->
        <div class="p-3 bg-gray-50 dark:bg-slate-950 border-t border-gray-200 dark:border-white/10 flex gap-2">
          <input
            type="text"
            id="chatInput"
            onkeydown="if (event.key === 'Enter') sendChatMessage();"
            placeholder="Nhập câu hỏi (VD: giá C300, VF3, G63)..."
            class="flex-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-white/10 px-3.5 py-2.5 rounded-xl text-xs text-gray-900 dark:text-white focus:outline-none focus:border-red-500" />
          <button
            onclick="sendChatMessage()"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-xl font-bold text-xs transition">
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- JAVASCRIPT LOGIC & ENGINE -->
    <script>
      // Fallback Database Cars (20 siêu phẩm đảm bảo website hiển thị đẹp ngay cả khi không có kết nối MySQL)
      const fallbackCars = [
        {
          id: 1,
          name: "Ferrari F8 Tributo",
          brand: "Ferrari",
          price: 19000000000,
          image: "https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800",
          engine: "3.9L V8 Twin-Turbo (710 HP)",
          transmission: "Tự động 7 cấp ly hợp kép",
          fuel: "Xăng",
          description:
            "Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm Ý. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h.",
        },
        {
          id: 2,
          name: "Lamborghini Urus S",
          brand: "Lamborghini",
          price: 16500000000,
          image: "https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800",
          engine: "4.0L V8 Twin-Turbo (666 HP)",
          transmission: "Tự động 8 cấp thể thao",
          fuel: "Xăng",
          description:
            "Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Thiết kế góc cạnh đậm chất chiến đấu của hãng xe bò tót Sant'Agata Bolognese.",
        },
        {
          id: 3,
          name: "Mercedes-AMG G63",
          brand: "Mercedes-Benz",
          price: 11750000000,
          image: "https://images.unsplash.com/photo-1520050206274-a1ae44613e6d?w=800",
          engine: "4.0L V8 Bi-Turbo (585 HP)",
          transmission: "Tự động 9 cấp AMG Speedshift",
          fuel: "Xăng",
          description:
            "Mẫu SUV địa hình hạng sang đẳng cấp biểu tượng hoàng gia. Hệ dẫn động 4 bánh toàn thời gian 4MATIC với 3 khóa vi sai độc lập.",
        },
        {
          id: 4,
          name: "Porsche 911 Carrera S",
          brand: "Porsche",
          price: 8500000000,
          image: "https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800",
          engine: "3.0L Boxer Twin-Turbo (450 HP)",
          transmission: "Tự động 8 cấp PDK",
          fuel: "Xăng",
          description:
            "Mẫu xe thể thao huyền thoại mang lại cảm giác lái đỉnh cao, thiết kế timeless vượt thời gian đi cùng gói thể thao Sport Chrono Package.",
        },
        {
          id: 5,
          name: "BMW 740i Pure Excellence",
          brand: "BMW",
          price: 4699000000,
          image: "https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800",
          engine: "3.0L I6 TwinPower (381 HP)",
          transmission: "Tự động 8 cấp Steptronic",
          fuel: "Xăng Mild-Hybrid",
          description:
            "Sedan hạng sang cao cấp đầy công nghệ của BMW với màn hình Theatre Screen 31.3 inch chuẩn 8K cùng hệ thống âm thanh vòm Bowers & Wilkins Diamond.",
        },
        {
          id: 6,
          name: "Lexus RX350 Luxury",
          brand: "Lexus",
          price: 4330000000,
          image: "https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800",
          engine: "2.4L Turbo T24A-FTS (275 HP)",
          transmission: "Tự động 8 cấp Direct Shift",
          fuel: "Xăng",
          description:
            "Mẫu SUV xe sang Nhật Bản êm ái, cách âm tĩnh lặng đỉnh cao, nội thất da Semi-Aniline cao cấp và hệ thống an toàn Lexus Safety System+ 3.0.",
        },
        {
          id: 7,
          name: "Audi Q7 45 TFSI quattro",
          brand: "Audi",
          price: 3700000000,
          image: "https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800",
          engine: "2.0L Turbo Mild-Hybrid (252 HP)",
          transmission: "Tự động 8 cấp Tiptronic",
          fuel: "Xăng Mild-Hybrid",
          description:
            "SUV hạng sang 7 chỗ cỡ lớn dẫn động 4 bánh toàn thời gian quattro danh tiếng, đèn Matrix LED thông minh và buồng lái ảo Audi Virtual Cockpit.",
        },
        {
          id: 8,
          name: "Mercedes-Benz C-Class C300 AMG",
          brand: "Mercedes-Benz",
          price: 2099000000,
          image: "https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800",
          engine: "2.0L Turbo EQ Boost (258 HP)",
          transmission: "Tự động 9 cấp 9G-TRONIC",
          fuel: "Xăng Mild-Hybrid",
          description:
            "Tiểu S-Class với thiết kế thể thao AMG Line, màn hình giải trí trung tâm 11.9 inch định dạng dọc, đèn Digital Light tối tân nhất.",
        },
        {
          id: 9,
          name: "Kia Carnival 2.2D Signature",
          brand: "Kia",
          price: 1759000000,
          image: "https://images.unsplash.com/photo-1563720223185-11003d516935?w=800",
          engine: "2.2L Smartstream D2.2 (199 HP)",
          transmission: "Tự động 8 cấp",
          fuel: "Dầu (Diesel)",
          description:
            "Chuyên cơ mặt đất MPV 7 chỗ thương gia siêu tiện nghi, hàng ghế thứ 2 sưởi/làm mát và chế độ thư giãn không trọng lực VIP.",
        },
        {
          id: 10,
          name: "Ford Everest Titanium+ 4x4",
          brand: "Ford",
          price: 1468000000,
          image: "https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800",
          engine: "2.0L Bi-Turbo Diesel (210 HP)",
          transmission: "Tự động 10 cấp điện tử",
          fuel: "Dầu (Diesel)",
          description:
            "SUV 7 chỗ thực thụ đậm chất cơ bắp Mỹ, khả năng lội nước 800mm, camera 360 độ và công nghệ đỗ xe tự động 2.0.",
        },
        {
          id: 11,
          name: "Toyota Camry 2.5Q",
          brand: "Toyota",
          price: 1405000000,
          image: "https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800",
          engine: "2.5L Dynamic Force (207 HP)",
          transmission: "Tự động 8 cấp Direct Shift",
          fuel: "Xăng",
          description:
            "Mẫu sedan hạng D chuẩn mực của sự thành đạt, bền bỉ, êm ái bậc nhất phân khúc với gói an toàn Toyota Safety Sense 2.0.",
        },
        {
          id: 12,
          name: "Ford Ranger Raptor 3.0 V6",
          brand: "Ford",
          price: 1299000000,
          image: "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800",
          engine: "3.0L V6 EcoBoost Twin-Turbo (392 HP)",
          transmission: "Tự động 10 cấp",
          fuel: "Xăng",
          description:
            "Vua bán tải hiệu năng cao, trang bị bộ giảm xóc FOX 2.5 inch Live Valve thích ứng theo thời gian thực và chế độ lái sa mạc Baja Mode.",
        },
        {
          id: 13,
          name: "VinFast VF8 Plus",
          brand: "VinFast",
          price: 1270000000,
          image: "https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800",
          engine: "2 Động cơ điện (402 HP - AWD)",
          transmission: "Tự động đơn cấp",
          fuel: "Điện",
          description:
            "SUV điện thông minh phân khúc D, thiết kế Pininfarina đỉnh cao, tăng tốc 0-100 km/h trong 5.5 giây và trợ lái thông minh ADAS cấp độ 2.",
        },
        {
          id: 14,
          name: "Honda CR-V e:HEV RS",
          brand: "Honda",
          price: 1259000000,
          image: "https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=800",
          engine: "2.0L Hybrid Xăng + Điện (204 HP)",
          transmission: "E-CVT thể thao",
          fuel: "Xăng Hybrid",
          description:
            "SUV thể thao thế hệ mới nhập khẩu nguyên chiếc, tiết kiệm nhiên liệu chỉ 3.4L/100km đô thị, gói an toàn Honda SENSING đầy đủ.",
        },
        {
          id: 15,
          name: "Hyundai Tucson 2.0 Diesel",
          brand: "Hyundai",
          price: 959000000,
          image: "https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800",
          engine: "2.0L Smartstream D2.0 (186 HP)",
          transmission: "Tự động 8 cấp số nút bấm",
          fuel: "Dầu (Diesel)",
          description:
            "Crossover thiết kế tương lai Parametric Jewel, nội thất mở dạng phi thuyền, máy dầu bốc và tiết kiệm bậc nhất.",
        },
        {
          id: 16,
          name: "Toyota Corolla Cross 1.8HEV",
          brand: "Toyota",
          price: 905000000,
          image: "https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800",
          engine: "1.8L Hybrid Xăng + Điện (122 HP)",
          transmission: "Vô cấp e-CVT",
          fuel: "Xăng Hybrid",
          description:
            "Mẫu Urban SUV tiết kiệm nhiên liệu tối ưu với động cơ Hybrid tiên tiến, khung gầm TNGA vững chắc và vận hành êm ái nhẹ nhàng.",
        },
        {
          id: 17,
          name: "Mazda CX-5 2.0 Premium",
          brand: "Mazda",
          price: 829000000,
          image: "https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=800",
          engine: "2.0L SkyActiv-G (154 HP)",
          transmission: "Tự động 6 cấp",
          fuel: "Xăng",
          description:
            "Mẫu Crossover bán chạy nhất phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế, 10 loa Bose cao cấp và hệ thống an toàn i-Activsense.",
        },
        {
          id: 18,
          name: "Hyundai Accent 1.5 AT",
          brand: "Hyundai",
          price: 489000000,
          image: "https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800",
          engine: "1.5L Smartstream G (115 HP)",
          transmission: "Vô cấp thông minh iVT",
          fuel: "Xăng",
          description:
            "Sedan hạng B thế hệ hoàn toàn mới, kích thước lớn nhất phân khúc, trang bị gói SmartSense vượt tầm giá.",
        },
        {
          id: 19,
          name: "VinFast VF5 Plus",
          brand: "VinFast",
          price: 468000000,
          image: "https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800",
          engine: "Động cơ điện (134 HP - 135 Nm)",
          transmission: "Tự động đơn cấp",
          fuel: "Điện",
          description:
            "A-SUV thuần điện quốc dân nhỏ gọn, chi phí vận hành siêu rẻ chỉ bằng 1/3 xe xăng, thời trang và linh hoạt trong đô thị.",
        },
        {
          id: 20,
          name: "VinFast VF3",
          brand: "VinFast",
          price: 240000000,
          image: "https://vinfastquan12.com.vn/wp-content/uploads/2025/02/VinFast_VF3_Mau_trang.webp",
          engine: "Động cơ điện đơn (43 HP)",
          transmission: "Tự động",
          fuel: "Điện",
          description:
            "Cơn sốt xe điện mini tại Việt Nam! Kiểu dáng hình hộp cá tính, gầm cao 191mm vượt địa hình ngập nước, Best Seller tại Showroom 4TL.",
        },
      ];

      let allCars = [];
      let comparedCars = [];
      let currentCategory = "all";

      // MODAL MANAGEMENT HELPER (100% immune to CSS class cascade quirks)
      function openModal(modalId) {
        const el = document.getElementById(modalId);
        if (!el) return;
        el.classList.remove("hidden");
        el.style.display = "flex";
        document.body.style.overflow = "hidden";
      }

      function closeModal(modalId) {
        const el = document.getElementById(modalId);
        if (!el) return;
        el.classList.add("hidden");
        el.style.display = "none";
        document.body.style.overflow = "";
      }

      // Close on backdrop click & ESC key
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          ["detailModal", "compareModal", "qrModal", "bookingModal"].forEach(closeModal);
          const chatWin = document.getElementById("chatWindow");
          if (chatWin && (chatWin.style.display === "flex" || !chatWin.classList.contains("hidden"))) {
            toggleChat();
          }
        }
      });

      ["detailModal", "compareModal", "qrModal", "bookingModal"].forEach((id) => {
        const el = document.getElementById(id);
        if (el) {
          el.addEventListener("click", function (e) {
            if (e.target === el) closeModal(id);
          });
        }
      });

      // DARK / LIGHT THEME CONTROLLER
      const themeToggle = document.getElementById("themeToggle");
      const themeIcon = document.getElementById("themeIcon");

      function setTheme(mode) {
        if (mode === "light") {
          document.documentElement.classList.remove("dark");
          document.documentElement.classList.add("light");
          localStorage.setItem("theme", "light");
          if (themeIcon) {
            themeIcon.className = "fa-solid fa-moon text-slate-700 text-base";
          }
          if (themeToggle) {
            themeToggle.title = "Chuyển sang chế độ Tối (Dark Mode)";
          }
        } else {
          document.documentElement.classList.add("dark");
          document.documentElement.classList.remove("light");
          localStorage.setItem("theme", "dark");
          if (themeIcon) {
            themeIcon.className = "fa-solid fa-sun text-yellow-400 text-base";
          }
          if (themeToggle) {
            themeToggle.title = "Chuyển sang chế độ Sáng (Light Mode)";
          }
        }
      }

      function toggleTheme() {
        const isDark = document.documentElement.classList.contains("dark");
        setTheme(isDark ? "light" : "dark");
      }

      function initTheme() {
        const savedTheme = localStorage.getItem("theme") || "dark";
        setTheme(savedTheme);
      }

      if (themeToggle) {
        themeToggle.onclick = toggleTheme;
      }

      // FETCH CARS DỮ LIỆU TỪ SERVER VỚI FALLBACK AN TOÀN
      async function fetchCars() {
        try {
          const res = await fetch("get_cars.php");
          const data = await res.json();
          if (Array.isArray(data) && data.length > 0) {
            allCars = data.map((c) => ({
              ...c,
              id: Number(c.id),
              price: Number(c.price),
            }));
          } else {
            allCars = fallbackCars.map((c) => ({
              ...c,
              id: Number(c.id),
              price: Number(c.price),
            }));
          }
        } catch (e) {
          console.warn("Sử dụng fallback dữ liệu xe nội bộ:", e);
          allCars = fallbackCars.map((c) => ({
            ...c,
            id: Number(c.id),
            price: Number(c.price),
          }));
        }

        renderBrandPills();
        populateBrandDropdown();
        populateCalculatorCarSelect();
        populateDriveSelect();
        renderCars(allCars);
        calculateLoan();
      }

      // BRAND PILLS RENDER
      function renderBrandPills() {
        const brands = ["Tất cả", ...new Set(allCars.map((c) => c.brand))].sort();
        const container = document.getElementById("brandPillContainer");
        container.innerHTML = brands
          .map(
            (b, idx) => `
                <button onclick="filterByBrandQuick('${b}')" class="brand-pill px-4 py-1.5 rounded-full text-xs font-bold border border-gray-200 dark:border-white/10 ${idx === 0 ? "active" : "bg-white text-slate-700 dark:bg-slate-900 dark:text-gray-300 hover:border-red-500"}">
                    ${b}
                </button>
            `,
          )
          .join("");
      }

      function populateBrandDropdown() {
        const brands = [...new Set(allCars.map((c) => c.brand))].sort();
        const select = document.getElementById("brandFilter");
        select.innerHTML = '<option value="">Tất cả thương hiệu</option>';
        brands.forEach((b) => {
          const opt = document.createElement("option");
          opt.value = b;
          opt.textContent = b;
          select.appendChild(opt);
        });
      }

      function populateCalculatorCarSelect() {
        const select = document.getElementById("calcCarSelect");
        select.innerHTML = '<option value="">-- Chọn xe có sẵn --</option>';
        allCars.forEach((car) => {
          const opt = document.createElement("option");
          opt.value = car.price;
          opt.textContent = `${car.name} - ${formatBillion(car.price)}`;
          select.appendChild(opt);
        });
      }

      function populateDriveSelect() {
        const select = document.getElementById("driveCar");
        select.innerHTML = '<option value="Chưa chọn xe">Chọn mẫu xe quan tâm</option>';
        allCars.forEach((car) => {
          const opt = document.createElement("option");
          opt.value = car.name;
          opt.textContent = car.name;
          select.appendChild(opt);
        });
      }

      function formatCurrency(num) {
        // return Number(num).toLocaleString("vi-VN") + " VNĐ";
        return Math.round(Number(num) || 0).toLocaleString("vi-VN") + " VNĐ";
      }

      function formatBillion(num) {
        if (num >= 1000000000) {
          const b = (num / 1000000000).toFixed(2).replace(/\.00$/, "");
          return b + " Tỷ VNĐ";
        }
        return (num / 1000000).toFixed(0) + " Triệu VNĐ";
      }

      // RENDER DANH SÁCH XE CARD
      function renderCars(cars) {
        const grid = document.getElementById("carGrid");
        const countBadge = document.getElementById("carCountBadge");
        countBadge.innerHTML = `Đang hiển thị: <strong class="text-red-600 dark:text-red-400">${cars.length}</strong> xe`;

        if (cars.length === 0) {
          grid.innerHTML = `
                    <div class="col-span-full text-center py-16 bg-white dark:bg-slate-900/50 rounded-3xl border border-gray-200 dark:border-white/10 space-y-3 shadow-sm">
                        <i class="fa-solid fa-car-tunnel text-4xl text-gray-400 dark:text-gray-500"></i>
                        <h4 class="text-lg font-bold text-slate-800 dark:text-gray-300">Không tìm thấy mẫu xe phù hợp</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Vui lòng thử điều chỉnh lại bộ lọc giá, thương hiệu hoặc từ khóa tìm kiếm.</p>
                        <button onclick="resetAllFilters()" class="mt-2 px-5 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs transition">
                            Xem tất cả các xe
                        </button>
                    </div>
                `;
          return;
        }

        grid.innerHTML = cars
          .map((car) => {
            const carId = Number(car.id);
            const isCompared = comparedCars.some((c) => Number(c.id) === carId);
            const fuelIcon =
              car.fuel && car.fuel.includes("Điện")
                ? "fa-bolt text-yellow-500"
                : car.fuel && car.fuel.includes("Dầu")
                  ? "fa-oil-can text-amber-500"
                  : "fa-gas-pump text-red-500";

            return `
                    <div class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between group bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md hover:shadow-2xl transition">
                        
                        <!-- Card Media -->
                        <div class="relative overflow-hidden aspect-[16/10] bg-slate-900">
                            <img src="${car.image}" alt="${car.name}" 
                                 loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500 cursor-pointer"
                                 onclick="openDetailModal(${carId})"
                                 onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600'">
                            
                            <!-- Badges -->
                            <div class="absolute top-3.5 left-3.5 flex flex-wrap gap-1.5">
                                <span class="bg-red-600/90 backdrop-blur-md text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shadow">
                                    ${car.brand}
                                </span>
                                ${
                                  car.fuel && car.fuel.includes("Điện")
                                    ? `
                                    <span class="bg-emerald-600/90 backdrop-blur-md text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shadow">
                                        ⚡ EV Thuần Điện
                                    </span>
                                `
                                    : ""
                                }
                            </div>

                            <!-- Compare Badge Button on image -->
                            <button onclick="toggleCompareCar(${carId})" title="${isCompared ? "Bỏ so sánh" : "Thêm vào so sánh"}" 
                                    class="absolute top-3.5 right-3.5 px-2.5 py-1 rounded-full ${isCompared ? "bg-emerald-600 text-white font-bold" : "bg-white/80 dark:bg-black/50 text-slate-700 dark:text-gray-300 hover:bg-red-600 hover:text-white"} backdrop-blur-md border border-gray-200 dark:border-white/20 flex items-center gap-1 text-[11px] transition shadow">
                                <i class="fa-solid ${isCompared ? "fa-check" : "fa-code-compare"}"></i>
                                <span>${isCompared ? "Đang so sánh" : "So sánh"}</span>
                            </button>
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <h3 onclick="openDetailModal(${carId})" class="text-xl font-black text-slate-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 transition leading-snug cursor-pointer">
                                    ${car.name}
                                </h3>
                                
                                <div class="text-red-600 font-heading text-2xl font-black my-1">
                                    ${formatCurrency(car.price)}
                                </div>

                                <!-- Key Specs Chips -->
                                <div class="grid grid-cols-3 gap-1.5 text-[11px] bg-gray-50 dark:bg-slate-950/70 p-2.5 rounded-2xl border border-gray-100 dark:border-white/5 text-slate-600 dark:text-gray-300 mt-3">
                                    <div class="text-center truncate" title="${car.engine || "N/A"}">
                                        <i class="fa-solid fa-gauge-high text-red-600 dark:text-red-500 block mb-1"></i>
                                        <span class="text-[10px]">${car.engine ? car.engine.split(" ")[0] : "Động cơ"}</span>
                                    </div>
                                    <div class="text-center truncate" title="${car.transmission || "Tự động"}">
                                        <i class="fa-solid fa-sliders text-red-600 dark:text-red-500 block mb-1"></i>
                                        <span class="text-[10px]">${car.transmission ? (car.transmission.includes("8") ? "8 cấp" : car.transmission.includes("9") ? "9 cấp" : "Tự động") : "Tự động"}</span>
                                    </div>
                                    <div class="text-center truncate" title="${car.fuel || "Xăng"}">
                                        <i class="fa-solid ${fuelIcon} block mb-1"></i>
                                        <span class="text-[10px]">${car.fuel || "Xăng"}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="space-y-2 pt-1">
                                <div class="grid grid-cols-2 gap-2">
                                    <button onclick="openDetailModal(${carId})" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl text-xs transition shadow-lg shadow-red-600/25 flex items-center justify-center gap-1.5">
                                        <i class="fa-solid fa-circle-info"></i> Xem Chi Tiết
                                    </button>
                                    <button onclick="toggleCompareCar(${carId})" class="${isCompared ? "bg-emerald-600 hover:bg-emerald-700 text-white" : "bg-gray-100 hover:bg-gray-200 text-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-gray-200"} font-bold py-2.5 rounded-xl text-xs border border-gray-200 dark:border-white/10 transition flex items-center justify-center gap-1.5 shadow-sm">
                                        <i class="fa-solid ${isCompared ? "fa-check" : "fa-code-compare"}"></i> ${isCompared ? "Đã Chọn" : "+ So Sánh"}
                                    </button>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-2">
                                    <button onclick="openBookingModal('${car.name}')" class="bg-gray-100 hover:bg-gray-200 text-slate-800 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 font-bold py-2 rounded-xl text-xs border border-gray-200 dark:border-white/10 hover:border-red-500/40 transition flex items-center justify-center gap-1">
                                        <i class="fa-solid fa-steering-wheel text-red-600 dark:text-red-400"></i> Lái Thử
                                    </button>
                                    <button onclick="openQRModal('${car.name}', ${car.price})" class="bg-gray-100 hover:bg-gray-200 text-slate-800 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 font-bold py-2 rounded-xl text-xs border border-gray-200 dark:border-white/10 hover:border-red-500/40 transition flex items-center justify-center gap-1">
                                        <i class="fa-solid fa-qrcode text-red-600 dark:text-red-400"></i> Đặt Cọc
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                `;
          })
          .join("");
      }

      // BỘ LỌC ĐA CHIỀU (SEARCH + BRAND + PRICE + FUEL + CATEGORY + SORT)
      function filterCars() {
        const search = document.getElementById("searchInput").value.toLowerCase().trim();
        const brand = document.getElementById("brandFilter").value;
        const price = document.getElementById("priceFilter").value;
        const fuel = document.getElementById("fuelFilter").value;
        const sort = document.getElementById("sortFilter").value;

        let filtered = allCars.filter((c) => {
          const matchSearch =
            !search || c.name.toLowerCase().includes(search) || c.brand.toLowerCase().includes(search);
          const matchBrand = !brand || c.brand === brand;

          let matchPrice = true;
          if (price === "under-1b") matchPrice = c.price < 1000000000;
          else if (price === "1b-3b") matchPrice = c.price >= 1000000000 && c.price <= 3000000000;
          else if (price === "3b-8b") matchPrice = c.price > 3000000000 && c.price <= 8000000000;
          else if (price === "over-8b") matchPrice = c.price > 8000000000;

          let matchFuel = true;
          if (fuel) {
            matchFuel = c.fuel && c.fuel.toLowerCase().includes(fuel.toLowerCase());
          }

          let matchCategory = true;
          if (currentCategory === "electric") {
            matchCategory = c.fuel && c.fuel.includes("Điện");
          } else if (currentCategory === "supercar") {
            matchCategory = c.price >= 8000000000 || ["Ferrari", "Lamborghini", "Porsche"].includes(c.brand);
          } else if (currentCategory === "luxury_suv") {
            matchCategory =
              c.name.includes("G63") ||
              c.name.includes("Urus") ||
              c.name.includes("RX350") ||
              c.name.includes("Q7") ||
              c.name.includes("Everest") ||
              c.name.includes("Tucson") ||
              c.name.includes("CR-V") ||
              c.name.includes("VF8");
          }

          return matchSearch && matchBrand && matchPrice && matchFuel && matchCategory;
        });

        if (sort === "asc") filtered.sort((a, b) => a.price - b.price);
        else if (sort === "desc") filtered.sort((a, b) => b.price - a.price);
        else if (sort === "name") filtered.sort((a, b) => a.name.localeCompare(b.name));
        else if (sort === "featured") filtered.sort((a, b) => b.id - a.id);

        renderCars(filtered);
      }

      // Quick Brand Pill Filter Click
      function filterByBrandQuick(brandName) {
        const pills = document.querySelectorAll(".brand-pill");
        pills.forEach((p) => {
          if ((brandName === "Tất cả" && p.textContent.trim() === "Tất cả") || p.textContent.trim() === brandName) {
            p.classList.add("active");
          } else {
            p.classList.remove("active");
          }
        });

        const brandSelect = document.getElementById("brandFilter");
        brandSelect.value = brandName === "Tất cả" ? "" : brandName;
        filterCars();

        // Smooth scroll to car section if on desktop
        const carSec = document.getElementById("car-section");
        carSec.scrollIntoView({ behavior: "smooth", block: "start" });
      }

      // Category Tab Filter
      // Category Tab Filter
      function setCategoryFilter(cat, el) {
        currentCategory = cat;
        const tabs = document.querySelectorAll(".cat-pill");
        tabs.forEach((t) => t.classList.remove("active", "bg-red-600", "text-white"));

        // Gán class active cho đúng nút vừa bấm (el)
        if (el) {
          el.classList.add("active", "bg-red-600", "text-white");
        }
        filterCars();
      }

      function resetAllFilters() {
        document.getElementById("searchInput").value = "";
        document.getElementById("brandFilter").value = "";
        document.getElementById("priceFilter").value = "";
        document.getElementById("fuelFilter").value = "";
        document.getElementById("sortFilter").value = "featured";
        currentCategory = "all";

        // Reset trạng thái nút Thương hiệu (.brand-pill)
        document.querySelectorAll(".brand-pill").forEach((p, idx) => {
          if (idx === 0) p.classList.add("active");
          else p.classList.remove("active");
        });

        // Reset trạng thái nút Danh mục nhanh (.cat-pill) về "Tất Cả Mẫu Xe"
        document.querySelectorAll(".cat-pill").forEach((t, idx) => {
          if (idx === 0) {
            t.classList.add("active", "bg-red-600", "text-white");
          } else {
            t.classList.remove("active", "bg-red-600", "text-white");
          }
        });

        filterCars();
      }

      document.getElementById("searchInput").addEventListener("input", filterCars);
      document.getElementById("brandFilter").addEventListener("change", filterCars);
      document.getElementById("priceFilter").addEventListener("change", filterCars);
      document.getElementById("fuelFilter").addEventListener("change", filterCars);

      // INSTALLMENT CALCULATOR LOGIC
      function applyCarToCalculator() {
        const val = document.getElementById("calcCarSelect").value;
        if (val) {
          document.getElementById("calcPriceInput").value = val;
          calculateLoan();
        }
      }

      function calculateLoan() {
        // 1. Cập nhật dải màu đỏ chạy theo cục tròn cho cả 3 thanh trượt
        ["calcDownPercent", "calcMonths", "calcInterest"].forEach((id) => {
          const slider = document.getElementById(id);
          if (!slider) return;
          const min = parseFloat(slider.min) || 0;
          const max = parseFloat(slider.max) || 100;
          const val = parseFloat(slider.value) || 0;
          const percent = ((val - min) / (max - min)) * 100;

          // Lấy màu nền phần chưa kéo dựa theo chế độ Sáng/Tối trong style.css
          const isLight = document.documentElement.classList.contains("light");
          const trackBg = isLight ? "#cbd5e1" : "#334155";

          slider.style.background = `linear-gradient(to right, #ef4444 0%, #ef4444 ${percent}%, ${trackBg} ${percent}%, ${trackBg} 100%)`;
        });

        // 2. code tính toán giá
        const price = parseFloat(document.getElementById("calcPriceInput").value) || 0;
        const downPercent = parseInt(document.getElementById("calcDownPercent").value) || 20;
        const months = parseInt(document.getElementById("calcMonths").value) || 60;
        const rateYear = parseFloat(document.getElementById("calcInterest").value) || 8.5;

        // Labels update
        const downAmount = price * (downPercent / 100);
        const loanAmount = price - downAmount;
        const years = Number((months / 12).toFixed(1));

        document.getElementById("calcDownPercentLabel").innerHTML = `${downPercent}% (${formatCurrency(downAmount)})`;
        document.getElementById("calcMonthsLabel").innerText = `${months} tháng (${years} năm)`;
        document.getElementById("calcInterestLabel").innerText = `${rateYear.toFixed(1)}% / năm`;

        // Loan math: monthly principal + monthly interest (first month)
        const monthlyPrincipal = loanAmount / months;
        const monthlyRate = rateYear / 100 / 12;
        const monthlyInterestFirst = loanAmount * monthlyRate;
        const totalMonthlyFirst = monthlyPrincipal + monthlyInterestFirst;

        document.getElementById("resLoanAmount").innerText = formatCurrency(loanAmount);
        document.getElementById("resDownPayment").innerText = formatCurrency(downAmount);
        document.getElementById("resMonthlyPrincipal").innerText = formatCurrency(monthlyPrincipal);
        document.getElementById("resMonthlyInterest").innerText = formatCurrency(monthlyInterestFirst);
        document.getElementById("resMonthlyPayment").innerText = formatCurrency(totalMonthlyFirst);
      }

      window.addEventListener("DOMContentLoaded", calculateLoan);
      // Tự động phát hiện ngay khi thẻ <html> đổi chế độ Dark / Light Mode
      const themeObserver = new MutationObserver(() => {
        calculateLoan();
      });
      // Lắng nghe mọi thay đổi thuộc tính class trên thẻ <html>
      themeObserver.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ["class"],
      });

      // function requestLoanConsult() {
      //   const price = formatCurrency(document.getElementById("calcPriceInput").value);
      //   const downPercent = document.getElementById("calcDownPercent").value;
      //   const months = document.getElementById("calcMonths").value;
      //   alert(
      //     `Dạ chuyên viên tín dụng Showroom 4TL đã ghi nhận thông số vay xe giá ${price}, trả trước ${downPercent}%, thời hạn ${months} tháng. Quý khách vui lòng để lại số Zalo để nhận file Excel bảng tính chi tiết từng tháng!`,
      //   );
      // }

      // CAR COMPARISON LOGIC
      function toggleCompareCar(id) {
        const targetId = Number(id);
        const car = allCars.find((c) => Number(c.id) === targetId);
        if (!car) {
          console.warn("Không tìm thấy xe id:", id);
          return;
        }

        const idx = comparedCars.findIndex((c) => Number(c.id) === targetId);
        if (idx > -1) {
          comparedCars.splice(idx, 1);
        } else {
          if (comparedCars.length >= 3) {
            alert("Quý khách chỉ có thể so sánh tối đa 3 mẫu xe cùng lúc. Vui lòng bấm bỏ bớt xe để thêm xe khác!");
            return;
          }
          comparedCars.push(car);
        }

        updateCompareDock();
        renderCars(allCars);
      }

      function updateCompareDock() {
        const dock = document.getElementById("comparisonDock");
        const thumbs = document.getElementById("compareThumbnails");
        const count = document.getElementById("compareCount");
        const navBadge = document.getElementById("compareNavCount");

        if (count) count.innerText = comparedCars.length;
        if (navBadge) {
          navBadge.innerText = comparedCars.length;
          if (comparedCars.length > 0) {
            navBadge.classList.remove("hidden");
          } else {
            navBadge.classList.add("hidden");
          }
        }

        if (dock) {
          if (comparedCars.length > 0) {
            dock.classList.remove("hidden");
            dock.style.display = "flex";
          } else {
            dock.classList.add("hidden");
            dock.style.display = "none";
          }
        }

        if (thumbs) {
          thumbs.innerHTML = comparedCars
            .map(
              (c) => `
                    <div class="relative group" title="${c.name}">
                        <img src="${c.image}" class="w-10 h-10 object-cover rounded-xl border-2 border-red-500 shadow" onerror="this.src='https://via.placeholder.com/40'">
                        <button onclick="toggleCompareCar(${c.id})" title="Bỏ xe này" class="absolute -top-1.5 -right-1.5 w-4 h-4 bg-red-600 hover:bg-red-700 rounded-full text-[9px] text-white flex items-center justify-center shadow">✕</button>
                    </div>
                `,
            )
            .join("");
        }
      }

      function clearComparison() {
        comparedCars = [];
        updateCompareDock();
        renderCars(allCars);
      }

      function toggleCompareModal() {
        if (comparedCars.length === 0) {
          // If user clicks compare on navbar without cars selected, auto-suggest the top 2 supercars!
          if (allCars.length >= 2) {
            comparedCars = [allCars[0], allCars[1]];
            updateCompareDock();
            renderCars(allCars);
          } else if (allCars.length === 1) {
            comparedCars = [allCars[0]];
            updateCompareDock();
            renderCars(allCars);
          }
        }
        openCompareModal();
      }

      function openCompareModal() {
        if (comparedCars.length === 0) {
          if (allCars.length >= 2) {
            comparedCars = [allCars[0], allCars[1]];
            updateCompareDock();
            renderCars(allCars);
          }
        }

        const container = document.getElementById("compareTableContainer");
        if (!container) return;

        container.innerHTML = `
                <div class="mb-4 flex flex-wrap items-center justify-between gap-3 bg-gray-50 dark:bg-slate-800/60 p-3 rounded-2xl border border-gray-200 dark:border-white/10 text-xs">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="font-bold text-slate-700 dark:text-gray-300">Thêm xe vào bảng so sánh:</span>
                        <select onchange="handleAddCarToCompare(this.value)" class="px-3 py-1.5 rounded-xl bg-white dark:bg-slate-900 border border-gray-300 dark:border-white/10 text-slate-800 dark:text-white">
                            <option value="">-- Chọn thêm xe để so sánh --</option>
                            ${allCars
                              .filter((c) => !comparedCars.some((cc) => Number(cc.id) === Number(c.id)))
                              .map(
                                (c) => `
                                <option value="${c.id}">${c.name} (${formatBillion(c.price)})</option>
                            `,
                              )
                              .join("")}
                        </select>
                    </div>
                    <button onclick="clearComparison(); closeModal('compareModal');" class="text-red-600 dark:text-red-400 hover:underline font-bold">
                        <i class="fa-solid fa-trash mr-1"></i>Xóa hết so sánh
                    </button>
                </div>

                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-white/10">
                            <th class="p-3 text-gray-500 dark:text-gray-400 w-36">Thông Số</th>
                            ${comparedCars
                              .map(
                                (c) => `
                                <th class="p-3 text-slate-900 dark:text-white font-bold text-base min-w-[220px]">
                                    <div class="relative group mb-2">
                                        <img src="${c.image}" class="w-full h-36 object-cover rounded-xl border border-gray-200 dark:border-white/10" onerror="this.src='https://via.placeholder.com/300'">
                                        <button onclick="toggleCompareCar(${c.id}); openCompareModal();" title="Bỏ xe này" class="absolute top-2 right-2 w-6 h-6 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center text-xs shadow hover:scale-110 transition">✕</button>
                                    </div>
                                    <div class="leading-tight">${c.name}</div>
                                    <div class="text-red-600 dark:text-red-500 font-heading text-lg mt-1">${formatCurrency(c.price)}</div>
                                </th>
                            `,
                              )
                              .join("")}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-white/10 text-slate-700 dark:text-gray-300">
                        <tr>
                            <td class="p-3 font-bold text-gray-500 dark:text-gray-400">Hãng Sản Xuất</td>
                            ${comparedCars.map((c) => `<td class="p-3"><span class="px-2 py-0.5 rounded bg-red-600/10 dark:bg-red-600/30 text-red-600 dark:text-red-300 font-bold">${c.brand}</span></td>`).join("")}
                        </tr>
                        <tr>
                            <td class="p-3 font-bold text-gray-500 dark:text-gray-400">Động Cơ & Công Suất</td>
                            ${comparedCars.map((c) => `<td class="p-3 font-medium">${c.engine || "Đang cập nhật"}</td>`).join("")}
                        </tr>
                        <tr>
                            <td class="p-3 font-bold text-gray-500 dark:text-gray-400">Hộp Số</td>
                            ${comparedCars.map((c) => `<td class="p-3 font-medium">${c.transmission || "Tự động"}</td>`).join("")}
                        </tr>
                        <tr>
                            <td class="p-3 font-bold text-gray-500 dark:text-gray-400">Nhiên Liệu</td>
                            ${comparedCars.map((c) => `<td class="p-3 font-semibold text-slate-900 dark:text-white">${c.fuel || "Xăng"}</td>`).join("")}
                        </tr>
                        <tr>
                            <td class="p-3 font-bold text-gray-500 dark:text-gray-400">Mô Tả & Điểm Nhấn</td>
                            ${comparedCars.map((c) => `<td class="p-3 leading-relaxed text-[11px] text-gray-600 dark:text-gray-400">${c.description || "Chưa có thông tin"}</td>`).join("")}
                        </tr>
                        <tr>
                            <td class="p-3 font-bold text-gray-500 dark:text-gray-400">Thao Tác</td>
                            ${comparedCars
                              .map(
                                (c) => `
                                <td class="p-3 space-y-1.5">
                                    <button onclick="closeModal('compareModal'); openBookingModal('${c.name}')" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-xl text-xs transition shadow">
                                        Đăng Ký Lái Thử
                                    </button>
                                    <button onclick="closeModal('compareModal'); openDetailModal(${c.id})" class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-gray-200 font-bold py-2 rounded-xl text-xs transition border border-gray-300 dark:border-white/10">
                                        Xem Chi Tiết
                                    </button>
                                </td>
                            `,
                              )
                              .join("")}
                        </tr>
                    </tbody>
                </table>
            `;

        openModal("compareModal");
      }

      function handleAddCarToCompare(carId) {
        if (!carId) return;
        toggleCompareCar(carId);
        openCompareModal();
      }

      // MODAL HANDLERS
      function openDetailModal(id) {
        const targetId = Number(id);
        const car = allCars.find((c) => Number(c.id) === targetId);
        if (!car) {
          console.warn("Không tìm thấy xe id:", id);
          return;
        }

        const isCompared = comparedCars.some((c) => Number(c.id) === targetId);

        document.getElementById("modalContent").innerHTML = `
                <div class="relative rounded-2xl overflow-hidden mb-5">
                    <img src="${car.image}" class="w-full h-80 object-cover" onerror="this.src='https://via.placeholder.com/600x350'">
                    <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        ${car.brand}
                    </span>
                </div>

                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 border-b border-gray-200 dark:border-white/10 pb-4">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-black font-heading text-slate-900 dark:text-white">${car.name}</h2>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Mã SKU: 4TL-00${car.id} | Tình trạng: Xe mới có sẵn giao ngay</span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-red-600 dark:text-red-500 font-heading">
                        ${formatCurrency(car.price)}
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 my-4">
                    <div class="bg-gray-50 dark:bg-slate-800/80 p-3.5 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                        <span class="text-gray-500 dark:text-gray-400 text-[10px] uppercase font-bold block mb-1">Động cơ</span>
                        <strong class="text-xs text-slate-900 dark:text-white">${car.engine || "N/A"}</strong>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-800/80 p-3.5 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                        <span class="text-gray-500 dark:text-gray-400 text-[10px] uppercase font-bold block mb-1">Hộp số</span>
                        <strong class="text-xs text-slate-900 dark:text-white">${car.transmission || "Tự động"}</strong>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-800/80 p-3.5 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                        <span class="text-gray-500 dark:text-gray-400 text-[10px] uppercase font-bold block mb-1">Nhiên liệu</span>
                        <strong class="text-xs text-slate-900 dark:text-white">${car.fuel || "Xăng"}</strong>
                    </div>
                </div>

                <div class="space-y-2">
                    <h4 class="text-xs font-bold text-red-600 dark:text-red-400 uppercase tracking-wider">Giới thiệu tổng quan & Trang bị nổi bật</h4>
                    <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed bg-gray-50 dark:bg-slate-950/50 p-4 rounded-2xl border border-gray-200 dark:border-white/5">
                        ${car.description || "Mẫu xe sở hữu thiết kế thể thao đột phá, vật liệu nội thất cao cấp cùng hệ thống trợ lái và an toàn tối tân hàng đầu phân khúc."}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-3">
                    <button onclick="closeModal('detailModal'); openQRModal('${car.name}', ${car.price})" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-2xl text-xs transition shadow-lg shadow-red-600/30 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-qrcode"></i> Đặt Cọc Giữ Xe
                    </button>
                    <button onclick="closeModal('detailModal'); openBookingModal('${car.name}')" class="bg-gray-100 hover:bg-gray-200 text-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-white font-bold py-3 rounded-2xl text-xs border border-gray-300 dark:border-white/10 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-car-side"></i> Lái Thử Tận Nơi
                    </button>
                    <button onclick="toggleCompareCar(${car.id}); closeModal('detailModal');" class="${isCompared ? "bg-emerald-600 text-white" : "bg-gray-100 hover:bg-gray-200 text-slate-800 dark:bg-slate-800 dark:text-white"} font-bold py-3 rounded-2xl text-xs border border-gray-300 dark:border-white/10 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-code-compare"></i> ${isCompared ? "Đang so sánh" : "+ So sánh xe"}
                    </button>
                </div>
            `;

        openModal("detailModal");
      }

      function openQRModal(carName, price) {
        window.currentDepositCar = { name: carName, price: price };
        document.getElementById("qrCarName").innerText = `Đặt cọc ưu tiên mẫu: ${carName}`;
        const memo = `COC ${carName.replace(/\s+/g, "").toUpperCase()}`;
        document.getElementById("qrMemo").innerText = memo;

        const qrImg = document.getElementById("qrImage");
        qrImg.src = "images/qrcode.jpg";

        // Dự phòng tự động nếu file images/qrcode.jpg bị thiếu hoặc sai tên trên server
        qrImg.onerror = function () {
          this.onerror = null;
          // Thay MÃ_NGÂN_HÀNG (vd: VCB, TCB, MB, ACB, BIDV...) và SỐ_TÀI_KHOẢN_THẬT của bạn vào dưới đây
          this.src = `https://img.vietqr.io/image/MB-0706850014-compact2.png?amount=500000000&addInfo=${encodeURIComponent(memo)}&accountName=SHOWROOM%204TL%20AUTO`;
        };

        // // VietQR Dynamic URL format
        // const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=SHOWROOM4TL_MB_0706850014_${encodeURIComponent(memo)}`;
        // document.getElementById("qrImage").src = qrUrl;

        openModal("qrModal");
      }

      function openBookingModal(carName) {
        document.getElementById("modalBookingCar").value = carName;
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById("modalBookingDate").value = tomorrow.toISOString().split("T")[0];
        openModal("bookingModal");
      }

      // function confirmDepositSuccess() {
      //   alert(
      //     "🎉 Showroom 4TL chân thành cảm ơn quý khách! Kế toán đã tiếp nhận thông tin chuyển khoản cọc. Chuyên viên quản lý hợp đồng sẽ liên hệ qua điện thoại để gửi phiếu thu và hợp đồng cọc xe trong 15 phút.",
      //   );
      //   closeModal("qrModal");
      // }

      // function handleModalBooking(e) {
      //   e.preventDefault();
      //   const car = document.getElementById("modalBookingCar").value;
      //   const name = document.getElementById("modalBookingName").value;
      //   const phone = document.getElementById("modalBookingPhone").value;
      //   const date = document.getElementById("modalBookingDate").value;

      //   alert(
      //     `✅ Đã đặt lịch lái thử thành công!\n\nKhách hàng: ${name}\nSố điện thoại: ${phone}\nMẫu xe: ${car}\nNgày hẹn: ${date}\n\nChuyên viên Showroom 4TL sẽ gọi lại xác nhận cung đường lái thử phù hợp nhất với quý khách.`,
      //   );
      //   closeModal("bookingModal");
      // }

      // function handleTestDriveSubmit(e) {
      //   e.preventDefault();
      //   const name = document.getElementById("driveName").value;
      //   const phone = document.getElementById("drivePhone").value;
      //   const car = document.getElementById("driveCar").value;

      //   alert(
      //     `✅ Đã tiếp nhận yêu cầu lái thử của quý khách ${name} (${phone}) đối với mẫu xe "${car}". Đội ngũ tiếp đón Showroom 4TL sẽ liên hệ sắp xếp trong chốc lát!`,
      //   );
      //   e.target.reset();
      // }

      async function confirmDepositSuccess() {
        const cusName = document.getElementById("qrCustomerName").value.trim() || "Khách đặt cọc online";
        const cusPhone = document.getElementById("qrCustomerPhone").value.trim();
        const memo = document.getElementById("qrMemo").innerText;

        if (!cusPhone) {
          alert("Vui lòng nhập Số điện thoại để kế toán đối soát giao dịch đặt cọc!");
          return;
        }

        await fetch("save_order.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            type: "deposit",
            car_name: window.currentDepositCar?.name || "Xe Showroom 4TL",
            car_price: window.currentDepositCar?.price || 0,
            memo: memo,
            customer_name: cusName,
            customer_phone: cusPhone,
          }),
        });

        alert(
          "🎉 Showroom 4TL đã lưu thông tin giao dịch cọc! Kế toán sẽ gọi xác nhận qua SĐT " +
            cusPhone +
            " trong 15 phút.",
        );
        closeModal("qrModal");
      }

      async function handleModalBooking(e) {
        e.preventDefault();
        const car = document.getElementById("modalBookingCar").value;
        const name = document.getElementById("modalBookingName").value;
        const phone = document.getElementById("modalBookingPhone").value;
        const date = document.getElementById("modalBookingDate").value;

        await fetch("save_order.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ type: "booking", name, phone, car, date, note: "Đặt từ Modal Lái thử" }),
        });

        alert(`✅ Đã lưu lịch lái thử vào hệ thống!\nKhách hàng: ${name} (${phone})\nMẫu xe: ${car} - Ngày: ${date}`);
        e.target.reset();
        closeModal("bookingModal");
      }

      async function handleTestDriveSubmit(e) {
        e.preventDefault();
        const name = document.getElementById("driveName").value;
        const phone = document.getElementById("drivePhone").value;
        const car = document.getElementById("driveCar").value;

        await fetch("save_order.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            type: "booking",
            name,
            phone,
            car,
            date: new Date().toISOString().split("T")[0],
            note: "Đặt từ Form chân trang",
          }),
        });

        alert(`✅ Đã tiếp nhận & lưu lịch hẹn của quý khách ${name} (${phone}) đối với mẫu xe "${car}"!`);
        e.target.reset();
      }

      async function requestLoanConsult() {
        const phone = prompt("Quý khách vui lòng nhập Số điện thoại / Zalo để nhận bảng tính trả góp chi tiết:");
        if (!phone) return;
        const price = formatCurrency(document.getElementById("calcPriceInput").value);
        const downPercent = document.getElementById("calcDownPercent").value;
        const months = document.getElementById("calcMonths").value;

        await fetch("save_order.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            type: "booking",
            name: "Khách tư vấn trả góp",
            phone: phone,
            car: `Gói vay xe ${price}`,
            date: new Date().toISOString().split("T")[0],
            note: `Trả trước ${downPercent}%, kỳ hạn ${months} tháng`,
          }),
        });
        alert("✅ Đã gửi yêu cầu thành công! Chuyên viên tín dụng 4TL sẽ gửi bảng tính qua Zalo " + phone + " ngay.");
      }

      // CHATBOT ASSISTANT
      function toggleChat() {
        const chatWin = document.getElementById("chatWindow");
        const chatIcon = document.getElementById("chatBubbleIcon");
        if (!chatWin) return;

        const isCurrentlyHidden = chatWin.style.display === "none" || chatWin.classList.contains("hidden");

        if (isCurrentlyHidden) {
          chatWin.classList.remove("hidden");
          chatWin.style.display = "flex";
          if (chatIcon) {
            chatIcon.className = "fa-solid fa-xmark text-2xl transition";
          }
          const chatBox = document.getElementById("chatBox");
          if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
          setTimeout(() => {
            const input = document.getElementById("chatInput");
            if (input) input.focus();
          }, 100);
        } else {
          chatWin.classList.add("hidden");
          chatWin.style.display = "none";
          if (chatIcon) {
            chatIcon.className = "fa-solid fa-headset text-2xl group-hover:rotate-12 transition";
          }
        }
      }

      function quickPrompt(text) {
        document.getElementById("chatInput").value = text;
        sendChatMessage();
      }

      async function sendChatMessage() {
        const input = document.getElementById("chatInput");
        const text = input.value.trim();
        if (!text) return;

        const chatBox = document.getElementById("chatBox");

        // Add user message
        chatBox.innerHTML += `
                <div class="bg-red-600 text-white p-3 rounded-2xl rounded-tr-none max-w-[85%] ml-auto text-xs shadow-md leading-relaxed">
                    ${text}
                </div>
            `;
        input.value = "";
        chatBox.scrollTop = chatBox.scrollHeight;

        // Typing indicator
        const typingId = "typing-" + Date.now();
        chatBox.innerHTML += `
                <div id="${typingId}" class="bg-gray-100 dark:bg-slate-800 text-gray-500 dark:text-gray-400 p-2.5 rounded-2xl rounded-tl-none max-w-[50%] self-start text-xs border border-gray-200 dark:border-white/5 flex items-center gap-1">
                    <span class="animate-bounce">●</span><span class="animate-bounce delay-100">●</span><span class="animate-bounce delay-200">●</span>
                </div>
            `;
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
          const res = await fetch("ai_chat.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ message: text }),
          });
          const data = await res.json();

          const typingEl = document.getElementById(typingId);
          if (typingEl) typingEl.remove();

          chatBox.innerHTML += `
                    <div class="bg-gray-100 dark:bg-slate-800 text-gray-800 dark:text-gray-200 p-3.5 rounded-2xl rounded-tl-none max-w-[85%] self-start border border-gray-200 dark:border-white/10 shadow-sm leading-relaxed">
                        ${data.reply}
                    </div>
                `;
          chatBox.scrollTop = chatBox.scrollHeight;
        } catch (err) {
          const typingEl = document.getElementById(typingId);
          if (typingEl) typingEl.remove();

          chatBox.innerHTML += `
                    <div class="bg-gray-100 dark:bg-slate-800 text-gray-800 dark:text-gray-200 p-3.5 rounded-2xl rounded-tl-none max-w-[85%] self-start border border-gray-200 dark:border-white/10 shadow-sm leading-relaxed">
                        Dạ quý khách cần tư vấn chi tiết về mẫu xe nào, xin vui lòng gọi trực tiếp Hotline VIP <strong>0706.850.014</strong> để được phục vụ 24/7 ạ!
                    </div>
                `;
          chatBox.scrollTop = chatBox.scrollHeight;
        }
      }

      // Initialize App
      initTheme();
      fetchCars();
    </script>
  </body>
</html>
```

### file admin.html:
```html
<!doctype html>
<html lang="vi" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bảng Quản Lý Admin - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            fontFamily: {
              sans: ["Plus Jakarta Sans", "sans-serif"],
              heading: ["Outfit", "sans-serif"],
            },
          },
        },
      };
    </script>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body
    class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 min-h-screen p-4 sm:p-8 font-sans transition-colors duration-300">
    <div class="max-w-6xl mx-auto space-y-6">
      <!-- Top Admin Header -->
      <header
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md p-6 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl">
        <div class="flex items-center gap-3">
          <div
            class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center text-white shadow-lg shadow-red-600/30">
            <i class="fa-solid fa-gauge text-lg"></i>
          </div>
          <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-heading">
              BẢNG QUẢN TRỊ KHO XE 4TL
            </h1>
            <p class="text-xs text-gray-500 dark:text-gray-400">
              Hệ thống quản lý mẫu xe, cập nhật giá và kho hàng trực tuyến
            </p>
          </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
          <!-- Theme Toggle Button -->
          <button
            id="themeToggle"
            type="button"
            title="Chuyển chế độ Sáng / Tối"
            class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 text-amber-500 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-yellow-400 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
            <i id="themeIcon" class="fa-solid fa-sun text-base"></i>
          </button>

          <a
            href="index.html"
            class="bg-gray-100 hover:bg-gray-200 text-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-gray-200 px-4 py-2.5 rounded-xl text-xs font-bold border border-gray-200 dark:border-white/10 transition flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
            Xem Trang Chủ
          </a>
          <a
            href="train_bot.php"
            class="bg-amber-500/15 hover:bg-amber-500 text-amber-600 hover:text-white dark:bg-yellow-500/20 dark:hover:bg-yellow-500 dark:text-yellow-400 dark:hover:text-slate-900 px-4 py-2.5 rounded-xl text-xs font-bold border border-amber-300 dark:border-yellow-500/30 transition flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-robot"></i>
            Huấn Luyện AI Bot
          </a>
          <a
            href="logout.php"
            class="bg-red-600/10 hover:bg-red-600 text-red-600 hover:text-white dark:bg-red-600/20 dark:hover:bg-red-600 dark:text-red-400 px-4 py-2.5 rounded-xl text-xs font-bold border border-red-200 dark:border-red-500/30 transition flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-right-from-bracket"></i>
            Đăng Xuất
          </a>
        </div>
      </header>

      <!-- KPI Stats Overview -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="statsGrid">
        <div
          class="bg-white dark:bg-slate-900/80 p-5 rounded-2xl border border-gray-200 dark:border-white/10 shadow-md">
          <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold">Tổng Số Xe</span>
          <div
            class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-heading mt-1"
            id="statTotalCars">
            --
          </div>
        </div>
        <div
          class="bg-white dark:bg-slate-900/80 p-5 rounded-2xl border border-gray-200 dark:border-white/10 shadow-md">
          <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold">Tổng Giá Trị Kho</span>
          <div
            class="text-xl sm:text-2xl font-black text-red-600 dark:text-red-400 font-heading mt-1"
            id="statTotalValue">
            --
          </div>
        </div>
        <div
          class="bg-white dark:bg-slate-900/80 p-5 rounded-2xl border border-gray-200 dark:border-white/10 shadow-md">
          <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold">Số Thương Hiệu</span>
          <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-heading mt-1" id="statBrands">
            --
          </div>
        </div>
        <div
          class="bg-white dark:bg-slate-900/80 p-5 rounded-2xl border border-gray-200 dark:border-white/10 shadow-md">
          <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold">Xe Đắt Giá Nhất</span>
          <div class="text-sm font-bold text-amber-600 dark:text-yellow-400 truncate mt-1" id="statTopCar">--</div>
        </div>
      </div>

      <!-- Form Thêm Xe Mới -->
      <div
        class="bg-white dark:bg-slate-900/80 p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl space-y-4">
        <div class="flex items-center gap-2 text-red-600 dark:text-red-500 font-bold text-sm uppercase tracking-wider">
          <i class="fa-solid fa-square-plus"></i>
          <h2>Thêm Mẫu Xe Mới Vào Showroom</h2>
        </div>

        <form id="addCarForm" class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Tên xe / Model</label>
            <input
              type="text"
              id="name"
              placeholder="VD: Porsche Taycan Turbo S"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Hãng sản xuất</label>
            <input
              type="text"
              id="brand"
              placeholder="VD: Porsche"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Giá bán (VNĐ)</label>
            <input
              type="number"
              id="price"
              placeholder="VD: 9500000000"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Động cơ & Mã lực</label>
            <input
              type="text"
              id="engine"
              placeholder="VD: Động cơ điện đôi (750 HP)"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Hộp số</label>
            <input
              type="text"
              id="transmission"
              placeholder="VD: Tự động 2 cấp"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Loại nhiên liệu</label>
            <input
              type="text"
              id="fuel"
              placeholder="VD: Điện / Xăng / Hybrid"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>

          <div class="md:col-span-3">
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">
              URL Hình ảnh xe (link ảnh online)
            </label>
            <input
              type="text"
              id="image"
              placeholder="https://..."
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-red-500" />
          </div>

          <div class="md:col-span-3">
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">
              Mô tả chi tiết & Điểm nhấn công nghệ
            </label>
            <textarea
              id="description"
              placeholder="Mô tả các trang bị an toàn, cảm giác lái, bảo hành..."
              rows="3"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-red-500"></textarea>
          </div>

          <div class="md:col-span-3">
            <button
              type="submit"
              class="w-full bg-red-600 hover:bg-red-700 text-white py-3.5 rounded-xl font-bold transition shadow-lg shadow-red-600/30 flex items-center justify-center gap-2">
              <i class="fa-solid fa-cloud-arrow-up"></i>
              Lưu Mẫu Xe Mới
            </button>
          </div>
        </form>
      </div>

      <!-- Danh Sách Xe Hiện Có -->
      <div
        class="bg-white dark:bg-slate-900/80 p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl space-y-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
          <h2 class="text-lg font-bold text-slate-900 dark:text-white font-heading">
            Danh Sách Xe Trong Cơ Sở Dữ Liệu
          </h2>
          <input
            type="text"
            id="adminSearch"
            oninput="filterAdminCars()"
            placeholder="Tìm nhanh theo tên hoặc hãng..."
            class="px-3.5 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-red-500 w-full sm:w-64" />
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-xs">
            <thead>
              <tr class="border-b border-gray-200 dark:border-white/10 text-gray-500 dark:text-gray-400">
                <th class="p-3">ID</th>
                <th class="p-3">Hình Ảnh</th>
                <th class="p-3">Tên Xe</th>
                <th class="p-3">Hãng</th>
                <th class="p-3">Nhiên Liệu</th>
                <th class="p-3">Giá (VNĐ)</th>
                <th class="p-3 text-right">Thao Tác</th>
              </tr>
            </thead>
            <tbody
              id="adminTable"
              class="divide-y divide-gray-100 dark:divide-white/5 text-slate-700 dark:text-gray-300"></tbody>
          </table>
        </div>
      </div>

      <!-- QUẢN LÝ ĐƠN ĐẶT CỌC GIỮ XE (DEPOSITS) -->
      <div
        class="bg-white dark:bg-slate-900/80 p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-bold text-slate-900 dark:text-white font-heading flex items-center gap-2">
            <i class="fa-solid fa-qrcode text-red-600"></i>
            Đơn Đặt Cọc Giữ Xe Online
          </h2>
          <span id="depositBadge" class="text-xs font-bold px-3 py-1 rounded-full bg-red-600/10 text-red-600">
            0 đơn
          </span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-xs">
            <thead>
              <tr class="border-b border-gray-200 dark:border-white/10 text-gray-500 dark:text-gray-400">
                <th class="p-3">ID</th>
                <th class="p-3">Khách Hàng</th>
                <th class="p-3">SĐT</th>
                <th class="p-3">Mẫu Xe Cọc</th>
                <th class="p-3">Mã CK</th>
                <th class="p-3">Trạng Thái</th>
                <th class="p-3 text-right">Duyệt Đơn</th>
              </tr>
            </thead>
            <tbody
              id="depositTable"
              class="divide-y divide-gray-100 dark:divide-white/5 text-slate-700 dark:text-gray-300"></tbody>
          </table>
        </div>
      </div>

      <!-- QUẢN LÝ LỊCH ĐĂNG KÝ LÁI THỬ & TƯ VẤN (BOOKINGS) -->
      <div
        class="bg-white dark:bg-slate-900/80 p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-bold text-slate-900 dark:text-white font-heading flex items-center gap-2">
            <i class="fa-solid fa-calendar-check text-emerald-500"></i>
            Lịch Hẹn Lái Thử & Yêu Cầu Tư Vấn
          </h2>
          <span id="bookingBadge" class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-600/10 text-emerald-500">
            0 lịch hẹn
          </span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-xs">
            <thead>
              <tr class="border-b border-gray-200 dark:border-white/10 text-gray-500 dark:text-gray-400">
                <th class="p-3">ID</th>
                <th class="p-3">Khách Hàng</th>
                <th class="p-3">SĐT</th>
                <th class="p-3">Mẫu Xe / Nhu Cầu</th>
                <th class="p-3">Ngày Hẹn & Ghi Chú</th>
                <th class="p-3">Trạng Thái</th>
                <th class="p-3 text-right">Thao Tác</th>
              </tr>
            </thead>
            <tbody
              id="bookingTable"
              class="divide-y divide-gray-100 dark:divide-white/5 text-slate-700 dark:text-gray-300"></tbody>
          </table>
        </div>
      </div>
    </div>

    <script>
      // THEME CONTROLLER
      const themeToggle = document.getElementById("themeToggle");
      const themeIcon = document.getElementById("themeIcon");

      function setTheme(mode) {
        if (mode === "light") {
          document.documentElement.classList.remove("dark");
          document.documentElement.classList.add("light");
          localStorage.setItem("theme", "light");
          if (themeIcon) themeIcon.className = "fa-solid fa-moon text-slate-700 text-base";
          if (themeToggle) themeToggle.title = "Chuyển sang chế độ Tối (Dark Mode)";
        } else {
          document.documentElement.classList.add("dark");
          document.documentElement.classList.remove("light");
          localStorage.setItem("theme", "dark");
          if (themeIcon) themeIcon.className = "fa-solid fa-sun text-yellow-400 text-base";
          if (themeToggle) themeToggle.title = "Chuyển sang chế độ Sáng (Light Mode)";
        }
      }

      function toggleTheme() {
        const isDark = document.documentElement.classList.contains("dark");
        setTheme(isDark ? "light" : "dark");
      }

      const savedTheme = localStorage.getItem("theme") || "dark";
      setTheme(savedTheme);
      if (themeToggle) themeToggle.onclick = toggleTheme;

      let adminCars = [];

      async function loadAdminCars() {
        try {
          const res = await fetch("get_cars.php");
          adminCars = await res.json();
          updateStats();
          renderAdminTable(adminCars);
        } catch (e) {
          console.error("Lỗi:", e);
        }
      }

      async function loadCRMOrders() {
        try {
          const res = await fetch("manage_orders.php?action=list");
          const data = await res.json();

          // 1. Render bảng Đặt Cọc
          const depTable = document.getElementById("depositTable");
          document.getElementById("depositBadge").innerText = `${data.deposits.length} đơn`;
          depTable.innerHTML =
            data.deposits.length === 0
              ? `<tr><td colspan="7" class="p-4 text-center text-gray-400">Chưa có giao dịch đặt cọc nào.</td></tr>`
              : data.deposits
                  .map(
                    (d) => `
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50">
                    <td class="p-3 font-mono text-gray-400">#${d.id}</td>
                    <td class="p-3 font-bold">${d.customer_name}</td>
                    <td class="p-3 font-mono text-red-500 font-bold">${d.customer_phone}</td>
                    <td class="p-3 font-semibold">${d.car_name}</td>
                    <td class="p-3 font-mono text-amber-500">${d.memo}</td>
                    <td class="p-3">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold ${d.status === "verified" ? "bg-emerald-500/20 text-emerald-400" : d.status === "cancelled" ? "bg-red-500/20 text-red-400" : "bg-amber-500/20 text-amber-400"}">
                            ${d.status === "verified" ? "Đã nhận tiền" : d.status === "cancelled" ? "Đã hủy" : "Chờ đối soát"}
                        </span>
                    </td>
                    <td class="p-3 text-right space-x-2">
                        <button onclick="updateOrder('deposits', ${d.id}, 'verified')" class="text-emerald-500 hover:underline font-bold">Xác nhận</button>
                        <button onclick="deleteOrder('deposits', ${d.id})" class="text-red-500 hover:underline font-bold">Xóa</button>
                    </td>
                </tr>
            `,
                  )
                  .join("");

          // 2. Render bảng Lái Thử
          const bookTable = document.getElementById("bookingTable");
          document.getElementById("bookingBadge").innerText = `${data.bookings.length} lịch hẹn`;
          bookTable.innerHTML =
            data.bookings.length === 0
              ? `<tr><td colspan="7" class="p-4 text-center text-gray-400">Chưa có lịch hẹn lái thử nào.</td></tr>`
              : data.bookings
                  .map(
                    (b) => `
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50">
                    <td class="p-3 font-mono text-gray-400">#${b.id}</td>
                    <td class="p-3 font-bold">${b.customer_name}</td>
                    <td class="p-3 font-mono text-blue-400 font-bold">${b.phone}</td>
                    <td class="p-3 font-semibold">${b.car_name}</td>
                    <td class="p-3 text-gray-400">${b.booking_date} — <span class="italic">${b.note || ""}</span></td>
                    <td class="p-3">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold ${b.status === "confirmed" ? "bg-emerald-500/20 text-emerald-400" : b.status === "cancelled" ? "bg-red-500/20 text-red-400" : "bg-amber-500/20 text-amber-400"}">
                            ${b.status === "confirmed" ? "Đã chốt lịch" : b.status === "cancelled" ? "Đã hủy" : "Chờ gọi xác nhận"}
                        </span>
                    </td>
                    <td class="p-3 text-right space-x-2">
                        <button onclick="updateOrder('bookings', ${b.id}, 'confirmed')" class="text-emerald-500 hover:underline font-bold">Duyệt</button>
                        <button onclick="deleteOrder('bookings', ${b.id})" class="text-red-500 hover:underline font-bold">Xóa</button>
                    </td>
                </tr>
            `,
                  )
                  .join("");
        } catch (e) {
          console.error("Lỗi tải CRM:", e);
        }
      }

      async function updateOrder(table, id, status) {
        await fetch(`manage_orders.php?action=update_status&table=${table}&id=${id}&status=${status}`);
        loadCRMOrders();
      }

      async function deleteOrder(table, id) {
        if (confirm("Xóa bản ghi này?")) {
          await fetch(`manage_orders.php?action=delete&table=${table}&id=${id}`);
          loadCRMOrders();
        }
      }

      loadCRMOrders();

      function updateStats() {
        document.getElementById("statTotalCars").innerText = adminCars.length;
        const totalVal = adminCars.reduce((acc, c) => acc + (parseFloat(c.price) || 0), 0);
        document.getElementById("statTotalValue").innerText = (totalVal / 1000000000).toFixed(1) + " Tỷ VNĐ";

        const brands = new Set(adminCars.map((c) => c.brand));
        document.getElementById("statBrands").innerText = brands.size;

        if (adminCars.length > 0) {
          const top = [...adminCars].sort((a, b) => b.price - a.price)[0];
          document.getElementById("statTopCar").innerText =
            `${top.name} (${Number(top.price).toLocaleString("vi-VN")} đ)`;
        }
      }

      function renderAdminTable(cars) {
        const table = document.getElementById("adminTable");
        if (cars.length === 0) {
          table.innerHTML = `<tr><td colspan="7" class="p-6 text-center text-gray-400">Không tìm thấy xe nào.</td></tr>`;
          return;
        }

        table.innerHTML = cars
          .map(
            (car) => `
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition">
                    <td class="p-3 text-gray-400 font-mono">#${car.id}</td>
                    <td class="p-3">
                        <img src="${car.image}" class="w-14 h-9 object-cover rounded-lg border border-gray-200 dark:border-white/10" onerror="this.src='https://via.placeholder.com/60x40'">
                    </td>
                    <td class="p-3 font-bold text-slate-900 dark:text-white">${car.name}</td>
                    <td class="p-3"><span class="px-2 py-0.5 rounded bg-red-600/10 dark:bg-red-600/20 text-red-600 dark:text-red-400 font-bold">${car.brand}</span></td>
                    <td class="p-3 text-gray-500 dark:text-gray-400">${car.fuel || "Xăng"}</td>
                    <td class="p-3 text-red-600 dark:text-red-400 font-bold font-mono">${Number(car.price).toLocaleString("vi-VN")} đ</td>
                    <td class="p-3 text-right space-x-2">
                        <a href="edit_car.php?id=${car.id}" class="text-blue-600 dark:text-blue-400 hover:underline font-bold inline-flex items-center gap-1">
                            <i class="fa-solid fa-pen-to-square"></i> Sửa
                        </a>
                        <button onclick="deleteCar(${car.id})" class="text-red-600 dark:text-red-400 hover:underline font-bold inline-flex items-center gap-1 ml-2">
                            <i class="fa-solid fa-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
            `,
          )
          .join("");
      }

      function filterAdminCars() {
        const q = document.getElementById("adminSearch").value.toLowerCase().trim();
        const filtered = adminCars.filter((c) => c.name.toLowerCase().includes(q) || c.brand.toLowerCase().includes(q));
        renderAdminTable(filtered);
      }

      document.getElementById("addCarForm").onsubmit = async function (e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("name", document.getElementById("name").value);
        formData.append("brand", document.getElementById("brand").value);
        formData.append("price", document.getElementById("price").value);
        formData.append("engine", document.getElementById("engine").value);
        formData.append("transmission", document.getElementById("transmission").value);
        formData.append("fuel", document.getElementById("fuel").value);
        formData.append("image", document.getElementById("image").value);
        formData.append("description", document.getElementById("description").value);

        try {
          await fetch("add_car.php", { method: "POST", body: formData });
          alert("Đã lưu thông tin xe thành công!");
          this.reset();
          loadAdminCars();
        } catch (err) {
          alert("Lỗi khi thêm xe: " + err);
        }
      };

      async function deleteCar(id) {
        if (confirm("Bạn có chắc muốn xóa mẫu xe này khỏi cơ sở dữ liệu?")) {
          try {
            await fetch(`delete_car.php?id=${id}`);
            loadAdminCars();
          } catch (err) {
            alert("Lỗi xóa xe: " + err);
          }
        }
      }

      loadAdminCars();
    </script>
  </body>
</html>
```

### file ai_chat.html:
```html
<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trợ Lý Tư Vấn Siêu Xe AI - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 p-4 sm:p-8 font-sans min-h-screen flex items-center justify-center hero-gradient-mesh transition-colors duration-300">
    
    <div class="w-full max-w-2xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-2xl space-y-4">
        
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-white/10 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center text-white shadow-lg shadow-red-600/30">
                    <i class="fa-solid fa-headset text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-slate-900 dark:text-white font-heading">SUPERCAR AI CONSULTANT</h1>
                    <span class="text-xs text-emerald-600 dark:text-emerald-400 flex items-center gap-1 font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Sẵn sàng giải đáp 24/7
                    </span>
                </div>
            </div>
            
            <div class="flex items-center gap-2">
                <button id="themeToggle" type="button" title="Chuyển chế độ Sáng / Tối" class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 text-amber-500 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-yellow-400 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
                    <i id="themeIcon" class="fa-solid fa-sun text-sm"></i>
                </button>
                <a href="index.html" class="text-xs text-slate-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-white transition flex items-center gap-1 bg-gray-100 dark:bg-slate-800 px-3 py-2 rounded-xl border border-gray-200 dark:border-white/10">
                    <i class="fa-solid fa-arrow-left"></i> Trang Chủ
                </a>
            </div>
        </div>

        <!-- Quick chips -->
        <div class="flex gap-2 overflow-x-auto text-[11px] pb-1 whitespace-nowrap">
            <button onclick="setPrompt('Giá xe VinFast VF3?')" class="px-3 py-1 rounded-full bg-gray-100 hover:bg-red-600 text-slate-700 hover:text-white dark:bg-white/10 dark:text-gray-300 dark:hover:bg-red-600 dark:hover:text-white border border-gray-200 dark:border-transparent transition">⚡ VF3</button>
            <button onclick="setPrompt('G63 AMG giá bao nhiêu?')" class="px-3 py-1 rounded-full bg-gray-100 hover:bg-red-600 text-slate-700 hover:text-white dark:bg-white/10 dark:text-gray-300 dark:hover:bg-red-600 dark:hover:text-white border border-gray-200 dark:border-transparent transition">🏎️ G63 AMG</button>
            <button onclick="setPrompt('Chính sách trả góp 80% thế nào?')" class="px-3 py-1 rounded-full bg-gray-100 hover:bg-red-600 text-slate-700 hover:text-white dark:bg-white/10 dark:text-gray-300 dark:hover:bg-red-600 dark:hover:text-white border border-gray-200 dark:border-transparent transition">💳 Trả góp</button>
            <button onclick="setPrompt('Địa chỉ showroom ở đâu?')" class="px-3 py-1 rounded-full bg-gray-100 hover:bg-red-600 text-slate-700 hover:text-white dark:bg-white/10 dark:text-gray-300 dark:hover:bg-red-600 dark:hover:text-white border border-gray-200 dark:border-transparent transition">📍 Địa chỉ</button>
        </div>
        
        <!-- Chat History -->
        <div class="h-96 overflow-y-auto space-y-3 p-4 bg-gray-50 dark:bg-slate-950/60 rounded-2xl border border-gray-200 dark:border-white/5 flex flex-col text-xs" id="chatBox">
            <div class="bg-white dark:bg-slate-800 text-slate-800 dark:text-gray-200 p-3.5 rounded-2xl rounded-tl-none max-w-[85%] self-start border border-gray-200 dark:border-white/10 leading-relaxed shadow-sm">
                👋 Chào quý khách! Em là Trợ lý AI của Showroom 4TL. Em có thể tư vấn mẫu xe, mức giá, chính sách bảo hành hoặc đặt hẹn lái thử. Quý khách đang quan tâm đến dòng xe nào?
            </div>
        </div>

        <!-- Input Box -->
        <div class="flex gap-2 pt-2">
            <input type="text" id="userInput" placeholder="Nhập câu hỏi (Ví dụ: giá Porsche 911, bảo hành, địa chỉ)..." 
                   class="flex-1 bg-white dark:bg-slate-800 px-4 py-3 rounded-2xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-none focus:border-red-500 transition">
            <button id="sendBtn" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl font-bold text-xs transition shadow-lg shadow-red-600/30 flex items-center gap-1.5">
                <span>Gửi</span>
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <script>
        // THEME CONTROLLER
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');

        function setTheme(mode) {
            if (mode === 'light') {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                localStorage.setItem('theme', 'light');
                if (themeIcon) themeIcon.className = 'fa-solid fa-moon text-slate-700 text-sm';
                if (themeToggle) themeToggle.title = 'Chuyển sang chế độ Tối (Dark Mode)';
            } else {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
                localStorage.setItem('theme', 'dark');
                if (themeIcon) themeIcon.className = 'fa-solid fa-sun text-yellow-400 text-sm';
                if (themeToggle) themeToggle.title = 'Chuyển sang chế độ Sáng (Light Mode)';
            }
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.contains('dark');
            setTheme(isDark ? 'light' : 'dark');
        }

        const savedTheme = localStorage.getItem('theme') || 'dark';
        setTheme(savedTheme);
        if (themeToggle) themeToggle.onclick = toggleTheme;

        const chatBox = document.getElementById('chatBox');
        const userInput = document.getElementById('userInput');
        const sendBtn = document.getElementById('sendBtn');

        function setPrompt(text) {
            userInput.value = text;
            sendMsg();
        }

        async function sendMsg() {
            const text = userInput.value.trim();
            if (!text) return;

            chatBox.innerHTML += `
                <div class="bg-red-600 text-white p-3.5 rounded-2xl rounded-tr-none max-w-[85%] ml-auto text-xs shadow-md leading-relaxed">
                    ${text}
                </div>
            `;
            userInput.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            const typingId = 'typing-' + Date.now();
            chatBox.innerHTML += `
                <div id="${typingId}" class="bg-white dark:bg-slate-800 text-gray-400 p-2.5 rounded-2xl rounded-tl-none max-w-[40%] self-start text-xs border border-gray-200 dark:border-white/5 flex items-center gap-1 shadow-sm">
                    <span class="animate-bounce">●</span><span class="animate-bounce delay-100">●</span><span class="animate-bounce delay-200">●</span>
                </div>
            `;
            chatBox.scrollTop = chatBox.scrollHeight;

            try {
                const res = await fetch('ai_chat.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: text })
                });
                const data = await res.json();
                
                const typingEl = document.getElementById(typingId);
                if (typingEl) typingEl.remove();

                chatBox.innerHTML += `
                    <div class="bg-white dark:bg-slate-800 text-slate-800 dark:text-gray-200 p-3.5 rounded-2xl rounded-tl-none max-w-[85%] self-start border border-gray-200 dark:border-white/10 leading-relaxed shadow-sm">
                        ${data.reply}
                    </div>
                `;
                chatBox.scrollTop = chatBox.scrollHeight;
            } catch (err) {
                const typingEl = document.getElementById(typingId);
                if (typingEl) typingEl.remove();

                chatBox.innerHTML += `
                    <div class="bg-white dark:bg-slate-800 text-slate-800 dark:text-gray-200 p-3.5 rounded-2xl rounded-tl-none max-w-[85%] self-start border border-gray-200 dark:border-white/10 leading-relaxed shadow-sm">
                        Dạ em đã ghi nhận câu hỏi. Quý khách có thể liên hệ trực tiếp Hotline VIP <strong>0706.850.014</strong> để chuyên viên tư vấn phục vụ quý khách ngay ạ!
                    </div>
                `;
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }

        sendBtn.onclick = sendMsg;
        userInput.onkeypress = (e) => { if (e.key === 'Enter') sendMsg(); };
    </script>
</body>
</html>
```

### file detail.html:
```html
<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Xe - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 min-h-screen p-4 sm:p-8 font-sans transition-colors duration-300">
    
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- Header Nav -->
        <div class="flex justify-between items-center bg-white/90 dark:bg-slate-900/80 backdrop-blur-md p-4 rounded-2xl border border-gray-200 dark:border-white/10 shadow-lg">
            <a href="index.html" class="text-xs font-bold text-slate-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-white flex items-center gap-2 transition">
                <i class="fa-solid fa-arrow-left text-red-600 dark:text-red-500"></i> Quay Lại Showroom
            </a>
            
            <span class="text-xs font-bold text-red-600 dark:text-red-400 font-heading tracking-wider uppercase">SHOWROOM 4TL MOTORS</span>
            
            <div class="flex items-center gap-2">
                <!-- Theme Toggle Button -->
                <button id="themeToggle" type="button" title="Chuyển chế độ Sáng / Tối" class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 text-amber-500 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-yellow-400 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
                    <i id="themeIcon" class="fa-solid fa-sun text-sm"></i>
                </button>
                <a href="tel:0706850014" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-1.5 rounded-xl transition flex items-center gap-1.5 shadow-md">
                    <i class="fa-solid fa-phone"></i> Hotline VIP
                </a>
            </div>
        </div>

        <!-- Main Detail Card -->
        <div id="detailContainer" class="glass-panel p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-2xl space-y-8">
            <div class="text-center py-12 text-gray-400">
                <i class="fa-solid fa-spinner fa-spin text-2xl text-red-500"></i>
                <p class="mt-2 text-xs">Đang tải thông tin xe...</p>
            </div>
        </div>

    </div>

    <script>
        // THEME CONTROLLER
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');

        function setTheme(mode) {
            if (mode === 'light') {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                localStorage.setItem('theme', 'light');
                if (themeIcon) themeIcon.className = 'fa-solid fa-moon text-slate-700 text-sm';
                if (themeToggle) themeToggle.title = 'Chuyển sang chế độ Tối (Dark Mode)';
            } else {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
                localStorage.setItem('theme', 'dark');
                if (themeIcon) themeIcon.className = 'fa-solid fa-sun text-yellow-400 text-sm';
                if (themeToggle) themeToggle.title = 'Chuyển sang chế độ Sáng (Light Mode)';
            }
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.contains('dark');
            setTheme(isDark ? 'light' : 'dark');
        }

        const savedTheme = localStorage.getItem('theme') || 'dark';
        setTheme(savedTheme);
        if (themeToggle) themeToggle.onclick = toggleTheme;

        const fallbackCars = [
            { id: 1, name: 'Ferrari F8 Tributo', brand: 'Ferrari', price: 19000000000, image: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800', engine: '3.9L V8 Twin-Turbo (710 HP)', transmission: 'Tự động 7 cấp ly hợp kép', fuel: 'Xăng', description: 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm Ý. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h.' },
            { id: 2, name: 'Lamborghini Urus S', brand: 'Lamborghini', price: 16500000000, image: 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800', engine: '4.0L V8 Twin-Turbo (666 HP)', transmission: 'Tự động 8 cấp thể thao', fuel: 'Xăng', description: 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Thiết kế góc cạnh đậm chất chiến đấu của hãng xe bò tót Sant\'Agata Bolognese.' },
            { id: 3, name: 'Mercedes-AMG G63', brand: 'Mercedes-Benz', price: 11750000000, image: 'https://images.unsplash.com/photo-1520050206274-a1ae44613e6d?w=800', engine: '4.0L V8 Bi-Turbo (585 HP)', transmission: 'Tự động 9 cấp AMG Speedshift', fuel: 'Xăng', description: 'Mẫu SUV địa hình hạng sang đẳng cấp biểu tượng hoàng gia. Hệ dẫn động 4 bánh toàn thời gian 4MATIC với 3 khóa vi sai độc lập.' },
            { id: 4, name: 'Porsche 911 Carrera S', brand: 'Porsche', price: 8500000000, image: 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800', engine: '3.0L Boxer Twin-Turbo (450 HP)', transmission: 'Tự động 8 cấp PDK', fuel: 'Xăng', description: 'Mẫu xe thể thao huyền thoại mang lại cảm giác lái đỉnh cao, thiết kế timeless vượt thời gian đi cùng gói thể thao Sport Chrono Package.' }
        ];

        async function loadCarDetail() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = parseInt(urlParams.get('id')) || 1;

            let cars = [];
            try {
                const res = await fetch('get_cars.php');
                cars = await res.json();
            } catch(e) {
                cars = fallbackCars;
            }

            const car = (Array.isArray(cars) && cars.find(c => Number(c.id) === Number(id))) || fallbackCars[0];

            document.getElementById('detailContainer').innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: Image & Badge -->
                    <div class="lg:col-span-7 space-y-4">
                        <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-slate-900 border border-gray-200 dark:border-white/10 shadow-2xl">
                            <img src="${car.image}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/600x400'">
                            <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider">
                                ${car.brand}
                            </span>
                        </div>

                        <!-- 3 Mini Specs -->
                        <div class="grid grid-cols-3 gap-3 text-xs">
                            <div class="bg-gray-50 dark:bg-slate-900/80 p-3 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                                <i class="fa-solid fa-gauge-high text-red-600 dark:text-red-500 mb-1"></i>
                                <div class="text-[10px] text-gray-500 dark:text-gray-400">Động cơ</div>
                                <div class="font-bold text-slate-900 dark:text-white truncate">${car.engine || 'N/A'}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-slate-900/80 p-3 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                                <i class="fa-solid fa-sliders text-red-600 dark:text-red-500 mb-1"></i>
                                <div class="text-[10px] text-gray-500 dark:text-gray-400">Hộp số</div>
                                <div class="font-bold text-slate-900 dark:text-white truncate">${car.transmission || 'Tự động'}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-slate-900/80 p-3 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                                <i class="fa-solid fa-gas-pump text-red-600 dark:text-red-500 mb-1"></i>
                                <div class="text-[10px] text-gray-500 dark:text-gray-400">Nhiên liệu</div>
                                <div class="font-bold text-slate-900 dark:text-white truncate">${car.fuel || 'Xăng'}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Info & Pricing -->
                    <div class="lg:col-span-5 space-y-6">
                        <div>
                            <span class="text-xs text-red-600 dark:text-red-400 font-bold uppercase tracking-widest">${car.brand} Supercar</span>
                            <h1 class="text-3xl font-black font-heading text-slate-900 dark:text-white mt-1">${car.name}</h1>
                            <div class="text-3xl font-black text-red-600 dark:text-red-500 font-heading mt-2">
                                ${Number(car.price).toLocaleString('vi-VN')} VNĐ
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-slate-900/80 p-4 rounded-2xl border border-gray-200 dark:border-white/10 space-y-2 text-xs">
                            <div class="text-gray-500 dark:text-gray-400 uppercase font-bold text-[10px]">Giới thiệu mẫu xe</div>
                            <p class="text-slate-700 dark:text-gray-300 leading-relaxed">${car.description || 'Mẫu xe sở hữu thiết kế tuyệt hảo, trang bị động cơ hiệu năng cao và công nghệ an toàn hàng đầu thế giới.'}</p>
                        </div>

                        <!-- Loan Preview -->
                        <div class="bg-red-50 dark:bg-red-600/10 p-4 rounded-2xl border border-red-200 dark:border-red-500/30 text-xs space-y-1">
                            <div class="flex justify-between text-slate-700 dark:text-gray-300">
                                <span>Trả trước 20%:</span>
                                <strong class="text-slate-900 dark:text-white">${Number(car.price * 0.2).toLocaleString('vi-VN')} đ</strong>
                            </div>
                            <div class="flex justify-between text-slate-700 dark:text-gray-300">
                                <span>Ước tính góp tháng (5 năm):</span>
                                <strong class="text-red-600 dark:text-red-400 font-bold">${Number((car.price * 0.8) / 60 + (car.price * 0.8 * 0.085 / 12)).toLocaleString('vi-VN')} đ</strong>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-2">
                            <a href="tel:0706850014" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-2xl text-xs flex items-center justify-center gap-2 transition shadow-lg shadow-red-600/30">
                                <i class="fa-solid fa-phone"></i> Gọi Hotline Tư Vấn Ngay: 0706.850.014
                            </a>
                            <a href="index.html#car-section" class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-gray-300 font-bold py-3 rounded-2xl text-xs flex items-center justify-center gap-2 border border-gray-200 dark:border-white/10 transition">
                                <i class="fa-solid fa-car"></i> Xem Các Mẫu Xe Khác
                            </a>
                        </div>
                    </div>

                </div>
            `;
        }

        loadCarDetail();
    </script>
</body>
</html>
```

### file login.php:
```php
<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Cho phép đăng nhập nhanh admin/admin123 hoặc so sánh qua CSDL
        if (($username === 'admin' && ($password === 'admin123' || $password === 'admin'))) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $username;
            header('Location: admin.html');
            exit();
        }

        if ($pdo) {
            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch();

                if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_user'] = $user['username'];
                    header('Location: admin.html');
                    exit();
                } else {
                    $error = 'Tài khoản hoặc mật khẩu không chính xác!';
                }
            } catch (Exception $e) {
                $error = 'Lỗi truy vấn: ' . $e->getMessage();
            }
        } else {
            $error = 'Tài khoản hoặc mật khẩu không chính xác!';
        }
    } else {
        $error = 'Vui lòng nhập đầy đủ tài khoản và mật khẩu!';
    }
}
?>
<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Quản Trị - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#0b0f19] text-gray-100 min-h-screen flex items-center justify-center p-4 font-sans hero-gradient-mesh">

    <div class="w-full max-w-md bg-slate-900/90 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-2xl space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center text-white mx-auto shadow-lg shadow-red-600/30">
                <i class="fa-solid fa-lock text-xl"></i>
            </div>
            <h1 class="text-2xl font-black text-white font-heading tracking-wide">CỔNG QUẢN TRỊ VIÊN</h1>
            <p class="text-xs text-gray-400">Đăng nhập tài khoản điều hành Showroom 4TL</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-500/10 border border-red-500/40 text-red-400 p-3.5 rounded-2xl text-xs text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4 text-xs">
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Tài khoản quản trị</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-3.5 top-3.5 text-gray-400"></i>
                    <input type="text" name="username" required placeholder="Nhập tài khoản (VD: admin)" class="w-full pl-10 pr-4 py-3 bg-slate-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-red-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-gray-400 mb-1 font-bold">Mật khẩu</label>
                <div class="relative">
                    <i class="fa-solid fa-key absolute left-3.5 top-3.5 text-gray-400"></i>
                    <input type="password" name="password" required placeholder="Nhập mật khẩu (VD: admin123)" class="w-full pl-10 pr-4 py-3 bg-slate-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-red-500 transition">
                </div>
            </div>

            <div class="p-3 rounded-xl bg-slate-950/60 border border-white/5 text-[11px] text-gray-400">
                <span class="text-yellow-400 font-bold">Gợi ý đăng nhập thử nghiệm:</span><br>
                Tài khoản: <code class="text-white font-mono">admin</code> | Mật khẩu: <code class="text-white font-mono">admin123</code>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-red-600/30 flex items-center justify-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i> Đăng Nhập Hệ Thống
            </button>
        </form>

        <div class="text-center pt-2 border-t border-white/10">
            <a href="index.html" class="text-xs text-gray-400 hover:text-white transition flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Quay lại trang chủ Showroom
            </a>
        </div>

    </div>

</body>
</html>
```

### file logout.php:
```php
<?php
session_start();
session_unset();
session_destroy();

header('Location: index.html');
exit();
?>
```

### file ai_chat.php:
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
if (!$input && isset($_POST['message'])) {
    $input = $_POST;
}

$message = mb_strtolower(trim($input['message'] ?? ''), 'UTF-8');

if (empty($message)) {
    echo json_encode(["reply" => "Chào quý khách! Em là Trợ lý AI Showroom 4TL. Em có thể tư vấn mẫu xe, mức giá, chương trình trả góp hay đăng ký lái thử cho quý khách."], JSON_UNESCAPED_UNICODE);
    exit();
}

// Hàm chuẩn hóa tiếng Việt bỏ dấu để tìm kiếm mờ (fuzzy match)
function removeAccents($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    return $str;
}

$msgNoAccent = removeAccents($message);
$reply = "";

// ƯU TIÊN 1: TRA CỨU TỪ BẢNG TRI THỨC HUẤN LUYỆN (bot_knowledge)
if (isset($pdo) && $pdo) {
    try {
        $stmt = $pdo->query("SELECT keywords, response FROM bot_knowledge ORDER BY id DESC");
        $knowledges = $stmt->fetchAll();

        $bestScore = 0;
        $bestResponse = "";

        foreach ($knowledges as $row) {
            $kwList = explode(',', $row['keywords']);
            $score = 0;
            foreach ($kwList as $kw) {
                $kwClean = mb_strtolower(trim($kw), 'UTF-8');
                $kwNoAccent = removeAccents($kwClean);
                if (empty($kwClean)) continue;

                // Khớp chính xác cụm từ khóa (có dấu hoặc không dấu)
                if (mb_strpos($message, $kwClean) !== false || strpos($msgNoAccent, $kwNoAccent) !== false) {
                    $score += 3;
                } else {
                    // Tìm kiếm mờ bằng độ tương đồng từ (similar_text) cho từng từ trong câu
                    $msgWords = explode(' ', $msgNoAccent);
                    foreach ($msgWords as $w) {
                        if (strlen($w) >= 4 && strlen($kwNoAccent) >= 4) {
                            similar_text($w, $kwNoAccent, $percent);
                            if ($percent >= 82) {
                                $score += 1;
                            }
                        }
                    }
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestResponse = $row['response'];
            }
        }

        if ($bestScore >= 3) {
            $reply = nl2br(htmlspecialchars($bestResponse));
        }
    } catch (Exception $e) {
        // Bỏ qua nếu bảng chưa tồn tại
    }
}

// ƯU TIÊN 2: TRA CỨU THÔNG TIN XE TỪ BẢNG CARS
$cars = [];
if (isset($conn) && $conn && !$conn->connect_error) {
    $result = @$conn->query("SELECT * FROM cars");
    if ($result && $result->num_rows > 0) {
        while ($car = $result->fetch_assoc()) {
            $cars[] = $car;
        }
    }
}

if (!$reply && !empty($cars)) {
    foreach ($cars as $car) {
        $carNameLower = mb_strtolower($car['name'], 'UTF-8');
        $carNameNoAccent = removeAccents($carNameLower);
        $words = explode(' ', $carNameNoAccent);
        $lastWord = end($words);

        if (mb_strpos($message, $carNameLower) !== false ||
            strpos($msgNoAccent, $carNameNoAccent) !== false ||
            (strlen($lastWord) >= 3 && strpos($msgNoAccent, $lastWord) !== false) ||
            ($car['name'] === 'VinFast VF3' && (strpos($msgNoAccent, 'vf3') !== false || strpos($msgNoAccent, 'vf 3') !== false)) ||
            ($car['name'] === 'Mercedes-AMG G63' && (strpos($msgNoAccent, 'g63') !== false || strpos($msgNoAccent, 'g 63') !== false))
        ) {
            $priceFormatted = number_format($car['price'], 0, ',', '.');
            $reply = "Dạ, mẫu xe <strong>{$car['name']}</strong> ({$car['brand']}) hiện có giá niêm yết là <strong>{$priceFormatted} VNĐ</strong>.<br>✨ Động cơ: {$car['engine']} | Nhiên liệu: {$car['fuel']}.<br>Quý khách có thể bấm <strong>Đặt Cọc</strong> hoặc <strong>Lái Thử</strong> ngay bên dưới thẻ xe ạ!";
            break;
        }
    }
}

// ƯU TIÊN 3: TƯ VẤN THEO NGÂN SÁCH & CÂU HỎI MẶC ĐỊNH
if (!$reply && (strpos($msgNoAccent, 'duoi') !== false || strpos($msgNoAccent, 'tam') !== false || strpos($msgNoAccent, 'ngan sach') !== false)) {
    $limitPrice = 0;
    $label = "";
    if (strpos($msgNoAccent, '500') !== false) { $limitPrice = 500000000; $label = "dưới 500 triệu"; }
    elseif (strpos($msgNoAccent, '1 ty') !== false || strpos($msgNoAccent, '1ty') !== false) { $limitPrice = 1000000000; $label = "dưới 1 tỷ"; }
    elseif (strpos($msgNoAccent, '2 ty') !== false || strpos($msgNoAccent, '2ty') !== false) { $limitPrice = 2000000000; $label = "dưới 2 tỷ"; }
    elseif (strpos($msgNoAccent, '3 ty') !== false || strpos($msgNoAccent, '3ty') !== false) { $limitPrice = 3000000000; $label = "dưới 3 tỷ"; }

    if ($limitPrice > 0 && !empty($cars)) {
        $matches = array_filter($cars, fn($c) => (float)$c['price'] <= $limitPrice);
        if (!empty($matches)) {
            usort($matches, fn($a, $b) => $b['price'] - $a['price']);
            $list = [];
            foreach (array_slice($matches, 0, 4) as $m) {
                $p = number_format($m['price'], 0, ',', '.');
                $list[] = "• <strong>{$m['name']}</strong>: {$p} VNĐ";
            }
            $reply = "Dạ với tầm tài chính <strong>{$label}</strong>, Showroom 4TL đề xuất các mẫu xe:<br>" . implode("<br>", $list);
        }
    }
}

if (!$reply) {
    if (strpos($msgNoAccent, 'tra gop') !== false || strpos($msgNoAccent, 'vay') !== false) {
        $reply = "Showroom 4TL hỗ trợ vay trả góp lên đến <strong>80% giá trị xe</strong> trong tối đa 7 năm (84 tháng). Quý khách có thể kéo thử thanh <strong>Dự Toán Trả Góp</strong> ngay trên trang chủ!";
    } elseif (strpos($msgNoAccent, 'lai thu') !== false) {
        $reply = "Quý khách hãy bấm nút <strong>'Lái Thử'</strong> trên bất kỳ mẫu xe nào, điền tên và SĐT, hệ thống sẽ lưu lịch hẹn ngay để chuyên viên mang xe tới tận nơi ạ!";
    } else {
        $reply = "Cảm ơn quý khách đã nhắn tin! Quý khách có thể hỏi về giá xe cụ thể (VD: <em>giá VF3, G63, Porsche 911</em>), ngân sách (<em>xe dưới 2 tỷ</em>) hoặc gọi Hotline VIP <strong>0706.850.014</strong> ạ!";
    }
}

echo json_encode(["reply" => $reply], JSON_UNESCAPED_UNICODE);
?>
```

### file db.php:
```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "web_ban_xe";

// Kết nối MySQLi
$conn = @new mysqli($host, $user, $pass, $dbname);
if ($conn && !$conn->connect_error) {
    $conn->set_charset("utf8mb4");
}

// Kết nối PDO cho các file login, edit_car
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    $pdo = null;
}
?>
```

### file delete_car.php:
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Xóa xe thành công"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi xóa bản ghi"]);
    }
}
?>
```

### file edit_car.php:
```php
<?php
require_once 'db.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$car = null;
if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $brand = trim($_POST['brand']);
        $price = $_POST['price'];
        $image = trim($_POST['image']);
        $engine = trim($_POST['engine']);
        $transmission = trim($_POST['transmission']);
        $fuel = trim($_POST['fuel']);
        $description = trim($_POST['description']);

        $stmt = $pdo->prepare("UPDATE cars SET name=?, brand=?, price=?, image=?, engine=?, transmission=?, fuel=?, description=? WHERE id=?");
        $stmt->execute([$name, $brand, $price, $image, $engine, $transmission, $fuel, $description, $id]);
        
        header("Location: admin.html");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->execute([$id]);
    $car = $stmt->fetch();
}

if (!$car) {
    // Fallback default car if testing without active MySQL
    $car = [
        'id' => $id,
        'name' => 'Siêu Xe Mẫu',
        'brand' => 'Showroom 4TL',
        'price' => 2000000000,
        'image' => 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800',
        'engine' => '3.0L Twin-Turbo (450 HP)',
        'transmission' => 'Tự động 8 cấp',
        'fuel' => 'Xăng',
        'description' => 'Mẫu xe sang thể thao hiệu năng cao đang được trưng bày tại Showroom 4TL.'
    ];
}
?>
<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Xe #<?= $id ?> - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-[#0b0f19] text-gray-100 p-4 sm:p-8 font-sans min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-slate-900/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-white/10 shadow-2xl space-y-6">
        
        <div class="flex justify-between items-center border-b border-white/10 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center text-white">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-white font-heading">CHỈNH SỬA THÔNG TIN XE</h1>
                    <span class="text-xs text-gray-400">Mã định danh: #<?= htmlspecialchars($car['id']) ?></span>
                </div>
            </div>
            <a href="admin.html" class="text-xs text-gray-400 hover:text-white transition">&larr; Quay lại Admin</a>
        </div>
        
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Tên xe / Model</label>
                <input type="text" name="name" value="<?= htmlspecialchars($car['name']) ?>" required class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Hãng sản xuất</label>
                <input type="text" name="brand" value="<?= htmlspecialchars($car['brand']) ?>" required class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Giá bán (VNĐ)</label>
                <input type="number" step="100000" name="price" value="<?= $car['price'] ?>" required class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Loại nhiên liệu</label>
                <input type="text" name="fuel" value="<?= htmlspecialchars($car['fuel'] ?? 'Xăng') ?>" class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Động cơ & Công suất</label>
                <input type="text" name="engine" value="<?= htmlspecialchars($car['engine'] ?? '') ?>" class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-400 mb-1 font-bold">Hộp số</label>
                <input type="text" name="transmission" value="<?= htmlspecialchars($car['transmission'] ?? '') ?>" class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-400 mb-1 font-bold">URL Hình ảnh</label>
                <input type="text" name="image" value="<?= htmlspecialchars($car['image']) ?>" required class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-400 mb-1 font-bold">Mô tả chi tiết</label>
                <textarea name="description" rows="3" class="w-full bg-slate-800 p-3 rounded-xl border border-white/10 text-white focus:outline-none focus:border-red-500"><?= htmlspecialchars($car['description'] ?? '') ?></textarea>
            </div>
            
            <div class="md:col-span-2 flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3.5 rounded-xl font-bold transition shadow-lg shadow-red-600/30 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check"></i> Lưu Cập Nhật
                </button>
                <a href="admin.html" class="bg-slate-800 hover:bg-slate-700 text-gray-300 px-6 py-3.5 rounded-xl text-center font-bold border border-white/10 transition">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</body>
</html>
```

### file add_car.php:
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $price = $_POST['price'] ?? 0;
    $engine = $_POST['engine'] ?? '';
    $transmission = $_POST['transmission'] ?? '';
    $fuel = $_POST['fuel'] ?? '';
    $image = $_POST['image'] ?? 'default.jpg';
    $description = $_POST['description'] ?? '';

    if (!empty($name) && !empty($brand)) {
        $stmt = $conn->prepare("INSERT INTO cars (name, brand, price, engine, transmission, fuel, image, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsssss", $name, $brand, $price, $engine, $transmission, $fuel, $image, $description);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Thêm xe thành công"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Lỗi: " . $stmt->error]);
        }
    }
}
```

### file get_cars.php:
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$cars = [];

if (isset($conn) && $conn && !$conn->connect_error) {
    $sql = "SELECT * FROM cars ORDER BY id DESC";
    $result = @$conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $row['id'] = (int)$row['id'];
            $row['price'] = (float)$row['price'];
            $cars[] = $row;
        }
    }
}

// Nếu CSDL chưa được import hoặc chưa chạy, sử dụng dữ liệu mẫu chuẩn của Showroom 4TL
if (empty($cars)) {
    $cars = [
        [
            'id' => 1,
            'name' => 'Ferrari F8 Tributo',
            'brand' => 'Ferrari',
            'price' => 19000000000.00,
            'image' => 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800',
            'engine' => '3.9L V8 Twin-Turbo (710 HP)',
            'transmission' => 'Tự động 7 cấp ly hợp kép',
            'fuel' => 'Xăng',
            'description' => 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm Ý. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h.'
        ],
        [
            'id' => 2,
            'name' => 'Lamborghini Urus S',
            'brand' => 'Lamborghini',
            'price' => 16500000000.00,
            'image' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800',
            'engine' => '4.0L V8 Twin-Turbo (666 HP)',
            'transmission' => 'Tự động 8 cấp thể thao',
            'fuel' => 'Xăng',
            'description' => 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Thiết kế góc cạnh đậm chất chiến đấu của hãng xe bò tót Sant\'Agata Bolognese.'
        ],
        [
            'id' => 3,
            'name' => 'Mercedes-AMG G63',
            'brand' => 'Mercedes-Benz',
            'price' => 11750000000.00,
            'image' => 'https://images.unsplash.com/photo-1520050206274-a1ae44613e6d?w=800',
            'engine' => '4.0L V8 Bi-Turbo (585 HP)',
            'transmission' => 'Tự động 9 cấp AMG Speedshift',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV địa hình hạng sang đẳng cấp biểu tượng hoàng gia. Hệ dẫn động 4 bánh toàn thời gian 4MATIC với 3 khóa vi sai độc lập.'
        ],
        [
            'id' => 4,
            'name' => 'Porsche 911 Carrera S',
            'brand' => 'Porsche',
            'price' => 8500000000.00,
            'image' => 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800',
            'engine' => '3.0L Boxer Twin-Turbo (450 HP)',
            'transmission' => 'Tự động 8 cấp PDK',
            'fuel' => 'Xăng',
            'description' => 'Mẫu xe thể thao huyền thoại mang lại cảm giác lái đỉnh cao, thiết kế timeless vượt thời gian đi cùng gói thể thao Sport Chrono Package.'
        ],
        [
            'id' => 5,
            'name' => 'BMW 740i Pure Excellence',
            'brand' => 'BMW',
            'price' => 4699000000.00,
            'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800',
            'engine' => '3.0L I6 TwinPower (381 HP)',
            'transmission' => 'Tự động 8 cấp Steptronic',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Sedan hạng sang cao cấp đầy công nghệ của BMW với màn hình Theatre Screen 31.3 inch chuẩn 8K cùng hệ thống âm thanh vòm Bowers & Wilkins Diamond.'
        ],
        [
            'id' => 6,
            'name' => 'Lexus RX350 Luxury',
            'brand' => 'Lexus',
            'price' => 4330000000.00,
            'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800',
            'engine' => '2.4L Turbo T24A-FTS (275 HP)',
            'transmission' => 'Tự động 8 cấp Direct Shift',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm tĩnh lặng đỉnh cao, nội thất da Semi-Aniline cao cấp và hệ thống an toàn Lexus Safety System+ 3.0.'
        ],
        [
            'id' => 7,
            'name' => 'Audi Q7 45 TFSI quattro',
            'brand' => 'Audi',
            'price' => 3700000000.00,
            'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800',
            'engine' => '2.0L Turbo Mild-Hybrid (252 HP)',
            'transmission' => 'Tự động 8 cấp Tiptronic',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'SUV hạng sang 7 chỗ cỡ lớn dẫn động 4 bánh toàn thời gian quattro danh tiếng, đèn Matrix LED thông minh và buồng lái ảo Audi Virtual Cockpit.'
        ],
        [
            'id' => 8,
            'name' => 'Mercedes-Benz C-Class C300 AMG',
            'brand' => 'Mercedes-Benz',
            'price' => 2099000000.00,
            'image' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800',
            'engine' => '2.0L Turbo Mild-Hybrid EQ Boost (258 HP)',
            'transmission' => 'Tự động 9 cấp 9G-TRONIC',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Tiểu S-Class với thiết kế thể thao AMG Line, màn hình giải trí trung tâm 11.9 inch định dạng dọc, đèn Digital Light tối tân nhất.'
        ],
        [
            'id' => 9,
            'name' => 'Kia Carnival 2.2D Signature',
            'brand' => 'Kia',
            'price' => 1759000000.00,
            'image' => 'https://images.unsplash.com/photo-1563720223185-11003d516935?w=800',
            'engine' => '2.2L Smartstream D2.2 (199 HP)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Chuyên cơ mặt đất MPV 7 chỗ thương gia siêu tiện nghi, hàng ghế thứ 2 sưởi/làm mát và chế độ thư giãn không trọng lực VIP.'
        ],
        [
            'id' => 10,
            'name' => 'Ford Everest Titanium+ 4x4',
            'brand' => 'Ford',
            'price' => 1468000000.00,
            'image' => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800',
            'engine' => '2.0L Bi-Turbo Diesel (210 HP)',
            'transmission' => 'Tự động 10 cấp điện tử',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'SUV 7 chỗ thực thụ đậm chất cơ bắp Mỹ, khả năng lội nước 800mm, camera 360 độ và công nghệ đỗ xe tự động 2.0.'
        ],
        [
            'id' => 11,
            'name' => 'Toyota Camry 2.5Q',
            'brand' => 'Toyota',
            'price' => 1405000000.00,
            'image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800',
            'engine' => '2.5L Dynamic Force 4-cylinders (207 HP)',
            'transmission' => 'Tự động 8 cấp Direct Shift',
            'fuel' => 'Xăng',
            'description' => 'Mẫu sedan hạng D chuẩn mực của sự thành đạt, bền bỉ, êm ái bậc nhất phân khúc với gói an toàn Toyota Safety Sense 2.0.'
        ],
        [
            'id' => 12,
            'name' => 'Ford Ranger Raptor 3.0 V6',
            'brand' => 'Ford',
            'price' => 1299000000.00,
            'image' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800',
            'engine' => '3.0L V6 EcoBoost Twin-Turbo (392 HP)',
            'transmission' => 'Tự động 10 cấp',
            'fuel' => 'Xăng',
            'description' => 'Vua bán tải hiệu năng cao, trang bị bộ giảm xóc FOX 2.5 inch Live Valve thích ứng theo thời gian thực và chế độ lái sa mạc Baja Mode.'
        ],
        [
            'id' => 13,
            'name' => 'VinFast VF8 Plus',
            'brand' => 'VinFast',
            'price' => 1270000000.00,
            'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800',
            'engine' => '2 Động cơ điện (402 HP - AWD)',
            'transmission' => 'Tự động đơn cấp',
            'fuel' => 'Điện',
            'description' => 'SUV điện thông minh phân khúc D, thiết kế Pininfarina đỉnh cao, tăng tốc 0-100 km/h trong 5.5 giây và trợ lái thông minh ADAS cấp độ 2.'
        ],
        [
            'id' => 14,
            'name' => 'Honda CR-V e:HEV RS',
            'brand' => 'Honda',
            'price' => 1259000000.00,
            'image' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=800',
            'engine' => '2.0L Atkinson kết hợp 2 mô tơ điện (204 HP)',
            'transmission' => 'E-CVT thể thao',
            'fuel' => 'Xăng Hybrid',
            'description' => 'SUV thể thao thế hệ mới nhập khẩu nguyên chiếc, tiết kiệm nhiên liệu chỉ 3.4L/100km đô thị, gói an toàn Honda SENSING đầy đủ.'
        ],
        [
            'id' => 15,
            'name' => 'Hyundai Tucson 2.0 Diesel',
            'brand' => 'Hyundai',
            'price' => 959000000.00,
            'image' => 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800',
            'engine' => '2.0L Smartstream D2.0 (186 HP)',
            'transmission' => 'Tự động 8 cấp số nút bấm',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Crossover thiết kế tương lai Parametric Jewel, nội thất mở dạng phi thuyền, máy dầu bốc và tiết kiệm bậc nhất.'
        ],
        [
            'id' => 16,
            'name' => 'Toyota Corolla Cross 1.8HEV',
            'brand' => 'Toyota',
            'price' => 905000000.00,
            'image' => 'https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800',
            'engine' => '1.8L Hybrid Xăng + Điện (122 HP)',
            'transmission' => 'Vô cấp e-CVT',
            'fuel' => 'Xăng Hybrid',
            'description' => 'Mẫu Urban SUV tiết kiệm nhiên liệu tối ưu với động cơ Hybrid tiên tiến, khung gầm TNGA vững chắc và vận hành êm ái nhẹ nhàng.'
        ],
        [
            'id' => 17,
            'name' => 'Mazda CX-5 2.0 Premium',
            'brand' => 'Mazda',
            'price' => 829000000.00,
            'image' => 'https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=800',
            'engine' => '2.0L SkyActiv-G (154 HP)',
            'transmission' => 'Tự động 6 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu Crossover bán chạy nhất phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế, 10 loa Bose cao cấp và hệ thống an toàn i-Activsense.'
        ],
        [
            'id' => 18,
            'name' => 'Hyundai Accent 1.5 AT',
            'brand' => 'Hyundai',
            'price' => 489000000.00,
            'image' => 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800',
            'engine' => '1.5L Smartstream G (115 HP)',
            'transmission' => 'Vô cấp thông minh iVT',
            'fuel' => 'Xăng',
            'description' => 'Sedan hạng B thế hệ hoàn toàn mới, kích thước lớn nhất phân khúc, trang bị gói SmartSense vượt tầm giá.'
        ],
        [
            'id' => 19,
            'name' => 'VinFast VF5 Plus',
            'brand' => 'VinFast',
            'price' => 468000000.00,
            'image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800',
            'engine' => 'Động cơ điện (134 HP - 135 Nm)',
            'transmission' => 'Tự động đơn cấp',
            'fuel' => 'Điện',
            'description' => 'A-SUV thuần điện quốc dân nhỏ gọn, chi phí vận hành siêu rẻ chỉ bằng 1/3 xe xăng, thời trang và linh hoạt trong đô thị.'
        ],
        [
            'id' => 20,
            'name' => 'VinFast VF3',
            'brand' => 'VinFast',
            'price' => 240000000.00,
            'image' => 'https://vinfastquan12.com.vn/wp-content/uploads/2025/02/VinFast_VF3_Mau_trang.webp',
            'engine' => 'Động cơ điện đơn (43 HP)',
            'transmission' => 'Tự động',
            'fuel' => 'Điện',
            'description' => 'Cơn sốt xe điện mini tại Việt Nam! Kiểu dáng hình hộp cá tính, gầm cao 191mm vượt địa hình ngập nước, Best Seller tại Showroom 4TL.'
        ]
    ];
}

echo json_encode($cars, JSON_UNESCAPED_UNICODE);
?>
```

### file train_bot.php:
```php
<?php
session_start();
require_once 'db.php';

$msg = '';

// Xử lý thêm dữ liệu huấn luyện mới
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $keywords = strtolower(trim($_POST['keywords']));
    $response = trim($_POST['response']);

    if (!empty($keywords) && !empty($response)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO bot_knowledge (keywords, response) VALUES (?, ?)");
            $stmt->execute([$keywords, $response]);
            $msg = "Đã lưu từ khóa huấn luyện thành công!";
        } catch (PDOException $e) {
            $msg = "Lỗi khi lưu dữ liệu: " . $e->getMessage();
        }
    } else {
        $msg = "Vui lòng nhập đầy đủ thông tin!";
    }
}

// Xử lý xóa từ khóa
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM bot_knowledge WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: train_bot.php');
    exit();
}

// Lấy danh sách dữ liệu tri thức bot đang có
$knowledges = [];
try {
    $stmt = $pdo->query("SELECT * FROM bot_knowledge ORDER BY id DESC");
    $knowledges = $stmt->fetchAll();
} catch (PDOException $e) {
    // Nếu chưa có bảng bot_knowledge thì báo lỗi nhẹ
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Huấn Luyện AI Chatbot - Showroom 4TL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6 font-sans">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center bg-gray-800 p-4 rounded-xl border border-gray-700">
            <h1 class="text-xl font-bold text-red-500">Huấn Luyện AI Chatbot (Train Bot)</h1>
            <a href="admin.html" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded text-sm transition">Quay về Admin</a>
        </div>

        <!-- Form Thêm Tri Thức Mới -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-xl">
            <h2 class="text-lg font-semibold mb-4 text-gray-200">Thêm Dữ Liệu Phản Hồi Mới</h2>
            <?php if ($msg): ?>
                <p class="text-emerald-400 mb-4 text-sm"><?= htmlspecialchars($msg) ?></p>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <input type="hidden" name="action" value="add">
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Từ khóa nhận biết (phân cách bằng dấu phẩy)</label>
                    <input type="text" name="keywords" placeholder="Ví dụ: gia, bao nhieu, chi phi" required class="w-full bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500">
                </div>
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Câu trả lời phản hồi tự động</label>
                    <textarea name="response" rows="3" placeholder="Ví dụ: Giá siêu xe dao động từ $200,000 đến $3,000,000..." required class="w-full bg-gray-700 p-3 rounded border border-gray-600 focus:outline-none focus:border-red-500"></textarea>
                </div>
                <button type="submit" class="bg-red-600 hover:bg-red-700 px-6 py-2.5 rounded font-bold transition">
                    + Lưu Dữ Liệu Train
                </button>
            </form>
        </div>

        <!-- Bảng Danh Sách Tri Thức Đang Có -->
        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-xl overflow-x-auto">
            <h2 class="text-lg font-semibold mb-4 text-gray-200">Danh Sách Từ Khóa Đã Huấn Luyện</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-700 text-gray-400 text-sm">
                        <th class="p-3">ID</th>
                        <th class="p-3">Từ khóa (Keywords)</th>
                        <th class="p-3">Câu phản hồi (Response)</th>
                        <th class="p-3 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    <?php if (empty($knowledges)): ?>
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Chưa có dữ liệu tri thức nào.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($knowledges as $k): ?>
                            <tr class="hover:bg-gray-750">
                                <td class="p-3 text-sm text-gray-400"><?= $k['id'] ?></td>
                                <td class="p-3 text-red-400 font-medium"><?= htmlspecialchars($k['keywords']) ?></td>
                                <td class="p-3 text-gray-300 text-sm"><?= htmlspecialchars($k['response']) ?></td>
                                <td class="p-3 text-right">
                                    <a href="train_bot.php?delete=<?= $k['id'] ?>" onclick="return confirm('Bạn có muốn xóa từ khóa này?');" class="text-red-400 hover:text-red-300 text-sm font-medium">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
```

### file style.css:
```css
/* ==========================================================================
   SHOWROOM 4TL - LUXURY & SUPERCAR AUTOMOTIVE DESIGN SYSTEM
   ========================================================================== */

@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap');

:root {
    --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    --font-heading: 'Outfit', 'Plus Jakarta Sans', sans-serif;
    --primary: #ef4444;
    --primary-hover: #dc2626;
    --primary-glow: rgba(239, 68, 68, 0.4);
    --gold: #f59e0b;
}

html {
    scroll-behavior: smooth;
    font-family: var(--font-sans);
}

body {
    overflow-x: hidden;
    font-family: var(--font-sans);
    transition: background-color 0.3s ease, color 0.3s ease;
}

h1, h2, h3, h4, h5, h6, .font-heading {
    font-family: var(--font-heading);
}

/* Custom Scrollbar - Dark Mode */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}
::-webkit-scrollbar-track {
    background: #0f172a;
}
::-webkit-scrollbar-thumb {
    background: #334155;
    border-radius: 9999px;
}
::-webkit-scrollbar-thumb:hover {
    background: #ef4444;
}

/* Custom Scrollbar - Light Mode */
.light ::-webkit-scrollbar-track {
    background: #f1f5f9;
}
.light ::-webkit-scrollbar-thumb {
    background: #cbd5e1;
}
.light ::-webkit-scrollbar-thumb:hover {
    background: #ef4444;
}

/* Glassmorphism Classes */
.glass-panel {
    background: rgba(15, 23, 42, 0.75);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.light .glass-panel {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(226, 232, 240, 0.9);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
}

.glass-card {
    background: rgba(30, 41, 59, 0.6);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.07);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.light .glass-card {
    background: #ffffff;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
}

.glass-card:hover {
    transform: translateY(-6px);
    border-color: rgba(239, 68, 68, 0.4);
    box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.5), 0 0 20px 2px rgba(239, 68, 68, 0.15);
}

.light .glass-card:hover {
    transform: translateY(-6px);
    border-color: rgba(239, 68, 68, 0.4);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
}

/* Luxury Glow & Gradients */
.glow-red {
    box-shadow: 0 0 25px rgba(239, 68, 68, 0.45);
}

.glow-red-sm {
    box-shadow: 0 0 12px rgba(239, 68, 68, 0.3);
}

.text-gradient-red {
    background: linear-gradient(135deg, #ffffff 20%, #fca5a5 60%, #ef4444 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.light .text-gradient-red {
    background: linear-gradient(135deg, #0f172a 20%, #b91c1c 70%, #ef4444 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.text-gradient-gold {
    background: linear-gradient(135deg, #fef08a 0%, #f59e0b 60%, #b45309 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Background Gradients */
.hero-gradient-mesh {
    background-image: 
        radial-gradient(at 0% 0%, rgba(220, 38, 38, 0.18) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(185, 28, 28, 0.12) 0px, transparent 50%),
        radial-gradient(at 50% 50%, rgba(15, 23, 42, 0.95) 0px, transparent 80%);
}

.light .hero-gradient-mesh {
    background-image: 
        radial-gradient(at 0% 0%, rgba(254, 226, 226, 0.9) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(254, 202, 202, 0.5) 0px, transparent 50%),
        radial-gradient(at 50% 50%, #f8fafc 0px, transparent 80%);
}

/* Pulse Glow Animation */
@keyframes pulse-ring {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 12px rgba(239, 68, 68, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
}

.pulse-ring {
    animation: pulse-ring 2.5s infinite cubic-bezier(0.4, 0, 0.6, 1);
}

/* Shimmer Loading / Luxury Shine */
.shine-hover {
    position: relative;
    overflow: hidden;
}

.shine-hover::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -60%;
    width: 20%;
    height: 200%;
    background: linear-gradient(
        60deg,
        rgba(255, 255, 255, 0) 20%,
        rgba(255, 255, 255, 0.25) 50%,
        rgba(255, 255, 255, 0) 80%
    );
    transform: rotate(25deg);
    transition: all 0.75s ease;
}

.shine-hover:hover::after {
    left: 140%;
}

/* Range input styling for Installment Calculator */
input[type=range] {
    -webkit-appearance: none;
    appearance: none;
    background: #334155;
    height: 6px;
    border-radius: 9999px;
    outline: none;
}
.light input[type=range] {
    background: #cbd5e1;
    cursor: pointer;
}
input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #ef4444;
    cursor: pointer;
    box-shadow: 0 0 10px rgba(239, 68, 68, 0.6);
    transition: transform 0.15s ease;
}
input[type=range]::-webkit-slider-thumb:hover {
    transform: scale(1.2);
}

/* Brand Filter Pills */
.brand-pill {
    transition: all 0.2s ease;
    user-select: none;
}
.brand-pill.active {
    background: #ef4444 !important;
    color: #ffffff !important;
    border-color: #ef4444 !important;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
}
.light .brand-pill:not(.active) {
    background: #ffffff;
    color: #334155;
    border-color: #e2e8f0;
}
.light .brand-pill:not(.active):hover {
    border-color: #ef4444;
    color: #dc2626;
}

/* Category Filter Pills */
.cat-pill {
    transition: all 0.2s ease;
}
.cat-pill.active {
    background: #ef4444 !important;
    color: #ffffff !important;
    border-color: #ef4444 !important;
}
.light .cat-pill:not(.active) {
    background: #ffffff;
    color: #334155;
    border-color: #e2e8f0;
}
.light .cat-pill:not(.active):hover {
    background: #f8fafc;
    color: #dc2626;
}

/* Custom Dropdown Animation */
.nav-group:hover .dropdown-menu {
    display: block;
    animation: fadeInSlide 0.25s ease forwards;
}

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
```

### file schema.sql:
```sql
CREATE DATABASE IF NOT EXISTS web_ban_xe DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE web_ban_xe;

DROP TABLE IF EXISTS cars;

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    image VARCHAR(255) DEFAULT 'default.jpg',
    engine VARCHAR(100),
    transmission VARCHAR(100),
    fuel VARCHAR(50),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bot_knowledge (
    id INT AUTO_INCREMENT PRIMARY KEY,
    keywords VARCHAR(255) NOT NULL,
    response TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng lưu lịch đăng ký lái thử & yêu cầu tư vấn
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    car_name VARCHAR(255) NOT NULL,
    booking_date VARCHAR(50) DEFAULT NULL,
    note TEXT DEFAULT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng lưu đơn đặt cọc giữ xe qua VietQR
CREATE TABLE IF NOT EXISTS deposits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_name VARCHAR(255) NOT NULL,
    car_price DECIMAL(15,2) NOT NULL,
    memo VARCHAR(100) NOT NULL,
    customer_name VARCHAR(150) DEFAULT 'Khách đặt online',
    customer_phone VARCHAR(20) DEFAULT '',
    status ENUM('pending', 'verified', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password) VALUES
('admin', 'admin123')
ON DUPLICATE KEY UPDATE username=username;

INSERT INTO bot_knowledge (keywords, response) VALUES
('gia, bao nhieu, chi phi', 'Giá các dòng xe tại Showroom 4TL dao động từ 240 triệu (VinFast VF3) đến hơn 19 tỷ VNĐ (Ferrari F8 Tributo).'),
('bao hanh, dich vu', 'Tất cả siêu xe và xe sang bán ra đều bảo hành 3 - 10 năm chính hãng, cam kết kiểm định 160 bước không đâm đụng, không ngập nước.'),
('tra gop, vay', 'Showroom 4TL hỗ trợ trả góp qua ngân hàng lên đến 80% giá trị xe trong thời gian tối đa 7 năm với lãi suất ưu đãi chỉ từ 7.5%/năm.');

INSERT INTO cars (name, brand, price, image, engine, transmission, fuel, description) VALUES
-- Dữ liệu ban đầu
('VinFast VF3', 'VinFast', 240000000.00, 'https://vinfastquan12.com.vn/wp-content/uploads/2025/02/VinFast_VF3_Mau_trang.webp', 'Điện đơn', 'Tự động', 'Điện', 'Mẫu xe điện đô thị mini màu trắng thời thượng, là tâm điểm bán chạy nhất (Best Seller) tại Showroom 4TL.'),
('Mercedes-Benz C-Class C300', 'Mercedes-Benz', 2099000000.00, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800', '2.0L Turbo', 'Tự động 9 cấp', 'Xăng', 'Dòng xe sang ấn tượng, trang bị hiện đại tại Showroom 4TL.'),
('Porsche 911 Carrera S', 'Porsche', 8500000000.00, 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800', '3.0L Twin-Turbo', 'Tự động 8 cấp PDK', 'Xăng', 'Mẫu xe thể thao huyền thoại mang lại cảm giác lái đỉnh cao.'),
('Mercedes-AMG G63', 'Mercedes-Benz', 11750000000.00, 'https://images.unsplash.com/photo-1520050206274-a1ae44613e6d?w=800', '585 mã lực', 'Tự động 9 cấp AMG', 'Xăng', 'Mẫu SUV địa hình hạng sang đẳng cấp biểu tượng.'),
('BMW 740i Pure Excellence', 'BMW', 4699000000.00, 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800', '381 mã lực', 'Tự động 8 cấp Steptronic', 'Xăng Mild-Hybrid', 'Sedan hạng sang cao cấp đầy công nghệ của BMW.'),
('VinFast VF8 Plus', 'VinFast', 1270000000.00, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800', 'Điện đôi (402 HP)', 'Tự động', 'Điện', 'SUV điện phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái thông minh ADAS.'),
('VinFast VF5 Plus', 'VinFast', 468000000.00, 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800', 'Điện đơn (134 HP)', 'Tự động', 'Điện', 'Mẫu A-SUV chạy điện nhỏ gọn, tối ưu cho nhu cầu di chuyển đô thị hàng ngày.'),
('Toyota Camry 2.5Q', 'Toyota', 1405000000.00, 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800', '2.5L 4-cylinders', 'Tự động 8 cấp', 'Xăng', 'Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái.'),
('Toyota Corolla Cross 1.8HEV', 'Toyota', 905000000.00, 'https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800', '1.8L Hybrid', 'Vô cấp e-CVT', 'Xăng Hybrid', 'SUV đô thị tiết kiệm nhiên liệu tối ưu với động cơ Hybrid tiên tiến.'),
('Ford Ranger Raptor 3.0 V6', 'Ford', 1299000000.00, 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800', '3.0L V6 Twin-Turbo', 'Tự động 10 cấp', 'Xăng', 'Vua bán tải hiệu năng cao, trang bị phuộc FOX trượt địa hình chuyên nghiệp.'),
('Ford Everest Titanium+ 4x4', 'Ford', 1468000000.00, 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800', '2.0L Bi-Turbo', 'Tự động 10 cấp', 'Dầu (Diesel)', 'SUV 7 chỗ hầm hố, cách âm tốt và giàu công nghệ an toàn hàng đầu.'),
('Hyundai Tucson 2.0 Diesel', 'Hyundai', 959000000.00, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800', '2.0L Smartstream', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Crossover thiết kế táo bạo, vận hành bốc và tiết kiệm nhiên liệu.'),
('Hyundai Accent 1.5 AT', 'Hyundai', 489000000.00, 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800', '1.5L MPi', 'Vô cấp iVT', 'Xăng', 'Sedan hạng B phổ thông, tiện nghi phong phú trong tầm giá.'),
('Honda CR-V e:HEV RS', 'Honda', 1259000000.00, 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800', '2.0L Hybrid', 'Vô cấp e-CVT', 'Xăng Hybrid', 'SUV 5 chỗ thể thao, trải nghiệm lái phấn khích chuẩn Honda Sensing.'),
('Mazda CX-5 2.0 Premium', 'Mazda', 829000000.00, 'https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?w=800', '2.0L SkyActiv-G', 'Tự động 6 cấp', 'Xăng', 'Mẫu Crossover bán chạy nhất phân khúc nhờ thiết kế KODO tinh tế.'),
('Kia Carnival 2.2D Signature', 'Kia', 1759000000.00, 'https://images.unsplash.com/photo-1563720223185-11003d516935?w=800', '2.2L Smartstream', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Xe gia đình hạng sang (MPV) rộng rãi, trang bị đầy đủ như một khoang thương gia.'),
('Audi Q7 45 TFSI quattro', 'Audi', 3700000000.00, 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800', '2.0L Turbo', 'Tự động 8 cấp Tiptronic', 'Xăng', 'SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian danh tiếng.'),
('Lexus RX350 Luxury', 'Lexus', 4330000000.00, 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800', '2.4L Turbo', 'Tự động 8 cấp', 'Xăng', 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt.'),
('Lamborghini Urus S', 'Lamborghini', 16500000000.00, 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800', '4.0L V8 Twin-Turbo', 'Tự động 8 cấp', 'Xăng', 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây.'),
('Ferrari F8 Tributo', 'Ferrari', 19000000000.00, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800', '3.9L V8 Twin-Turbo', 'Tự động 7 cấp ly hợp kép', 'Xăng', 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm.');
```

### file save_order.php:
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data || !isset($data['type'])) {
    echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

$type = $data['type'];

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    if ($type === 'booking') {
        $name = trim($data['name'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $car = trim($data['car'] ?? 'Chưa chọn xe');
        $date = trim($data['date'] ?? date('Y-m-d'));
        $note = trim($data['note'] ?? 'Đăng ký lái thử từ website');

        if (empty($name) || empty($phone)) {
            echo json_encode(["status" => "error", "message" => "Vui lòng nhập tên và số điện thoại"], JSON_UNESCAPED_UNICODE);
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO bookings (customer_name, phone, car_name, booking_date, note) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $phone, $car, $date, $note]);

        echo json_encode(["status" => "success", "message" => "Đã lưu lịch hẹn lái thử vào hệ thống!"], JSON_UNESCAPED_UNICODE);

    } elseif ($type === 'deposit') {
        $carName = trim($data['car_name'] ?? '');
        $carPrice = floatval($data['car_price'] ?? 0);
        $memo = trim($data['memo'] ?? 'COC XE 4TL');
        $cusName = trim($data['customer_name'] ?? 'Khách quét QR');
        $cusPhone = trim($data['customer_phone'] ?? '');

        $stmt = $pdo->prepare("INSERT INTO deposits (car_name, car_price, memo, customer_name, customer_phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$carName, $carPrice, $memo, $cusName, $cusPhone]);

        echo json_encode(["status" => "success", "message" => "Đã ghi nhận giao dịch đặt cọc!"], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi hệ thống: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>
```

### file manage_orders.php:
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if (!$pdo) {
    echo json_encode(["bookings" => [], "deposits" => []], JSON_UNESCAPED_UNICODE);
    exit();
}

$action = $_GET['action'] ?? 'list';

try {
    if ($action === 'list') {
        $bookings = $pdo->query("SELECT * FROM bookings ORDER BY id DESC")->fetchAll();
        $deposits = $pdo->query("SELECT * FROM deposits ORDER BY id DESC")->fetchAll();
        echo json_encode(["bookings" => $bookings, "deposits" => $deposits], JSON_UNESCAPED_UNICODE);

    } elseif ($action === 'update_status') {
        $table = (($_GET['table'] ?? '') === 'deposits') ? 'deposits' : 'bookings';
        $id = intval($_GET['id'] ?? 0);
        $status = $_GET['status'] ?? 'pending';

        $stmt = $pdo->prepare("UPDATE {$table} SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        echo json_encode(["status" => "success"], JSON_UNESCAPED_UNICODE);

    } elseif ($action === 'delete') {
        $table = (($_GET['table'] ?? '') === 'deposits') ? 'deposits' : 'bookings';
        $id = intval($_GET['id'] ?? 0);

        $stmt = $pdo->prepare("DELETE FROM {$table} WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["status" => "success"], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>
```
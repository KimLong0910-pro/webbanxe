# Đây là đồ án web bán xe.
## Hiện tại đây là code tôi có. 
**Tôi sẽ tổng hợp các file code ở đây cho bạn nắm thông tin dự án của tôi:**

```bash
webbanxe/
├── .gitignore                          # Quy tắc bỏ qua tệp khi dùng Git
├── README.md                            # Giới thiệu và ghi chú dự án
├── css/
│   └── style.css                        # Kiểu dáng dùng chung cho website
├── html/
│   ├── admin.html                       # Trang quản trị xe và đơn hàng
│   ├── car_collection.html              # Trang danh sách, lọc và so sánh xe
│   ├── bot_train.html                   # Giao diện chatbot tư vấn xe
│   ├── detail.html                      # Trang thông tin chi tiết xe
│   ├── login.html                       # Trang đăng nhập quản trị
|   ├── orders_history.html              # Ghi lại lịch sử đơn hàng và tiến độ
│   └── train_bot.html                   # Trang quản lý dữ liệu huấn luyện chatbot
├── images/
│   └── qrcode.jpg                       # Mã QR đặt cọc
├── index.html                           # Trang chủ showroom
├── js/
│   └── theme.js                         # Cấu hình giao diện và tiện ích dùng chung
├── php/
│   ├── add_car.php                      # Thêm xe vào cơ sở dữ liệu
│   ├── auth_check.php                   # Kiểm tra phiên đăng nhập quản trị
│   ├── bot_train.php                    # Xử lý câu hỏi và phản hồi chatbot
│   ├── db.php                           # Kết nối và khởi tạo cơ sở dữ liệu
│   ├── delete_car.php                   # Xóa xe khỏi cơ sở dữ liệu
│   ├── edit_car.php                     # Cập nhật thông tin xe
│   ├── get_cars.php                     # Lấy danh sách xe
│   ├── login.php                        # Xác thực tài khoản quản trị
│   ├── logout.php                       # Đăng xuất quản trị
│   ├── manage_orders.php                # Quản lý lịch hẹn và đơn đặt cọc
│   ├── save_order.php                   # Lưu lịch hẹn và thông tin đặt cọc
|   ├── get_customer_orders.php         
│   └── train_bot.php                    # Quản lý dữ liệu huấn luyện chatbot
├── sql/
│   └── schema.sql                       # Tạo bảng và nạp dữ liệu mẫu
└── thongtinxe.md                        # Thông số và mô tả các mẫu xe
```

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
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&family=Montserrat:wght@600;700;800;900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="js/theme.js"></script>
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body
    class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 transition-colors duration-300 min-h-screen selection:bg-indigo-600 selection:text-white">
    <!-- KHUNG CHỨA TOAST -->
    <div
      id="toastContainer"
      class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex flex-col items-center gap-2 pointer-events-none"></div>

    <!-- TOP PROMOTION BAR -->
    <div
      class="bg-gradient-to-r from-indigo-900 via-indigo-600 to-indigo-900 text-white text-xs font-semibold py-2 px-4 text-center tracking-wide border-b border-indigo-500/30 flex items-center justify-center gap-2">
      <span class="inline-block px-2 py-0.5 bg-black/40 rounded-full text-[10px] uppercase font-bold text-yellow-300">
        Ưu Đãi Đặc Biệt
      </span>
      <span>Tặng gói bảo hiểm thân vỏ 2 năm + Gói phủ Ceramic VIP khi cọc xe online trong tháng</span>
      <a href="html/car_collection.html" class="underline ml-2 hover:text-yellow-200">Khám Phá Ngay &rarr;</a>
    </div>

    <!-- MAIN HEADER / NAVBAR -->
    <header
      class="sticky top-0 z-40 bg-white/85 dark:bg-slate-950/85 backdrop-blur-xl border-b border-gray-200/80 dark:border-white/10 px-4 md:px-8 py-3.5 transition-all duration-300 shadow-sm dark:shadow-none">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="index.html" class="flex items-center gap-3 group">
          <div
            class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-indigo-900 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30 group-hover:scale-105 transition duration-300">
            <i class="fa-solid fa-shield-halved text-lg"></i>
          </div>
          <div>
            <div
              class="text-2xl font-black tracking-wider text-slate-900 dark:text-white font-heading leading-none flex items-center gap-1">
              4TL
              <span class="text-indigo-600 dark:text-indigo-500">MOTORS</span>
            </div>
            <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 tracking-widest uppercase">
              Supercar & Luxury
            </span>
          </div>
        </a>

        <!-- Navigation Links -->
        <nav
          class="hidden lg:flex items-center gap-6 text-sm font-semibold text-gray-600 dark:text-gray-300 whitespace-nowrap">
          <a
            href="index.html"
            class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-500 transition flex items-center gap-1.5">
            <i class="fa-solid fa-house text-xs"></i>
            Trang Chủ
          </a>
          <a
            href="html/car_collection.html"
            class="hover:text-indigo-600 dark:hover:text-indigo-400 transition flex items-center gap-1.5">
            <i class="fa-solid fa-car text-xs"></i>
            Bộ Sưu Tập Xe
          </a>
          <a
            href="#loan-calculator"
            class="hover:text-indigo-600 dark:hover:text-indigo-400 transition flex items-center gap-1.5">
            <i class="fa-solid fa-calculator text-xs"></i>
            Dự Toán Trả Góp
          </a>
          <!-- Comparison Nav Link -->
          <a
            href="#map-section"
            class="hover:text-indigo-600 dark:hover:text-indigo-400 transition flex items-center gap-1.5">
            <i class="fa-solid fa-map-location-dot text-xs"></i>
            Showroom
          </a>
          <a
            href="html/orders_history.html"
            class="hover:text-indigo-600 dark:hover:text-indigo-400 transition flex items-center gap-1.5">
            <i class="fa-solid fa-clock-rotate-left text-xs text-indigo-500"></i>
            Đơn Của Tôi
          </a>
          <a
            href="html/admin.html"
            class="text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-yellow-400 transition flex items-center gap-1 text-xs px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10">
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
            href="tel:0765650114"
            class="shine-hover relative group bg-gradient-to-r from-indigo-600 to-violet-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold px-4 py-2 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-lg shadow-indigo-600/25 transition">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <i class="fa-solid fa-phone-volume"></i>
            <span class="hidden sm:inline">0765.650.114</span>
            <span class="sm:hidden">Gọi VIP</span>
          </a>
        </div>
      </div>
    </header>

    <!-- HERO SECTION (CHIA 2 CỘT CÂN ĐỐI: TRÁI GIỚI THIỆU - PHẢI THÔNG SỐ & CTA) -->
    <!-- HERO SECTION (BỐ CỤC 2 CỘT CHUẨN UX/UI) -->
    <section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28">
      <!-- Hiệu ứng ánh sáng nền (Ambient Glow) -->
      <div
        class="pointer-events-none absolute -top-24 -left-24 h-96 w-96 rounded-full bg-indigo-600/20 blur-[120px]"></div>
      <div
        class="pointer-events-none absolute top-1/3 right-0 h-80 w-80 rounded-full bg-purple-600/15 blur-[120px]"></div>

      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-12 lg:gap-10">
          <!-- CỘT TRÁI (7/12): TIÊU ĐỀ, CTA & CHỈ SỐ CAM KẾT -->
          <div class="lg:col-span-7">
            <!-- Badge nhỏ phía trên -->
            <div
              class="mb-6 inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-4 py-1.5 backdrop-blur-md">
              <span class="text-xs font-semibold tracking-wider text-indigo-400 uppercase">
                ⚡ SHOWROOM SIÊU XE &amp; XE SANG UY TÍN HÀNG ĐẦU
              </span>
            </div>

            <!-- Tiêu đề chính (Đã tối ưu kích thước chữ để không bị rớt dòng lẻ) -->
            <h1
              class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl xl:text-[54px] xl:leading-[1.15]">
              ĐẲNG CẤP
              <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-indigo-400 bg-clip-text text-transparent">
                THƯỢNG LƯU
              </span>
              <br class="hidden sm:inline" />
              BỨT PHÁ MỌI GIỚI HẠN
            </h1>

            <!-- Mô tả ngắn -->
            <p class="mt-6 max-w-2xl text-base leading-relaxed text-slate-600 dark:text-slate-300 sm:text-lg">
              Khám phá bộ sưu tập hơn
              <strong class="font-semibold text-slate-900 dark:text-white">
                50+ siêu xe thể thao, SUV cao cấp &amp; xe điện thế hệ mới
              </strong>
              sẵn sàng bàn giao trong 24h. Cam kết kiểm định 160 bước nghiêm ngặt, hỗ trợ trả góp đến 80%.
            </p>

            <!-- Cụm 3 nút hành động (CTA) -->
            <div class="mt-8 flex flex-wrap items-center gap-4">
              <!-- Nút chính -->
              <a
                href="html/car_collection.html"
                class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition-all duration-300 hover:scale-[1.02] hover:from-indigo-500 hover:to-purple-500">
                <span>Khám Phá Bộ Sưu Tập</span>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </a>

              <!-- Nút phụ (Dự toán trả góp) -->
              <a
                href="#loan-calculator"
                class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white/70 px-6 py-3.5 text-sm font-semibold text-slate-800 backdrop-blur-md transition-all duration-300 hover:bg-slate-100 dark:border-white/15 dark:bg-white/5 dark:text-white dark:hover:bg-white/10">
                <svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span>Dự Toán Trả Góp</span>
              </a>

              <!-- Link phụ (Đăng ký lái thử) -->
              <button
                onclick="openBookingModal('Tất cả mẫu xe')"
                class="inline-flex items-center gap-1.5 px-2 py-2 text-sm font-medium text-slate-500 underline-offset-4 transition-colors hover:text-indigo-500 hover:underline dark:text-slate-400 dark:hover:text-indigo-300">
                <span>Đăng ký lái thử tận nhà &rarr;</span>
              </button>
            </div>

            <!-- Đường kẻ phân cách mờ -->
            <div
              class="my-9 h-px w-full bg-gradient-to-r from-slate-200 via-slate-300 to-transparent dark:from-white/15 dark:via-white/10 dark:to-transparent"></div>

            <!-- Hàng 4 chỉ số cam kết phía dưới -->
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-4">
              <div>
                <div class="text-2xl font-extrabold text-slate-900 dark:text-white sm:text-3xl">50+</div>
                <div class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-400">Siêu xe có sẵn</div>
              </div>
              <div>
                <div
                  class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-2xl font-extrabold text-transparent sm:text-3xl">
                  100%
                </div>
                <div class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-400">Kiểm định chính hãng</div>
              </div>
              <div>
                <div class="text-2xl font-extrabold text-slate-900 dark:text-white sm:text-3xl">80%</div>
                <div class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-400">Hỗ trợ vay trả góp</div>
              </div>
              <div>
                <div
                  class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-2xl font-extrabold text-transparent sm:text-3xl">
                  24/7
                </div>
                <div class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-400">Cứu hộ &amp; Giao xe VIP</div>
              </div>
            </div>
          </div>

          <!-- CỘT PHẢI (5/12): CARD XE SPOTLIGHT NỔI BẬT -->
          <div class="lg:col-span-5">
            <a
              href="html/detail.html?id=3"
              class="group relative block overflow-hidden rounded-3xl border border-slate-200/80 bg-slate-900 shadow-2xl shadow-indigo-950/40 transition-all duration-500 hover:-translate-y-1.5 hover:border-indigo-500/50 dark:border-white/15">
              <!-- Ảnh xe tỷ lệ vuông/4:3 lớn -->
              <div class="relative aspect-[4/3] w-full overflow-hidden">
                <img
                  src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?w=800"
                  alt="Porsche 911 Carrera S"
                  class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />

                <!-- Lớp phủ gradient tối dần ở đáy để làm nổi chữ -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/35 to-transparent"></div>

                <!-- Nhãn góc trên trái -->
                <div
                  class="absolute top-4 left-4 inline-flex items-center gap-1.5 rounded-full bg-indigo-600/90 px-3.5 py-1 text-[11px] font-bold tracking-wider text-white uppercase shadow-md backdrop-blur-md">
                  <span>★ SPOTLIGHT MỚI VỀ</span>
                </div>
              </div>

              <!-- Khung thông tin Glassmorphism ở đáy card -->
              <div
                class="relative -mt-20 mx-3 mb-3 rounded-2xl border border-white/15 bg-slate-950/75 p-5 backdrop-blur-xl">
                <div class="flex items-end justify-between gap-4">
                  <div>
                    <p class="text-[11px] font-bold tracking-widest text-indigo-400 uppercase">PORSCHE SERIES</p>
                    <h2 class="mt-0.5 text-xl font-bold text-white sm:text-2xl">Porsche 911 Carrera S</h2>
                    <p class="mt-1.5 text-xs text-slate-300">
                      0-100 km/h: 3.7s
                      <span class="mx-1 text-slate-500">|</span>
                      450 HP
                      <span class="mx-1 text-slate-500">|</span>
                      Hộp số PDK 8 cấp
                    </p>
                  </div>

                  <div class="text-right shrink-0">
                    <span class="block text-[11px] text-slate-400">Giá niêm yết</span>
                    <span class="text-lg font-extrabold text-indigo-400 sm:text-xl">8,5 Tỷ VNĐ</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- INTERACTIVE INSTALLMENT / LOAN CALCULATOR -->
    <section id="loan-calculator" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div
        class="glass-panel p-6 sm:p-10 rounded-3xl border border-gray-200 dark:border-indigo-500/20 relative overflow-hidden shadow-2xl">
        <!-- Ambient Glow -->
        <div
          class="absolute -right-20 -bottom-20 w-80 h-80 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="text-center max-w-2xl mx-auto mb-8">
          <span
            class="text-xs font-bold text-indigo-600 dark:text-indigo-500 tracking-widest uppercase flex items-center justify-center gap-1.5">
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
                  class="px-3.5 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500">
                  <option value="">-- Chọn xe có sẵn --</option>
                </select>
                <div class="relative">
                  <input
                    type="number"
                    id="calcPriceInput"
                    value="2000000000"
                    step="50000000"
                    oninput="calculateLoan()"
                    class="w-full px-3.5 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500" />
                  <span class="absolute right-3.5 top-3 text-xs text-gray-400 font-bold">VNĐ</span>
                </div>
              </div>
            </div>

            <!-- Prepayment Percentage Slider -->
            <div class="space-y-2">
              <div class="flex justify-between items-center text-sm font-semibold">
                <span class="text-gray-700 dark:text-gray-300">Tỷ lệ trả trước:</span>
                <span class="text-indigo-600 dark:text-indigo-400 font-bold" id="calcDownPercentLabel">
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
                step="1"
                value="20"
                oninput="calculateLoan()"
                class="w-full" />
              <div class="relative h-4 text-[11px] text-gray-400">
                <span class="absolute left-0">10% (Tối thiểu)</span>
                <span class="absolute left-[28.57%] -translate-x-1/2">30%</span>
                <span class="absolute left-[57.14%] -translate-x-1/2">50%</span>
                <span class="absolute right-0">80%</span>
              </div>
            </div>

            <!-- Loan Term Slider -->
            <div class="space-y-2">
              <div class="flex justify-between items-center text-sm font-semibold">
                <span class="text-gray-700 dark:text-gray-300">Thời hạn vay:</span>
                <span class="text-indigo-600 dark:text-indigo-400 font-bold" id="calcMonthsLabel">
                  60 tháng (5 năm)
                </span>
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
                <span class="text-indigo-600 dark:text-indigo-400 font-bold" id="calcInterestLabel">8.5% / năm</span>
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
            class="lg:col-span-5 glass-card bg-gradient-to-b from-indigo-50/90 via-white/95 to-purple-50/80 dark:from-indigo-950/50 dark:via-slate-900/60 dark:to-purple-950/40 p-6 sm:p-8 rounded-3xl border border-indigo-200 dark:border-indigo-500/30 space-y-6 shadow-xl">
            <div class="border-b border-gray-200 dark:border-white/10 pb-4">
              <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider">
                Ước tính trả hàng tháng (Gốc + Lãi)
              </span>
              <div
                class="text-3xl sm:text-4xl font-black text-indigo-600 dark:text-indigo-400 font-heading mt-1"
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
                class="w-full bg-indigo-600 hover:bg-violet-700 text-white font-bold py-3.5 rounded-2xl text-sm transition shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2">
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
          class="text-xs font-bold text-indigo-600 dark:text-indigo-500 tracking-widest uppercase flex items-center justify-center gap-1.5">
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
            class="w-12 h-12 rounded-2xl bg-indigo-600/10 border border-indigo-500/20 text-indigo-600 dark:text-indigo-500 flex items-center justify-center text-xl">
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
            class="w-12 h-12 rounded-2xl bg-indigo-600/10 border border-indigo-500/20 text-indigo-600 dark:text-indigo-500 flex items-center justify-center text-xl">
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
            class="w-12 h-12 rounded-2xl bg-indigo-600/10 border border-indigo-500/20 text-indigo-600 dark:text-indigo-500 flex items-center justify-center text-xl">
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
            class="w-12 h-12 rounded-2xl bg-indigo-600/10 border border-indigo-500/20 text-indigo-600 dark:text-indigo-500 flex items-center justify-center text-xl">
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
          class="text-xs font-bold text-indigo-600 dark:text-indigo-500 tracking-widest uppercase flex items-center justify-center gap-1.5">
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
              class="w-10 h-10 rounded-full object-cover border border-indigo-500" />
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
              class="w-10 h-10 rounded-full object-cover border border-indigo-500" />
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
              class="w-10 h-10 rounded-full object-cover border border-indigo-500" />
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
                class="text-xs font-bold text-indigo-600 dark:text-indigo-500 tracking-widest uppercase flex items-center gap-1.5">
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
                <i class="fa-solid fa-map-pin text-indigo-600 dark:text-indigo-500 mt-1"></i>
                <span>99 Nguyễn Lương Bằng, Phường Tân Phú, Quận 7, TP. Hồ Chí Minh</span>
              </div>
              <div class="flex items-center gap-3">
                <i class="fa-solid fa-clock text-indigo-600 dark:text-indigo-500"></i>
                <span>Giờ mở cửa: 08:00 - 20:30 (Tất cả các ngày trong tuần)</span>
              </div>
              <div class="flex items-center gap-3">
                <i class="fa-solid fa-phone text-indigo-600 dark:text-indigo-500"></i>
                <span>
                  Hotline Bán Hàng:
                  <strong class="text-slate-900 dark:text-white">0765.650.114</strong>
                </span>
              </div>
              <div class="flex items-center gap-3">
                <i class="fa-solid fa-envelope text-indigo-600 dark:text-indigo-500"></i>
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
                  class="w-full px-3 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
                <input
                  type="tel"
                  id="drivePhone"
                  placeholder="Số điện thoại liên hệ"
                  required
                  class="w-full px-3 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
                <select
                  id="driveCar"
                  class="w-full px-3 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500">
                  <option value="Chưa chọn xe">Chọn mẫu xe quan tâm</option>
                </select>
                <button
                  type="submit"
                  class="w-full bg-indigo-600 hover:bg-violet-700 text-white font-bold py-2.5 rounded-xl text-xs transition">
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
              <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold">
                <i class="fa-solid fa-shield-halved"></i>
              </div>
              <span class="text-xl font-black text-white font-heading tracking-wider">SHOWROOM 4TL</span>
            </a>
            <p class="text-xs leading-relaxed max-w-sm text-gray-400">
              Đại lý độc lập phân phối các dòng siêu xe thể thao, SUV cao cấp và xe điện hàng đầu tại Việt Nam. Cam kết
              chất lượng chuẩn quốc tế, nâng tầm phong cách sống thượng lưu.
            </p>
            <!-- FOOTER -->
            <div class="flex items-center gap-3 pt-2">
              <!-- Facebook -->
              <a
                href="https://www.facebook.com/reel/1642467180766930"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Facebook Showroom 4TL"
                class="w-8 h-8 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center hover:text-indigo-400 hover:border-indigo-500 transition">
                <i class="fa-brands fa-facebook-f"></i>
              </a>

              <!-- YouTube -->
              <a
                href="https://youtube.com/shorts/_6HzLIJPH2A?si=6ImBgPEFHYw8e5pb"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="YouTube Showroom 4TL"
                class="w-8 h-8 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center hover:text-indigo-400 hover:border-indigo-500 transition">
                <i class="fa-brands fa-youtube"></i>
              </a>

              <!-- TikTok -->
              <a
                href="https://www.tiktok.com/@thanh_ne_troi/video/7687223237138189588?is_from_webapp=1&sender_device=pc&web_id=7709105540550477333"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="TikTok Showroom 4TL"
                class="w-8 h-8 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center hover:text-indigo-400 hover:border-indigo-500 transition">
                <i class="fa-brands fa-tiktok"></i>
              </a>

              <!-- Instagram -->
              <a
                href="https://www.instagram.com/reel/Db958Q4S4u1/?cplk=djB3N3ByZWFwMjJn"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Instagram Showroom 4TL"
                class="w-8 h-8 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center hover:text-indigo-400 hover:border-indigo-500 transition">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Col 2: Dòng xe -->
          <div class="space-y-3">
            <h4 class="text-white font-bold uppercase text-xs tracking-wider">Dòng Xe Bán Chạy</h4>
            <ul class="space-y-2">
              <li>
                <a href="html/car_collection.html" class="hover:text-indigo-400 transition">Porsche 911 Series</a>
              </li>
              <li>
                <a href="html/car_collection.html" class="hover:text-indigo-400 transition">Mercedes-AMG G63</a>
              </li>
              <li>
                <a href="html/car_collection.html" class="hover:text-indigo-400 transition">VinFast VF3 & VF8</a>
              </li>
              <li>
                <a href="html/car_collection.html" class="hover:text-indigo-400 transition">Ferrari F8 Tributo</a>
              </li>
              <li>
                <a href="html/car_collection.html" class="hover:text-indigo-400 transition">BMW 7-Series</a>
              </li>
            </ul>
          </div>

          <!-- Col 3: Dịch vụ -->
          <div class="space-y-3">
            <h4 class="text-white font-bold uppercase text-xs tracking-wider">Dịch Vụ Khách Hàng</h4>
            <ul class="space-y-2">
              <li><a href="#loan-calculator" class="hover:text-indigo-400 transition">Dự toán trả góp ngân hàng</a></li>
              <li>
                <a href="#services-section" class="hover:text-indigo-400 transition">Kiểm định 160 bước chính hãng</a>
              </li>
              <li><a href="#map-section" class="hover:text-indigo-400 transition">Đặt hẹn lái thử tận nơi</a></li>
              <li>
                <a
                  href="#"
                  onclick="
                    showToast('Hotline cứu hộ khẩn cấp: 1900.8888 (24/7)', 'success');
                    return false;
                  "
                  class="hover:text-indigo-400 transition">
                  Cứu hộ xe 24/7 toàn quốc
                </a>
              </li>
              <li><a href="html/admin.html" class="hover:text-yellow-400 transition">Cổng quản trị nội bộ</a></li>
            </ul>
          </div>

          <!-- Col 4: Pháp lý -->
          <div class="space-y-3">
            <h4 class="text-white font-bold uppercase text-xs tracking-wider">Chính Sách & Hỗ Trợ</h4>
            <ul class="space-y-2">
              <li><a href="#" class="hover:text-indigo-400 transition">Chính sách bảo hành 3 năm</a></li>
              <li><a href="#" class="hover:text-indigo-400 transition">Cam kết hoàn tiền 100%</a></li>
              <li><a href="#" class="hover:text-indigo-400 transition">Chính sách bảo mật khách hàng</a></li>
              <li><a href="#" class="hover:text-indigo-400 transition">Quy trình đặt cọc giữ xe</a></li>
            </ul>
          </div>
        </div>

        <!-- Bottom Copyright -->
        <div
          class="pt-8 border-t border-gray-800 dark:border-white/10 flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left text-gray-500">
          <p>© 2026 SHOWROOM 4TL. Bản quyền phát triển bởi Sinh viên ĐH Văn Lang.</p>
          <div class="flex gap-4">
            <span>Đẳng Cấp • Minh Bạch • Tận Tâm • Thanh Lịch</span>
          </div>
        </div>
      </div>
    </footer>

    <!-- STICKY COMPARISON DOCK (Appears when >= 1 car is selected) -->

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
        class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-3xl max-w-sm w-full p-6 text-center relative shadow-2xl border border-gray-200 dark:border-indigo-500/30 space-y-4">
        <button
          onclick="closeModal('qrModal')"
          class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition">
          ✕
        </button>

        <div
          class="w-12 h-12 rounded-full bg-indigo-600/10 dark:bg-indigo-600/20 text-indigo-600 dark:text-indigo-500 mx-auto flex items-center justify-center text-xl">
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
            <strong class="text-indigo-600 dark:text-indigo-400 font-mono tracking-wider">0765650114</strong>
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
            class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          <input
            type="tel"
            id="qrCustomerPhone"
            placeholder="Số điện thoại xác nhận *"
            class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
        </div>

        <button
          onclick="confirmDepositSuccess()"
          class="w-full bg-indigo-600 hover:bg-violet-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-md shadow-indigo-600/30">
          <i class="fa-solid fa-circle-check mr-1.5"></i>
          Tôi Đã Hoàn Tất Chuyển Khoản
        </button>
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
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-600 dark:text-gray-400 mb-1">Số điện thoại liên hệ</label>
            <input
              type="tel"
              id="modalBookingPhone"
              required
              placeholder="0900.xxx.xxx"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-600 dark:text-gray-400 mb-1">Thời gian dự kiến</label>
            <input
              type="date"
              id="modalBookingDate"
              required
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <button
            type="submit"
            class="w-full bg-indigo-600 hover:bg-violet-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-lg shadow-indigo-600/30">
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
        class="relative pulse-ring w-14 h-14 bg-gradient-to-tr from-indigo-600 to-indigo-500 text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition duration-300 group cursor-pointer">
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
          class="bg-gradient-to-r from-violet-700 to-indigo-600 p-4 text-white flex justify-between items-center shadow-sm">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-white shadow-inner">
              <i class="fa-solid fa-robot"></i>
            </div>
            <div>
              <h4 class="text-sm font-bold leading-tight">4TL AI Assistant</h4>
              <span class="text-[10px] text-indigo-200 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Trực tuyến 24/7
              </span>
            </div>
          </div>
          <div class="flex items-center gap-1.5">
            <a
              href="html/bot_train.html"
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
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            ⚡ Giá VF3
          </button>
          <button
            onclick="quickPrompt('Tư vấn xe dưới 2 tỷ')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            💰 Dưới 2 tỷ
          </button>
          <button
            onclick="quickPrompt('Tư vấn thủ tục trả góp')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            💳 Trả góp
          </button>
          <button
            onclick="quickPrompt('Đăng ký lái thử xe')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
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
            class="flex-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-white/10 px-3.5 py-2.5 rounded-xl text-xs text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          <button
            onclick="sendChatMessage()"
            class="bg-indigo-600 hover:bg-violet-700 text-white px-4 py-2.5 rounded-xl font-bold text-xs transition">
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- JAVASCRIPT LOGIC & ENGINE -->
    <script>
      function showToast(message, type = "success") {
        const container = document.getElementById("toastContainer");
        if (!container) return;

        const toast = document.createElement("div");
        toast.className = `pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-2xl shadow-2xl text-xs font-bold transition-all duration-300 transform translate-y-[-20px] opacity-0 border backdrop-blur-xl ${
          type === "success"
            ? "bg-emerald-950/90 border-emerald-500/40 text-emerald-300"
            : "bg-rose-950/90 border-rose-500/40 text-rose-300"
        }`;

        toast.innerHTML = `
              <i class="fa-solid ${type === "success" ? "fa-circle-check text-emerald-400" : "fa-triangle-exclamation text-rose-400"} text-base"></i>
              <span>${escapeHtml(message)}</span>
          `;

        container.appendChild(toast);

        setTimeout(() => {
          toast.classList.remove("translate-y-[-20px]", "opacity-0");
        }, 10);

        setTimeout(() => {
          toast.classList.add("translate-y-[-20px]", "opacity-0");
          setTimeout(() => toast.remove(), 300);
        }, 3000);
      }

      // Fallback Database Cars
      const fallbackCars = [
        {
          id: 1,
          name: "VinFast VF3",
          brand: "VinFast",
          price: 240000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFJCmiv3bB_2DDesc8SnYvKr_hq-1IiNwk2YCGZKyqZA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDJ8HxL4j3SfFrNMGCvRD9bwAZjykVF3WG-Xxl5v7h9w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbsZHkDzGDsG_EspjalYDoIEN3dnHiV45pQrIns8UK3w&s=10",
          engine: "Động cơ điện đơn (Công suất 43 HP / Mô-men xoắn 110 Nm)",
          transmission: "Tự động 1 cấp",
          fuel: "Điện",
          description:
            "Cơn sốt xe điện mini đô thị tại Việt Nam! Mang phong cách thiết kế hình hộp cá tính, khỏe khoắn, khoảng sáng gầm xe cao 191mm giúp dễ dàng vượt qua các địa hình ngập nước đô thị, là mẫu xe điện bán chạy nhất (Best Seller) tại Showroom 4TL.",
        },
        {
          id: 2,
          name: "Mercedes-Benz C-Class C300 AMG",
          brand: "Mercedes-Benz",
          price: 2099000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8nJj5R87z1dpwUCcHbj1KwNTJtJBM4sYDjrEIgxRtRA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jXuoX5_WAmEuVpxNpYUIX-UtNpPa78eTAQECU9_aJQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR98khAhzlP1bBIDo7mN_uNiVMy5ExBrqfae38EzD2oBg&s=10",
          engine: "Xăng 2.0L Turbo kết hợp công nghệ EQ Boost Mild-Hybrid (258 HP / 400 Nm)",
          transmission: "Tự động 9 cấp 9G-TRONIC",
          fuel: "Xăng Mild-Hybrid",
          description:
            'Mẫu sedan thể thao mệnh danh là "tiểu S-Class" với gói trang thiết kế ngoại thất AMG Line cuốn hút, màn hình giải trí trung tâm đặt dọc 11.9 inch tích hợp MBUX thế hệ mới, cụm đèn pha thông minh Digital Light tối tân và hệ thống âm thanh vòm Burmester 3D 15 loa sống động.',
        },
        {
          id: 3,
          name: "Porsche 911 Carrera S",
          brand: "Porsche",
          price: 8500000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUGbNCOFMrr8i-ELaF9sQVPpIjPWMSJB44Ql_bo2667w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIwrpx24-3p2ImkIovLVRN_wTXP-Sr-f5Y_LXkgKJDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpMtyFyXiOJ0kzPQgcy_26PGobb5w_z8zugn9VxdYSjg&s=10",
          engine: "Xăng Boxer 6 xi-lanh 3.0L Twin-Turbo (450 HP / 530 Nm)",
          transmission: "Ly hợp kép 8 cấp PDK danh tiếng của Porsche",
          fuel: "Xăng",
          description:
            "Biểu tượng xe thể thao hiệu suất cao huyền thoại mang lại cảm giác lái thuần khiết đỉnh cao. Khả năng tăng tốc 0-100 km/h chỉ mất 3.7 giây khi trang bị gói Sport Chrono, tốc độ tối đa đạt 308 km/h, tích hợp hệ thống treo chủ động PASM và thiết kế buồng lái đậm chất xe đua Đức.",
        },
        {
          id: 4,
          name: "Mercedes-AMG G63",
          brand: "Mercedes-Benz",
          price: 11750000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9k-mmUkZkHwMhAB8bjPOA9mFIiMkV_1C-dBgyFThkTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHgJI_oRJzR0lzto9sfPraPiSShwHmuhhfQ45LX6a1lA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKEtZnRwUw07P1WR5UkpeZNNF4_2YJJY3Pyyja2xXKOw&s=10",
          engine: "Xăng V8 4.0L Biturbo AMG (585 HP / 850 Nm)",
          transmission: "Tự động thể thao 9 cấp AMG SPEEDSHIFT TCT 9G",
          fuel: "Xăng",
          description:
            "Mẫu SUV địa hình hạng sang biểu tượng uy quyền. Thiết kế khung gầm hình thang siêu cứng vững với 3 khóa vi sai độc lập có thể khóa hoàn toàn bằng điện, hệ thống ống xả thể thao đặt bên hông uy lực, nội thất da Nappa hảo hạng kết hợp hệ thống âm thanh vòm Burmester 15 loa.",
        },
        {
          id: 5,
          name: "BMW 740i Pure Excellence",
          brand: "BMW",
          price: 4699000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHMNStnEqOgN-AtfJc4ZxIl-FSqSxWD-_KPP9Zjk-BkA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10",
          engine: "Xăng 3.0L I6 TwinPower Turbo Mild-Hybrid (381 HP / 540 Nm)",
          transmission: "Tự động 8 cấp Steptronic Sport",
          fuel: "Xăng Mild-Hybrid",
          description:
            "Sedan hạng sang cỡ lớn đỉnh cao công nghệ của BMW. Không gian nội thất xa hoa với thanh pha lê tương tác BMW Interaction Bar, ghế ngồi thương gia bọc da Merino cao cấp tích hợp massage, màn hình rạp chiếu phim rạp phía sau 31.3 inch và dàn âm thanh vòm Bowers & Wilkins Diamond.",
        },
        {
          id: 6,
          name: "VinFast VF8 Plus",
          brand: "VinFast",
          price: 1270000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMgh5eFb69xZCQCeJXpE2n1sx0fIj0gMZRsLUCkF7F2Q&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2fiRyUQE2tzYAfH61XkhF-ZaRi4kbEv1pGYAd6gaKZw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnZ23dQtN4guhpS1WTpIHS2Azx4Cb_TRBVR3v3oMa8A&s=10",
          engine: "2 mô-tơ điện AWD toàn thời gian (402 HP / 620 Nm)",
          transmission: "Tự động 1 cấp",
          fuel: "Điện",
          description:
            "SUV điện thông minh phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái nâng cao ADAS. Khả năng tăng tốc ấn tượng từ 0-100 km/h dưới 5.5 giây, màn hình trung tâm tràn viền 15.6 inch tối giản, không gian rộng rãi và cửa sổ trời toàn cảnh kính lớn.",
        },
        {
          id: 7,
          name: "VinFast VF5 Plus",
          brand: "VinFast",
          price: 468000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd-uWGNUo1taSToXpQaIDCJxCi0OOXvd5SN34Va8zCgQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFGMSwMiRgj3WEsCu14j3Th0mDeFZDiTmfuN5AIyfgiA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEnAbDWJMk7kjzcYqCfHxsNLGsZ4hGodDqmC_vbKh6lw&s=10",
          engine: "Động cơ điện đơn (Công suất 134 HP / Mô-men xoắn 135 Nm)",
          transmission: "Tự động 1 cấp",
          fuel: "Điện",
          description:
            "Mẫu A-SUV chạy điện nhỏ gọn, thiết kế năng động tối ưu cho nhu cầu di chuyển đô thị hàng ngày. Tầm hoạt động hơn 300 km cho mỗi lần sạc đầy, tích hợp trợ lý ảo tiếng Việt thông minh, cảnh báo điểm mù và trang bị 6 túi khí an toàn.",
        },
        {
          id: 8,
          name: "Toyota Camry 2.5Q",
          brand: "Toyota",
          price: 1405000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYl1j8avzp_a52uX2szBu_X2g82yHbEtkqDDN0XtKJ6A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ16pL8BQW83ACdsEAsk95IbLeS0i347RmCkAbc4zGLLA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDKY-KgdZor0p_2ggyNXFiRd7VE6K5ydz31QxuOYG8w&s=10",
          engine: "Xăng Dynamic Force 2.5L (207 HP / 250 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Xăng",
          description:
            "Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái. Khoang hành khách phía sau thiết kế chuẩn doanh nhân với bệ tỳ tay tích hợp bảng điều khiển cảm ứng ngả ghế, rèm che nắng chỉnh điện, điều hòa 3 vùng độc lập và 9 loa JBL cao cấp.",
        },
        {
          id: 9,
          name: "Toyota Corolla Cross 1.8HEV",
          brand: "Toyota",
          price: 905000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpA_ZtVNe8sOc_-tGXiFue--SWAvHYn4hqdXnj1v5NYg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuPdKKZWfVIlpfJtWjiH1WDTCkzs65ZGLNbW8xdkYXA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaemDP4gzPH3lDaNIymrWag_h6ogYiqv8TLc60aEacSA&s=10",
          engine: "Xăng 1.8L kết hợp mô-tơ điện Hybrid (Tổng công suất 122 HP)",
          transmission: "Tự động vô cấp E-CVT",
          fuel: "Xăng Hybrid",
          description:
            "SUV đô thị xanh tiết kiệm nhiên liệu tối ưu nhờ công suất tự sạc Hybrid tiên tiến. Trang bị gói công nghệ an toàn Toyota Safety Sense, camera toàn cảnh 360 độ, cửa sổ trời toàn cảnh và vận hành êm ái, bền bỉ chuẩn mực.",
        },
        {
          id: 10,
          name: "Ford Ranger Raptor 3.0 V6",
          brand: "Ford",
          price: 1299000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkAP8_0fM7-es-s0TkuWfES4ERnhn3kRzgpiERtCEFyw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSX-ZqLNONfwQeU5XwtL9ZqejukswL1TpUpsr1-76jc3w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQH0fOuAoH-XV1q7BGhIXSq8KXrWfeO2ChqH9Z6Zjgvg&s=10",
          engine: "Xăng EcoBoost 3.0L V6 Twin-Turbo (397 HP / 583 Nm)",
          transmission: "Tự động 10 cấp điện tử",
          fuel: "Xăng",
          description:
            "Vua bán tải hiệu năng cao chuyên nghiệp, trang bị hệ thống giảm xóc FOX Live Valve 2.5 inch trượt địa hình. Sở hữu 7 chế độ lái linh hoạt (bao gồm chế độ Baja chuyên đua sa mạc), hệ thống khóa vi sai trước/sau và ống xả thể thao điều chỉnh độ vang.",
        },
        {
          id: 11,
          name: "Ford Everest Titanium+ 4x4",
          brand: "Ford",
          price: 1468000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiZtZyv9cLXgHdi-7v-PjeTIL5tGeeU3tpnMYplS6XDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTYj1liAKQcUeUhRU01jidOFrEQonbqh2FvYukozZM4w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfRprvZIOazCuK7ZgS3R8vKBIHAlTpdmYSX9Y03eOZBw&s=10",
          engine: "Bi-Turbo Diesel 2.0L i4 (210 HP / 500 Nm)",
          transmission: "Tự động 10 cấp điện tử",
          fuel: "Dầu (Diesel)",
          description:
            "SUV 7 chỗ gầm cao hầm hố, khả năng cách âm đỉnh cao và giàu công nghệ an toàn hàng đầu phân khúc. Hệ thống dẫn động 2 cầu 4x4 thông minh, màn hình trung tâm dọc 12 inch chạy SYNC 4A, camera 360 độ sắc nét và hỗ trợ đỗ xe tự động.",
        },
        {
          id: 12,
          name: "Hyundai Tucson 2.0 Diesel",
          brand: "Hyundai",
          price: 959000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStMbKbjpRugZbAa8Jxhz2GPdFPKMMrw8fJwjRdQ-TBZQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZ8ey04y0-7pSS5gagfiCQrjMaVJBoxy_NPolImcNVTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-AHImYzA1sSv1yPO9EeJObAW1AWSceaxllVKBvl_VJg&s=10",
          engine: "Diesel Smartstream D2.0 (186 HP / 416 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Dầu (Diesel)",
          description:
            "Crossover sở hữu thiết kế ngoại thất táo bạo, khả năng vận hành mạnh mẽ, bốc và tiết kiệm nhiên liệu tối ưu. Nổi bật với lưới tản nhiệt hình khối thông minh, cần số điện tử dạng nút bấm, cửa sổ trời toàn cảnh và gói an toàn Hyundai SmartSense.",
        },
        {
          id: 13,
          name: "Hyundai Accent 1.5 AT",
          brand: "Hyundai",
          price: 489000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqxAlh0ojNuYt82BpLC-BRYGclFmTXJd-gJrp2lEF6WQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSahuOZxstBhmyAYM9STEFGftWiVL3FaEJV6jgiXXgjVQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NEb-vWA47bMBzZmMi3bTdDEKeRmafgiCvZAUuKuHlA&s=10",
          engine: "Xăng Smartstream G1.5 (115 HP / 144 Nm)",
          transmission: "Tự động vô cấp thông minh iVT",
          fuel: "Xăng",
          description:
            "Sedan hạng B phổ thông, tiện nghi phong phú vượt tầm giá. Thiết kế phong cách Fastback thể thao trẻ trung, màn hình giải trí 8 inch tích hợp Apple CarPlay/Android Auto không dây, sạc điện thoại không dây và tính năng mở cốp thông minh.",
        },
        {
          id: 14,
          name: "Honda CR-V e:HEV RS",
          brand: "Honda",
          price: 1259000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYwkQ2_Bnn715DhM8OfuYNpzg5ozBqKoyC2evRYhhUw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYKCZvpPeMChk_J4Lbs9BbrSrpBDSw5G69aSbUDdtrsw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8Vqeig2JBKNtNlJ5UGdtK69cmsDwRARmVSINyLF-S_Q&s=10",
          engine: "Xăng 2.0L kết hợp 2 mô-tơ điện (Tổng công suất 204 HP / 335 Nm)",
          transmission: "Tự động vô cấp E-CVT",
          fuel: "Xăng Hybrid",
          description:
            "SUV 5 chỗ thể thao mang lại trải nghiệm lái phấn khích chuẩn Honda Sensing. Khả năng tiết kiệm nhiên liệu tối ưu chỉ khoảng 5.2L/100km trong đô thị, trang bị cửa sổ trời toàn cảnh Panorama, hệ thống âm thanh 12 loa Bose và màn hình HUD.",
        },
        {
          id: 15,
          name: "Mazda CX-5 2.0 Premium",
          brand: "Mazda",
          price: 829000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpW39XsAvfNmzgS3h7r2TjxeeJTUhyLpVsnzGlKpS-mQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTInC9__STOHLHNime6eFjQhx4SSUEX5S8lyJn71cJTqQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIF5WKKGY123T08e8kSO_mXGGGMgDtg41luLhyq88TKw&s=10",
          engine: "Xăng SkyActiv-G 2.0L (154 HP / 200 Nm)",
          transmission: "Tự động 6 cấp",
          fuel: "Xăng",
          description:
            "Mẫu Crossover bán chạy hàng đầu phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế. Trang bị màn hình hiển thị kính lái HUD, gương chiếu hậu chống chói tự động, cốp điện rảnh tay, 10 loa Bose cao cấp và gói an toàn chủ động i-Activsense.",
        },
        {
          id: 16,
          name: "Kia Carnival 2.2D Signature",
          brand: "Kia",
          price: 1759000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDrQOfx7kICr3cyGjHqTHm_SMnzFbZOde_TVN6qS1FXw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5v0u6MMN_-u8H5QgBA6eq9gRrBtD3urv_V9zGDT_5ig&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKUw3TRHK3bFJ7Hv5brQb8FBAB1NJEcZdPSkYD5-8ysg&s=10",
          engine: "Diesel Smartstream 2.2L (199 HP / 440 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Dầu (Diesel)",
          description:
            "Xe gia đình hạng sang (MPV) cỡ lớn rộng rãi, trang bị đầy đủ như khoang hạng thương gia. Hàng ghế thứ hai chỉnh điện thư giãn tích hợp sưởi/làm mát, cửa sổ trời đôi độc lập, rèm che nắng và hệ thống âm thanh 12 loa Bose.",
        },
        {
          id: 17,
          name: "Audi Q7 45 TFSI quattro",
          brand: "Audi",
          price: 3700000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsMi5fmiZg1cQubrLMpSpHHiwFbiC2puLtGW-dhi1Evw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2Z49zJQSa-QgYOK6PnDsCeXGbIjDlMy_UJgY5AVG0w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXio_hwx7mM0zgI01Sdx4o-ZLySmfpn8qKouBDzFESQA&s=10",
          engine: "Xăng 2.0L TFSI Mild-Hybrid MHEV (252 HP / 370 Nm)",
          transmission: "Tự động 8 cấp Tiptronic",
          fuel: "Xăng",
          description:
            "SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian quattro danh tiếng. Thiết kế lưới tản nhiệt Singleframe bát giác bề thế, cụm đèn pha LED Matrix sắc sảo, buồng lái ảo Audi Virtual Cockpit và dàn âm thanh 3D Bang & Olufsen 19 loa.",
        },
        {
          id: 18,
          name: "Lexus RX350 Luxury",
          brand: "Lexus",
          price: 4330000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOKn1MNoCINsLRyMryNK-gqu0xXC7E4vegTJpqDpxwKg&s, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlhxOxreBx7dZ0WVilniwHUvofB_NaKB71xDtEZh1WYA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOMkj7dV-dZSUjqzqpyhMVxWrlA_BEZeQ-CC4u_rdp7Q&s=10",
          engine: "Xăng 2.4L Turbo I4 (275 HP / 430 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Xăng",
          description:
            "Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt. Nội thất bọc da Semi-Aniline cao cấp, màn hình trung tâm cảm ứng 14 inch, hệ thống âm thanh vòm 21 loa Mark Levinson và gói công nghệ an toàn Lexus Safety System+.",
        },
        {
          id: 19,
          name: "Lamborghini Urus S",
          brand: "Lamborghini",
          price: 16500000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHS2yGPTepN8pLd6xYDDwMDfzd7nNgw0Wb_yTGlGCm0A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKtHAnyoB_1kLYyhE81rizhXi7nkTxwh82w-nitYue7g&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ098BS6eDBP3owhuf17ApxAaDbgMExcwrI0huLgTUudQ&s=10",
          engine: "Xăng V8 4.0L Twin-Turbo (666 HP / 850 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Xăng",
          description:
            "Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Hệ thống dẫn động 4 bánh toàn thời gian, treo khí nén thích ứng thông minh và núm xoay chế độ lái ANIMA gồm Strada, Sport, Corsa, Terra, Sabbia và Neve.",
        },
        {
          id: 20,
          name: "Ferrari F8 Tributo",
          brand: "Ferrari",
          price: 19000000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE3sDpn33xn9qTk5wTWc6EFHdkMEssFXSa6l-0td5o2w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgqtnNRCxzmqTFoL6wSi62G-QtJKf_vgT58IWQOpjJvg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTw0GaWZqHRGG_hseloDpgEOje7D5M_ahm2lMqzkTrlTg&s=10",
          engine: "Xăng V8 3.9L Twin-Turbo (720 HP / 770 Nm)",
          transmission: "Ly hợp kép 7 cấp F1",
          fuel: "Xăng",
          description:
            "Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h, trang bị hốc gió khí động học S-Duct lấy cảm hứng từ xe đua Công thức 1 giúp tăng lực ép xuống đường.",
        },
      ];

      let allCars = [];

      function openBookingModalById(id) {
        const car = allCars.find((c) => Number(c.id) === Number(id));
        openBookingModal(car ? car.name : "Tất cả mẫu xe");
      }

      function openQRModalById(id) {
        const car = allCars.find((c) => Number(c.id) === Number(id));
        if (!car) return;
        openQRModal(car.name, car.price);
      }

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

      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          ["detailModal", "qrModal", "bookingModal"].forEach(closeModal);
          const chatWin = document.getElementById("chatWindow");
          if (chatWin && (chatWin.style.display === "flex" || !chatWin.classList.contains("hidden"))) {
            toggleChat();
          }
        }
      });

      ["detailModal", "qrModal", "bookingModal"].forEach((id) => {
        const el = document.getElementById(id);
        if (el) {
          el.addEventListener("click", function (e) {
            if (e.target === el) closeModal(id);
          });
        }
      });

      async function fetchCars() {
        try {
          const res = await fetch("php/get_cars.php?t=" + Date.now(), { cache: "no-store" });
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
          allCars = fallbackCars.map((c) => ({
            ...c,
            id: Number(c.id),
            price: Number(c.price),
          }));
        }
        allCars.sort((a, b) => b.id - a.id);

        populateCalculatorCarSelect();
        populateDriveSelect();
        calculateLoan();
      }

      function populateCalculatorCarSelect() {
        const select = document.getElementById("calcCarSelect");
        if (!select) return;
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
        if (!select) return;
        select.innerHTML = '<option value="Chưa chọn xe">Chọn mẫu xe quan tâm</option>';
        allCars.forEach((car) => {
          const opt = document.createElement("option");
          opt.value = car.name;
          opt.textContent = car.name;
          select.appendChild(opt);
        });
      }

      function formatCurrency(num) {
        return Math.round(Number(num) || 0).toLocaleString("vi-VN") + " VNĐ";
      }

      function formatBillion(num) {
        if (num >= 1000000000) {
          const b = (num / 1000000000).toFixed(2).replace(/\.00$/, "");
          return b + " Tỷ VNĐ";
        }
        return (num / 1000000).toFixed(0) + " Triệu VNĐ";
      }

      function applyCarToCalculator() {
        const val = document.getElementById("calcCarSelect").value;
        if (val) {
          document.getElementById("calcPriceInput").value = val;
          calculateLoan();
        }
      }

      function calculateLoan() {
        ["calcDownPercent", "calcMonths", "calcInterest"].forEach((id) => {
          const slider = document.getElementById(id);
          if (!slider) return;
          const min = parseFloat(slider.min) || 0;
          const max = parseFloat(slider.max) || 100;
          const val = parseFloat(slider.value) || 0;
          const percent = ((val - min) / (max - min)) * 100;

          const isLight = document.documentElement.classList.contains("light");
          const trackBg = isLight ? "#ddd6fe" : "#2e1065";
          slider.style.background = `linear-gradient(to right, #6d28d9 0%, #a78bfa ${percent}%, ${trackBg} ${percent}%, ${trackBg} 100%)`;
        });

        const price = parseFloat(document.getElementById("calcPriceInput").value) || 0;
        const downPercent = parseInt(document.getElementById("calcDownPercent").value) || 20;
        const months = parseInt(document.getElementById("calcMonths").value) || 60;
        const rateYear = parseFloat(document.getElementById("calcInterest").value) || 8.5;

        const downAmount = price * (downPercent / 100);
        const loanAmount = price - downAmount;
        const years = Number((months / 12).toFixed(1));

        document.getElementById("calcDownPercentLabel").innerHTML = `${downPercent}% (${formatCurrency(downAmount)})`;
        document.getElementById("calcMonthsLabel").innerText = `${months} tháng (${years} năm)`;
        document.getElementById("calcInterestLabel").innerText = `${rateYear.toFixed(1)}% / năm`;

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
      const themeObserver = new MutationObserver(() => {
        calculateLoan();
      });
      themeObserver.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ["class"],
      });

      function openDetailModal(id) {
        const targetId = Number(id);
        const car = allCars.find((c) => Number(c.id) === targetId);
        if (!car) return;

        document.getElementById("modalContent").innerHTML = `
                <div class="relative rounded-2xl overflow-hidden mb-5">
                    <img src="${getCarImage(car.image)}" class="w-full h-80 object-cover" onerror="this.onerror=null; this.src=FALLBACK_CAR_IMG">
                    <span class="absolute top-4 left-4 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        ${escapeHtml(car.brand)}
                    </span>
                </div>

                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 border-b border-gray-200 dark:border-white/10 pb-4">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-black font-heading text-slate-900 dark:text-white">${escapeHtml(car.name)}</h2>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Mã SKU: 4TL-00${car.id} | Tình trạng: Xe mới có sẵn giao ngay</span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-indigo-600 dark:text-indigo-500 font-heading">
                        ${formatCurrency(car.price)}
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 my-4">
                    <div class="bg-gray-50 dark:bg-slate-800/80 p-3.5 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                        <span class="text-gray-500 dark:text-gray-400 text-[10px] uppercase font-bold block mb-1">Động cơ</span>
                        <strong class="text-xs text-slate-900 dark:text-white">${escapeHtml(car.engine || "N/A")}</strong>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-800/80 p-3.5 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                        <span class="text-gray-500 dark:text-gray-400 text-[10px] uppercase font-bold block mb-1">Hộp số</span>
                        <strong class="text-xs text-slate-900 dark:text-white">${escapeHtml(car.transmission || "Tự động")}</strong>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-800/80 p-3.5 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                        <span class="text-gray-500 dark:text-gray-400 text-[10px] uppercase font-bold block mb-1">Nhiên liệu</span>
                        <strong class="text-xs text-slate-900 dark:text-white">${escapeHtml(car.fuel || "Xăng")}</strong>
                    </div>
                </div>

                <div class="space-y-2">
                    <h4 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Giới thiệu tổng quan & Trang bị nổi bật</h4>
                    <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed bg-gray-50 dark:bg-slate-950/50 p-4 rounded-2xl border border-gray-200 dark:border-white/5 break-words whitespace-pre-line">
                        ${escapeHtml(car.description || "Mẫu xe sở hữu thiết kế thể thao đột phá, vật liệu nội thất cao cấp cùng hệ thống trợ lái và an toàn tối tân hàng đầu phân khúc.")}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3">
                    <button onclick="closeModal('detailModal'); openQRModalById(${car.id})" class="bg-indigo-600 hover:bg-violet-700 text-white font-bold py-3 rounded-2xl text-xs transition shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-qrcode"></i> Đặt Cọc Giữ Xe
                    </button>
                    <button onclick="closeModal('detailModal'); openBookingModalById(${car.id})" class="bg-gray-100 hover:bg-gray-200 text-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-white font-bold py-3 rounded-2xl text-xs border border-gray-300 dark:border-white/10 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-car-side"></i> Lái Thử Tận Nơi
                </div>
                
                <div class="pt-1 text-center">
                    <a href="html/detail.html?id=${car.id}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 underline underline-offset-4 transition">
                        <i class="fa-solid fa-up-right-from-square"></i> Mở trang chi tiết đầy đủ (Chia sẻ link)
                    </a>
                </div>
            `;

        openModal("detailModal");
      }

      function openQRModal(carName, price) {
        window.currentDepositCar = { name: carName, price: price };
        document.getElementById("qrCarName").innerText = `Đặt cọc ưu tiên mẫu: ${carName}`;
        const memo = `COC ${carName.replace(/[^a-zA-Z0-9]/g, "").toUpperCase()}`;
        document.getElementById("qrMemo").innerText = memo;

        const qrImg = document.getElementById("qrImage");
        qrImg.src = "images/qrcode.jpg";

        qrImg.onerror = function () {
          this.onerror = null;
          this.src = `https://img.vietqr.io/image/MB-0765650114-compact2.png?amount=500000000&addInfo=${encodeURIComponent(memo)}&accountName=SHOWROOM%204TL%20AUTO`;
        };

        openModal("qrModal");
      }

      function openBookingModal(carName) {
        document.getElementById("modalBookingCar").value = carName;
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById("modalBookingDate").value = tomorrow.toISOString().split("T")[0];
        openModal("bookingModal");
      }

      async function confirmDepositSuccess() {
        const cusName = document.getElementById("qrCustomerName").value.trim() || "Khách đặt cọc online";
        const cusPhone = document.getElementById("qrCustomerPhone").value.trim();
        const memo = document.getElementById("qrMemo").innerText;

        if (!cusPhone) {
          showToast("Vui lòng nhập Số điện thoại để kế toán đối soát!", "error");
          return;
        }

        try {
          const res = await fetch("php/save_order.php", {
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

          const result = await res.json();
          if (result.status !== "success") {
            showToast(result.message || "Lỗi lưu giao dịch đặt cọc!", "error");
            return;
          }

          localStorage.setItem("4tl_customer_phone", cusPhone.replace(/[^0-9]/g, ""));

          showToast(
            "Đã lưu thông tin giao dịch cọc! Kế toán sẽ gọi xác nhận qua SĐT " + cusPhone + " trong 15 phút.",
            "success",
          );
          document.getElementById("qrCustomerName").value = "";
          document.getElementById("qrCustomerPhone").value = "";
          closeModal("qrModal");
        } catch (err) {
          showToast("Lỗi kết nối máy chủ: Không thể lưu giao dịch lúc này.", "error");
        }
      }

      async function handleModalBooking(e) {
        e.preventDefault();
        const car = document.getElementById("modalBookingCar").value;
        const name = document.getElementById("modalBookingName").value;
        const phone = document.getElementById("modalBookingPhone").value;
        const date = document.getElementById("modalBookingDate").value;

        try {
          const res = await fetch("php/save_order.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ type: "booking", name, phone, car, date, note: "Đặt từ Modal Lái thử" }),
          });

          const result = await res.json();

          localStorage.setItem("4tl_customer_phone", phone.replace(/[^0-9]/g, ""));

          if (result.status === "success") {
            showToast("Đã lưu lịch lái thử thành công cho khách hàng: " + name, "success");
          } else {
            showToast(result.message || "Có lỗi xảy ra!", "error");
            return;
          }

          e.target.reset();
          closeModal("bookingModal");
        } catch (err) {
          showToast("Lỗi kết nối máy chủ!", "error");
        }
      }

      async function handleTestDriveSubmit(e) {
        e.preventDefault();
        const name = document.getElementById("driveName").value;
        const phone = document.getElementById("drivePhone").value;
        const car = document.getElementById("driveCar").value;

        try {
          const res = await fetch("php/save_order.php", {
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

          const result = await res.json();

          localStorage.setItem("4tl_customer_phone", phone.replace(/[^0-9]/g, ""));

          if (result.status === "success") {
            showToast("Đã tiếp nhận lịch hẹn lái thử của quý khách " + name + "!", "success");
          } else {
            showToast(result.message || "Có lỗi xảy ra!", "error");
            return;
          }

          e.target.reset();
        } catch (err) {
          showToast("Lỗi kết nối máy chủ: Không thể gửi lịch hẹn.", "error");
        }
      }

      async function requestLoanConsult() {
        const phone = prompt("Quý khách vui lòng nhập Số điện thoại / Zalo để nhận bảng tính trả góp chi tiết:");
        if (!phone || !phone.trim()) return;

        const price = formatCurrency(document.getElementById("calcPriceInput").value);
        const downPercent = document.getElementById("calcDownPercent").value;
        const months = document.getElementById("calcMonths").value;

        try {
          const res = await fetch("php/save_order.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              type: "booking",
              name: "Khách tư vấn trả góp",
              phone: phone.trim(),
              car: `Gói vay xe ${price}`,
              date: new Date().toISOString().split("T")[0],
              note: `Trả trước ${downPercent}%, kỳ hạn ${months} tháng`,
            }),
          });

          const result = await res.json();
          if (result.status !== "success") {
            showToast(result.message || "Không thể gửi yêu cầu tư vấn!", "error");
            return;
          }

          showToast("Đã gửi yêu cầu thành công! Chuyên viên sẽ gửi bảng tính qua Zalo " + phone.trim(), "success");
        } catch (err) {
          showToast("Lỗi kết nối máy chủ: Không thể gửi yêu cầu tư vấn.", "error");
        }
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

        chatBox.innerHTML += `
              <div class="bg-indigo-600 text-white p-3 rounded-2xl rounded-tr-none max-w-[85%] ml-auto text-xs shadow-md leading-relaxed">
                  ${escapeHtml(text)}
              </div>
          `;
        input.value = "";
        chatBox.scrollTop = chatBox.scrollHeight;

        const typingId = "typing-" + Date.now();
        chatBox.innerHTML += `
                <div id="${typingId}" class="bg-gray-100 dark:bg-slate-800 text-gray-500 dark:text-gray-400 p-2.5 rounded-2xl rounded-tl-none max-w-[50%] self-start text-xs border border-gray-200 dark:border-white/5 flex items-center gap-1">
                    <span class="animate-bounce">●</span><span class="animate-bounce delay-100">●</span><span class="animate-bounce delay-200">●</span>
                </div>
            `;
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
          const res = await fetch("php/bot_train.php", {
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
                        Dạ quý khách cần tư vấn chi tiết về mẫu xe nào, xin vui lòng gọi trực tiếp Hotline VIP <strong>0765.650.114</strong> để được phục vụ 24/7 ạ!
                    </div>
                `;
          chatBox.scrollTop = chatBox.scrollHeight;
        }
      }

      // Initialize App
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
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&family=Montserrat:wght@600;700;800;900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/theme.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body
    class="hidden bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 min-h-screen p-4 sm:p-8 font-sans transition-colors duration-300">
    
    <!-- KHUNG CHỨA THÔNG BÁO TOAST (NẰM GIỮA PHÍA TRÊN) -->
    <div id="toastContainer" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex flex-col items-center gap-2 pointer-events-none"></div>

    <div class="max-w-6xl mx-auto space-y-6">
    <div class="max-w-6xl mx-auto space-y-6">
      <!-- Top Admin Header -->
      <header
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md p-6 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl">
        <div class="flex items-center gap-3">
          <div
            class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30">
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
            href="../index.html"
            class="bg-gray-100 hover:bg-gray-200 text-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-gray-200 px-4 py-2.5 rounded-xl text-xs font-bold border border-gray-200 dark:border-white/10 transition flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
            Xem Trang Chủ
          </a>
          <a
            href="train_bot.html"
            class="bg-amber-500/15 hover:bg-amber-500 text-amber-600 hover:text-white dark:bg-yellow-500/20 dark:hover:bg-yellow-500 dark:text-yellow-400 dark:hover:text-slate-900 px-4 py-2.5 rounded-xl text-xs font-bold border border-amber-300 dark:border-yellow-500/30 transition flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-robot"></i>
            Huấn Luyện AI Bot
          </a>
          <a
            href="../php/logout.php"
            class="bg-indigo-600/10 hover:bg-indigo-600 text-indigo-600 hover:text-white dark:bg-indigo-600/20 dark:hover:bg-indigo-600 dark:text-indigo-400 px-4 py-2.5 rounded-xl text-xs font-bold border border-indigo-200 dark:border-indigo-500/30 transition flex items-center gap-1.5 shadow-sm">
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
            class="text-xl sm:text-2xl font-black text-indigo-600 dark:text-indigo-400 font-heading mt-1"
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

      <!-- QUẢN LÝ ĐƠN ĐẶT CỌC GIỮ XE (DEPOSITS) -->
      <div
        class="bg-white dark:bg-slate-900/80 p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-bold text-slate-900 dark:text-white font-heading flex items-center gap-2">
            <i class="fa-solid fa-qrcode text-indigo-600"></i>
            Đơn Đặt Cọc Giữ Xe Online
          </h2>
          <span id="depositBadge" class="text-xs font-bold px-3 py-1 rounded-full bg-indigo-600/10 text-indigo-600">
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

      <!-- Form Thêm Xe Mới -->
      <div
        class="bg-white dark:bg-slate-900/80 p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl space-y-4">
        <div
          class="flex items-center gap-2 text-indigo-600 dark:text-indigo-500 font-bold text-sm uppercase tracking-wider">
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
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Hãng sản xuất</label>
            <input
              type="text"
              id="brand"
              placeholder="VD: Porsche"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Giá bán (VNĐ)</label>
            <input
              type="number"
              id="price"
              placeholder="VD: 9500000000"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Động cơ & Mã lực</label>
            <input
              type="text"
              id="engine"
              placeholder="VD: Động cơ điện đôi (750 HP)"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Hộp số</label>
            <input
              type="text"
              id="transmission"
              placeholder="VD: Tự động 2 cấp"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">Loại nhiên liệu</label>
            <input
              type="text"
              id="fuel"
              placeholder="VD: Điện / Xăng / Hybrid"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>

          <div class="md:col-span-3">
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-semibold">
              Danh sách URL Hình ảnh xe (ngăn cách bằng dấu phẩy hoặc xuống dòng)
            </label>
            <textarea
              id="image"
              rows="2"
              placeholder="https://link-anh-1.jpg, https://link-anh-2.jpg, https://link-anh-3.jpg"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500"></textarea>
          </div>

          <div class="md:col-span-3">
            <div class="flex justify-between items-center mb-1">
              <label class="block text-gray-700 dark:text-gray-400 font-semibold">
                Mô tả chi tiết & Điểm nhấn công nghệ
              </label>
              <!-- Hiển thị đếm số ký tự -->
              <span id="charCount" class="text-[10px] text-gray-400">0 / 500 ký tự</span>
            </div>
            <textarea
              id="description"
              maxlength="500"
              oninput="document.getElementById('charCount').innerText = this.value.length + ' / 500 ký tự';"
              placeholder="Mô tả các trang bị an toàn, cảm giác lái, bảo hành (Tối đa 500 ký tự)..."
              rows="3"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500"></textarea>
          </div>

          <div class="md:col-span-3">
            <button
              type="submit"
              class="w-full bg-indigo-600 hover:bg-violet-700 text-white py-3.5 rounded-xl font-bold transition shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2">
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
            class="px-3.5 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 w-full sm:w-64" />
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
    </div>

    <script>
      function showToast(message, type = 'success') {
          const container = document.getElementById('toastContainer');
          if (!container) return;

          const toast = document.createElement('div');
          toast.className = `pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-2xl shadow-2xl text-xs font-bold transition-all duration-300 transform translate-y-[-20px] opacity-0 border backdrop-blur-xl ${
              type === 'success' 
                  ? 'bg-emerald-950/90 border-emerald-500/40 text-emerald-300' 
                  : 'bg-rose-950/90 border-rose-500/40 text-rose-300'
          }`;

          toast.innerHTML = `
              <i class="fa-solid ${type === 'success' ? 'fa-circle-check text-emerald-400' : 'fa-triangle-exclamation text-rose-400'} text-base"></i>
              <span>${escapeHtml(message)}</span>
          `;

          container.appendChild(toast);

          setTimeout(() => {
              toast.classList.remove('translate-y-[-20px]', 'opacity-0');
          }, 10);

          setTimeout(() => {
              toast.classList.add('translate-y-[-20px]', 'opacity-0');
              setTimeout(() => toast.remove(), 300);
          }, 3000);
      }

      (async function checkAdminSession() {
        try {
          const res = await fetch("../php/auth_check.php");
          const data = await res.json();
          if (!data.logged_in) {
            window.location.replace("login.html");
            return;
          }
          document.body.classList.remove("hidden");
        } catch (e) {
          window.location.replace("login.html");
        }
      })();

      let adminCars = [];

      async function loadAdminCars() {
        try {
          const res = await fetch("../php/get_cars.php?t=" + Date.now(), { cache: "no-store" });
          adminCars = await res.json();
          updateStats();
          renderAdminTable(adminCars);
        } catch (e) {
          console.error("Lỗi:", e);
        }
      }

      async function loadCRMOrders() {
        try {
          const res = await fetch("../php/manage_orders.php?action=list");
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
                    <td class="p-3 font-mono text-gray-400">#${Number(d.id)}</td>
                    <td class="p-3 font-bold">${escapeHtml(d.customer_name)}</td>
                    <td class="p-3 font-mono text-indigo-500 font-bold">${escapeHtml(d.customer_phone)}</td>
                    <td class="p-3 font-semibold">${escapeHtml(d.car_name)}</td>
                    <td class="p-3 font-mono text-amber-500">${escapeHtml(d.memo)}</td>
                    <td class="p-3">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold ${d.status === "verified" ? "bg-emerald-500/20 text-emerald-400" : d.status === "cancelled" ? "bg-indigo-500/20 text-indigo-400" : "bg-amber-500/20 text-amber-400"}">
                            ${d.status === "verified" ? "Đã nhận tiền" : d.status === "cancelled" ? "Đã hủy" : "Chờ đối soát"}
                        </span>
                    </td>
                    <td class="p-3 text-right space-x-2">
                      <button onclick="updateOrder('deposits', ${d.id}, 'verified')" class="text-emerald-500 hover:underline font-bold">Xác nhận</button>
                      <button onclick="updateOrder('deposits', ${d.id}, 'cancelled')" class="text-amber-500 hover:underline font-bold">Hủy</button>
                      <button onclick="deleteOrder('deposits', ${d.id})" class="text-rose-500 hover:underline font-bold">Xóa</button>
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
                    <td class="p-3 font-mono text-gray-400">#${Number(b.id)}</td>
                    <td class="p-3 font-bold">${escapeHtml(b.customer_name)}</td>
                    <td class="p-3 font-mono text-blue-400 font-bold">${escapeHtml(b.phone)}</td>
                    <td class="p-3 font-semibold">${escapeHtml(b.car_name)}</td>
                    <td class="p-3 text-gray-400">${escapeHtml(b.booking_date)} — <span class="italic">${escapeHtml(b.note || "")}</span></td>
                    <td class="p-3">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold ${b.status === "confirmed" ? "bg-emerald-500/20 text-emerald-400" : b.status === "cancelled" ? "bg-indigo-500/20 text-indigo-400" : "bg-amber-500/20 text-amber-400"}">
                            ${b.status === "confirmed" ? "Đã chốt lịch" : b.status === "cancelled" ? "Đã hủy" : "Chờ gọi xác nhận"}
                        </span>
                    </td>
                    <td class="p-3 text-right space-x-2">
                      <button onclick="updateOrder('bookings', ${b.id}, 'confirmed')" class="text-emerald-500 hover:underline font-bold">Duyệt</button>
                      <button onclick="updateOrder('bookings', ${b.id}, 'cancelled')" class="text-amber-500 hover:underline font-bold">Hủy</button>
                      <button onclick="deleteOrder('bookings', ${b.id})" class="text-rose-500 hover:underline font-bold">Xóa</button>
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
        await fetch(`../php/manage_orders.php?action=update_status&table=${table}&id=${id}&status=${status}`);
        loadCRMOrders();
      }

      async function deleteOrder(table, id) {
        // Thay vì dùng hộp thoại confirm() mặc định của trình duyệt, 
        // ta gọi trực tiếp API xóa và hiển thị Toast thông báo kết quả
        try {
          const res = await fetch(`../php/manage_orders.php?action=delete&table=${table}&id=${id}`);
          const data = await res.json();

          if (data.status === "success") {
            showToast("Đã xóa bản ghi thành công!", "success");
            loadCRMOrders();
          } else {
            showToast(data.message || "Không thể xóa bản ghi này!", "error");
          }
        } catch (err) {
          showToast("Lỗi kết nối máy chủ khi xóa!", "error");
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
                    <td class="p-3 text-gray-400 font-mono">#${Number(car.id)}</td>
                    <td class="p-3">
                        <div class="relative inline-block">
                            <img src="${getCarImage(car.image)}" class="w-14 h-9 object-cover rounded-lg border border-gray-200 dark:border-white/10" onerror="this.onerror=null; this.src=FALLBACK_CAR_IMG">
                            <span class="absolute -top-1.5 -right-1.5 bg-indigo-600 text-white text-[9px] font-bold px-1.5 rounded-full shadow">
                                ${getCarImages(car.image).length} ảnh
                            </span>
                        </div>
                    </td>
                    <td class="p-3 font-bold text-slate-900 dark:text-white">${escapeHtml(car.name)}</td>
                    <td class="p-3"><span class="px-2 py-0.5 rounded bg-indigo-600/10 dark:bg-indigo-600/20 text-indigo-600 dark:text-indigo-400 font-bold">${escapeHtml(car.brand)}</span></td>
                    <td class="p-3 text-gray-500 dark:text-gray-400">${escapeHtml(car.fuel || "Xăng")}</td>
                    <td class="p-3 text-indigo-600 dark:text-indigo-400 font-bold font-mono">${Number(car.price).toLocaleString("vi-VN")} đ</td>
                    <td class="p-3 text-right space-x-2">
                        <button onclick="openEditModal(${car.id})" class="text-blue-600 dark:text-blue-400 hover:underline font-bold inline-flex items-center gap-1">
                        <i class="fa-solid fa-pen-to-square"></i> Sửa
                        </button> 
                        <button onclick="deleteCar(${car.id})" class="text-indigo-600 dark:text-indigo-400 hover:underline font-bold inline-flex items-center gap-1 ml-2">
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
          const res = await fetch("../php/add_car.php", {
            method: "POST",
            body: formData,
          });
          const data = await res.json();
          if (data.status === "success") {
            // THAY THẾ ALERT BẰNG TOAST THÀNH CÔNG
            showToast("Đã lưu thông tin xe thành công!", "success");
            this.reset();
            loadAdminCars();
          } else {
            // THAY THẾ ALERT BẰNG TOAST LỖI
            showToast(data.message || "Thêm xe thất bại!", "error");
          }
        } catch (err) {
          showToast("Lỗi kết nối máy chủ khi thêm xe: " + err, "error");
        }
      };

      // Hàm xóa xe
      async function deleteCar(id) {
        try {
          const res = await fetch("../php/delete_car.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: Number(id) })
          });
          
          const data = await res.json();

          if (data.status === "success") {
            showToast("Đã xóa mẫu xe thành công!", "success");
            await loadAdminCars();
          } else {
            showToast(data.message || "Không thể xóa mẫu xe này!", "error");
          }
        } catch (err) {
          console.error(err);
          showToast("Lỗi kết nối máy chủ khi xóa xe!", "error");
        }
      }

      loadAdminCars();

      function openEditModal(id) {
        const car = adminCars.find((c) => Number(c.id) === Number(id));
        if (!car) {
          showToast("Không tìm thấy dữ liệu xe!", "error");
          return;
        }

        document.getElementById("editCarIdLabel").innerText = car.id;
        document.getElementById("edit_id").value = car.id;
        document.getElementById("edit_name").value = car.name || "";
        document.getElementById("edit_brand").value = car.brand || "";
        document.getElementById("edit_price").value = car.price || 0;
        document.getElementById("edit_fuel").value = car.fuel || "";
        document.getElementById("edit_engine").value = car.engine || "";
        document.getElementById("edit_transmission").value = car.transmission || "";
        document.getElementById("edit_image").value = car.image || "";
        document.getElementById("edit_description").value = car.description || "";
        document.getElementById("editCharCount").innerText = (car.description ? car.description.length : 0) + " / 500 ký tự";

        const modal = document.getElementById("editCarModal");
        modal.classList.remove("hidden");
        modal.style.display = "flex";
      }

      function closeEditModal() {
        const modal = document.getElementById("editCarModal");
        modal.classList.add("hidden");
        modal.style.display = "none";
      }

      // Đảm bảo trang tải xong mới gắn sự kiện cho #editCarForm
      document.addEventListener("DOMContentLoaded", function () {
        const editForm = document.getElementById("editCarForm");
        if (!editForm) return;

        editForm.addEventListener("submit", async function (e) {
          e.preventDefault();

          const payload = {
            id: Number(document.getElementById("edit_id").value),
            name: document.getElementById("edit_name").value.trim(),
            brand: document.getElementById("edit_brand").value.trim(),
            price: Number(document.getElementById("edit_price").value),
            fuel: document.getElementById("edit_fuel").value.trim(),
            engine: document.getElementById("edit_engine").value.trim(),
            transmission: document.getElementById("edit_transmission").value.trim(),
            image: document.getElementById("edit_image").value.trim(),
            description: document.getElementById("edit_description").value.trim(),
          };

          try {
            const res = await fetch("../php/edit_car.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify(payload),
            });
            const data = await res.json();

            if (data.status === "success") {
              showToast("Đã cập nhật thông tin xe thành công!", "success");
              closeEditModal();
              await loadAdminCars();
            } else {
              showToast(data.message || "Cập nhật thất bại!", "error");
            }
          } catch (err) {
            showToast("Lỗi kết nối máy chủ: " + err.message, "error");
          }
        });
      });
      
    </script>

    <!-- MODAL CHỈNH SỬA THÔNG TIN XE TRỰC TIẾP -->
    <div
      id="editCarModal"
      class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 hidden items-center justify-center p-4 overflow-y-auto">
      <div
        class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 relative shadow-2xl border border-gray-200 dark:border-white/15 space-y-5">
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-white/10 pb-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white">
              <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div>
              <h3 class="text-lg font-black font-heading">CHỈNH SỬA THÔNG TIN XE</h3>
              <span class="text-xs text-gray-500 dark:text-gray-400">
                Mã xe: #
                <span id="editCarIdLabel"></span>
              </span>
            </div>
          </div>
          <button
            onclick="closeEditModal()"
            type="button"
            class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 dark:text-gray-300 flex items-center justify-center transition">
            ✕
          </button>
        </div>

        <form id="editCarForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
          <input type="hidden" id="edit_id" />
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-bold">Tên xe / Model</label>
            <input
              type="text"
              id="edit_name"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-bold">Hãng sản xuất</label>
            <input
              type="text"
              id="edit_brand"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-bold">Giá bán (VNĐ)</label>
            <input
              type="number"
              step="100000"
              id="edit_price"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-bold">Loại nhiên liệu</label>
            <input
              type="text"
              id="edit_fuel"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-bold">Động cơ & Công suất</label>
            <input
              type="text"
              id="edit_engine"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-bold">Hộp số</label>
            <input
              type="text"
              id="edit_transmission"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 focus:outline-none focus:border-indigo-500" />
          </div>
          <div class="md:col-span-2">
            <label class="block text-gray-700 dark:text-gray-400 mb-1 font-bold">
              Danh sách URL Hình ảnh (ngăn cách bằng dấu phẩy hoặc xuống dòng)
            </label>
            <textarea
              id="edit_image"
              rows="3"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 focus:outline-none focus:border-indigo-500"></textarea>
          </div>
          <div class="md:col-span-2">
            <div class="flex justify-between items-center mb-1">
              <label class="block text-gray-700 dark:text-gray-400 font-bold">Mô tả chi tiết</label>
              <span id="editCharCount" class="text-[10px] text-gray-400">0 / 500 ký tự</span>
            </div>
            <textarea
              id="edit_description"
              maxlength="500"
              oninput="document.getElementById('editCharCount').innerText = this.value.length + ' / 500 ký tự';"
              rows="3"
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 focus:outline-none focus:border-indigo-500"></textarea>
          </div>

          <div class="md:col-span-2 flex gap-3 pt-2">
            <button
              type="submit"
              class="flex-1 bg-indigo-600 hover:bg-violet-700 text-white py-3 rounded-xl font-bold transition shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2">
              <i class="fa-solid fa-check"></i>
              Lưu Cập Nhật
            </button>
            <button
              type="button"
              onclick="closeEditModal()"
              class="bg-gray-200 hover:bg-gray-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-gray-300 px-6 py-3 rounded-xl font-bold transition">
              Hủy
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
```

### file bot_train.html:
```html
<!doctype html>
<html lang="vi" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trợ Lý Tư Vấn Siêu Xe AI - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&family=Montserrat:wght@600;700;800;900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/theme.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body
    class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 p-4 sm:p-8 font-sans min-h-screen flex items-center justify-center hero-gradient-mesh transition-colors duration-300">
    <div
      class="w-full max-w-2xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-2xl space-y-4">
      <div class="flex justify-between items-center border-b border-gray-200 dark:border-white/10 pb-4">
        <div class="flex items-center gap-3">
          <div
            class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-600 to-indigo-900 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30">
            <i class="fa-solid fa-headset text-lg"></i>
          </div>
          <div>
            <h1 class="text-xl font-black text-slate-900 dark:text-white font-heading">SUPERCAR AI CONSULTANT</h1>
            <span class="text-xs text-emerald-600 dark:text-emerald-400 flex items-center gap-1 font-semibold">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
              Sẵn sàng giải đáp 24/7
            </span>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <button
            id="themeToggle"
            type="button"
            title="Chuyển chế độ Sáng / Tối"
            class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 text-amber-500 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-yellow-400 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
            <i id="themeIcon" class="fa-solid fa-sun text-sm"></i>
          </button>
          <a
            href="../index.html"
            class="text-xs text-slate-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-white transition flex items-center gap-1 bg-gray-100 dark:bg-slate-800 px-3 py-2 rounded-xl border border-gray-200 dark:border-white/10">
            <i class="fa-solid fa-arrow-left"></i>
            Trang Chủ
          </a>
        </div>
      </div>

      <!-- Quick chips -->
      <div class="flex gap-2 overflow-x-auto text-[11px] pb-1 whitespace-nowrap">
        <button
          onclick="setPrompt('Giá xe VinFast VF3?')"
          class="px-3 py-1 rounded-full bg-gray-100 hover:bg-indigo-600 text-slate-700 hover:text-white dark:bg-white/10 dark:text-gray-300 dark:hover:bg-indigo-600 dark:hover:text-white border border-gray-200 dark:border-transparent transition">
          ⚡ VF3
        </button>
        <button
          onclick="setPrompt('G63 AMG giá bao nhiêu?')"
          class="px-3 py-1 rounded-full bg-gray-100 hover:bg-indigo-600 text-slate-700 hover:text-white dark:bg-white/10 dark:text-gray-300 dark:hover:bg-indigo-600 dark:hover:text-white border border-gray-200 dark:border-transparent transition">
          🏎️ G63 AMG
        </button>
        <button
          onclick="setPrompt('Chính sách trả góp 80% thế nào?')"
          class="px-3 py-1 rounded-full bg-gray-100 hover:bg-indigo-600 text-slate-700 hover:text-white dark:bg-white/10 dark:text-gray-300 dark:hover:bg-indigo-600 dark:hover:text-white border border-gray-200 dark:border-transparent transition">
          💳 Trả góp
        </button>
        <button
          onclick="setPrompt('Địa chỉ showroom ở đâu?')"
          class="px-3 py-1 rounded-full bg-gray-100 hover:bg-indigo-600 text-slate-700 hover:text-white dark:bg-white/10 dark:text-gray-300 dark:hover:bg-indigo-600 dark:hover:text-white border border-gray-200 dark:border-transparent transition">
          📍 Địa chỉ
        </button>
      </div>

      <!-- Chat History -->
      <div
        class="h-96 overflow-y-auto space-y-3 p-4 bg-gray-50 dark:bg-slate-950/60 rounded-2xl border border-gray-200 dark:border-white/5 flex flex-col text-xs"
        id="chatBox">
        <div
          class="bg-white dark:bg-slate-800 text-slate-800 dark:text-gray-200 p-3.5 rounded-2xl rounded-tl-none max-w-[85%] self-start border border-gray-200 dark:border-white/10 leading-relaxed shadow-sm">
          👋 Chào quý khách! Em là Trợ lý AI của Showroom 4TL. Em có thể tư vấn mẫu xe, mức giá, chính sách bảo hành
          hoặc đặt hẹn lái thử. Quý khách đang quan tâm đến dòng xe nào?
        </div>
      </div>

      <!-- Input Box -->
      <div class="flex gap-2 pt-2">
        <input
          type="text"
          id="userInput"
          placeholder="Nhập câu hỏi (Ví dụ: giá Porsche 911, bảo hành, địa chỉ)..."
          class="flex-1 bg-white dark:bg-slate-800 px-4 py-3 rounded-2xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-none focus:border-indigo-500 transition" />
        <button
          id="sendBtn"
          class="bg-indigo-600 hover:bg-violet-700 text-white px-6 py-3 rounded-2xl font-bold text-xs transition shadow-lg shadow-indigo-600/30 flex items-center gap-1.5">
          <span>Gửi</span>
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </div>
    </div>

    <script>
      const chatBox = document.getElementById("chatBox");
      const userInput = document.getElementById("userInput");
      const sendBtn = document.getElementById("sendBtn");

      function setPrompt(text) {
        userInput.value = text;
        sendMsg();
      }

      async function sendMsg() {
        const text = userInput.value.trim();
        if (!text) return;

        chatBox.innerHTML += `
                <div class="bg-indigo-600 text-white p-3.5 rounded-2xl rounded-tr-none max-w-[85%] ml-auto text-xs shadow-md leading-relaxed">
                    ${escapeHtml(text)}
                </div>
            `;
        userInput.value = "";
        chatBox.scrollTop = chatBox.scrollHeight;

        const typingId = "typing-" + Date.now();
        chatBox.innerHTML += `
                <div id="${typingId}" class="bg-white dark:bg-slate-800 text-gray-400 p-2.5 rounded-2xl rounded-tl-none max-w-[40%] self-start text-xs border border-gray-200 dark:border-white/5 flex items-center gap-1 shadow-sm">
                    <span class="animate-bounce">●</span><span class="animate-bounce delay-100">●</span><span class="animate-bounce delay-200">●</span>
                </div>
            `;
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
          const res = await fetch("../php/bot_train.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ message: text }),
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
                        Dạ em đã ghi nhận câu hỏi. Quý khách có thể liên hệ trực tiếp Hotline VIP <strong>0765.650.114</strong> để chuyên viên tư vấn phục vụ quý khách ngay ạ!
                    </div>
                `;
          chatBox.scrollTop = chatBox.scrollHeight;
        }
      }

      sendBtn.onclick = sendMsg;
      userInput.onkeypress = (e) => {
        if (e.key === "Enter") sendMsg();
      };
    </script>
  </body>
</html>
```

### file detail.html:
```html
<!doctype html>
<html lang="vi" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chi Tiết Xe - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&family=Montserrat:wght@600;700;800;900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/theme.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body
    class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 min-h-screen p-4 sm:p-8 font-sans transition-colors duration-300">
    <div class="max-w-5xl mx-auto space-y-6">
      <!-- Header Nav -->
      <div
        class="flex justify-between items-center bg-white/90 dark:bg-slate-900/80 backdrop-blur-md p-4 rounded-2xl border border-gray-200 dark:border-white/10 shadow-lg">
        <a
          href="../index.html"
          class="text-xs font-bold text-slate-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-white flex items-center gap-2 transition">
          <i class="fa-solid fa-arrow-left text-indigo-600 dark:text-indigo-500"></i>
          Quay Lại Showroom
        </a>

        <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 font-heading tracking-wider uppercase">
          SHOWROOM 4TL MOTORS
        </span>

        <div class="flex items-center gap-2">
          <!-- Theme Toggle Button -->
          <button
            id="themeToggle"
            type="button"
            title="Chuyển chế độ Sáng / Tối"
            class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 text-amber-500 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-yellow-400 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
            <i id="themeIcon" class="fa-solid fa-sun text-sm"></i>
          </button>
          <a
            href="tel:0765650114"
            class="bg-indigo-600 hover:bg-violet-700 text-white text-xs font-bold px-3 py-1.5 rounded-xl transition flex items-center gap-1.5 shadow-md">
            <i class="fa-solid fa-phone"></i>
            Hotline VIP
          </a>
        </div>
      </div>

      <!-- Main Detail Card -->
      <div
        id="detailContainer"
        class="glass-panel p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-2xl space-y-8">
        <div class="text-center py-12 text-gray-400">
          <i class="fa-solid fa-spinner fa-spin text-2xl text-indigo-500"></i>
          <p class="mt-2 text-xs">Đang tải thông tin xe...</p>
        </div>
      </div>
    </div>

    <script>
      const fallbackCars = [
        {
          id: 1,
          name: "VinFast VF3",
          brand: "VinFast",
          price: 240000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFJCmiv3bB_2DDesc8SnYvKr_hq-1IiNwk2YCGZKyqZA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDJ8HxL4j3SfFrNMGCvRD9bwAZjykVF3WG-Xxl5v7h9w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbsZHkDzGDsG_EspjalYDoIEN3dnHiV45pQrIns8UK3w&s=10",
          engine: "Động cơ điện đơn (Công suất 43 HP / Mô-men xoắn 110 Nm)",
          transmission: "Tự động 1 cấp",
          fuel: "Điện",
          description:
            "Cơn sốt xe điện mini đô thị tại Việt Nam! Mang phong cách thiết kế hình hộp cá tính, khỏe khoắn, khoảng sáng gầm xe cao 191mm giúp dễ dàng vượt qua các địa hình ngập nước đô thị, là mẫu xe điện bán chạy nhất (Best Seller) tại Showroom 4TL.",
        },
        {
          id: 2,
          name: "Mercedes-Benz C-Class C300 AMG",
          brand: "Mercedes-Benz",
          price: 2099000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8nJj5R87z1dpwUCcHbj1KwNTJtJBM4sYDjrEIgxRtRA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jXuoX5_WAmEuVpxNpYUIX-UtNpPa78eTAQECU9_aJQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR98khAhzlP1bBIDo7mN_uNiVMy5ExBrqfae38EzD2oBg&s=10",
          engine: "Xăng 2.0L Turbo kết hợp công nghệ EQ Boost Mild-Hybrid (258 HP / 400 Nm)",
          transmission: "Tự động 9 cấp 9G-TRONIC",
          fuel: "Xăng Mild-Hybrid",
          description:
            'Mẫu sedan thể thao mệnh danh là "tiểu S-Class" với gói trang thiết kế ngoại thất AMG Line cuốn hút, màn hình giải trí trung tâm đặt dọc 11.9 inch tích hợp MBUX thế hệ mới, cụm đèn pha thông minh Digital Light tối tân và hệ thống âm thanh vòm Burmester 3D 15 loa sống động.',
        },
        {
          id: 3,
          name: "Porsche 911 Carrera S",
          brand: "Porsche",
          price: 8500000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUGbNCOFMrr8i-ELaF9sQVPpIjPWMSJB44Ql_bo2667w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIwrpx24-3p2ImkIovLVRN_wTXP-Sr-f5Y_LXkgKJDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpMtyFyXiOJ0kzPQgcy_26PGobb5w_z8zugn9VxdYSjg&s=10",
          engine: "Xăng Boxer 6 xi-lanh 3.0L Twin-Turbo (450 HP / 530 Nm)",
          transmission: "Ly hợp kép 8 cấp PDK danh tiếng của Porsche",
          fuel: "Xăng",
          description:
            "Biểu tượng xe thể thao hiệu suất cao huyền thoại mang lại cảm giác lái thuần khiết đỉnh cao. Khả năng tăng tốc 0-100 km/h chỉ mất 3.7 giây khi trang bị gói Sport Chrono, tốc độ tối đa đạt 308 km/h, tích hợp hệ thống treo chủ động PASM và thiết kế buồng lái đậm chất xe đua Đức.",
        },
        {
          id: 4,
          name: "Mercedes-AMG G63",
          brand: "Mercedes-Benz",
          price: 11750000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9k-mmUkZkHwMhAB8bjPOA9mFIiMkV_1C-dBgyFThkTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHgJI_oRJzR0lzto9sfPraPiSShwHmuhhfQ45LX6a1lA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKEtZnRwUw07P1WR5UkpeZNNF4_2YJJY3Pyyja2xXKOw&s=10",
          engine: "Xăng V8 4.0L Biturbo AMG (585 HP / 850 Nm)",
          transmission: "Tự động thể thao 9 cấp AMG SPEEDSHIFT TCT 9G",
          fuel: "Xăng",
          description:
            "Mẫu SUV địa hình hạng sang biểu tượng uy quyền. Thiết kế khung gầm hình thang siêu cứng vững với 3 khóa vi sai độc lập có thể khóa hoàn toàn bằng điện, hệ thống ống xả thể thao đặt bên hông uy lực, nội thất da Nappa hảo hạng kết hợp hệ thống âm thanh vòm Burmester 15 loa.",
        },
        {
          id: 5,
          name: "BMW 740i Pure Excellence",
          brand: "BMW",
          price: 4699000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHMNStnEqOgN-AtfJc4ZxIl-FSqSxWD-_KPP9Zjk-BkA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10",
          engine: "Xăng 3.0L I6 TwinPower Turbo Mild-Hybrid (381 HP / 540 Nm)",
          transmission: "Tự động 8 cấp Steptronic Sport",
          fuel: "Xăng Mild-Hybrid",
          description:
            "Sedan hạng sang cỡ lớn đỉnh cao công nghệ của BMW. Không gian nội thất xa hoa với thanh pha lê tương tác BMW Interaction Bar, ghế ngồi thương gia bọc da Merino cao cấp tích hợp massage, màn hình rạp chiếu phim rạp phía sau 31.3 inch và dàn âm thanh vòm Bowers & Wilkins Diamond.",
        },
        {
          id: 6,
          name: "VinFast VF8 Plus",
          brand: "VinFast",
          price: 1270000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMgh5eFb69xZCQCeJXpE2n1sx0fIj0gMZRsLUCkF7F2Q&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2fiRyUQE2tzYAfH61XkhF-ZaRi4kbEv1pGYAd6gaKZw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnZ23dQtN4guhpS1WTpIHS2Azx4Cb_TRBVR3v3oMa8A&s=10",
          engine: "2 mô-tơ điện AWD toàn thời gian (402 HP / 620 Nm)",
          transmission: "Tự động 1 cấp",
          fuel: "Điện",
          description:
            "SUV điện thông minh phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái nâng cao ADAS. Khả năng tăng tốc ấn tượng từ 0-100 km/h dưới 5.5 giây, màn hình trung tâm tràn viền 15.6 inch tối giản, không gian rộng rãi và cửa sổ trời toàn cảnh kính lớn.",
        },
        {
          id: 7,
          name: "VinFast VF5 Plus",
          brand: "VinFast",
          price: 468000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd-uWGNUo1taSToXpQaIDCJxCi0OOXvd5SN34Va8zCgQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFGMSwMiRgj3WEsCu14j3Th0mDeFZDiTmfuN5AIyfgiA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEnAbDWJMk7kjzcYqCfHxsNLGsZ4hGodDqmC_vbKh6lw&s=10",
          engine: "Động cơ điện đơn (Công suất 134 HP / Mô-men xoắn 135 Nm)",
          transmission: "Tự động 1 cấp",
          fuel: "Điện",
          description:
            "Mẫu A-SUV chạy điện nhỏ gọn, thiết kế năng động tối ưu cho nhu cầu di chuyển đô thị hàng ngày. Tầm hoạt động hơn 300 km cho mỗi lần sạc đầy, tích hợp trợ lý ảo tiếng Việt thông minh, cảnh báo điểm mù và trang bị 6 túi khí an toàn.",
        },
        {
          id: 8,
          name: "Toyota Camry 2.5Q",
          brand: "Toyota",
          price: 1405000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYl1j8avzp_a52uX2szBu_X2g82yHbEtkqDDN0XtKJ6A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ16pL8BQW83ACdsEAsk95IbLeS0i347RmCkAbc4zGLLA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDKY-KgdZor0p_2ggyNXFiRd7VE6K5ydz31QxuOYG8w&s=10",
          engine: "Xăng Dynamic Force 2.5L (207 HP / 250 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Xăng",
          description:
            "Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái. Khoang hành khách phía sau thiết kế chuẩn doanh nhân với bệ tỳ tay tích hợp bảng điều khiển cảm ứng ngả ghế, rèm che nắng chỉnh điện, điều hòa 3 vùng độc lập và 9 loa JBL cao cấp.",
        },
        {
          id: 9,
          name: "Toyota Corolla Cross 1.8HEV",
          brand: "Toyota",
          price: 905000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpA_ZtVNe8sOc_-tGXiFue--SWAvHYn4hqdXnj1v5NYg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuPdKKZWfVIlpfJtWjiH1WDTCkzs65ZGLNbW8xdkYXA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaemDP4gzPH3lDaNIymrWag_h6ogYiqv8TLc60aEacSA&s=10",
          engine: "Xăng 1.8L kết hợp mô-tơ điện Hybrid (Tổng công suất 122 HP)",
          transmission: "Tự động vô cấp E-CVT",
          fuel: "Xăng Hybrid",
          description:
            "SUV đô thị xanh tiết kiệm nhiên liệu tối ưu nhờ công suất tự sạc Hybrid tiên tiến. Trang bị gói công nghệ an toàn Toyota Safety Sense, camera toàn cảnh 360 độ, cửa sổ trời toàn cảnh và vận hành êm ái, bền bỉ chuẩn mực.",
        },
        {
          id: 10,
          name: "Ford Ranger Raptor 3.0 V6",
          brand: "Ford",
          price: 1299000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkAP8_0fM7-es-s0TkuWfES4ERnhn3kRzgpiERtCEFyw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSX-ZqLNONfwQeU5XwtL9ZqejukswL1TpUpsr1-76jc3w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQH0fOuAoH-XV1q7BGhIXSq8KXrWfeO2ChqH9Z6Zjgvg&s=10",
          engine: "Xăng EcoBoost 3.0L V6 Twin-Turbo (397 HP / 583 Nm)",
          transmission: "Tự động 10 cấp điện tử",
          fuel: "Xăng",
          description:
            "Vua bán tải hiệu năng cao chuyên nghiệp, trang bị hệ thống giảm xóc FOX Live Valve 2.5 inch trượt địa hình. Sở hữu 7 chế độ lái linh hoạt (bao gồm chế độ Baja chuyên đua sa mạc), hệ thống khóa vi sai trước/sau và ống xả thể thao điều chỉnh độ vang.",
        },
        {
          id: 11,
          name: "Ford Everest Titanium+ 4x4",
          brand: "Ford",
          price: 1468000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiZtZyv9cLXgHdi-7v-PjeTIL5tGeeU3tpnMYplS6XDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTYj1liAKQcUeUhRU01jidOFrEQonbqh2FvYukozZM4w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfRprvZIOazCuK7ZgS3R8vKBIHAlTpdmYSX9Y03eOZBw&s=10",
          engine: "Bi-Turbo Diesel 2.0L i4 (210 HP / 500 Nm)",
          transmission: "Tự động 10 cấp điện tử",
          fuel: "Dầu (Diesel)",
          description:
            "SUV 7 chỗ gầm cao hầm hố, khả năng cách âm đỉnh cao và giàu công nghệ an toàn hàng đầu phân khúc. Hệ thống dẫn động 2 cầu 4x4 thông minh, màn hình trung tâm dọc 12 inch chạy SYNC 4A, camera 360 độ sắc nét và hỗ trợ đỗ xe tự động.",
        },
        {
          id: 12,
          name: "Hyundai Tucson 2.0 Diesel",
          brand: "Hyundai",
          price: 959000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStMbKbjpRugZbAa8Jxhz2GPdFPKMMrw8fJwjRdQ-TBZQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZ8ey04y0-7pSS5gagfiCQrjMaVJBoxy_NPolImcNVTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-AHImYzA1sSv1yPO9EeJObAW1AWSceaxllVKBvl_VJg&s=10",
          engine: "Diesel Smartstream D2.0 (186 HP / 416 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Dầu (Diesel)",
          description:
            "Crossover sở hữu thiết kế ngoại thất táo bạo, khả năng vận hành mạnh mẽ, bốc và tiết kiệm nhiên liệu tối ưu. Nổi bật với lưới tản nhiệt hình khối thông minh, cần số điện tử dạng nút bấm, cửa sổ trời toàn cảnh và gói an toàn Hyundai SmartSense.",
        },
        {
          id: 13,
          name: "Hyundai Accent 1.5 AT",
          brand: "Hyundai",
          price: 489000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqxAlh0ojNuYt82BpLC-BRYGclFmTXJd-gJrp2lEF6WQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSahuOZxstBhmyAYM9STEFGftWiVL3FaEJV6jgiXXgjVQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NEb-vWA47bMBzZmMi3bTdDEKeRmafgiCvZAUuKuHlA&s=10",
          engine: "Xăng Smartstream G1.5 (115 HP / 144 Nm)",
          transmission: "Tự động vô cấp thông minh iVT",
          fuel: "Xăng",
          description:
            "Sedan hạng B phổ thông, tiện nghi phong phú vượt tầm giá. Thiết kế phong cách Fastback thể thao trẻ trung, màn hình giải trí 8 inch tích hợp Apple CarPlay/Android Auto không dây, sạc điện thoại không dây và tính năng mở cốp thông minh.",
        },
        {
          id: 14,
          name: "Honda CR-V e:HEV RS",
          brand: "Honda",
          price: 1259000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYwkQ2_Bnn715DhM8OfuYNpzg5ozBqKoyC2evRYhhUw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYKCZvpPeMChk_J4Lbs9BbrSrpBDSw5G69aSbUDdtrsw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8Vqeig2JBKNtNlJ5UGdtK69cmsDwRARmVSINyLF-S_Q&s=10",
          engine: "Xăng 2.0L kết hợp 2 mô-tơ điện (Tổng công suất 204 HP / 335 Nm)",
          transmission: "Tự động vô cấp E-CVT",
          fuel: "Xăng Hybrid",
          description:
            "SUV 5 chỗ thể thao mang lại trải nghiệm lái phấn khích chuẩn Honda Sensing. Khả năng tiết kiệm nhiên liệu tối ưu chỉ khoảng 5.2L/100km trong đô thị, trang bị cửa sổ trời toàn cảnh Panorama, hệ thống âm thanh 12 loa Bose và màn hình HUD.",
        },
        {
          id: 15,
          name: "Mazda CX-5 2.0 Premium",
          brand: "Mazda",
          price: 829000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpW39XsAvfNmzgS3h7r2TjxeeJTUhyLpVsnzGlKpS-mQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTInC9__STOHLHNime6eFjQhx4SSUEX5S8lyJn71cJTqQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIF5WKKGY123T08e8kSO_mXGGGMgDtg41luLhyq88TKw&s=10",
          engine: "Xăng SkyActiv-G 2.0L (154 HP / 200 Nm)",
          transmission: "Tự động 6 cấp",
          fuel: "Xăng",
          description:
            "Mẫu Crossover bán chạy hàng đầu phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế. Trang bị màn hình hiển thị kính lái HUD, gương chiếu hậu chống chói tự động, cốp điện rảnh tay, 10 loa Bose cao cấp và gói an toàn chủ động i-Activsense.",
        },
        {
          id: 16,
          name: "Kia Carnival 2.2D Signature",
          brand: "Kia",
          price: 1759000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDrQOfx7kICr3cyGjHqTHm_SMnzFbZOde_TVN6qS1FXw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5v0u6MMN_-u8H5QgBA6eq9gRrBtD3urv_V9zGDT_5ig&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKUw3TRHK3bFJ7Hv5brQb8FBAB1NJEcZdPSkYD5-8ysg&s=10",
          engine: "Diesel Smartstream 2.2L (199 HP / 440 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Dầu (Diesel)",
          description:
            "Xe gia đình hạng sang (MPV) cỡ lớn rộng rãi, trang bị đầy đủ như khoang hạng thương gia. Hàng ghế thứ hai chỉnh điện thư giãn tích hợp sưởi/làm mát, cửa sổ trời đôi độc lập, rèm che nắng và hệ thống âm thanh 12 loa Bose.",
        },
        {
          id: 17,
          name: "Audi Q7 45 TFSI quattro",
          brand: "Audi",
          price: 3700000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsMi5fmiZg1cQubrLMpSpHHiwFbiC2puLtGW-dhi1Evw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2Z49zJQSa-QgYOK6PnDsCeXGbIjDlMy_UJgY5AVG0w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXio_hwx7mM0zgI01Sdx4o-ZLySmfpn8qKouBDzFESQA&s=10",
          engine: "Xăng 2.0L TFSI Mild-Hybrid MHEV (252 HP / 370 Nm)",
          transmission: "Tự động 8 cấp Tiptronic",
          fuel: "Xăng",
          description:
            "SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian quattro danh tiếng. Thiết kế lưới tản nhiệt Singleframe bát giác bề thế, cụm đèn pha LED Matrix sắc sảo, buồng lái ảo Audi Virtual Cockpit và dàn âm thanh 3D Bang & Olufsen 19 loa.",
        },
        {
          id: 18,
          name: "Lexus RX350 Luxury",
          brand: "Lexus",
          price: 4330000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOKn1MNoCINsLRyMryNK-gqu0xXC7E4vegTJpqDpxwKg&s, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlhxOxreBx7dZ0WVilniwHUvofB_NaKB71xDtEZh1WYA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOMkj7dV-dZSUjqzqpyhMVxWrlA_BEZeQ-CC4u_rdp7Q&s=10",
          engine: "Xăng 2.4L Turbo I4 (275 HP / 430 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Xăng",
          description:
            "Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt. Nội thất bọc da Semi-Aniline cao cấp, màn hình trung tâm cảm ứng 14 inch, hệ thống âm thanh vòm 21 loa Mark Levinson và gói công nghệ an toàn Lexus Safety System+.",
        },
        {
          id: 19,
          name: "Lamborghini Urus S",
          brand: "Lamborghini",
          price: 16500000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHS2yGPTepN8pLd6xYDDwMDfzd7nNgw0Wb_yTGlGCm0A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKtHAnyoB_1kLYyhE81rizhXi7nkTxwh82w-nitYue7g&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ098BS6eDBP3owhuf17ApxAaDbgMExcwrI0huLgTUudQ&s=10",
          engine: "Xăng V8 4.0L Twin-Turbo (666 HP / 850 Nm)",
          transmission: "Tự động 8 cấp",
          fuel: "Xăng",
          description:
            "Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Hệ thống dẫn động 4 bánh toàn thời gian, treo khí nén thích ứng thông minh và núm xoay chế độ lái ANIMA gồm Strada, Sport, Corsa, Terra, Sabbia và Neve.",
        },
        {
          id: 20,
          name: "Ferrari F8 Tributo",
          brand: "Ferrari",
          price: 19000000000,
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE3sDpn33xn9qTk5wTWc6EFHdkMEssFXSa6l-0td5o2w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgqtnNRCxzmqTFoL6wSi62G-QtJKf_vgT58IWQOpjJvg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTw0GaWZqHRGG_hseloDpgEOje7D5M_ahm2lMqzkTrlTg&s=10",
          engine: "Xăng V8 3.9L Twin-Turbo (720 HP / 770 Nm)",
          transmission: "Ly hợp kép 7 cấp F1",
          fuel: "Xăng",
          description:
            "Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h, trang bị hốc gió khí động học S-Duct lấy cảm hứng từ xe đua Công thức 1 giúp tăng lực ép xuống đường.",
        },
      ];

      let currentSlideImages = [];
      let currentSlideIndex = 0;

      function updateSliderUI() {
        const mainImg = document.getElementById("mainCarImage");
        const counter = document.getElementById("slideCounter");
        if (!mainImg || currentSlideImages.length === 0) return;

        mainImg.src = currentSlideImages[currentSlideIndex];
        if (counter) {
          counter.innerText = `${currentSlideIndex + 1} / ${currentSlideImages.length}`;
        }

        document.querySelectorAll(".car-thumb-btn").forEach((btn, idx) => {
          if (idx === currentSlideIndex) {
            btn.classList.add("ring-2", "ring-indigo-500", "opacity-100");
            btn.classList.remove("opacity-60");
          } else {
            btn.classList.remove("ring-2", "ring-indigo-500", "opacity-100");
            btn.classList.add("opacity-60");
          }
        });
      }

      function changeCarSlide(step) {
        if (currentSlideImages.length <= 1) return;
        currentSlideIndex = (currentSlideIndex + step + currentSlideImages.length) % currentSlideImages.length;
        updateSliderUI();
      }

      function goToCarSlide(index) {
        if (index < 0 || index >= currentSlideImages.length) return;
        currentSlideIndex = index;
        updateSliderUI();
      }

      document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") changeCarSlide(-1);
        if (e.key === "ArrowRight") changeCarSlide(1);
      });

      async function loadCarDetail() {
        const urlParams = new URLSearchParams(window.location.search);
        const id = parseInt(urlParams.get("id")) || 1;

        let cars = [];
        try {
          const res = await fetch("../php/get_cars.php");
          cars = await res.json();
        } catch (e) {
          cars = fallbackCars;
        }

        const car = (Array.isArray(cars) && cars.find((c) => Number(c.id) === Number(id))) || fallbackCars[0];
        currentSlideImages = getCarImages(car.image);
        currentSlideIndex = 0;
        const hasMultiple = currentSlideImages.length > 1;

        document.getElementById("detailContainer").innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: Image Slider & Badge -->
                    <div class="lg:col-span-7 space-y-3">
                        <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-slate-900 border border-gray-200 dark:border-white/10 shadow-2xl group">
                            <img id="mainCarImage" src="${currentSlideImages[0]}" class="w-full h-full object-cover transition-all duration-300" onerror="this.onerror=null; this.src=FALLBACK_CAR_IMG">
                            
                            <span class="absolute top-4 left-4 bg-indigo-600 text-white text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider shadow-md">
                                ${escapeHtml(car.brand)}
                            </span>

                            ${
                              hasMultiple
                                ? `
                              <!-- Bộ đếm số ảnh -->
                              <span id="slideCounter" class="absolute top-4 right-4 bg-black/65 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-white/15">
                                1 / ${currentSlideImages.length}
                              </span>

                              <!-- Nút mũi tên Trái -->
                              <button type="button" onclick="changeCarSlide(-1)" title="Ảnh trước (Mũi tên trái)"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/55 hover:bg-indigo-600 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition shadow-lg">
                                <i class="fa-solid fa-chevron-left"></i>
                              </button>

                              <!-- Nút mũi tên Phải -->
                              <button type="button" onclick="changeCarSlide(1)" title="Ảnh tiếp theo (Mũi tên phải)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/55 hover:bg-indigo-600 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition shadow-lg">
                                <i class="fa-solid fa-chevron-right"></i>
                              </button>
                            `
                                : ""
                            }
                        </div>

                        <!-- Dải ảnh thu nhỏ (Thumbnails) -->
                        ${
                          hasMultiple
                            ? `
                          <div class="flex gap-2.5 overflow-x-auto py-1">
                            ${currentSlideImages
                              .map(
                                (imgUrl, idx) => `
                              <button type="button" onclick="goToCarSlide(${idx})"
                                class="car-thumb-btn relative flex-shrink-0 w-20 h-14 rounded-xl overflow-hidden border border-gray-300 dark:border-white/15 transition ${idx === 0 ? "ring-2 ring-indigo-500 opacity-100" : "opacity-60 hover:opacity-100"}">
                                <img src="${imgUrl}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src=FALLBACK_CAR_IMG">
                              </button>
                            `,
                              )
                              .join("")}
                          </div>
                        `
                            : ""
                        }

                        <!-- 3 Mini Specs -->
                        <div class="grid grid-cols-3 gap-3 text-xs pt-1">
                            <div class="bg-gray-50 dark:bg-slate-900/80 p-3 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                                <i class="fa-solid fa-gauge-high text-indigo-600 dark:text-indigo-500 mb-1"></i>
                                <div class="text-[10px] text-gray-500 dark:text-gray-400">Động cơ</div>
                                <div class="font-bold text-slate-900 dark:text-white truncate">${escapeHtml(car.engine || "N/A")}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-slate-900/80 p-3 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                                <i class="fa-solid fa-sliders text-indigo-600 dark:text-indigo-500 mb-1"></i>
                                <div class="text-[10px] text-gray-500 dark:text-gray-400">Hộp số</div>
                                <div class="font-bold text-slate-900 dark:text-white truncate">${escapeHtml(car.transmission || "Tự động")}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-slate-900/80 p-3 rounded-2xl border border-gray-200 dark:border-white/10 text-center">
                                <i class="fa-solid fa-gas-pump text-indigo-600 dark:text-indigo-500 mb-1"></i>
                                <div class="text-[10px] text-gray-500 dark:text-gray-400">Nhiên liệu</div>
                                <div class="font-bold text-slate-900 dark:text-white truncate">${escapeHtml(car.fuel || "Xăng")}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Info & Pricing -->
                    <div class="lg:col-span-5 space-y-6">
                        <div>
                            <span class="text-xs text-indigo-600 dark:text-indigo-400 font-bold uppercase tracking-widest">${escapeHtml(car.brand)} Supercar</span>
                            <h1 class="text-3xl font-black font-heading text-slate-900 dark:text-white mt-1">${escapeHtml(car.name)}</h1>
                            <div class="text-3xl font-black text-indigo-600 dark:text-indigo-500 font-heading mt-2">
                                ${Number(car.price).toLocaleString("vi-VN")} VNĐ
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-slate-900/80 p-4 rounded-2xl border border-gray-200 dark:border-white/10 space-y-2 text-xs">
                            <div class="text-gray-500 dark:text-gray-400 uppercase font-bold text-[10px]">Giới thiệu mẫu xe</div>
                            <p class="text-slate-700 dark:text-gray-300 leading-relaxed break-words whitespace-pre-line">${escapeHtml(car.description || "Mẫu xe sở hữu thiết kế tuyệt hảo, trang bị động cơ hiệu năng cao và công nghệ an toàn hàng đầu thế giới.")}</p>
                        </div>

                        <!-- Loan Preview -->
                        <div class="bg-indigo-50 dark:bg-indigo-600/10 p-4 rounded-2xl border border-indigo-200 dark:border-indigo-500/30 text-xs space-y-1">
                            <div class="flex justify-between text-slate-700 dark:text-gray-300">
                                <span>Trả trước 20%:</span>
                                <strong class="text-slate-900 dark:text-white">${Number(car.price * 0.2).toLocaleString("vi-VN")} đ</strong>
                            </div>
                            <div class="flex justify-between text-slate-700 dark:text-gray-300">
                                <span>Ước tính góp tháng (5 năm):</span>
                                <strong class="text-indigo-600 dark:text-indigo-400 font-bold">${Number((car.price * 0.8) / 60 + (car.price * 0.8 * 0.085) / 12).toLocaleString("vi-VN")} đ</strong>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-2">
                            <a href="tel:0765650114" class="w-full bg-indigo-600 hover:bg-violet-700 text-white font-bold py-3.5 rounded-2xl text-xs flex items-center justify-center gap-2 transition shadow-lg shadow-indigo-600/30">
                                <i class="fa-solid fa-phone"></i> Gọi Hotline Tư Vấn Ngay: 0765.650.114
                            </a>
                            <a href="car_collection.html" class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-gray-300 font-bold py-3 rounded-2xl text-xs flex items-center justify-center gap-2 border border-gray-200 dark:border-white/10 transition">
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

### file login.html:
```html
<!doctype html>
<html lang="vi" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Nhập Quản Trị - SHOWROOM 4TL</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=Montserrat:wght@700;800;900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/theme.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body
    class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 min-h-screen flex items-center justify-center p-4 font-sans hero-gradient-mesh transition-colors duration-300 relative">
    <!-- Nút chuyển Dark/Light nhanh ở góc trên phải -->
    <!-- <button
      id="themeToggle"
      type="button"
      title="Chuyển chế độ Sáng / Tối"
      class="fixed top-5 right-5 z-50 w-10 h-10 rounded-xl bg-white/90 hover:bg-gray-100 text-indigo-600 dark:bg-slate-800/90 dark:hover:bg-slate-700 dark:text-amber-300 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-md">
      <i id="themeIcon" class="fa-solid fa-sun text-base"></i>
    </button> -->

    <div
      class="w-full max-w-md bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl p-8 rounded-3xl border border-gray-200 dark:border-indigo-500/20 shadow-2xl space-y-6">
      <div class="text-center space-y-2">
        <div
          class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-700 flex items-center justify-center text-white mx-auto shadow-lg shadow-indigo-600/30">
          <i class="fa-solid fa-lock text-xl"></i>
        </div>
        <h1 class="text-2xl font-black text-slate-900 dark:text-white font-heading tracking-wide">
          CỔNG QUẢN TRỊ VIÊN
        </h1>
        <p class="text-xs text-gray-500 dark:text-gray-400">Đăng nhập tài khoản điều hành Showroom 4TL</p>
      </div>

      <div
        id="errorBox"
        class="hidden bg-rose-500/10 border border-rose-500/40 text-rose-600 dark:text-rose-400 p-3.5 rounded-2xl text-xs text-center flex items-center justify-center gap-2">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span id="errorText"></span>
      </div>

      <form id="loginForm" class="space-y-4 text-xs">
        <div>
          <label class="block text-slate-700 dark:text-gray-300 mb-1 font-bold">Tài khoản quản trị</label>
          <div class="relative">
            <i class="fa-solid fa-user absolute left-3.5 top-3.5 text-gray-400"></i>
            <input
              type="text"
              id="username"
              required
              placeholder="Nhập tài khoản (VD: admin)"
              class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 transition" />
          </div>
        </div>

        <div>
          <label class="block text-slate-700 dark:text-gray-300 mb-1 font-bold">Mật khẩu</label>
          <div class="relative">
            <i class="fa-solid fa-key absolute left-3.5 top-3.5 text-gray-400"></i>
            <input
              type="password"
              id="password"
              required
              placeholder="Nhập mật khẩu (VD: admin123)"
              class="w-full pl-10 pr-11 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 transition" />
            <!-- Nút con mắt Show/Hide Password -->
            <button
              type="button"
              id="togglePasswordBtn"
              title="Hiện / Ẩn mật khẩu"
              class="absolute right-3.5 top-3 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition focus:outline-none">
              <i id="togglePasswordIcon" class="fa-solid fa-eye text-sm"></i>
            </button>
          </div>
        </div>

        <div
          class="p-3 rounded-xl bg-indigo-50/70 dark:bg-slate-950/60 border border-indigo-100 dark:border-white/5 text-[11px] text-gray-600 dark:text-gray-400">
          <span class="text-indigo-600 dark:text-indigo-400 font-bold">Gợi ý đăng nhập thử nghiệm:</span>
          <br />
          Tài khoản:
          <code class="text-slate-900 dark:text-white font-mono font-bold">admin</code>
          | Mật khẩu:
          <code class="text-slate-900 dark:text-white font-mono font-bold">admin123</code>
        </div>

        <button
          type="submit"
          class="w-full bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2">
          <i class="fa-solid fa-right-to-bracket"></i>
          Đăng Nhập Hệ Thống
        </button>
      </form>

      <div class="text-center pt-2 border-t border-gray-200 dark:border-white/10">
        <a
          href="../index.html"
          class="text-xs text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-white transition flex items-center justify-center gap-1.5">
          <i class="fa-solid fa-arrow-left"></i>
          Quay lại trang chủ Showroom
        </a>
      </div>
    </div>

    <script>
      // Tính năng Show / Hide Password
      const togglePasswordBtn = document.getElementById("togglePasswordBtn");
      const passwordInput = document.getElementById("password");
      const togglePasswordIcon = document.getElementById("togglePasswordIcon");

      togglePasswordBtn.addEventListener("click", function () {
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";
        togglePasswordIcon.className = isPassword
          ? "fa-solid fa-eye-slash text-sm text-indigo-500"
          : "fa-solid fa-eye text-sm";
      });

      // Nếu đã đăng nhập sẵn thì chuyển thẳng vào admin.html
      (async function () {
        try {
          const res = await fetch("../php/auth_check.php");
          const data = await res.json();
          if (data.logged_in) {
            window.location.replace("admin.html");
          }
        } catch (e) {}
      })();

      document.getElementById("loginForm").onsubmit = async function (e) {
        e.preventDefault();
        const errorBox = document.getElementById("errorBox");
        const errorText = document.getElementById("errorText");
        errorBox.classList.add("hidden");

        try {
          const res = await fetch("../php/login.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              username: document.getElementById("username").value,
              password: document.getElementById("password").value,
            }),
          });
          const data = await res.json();

          if (data.status === "success") {
            window.location.replace("admin.html");
          } else {
            errorText.innerText = data.message || "Đăng nhập thất bại!";
            errorBox.classList.remove("hidden");
          }
        } catch (err) {
          errorText.innerText = "Lỗi kết nối máy chủ PHP!";
          errorBox.classList.remove("hidden");
        }
      };
    </script>
  </body>
</html>
```

### file login.php:
```php
<?php
session_start();
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Phương thức không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
$username = trim($input['username'] ?? '');
$password = $input['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ tài khoản và mật khẩu!"], JSON_UNESCAPED_UNICODE);
    exit();
}

// 1. Xác thực chính qua bảng users trong MySQL
if ($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $user['username'];
            echo json_encode(["status" => "success", "message" => "Đăng nhập thành công!"], JSON_UNESCAPED_UNICODE);
            exit();
        }

        echo json_encode(["status" => "error", "message" => "Tài khoản hoặc mật khẩu không chính xác!"], JSON_UNESCAPED_UNICODE);
        exit();
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Lỗi truy vấn: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
        exit();
    }
}

// 2. Chế độ dự phòng khi chưa bật MySQL
if ($username === 'admin' && $password === 'admin123') {
    session_regenerate_id(true);
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_user'] = 'admin';
    echo json_encode(["status" => "success", "message" => "Đăng nhập thành công!"], JSON_UNESCAPED_UNICODE);
    exit();
}

echo json_encode(["status" => "error", "message" => "Tài khoản hoặc mật khẩu không chính xác!"], JSON_UNESCAPED_UNICODE);
?>
```

### file logout.php:
```php
<?php
session_start();
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();
header('Location: ../index.html');
exit();
?>
```

### file bot_train.php:
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
if (!$input && isset($_POST['message'])) {
    $input = $_POST;
}

function e($str)
{
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

function toLowerUtf8($str)
{
    return function_exists('mb_strtolower') ? mb_strtolower($str, 'UTF-8') : strtolower($str);
}

function strPosUtf8($haystack, $needle)
{
    return function_exists('mb_strpos') ? mb_strpos($haystack, $needle) : strpos($haystack, $needle);
}

function removeAccents($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/u", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/u", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/u", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/u", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/u", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/u", 'y', $str);
    $str = preg_replace("/(đ)/u", 'd', $str);
    return $str;
}

// Kiểm tra từ/cụm từ độc lập (tránh khớp nhầm chuỗi con)
function hasWord($haystack, $needle)
{
    $pattern = '/(?<![a-z0-9])' . preg_quote($needle, '/') . '(?![a-z0-9])/i';
    return preg_match($pattern, $haystack) === 1;
}

// Trích xuất mã nhận diện riêng của từng xe, loại bỏ các hậu tố phổ thông
function getCarIdentifiers($carNameNoAccent, $brandNoAccent)
{
    $stopWords = [
        'plus',
        'amg',
        'luxury',
        'premium',
        'signature',
        'tributo',
        'quattro',
        'pure',
        'excellence',
        'carrera',
        'diesel',
        'hybrid',
        'hev',
        'e:hev',
        'titanium',
        'titanium+',
        '4x4',
        'at',
        'rs',
        'v6',
        's',
        'class',
        'c-class'
    ];

    $identifiers = [$carNameNoAccent];
    // Bỏ tên hãng khỏi tên xe để lấy phần tên dòng/mã xe
    $modelPart = trim(str_replace($brandNoAccent, '', $carNameNoAccent));
    if (strlen($modelPart) >= 2 && !in_array($modelPart, $stopWords)) {
        $identifiers[] = $modelPart;
    }

    $tokens = preg_split('/[\s\/]+/', $modelPart);
    foreach ($tokens as $token) {
        $tokenClean = trim($token, '+-');
        if (strlen($tokenClean) >= 2 && !in_array($tokenClean, $stopWords)) {
            // Ưu tiên token có chứa chữ số (vf3, c300, g63, 911, cx-5...) hoặc tên riêng >= 4 ký tự (camry, urus...)
            if (preg_match('/\d/', $tokenClean) || strlen($tokenClean) >= 4) {
                $identifiers[] = $tokenClean;
            }
        }
    }

    // Bổ sung biến thể có dấu cách cho mã VF (vd: "vf 3", "vf 5", "vf 8")
    if (preg_match('/\bvf(\d+)\b/', $carNameNoAccent, $m)) {
        $identifiers[] = 'vf ' . $m[1];
    }

    return array_unique($identifiers);
}

$message = toLowerUtf8(trim($input['message'] ?? ''));

if (empty($message)) {
    echo json_encode([
        "reply" => "Chào quý khách! Em là Trợ lý AI Showroom 4TL. Em có thể tư vấn mẫu xe, mức giá, chương trình trả góp hay đăng ký lái thử cho quý khách."
    ], JSON_UNESCAPED_UNICODE);
    exit();
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
                $kwClean = toLowerUtf8(trim($kw));
                $kwNoAccent = removeAccents($kwClean);
                if (empty($kwNoAccent)) continue;

                if (hasWord($msgNoAccent, $kwNoAccent)) {
                    $score += 3;
                } else {
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
            $reply = nl2br(htmlspecialchars($bestResponse, ENT_QUOTES, 'UTF-8'));
        }
    } catch (Exception $e) {
        // Bỏ qua nếu bảng chưa tồn tại
    }
}

// ƯU TIÊN 2: LẤY DANH SÁCH XE TỪ PDO
$cars = [];
if (isset($pdo) && $pdo) {
    try {
        $cars = $pdo->query("SELECT * FROM cars ORDER BY id DESC")->fetchAll();
    } catch (Exception $e) {
        $cars = [];
    }
}

if (empty($cars)) {
    $cars = [
        [
            'id' => 20,
            'name' => 'Ferrari F8 Tributo',
            'brand' => 'Ferrari',
            'price' => 19000000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE3sDpn33xn9qTk5wTWc6EFHdkMEssFXSa6l-0td5o2w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgqtnNRCxzmqTFoL6wSi62G-QtJKf_vgT58IWQOpjJvg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTw0GaWZqHRGG_hseloDpgEOje7D5M_ahm2lMqzkTrlTg&s=10',
            'engine' => 'Xăng V8 3.9L Twin-Turbo (720 HP / 770 Nm)',
            'transmission' => 'Ly hợp kép 7 cấp F1',
            'fuel' => 'Xăng',
            'description' => 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h, trang bị hốc gió khí động học S-Duct lấy cảm hứng từ xe đua Công thức 1 giúp tăng lực ép xuống đường.'
        ],
        [
            'id' => 19,
            'name' => 'Lamborghini Urus S',
            'brand' => 'Lamborghini',
            'price' => 16500000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHS2yGPTepN8pLd6xYDDwMDfzd7nNgw0Wb_yTGlGCm0A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKtHAnyoB_1kLYyhE81rizhXi7nkTxwh82w-nitYue7g&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ098BS6eDBP3owhuf17ApxAaDbgMExcwrI0huLgTUudQ&s=10',
            'engine' => 'Xăng V8 4.0L Twin-Turbo (666 HP / 850 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Hệ thống dẫn động 4 bánh toàn thời gian, treo khí nén thích ứng thông minh và núm xoay chế độ lái ANIMA gồm Strada, Sport, Corsa, Terra, Sabbia và Neve.'
        ],
        [
            'id' => 18,
            'name' => 'Lexus RX350 Luxury',
            'brand' => 'Lexus',
            'price' => 4330000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOKn1MNoCINsLRyMryNK-gqu0xXC7E4vegTJpqDpxwKg&s, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlhxOxreBx7dZ0WVilniwHUvofB_NaKB71xDtEZh1WYA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOMkj7dV-dZSUjqzqpyhMVxWrlA_BEZeQ-CC4u_rdp7Q&s=10',
            'engine' => 'Xăng 2.4L Turbo I4 (275 HP / 430 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt. Nội thất bọc da Semi-Aniline cao cấp, màn hình trung tâm cảm ứng 14 inch, hệ thống âm thanh vòm 21 loa Mark Levinson và gói công nghệ an toàn Lexus Safety System+.'
        ],
        [
            'id' => 17,
            'name' => 'Audi Q7 45 TFSI quattro',
            'brand' => 'Audi',
            'price' => 3700000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsMi5fmiZg1cQubrLMpSpHHiwFbiC2puLtGW-dhi1Evw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2Z49zJQSa-QgYOK6PnDsCeXGbIjDlMy_UJgY5AVG0w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXio_hwx7mM0zgI01Sdx4o-ZLySmfpn8qKouBDzFESQA&s=10',
            'engine' => 'Xăng 2.0L TFSI Mild-Hybrid MHEV (252 HP / 370 Nm)',
            'transmission' => 'Tự động 8 cấp Tiptronic',
            'fuel' => 'Xăng',
            'description' => 'SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian quattro danh tiếng. Thiết kế lưới tản nhiệt Singleframe bát giác bề thế, cụm đèn pha LED Matrix sắc sảo, buồng lái ảo Audi Virtual Cockpit và dàn âm thanh 3D Bang & Olufsen 19 loa.'
        ],
        [
            'id' => 16,
            'name' => 'Kia Carnival 2.2D Signature',
            'brand' => 'Kia',
            'price' => 1759000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDrQOfx7kICr3cyGjHqTHm_SMnzFbZOde_TVN6qS1FXw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5v0u6MMN_-u8H5QgBA6eq9gRrBtD3urv_V9zGDT_5ig&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKUw3TRHK3bFJ7Hv5brQb8FBAB1NJEcZdPSkYD5-8ysg&s=10',
            'engine' => 'Diesel Smartstream 2.2L (199 HP / 440 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Xe gia đình hạng sang (MPV) cỡ lớn rộng rãi, trang bị đầy đủ như khoang hạng thương gia. Hàng ghế thứ hai chỉnh điện thư giãn tích hợp sưởi/làm mát, cửa sổ trời đôi độc lập, rèm che nắng và hệ thống âm thanh 12 loa Bose.'
        ],
        [
            'id' => 15,
            'name' => 'Mazda CX-5 2.0 Premium',
            'brand' => 'Mazda',
            'price' => 829000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpW39XsAvfNmzgS3h7r2TjxeeJTUhyLpVsnzGlKpS-mQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTInC9__STOHLHNime6eFjQhx4SSUEX5S8lyJn71cJTqQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIF5WKKGY123T08e8kSO_mXGGGMgDtg41luLhyq88TKw&s=10',
            'engine' => 'Xăng SkyActiv-G 2.0L (154 HP / 200 Nm)',
            'transmission' => 'Tự động 6 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu Crossover bán chạy hàng đầu phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế. Trang bị màn hình hiển thị kính lái HUD, gương chiếu hậu chống chói tự động, cốp điện rảnh tay, 10 loa Bose cao cấp và gói an toàn chủ động i-Activsense.'
        ],
        [
            'id' => 14,
            'name' => 'Honda CR-V e:HEV RS',
            'brand' => 'Honda',
            'price' => 1259000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYwkQ2_Bnn715DhM8OfuYNpzg5ozBqKoyC2evRYhhUw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYKCZvpPeMChk_J4Lbs9BbrSrpBDSw5G69aSbUDdtrsw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8Vqeig2JBKNtNlJ5UGdtK69cmsDwRARmVSINyLF-S_Q&s=10',
            'engine' => 'Xăng 2.0L kết hợp 2 mô-tơ điện (Tổng công suất 204 HP / 335 Nm)',
            'transmission' => 'Tự động vô cấp E-CVT',
            'fuel' => 'Xăng Hybrid',
            'description' => 'SUV 5 chỗ thể thao mang lại trải nghiệm lái phấn khích chuẩn Honda Sensing. Khả năng tiết kiệm nhiên liệu tối ưu chỉ khoảng 5.2L/100km trong đô thị, trang bị cửa sổ trời toàn cảnh Panorama, hệ thống âm thanh 12 loa Bose và màn hình HUD.'
        ],
        [
            'id' => 13,
            'name' => 'Hyundai Accent 1.5 AT',
            'brand' => 'Hyundai',
            'price' => 489000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqxAlh0ojNuYt82BpLC-BRYGclFmTXJd-gJrp2lEF6WQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSahuOZxstBhmyAYM9STEFGftWiVL3FaEJV6jgiXXgjVQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NEb-vWA47bMBzZmMi3bTdDEKeRmafgiCvZAUuKuHlA&s=10',
            'engine' => 'Xăng Smartstream G1.5 (115 HP / 144 Nm)',
            'transmission' => 'Tự động vô cấp thông minh iVT',
            'fuel' => 'Xăng',
            'description' => 'Sedan hạng B phổ thông, tiện nghi phong phú vượt tầm giá. Thiết kế phong cách Fastback thể thao trẻ trung, màn hình giải trí 8 inch tích hợp Apple CarPlay/Android Auto không dây, sạc điện thoại không dây và tính năng mở cốp thông minh.'
        ],
        [
            'id' => 12,
            'name' => 'Hyundai Tucson 2.0 Diesel',
            'brand' => 'Hyundai',
            'price' => 959000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStMbKbjpRugZbAa8Jxhz2GPdFPKMMrw8fJwjRdQ-TBZQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZ8ey04y0-7pSS5gagfiCQrjMaVJBoxy_NPolImcNVTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-AHImYzA1sSv1yPO9EeJObAW1AWSceaxllVKBvl_VJg&s=10',
            'engine' => 'Diesel Smartstream D2.0 (186 HP / 416 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Crossover sở hữu thiết kế ngoại thất táo bạo, khả năng vận hành mạnh mẽ, bốc và tiết kiệm nhiên liệu tối ưu. Nổi bật với lưới tản nhiệt hình khối thông minh, cần số điện tử dạng nút bấm, cửa sổ trời toàn cảnh và gói an toàn Hyundai SmartSense.'
        ],
        [
            'id' => 11,
            'name' => 'Ford Everest Titanium+ 4x4',
            'brand' => 'Ford',
            'price' => 1468000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiZtZyv9cLXgHdi-7v-PjeTIL5tGeeU3tpnMYplS6XDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTYj1liAKQcUeUhRU01jidOFrEQonbqh2FvYukozZM4w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfRprvZIOazCuK7ZgS3R8vKBIHAlTpdmYSX9Y03eOZBw&s=10',
            'engine' => 'Bi-Turbo Diesel 2.0L i4 (210 HP / 500 Nm)',
            'transmission' => 'Tự động 10 cấp điện tử',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'SUV 7 chỗ gầm cao hầm hố, khả năng cách âm đỉnh cao và giàu công nghệ an toàn hàng đầu phân khúc. Hệ thống dẫn động 2 cầu 4x4 thông minh, màn hình trung tâm dọc 12 inch chạy SYNC 4A, camera 360 độ sắc nét và hỗ trợ đỗ xe tự động.'
        ],
        [
            'id' => 10,
            'name' => 'Ford Ranger Raptor 3.0 V6',
            'brand' => 'Ford',
            'price' => 1299000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkAP8_0fM7-es-s0TkuWfES4ERnhn3kRzgpiERtCEFyw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSX-ZqLNONfwQeU5XwtL9ZqejukswL1TpUpsr1-76jc3w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQH0fOuAoH-XV1q7BGhIXSq8KXrWfeO2ChqH9Z6Zjgvg&s=10',
            'engine' => 'Xăng EcoBoost 3.0L V6 Twin-Turbo (397 HP / 583 Nm)',
            'transmission' => 'Tự động 10 cấp điện tử',
            'fuel' => 'Xăng',
            'description' => 'Vua bán tải hiệu năng cao chuyên nghiệp, trang bị hệ thống giảm xóc FOX Live Valve 2.5 inch trượt địa hình. Sở hữu 7 chế độ lái linh hoạt (bao gồm chế độ Baja chuyên đua sa mạc), hệ thống khóa vi sai trước/sau và ống xả thể thao điều chỉnh độ vang.'
        ],
        [
            'id' => 9,
            'name' => 'Toyota Corolla Cross 1.8HEV',
            'brand' => 'Toyota',
            'price' => 905000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpA_ZtVNe8sOc_-tGXiFue--SWAvHYn4hqdXnj1v5NYg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuPdKKZWfVIlpfJtWjiH1WDTCkzs65ZGLNbW8xdkYXA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaemDP4gzPH3lDaNIymrWag_h6ogYiqv8TLc60aEacSA&s=10',
            'engine' => 'Xăng 1.8L kết hợp mô-tơ điện Hybrid (Tổng công suất 122 HP)',
            'transmission' => 'Tự động vô cấp E-CVT',
            'fuel' => 'Xăng Hybrid',
            'description' => 'SUV đô thị xanh tiết kiệm nhiên liệu tối ưu nhờ công suất tự sạc Hybrid tiên tiến. Trang bị gói công nghệ an toàn Toyota Safety Sense, camera toàn cảnh 360 độ, cửa sổ trời toàn cảnh và vận hành êm ái, bền bỉ chuẩn mực.'
        ],
        [
            'id' => 8,
            'name' => 'Toyota Camry 2.5Q',
            'brand' => 'Toyota',
            'price' => 1405000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYl1j8avzp_a52uX2szBu_X2g82yHbEtkqDDN0XtKJ6A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ16pL8BQW83ACdsEAsk95IbLeS0i347RmCkAbc4zGLLA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDKY-KgdZor0p_2ggyNXFiRd7VE6K5ydz31QxuOYG8w&s=10',
            'engine' => 'Xăng Dynamic Force 2.5L (207 HP / 250 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái. Khoang hành khách phía sau thiết kế chuẩn doanh nhân với bệ tỳ tay tích hợp bảng điều khiển cảm ứng ngả ghế, rèm che nắng chỉnh điện, điều hòa 3 vùng độc lập và 9 loa JBL cao cấp.'
        ],
        [
            'id' => 7,
            'name' => 'VinFast VF5 Plus',
            'brand' => 'VinFast',
            'price' => 468000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd-uWGNUo1taSToXpQaIDCJxCi0OOXvd5SN34Va8zCgQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFGMSwMiRgj3WEsCu14j3Th0mDeFZDiTmfuN5AIyfgiA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEnAbDWJMk7kjzcYqCfHxsNLGsZ4hGodDqmC_vbKh6lw&s=10',
            'engine' => 'Động cơ điện đơn (Công suất 134 HP / Mô-men xoắn 135 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'Mẫu A-SUV chạy điện nhỏ gọn, thiết kế năng động tối ưu cho nhu cầu di chuyển đô thị hàng ngày. Tầm hoạt động hơn 300 km cho mỗi lần sạc đầy, tích hợp trợ lý ảo tiếng Việt thông minh, cảnh báo điểm mù và trang bị 6 túi khí an toàn.'
        ],
        [
            'id' => 6,
            'name' => 'VinFast VF8 Plus',
            'brand' => 'VinFast',
            'price' => 1270000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMgh5eFb69xZCQCeJXpE2n1sx0fIj0gMZRsLUCkF7F2Q&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2fiRyUQE2tzYAfH61XkhF-ZaRi4kbEv1pGYAd6gaKZw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnZ23dQtN4guhpS1WTpIHS2Azx4Cb_TRBVR3v3oMa8A&s=10',
            'engine' => '2 mô-tơ điện AWD toàn thời gian (402 HP / 620 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'SUV điện thông minh phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái nâng cao ADAS. Khả năng tăng tốc ấn tượng từ 0-100 km/h dưới 5.5 giây, màn hình trung tâm tràn viền 15.6 inch tối giản, không gian rộng rãi và cửa sổ trời toàn cảnh kính lớn.'
        ],
        [
            'id' => 5,
            'name' => 'BMW 740i Pure Excellence',
            'brand' => 'BMW',
            'price' => 4699000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHMNStnEqOgN-AtfJc4ZxIl-FSqSxWD-_KPP9Zjk-BkA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10',
            'engine' => 'Xăng 3.0L I6 TwinPower Turbo Mild-Hybrid (381 HP / 540 Nm)',
            'transmission' => 'Tự động 8 cấp Steptronic Sport',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Sedan hạng sang cỡ lớn đỉnh cao công nghệ của BMW. Không gian nội thất xa hoa với thanh pha lê tương tác BMW Interaction Bar, ghế ngồi thương gia bọc da Merino cao cấp tích hợp massage, màn hình rạp chiếu phim rạp phía sau 31.3 inch và dàn âm thanh vòm Bowers & Wilkins Diamond.'
        ],
        [
            'id' => 4,
            'name' => 'Mercedes-AMG G63',
            'brand' => 'Mercedes-Benz',
            'price' => 11750000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9k-mmUkZkHwMhAB8bjPOA9mFIiMkV_1C-dBgyFThkTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHgJI_oRJzR0lzto9sfPraPiSShwHmuhhfQ45LX6a1lA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKEtZnRwUw07P1WR5UkpeZNNF4_2YJJY3Pyyja2xXKOw&s=10',
            'engine' => 'Xăng V8 4.0L Biturbo AMG (585 HP / 850 Nm)',
            'transmission' => 'Tự động thể thao 9 cấp AMG SPEEDSHIFT TCT 9G',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV địa hình hạng sang biểu tượng uy quyền. Thiết kế khung gầm hình thang siêu cứng vững với 3 khóa vi sai độc lập có thể khóa hoàn toàn bằng điện, hệ thống ống xả thể thao đặt bên hông uy lực, nội thất da Nappa hảo hạng kết hợp hệ thống âm thanh vòm Burmester 15 loa.'
        ],
        [
            'id' => 3,
            'name' => 'Porsche 911 Carrera S',
            'brand' => 'Porsche',
            'price' => 8500000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUGbNCOFMrr8i-ELaF9sQVPpIjPWMSJB44Ql_bo2667w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIwrpx24-3p2ImkIovLVRN_wTXP-Sr-f5Y_LXkgKJDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpMtyFyXiOJ0kzPQgcy_26PGobb5w_z8zugn9VxdYSjg&s=10',
            'engine' => 'Xăng Boxer 6 xi-lanh 3.0L Twin-Turbo (450 HP / 530 Nm)',
            'transmission' => 'Ly hợp kép 8 cấp PDK danh tiếng của Porsche',
            'fuel' => 'Xăng',
            'description' => 'Biểu tượng xe thể thao hiệu suất cao huyền thoại mang lại cảm giác lái thuần khiết đỉnh cao. Khả năng tăng tốc 0-100 km/h chỉ mất 3.7 giây khi trang bị gói Sport Chrono, tốc độ tối đa đạt 308 km/h, tích hợp hệ thống treo chủ động PASM và thiết kế buồng lái đậm chất xe đua Đức.'
        ],
        [
            'id' => 2,
            'name' => 'Mercedes-Benz C-Class C300 AMG',
            'brand' => 'Mercedes-Benz',
            'price' => 2099000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8nJj5R87z1dpwUCcHbj1KwNTJtJBM4sYDjrEIgxRtRA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jXuoX5_WAmEuVpxNpYUIX-UtNpPa78eTAQECU9_aJQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR98khAhzlP1bBIDo7mN_uNiVMy5ExBrqfae38EzD2oBg&s=10',
            'engine' => 'Xăng 2.0L Turbo kết hợp công nghệ EQ Boost Mild-Hybrid (258 HP / 400 Nm)',
            'transmission' => 'Tự động 9 cấp 9G-TRONIC',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Mẫu sedan thể thao mệnh danh là "tiểu S-Class" với gói trang thiết kế ngoại thất AMG Line cuốn hút, màn hình giải trí trung tâm đặt dọc 11.9 inch tích hợp MBUX thế hệ mới, cụm đèn pha thông minh Digital Light tối tân và hệ thống âm thanh vòm Burmester 3D 15 loa sống động.'
        ],
        [
            'id' => 1,
            'name' => 'VinFast VF3',
            'brand' => 'VinFast',
            'price' => 240000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFJCmiv3bB_2DDesc8SnYvKr_hq-1IiNwk2YCGZKyqZA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDJ8HxL4j3SfFrNMGCvRD9bwAZjykVF3WG-Xxl5v7h9w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbsZHkDzGDsG_EspjalYDoIEN3dnHiV45pQrIns8UK3w&s=10',
            'engine' => 'Động cơ điện đơn (Công suất 43 HP / Mô-men xoắn 110 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'Cơn sốt xe điện mini đô thị tại Việt Nam! Mang phong cách thiết kế hình hộp cá tính, khỏe khoắn, khoảng sáng gầm xe cao 191mm giúp dễ dàng vượt qua các địa hình ngập nước đô thị, là mẫu xe điện bán chạy nhất (Best Seller) tại Showroom 4TL.'
        ]
    ];
}

if (!$reply && !empty($cars)) {
    // Bước 2A: Tìm theo MẪU XE CỤ THỂ (chọn xe khớp chính xác nhất)
    $matchedCar = null;
    $bestCarScore = 0;

    foreach ($cars as $car) {
        $carNameNoAccent = removeAccents(toLowerUtf8($car['name']));
        $brandNoAccent = removeAccents(toLowerUtf8($car['brand']));
        $identifiers = getCarIdentifiers($carNameNoAccent, $brandNoAccent);

        $carScore = 0;
        foreach ($identifiers as $idx => $idStr) {
            if (hasWord($msgNoAccent, $idStr)) {
                // Khớp nguyên tên xe điểm cao nhất (10), khớp mã dòng xe điểm 5
                $carScore = max($carScore, $idx === 0 ? 10 : 5);
            }
        }

        if ($carScore > $bestCarScore) {
            $bestCarScore = $carScore;
            $matchedCar = $car;
        }
    }

    if ($matchedCar) {
        $priceFormatted = number_format((float)$matchedCar['price'], 0, ',', '.');
        $cName = e($matchedCar['name']);
        $cBrand = e($matchedCar['brand']);
        $cEngine = e($matchedCar['engine']);
        $cFuel = e($matchedCar['fuel']);
        $reply = "Dạ, mẫu xe <strong>{$cName}</strong> ({$cBrand}) hiện có giá niêm yết là <strong>{$priceFormatted} VNĐ</strong>.<br>✨ Động cơ: {$cEngine} | Nhiên liệu: {$cFuel}.<br>Quý khách có thể bấm <strong>Đặt Cọc</strong> hoặc <strong>Lái Thử</strong> ngay bên dưới thẻ xe ạ!";
    } else {
        // Bước 2B: Nếu không nhắc tên xe cụ thể, kiểm tra xem khách có hỏi theo THƯƠNG HIỆU không (không break sớm)
        $brandMatches = [];
        $matchedBrandName = "";

        foreach ($cars as $car) {
            $brandNoAccent = removeAccents(toLowerUtf8($car['brand']));
            // Hỗ trợ gõ tắt "mercedes" cho "mercedes-benz"
            $brandAliases = [$brandNoAccent];
            if (strpos($brandNoAccent, 'mercedes') !== false) {
                $brandAliases[] = 'mercedes';
                $brandAliases[] = 'mec';
            }

            foreach ($brandAliases as $alias) {
                if (hasWord($msgNoAccent, $alias)) {
                    $brandMatches[] = $car;
                    $matchedBrandName = $car['brand'];
                    break;
                }
            }
        }

        if (!empty($brandMatches)) {
            $lines = [];
            foreach ($brandMatches as $m) {
                $p = number_format((float)$m['price'], 0, ',', '.');
                $lines[] = "• <strong>" . e($m['name']) . "</strong>: {$p} VNĐ (" . e($m['fuel']) . ")";
            }
            $reply = "Dạ, Showroom 4TL hiện đang có <strong>" . count($brandMatches) . " mẫu xe " . e($matchedBrandName) . "</strong> sẵn giao:<br>" . implode("<br>", $lines);
        }
    }
}

// ƯU TIÊN 3: TƯ VẤN THEO NGÂN SÁCH & CÂU HỎI MẶC ĐỊNH
if (!$reply && (strpos($msgNoAccent, 'duoi') !== false || strpos($msgNoAccent, 'tam') !== false || strpos($msgNoAccent, 'ngan sach') !== false)) {
    $limitPrice = 0;
    $label = "";
    if (strpos($msgNoAccent, '500') !== false) {
        $limitPrice = 500000000;
        $label = "dưới 500 triệu";
    } elseif (strpos($msgNoAccent, '1 ty') !== false || strpos($msgNoAccent, '1ty') !== false) {
        $limitPrice = 1000000000;
        $label = "dưới 1 tỷ";
    } elseif (strpos($msgNoAccent, '2 ty') !== false || strpos($msgNoAccent, '2ty') !== false) {
        $limitPrice = 2000000000;
        $label = "dưới 2 tỷ";
    } elseif (strpos($msgNoAccent, '3 ty') !== false || strpos($msgNoAccent, '3ty') !== false) {
        $limitPrice = 3000000000;
        $label = "dưới 3 tỷ";
    }

    if ($limitPrice > 0 && !empty($cars)) {
        $matches = array_filter($cars, fn($c) => (float)$c['price'] <= $limitPrice);
        if (!empty($matches)) {
            usort($matches, fn($a, $b) => (float)$b['price'] - (float)$a['price']);
            $list = [];
            foreach (array_slice($matches, 0, 4) as $m) {
                $p = number_format((float)$m['price'], 0, ',', '.');
                $list[] = "• <strong>" . e($m['name']) . "</strong>: {$p} VNĐ";
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
        $reply = "Cảm ơn quý khách đã nhắn tin! Quý khách có thể hỏi về giá xe cụ thể (VD: <em>giá VF3, G63, Porsche 911</em>), theo hãng (<em>xe VinFast, Mercedes</em>), ngân sách (<em>xe dưới 2 tỷ</em>) hoặc gọi Hotline VIP <strong>0765.650.114</strong> ạ!";
    }
}

echo json_encode(["reply" => $reply], JSON_UNESCAPED_UNICODE);
```

### file db.php:
```php
<?php
// Tự động nhận diện môi trường chạy Local (XAMPP) hay Online (Hosting PHP)
$hostName = $_SERVER['HTTP_HOST'] ?? 'localhost';
$remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
$isLocal = in_array($remoteAddr, ['127.0.0.1', '::1'])
    || strpos($hostName, 'localhost') !== false
    || strpos($hostName, '127.0.0.1') !== false;

if ($isLocal) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "web_ban_xe";
} else {
    // THAY 4 THÔNG SỐ DƯỚI ĐÂY BẰNG THÔNG TIN MYSQL TRÊN HOSTING CỦA BẠN (VD: InfinityFree)
    $host = "sql305.infinityfree.com";
    $user = "if0_43447777";
    $pass = "1oa1wl9IvwkrK";
    $dbname = "if0_43447777_web_ban_xe";
}

$pdo = null;

try {
    if ($isLocal) {
        // Chỉ chạy tạo DB tự động khi ở máy cá nhân (XAMPP)
        $pdoInit = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $pdoInit->exec("CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    // Kết nối thẳng vào Database (Bắt buộc trên InfinityFree)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // 4. Tự động tạo 5 bảng nếu chưa tồn tại (Không cần import schema.sql)
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cars (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            brand VARCHAR(100) NOT NULL,
            price DECIMAL(15,2) NOT NULL,
            image TEXT,
            engine VARCHAR(100),
            transmission VARCHAR(100),
            fuel VARCHAR(50),
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS bot_knowledge (
            id INT AUTO_INCREMENT PRIMARY KEY,
            keywords VARCHAR(255) NOT NULL,
            response TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS bookings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_name VARCHAR(150) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            car_name VARCHAR(255) NOT NULL,
            booking_date VARCHAR(50) DEFAULT NULL,
            note TEXT DEFAULT NULL,
            status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS deposits (
            id INT AUTO_INCREMENT PRIMARY KEY,
            car_name VARCHAR(255) NOT NULL,
            car_price DECIMAL(15,2) NOT NULL,
            memo VARCHAR(100) NOT NULL,
            customer_name VARCHAR(150) DEFAULT 'Khách đặt online',
            customer_phone VARCHAR(20) DEFAULT '',
            status ENUM('pending', 'verified', 'cancelled') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    // Tự động nâng cấp cột image lên TEXT để chứa được nhiều link ảnh
    $pdo->exec("ALTER TABLE cars MODIFY COLUMN image TEXT");

    // 5. Nạp tài khoản Admin mặc định (đã mã hóa mật khẩu) nếu bảng users trống
    if ((int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn() === 0) {
        $stmtUser = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmtUser->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT)]);
    }

    // 6. Nạp tri thức AI Chatbot mặc định nếu bảng bot_knowledge trống
    if ((int)$pdo->query("SELECT COUNT(*) FROM bot_knowledge")->fetchColumn() === 0) {
        $pdo->exec("
            INSERT INTO bot_knowledge (keywords, response) VALUES
            ('gia, bao nhieu, chi phi', 'Giá các dòng xe tại Showroom 4TL dao động từ 240 triệu (VinFast VF3) đến hơn 19 tỷ VNĐ (Ferrari F8 Tributo).'),
            ('bao hanh, dich vu', 'Tất cả siêu xe và xe sang bán ra đều bảo hành 3 - 10 năm chính hãng, cam kết kiểm định 160 bước không đâm đụng, không ngập nước.'),
            ('tra gop, vay', 'Showroom 4TL hỗ trợ trả góp qua ngân hàng lên đến 80% giá trị xe trong thời gian tối đa 7 năm với lãi suất ưu đãi chỉ từ 7.5%/năm.')
        ");
    }

    // 7. Nạp trọn bộ 20 mẫu xe mặc định từ schema.sql nếu bảng cars trống
    if ((int)$pdo->query("SELECT COUNT(*) FROM cars")->fetchColumn() === 0) {
        $sql_cars = <<<'SQL'
INSERT INTO cars (name, brand, price, image, engine, transmission, fuel, description) VALUES
('VinFast VF3', 'VinFast', 240000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFJCmiv3bB_2DDesc8SnYvKr_hq-1IiNwk2YCGZKyqZA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDJ8HxL4j3SfFrNMGCvRD9bwAZjykVF3WG-Xxl5v7h9w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbsZHkDzGDsG_EspjalYDoIEN3dnHiV45pQrIns8UK3w&s=10', 'Động cơ điện đơn (Công suất 43 HP / Mô-men xoắn 110 Nm)', 'Tự động 1 cấp', 'Điện', 'Cơn sốt xe điện mini đô thị tại Việt Nam! Mang phong cách thiết kế hình hộp cá tính, khỏe khoắn, khoảng sáng gầm xe cao 191mm giúp dễ dàng vượt qua các địa hình ngập nước đô thị, là mẫu xe điện bán chạy nhất (Best Seller) tại Showroom 4TL.'),
('Mercedes-Benz C-Class C300 AMG', 'Mercedes-Benz', 2099000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8nJj5R87z1dpwUCcHbj1KwNTJtJBM4sYDjrEIgxRtRA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jXuoX5_WAmEuVpxNpYUIX-UtNpPa78eTAQECU9_aJQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR98khAhzlP1bBIDo7mN_uNiVMy5ExBrqfae38EzD2oBg&s=10', 'Xăng 2.0L Turbo kết hợp công nghệ EQ Boost Mild-Hybrid (258 HP / 400 Nm)', 'Tự động 9 cấp 9G-TRONIC', 'Xăng Mild-Hybrid', 'Mẫu sedan thể thao mệnh danh là "tiểu S-Class" với gói trang thiết kế ngoại thất AMG Line cuốn hút, màn hình giải trí trung tâm đặt dọc 11.9 inch tích hợp MBUX thế hệ mới, cụm đèn pha thông minh Digital Light tối tân và hệ thống âm thanh vòm Burmester 3D 15 loa sống động.'),
('Porsche 911 Carrera S', 'Porsche', 8500000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUGbNCOFMrr8i-ELaF9sQVPpIjPWMSJB44Ql_bo2667w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIwrpx24-3p2ImkIovLVRN_wTXP-Sr-f5Y_LXkgKJDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpMtyFyXiOJ0kzPQgcy_26PGobb5w_z8zugn9VxdYSjg&s=10', 'Xăng Boxer 6 xi-lanh 3.0L Twin-Turbo (450 HP / 530 Nm)', 'Ly hợp kép 8 cấp PDK danh tiếng của Porsche', 'Xăng', 'Biểu tượng xe thể thao hiệu suất cao huyền thoại mang lại cảm giác lái thuần khiết đỉnh cao. Khả năng tăng tốc 0-100 km/h chỉ mất 3.7 giây khi trang bị gói Sport Chrono, tốc độ tối đa đạt 308 km/h, tích hợp hệ thống treo chủ động PASM và thiết kế buồng lái đậm chất xe đua Đức.'),
('Mercedes-AMG G63', 'Mercedes-Benz', 11750000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9k-mmUkZkHwMhAB8bjPOA9mFIiMkV_1C-dBgyFThkTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHgJI_oRJzR0lzto9sfPraPiSShwHmuhhfQ45LX6a1lA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKEtZnRwUw07P1WR5UkpeZNNF4_2YJJY3Pyyja2xXKOw&s=10', 'Xăng V8 4.0L Biturbo AMG (585 HP / 850 Nm)', 'Tự động thể thao 9 cấp AMG SPEEDSHIFT TCT 9G', 'Xăng', 'Mẫu SUV địa hình hạng sang biểu tượng uy quyền. Thiết kế khung gầm hình thang siêu cứng vững với 3 khóa vi sai độc lập có thể khóa hoàn toàn bằng điện, hệ thống ống xả thể thao đặt bên hông uy lực, nội thất da Nappa hảo hạng kết hợp hệ thống âm thanh vòm Burmester 15 loa.'),
('BMW 740i Pure Excellence', 'BMW', 4699000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHMNStnEqOgN-AtfJc4ZxIl-FSqSxWD-_KPP9Zjk-BkA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10', 'Xăng 3.0L I6 TwinPower Turbo Mild-Hybrid (381 HP / 540 Nm)', 'Tự động 8 cấp Steptronic Sport', 'Xăng Mild-Hybrid', 'Sedan hạng sang cỡ lớn đỉnh cao công nghệ của BMW. Không gian nội thất xa hoa với thanh pha lê tương tác BMW Interaction Bar, ghế ngồi thương gia bọc da Merino cao cấp tích hợp massage, màn hình rạp chiếu phim rạp phía sau 31.3 inch và dàn âm thanh vòm Bowers & Wilkins Diamond.'),
('VinFast VF8 Plus', 'VinFast', 1270000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMgh5eFb69xZCQCeJXpE2n1sx0fIj0gMZRsLUCkF7F2Q&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2fiRyUQE2tzYAfH61XkhF-ZaRi4kbEv1pGYAd6gaKZw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnZ23dQtN4guhpS1WTpIHS2Azx4Cb_TRBVR3v3oMa8A&s=10', '2 mô-tơ điện AWD toàn thời gian (402 HP / 620 Nm)', 'Tự động 1 cấp', 'Điện', 'SUV điện thông minh phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái nâng cao ADAS. Khả năng tăng tốc ấn tượng từ 0-100 km/h dưới 5.5 giây, màn hình trung tâm tràn viền 15.6 inch tối giản, không gian rộng rãi và cửa sổ trời toàn cảnh kính lớn.'),
('VinFast VF5 Plus', 'VinFast', 468000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd-uWGNUo1taSToXpQaIDCJxCi0OOXvd5SN34Va8zCgQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFGMSwMiRgj3WEsCu14j3Th0mDeFZDiTmfuN5AIyfgiA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEnAbDWJMk7kjzcYqCfHxsNLGsZ4hGodDqmC_vbKh6lw&s=10', 'Động cơ điện đơn (Công suất 134 HP / Mô-men xoắn 135 Nm)', 'Tự động 1 cấp', 'Điện', 'Mẫu A-SUV chạy điện nhỏ gọn, thiết kế năng động tối ưu cho nhu cầu di chuyển đô thị hàng ngày. Tầm hoạt động hơn 300 km cho mỗi lần sạc đầy, tích hợp trợ lý ảo tiếng Việt thông minh, cảnh báo điểm mù và trang bị 6 túi khí an toàn.'),
('Toyota Camry 2.5Q', 'Toyota', 1405000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYl1j8avzp_a52uX2szBu_X2g82yHbEtkqDDN0XtKJ6A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ16pL8BQW83ACdsEAsk95IbLeS0i347RmCkAbc4zGLLA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDKY-KgdZor0p_2ggyNXFiRd7VE6K5ydz31QxuOYG8w&s=10', 'Xăng Dynamic Force 2.5L (207 HP / 250 Nm)', 'Tự động 8 cấp', 'Xăng', 'Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái. Khoang hành khách phía sau thiết kế chuẩn doanh nhân với bệ tỳ tay tích hợp bảng điều khiển cảm ứng ngả ghế, rèm che nắng chỉnh điện, điều hòa 3 vùng độc lập và 9 loa JBL cao cấp.'),
('Toyota Corolla Cross 1.8HEV', 'Toyota', 905000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpA_ZtVNe8sOc_-tGXiFue--SWAvHYn4hqdXnj1v5NYg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuPdKKZWfVIlpfJtWjiH1WDTCkzs65ZGLNbW8xdkYXA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaemDP4gzPH3lDaNIymrWag_h6ogYiqv8TLc60aEacSA&s=10', 'Xăng 1.8L kết hợp mô-tơ điện Hybrid (Tổng công suất 122 HP)', 'Tự động vô cấp E-CVT', 'Xăng Hybrid', 'SUV đô thị xanh tiết kiệm nhiên liệu tối ưu nhờ công suất tự sạc Hybrid tiên tiến. Trang bị gói công nghệ an toàn Toyota Safety Sense, camera toàn cảnh 360 độ, cửa sổ trời toàn cảnh và vận hành êm ái, bền bỉ chuẩn mực.'),
('Ford Ranger Raptor 3.0 V6', 'Ford', 1299000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkAP8_0fM7-es-s0TkuWfES4ERnhn3kRzgpiERtCEFyw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSX-ZqLNONfwQeU5XwtL9ZqejukswL1TpUpsr1-76jc3w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQH0fOuAoH-XV1q7BGhIXSq8KXrWfeO2ChqH9Z6Zjgvg&s=10', 'Xăng EcoBoost 3.0L V6 Twin-Turbo (397 HP / 583 Nm)', 'Tự động 10 cấp điện tử', 'Xăng', 'Vua bán tải hiệu năng cao chuyên nghiệp, trang bị hệ thống giảm xóc FOX Live Valve 2.5 inch trượt địa hình. Sở hữu 7 chế độ lái linh hoạt (bao gồm chế độ Baja chuyên đua sa mạc), hệ thống khóa vi sai trước/sau và ống xả thể thao điều chỉnh độ vang.'),
('Ford Everest Titanium+ 4x4', 'Ford', 1468000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiZtZyv9cLXgHdi-7v-PjeTIL5tGeeU3tpnMYplS6XDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTYj1liAKQcUeUhRU01jidOFrEQonbqh2FvYukozZM4w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfRprvZIOazCuK7ZgS3R8vKBIHAlTpdmYSX9Y03eOZBw&s=10', 'Bi-Turbo Diesel 2.0L i4 (210 HP / 500 Nm)', 'Tự động 10 cấp điện tử', 'Dầu (Diesel)', 'SUV 7 chỗ gầm cao hầm hố, khả năng cách âm đỉnh cao và giàu công nghệ an toàn hàng đầu phân khúc. Hệ thống dẫn động 2 cầu 4x4 thông minh, màn hình trung tâm dọc 12 inch chạy SYNC 4A, camera 360 độ sắc nét và hỗ trợ đỗ xe tự động.'),
('Hyundai Tucson 2.0 Diesel', 'Hyundai', 959000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStMbKbjpRugZbAa8Jxhz2GPdFPKMMrw8fJwjRdQ-TBZQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZ8ey04y0-7pSS5gagfiCQrjMaVJBoxy_NPolImcNVTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-AHImYzA1sSv1yPO9EeJObAW1AWSceaxllVKBvl_VJg&s=10', 'Diesel Smartstream D2.0 (186 HP / 416 Nm)', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Crossover sở hữu thiết kế ngoại thất táo bạo, khả năng vận hành mạnh mẽ, bốc và tiết kiệm nhiên liệu tối ưu. Nổi bật với lưới tản nhiệt hình khối thông minh, cần số điện tử dạng nút bấm, cửa sổ trời toàn cảnh và gói an toàn Hyundai SmartSense.'),
('Hyundai Accent 1.5 AT', 'Hyundai', 489000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqxAlh0ojNuYt82BpLC-BRYGclFmTXJd-gJrp2lEF6WQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSahuOZxstBhmyAYM9STEFGftWiVL3FaEJV6jgiXXgjVQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NEb-vWA47bMBzZmMi3bTdDEKeRmafgiCvZAUuKuHlA&s=10', 'Xăng Smartstream G1.5 (115 HP / 144 Nm)', 'Tự động vô cấp thông minh iVT', 'Xăng', 'Sedan hạng B phổ thông, tiện nghi phong phú vượt tầm giá. Thiết kế phong cách Fastback thể thao trẻ trung, màn hình giải trí 8 inch tích hợp Apple CarPlay/Android Auto không dây, sạc điện thoại không dây và tính năng mở cốp thông minh.'),
('Honda CR-V e:HEV RS', 'Honda', 1259000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYwkQ2_Bnn715DhM8OfuYNpzg5ozBqKoyC2evRYhhUw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYKCZvpPeMChk_J4Lbs9BbrSrpBDSw5G69aSbUDdtrsw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8Vqeig2JBKNtNlJ5UGdtK69cmsDwRARmVSINyLF-S_Q&s=10', 'Xăng 2.0L kết hợp 2 mô-tơ điện (Tổng công suất 204 HP / 335 Nm)', 'Tự động vô cấp E-CVT', 'Xăng Hybrid', 'SUV 5 chỗ thể thao mang lại trải nghiệm lái phấn khích chuẩn Honda Sensing. Khả năng tiết kiệm nhiên liệu tối ưu chỉ khoảng 5.2L/100km trong đô thị, trang bị cửa sổ trời toàn cảnh Panorama, hệ thống âm thanh 12 loa Bose và màn hình HUD.'),
('Mazda CX-5 2.0 Premium', 'Mazda', 829000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpW39XsAvfNmzgS3h7r2TjxeeJTUhyLpVsnzGlKpS-mQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTInC9__STOHLHNime6eFjQhx4SSUEX5S8lyJn71cJTqQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIF5WKKGY123T08e8kSO_mXGGGMgDtg41luLhyq88TKw&s=10', 'Xăng SkyActiv-G 2.0L (154 HP / 200 Nm)', 'Tự động 6 cấp', 'Xăng', 'Mẫu Crossover bán chạy hàng đầu phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế. Trang bị màn hình hiển thị kính lái HUD, gương chiếu hậu chống chói tự động, cốp điện rảnh tay, 10 loa Bose cao cấp và gói an toàn chủ động i-Activsense.'),
('Kia Carnival 2.2D Signature', 'Kia', 1759000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDrQOfx7kICr3cyGjHqTHm_SMnzFbZOde_TVN6qS1FXw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5v0u6MMN_-u8H5QgBA6eq9gRrBtD3urv_V9zGDT_5ig&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKUw3TRHK3bFJ7Hv5brQb8FBAB1NJEcZdPSkYD5-8ysg&s=10', 'Diesel Smartstream 2.2L (199 HP / 440 Nm)', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Xe gia đình hạng sang (MPV) cỡ lớn rộng rãi, trang bị đầy đủ như khoang hạng thương gia. Hàng ghế thứ hai chỉnh điện thư giãn tích hợp sưởi/làm mát, cửa sổ trời đôi độc lập, rèm che nắng và hệ thống âm thanh 12 loa Bose.'),
('Audi Q7 45 TFSI quattro', 'Audi', 3700000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsMi5fmiZg1cQubrLMpSpHHiwFbiC2puLtGW-dhi1Evw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2Z49zJQSa-QgYOK6PnDsCeXGbIjDlMy_UJgY5AVG0w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXio_hwx7mM0zgI01Sdx4o-ZLySmfpn8qKouBDzFESQA&s=10', 'Xăng 2.0L TFSI Mild-Hybrid MHEV (252 HP / 370 Nm)', 'Tự động 8 cấp Tiptronic', 'Xăng', 'SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian quattro danh tiếng. Thiết kế lưới tản nhiệt Singleframe bát giác bề thế, cụm đèn pha LED Matrix sắc sảo, buồng lái ảo Audi Virtual Cockpit và dàn âm thanh 3D Bang & Olufsen 19 loa.'),
('Lexus RX350 Luxury', 'Lexus', 4330000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOKn1MNoCINsLRyMryNK-gqu0xXC7E4vegTJpqDpxwKg&s, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlhxOxreBx7dZ0WVilniwHUvofB_NaKB71xDtEZh1WYA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOMkj7dV-dZSUjqzqpyhMVxWrlA_BEZeQ-CC4u_rdp7Q&s=10', 'Xăng 2.4L Turbo I4 (275 HP / 430 Nm)', 'Tự động 8 cấp', 'Xăng', 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt. Nội thất bọc da Semi-Aniline cao cấp, màn hình trung tâm cảm ứng 14 inch, hệ thống âm thanh vòm 21 loa Mark Levinson và gói công nghệ an toàn Lexus Safety System+.'),
('Lamborghini Urus S', 'Lamborghini', 16500000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHS2yGPTepN8pLd6xYDDwMDfzd7nNgw0Wb_yTGlGCm0A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKtHAnyoB_1kLYyhE81rizhXi7nkTxwh82w-nitYue7g&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ098BS6eDBP3owhuf17ApxAaDbgMExcwrI0huLgTUudQ&s=10', 'Xăng V8 4.0L Twin-Turbo (666 HP / 850 Nm)', 'Tự động 8 cấp', 'Xăng', 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Hệ thống dẫn động 4 bánh toàn thời gian, treo khí nén thích ứng thông minh và núm xoay chế độ lái ANIMA gồm Strada, Sport, Corsa, Terra, Sabbia và Neve.'),
('Ferrari F8 Tributo', 'Ferrari', 19000000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE3sDpn33xn9qTk5wTWc6EFHdkMEssFXSa6l-0td5o2w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgqtnNRCxzmqTFoL6wSi62G-QtJKf_vgT58IWQOpjJvg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTw0GaWZqHRGG_hseloDpgEOje7D5M_ahm2lMqzkTrlTg&s=10', 'Xăng V8 3.9L Twin-Turbo (720 HP / 770 Nm)', 'Ly hợp kép 7 cấp F1', 'Xăng', 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h, trang bị hốc gió khí động học S-Duct lấy cảm hứng từ xe đua Công thức 1 giúp tăng lực ép xuống đường.');
SQL;
        $pdo->exec($sql_cars);
    }
} catch (Exception $e) {
    $pdo = null;
}
```

### file edit_car.php:
```php
<?php
require_once 'auth_check.php';
requireAdminApi();
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Phương thức không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
$id = intval($input['id'] ?? 0);
$name = trim($input['name'] ?? '');
$brand = trim($input['brand'] ?? '');
$price = floatval($input['price'] ?? 0);
$image = trim($input['image'] ?? '');
$engine = trim($input['engine'] ?? '');
$transmission = trim($input['transmission'] ?? '');
$fuel = trim($input['fuel'] ?? '');
$description = trim($input['description'] ?? '');

// Thêm giới hạn 500 ký tự cho mô tả khi chỉnh sửa
if (mb_strlen($description, 'UTF-8') > 500) {
    echo json_encode(["status" => "error", "message" => "Mô tả chi tiết không được vượt quá 500 ký tự!"], JSON_UNESCAPED_UNICODE);
    exit();
}

if ($id <= 0 || empty($name) || empty($brand)) {
    echo json_encode(["status" => "error", "message" => "Dữ liệu cập nhật không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    $check = $pdo->prepare("SELECT id FROM cars WHERE id = ?");
    $check->execute([$id]);
    if (!$check->fetch()) {
        echo json_encode(["status" => "error", "message" => "Không tìm thấy xe có ID #{$id} trong cơ sở dữ liệu!"], JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    $stmt = $pdo->prepare("UPDATE cars SET name=?, brand=?, price=?, image=?, engine=?, transmission=?, fuel=?, description=? WHERE id=?");
    $stmt->execute([$name, $brand, $price, $image, $engine, $transmission, $fuel, $description, $id]);
    echo json_encode(["status" => "success", "message" => "Cập nhật thông tin xe thành công!"], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi CSDL: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
```

### file add_car.php:
```php
<?php
require_once 'auth_check.php';
requireAdminApi();

require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Phương thức không hợp lệ"], JSON_UNESCAPED_UNICODE);
    exit();
}

$name = trim($_POST['name'] ?? '');
$brand = trim($_POST['brand'] ?? '');
$price = floatval($_POST['price'] ?? 0);
$engine = trim($_POST['engine'] ?? '');
$transmission = trim($_POST['transmission'] ?? '');
$fuel = trim($_POST['fuel'] ?? '');
$image = trim($_POST['image'] ?? '');
$description = trim($_POST['description'] ?? '');

// Thêm kiểm tra giới hạn 500 ký tự cho mô tả
if (mb_strlen($description, 'UTF-8') > 500) {
    echo json_encode(["status" => "error", "message" => "Mô tả chi tiết không được vượt quá 500 ký tự!"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (empty($image)) {
    $image = 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800';
}

if (empty($name) || empty($brand)) {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ tên xe và hãng xe!"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL"], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    $stmt = $pdo->prepare("INSERT INTO cars (name, brand, price, engine, transmission, fuel, image, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $brand, $price, $engine, $transmission, $fuel, $image, $description]);
    echo json_encode(["status" => "success", "message" => "Thêm xe thành công"], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi CSDL: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>
```

### file get_cars.php:
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

$cars = [];

if (isset($pdo) && $pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM cars ORDER BY id DESC");
        while ($row = $stmt->fetch()) {
            $row['id'] = (int)$row['id'];
            $row['price'] = (float)$row['price'];
            $cars[] = $row;
        }
    } catch (Exception $e) {
        $cars = [];
    }
}

// Nếu CSDL chưa được import hoặc chưa chạy, sử dụng dữ liệu mẫu chuẩn của Showroom 4TL
if (empty($cars)) {
    $cars = [
        [
            'id' => 20,
            'name' => 'Ferrari F8 Tributo',
            'brand' => 'Ferrari',
            'price' => 19000000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE3sDpn33xn9qTk5wTWc6EFHdkMEssFXSa6l-0td5o2w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgqtnNRCxzmqTFoL6wSi62G-QtJKf_vgT58IWQOpjJvg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTw0GaWZqHRGG_hseloDpgEOje7D5M_ahm2lMqzkTrlTg&s=10',
            'engine' => 'Xăng V8 3.9L Twin-Turbo (720 HP / 770 Nm)',
            'transmission' => 'Ly hợp kép 7 cấp F1',
            'fuel' => 'Xăng',
            'description' => 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h, trang bị hốc gió khí động học S-Duct lấy cảm hứng từ xe đua Công thức 1 giúp tăng lực ép xuống đường.'
        ],
        [
            'id' => 19,
            'name' => 'Lamborghini Urus S',
            'brand' => 'Lamborghini',
            'price' => 16500000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHS2yGPTepN8pLd6xYDDwMDfzd7nNgw0Wb_yTGlGCm0A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKtHAnyoB_1kLYyhE81rizhXi7nkTxwh82w-nitYue7g&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ098BS6eDBP3owhuf17ApxAaDbgMExcwrI0huLgTUudQ&s=10',
            'engine' => 'Xăng V8 4.0L Twin-Turbo (666 HP / 850 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Hệ thống dẫn động 4 bánh toàn thời gian, treo khí nén thích ứng thông minh và núm xoay chế độ lái ANIMA gồm Strada, Sport, Corsa, Terra, Sabbia và Neve.'
        ],
        [
            'id' => 18,
            'name' => 'Lexus RX350 Luxury',
            'brand' => 'Lexus',
            'price' => 4330000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOKn1MNoCINsLRyMryNK-gqu0xXC7E4vegTJpqDpxwKg&s, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlhxOxreBx7dZ0WVilniwHUvofB_NaKB71xDtEZh1WYA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOMkj7dV-dZSUjqzqpyhMVxWrlA_BEZeQ-CC4u_rdp7Q&s=10',
            'engine' => 'Xăng 2.4L Turbo I4 (275 HP / 430 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt. Nội thất bọc da Semi-Aniline cao cấp, màn hình trung tâm cảm ứng 14 inch, hệ thống âm thanh vòm 21 loa Mark Levinson và gói công nghệ an toàn Lexus Safety System+.'
        ],
        [
            'id' => 17,
            'name' => 'Audi Q7 45 TFSI quattro',
            'brand' => 'Audi',
            'price' => 3700000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsMi5fmiZg1cQubrLMpSpHHiwFbiC2puLtGW-dhi1Evw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2Z49zJQSa-QgYOK6PnDsCeXGbIjDlMy_UJgY5AVG0w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXio_hwx7mM0zgI01Sdx4o-ZLySmfpn8qKouBDzFESQA&s=10',
            'engine' => 'Xăng 2.0L TFSI Mild-Hybrid MHEV (252 HP / 370 Nm)',
            'transmission' => 'Tự động 8 cấp Tiptronic',
            'fuel' => 'Xăng',
            'description' => 'SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian quattro danh tiếng. Thiết kế lưới tản nhiệt Singleframe bát giác bề thế, cụm đèn pha LED Matrix sắc sảo, buồng lái ảo Audi Virtual Cockpit và dàn âm thanh 3D Bang & Olufsen 19 loa.'
        ],
        [
            'id' => 16,
            'name' => 'Kia Carnival 2.2D Signature',
            'brand' => 'Kia',
            'price' => 1759000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDrQOfx7kICr3cyGjHqTHm_SMnzFbZOde_TVN6qS1FXw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5v0u6MMN_-u8H5QgBA6eq9gRrBtD3urv_V9zGDT_5ig&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKUw3TRHK3bFJ7Hv5brQb8FBAB1NJEcZdPSkYD5-8ysg&s=10',
            'engine' => 'Diesel Smartstream 2.2L (199 HP / 440 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Xe gia đình hạng sang (MPV) cỡ lớn rộng rãi, trang bị đầy đủ như khoang hạng thương gia. Hàng ghế thứ hai chỉnh điện thư giãn tích hợp sưởi/làm mát, cửa sổ trời đôi độc lập, rèm che nắng và hệ thống âm thanh 12 loa Bose.'
        ],
        [
            'id' => 15,
            'name' => 'Mazda CX-5 2.0 Premium',
            'brand' => 'Mazda',
            'price' => 829000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpW39XsAvfNmzgS3h7r2TjxeeJTUhyLpVsnzGlKpS-mQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTInC9__STOHLHNime6eFjQhx4SSUEX5S8lyJn71cJTqQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIF5WKKGY123T08e8kSO_mXGGGMgDtg41luLhyq88TKw&s=10',
            'engine' => 'Xăng SkyActiv-G 2.0L (154 HP / 200 Nm)',
            'transmission' => 'Tự động 6 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu Crossover bán chạy hàng đầu phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế. Trang bị màn hình hiển thị kính lái HUD, gương chiếu hậu chống chói tự động, cốp điện rảnh tay, 10 loa Bose cao cấp và gói an toàn chủ động i-Activsense.'
        ],
        [
            'id' => 14,
            'name' => 'Honda CR-V e:HEV RS',
            'brand' => 'Honda',
            'price' => 1259000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYwkQ2_Bnn715DhM8OfuYNpzg5ozBqKoyC2evRYhhUw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYKCZvpPeMChk_J4Lbs9BbrSrpBDSw5G69aSbUDdtrsw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8Vqeig2JBKNtNlJ5UGdtK69cmsDwRARmVSINyLF-S_Q&s=10',
            'engine' => 'Xăng 2.0L kết hợp 2 mô-tơ điện (Tổng công suất 204 HP / 335 Nm)',
            'transmission' => 'Tự động vô cấp E-CVT',
            'fuel' => 'Xăng Hybrid',
            'description' => 'SUV 5 chỗ thể thao mang lại trải nghiệm lái phấn khích chuẩn Honda Sensing. Khả năng tiết kiệm nhiên liệu tối ưu chỉ khoảng 5.2L/100km trong đô thị, trang bị cửa sổ trời toàn cảnh Panorama, hệ thống âm thanh 12 loa Bose và màn hình HUD.'
        ],
        [
            'id' => 13,
            'name' => 'Hyundai Accent 1.5 AT',
            'brand' => 'Hyundai',
            'price' => 489000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqxAlh0ojNuYt82BpLC-BRYGclFmTXJd-gJrp2lEF6WQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSahuOZxstBhmyAYM9STEFGftWiVL3FaEJV6jgiXXgjVQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NEb-vWA47bMBzZmMi3bTdDEKeRmafgiCvZAUuKuHlA&s=10',
            'engine' => 'Xăng Smartstream G1.5 (115 HP / 144 Nm)',
            'transmission' => 'Tự động vô cấp thông minh iVT',
            'fuel' => 'Xăng',
            'description' => 'Sedan hạng B phổ thông, tiện nghi phong phú vượt tầm giá. Thiết kế phong cách Fastback thể thao trẻ trung, màn hình giải trí 8 inch tích hợp Apple CarPlay/Android Auto không dây, sạc điện thoại không dây và tính năng mở cốp thông minh.'
        ],
        [
            'id' => 12,
            'name' => 'Hyundai Tucson 2.0 Diesel',
            'brand' => 'Hyundai',
            'price' => 959000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStMbKbjpRugZbAa8Jxhz2GPdFPKMMrw8fJwjRdQ-TBZQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZ8ey04y0-7pSS5gagfiCQrjMaVJBoxy_NPolImcNVTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-AHImYzA1sSv1yPO9EeJObAW1AWSceaxllVKBvl_VJg&s=10',
            'engine' => 'Diesel Smartstream D2.0 (186 HP / 416 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'Crossover sở hữu thiết kế ngoại thất táo bạo, khả năng vận hành mạnh mẽ, bốc và tiết kiệm nhiên liệu tối ưu. Nổi bật với lưới tản nhiệt hình khối thông minh, cần số điện tử dạng nút bấm, cửa sổ trời toàn cảnh và gói an toàn Hyundai SmartSense.'
        ],
        [
            'id' => 11,
            'name' => 'Ford Everest Titanium+ 4x4',
            'brand' => 'Ford',
            'price' => 1468000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiZtZyv9cLXgHdi-7v-PjeTIL5tGeeU3tpnMYplS6XDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTYj1liAKQcUeUhRU01jidOFrEQonbqh2FvYukozZM4w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfRprvZIOazCuK7ZgS3R8vKBIHAlTpdmYSX9Y03eOZBw&s=10',
            'engine' => 'Bi-Turbo Diesel 2.0L i4 (210 HP / 500 Nm)',
            'transmission' => 'Tự động 10 cấp điện tử',
            'fuel' => 'Dầu (Diesel)',
            'description' => 'SUV 7 chỗ gầm cao hầm hố, khả năng cách âm đỉnh cao và giàu công nghệ an toàn hàng đầu phân khúc. Hệ thống dẫn động 2 cầu 4x4 thông minh, màn hình trung tâm dọc 12 inch chạy SYNC 4A, camera 360 độ sắc nét và hỗ trợ đỗ xe tự động.'
        ],
        [
            'id' => 10,
            'name' => 'Ford Ranger Raptor 3.0 V6',
            'brand' => 'Ford',
            'price' => 1299000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkAP8_0fM7-es-s0TkuWfES4ERnhn3kRzgpiERtCEFyw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSX-ZqLNONfwQeU5XwtL9ZqejukswL1TpUpsr1-76jc3w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQH0fOuAoH-XV1q7BGhIXSq8KXrWfeO2ChqH9Z6Zjgvg&s=10',
            'engine' => 'Xăng EcoBoost 3.0L V6 Twin-Turbo (397 HP / 583 Nm)',
            'transmission' => 'Tự động 10 cấp điện tử',
            'fuel' => 'Xăng',
            'description' => 'Vua bán tải hiệu năng cao chuyên nghiệp, trang bị hệ thống giảm xóc FOX Live Valve 2.5 inch trượt địa hình. Sở hữu 7 chế độ lái linh hoạt (bao gồm chế độ Baja chuyên đua sa mạc), hệ thống khóa vi sai trước/sau và ống xả thể thao điều chỉnh độ vang.'
        ],
        [
            'id' => 9,
            'name' => 'Toyota Corolla Cross 1.8HEV',
            'brand' => 'Toyota',
            'price' => 905000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpA_ZtVNe8sOc_-tGXiFue--SWAvHYn4hqdXnj1v5NYg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuPdKKZWfVIlpfJtWjiH1WDTCkzs65ZGLNbW8xdkYXA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaemDP4gzPH3lDaNIymrWag_h6ogYiqv8TLc60aEacSA&s=10',
            'engine' => 'Xăng 1.8L kết hợp mô-tơ điện Hybrid (Tổng công suất 122 HP)',
            'transmission' => 'Tự động vô cấp E-CVT',
            'fuel' => 'Xăng Hybrid',
            'description' => 'SUV đô thị xanh tiết kiệm nhiên liệu tối ưu nhờ công suất tự sạc Hybrid tiên tiến. Trang bị gói công nghệ an toàn Toyota Safety Sense, camera toàn cảnh 360 độ, cửa sổ trời toàn cảnh và vận hành êm ái, bền bỉ chuẩn mực.'
        ],
        [
            'id' => 8,
            'name' => 'Toyota Camry 2.5Q',
            'brand' => 'Toyota',
            'price' => 1405000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYl1j8avzp_a52uX2szBu_X2g82yHbEtkqDDN0XtKJ6A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ16pL8BQW83ACdsEAsk95IbLeS0i347RmCkAbc4zGLLA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDKY-KgdZor0p_2ggyNXFiRd7VE6K5ydz31QxuOYG8w&s=10',
            'engine' => 'Xăng Dynamic Force 2.5L (207 HP / 250 Nm)',
            'transmission' => 'Tự động 8 cấp',
            'fuel' => 'Xăng',
            'description' => 'Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái. Khoang hành khách phía sau thiết kế chuẩn doanh nhân với bệ tỳ tay tích hợp bảng điều khiển cảm ứng ngả ghế, rèm che nắng chỉnh điện, điều hòa 3 vùng độc lập và 9 loa JBL cao cấp.'
        ],
        [
            'id' => 7,
            'name' => 'VinFast VF5 Plus',
            'brand' => 'VinFast',
            'price' => 468000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd-uWGNUo1taSToXpQaIDCJxCi0OOXvd5SN34Va8zCgQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFGMSwMiRgj3WEsCu14j3Th0mDeFZDiTmfuN5AIyfgiA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEnAbDWJMk7kjzcYqCfHxsNLGsZ4hGodDqmC_vbKh6lw&s=10',
            'engine' => 'Động cơ điện đơn (Công suất 134 HP / Mô-men xoắn 135 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'Mẫu A-SUV chạy điện nhỏ gọn, thiết kế năng động tối ưu cho nhu cầu di chuyển đô thị hàng ngày. Tầm hoạt động hơn 300 km cho mỗi lần sạc đầy, tích hợp trợ lý ảo tiếng Việt thông minh, cảnh báo điểm mù và trang bị 6 túi khí an toàn.'
        ],
        [
            'id' => 6,
            'name' => 'VinFast VF8 Plus',
            'brand' => 'VinFast',
            'price' => 1270000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMgh5eFb69xZCQCeJXpE2n1sx0fIj0gMZRsLUCkF7F2Q&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2fiRyUQE2tzYAfH61XkhF-ZaRi4kbEv1pGYAd6gaKZw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnZ23dQtN4guhpS1WTpIHS2Azx4Cb_TRBVR3v3oMa8A&s=10',
            'engine' => '2 mô-tơ điện AWD toàn thời gian (402 HP / 620 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'SUV điện thông minh phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái nâng cao ADAS. Khả năng tăng tốc ấn tượng từ 0-100 km/h dưới 5.5 giây, màn hình trung tâm tràn viền 15.6 inch tối giản, không gian rộng rãi và cửa sổ trời toàn cảnh kính lớn.'
        ],
        [
            'id' => 5,
            'name' => 'BMW 740i Pure Excellence',
            'brand' => 'BMW',
            'price' => 4699000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHMNStnEqOgN-AtfJc4ZxIl-FSqSxWD-_KPP9Zjk-BkA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10',
            'engine' => 'Xăng 3.0L I6 TwinPower Turbo Mild-Hybrid (381 HP / 540 Nm)',
            'transmission' => 'Tự động 8 cấp Steptronic Sport',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Sedan hạng sang cỡ lớn đỉnh cao công nghệ của BMW. Không gian nội thất xa hoa với thanh pha lê tương tác BMW Interaction Bar, ghế ngồi thương gia bọc da Merino cao cấp tích hợp massage, màn hình rạp chiếu phim rạp phía sau 31.3 inch và dàn âm thanh vòm Bowers & Wilkins Diamond.'
        ],
        [
            'id' => 4,
            'name' => 'Mercedes-AMG G63',
            'brand' => 'Mercedes-Benz',
            'price' => 11750000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9k-mmUkZkHwMhAB8bjPOA9mFIiMkV_1C-dBgyFThkTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHgJI_oRJzR0lzto9sfPraPiSShwHmuhhfQ45LX6a1lA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKEtZnRwUw07P1WR5UkpeZNNF4_2YJJY3Pyyja2xXKOw&s=10',
            'engine' => 'Xăng V8 4.0L Biturbo AMG (585 HP / 850 Nm)',
            'transmission' => 'Tự động thể thao 9 cấp AMG SPEEDSHIFT TCT 9G',
            'fuel' => 'Xăng',
            'description' => 'Mẫu SUV địa hình hạng sang biểu tượng uy quyền. Thiết kế khung gầm hình thang siêu cứng vững với 3 khóa vi sai độc lập có thể khóa hoàn toàn bằng điện, hệ thống ống xả thể thao đặt bên hông uy lực, nội thất da Nappa hảo hạng kết hợp hệ thống âm thanh vòm Burmester 15 loa.'
        ],
        [
            'id' => 3,
            'name' => 'Porsche 911 Carrera S',
            'brand' => 'Porsche',
            'price' => 8500000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUGbNCOFMrr8i-ELaF9sQVPpIjPWMSJB44Ql_bo2667w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIwrpx24-3p2ImkIovLVRN_wTXP-Sr-f5Y_LXkgKJDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpMtyFyXiOJ0kzPQgcy_26PGobb5w_z8zugn9VxdYSjg&s=10',
            'engine' => 'Xăng Boxer 6 xi-lanh 3.0L Twin-Turbo (450 HP / 530 Nm)',
            'transmission' => 'Ly hợp kép 8 cấp PDK danh tiếng của Porsche',
            'fuel' => 'Xăng',
            'description' => 'Biểu tượng xe thể thao hiệu suất cao huyền thoại mang lại cảm giác lái thuần khiết đỉnh cao. Khả năng tăng tốc 0-100 km/h chỉ mất 3.7 giây khi trang bị gói Sport Chrono, tốc độ tối đa đạt 308 km/h, tích hợp hệ thống treo chủ động PASM và thiết kế buồng lái đậm chất xe đua Đức.'
        ],
        [
            'id' => 2,
            'name' => 'Mercedes-Benz C-Class C300 AMG',
            'brand' => 'Mercedes-Benz',
            'price' => 2099000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8nJj5R87z1dpwUCcHbj1KwNTJtJBM4sYDjrEIgxRtRA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jXuoX5_WAmEuVpxNpYUIX-UtNpPa78eTAQECU9_aJQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR98khAhzlP1bBIDo7mN_uNiVMy5ExBrqfae38EzD2oBg&s=10',
            'engine' => 'Xăng 2.0L Turbo kết hợp công nghệ EQ Boost Mild-Hybrid (258 HP / 400 Nm)',
            'transmission' => 'Tự động 9 cấp 9G-TRONIC',
            'fuel' => 'Xăng Mild-Hybrid',
            'description' => 'Mẫu sedan thể thao mệnh danh là "tiểu S-Class" với gói trang thiết kế ngoại thất AMG Line cuốn hút, màn hình giải trí trung tâm đặt dọc 11.9 inch tích hợp MBUX thế hệ mới, cụm đèn pha thông minh Digital Light tối tân và hệ thống âm thanh vòm Burmester 3D 15 loa sống động.'
        ],
        [
            'id' => 1,
            'name' => 'VinFast VF3',
            'brand' => 'VinFast',
            'price' => 240000000.00,
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFJCmiv3bB_2DDesc8SnYvKr_hq-1IiNwk2YCGZKyqZA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDJ8HxL4j3SfFrNMGCvRD9bwAZjykVF3WG-Xxl5v7h9w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbsZHkDzGDsG_EspjalYDoIEN3dnHiV45pQrIns8UK3w&s=10',
            'engine' => 'Động cơ điện đơn (Công suất 43 HP / Mô-men xoắn 110 Nm)',
            'transmission' => 'Tự động 1 cấp',
            'fuel' => 'Điện',
            'description' => 'Cơn sốt xe điện mini đô thị tại Việt Nam! Mang phong cách thiết kế hình hộp cá tính, khỏe khoắn, khoảng sáng gầm xe cao 191mm giúp dễ dàng vượt qua các địa hình ngập nước đô thị, là mẫu xe điện bán chạy nhất (Best Seller) tại Showroom 4TL.'
        ]
    ];
}

echo json_encode($cars, JSON_UNESCAPED_UNICODE);
```

### file train_bot.html:
```html
<!doctype html>
<html lang="vi" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Huấn Luyện AI Chatbot - Showroom 4TL</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=Montserrat:wght@700;800;900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/theme.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body
    class="hidden bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-white p-6 font-sans min-h-screen transition-colors duration-300">
    <div class="max-w-4xl mx-auto space-y-6">
      <!-- Header -->
      <div
        class="flex justify-between items-center bg-white/90 dark:bg-slate-900/90 backdrop-blur-md p-5 rounded-2xl border border-gray-200 dark:border-white/10 shadow-xl">
        <div class="flex items-center gap-3">
          <div
            class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 text-white flex items-center justify-center shadow-lg shadow-indigo-600/30">
            <i class="fa-solid fa-robot text-lg"></i>
          </div>
          <h1 class="text-xl font-black text-slate-900 dark:text-white font-heading">
            Huấn Luyện AI Chatbot (Train Bot)
          </h1>
        </div>

        <div class="flex items-center gap-2.5">
          <button
            id="themeToggle"
            type="button"
            title="Chuyển chế độ Sáng / Tối"
            class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 text-indigo-600 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-amber-300 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
            <i id="themeIcon" class="fa-solid fa-sun text-base"></i>
          </button>

          <a
            href="admin.html"
            class="bg-gray-100 hover:bg-gray-200 text-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-gray-200 px-4 py-2 rounded-xl text-xs font-bold border border-gray-200 dark:border-white/10 transition flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay về Admin
          </a>
        </div>
      </div>

      <!-- Form Thêm Tri Thức Mới -->
      <div
        class="bg-white dark:bg-slate-900/80 p-6 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl">
        <h2 class="text-base font-bold mb-4 text-slate-900 dark:text-gray-200 font-heading">
          Thêm Dữ Liệu Phản Hồi Mới
        </h2>
        <p id="statusMsg" class="hidden text-emerald-500 mb-4 text-xs font-semibold"></p>

        <form id="trainForm" class="space-y-4 text-xs">
          <div>
            <label class="block text-slate-700 dark:text-gray-400 mb-1 font-semibold">
              Từ khóa nhận biết (phân cách bằng dấu phẩy)
            </label>
            <input
              type="text"
              id="keywords"
              placeholder="Ví dụ: gia, bao nhieu, chi phi"
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-slate-700 dark:text-gray-400 mb-1 font-semibold">
              Câu trả lời phản hồi tự động
            </label>
            <textarea
              id="response"
              rows="3"
              placeholder="Ví dụ: Giá siêu xe dao động từ 240 triệu đến 19 tỷ VNĐ..."
              required
              class="w-full bg-gray-50 dark:bg-slate-800 p-3 rounded-xl border border-gray-300 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500"></textarea>
          </div>
          <button
            type="submit"
            class="bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white px-6 py-3 rounded-xl font-bold transition shadow-lg shadow-indigo-600/30">
            + Lưu Dữ Liệu Train
          </button>
        </form>
      </div>

      <!-- Bảng Danh Sách Tri Thức Đang Có -->
      <div
        class="bg-white dark:bg-slate-900/80 p-6 rounded-3xl border border-gray-200 dark:border-white/10 shadow-xl overflow-x-auto">
        <h2 class="text-base font-bold mb-4 text-slate-900 dark:text-gray-200 font-heading">
          Danh Sách Từ Khóa Đã Huấn Luyện
        </h2>
        <table class="w-full text-left border-collapse text-xs">
          <thead>
            <tr class="border-b border-gray-200 dark:border-white/10 text-gray-500 dark:text-gray-400">
              <th class="p-3">ID</th>
              <th class="p-3">Từ khóa (Keywords)</th>
              <th class="p-3">Câu phản hồi (Response)</th>
              <th class="p-3 text-right">Thao tác</th>
            </tr>
          </thead>
          <tbody
            id="knowledgeTable"
            class="divide-y divide-gray-100 dark:divide-white/5 text-slate-700 dark:text-gray-300"></tbody>
        </table>
      </div>
    </div>

    <script>
      // Bảo vệ trang: chưa đăng nhập đẩy về login.html
      (async function checkAdminSession() {
        try {
          const res = await fetch("../php/auth_check.php");
          const data = await res.json();
          if (!data.logged_in) {
            window.location.replace("login.html");
            return;
          }
          document.body.classList.remove("hidden");
          loadKnowledge();
        } catch (e) {
          window.location.replace("login.html");
        }
      })();

      async function loadKnowledge() {
        const table = document.getElementById("knowledgeTable");
        try {
          const res = await fetch("../php/train_bot.php?action=list");
          const result = await res.json();
          const list = result.data || [];

          if (list.length === 0) {
            table.innerHTML = `<tr><td colspan="4" class="p-4 text-center text-gray-500">Chưa có dữ liệu tri thức nào.</td></tr>`;
            return;
          }

          table.innerHTML = list
            .map(
              (k) => `
              <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition">
                <td class="p-3 text-gray-400 font-mono">#${k.id}</td>
                <td class="p-3 text-indigo-600 dark:text-indigo-400 font-bold">${escapeHtml(k.keywords)}</td>
                <td class="p-3 text-slate-700 dark:text-gray-300">${escapeHtml(k.response)}</td>
                <td class="p-3 text-right">
                  <button onclick="deleteKnowledge(${k.id})" class="text-rose-600 dark:text-rose-400 hover:underline font-bold">Xóa</button>
                </td>
              </tr>
            `,
            )
            .join("");
        } catch (e) {
          table.innerHTML = `<tr><td colspan="4" class="p-4 text-center text-rose-500">Lỗi tải dữ liệu từ máy chủ.</td></tr>`;
        }
      }

      document.getElementById("trainForm").onsubmit = async function (e) {
        e.preventDefault();
        const msgEl = document.getElementById("statusMsg");
        const res = await fetch("../php/train_bot.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            action: "add",
            keywords: document.getElementById("keywords").value,
            response: document.getElementById("response").value,
          }),
        });
        const data = await res.json();
        msgEl.innerText = data.message;
        msgEl.className =
          data.status === "success"
            ? "text-emerald-500 mb-4 text-xs font-semibold"
            : "text-rose-500 mb-4 text-xs font-semibold";
        msgEl.classList.remove("hidden");

        if (data.status === "success") {
          this.reset();
          loadKnowledge();
        }
      };

      async function deleteKnowledge(id) {
        if (!confirm("Bạn có muốn xóa từ khóa này?")) return;
        await fetch(`../php/train_bot.php?action=delete&id=${id}`);
        loadKnowledge();
      }

      function escapeHtml(str) {
        return String(str).replace(/[&<>"']/g, (m) => ({
          "&": "&amp;",
          "<": "&lt;",
          ">": "&gt;",
          '"': "&quot;",
          "'": "&#39;",
        }[m]));
      }
    </script>
  </body>
</html>
```

### file train_bot.php:
```php
<?php
require_once 'auth_check.php';
requireAdminApi();
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

if (!$pdo) {
    echo json_encode(["status" => "error", "message" => "Chưa kết nối được CSDL MySQL", "data" => []], JSON_UNESCAPED_UNICODE);
    exit();
}

$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
if (empty($action) && isset($input['action'])) {
    $action = $input['action'];
}

try {
    if ($action === 'list' || ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($action))) {
        $stmt = $pdo->query("SELECT * FROM bot_knowledge ORDER BY id DESC");
        $knowledges = $stmt->fetchAll();
        echo json_encode(["status" => "success", "data" => $knowledges], JSON_UNESCAPED_UNICODE);

    } elseif ($action === 'add') {
        $keywords = mb_strtolower(trim($input['keywords'] ?? ''), 'UTF-8');
        $response = trim($input['response'] ?? '');

        if (empty($keywords) || empty($response)) {
            echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ từ khóa và câu trả lời!"], JSON_UNESCAPED_UNICODE);
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO bot_knowledge (keywords, response) VALUES (?, ?)");
        $stmt->execute([$keywords, $response]);
        echo json_encode(["status" => "success", "message" => "Đã lưu từ khóa huấn luyện thành công!"], JSON_UNESCAPED_UNICODE);

    } elseif ($action === 'delete') {
        $id = intval($_GET['id'] ?? $input['id'] ?? 0);
        if ($id <= 0) {
            echo json_encode(["status" => "error", "message" => "ID không hợp lệ!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $stmt = $pdo->prepare("DELETE FROM bot_knowledge WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["status" => "success", "message" => "Đã xóa từ khóa!"], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi CSDL: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>
```

### file style.css:
```css
/* 4TL MOTORS - ROYAL AMETHYST (VELVET VIOLET GLOW - DARK & LIGHT EDITION) */
:root {
    --font-sans: 'Be Vietnam Pro', system-ui, -apple-system, sans-serif;
    --font-heading: 'Montserrat', 'Be Vietnam Pro', sans-serif;

    /* Core Royal Amethyst Palette */
    --primary: #8b5cf6;          /* Violet 500 */
    --primary-hover: #7c3aed;    /* Violet 600 */
    --accent-violet: #a78bfa;    /* Violet 400 */
    --accent-lavender: #ddd6fe;  /* Violet 200 */
    --accent-orchid: #9333ea;    /* Purple 600 */
    --gold: #f59e0b;

    --primary-glow: rgba(139, 92, 246, 0.45);
    --galaxy-gradient: linear-gradient(135deg, #6d28d9 0%, #8b5cf6 50%, #4f46e5 100%);
    --aurora-text-gradient: linear-gradient(135deg, #ffffff 10%, #ddd6fe 45%, #a78bfa 78%, #818cf8 100%);
}

html.light {
    --primary: #6d28d9;
    --primary-hover: #5b21b6;
    --accent-violet: #7c3aed;
    --accent-lavender: #8b5cf6;
    --accent-orchid: #9333ea;

    --primary-glow: rgba(109, 40, 217, 0.25);
    --galaxy-gradient: linear-gradient(135deg, #5b21b6 0%, #7c3aed 52%, #4338ca 100%);
    --aurora-text-gradient: linear-gradient(135deg, #1e1b4b 8%, #5b21b6 48%, #7c3aed 82%, #4f46e5 100%);
}

html {
    scroll-behavior: smooth;
    font-family: var(--font-sans);
}

body {
    overflow-x: hidden;
    font-family: var(--font-sans);
    transition: background-color 0.35s ease, color 0.35s ease;
}

h1, h2, h3, h4, h5, h6, .font-heading {
    font-family: var(--font-heading);
}

/* 1. DARK MODE: DEEP VELVET PURPLE & AMETHYST GLOW */
html.dark {
    background: #090514 !important;
}

html.dark body {
    background: transparent !important;
    position: relative;
    isolation: isolate;
}

/* Nền ánh tím hoàng gia đa tầng (Không còn hồng gắt hay cyan) */
html.dark body::before {
    content: "";
    position: fixed;
    inset: 0;
    z-index: -3;
    pointer-events: none;

    background-color: #090514;
    background-image:
        radial-gradient(
            ellipse 70% 55% at 20% 15%,
            rgba(124, 58, 237, 0.32) 0%,
            rgba(91, 33, 182, 0.14) 45%,
            transparent 75%
        ),
        radial-gradient(
            ellipse 65% 50% at 82% 28%,
            rgba(139, 92, 246, 0.28) 0%,
            rgba(76, 29, 149, 0.12) 48%,
            transparent 75%
        ),
        radial-gradient(
            ellipse 80% 60% at 50% 85%,
            rgba(109, 40, 217, 0.26) 0%,
            rgba(46, 16, 101, 0.15) 50%,
            transparent 80%
        ),
        linear-gradient(
            180deg,
            #0b0618 0%,
            #120926 50%,
            #080412 100%
        );
    background-attachment: fixed;
}

/* Cho phép <main> và <section> trong suốt hoàn toàn để lộ nền ngân hà */
html.dark :is(main, section):not(#chatWindow):not([id$="Modal"] *) {
    background-color: transparent !important;
}

/* Chỉ giữ nền kính mờ cho thanh điều hướng trên cùng (header) và chân trang (footer) */
html.dark header {
    background-color: rgba(15, 9, 32, 0.65) !important;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
}

html.dark footer {
    background-color: rgba(11, 6, 24, 0.78) !important;
}

/* Giữ nền đặc vừa đủ cho Popup Modal và Cửa sổ Chat */
html.dark :is(#detailModal, #qrModal, #compareModal, #bookingModal, #editCarModal) > div,
html.dark #chatWindow {
    background-color: rgba(18, 11, 40, 0.95) !important;
    border-color: rgba(139, 92, 246, 0.38) !important;
}

/* 2. LIGHT MODE: SOFT LAVENDER MIST (SƯƠNG TÍM NHẠT) */
html.light {
    background: #f5f3ff !important;
}

html.light body {
    background: transparent !important;
    position: relative;
    isolation: isolate;
}

html.light body::before {
    content: "";
    position: fixed;
    inset: 0;
    z-index: -3;
    pointer-events: none;
    background-color: #f5f3ff;
    background-image:
        radial-gradient(ellipse at 14% 16%, rgba(196, 181, 253, 0.55) 0%, transparent 50%),
        radial-gradient(ellipse at 86% 22%, rgba(221, 214, 254, 0.60) 0%, transparent 48%),
        radial-gradient(ellipse at 50% 88%, rgba(167, 139, 250, 0.32) 0%, transparent 55%);
    background-attachment: fixed;
}

html.light body::after {
    content: "";
    position: fixed;
    inset: 0;
    z-index: -2;
    pointer-events: none;
    background-image:
        radial-gradient(2px 2px at 45px 65px, rgba(124, 58, 237, 0.25) 99%, transparent),
        radial-gradient(1.5px 1.5px at 180px 140px, rgba(139, 92, 246, 0.22) 99%, transparent),
        radial-gradient(2px 2px at 320px 90px, rgba(109, 40, 217, 0.22) 99%, transparent),
        radial-gradient(1.5px 1.5px at 260px 270px, rgba(147, 51, 234, 0.20) 99%, transparent);
    background-size: 460px 350px;
}

/* 3. BỤI ÁNH SÁNG TÍM LẤP LÁNH NHẸ (DARK MODE) */
html.dark body::after {
    content: "";
    position: fixed;
    inset: 0;
    z-index: -2;
    pointer-events: none;

    background-image:
        radial-gradient(1.2px 1.2px at 25px 35px, rgba(237, 233, 254, 0.85) 99%, transparent),
        radial-gradient(1.8px 1.8px at 95px 115px, rgba(196, 181, 253, 0.90) 99%, transparent),
        radial-gradient(1.2px 1.2px at 180px 65px, rgba(167, 139, 250, 0.85) 99%, transparent),
        radial-gradient(2px 2px at 240px 180px, rgba(221, 214, 254, 0.88) 99%, transparent),
        radial-gradient(1.2px 1.2px at 310px 45px, rgba(255, 255, 255, 0.85) 99%, transparent),
        radial-gradient(1.5px 1.5px at 370px 140px, rgba(168, 85, 247, 0.82) 99%, transparent),
        radial-gradient(1.2px 1.2px at 420px 230px, rgba(221, 214, 254, 0.80) 99%, transparent),
        radial-gradient(1.5px 1.5px at 145px 265px, rgba(196, 181, 253, 0.85) 99%, transparent);

    background-size: 460px 350px;
    background-repeat: repeat;
    opacity: 0.45;
    animation: galaxyStarsTwinkle 5s ease-in-out infinite alternate;
}

@keyframes galaxyStarsTwinkle {
    0% { opacity: 0.25; filter: brightness(0.9); }
    50% { opacity: 0.45; filter: brightness(1.05); }
    100% { opacity: 0.60; filter: brightness(1.18); }
}

/* 4. SAO LẤP LÁNH ÁNH TÍM */
.galaxy-sparkles {
    display: none;
}

html.dark body .galaxy-sparkles {
    display: block;
    position: fixed;
    inset: 0;
    z-index: -1;
    pointer-events: none;
    overflow: hidden;
}

.galaxy-sparkles span {
    position: absolute;
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: #ede9fe;
    box-shadow:
        0 0 6px 2px rgba(221, 214, 254, 0.85),
        0 0 16px 5px rgba(139, 92, 246, 0.65);
    opacity: 0.2;
    animation: sparklePulse 3.8s ease-in-out infinite;
}

.galaxy-sparkles span::before,
.galaxy-sparkles span::after {
    content: "";
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
}

.galaxy-sparkles span::before {
    width: 1px;
    height: 18px;
    background: linear-gradient(transparent, rgba(221, 214, 254, 0.9), transparent);
}

.galaxy-sparkles span::after {
    width: 18px;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(221, 214, 254, 0.9), transparent);
}

.galaxy-sparkles span:nth-child(1) { left: 12%; top: 18%; animation-delay: 0s; }
.galaxy-sparkles span:nth-child(2) { left: 28%; top: 65%; animation-delay: 1.2s; }
.galaxy-sparkles span:nth-child(3) { left: 48%; top: 28%; animation-delay: 2.1s; }
.galaxy-sparkles span:nth-child(4) { left: 67%; top: 75%; animation-delay: 0.7s; }
.galaxy-sparkles span:nth-child(5) { left: 83%; top: 35%; animation-delay: 1.8s; }
.galaxy-sparkles span:nth-child(6) { left: 92%; top: 82%; animation-delay: 2.7s; }
.galaxy-sparkles span:nth-child(7) { left: 38%; top: 88%; animation-delay: 1.5s; }
.galaxy-sparkles span:nth-child(8) { left: 75%; top: 12%; animation-delay: 0.4s; }

@keyframes sparklePulse {
    0%, 100% { opacity: 0.12; transform: scale(0.55) rotate(0deg); }
    45% { opacity: 0.90; transform: scale(1.3) rotate(45deg); }
    65% { opacity: 0.50; transform: scale(0.9) rotate(90deg); }
}

/* 5. VỆT SÁNG ÁNH TÍM NHẸ */
.galaxy-meteors {
    display: none;
}

html.dark body .galaxy-meteors {
    display: block;
    position: fixed;
    inset: 0;
    z-index: -1;
    pointer-events: none;
    overflow: hidden;
}

.galaxy-meteors span {
    position: absolute;
    width: 2px;
    height: 2px;
    border-radius: 50%;
    background: #ede9fe;
    box-shadow: 0 0 8px 2px rgba(167, 139, 250, 0.9);
    opacity: 0;
}

.galaxy-meteors span::after {
    content: "";
    position: absolute;
    right: 1px;
    top: 0;
    width: 70px;
    height: 1px;
    transform: rotate(-35deg);
    transform-origin: right center;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(139, 92, 246, 0.25),
        rgba(196, 181, 253, 0.65),
        rgba(255, 255, 255, 0.92)
    );
}

.galaxy-meteors span:nth-child(1) { left: 18%; top: 10%; animation: meteorFall 9s linear infinite 2s; }
.galaxy-meteors span:nth-child(2) { left: 72%; top: 20%; animation: meteorFall 12s linear infinite 6s; }
.galaxy-meteors span:nth-child(3) { left: 45%; top: 5%; animation: meteorFall 10s linear infinite 9s; }

@keyframes meteorFall {
    0% { opacity: 0; transform: translate(0, 0); }
    3% { opacity: 0.80; }
    12% { opacity: 0.60; }
    20% { opacity: 0; transform: translate(-150px, 190px); }
    100% { opacity: 0; transform: translate(-150px, 190px); }
}

/* 6. SCROLLBAR ÁNH TÍM */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}
::-webkit-scrollbar-track {
    background: #090514;
}
::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #6d28d9, #8b5cf6);
    border-radius: 999px;
}
::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #8b5cf6, #a78bfa);
}

.light ::-webkit-scrollbar-track {
    background: #ede9fe;
}
.light ::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #7c3aed, #8b5cf6);
}

/* 7. GLASSMORPHISM PANELS & CARDS (ÁNH TÍM MỊN) */
.glass-panel {
    background: rgba(18, 11, 40, 0.38);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(139, 92, 246, 0.28);
    box-shadow: 0 10px 35px rgba(9, 5, 22, 0.42), inset 0 1px 0 rgba(221, 214, 254, 0.12);
}

.light .glass-panel {
    background: rgba(255, 255, 255, 0.90);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(124, 58, 237, 0.20);
    box-shadow: 0 10px 28px -5px rgba(109, 40, 217, 0.12);
}

.glass-card {
    background: rgba(23, 14, 50, 0.40);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border: 1px solid rgba(139, 92, 246, 0.24);
    transition: all 0.32s cubic-bezier(0.4, 0, 0.2, 1);
}

.light .glass-card {
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid rgba(139, 92, 246, 0.18);
    box-shadow: 0 6px 16px rgba(109, 40, 217, 0.07);
}

.glass-card:hover {
    transform: translateY(-6px);
    border-color: rgba(167, 139, 250, 0.65);
    box-shadow:
        0 20px 35px -10px rgba(0, 0, 0, 0.65),
        0 0 28px rgba(139, 92, 246, 0.35),
        0 0 45px rgba(109, 40, 217, 0.18);
}

.light .glass-card:hover {
    transform: translateY(-6px);
    border-color: rgba(124, 58, 237, 0.45);
    box-shadow:
        0 18px 28px -6px rgba(109, 40, 217, 0.16),
        0 0 18px rgba(139, 92, 246, 0.12);
}

/* 8. BUTTONS, TEXT GRADIENTS & GLOWS */
:is(button, a).bg-indigo-600 {
    background-image: var(--galaxy-gradient) !important;
    border: 1px solid rgba(221, 214, 254, 0.2);
    box-shadow: 0 6px 20px -4px rgba(139, 92, 246, 0.5);
    transition: all 0.25s ease;
}

:is(button, a).bg-indigo-600:hover {
    filter: brightness(1.12);
    box-shadow: 0 8px 26px -2px rgba(167, 139, 250, 0.55);
}

.glow-red {
    box-shadow: 0 0 24px rgba(139, 92, 246, 0.40), 0 0 42px rgba(109, 40, 217, 0.22);
}

.glow-red-sm {
    box-shadow: 0 0 12px rgba(139, 92, 246, 0.32);
}

.text-gradient-red,
.text-galaxy-gradient {
    background: var(--aurora-text-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.text-gradient-gold {
    background: linear-gradient(135deg, #fef08a, #f59e0b 60%, #b45309);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* 9. HERO GRADIENT MESH (ÁNH TÍM SÂU) */
html.dark .hero-gradient-mesh {
    background-color: transparent !important;
    background-image:
        radial-gradient(ellipse at 22% 45%, rgba(124, 58, 237, 0.28), transparent 58%),
        radial-gradient(ellipse at 82% 30%, rgba(139, 92, 246, 0.20), transparent 55%),
        radial-gradient(ellipse at 65% 85%, rgba(91, 33, 182, 0.18), transparent 58%);
}

.light .hero-gradient-mesh {
    background-image:
        radial-gradient(at 0% 0%, rgba(221, 214, 254, 0.72), transparent 55%),
        radial-gradient(at 100% 0%, rgba(196, 181, 253, 0.62), transparent 55%),
        radial-gradient(at 50% 100%, rgba(237, 233, 254, 0.75), transparent 60%);
}

/* 10. ANIMATIONS, RANGE SLIDER, FILTER PILLS */
@keyframes pulse-ring {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.65); }
    70% { transform: scale(1); box-shadow: 0 0 0 13px rgba(139, 92, 246, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(139, 92, 246, 0); }
}

.pulse-ring {
    animation: pulse-ring 2.5s infinite cubic-bezier(0.4, 0, 0.6, 1);
}

.shine-hover {
    position: relative;
    overflow: hidden;
}

.shine-hover::after {
    content: "";
    position: absolute;
    top: -50%;
    left: -60%;
    width: 20%;
    height: 200%;
    background: linear-gradient(60deg, transparent 20%, rgba(237, 233, 254, 0.28) 50%, transparent 80%);
    transform: rotate(25deg);
    transition: all 0.75s ease;
}

.shine-hover:hover::after {
    left: 140%;
}

/* Range Input (Thanh trượt dự toán trả góp ánh tím) */
input[type=range] {
    -webkit-appearance: none;
    appearance: none;
    background: #2e1065;
    height: 6px;
    border-radius: 999px;
    outline: none;
}

.light input[type=range] {
    background: #ddd6fe;
    cursor: pointer;
}

input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: linear-gradient(135deg, #7c3aed, #a78bfa);
    cursor: pointer;
    box-shadow: 0 0 12px rgba(139, 92, 246, 0.8);
    transition: transform 0.15s ease;
}

input[type=range]::-webkit-slider-thumb:hover {
    transform: scale(1.2);
}

/* Brand & Category Filter Pills */
.brand-pill,
.cat-pill {
    transition: all 0.22s ease;
    user-select: none;
}

.brand-pill.active,
.cat-pill.active {
    background: var(--galaxy-gradient) !important;
    color: #fff !important;
    border-color: rgba(196, 181, 253, 0.65) !important;
    box-shadow: 0 4px 16px rgba(124, 58, 237, 0.48);
}

.light .brand-pill:not(.active),
.light .cat-pill:not(.active) {
    background: rgba(255, 255, 255, 0.92);
    color: #3b0764;
    border-color: #ddd6fe;
}

.light .brand-pill:not(.active):hover,
.light .cat-pill:not(.active):hover {
    border-color: #7c3aed;
    color: #6d28d9;
    background: #f5f3ff;
}
```

### file schema.sql:
```sql
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- 1. Bảng danh sách xe
DROP TABLE IF EXISTS cars;
CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    image TEXT,
    engine VARCHAR(100),
    transmission VARCHAR(100),
    fuel VARCHAR(50),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Bảng tài khoản quản trị
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Bảng dữ liệu huấn luyện Chatbot
DROP TABLE IF EXISTS bot_knowledge;
CREATE TABLE bot_knowledge (
    id INT AUTO_INCREMENT PRIMARY KEY,
    keywords VARCHAR(255) NOT NULL,
    response TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Bảng đặt lịch lái thử / tư vấn
DROP TABLE IF EXISTS bookings;
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    car_name VARCHAR(255) NOT NULL,
    booking_date VARCHAR(50) DEFAULT NULL,
    note TEXT DEFAULT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Bảng quản lý đặt cọc xe
DROP TABLE IF EXISTS deposits;
CREATE TABLE deposits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_name VARCHAR(255) NOT NULL,
    car_price DECIMAL(15,2) NOT NULL,
    memo VARCHAR(100) NOT NULL,
    customer_name VARCHAR(150) DEFAULT 'Khách đặt online',
    customer_phone VARCHAR(20) DEFAULT '',
    status ENUM('pending', 'verified', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO bot_knowledge (keywords, response) VALUES
('gia, bao nhieu, chi phi', 'Giá các dòng xe tại Showroom 4TL dao động từ 240 triệu (VinFast VF3) đến hơn 19 tỷ VNĐ (Ferrari F8 Tributo).'),
('bao hanh, dich vu', 'Tất cả siêu xe và xe sang bán ra đều bảo hành 3 - 10 năm chính hãng, cam kết kiểm định 160 bước không đâm đụng, không ngập nước.'),
('tra gop, vay', 'Showroom 4TL hỗ trợ trả góp qua ngân hàng lên đến 80% giá trị xe trong thời gian tối đa 7 năm với lãi suất ưu đãi chỉ từ 7.5%/năm.');

INSERT INTO cars (name, brand, price, image, engine, transmission, fuel, description) VALUES
('VinFast VF3', 'VinFast', 240000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFJCmiv3bB_2DDesc8SnYvKr_hq-1IiNwk2YCGZKyqZA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDJ8HxL4j3SfFrNMGCvRD9bwAZjykVF3WG-Xxl5v7h9w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbsZHkDzGDsG_EspjalYDoIEN3dnHiV45pQrIns8UK3w&s=10', 'Động cơ điện đơn (Công suất 43 HP / Mô-men xoắn 110 Nm)', 'Tự động 1 cấp', 'Điện', 'Cơn sốt xe điện mini đô thị tại Việt Nam! Mang phong cách thiết kế hình hộp cá tính, khỏe khoắn, khoảng sáng gầm xe cao 191mm giúp dễ dàng vượt qua các địa hình ngập nước đô thị, là mẫu xe điện bán chạy nhất (Best Seller) tại Showroom 4TL.'),
('Mercedes-Benz C-Class C300 AMG', 'Mercedes-Benz', 2099000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8nJj5R87z1dpwUCcHbj1KwNTJtJBM4sYDjrEIgxRtRA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jXuoX5_WAmEuVpxNpYUIX-UtNpPa78eTAQECU9_aJQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR98khAhzlP1bBIDo7mN_uNiVMy5ExBrqfae38EzD2oBg&s=10', 'Xăng 2.0L Turbo kết hợp công nghệ EQ Boost Mild-Hybrid (258 HP / 400 Nm)', 'Tự động 9 cấp 9G-TRONIC', 'Xăng Mild-Hybrid', 'Mẫu sedan thể thao mệnh danh là "tiểu S-Class" với gói trang thiết kế ngoại thất AMG Line cuốn hút, màn hình giải trí trung tâm đặt dọc 11.9 inch tích hợp MBUX thế hệ mới, cụm đèn pha thông minh Digital Light tối tân và hệ thống âm thanh vòm Burmester 3D 15 loa sống động.'),
('Porsche 911 Carrera S', 'Porsche', 8500000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUGbNCOFMrr8i-ELaF9sQVPpIjPWMSJB44Ql_bo2667w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXIwrpx24-3p2ImkIovLVRN_wTXP-Sr-f5Y_LXkgKJDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpMtyFyXiOJ0kzPQgcy_26PGobb5w_z8zugn9VxdYSjg&s=10', 'Xăng Boxer 6 xi-lanh 3.0L Twin-Turbo (450 HP / 530 Nm)', 'Ly hợp kép 8 cấp PDK danh tiếng của Porsche', 'Xăng', 'Biểu tượng xe thể thao hiệu suất cao huyền thoại mang lại cảm giác lái thuần khiết đỉnh cao. Khả năng tăng tốc 0-100 km/h chỉ mất 3.7 giây khi trang bị gói Sport Chrono, tốc độ tối đa đạt 308 km/h, tích hợp hệ thống treo chủ động PASM và thiết kế buồng lái đậm chất xe đua Đức.'),
('Mercedes-AMG G63', 'Mercedes-Benz', 11750000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9k-mmUkZkHwMhAB8bjPOA9mFIiMkV_1C-dBgyFThkTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHgJI_oRJzR0lzto9sfPraPiSShwHmuhhfQ45LX6a1lA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKEtZnRwUw07P1WR5UkpeZNNF4_2YJJY3Pyyja2xXKOw&s=10', 'Xăng V8 4.0L Biturbo AMG (585 HP / 850 Nm)', 'Tự động thể thao 9 cấp AMG SPEEDSHIFT TCT 9G', 'Xăng', 'Mẫu SUV địa hình hạng sang biểu tượng uy quyền. Thiết kế khung gầm hình thang siêu cứng vững với 3 khóa vi sai độc lập có thể khóa hoàn toàn bằng điện, hệ thống ống xả thể thao đặt bên hông uy lực, nội thất da Nappa hảo hạng kết hợp hệ thống âm thanh vòm Burmester 15 loa.'),
('BMW 740i Pure Excellence', 'BMW', 4699000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHMNStnEqOgN-AtfJc4ZxIl-FSqSxWD-_KPP9Zjk-BkA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpu21ap_2ACAfDEwwDAA0bGGi1yx5bZ0rMJ9gDkNsew&s=10', 'Xăng 3.0L I6 TwinPower Turbo Mild-Hybrid (381 HP / 540 Nm)', 'Tự động 8 cấp Steptronic Sport', 'Xăng Mild-Hybrid', 'Sedan hạng sang cỡ lớn đỉnh cao công nghệ của BMW. Không gian nội thất xa hoa với thanh pha lê tương tác BMW Interaction Bar, ghế ngồi thương gia bọc da Merino cao cấp tích hợp massage, màn hình rạp chiếu phim rạp phía sau 31.3 inch và dàn âm thanh vòm Bowers & Wilkins Diamond.'),
('VinFast VF8 Plus', 'VinFast', 1270000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMgh5eFb69xZCQCeJXpE2n1sx0fIj0gMZRsLUCkF7F2Q&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2fiRyUQE2tzYAfH61XkhF-ZaRi4kbEv1pGYAd6gaKZw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnZ23dQtN4guhpS1WTpIHS2Azx4Cb_TRBVR3v3oMa8A&s=10', '2 mô-tơ điện AWD toàn thời gian (402 HP / 620 Nm)', 'Tự động 1 cấp', 'Điện', 'SUV điện thông minh phân khúc D mạnh mẽ, trang bị nhiều tính năng trợ lái nâng cao ADAS. Khả năng tăng tốc ấn tượng từ 0-100 km/h dưới 5.5 giây, màn hình trung tâm tràn viền 15.6 inch tối giản, không gian rộng rãi và cửa sổ trời toàn cảnh kính lớn.'),
('VinFast VF5 Plus', 'VinFast', 468000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd-uWGNUo1taSToXpQaIDCJxCi0OOXvd5SN34Va8zCgQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFGMSwMiRgj3WEsCu14j3Th0mDeFZDiTmfuN5AIyfgiA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEnAbDWJMk7kjzcYqCfHxsNLGsZ4hGodDqmC_vbKh6lw&s=10', 'Động cơ điện đơn (Công suất 134 HP / Mô-men xoắn 135 Nm)', 'Tự động 1 cấp', 'Điện', 'Mẫu A-SUV chạy điện nhỏ gọn, thiết kế năng động tối ưu cho nhu cầu di chuyển đô thị hàng ngày. Tầm hoạt động hơn 300 km cho mỗi lần sạc đầy, tích hợp trợ lý ảo tiếng Việt thông minh, cảnh báo điểm mù và trang bị 6 túi khí an toàn.'),
('Toyota Camry 2.5Q', 'Toyota', 1405000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYl1j8avzp_a52uX2szBu_X2g82yHbEtkqDDN0XtKJ6A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ16pL8BQW83ACdsEAsk95IbLeS0i347RmCkAbc4zGLLA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkDKY-KgdZor0p_2ggyNXFiRd7VE6K5ydz31QxuOYG8w&s=10', 'Xăng Dynamic Force 2.5L (207 HP / 250 Nm)', 'Tự động 8 cấp', 'Xăng', 'Mẫu sedan hạng D biểu tượng cho sự bền bỉ, sang trọng và êm ái. Khoang hành khách phía sau thiết kế chuẩn doanh nhân với bệ tỳ tay tích hợp bảng điều khiển cảm ứng ngả ghế, rèm che nắng chỉnh điện, điều hòa 3 vùng độc lập và 9 loa JBL cao cấp.'),
('Toyota Corolla Cross 1.8HEV', 'Toyota', 905000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpA_ZtVNe8sOc_-tGXiFue--SWAvHYn4hqdXnj1v5NYg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuPdKKZWfVIlpfJtWjiH1WDTCkzs65ZGLNbW8xdkYXA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaemDP4gzPH3lDaNIymrWag_h6ogYiqv8TLc60aEacSA&s=10', 'Xăng 1.8L kết hợp mô-tơ điện Hybrid (Tổng công suất 122 HP)', 'Tự động vô cấp E-CVT', 'Xăng Hybrid', 'SUV đô thị xanh tiết kiệm nhiên liệu tối ưu nhờ công suất tự sạc Hybrid tiên tiến. Trang bị gói công nghệ an toàn Toyota Safety Sense, camera toàn cảnh 360 độ, cửa sổ trời toàn cảnh và vận hành êm ái, bền bỉ chuẩn mực.'),
('Ford Ranger Raptor 3.0 V6', 'Ford', 1299000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkAP8_0fM7-es-s0TkuWfES4ERnhn3kRzgpiERtCEFyw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSX-ZqLNONfwQeU5XwtL9ZqejukswL1TpUpsr1-76jc3w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQH0fOuAoH-XV1q7BGhIXSq8KXrWfeO2ChqH9Z6Zjgvg&s=10', 'Xăng EcoBoost 3.0L V6 Twin-Turbo (397 HP / 583 Nm)', 'Tự động 10 cấp điện tử', 'Xăng', 'Vua bán tải hiệu năng cao chuyên nghiệp, trang bị hệ thống giảm xóc FOX Live Valve 2.5 inch trượt địa hình. Sở hữu 7 chế độ lái linh hoạt (bao gồm chế độ Baja chuyên đua sa mạc), hệ thống khóa vi sai trước/sau và ống xả thể thao điều chỉnh độ vang.'),
('Ford Everest Titanium+ 4x4', 'Ford', 1468000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiZtZyv9cLXgHdi-7v-PjeTIL5tGeeU3tpnMYplS6XDw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTYj1liAKQcUeUhRU01jidOFrEQonbqh2FvYukozZM4w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfRprvZIOazCuK7ZgS3R8vKBIHAlTpdmYSX9Y03eOZBw&s=10', 'Bi-Turbo Diesel 2.0L i4 (210 HP / 500 Nm)', 'Tự động 10 cấp điện tử', 'Dầu (Diesel)', 'SUV 7 chỗ gầm cao hầm hố, khả năng cách âm đỉnh cao và giàu công nghệ an toàn hàng đầu phân khúc. Hệ thống dẫn động 2 cầu 4x4 thông minh, màn hình trung tâm dọc 12 inch chạy SYNC 4A, camera 360 độ sắc nét và hỗ trợ đỗ xe tự động.'),
('Hyundai Tucson 2.0 Diesel', 'Hyundai', 959000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStMbKbjpRugZbAa8Jxhz2GPdFPKMMrw8fJwjRdQ-TBZQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZ8ey04y0-7pSS5gagfiCQrjMaVJBoxy_NPolImcNVTA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-AHImYzA1sSv1yPO9EeJObAW1AWSceaxllVKBvl_VJg&s=10', 'Diesel Smartstream D2.0 (186 HP / 416 Nm)', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Crossover sở hữu thiết kế ngoại thất táo bạo, khả năng vận hành mạnh mẽ, bốc và tiết kiệm nhiên liệu tối ưu. Nổi bật với lưới tản nhiệt hình khối thông minh, cần số điện tử dạng nút bấm, cửa sổ trời toàn cảnh và gói an toàn Hyundai SmartSense.'),
('Hyundai Accent 1.5 AT', 'Hyundai', 489000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqxAlh0ojNuYt82BpLC-BRYGclFmTXJd-gJrp2lEF6WQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSahuOZxstBhmyAYM9STEFGftWiVL3FaEJV6jgiXXgjVQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NEb-vWA47bMBzZmMi3bTdDEKeRmafgiCvZAUuKuHlA&s=10', 'Xăng Smartstream G1.5 (115 HP / 144 Nm)', 'Tự động vô cấp thông minh iVT', 'Xăng', 'Sedan hạng B phổ thông, tiện nghi phong phú vượt tầm giá. Thiết kế phong cách Fastback thể thao trẻ trung, màn hình giải trí 8 inch tích hợp Apple CarPlay/Android Auto không dây, sạc điện thoại không dây và tính năng mở cốp thông minh.'),
('Honda CR-V e:HEV RS', 'Honda', 1259000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgYwkQ2_Bnn715DhM8OfuYNpzg5ozBqKoyC2evRYhhUw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYKCZvpPeMChk_J4Lbs9BbrSrpBDSw5G69aSbUDdtrsw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8Vqeig2JBKNtNlJ5UGdtK69cmsDwRARmVSINyLF-S_Q&s=10', 'Xăng 2.0L kết hợp 2 mô-tơ điện (Tổng công suất 204 HP / 335 Nm)', 'Tự động vô cấp E-CVT', 'Xăng Hybrid', 'SUV 5 chỗ thể thao mang lại trải nghiệm lái phấn khích chuẩn Honda Sensing. Khả năng tiết kiệm nhiên liệu tối ưu chỉ khoảng 5.2L/100km trong đô thị, trang bị cửa sổ trời toàn cảnh Panorama, hệ thống âm thanh 12 loa Bose và màn hình HUD.'),
('Mazda CX-5 2.0 Premium', 'Mazda', 829000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpW39XsAvfNmzgS3h7r2TjxeeJTUhyLpVsnzGlKpS-mQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTInC9__STOHLHNime6eFjQhx4SSUEX5S8lyJn71cJTqQ&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIF5WKKGY123T08e8kSO_mXGGGMgDtg41luLhyq88TKw&s=10', 'Xăng SkyActiv-G 2.0L (154 HP / 200 Nm)', 'Tự động 6 cấp', 'Xăng', 'Mẫu Crossover bán chạy hàng đầu phân khúc nhờ ngôn ngữ thiết kế KODO tinh tế. Trang bị màn hình hiển thị kính lái HUD, gương chiếu hậu chống chói tự động, cốp điện rảnh tay, 10 loa Bose cao cấp và gói an toàn chủ động i-Activsense.'),
('Kia Carnival 2.2D Signature', 'Kia', 1759000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDrQOfx7kICr3cyGjHqTHm_SMnzFbZOde_TVN6qS1FXw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5v0u6MMN_-u8H5QgBA6eq9gRrBtD3urv_V9zGDT_5ig&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKUw3TRHK3bFJ7Hv5brQb8FBAB1NJEcZdPSkYD5-8ysg&s=10', 'Diesel Smartstream 2.2L (199 HP / 440 Nm)', 'Tự động 8 cấp', 'Dầu (Diesel)', 'Xe gia đình hạng sang (MPV) cỡ lớn rộng rãi, trang bị đầy đủ như khoang hạng thương gia. Hàng ghế thứ hai chỉnh điện thư giãn tích hợp sưởi/làm mát, cửa sổ trời đôi độc lập, rèm che nắng và hệ thống âm thanh 12 loa Bose.'),
('Audi Q7 45 TFSI quattro', 'Audi', 3700000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsMi5fmiZg1cQubrLMpSpHHiwFbiC2puLtGW-dhi1Evw&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg2Z49zJQSa-QgYOK6PnDsCeXGbIjDlMy_UJgY5AVG0w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXio_hwx7mM0zgI01Sdx4o-ZLySmfpn8qKouBDzFESQA&s=10', 'Xăng 2.0L TFSI Mild-Hybrid MHEV (252 HP / 370 Nm)', 'Tự động 8 cấp Tiptronic', 'Xăng', 'SUV hạng sang 7 chỗ dẫn động 4 bánh toàn thời gian quattro danh tiếng. Thiết kế lưới tản nhiệt Singleframe bát giác bề thế, cụm đèn pha LED Matrix sắc sảo, buồng lái ảo Audi Virtual Cockpit và dàn âm thanh 3D Bang & Olufsen 19 loa.'),
('Lexus RX350 Luxury', 'Lexus', 4330000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOKn1MNoCINsLRyMryNK-gqu0xXC7E4vegTJpqDpxwKg&s, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlhxOxreBx7dZ0WVilniwHUvofB_NaKB71xDtEZh1WYA&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOMkj7dV-dZSUjqzqpyhMVxWrlA_BEZeQ-CC4u_rdp7Q&s=10', 'Xăng 2.4L Turbo I4 (275 HP / 430 Nm)', 'Tự động 8 cấp', 'Xăng', 'Mẫu SUV xe sang Nhật Bản êm ái, cách âm vượt trội và giữ giá tốt. Nội thất bọc da Semi-Aniline cao cấp, màn hình trung tâm cảm ứng 14 inch, hệ thống âm thanh vòm 21 loa Mark Levinson và gói công nghệ an toàn Lexus Safety System+.'),
('Lamborghini Urus S', 'Lamborghini', 16500000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHS2yGPTepN8pLd6xYDDwMDfzd7nNgw0Wb_yTGlGCm0A&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKtHAnyoB_1kLYyhE81rizhXi7nkTxwh82w-nitYue7g&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ098BS6eDBP3owhuf17ApxAaDbgMExcwrI0huLgTUudQ&s=10', 'Xăng V8 4.0L Twin-Turbo (666 HP / 850 Nm)', 'Tự động 8 cấp', 'Xăng', 'Siêu SUV sở hữu sức mạnh 666 mã lực, tăng tốc 0-100 km/h trong 3.5 giây. Hệ thống dẫn động 4 bánh toàn thời gian, treo khí nén thích ứng thông minh và núm xoay chế độ lái ANIMA gồm Strada, Sport, Corsa, Terra, Sabbia và Neve.'),
('Ferrari F8 Tributo', 'Ferrari', 19000000000.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE3sDpn33xn9qTk5wTWc6EFHdkMEssFXSa6l-0td5o2w&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgqtnNRCxzmqTFoL6wSi62G-QtJKf_vgT58IWQOpjJvg&s=10, https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTw0GaWZqHRGG_hseloDpgEOje7D5M_ahm2lMqzkTrlTg&s=10', 'Xăng V8 3.9L Twin-Turbo (720 HP / 770 Nm)', 'Ly hợp kép 7 cấp F1', 'Xăng', 'Siêu xe thể thao động cơ đặt giữa kinh điển của thương hiệu Ngựa chồm. Tăng tốc 0-100 km/h trong 2.9 giây, tốc độ tối đa 340 km/h, trang bị hốc gió khí động học S-Duct lấy cảm hứng từ xe đua Công thức 1 giúp tăng lực ép xuống đường.');
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

        if (empty($carName) || empty($cusPhone)) {
            echo json_encode(["status" => "error", "message" => "Thiếu tên xe hoặc số điện thoại xác nhận đặt cọc!"], JSON_UNESCAPED_UNICODE);
            exit();
        }

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
require_once 'auth_check.php';
requireAdminApi();

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

        $allowedStatuses = ['pending', 'confirmed', 'verified', 'cancelled'];
        if ($id <= 0 || !in_array($status, $allowedStatuses, true)) {
            echo json_encode(["status" => "error", "message" => "Tham số ID hoặc trạng thái không hợp lệ!"], JSON_UNESCAPED_UNICODE);
            exit();
        }

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

### file auth_check.php:
```php
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireAdminPage()
{
    if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: ../html/login.html');
        exit();
    }
}

function requireAdminApi()
{
    if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        http_response_code(401);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "status" => "unauthorized",
            "message" => "Từ chối truy cập! Bạn chưa đăng nhập quyền Admin."
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }
}

// Endpoint cho phép các file HTML kiểm tra phiên đăng nhập qua fetch()
if (basename($_SERVER['SCRIPT_FILENAME']) === 'auth_check.php') {
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode([
        "logged_in" => (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true),
        "user" => $_SESSION['admin_user'] ?? null
    ], JSON_UNESCAPED_UNICODE);
    exit();
}
```

### file theme.js:
```js
// 1. Cấu hình Tailwind CSS dùng chung cho toàn bộ các trang HTML
if (typeof tailwind !== "undefined") {
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        colors: {
          brand: {
            50: "#faf5ff",
            100: "#f3e8ff",
            400: "#c084fc",
            500: "#a855f7",
            600: "#9333ea",
            700: "#7e22ce",
            800: "#6b21a8",
            900: "#581c87",
          },
          galaxy: {
            space: "#090514",
            nebula: "#8b5cf6",
            aurora: "#a78bfa",
            pearl: "#f5f3ff",
          },
        },
        fontFamily: {
          sans: ["Be Vietnam Pro", "sans-serif"],
          heading: ["Montserrat", "sans-serif"],
        },
      },
    },
  };
}

// 2. Hàm áp dụng giao diện Dark / Light
function applyGlobalTheme(mode) {
  const html = document.documentElement;
  const themeIcon = document.getElementById("themeIcon");
  const themeToggle = document.getElementById("themeToggle");

  if (mode === "light") {
    html.classList.remove("dark");
    html.classList.add("light");
    if (themeIcon) themeIcon.className = "fa-solid fa-moon text-indigo-600 text-base";
    if (themeToggle) themeToggle.title = "Chuyển sang chế độ Tối (Dark Mode)";
  } else {
    html.classList.add("dark");
    html.classList.remove("light");
    if (themeIcon) themeIcon.className = "fa-solid fa-sun text-amber-300 text-base";
    if (themeToggle) themeToggle.title = "Chuyển sang chế độ Sáng (Light Mode)";
  }
}

// 3. Hàm chuyển đổi khi bấm nút
function toggleGlobalTheme() {
  const isDark = document.documentElement.classList.contains("dark");
  const nextMode = isDark ? "light" : "dark";
  localStorage.setItem("theme", nextMode);
  applyGlobalTheme(nextMode);
}

// 4. Chạy ngay lập tức khi tải trang để tránh nháy màn hình
(function initGlobalTheme() {
  const savedTheme = localStorage.getItem("theme") || "dark";
  applyGlobalTheme(savedTheme);
})();

// 5. Gắn sự kiện click cho nút #themeToggle & Tự động khởi tạo hiệu ứng Galaxy (Sao 4 cánh + Sao băng)
document.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem("theme") || "dark";
  applyGlobalTheme(savedTheme);

  const themeToggle = document.getElementById("themeToggle");
  if (themeToggle) {
    themeToggle.onclick = toggleGlobalTheme;
  }

  // Tự động chèn hiệu ứng Sao 4 cánh & Sao băng nếu chưa có trong HTML
  if (!document.querySelector(".galaxy-sparkles")) {
    const sparkles = document.createElement("div");
    sparkles.className = "galaxy-sparkles";
    sparkles.setAttribute("aria-hidden", "true");
    sparkles.innerHTML = "<span></span>".repeat(8);
    document.body.prepend(sparkles);
  }

  if (!document.querySelector(".galaxy-meteors")) {
    const meteors = document.createElement("div");
    meteors.className = "galaxy-meteors";
    meteors.setAttribute("aria-hidden", "true");
    meteors.innerHTML = "<span></span>".repeat(3);
    document.body.prepend(meteors);
  }
});

// 6. Tự động đồng bộ khi đổi Dark/Light ở một tab khác
window.addEventListener("storage", (e) => {
  if (e.key === "theme" && e.newValue) {
    applyGlobalTheme(e.newValue);
  }
});

// 7. Hàm chuẩn hóa danh sách ảnh xe (Hỗ trợ nhiều link/file ngăn cách bằng dấu phẩy)
const FALLBACK_CAR_IMG = "https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800";

function normalizeSingleImage(singleImg) {
  if (!singleImg || String(singleImg).trim() === "" || singleImg === "default.jpg") {
    return FALLBACK_CAR_IMG;
  }
  const cleanImg = String(singleImg).trim();
  if (cleanImg.startsWith("http://") || cleanImg.startsWith("https://")) {
    return cleanImg;
  }
  const prefix = window.location.pathname.includes("/html/") ? "../" : "";
  if (cleanImg.startsWith("images/")) {
    return prefix + cleanImg;
  }
  return prefix + "images/" + cleanImg.replace(/^\/+/, "");
}

function getCarImages(imgString) {
  if (!imgString || String(imgString).trim() === "" || imgString === "default.jpg") {
    return [FALLBACK_CAR_IMG];
  }
  const list = String(imgString)
    .split(/[\n,]+/)
    .map((item) => item.trim())
    .filter((item) => item !== "");
  return list.length > 0 ? list.map(normalizeSingleImage) : [FALLBACK_CAR_IMG];
}

function getCarImage(img) {
  return getCarImages(img)[0];
}

// 8. Hàm chống XSS dùng chung cho toàn bộ website
function escapeHtml(str) {
  if (str === null || str === undefined) return "";
  return String(str).replace(/[&<>"']/g, (m) => ({
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;",
  }[m]));
}
```

### file car_collection.html
```html
<!doctype html>
<html lang="vi" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bộ Sưu Tập Siêu Xe - SHOWROOM 4TL</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&family=Montserrat:wght@600;700;800;900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Thẻ gọi JS & CSS từ thư mục gốc -->
    <script src="../js/theme.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body
    class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 transition-colors duration-300 min-h-screen selection:bg-indigo-600 selection:text-white">
    <!-- KHUNG CHỨA THÔNG BÁO TOAST -->
    <div
      id="toastContainer"
      class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex flex-col items-center gap-2 pointer-events-none"></div>

    <!-- NAVBAR -->
    <header
      class="sticky top-0 z-40 bg-white/85 dark:bg-slate-950/85 backdrop-blur-xl border-b border-gray-200/80 dark:border-white/10 px-4 md:px-8 py-3.5 transition-all duration-300 shadow-sm">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="../index.html" class="flex items-center gap-3 group">
          <div
            class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-indigo-900 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30">
            <i class="fa-solid fa-shield-halved text-lg"></i>
          </div>
          <div>
            <div
              class="text-2xl font-black tracking-wider text-slate-900 dark:text-white font-heading leading-none flex items-center gap-1">
              4TL
              <span class="text-indigo-600">MOTORS</span>
            </div>
            <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 tracking-widest uppercase">
              Supercar Collection
            </span>
          </div>
        </a>

        <div class="flex items-center gap-3">
          <a
            href="orders_history.html"
            class="bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 px-3.5 py-2 rounded-xl text-xs font-bold border border-emerald-500/30 transition flex items-center gap-1.5">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Đơn Của Tôi
          </a>
          <button
            onclick="openCompareModal()"
            class="relative bg-indigo-600/10 hover:bg-indigo-600/20 text-indigo-600 dark:text-indigo-400 px-4 py-2 rounded-xl text-xs font-bold border border-indigo-500/30 transition flex items-center gap-1.5">
            <i class="fa-solid fa-code-compare"></i>
            So Sánh Xe (
            <span id="compareCount">0</span>
            )
          </button>
          <a
            href="../index.html"
            class="bg-gray-100 hover:bg-gray-200 text-slate-700 dark:bg-slate-800 dark:text-gray-200 px-4 py-2 rounded-xl text-xs font-bold border border-gray-200 dark:border-white/10 transition flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i>
            Trang Chủ
          </a>
          <button
            id="themeToggle"
            type="button"
            class="w-10 h-10 rounded-xl bg-gray-100 text-amber-500 dark:bg-slate-800 dark:text-yellow-400 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
            <i id="themeIcon" class="fa-solid fa-sun text-base"></i>
          </button>
        </div>
      </div>
    </header>

    <!-- BRAND LOGO / QUICK FILTER STRIP -->
    <section
      class="py-6 bg-gray-100/80 dark:bg-slate-950/90 border-b border-gray-200 dark:border-white/10 overflow-x-auto">
      <div
        class="max-w-7xl mx-auto px-4 flex items-center gap-2 sm:gap-3 justify-start md:justify-center min-w-max"
        id="brandPillContainer"></div>
    </section>

    <!-- MAIN CAR SHOWROOM & INVENTORY -->
    <main id="car-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
          <span
            class="text-xs font-bold text-indigo-600 dark:text-indigo-500 tracking-widest uppercase flex items-center gap-1.5">
            <i class="fa-solid fa-car-side"></i>
            BỘ SƯU TẬP XE 2026
          </span>
          <h2 class="text-3xl sm:text-4xl font-black font-heading mt-1 text-slate-900 dark:text-white">
            TOÀN BỘ SIÊU XE & XE SANG SẴN GIAO
          </h2>
        </div>
        <div class="flex items-center gap-3">
          <span
            id="carCountBadge"
            class="text-xs font-bold px-3 py-1.5 rounded-xl bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-white/10 shadow-sm">
            Đang hiển thị:
            <strong class="text-indigo-600">0</strong>
            xe
          </span>
          <button onclick="resetAllFilters()" class="text-xs text-gray-500 hover:text-indigo-600 underline transition">
            <i class="fa-solid fa-rotate-left mr-1"></i>
            Đặt lại bộ lọc
          </button>
        </div>
      </div>

      <!-- ADVANCED FILTER & SEARCH PANEL -->
      <div class="glass-panel p-5 rounded-3xl space-y-4 shadow-xl border border-gray-200/80 dark:border-white/10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
          <div class="relative lg:col-span-2">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-gray-400 text-sm"></i>
            <input
              type="text"
              id="searchInput"
              placeholder="Tìm kiếm theo tên xe, hãng xe..."
              class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <select
              id="brandFilter"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500">
              <option value="">Tất cả thương hiệu</option>
            </select>
          </div>
          <div>
            <select
              id="priceFilter"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500">
              <option value="">Tất cả phân khúc giá</option>
              <option value="under-3b">Dưới 3 Tỷ VNĐ</option>
              <option value="3b-10b">3 Tỷ - 10 Tỷ VNĐ</option>
              <option value="over-10b">Trên 10 Tỷ VNĐ (Siêu xe)</option>
            </select>
          </div>
          <div>
            <select
              id="fuelFilter"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-900/90 border border-gray-300 dark:border-white/10 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500">
              <option value="">Tất cả nhiên liệu</option>
              <option value="Điện">⚡ Xe thuần điện (EV)</option>
              <option value="Xăng">⛽ Xe máy xăng</option>
              <option value="Hybrid">🔋 Xe Hybrid</option>
            </select>
          </div>
        </div>
      </div>

      <!-- CAR INVENTORY GRID -->
      <div id="carGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-2"></div>
    </main>

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

    <!-- MODAL 2: MÃ QR ĐẶT CỌC -->
    <div
      id="qrModal"
      class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 items-center justify-center p-4 hidden"
      style="display: none">
      <div
        class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-3xl max-w-sm w-full p-6 text-center relative shadow-2xl border border-gray-200 dark:border-indigo-500/30 space-y-4">
        <button
          onclick="closeModal('qrModal')"
          class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white flex items-center justify-center transition">
          ✕
        </button>
        <div
          class="w-12 h-12 rounded-full bg-indigo-600/10 dark:bg-indigo-600/20 text-indigo-600 dark:text-indigo-500 mx-auto flex items-center justify-center text-xl">
          <i class="fa-solid fa-qrcode"></i>
        </div>
        <h3 class="text-lg font-black uppercase text-slate-900 dark:text-white font-heading">
          QUÉT MÃ QR ĐẶT CỌC GIỮ XE
        </h3>
        <p class="text-xs text-gray-500 dark:text-gray-300" id="qrCarName">Thanh toán cọc giữ xe tại Showroom 4TL</p>
        <div class="bg-white p-3 rounded-2xl inline-block shadow-lg border border-gray-200">
          <img
            id="qrImage"
            src="../images/qrcode.jpg"
            alt="Mã QR Đặt Cọc"
            class="w-48 h-48 mx-auto object-contain"
            onerror="this.src = FALLBACK_CAR_IMG" />
        </div>
        <div
          class="bg-gray-100 dark:bg-slate-800 p-3 rounded-xl text-left text-xs space-y-1 text-slate-700 dark:text-gray-300 border border-gray-200 dark:border-white/10">
          <div class="flex justify-between">
            <span>Ngân hàng:</span>
            <strong class="text-slate-900 dark:text-white">MB Bank</strong>
          </div>
          <div class="flex justify-between">
            <span>Số tài khoản:</span>
            <strong class="text-indigo-600 dark:text-indigo-400 font-mono">0765650114</strong>
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
            class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          <input
            type="tel"
            id="qrCustomerPhone"
            placeholder="Số điện thoại xác nhận *"
            class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-xs text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
        </div>
        <button
          onclick="confirmDepositSuccess()"
          class="w-full bg-indigo-600 hover:bg-violet-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-md shadow-indigo-600/30">
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
              Xem trực quan thông số, phân khúc và mức giá giữa các mẫu xe.
            </p>
          </div>
          <button
            onclick="closeModal('compareModal')"
            class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 hover:text-gray-900 dark:text-gray-300 flex items-center justify-center transition">
            ✕
          </button>
        </div>
        <div id="compareTableContainer" class="overflow-x-auto"></div>
      </div>
    </div>

    <!-- MODAL 4: ĐĂNG KÝ LÁI THỬ -->
    <div
      id="bookingModal"
      class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 items-center justify-center p-4 hidden"
      style="display: none">
      <div
        class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-3xl max-w-md w-full p-6 relative shadow-2xl border border-gray-200 dark:border-white/15 space-y-4">
        <button
          onclick="closeModal('bookingModal')"
          class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 text-gray-500 hover:text-gray-900 dark:text-gray-300 flex items-center justify-center transition">
          ✕
        </button>
        <h3 class="text-xl font-black font-heading text-slate-900 dark:text-white">ĐĂNG KÝ TRẢI NGHIỆM LÁI THỬ</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400">
          Đội ngũ Showroom 4TL sẽ chuẩn bị xe sẵn sàng đón tiếp quý khách.
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
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-600 dark:text-gray-400 mb-1">Số điện thoại liên hệ</label>
            <input
              type="tel"
              id="modalBookingPhone"
              required
              placeholder="0900.xxx.xxx"
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <div>
            <label class="block text-gray-600 dark:text-gray-400 mb-1">Thời gian dự kiến</label>
            <input
              type="date"
              id="modalBookingDate"
              required
              class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          </div>
          <button
            type="submit"
            class="w-full bg-indigo-600 hover:bg-violet-700 text-white font-bold py-3 rounded-xl text-xs transition shadow-lg shadow-indigo-600/30">
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
        class="relative pulse-ring w-14 h-14 bg-gradient-to-tr from-indigo-600 to-indigo-500 text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition duration-300 group cursor-pointer">
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
          class="bg-gradient-to-r from-violet-700 to-indigo-600 p-4 text-white flex justify-between items-center shadow-sm">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-white shadow-inner">
              <i class="fa-solid fa-robot"></i>
            </div>
            <div>
              <h4 class="text-sm font-bold leading-tight">4TL AI Assistant</h4>
              <span class="text-[10px] text-indigo-200 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Trực tuyến 24/7
              </span>
            </div>
          </div>
          <div class="flex items-center gap-1.5">
            <a
              href="bot_train.html"
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
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            ⚡ Giá VF3
          </button>
          <button
            onclick="quickPrompt('Tư vấn xe dưới 2 tỷ')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            💰 Dưới 2 tỷ
          </button>
          <button
            onclick="quickPrompt('Tư vấn thủ tục trả góp')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            💳 Trả góp
          </button>
          <button
            onclick="quickPrompt('Đăng ký lái thử xe')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
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
            class="flex-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-white/10 px-3.5 py-2.5 rounded-xl text-xs text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          <button
            onclick="sendChatMessage()"
            class="bg-indigo-600 hover:bg-violet-700 text-white px-4 py-2.5 rounded-xl font-bold text-xs transition">
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
      let allCars = [];
      let comparedCars = [];
      let currentBrandFilter = "Tất cả";

      function showToast(message, type = "success") {
        const container = document.getElementById("toastContainer");
        if (!container) return;
        const toast = document.createElement("div");
        toast.className = `px-4 py-3 rounded-2xl text-xs font-bold shadow-xl border backdrop-blur-md transition-all duration-300 flex items-center gap-2 ${
          type === "success"
            ? "bg-emerald-500/90 text-white border-emerald-400"
            : "bg-rose-500/90 text-white border-rose-400"
        }`;
        toast.innerHTML = `<i class="fa-solid ${type === "success" ? "fa-circle-check" : "fa-triangle-exclamation"} text-sm"></i> ${escapeHtml(message)}`;
        container.appendChild(toast);
        setTimeout(() => {
          toast.style.opacity = "0";
          setTimeout(() => toast.remove(), 300);
        }, 3500);
      }

      function formatCurrency(amount) {
        if (!amount) return "Liên hệ";
        return Number(amount).toLocaleString("vi-VN") + " VNĐ";
      }

      function formatBillion(amount) {
        const val = Number(amount);
        if (val >= 1e9) {
          return (val / 1e9).toFixed(1) + " Tỷ";
        }
        return val.toLocaleString("vi-VN") + " VNĐ";
      }

      async function fetchCars() {
        try {
          const res = await fetch("../php/get_cars.php?t=" + Date.now(), { cache: "no-store" });
          const data = await res.json();
          allCars = Array.isArray(data) ? data : [];
        } catch (e) {
          allCars = [];
        }
        renderBrandPills();
        populateBrandDropdown();
        filterCars();
      }

      function renderBrandPills() {
        const brands = ["Tất cả", ...[...new Set(allCars.map((c) => c.brand))].sort()];
        document.getElementById("brandPillContainer").innerHTML = brands
          .map(
            (b) => `
          <button data-brand="${b}" onclick="filterByBrandQuick('${b}')" class="brand-pill px-4 py-1.5 rounded-full text-xs font-bold border border-gray-200 dark:border-white/10 ${currentBrandFilter === b ? "active bg-indigo-600 text-white" : "bg-white text-slate-700 dark:bg-slate-900 dark:text-gray-300"}">${b}</button>
        `,
          )
          .join("");
      }

      function filterByBrandQuick(brand) {
        currentBrandFilter = brand;
        document.querySelectorAll(".brand-pill").forEach((btn) => {
          if (btn.dataset.brand === brand) {
            btn.classList.add("active", "bg-indigo-600", "text-white");
            btn.classList.remove("bg-white", "text-slate-700", "dark:bg-slate-900", "dark:text-gray-300");
          } else {
            btn.classList.remove("active", "bg-indigo-600", "text-white");
            btn.classList.add("bg-white", "text-slate-700", "dark:bg-slate-900", "dark:text-gray-300");
          }
        });
        const select = document.getElementById("brandFilter");
        if (select) select.value = brand === "Tất cả" ? "" : brand;
        filterCars();
      }

      function populateBrandDropdown() {
        const brands = [...new Set(allCars.map((c) => c.brand))].sort();
        const select = document.getElementById("brandFilter");
        if (!select) return;
        select.innerHTML = '<option value="">Tất cả thương hiệu</option>';
        brands.forEach((b) => {
          const opt = document.createElement("option");
          opt.value = b;
          opt.textContent = b;
          select.appendChild(opt);
        });
      }

      function slideCardImage(carId, step) {
        const car = allCars.find((c) => Number(c.id) === Number(carId));
        if (!car) return;
        const imgs = getCarImages(car.image);
        if (imgs.length <= 1) return;

        const imgEl = document.getElementById(`card-img-${carId}`);
        const badgeEl = document.getElementById(`card-badge-${carId}`);
        if (!imgEl) return;

        let idx = parseInt(imgEl.dataset.idx || "0", 10);
        idx = (idx + step + imgs.length) % imgs.length;
        imgEl.dataset.idx = idx;
        imgEl.src = imgs[idx];
        if (badgeEl) badgeEl.innerText = `${idx + 1}/${imgs.length}`;
      }

      function renderCars(cars) {
        const grid = document.getElementById("carGrid");
        document.getElementById("carCountBadge").innerHTML =
          `Đang hiển thị: <strong class="text-indigo-600">${cars.length}</strong> xe`;

        if (cars.length === 0) {
          grid.innerHTML = `
            <div class="col-span-full py-16 text-center space-y-3">
              <i class="fa-solid fa-car-tunnel text-4xl text-gray-400"></i>
              <p class="text-sm text-gray-500 font-medium">Không tìm thấy siêu xe phù hợp với bộ lọc.</p>
              <button onclick="resetAllFilters()" class="text-xs text-indigo-600 font-bold underline">Xóa bộ lọc tìm kiếm</button>
            </div>
          `;
          return;
        }

        grid.innerHTML = cars
          .map((car) => {
            const isCompared = comparedCars.some((c) => Number(c.id) === Number(car.id));
            const carImgs = getCarImages(car.image);
            const hasMulti = carImgs.length > 1;
            return `
            <div class="glass-card rounded-3xl overflow-hidden flex flex-col justify-between group bg-white dark:bg-slate-900/60 border border-gray-200 dark:border-white/10 shadow-md">
              <div class="relative overflow-hidden aspect-[16/10] bg-slate-900">
                <img id="card-img-${car.id}" data-idx="0" src="${carImgs[0]}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 cursor-pointer" onclick="window.location.href='detail.html?id=${car.id}'" onerror="this.onerror=null; this.src=FALLBACK_CAR_IMG">
                <span class="absolute top-3 left-3 bg-indigo-600/90 backdrop-blur text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                  ${escapeHtml(car.brand)}
                </span>
                <span class="absolute top-3 right-3 bg-slate-900/80 backdrop-blur text-amber-400 text-[10px] font-bold px-2.5 py-1 rounded-full">
                  <i class="fa-solid fa-bolt mr-1"></i>${escapeHtml(car.fuel || "Xăng")}
                </span>
                ${
                  hasMulti
                    ? `
                  <button type="button" onclick="event.stopPropagation(); slideCardImage(${car.id}, -1)"
                    class="opacity-0 group-hover:opacity-100 absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/60 hover:bg-indigo-600 text-white flex items-center justify-center text-xs transition shadow-md">
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button type="button" onclick="event.stopPropagation(); slideCardImage(${car.id}, 1)"
                    class="opacity-0 group-hover:opacity-100 absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-black/60 hover:bg-indigo-600 text-white flex items-center justify-center text-xs transition shadow-md">
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                  <span id="card-badge-${car.id}" class="absolute bottom-2.5 right-2.5 bg-black/65 backdrop-blur text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                    1/${carImgs.length}
                  </span>
                `
                    : ""
                }
              </div>
              <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div>
                  <h3 onclick="window.location.href='detail.html?id=${car.id}'" class="text-xl font-black text-slate-900 dark:text-white cursor-pointer hover:text-indigo-500 line-clamp-1">${escapeHtml(car.name)}</h3>
                  <div class="text-indigo-600 dark:text-indigo-400 font-heading text-2xl font-black my-1">${formatCurrency(car.price)}</div>
                  <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">${escapeHtml(car.description || "Động cơ hiệu năng cao, thiết kế sang trọng và trang bị công nghệ đỉnh cao.")}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-2 pt-2 border-t border-gray-100 dark:border-white/10">
                  <button onclick="openQRModalById(${car.id})" class="bg-indigo-600 hover:bg-violet-700 text-white font-bold py-2.5 px-2 rounded-xl text-xs transition flex items-center justify-center gap-1.5 shadow-sm">
                    <i class="fa-solid fa-qrcode"></i> Đặt Cọc
                  </button>
                  <button onclick="openBookingModalById(${car.id})" class="bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-gray-200 font-bold py-2.5 px-2 rounded-xl text-xs transition flex items-center justify-center gap-1.5 border border-gray-200 dark:border-white/10">
                    <i class="fa-solid fa-calendar-days"></i> Lái Thử
                  </button>
                </div>

                <div class="flex items-center justify-between pt-1">
                  <button onclick="window.location.href='detail.html?id=${car.id}'" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                    Xem chi tiết thông số <i class="fa-solid fa-arrow-right ml-0.5"></i>
                  </button>
                  <button onclick="toggleCompareCar(${car.id})" class="text-xs font-semibold px-2.5 py-1 rounded-lg ${isCompared ? "bg-indigo-600 text-white" : "bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300"} transition">
                    <i class="fa-solid fa-code-compare mr-1"></i> ${isCompared ? "Đang so sánh" : "+ So sánh"}
                  </button>
                </div>
              </div>
            </div>
          `;
          })
          .join("");
      }

      function filterCars() {
        const search = document.getElementById("searchInput").value.toLowerCase().trim();
        const brand = document.getElementById("brandFilter").value;
        const priceRange = document.getElementById("priceFilter").value;
        const fuel = document.getElementById("fuelFilter").value;

        let filtered = allCars.filter((c) => {
          const matchSearch =
            !search || c.name.toLowerCase().includes(search) || c.brand.toLowerCase().includes(search);
          const matchBrand = !brand || c.brand === brand;
          const matchFuel = !fuel || (c.fuel && c.fuel.toLowerCase().includes(fuel.toLowerCase()));

          let matchPrice = true;
          const price = Number(c.price);
          if (priceRange === "under-3b") matchPrice = price < 3e9;
          else if (priceRange === "3b-10b") matchPrice = price >= 3e9 && price <= 10e9;
          else if (priceRange === "over-10b") matchPrice = price > 10e9;

          return matchSearch && matchBrand && matchPrice && matchFuel;
        });
        renderCars(filtered);
      }

      function resetAllFilters() {
        document.getElementById("searchInput").value = "";
        document.getElementById("brandFilter").value = "";
        document.getElementById("priceFilter").value = "";
        document.getElementById("fuelFilter").value = "";
        currentBrandFilter = "Tất cả";
        renderBrandPills();
        renderCars(allCars);
      }

      function openModal(id) {
        const el = document.getElementById(id);
        if (el) {
          el.style.display = "flex";
          el.classList.remove("hidden");
        }
      }

      function closeModal(id) {
        const el = document.getElementById(id);
        if (el) {
          el.style.display = "none";
          el.classList.add("hidden");
        }
      }

      ["detailModal", "compareModal", "qrModal", "bookingModal"].forEach((id) => {
        const el = document.getElementById(id);
        if (el) {
          el.addEventListener("click", (e) => {
            if (e.target === el) closeModal(id);
          });
        }
      });

      let currentDepositCar = null;

      function openQRModalById(id) {
        const car = allCars.find((c) => Number(c.id) === Number(id));
        if (!car) return;
        currentDepositCar = car;
        document.getElementById("qrCarName").innerText = `Đặt cọc ưu tiên mẫu: ${car.name}`;
        document.getElementById("qrMemo").innerText = `COC ${car.id} ${car.name}`.substring(0, 30);
        const qrImg = document.getElementById("qrImage");
        qrImg.src = `https://img.vietqr.io/image/MB-0765650114-compact2.png?amount=500000000&addInfo=${encodeURIComponent("COC " + car.name)}`;
        openModal("qrModal");
      }

      async function confirmDepositSuccess() {
        const name = document.getElementById("qrCustomerName").value.trim();
        const phone = document.getElementById("qrCustomerPhone").value.trim();
        const memo = document.getElementById("qrMemo").innerText;

        if (!name || !phone) {
          showToast("Vui lòng điền đầy đủ họ tên và số điện thoại!", "error");
          return;
        }

        try {
          const res = await fetch("../php/save_order.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              type: "deposit",
              car_name: currentDepositCar ? currentDepositCar.name : "Xe Showroom 4TL",
              car_price: currentDepositCar ? currentDepositCar.price : 0,
              memo: memo,
              customer_name: name,
              customer_phone: phone,
            }),
          });
          const result = await res.json();
          if (result.status !== "success") {
            showToast(result.message || "Lỗi lưu giao dịch đặt cọc!", "error");
            return;
          }
        } catch (e) {}

        localStorage.setItem("4tl_customer_phone", phone.replace(/[^0-9]/g, ""));

        showToast("Đã ghi nhận thông tin đặt cọc thành công! Nhân viên sẽ liên hệ lại ngay.", "success");
        document.getElementById("qrCustomerName").value = "";
        document.getElementById("qrCustomerPhone").value = "";
        closeModal("qrModal");
      }

      function openBookingModalById(id) {
        const car = allCars.find((c) => Number(c.id) === Number(id));
        const carName = car ? car.name : "Tất cả mẫu xe";
        document.getElementById("modalBookingCar").value = carName;
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById("modalBookingDate").value = tomorrow.toISOString().split("T")[0];
        openModal("bookingModal");
      }

      async function handleModalBooking(e) {
        e.preventDefault();
        const car = document.getElementById("modalBookingCar").value;
        const name = document.getElementById("modalBookingName").value;
        const phone = document.getElementById("modalBookingPhone").value;
        const date = document.getElementById("modalBookingDate").value;
        try {
          await fetch("../php/save_order.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ type: "booking", name, phone, car, date, note: "Đặt lái thử từ trang Bộ sưu tập" }),
          });
        } catch (e) {}

        localStorage.setItem("4tl_customer_phone", phone.replace(/[^0-9]/g, ""));

        showToast("Đăng ký lịch lái thử thành công cho quý khách: " + name, "success");
        closeModal("bookingModal");
      }

      function toggleCompareCar(id) {
        const targetId = Number(id);
        const idx = comparedCars.findIndex((c) => Number(c.id) === targetId);
        if (idx > -1) {
          comparedCars.splice(idx, 1);
          showToast("Đã gỡ xe khỏi bảng so sánh.", "success");
        } else {
          if (comparedCars.length >= 3) {
            showToast("Chỉ có thể so sánh tối đa 3 mẫu xe cùng lúc!", "error");
            return;
          }
          const car = allCars.find((c) => Number(c.id) === targetId);
          if (car) {
            comparedCars.push(car);
            showToast(`Đã thêm ${car.name} vào bảng so sánh.`, "success");
          }
        }
        document.getElementById("compareCount").innerText = comparedCars.length;
        renderCars(allCars);
      }

      function openCompareModal() {
        if (comparedCars.length === 0 && allCars.length >= 2) {
          comparedCars = [allCars[0], allCars[1]];
        }
        document.getElementById("compareCount").innerText = comparedCars.length;
        const container = document.getElementById("compareTableContainer");
        if (!container) return;

        container.innerHTML = `
          <div class="mb-4 flex flex-wrap items-center justify-between gap-3 bg-gray-50 dark:bg-slate-800/60 p-3 rounded-2xl border border-gray-200 dark:border-white/10 text-xs">
            <div class="flex flex-wrap items-center gap-2">
              <span class="font-bold text-slate-700 dark:text-gray-300">Thêm xe so sánh:</span>
              <select onchange="handleAddCarToCompare(this.value)" class="px-3 py-1.5 rounded-xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-white/10 text-slate-800 dark:text-white">
                <option value="">-- Chọn thêm xe --</option>
                ${allCars
                  .filter((c) => !comparedCars.some((cc) => Number(cc.id) === Number(c.id)))
                  .map((c) => `<option value="${c.id}">${escapeHtml(c.name)} (${formatBillion(c.price)})</option>`)
                  .join("")}
              </select>
            </div>
            <button onclick="comparedCars=[]; closeModal('compareModal'); document.getElementById('compareCount').innerText='0'; renderCars(allCars);" class="text-indigo-600 dark:text-indigo-400 hover:underline font-bold">
              <i class="fa-solid fa-trash mr-1"></i>Xóa hết so sánh
            </button>
          </div>
          <table class="w-full table-fixed text-left border-collapse text-xs">
            <thead>
              <tr class="border-b border-gray-200 dark:border-white/10">
                <th class="p-3 text-gray-500 w-36">Thông Số</th>
                ${comparedCars
                  .map(
                    (c) => `
                  <th class="p-3 text-slate-900 dark:text-white font-bold text-base min-w-[220px]">
                    <div class="relative group mb-2">
                      <img src="${getCarImage(c.image)}" class="w-full h-36 object-cover rounded-xl border border-gray-200 dark:border-white/10" onerror="this.onerror=null; this.src=FALLBACK_CAR_IMG">
                      <button onclick="toggleCompareCar(${c.id}); openCompareModal();" title="Bỏ xe này" class="absolute top-2 right-2 w-6 h-6 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs">✕</button>
                    </div>
                    <div class="leading-tight">${escapeHtml(c.name)}</div>
                    <div class="text-indigo-600 dark:text-indigo-400 font-heading text-lg mt-1">${formatCurrency(c.price)}</div>
                  </th>
                `,
                  )
                  .join("")}
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-white/10 text-slate-700 dark:text-gray-300">
              <tr>
                <td class="p-3 font-bold text-gray-500">Hãng</td>
                ${comparedCars.map((c) => `<td class="p-3"><span class="px-2 py-0.5 rounded bg-indigo-600/10 text-indigo-300 font-bold">${escapeHtml(c.brand)}</span></td>`).join("")}
              </tr>
              <tr>
                <td class="p-3 font-bold text-gray-500">Động Cơ</td>
                ${comparedCars.map((c) => `<td class="p-3">${escapeHtml(c.engine || "N/A")}</td>`).join("")}
              </tr>
              <tr>
                <td class="p-3 font-bold text-gray-500">Hộp Số</td>
                ${comparedCars.map((c) => `<td class="p-3">${escapeHtml(c.transmission || "Tự động")}</td>`).join("")}
              </tr>
              <tr>
                <td class="p-3 font-bold text-gray-500">Nhiên Liệu</td>
                ${comparedCars.map((c) => `<td class="p-3 font-semibold text-slate-900 dark:text-white">${escapeHtml(c.fuel || "Xăng")}</td>`).join("")}
              </tr>
              <tr>
                <td class="p-3 font-bold text-gray-500">Mô Tả</td>
                ${comparedCars.map((c) => `<td class="p-3 leading-relaxed text-[11px] text-gray-500 dark:text-gray-400 break-words">${escapeHtml(c.description || "N/A")}</td>`).join("")}
              </tr>
              <tr>
                <td class="p-3 font-bold text-gray-500">Thao Tác</td>
                ${comparedCars
                  .map(
                    (c) => `
                  <td class="p-3 space-y-1.5">
                    <button onclick="closeModal('compareModal'); openBookingModalById(${c.id})" class="w-full bg-indigo-600 hover:bg-violet-700 text-white font-bold py-2 rounded-xl text-xs transition">Lái Thử</button>
                    <button onclick="closeModal('compareModal'); window.location.href='detail.html?id=${c.id}'" class="w-full bg-gray-100 dark:bg-slate-800 text-slate-800 dark:text-gray-200 font-bold py-2 rounded-xl text-xs transition">Xem Chi Tiết</button>
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

      // CHATBOT ASSISTANT LOGIC (Gọi API PHP ở thư mục gốc: ../php/bot_train.php)
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

        chatBox.innerHTML += `
          <div class="bg-indigo-600 text-white p-3 rounded-2xl rounded-tr-none max-w-[85%] ml-auto text-xs shadow-md leading-relaxed">
              ${escapeHtml(text)}
          </div>
        `;
        input.value = "";
        chatBox.scrollTop = chatBox.scrollHeight;

        const typingId = "typing-" + Date.now();
        chatBox.innerHTML += `
          <div id="${typingId}" class="bg-gray-100 dark:bg-slate-800 text-gray-500 dark:text-gray-400 p-2.5 rounded-2xl rounded-tl-none max-w-[50%] self-start text-xs border border-gray-200 dark:border-white/5 flex items-center gap-1">
              <span class="animate-bounce">●</span><span class="animate-bounce delay-100">●</span><span class="animate-bounce delay-200">●</span>
          </div>
        `;
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
          const res = await fetch("../php/bot_train.php", {
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
                Dạ quý khách cần tư vấn chi tiết về mẫu xe nào, xin vui lòng gọi trực tiếp Hotline VIP <strong>0765.650.114</strong> để được phục vụ 24/7 ạ!
            </div>
          `;
          chatBox.scrollTop = chatBox.scrollHeight;
        }
      }

      document.getElementById("searchInput").addEventListener("input", filterCars);
      document.getElementById("brandFilter").addEventListener("change", filterCars);
      document.getElementById("priceFilter").addEventListener("change", filterCars);
      document.getElementById("fuelFilter").addEventListener("change", filterCars);

      fetchCars();
    </script>

    <!-- LUXURY FLOATING AI CHATBOT WIDGET HTML -->
    <div class="fixed bottom-6 right-6 z-50">
      <button
        id="chatBubbleBtn"
        onclick="toggleChat()"
        type="button"
        aria-label="Mở Trợ lý AI 4TL"
        class="relative pulse-ring w-14 h-14 bg-gradient-to-tr from-indigo-600 to-indigo-500 text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition duration-300 group cursor-pointer">
        <i id="chatBubbleIcon" class="fa-solid fa-headset text-2xl group-hover:rotate-12 transition"></i>
        <span
          class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white dark:border-slate-900 rounded-full shadow-sm"></span>
      </button>

      <div
        id="chatWindow"
        class="hidden absolute bottom-20 right-0 w-[calc(100vw-3rem)] sm:w-96 max-h-[calc(100vh-120px)] bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border border-gray-200 dark:border-white/15 rounded-3xl shadow-2xl overflow-hidden flex flex-col h-[520px] transition-all origin-bottom-right"
        style="display: none">
        <div
          class="bg-gradient-to-r from-violet-700 to-indigo-600 p-4 text-white flex justify-between items-center shadow-sm">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-white shadow-inner">
              <i class="fa-solid fa-robot"></i>
            </div>
            <div>
              <h4 class="text-sm font-bold leading-tight">4TL AI Assistant</h4>
              <span class="text-[10px] text-indigo-200 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Trực tuyến 24/7
              </span>
            </div>
          </div>
          <div class="flex items-center gap-1.5">
            <a
              href="bot_train.html"
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

        <div
          class="p-2.5 bg-gray-100/80 dark:bg-slate-950/60 border-b border-gray-200 dark:border-white/10 flex gap-1.5 overflow-x-auto text-[11px] whitespace-nowrap">
          <button
            onclick="quickPrompt('Giá xe VinFast VF3?')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            ⚡ Giá VF3
          </button>
          <button
            onclick="quickPrompt('Tư vấn xe dưới 2 tỷ')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            💰 Dưới 2 tỷ
          </button>
          <button
            onclick="quickPrompt('Tư vấn thủ tục trả góp')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            💳 Trả góp
          </button>
          <button
            onclick="quickPrompt('Đăng ký lái thử xe')"
            class="px-2.5 py-1 rounded-full bg-white dark:bg-white/10 hover:bg-indigo-600 text-gray-700 dark:text-gray-300 hover:text-white border border-gray-200 dark:border-transparent transition">
            🏎️ Lái thử
          </button>
        </div>

        <div id="chatBox" class="flex-1 p-4 overflow-y-auto space-y-3 text-xs">
          <div
            class="bg-gray-100 dark:bg-slate-800 text-gray-800 dark:text-gray-200 p-3.5 rounded-2xl rounded-tl-none max-w-[85%] self-start border border-gray-200 dark:border-white/10 shadow-sm leading-relaxed">
            👋 Xin kính chào quý khách! Em là Trợ lý AI Showroom 4TL. Em có thể hỗ trợ quý khách tra cứu thông số kỹ
            thuật, bảng giá lăn bánh, chính sách trả góp hay lịch lái thử hôm nay ạ?
          </div>
        </div>

        <div class="p-3 bg-gray-50 dark:bg-slate-950 border-t border-gray-200 dark:border-white/10 flex gap-2">
          <input
            type="text"
            id="chatInput"
            onkeydown="if (event.key === 'Enter') sendChatMessage();"
            placeholder="Nhập câu hỏi (VD: giá C300, VF3, G63)..."
            class="flex-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-white/10 px-3.5 py-2.5 rounded-xl text-xs text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500" />
          <button
            onclick="sendChatMessage()"
            class="bg-indigo-600 hover:bg-violet-700 text-white px-4 py-2.5 rounded-xl font-bold text-xs transition">
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>
  </body>
</html>
```

### file orders_history.html:
```html
<!doctype html>
<html lang="vi" class="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lịch Sử Đơn Hàng & Lái Thử - SHOWROOM 4TL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&family=Montserrat:wght@600;700;800;900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/theme.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body
    class="bg-slate-50 text-slate-800 dark:bg-[#0b0f19] dark:text-gray-100 transition-colors duration-300 min-h-screen selection:bg-indigo-600 selection:text-white">
    <!-- TOAST CONTAINER -->
    <div
      id="toastContainer"
      class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex flex-col items-center gap-2 pointer-events-none"></div>

    <!-- NAVBAR -->
    <header
      class="sticky top-0 z-40 bg-white/85 dark:bg-slate-950/85 backdrop-blur-xl border-b border-gray-200/80 dark:border-white/10 px-4 md:px-8 py-3.5 transition-all duration-300 shadow-sm">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="../index.html" class="flex items-center gap-3 group">
          <div
            class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-indigo-900 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30">
            <i class="fa-solid fa-shield-halved text-lg"></i>
          </div>
          <div>
            <div
              class="text-2xl font-black tracking-wider text-slate-900 dark:text-white font-heading leading-none flex items-center gap-1">
              4TL
              <span class="text-indigo-600">MOTORS</span>
            </div>
            <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 tracking-widest uppercase">
              Order Tracking
            </span>
          </div>
        </a>

        <div class="flex items-center gap-3">
          <a
            href="car_collection.html"
            class="hidden sm:flex bg-indigo-600/10 hover:bg-indigo-600/20 text-indigo-600 dark:text-indigo-400 px-4 py-2 rounded-xl text-xs font-bold border border-indigo-500/30 transition items-center gap-1.5">
            <i class="fa-solid fa-car"></i>
            Bộ Sưu Tập Xe
          </a>
          <a
            href="../index.html"
            class="bg-gray-100 hover:bg-gray-200 text-slate-700 dark:bg-slate-800 dark:text-gray-200 px-4 py-2 rounded-xl text-xs font-bold border border-gray-200 dark:border-white/10 transition flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i>
            Trang Chủ
          </a>
          <button
            id="themeToggle"
            type="button"
            title="Chuyển chế độ Sáng / Tối"
            class="w-10 h-10 rounded-xl bg-gray-100 text-amber-500 dark:bg-slate-800 dark:text-yellow-400 flex items-center justify-center border border-gray-200 dark:border-white/10 transition shadow-sm">
            <i id="themeIcon" class="fa-solid fa-sun text-base"></i>
          </button>
        </div>
      </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
      <!-- HEADER & SEARCH FORM -->
      <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-white/10 shadow-2xl space-y-6">
        <div class="text-center max-w-2xl mx-auto space-y-2">
          <span
            class="text-xs font-bold text-indigo-600 dark:text-indigo-400 tracking-widest uppercase inline-flex items-center gap-1.5">
            <i class="fa-solid fa-clock-rotate-left"></i>
            CỔNG THÔNG TIN KHÁCH HÀNG
          </span>
          <h1 class="text-2xl sm:text-3xl font-black font-heading text-slate-900 dark:text-white">
            TRA CỨU LỊCH SỬ ĐẶT CỌC & LÁI THỬ
          </h1>
          <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
            Nhập số điện thoại bạn đã dùng khi đặt cọc giữ xe hoặc đăng ký lái thử để theo dõi tiến độ xử lý từ Showroom
            4TL.
          </p>
        </div>

        <form
          id="lookupForm"
          onsubmit="handleLookupSubmit(event)"
          class="max-w-xl mx-auto flex flex-col sm:flex-row gap-3">
          <div class="relative flex-1">
            <i class="fa-solid fa-phone absolute left-4 top-3.5 text-gray-400 text-sm"></i>
            <input
              type="tel"
              id="lookupPhoneInput"
              required
              placeholder="Nhập số điện thoại của bạn (VD: 0909123456)..."
              class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-300 dark:border-white/15 rounded-2xl text-sm text-slate-900 dark:text-white focus:outline-none focus:border-indigo-500 transition" />
          </div>
          <button
            type="submit"
            class="bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold px-6 py-3 rounded-2xl text-sm transition shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2 shrink-0">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span>Tra Cứu Ngay</span>
          </button>
        </form>

        <div id="savedPhoneHint" class="hidden text-center text-xs text-gray-500 dark:text-gray-400">
          Đang hiển thị lịch sử cho SĐT:
          <strong id="currentSearchedPhone" class="text-indigo-600 dark:text-indigo-400 font-mono"></strong>
          <button
            type="button"
            onclick="refreshCurrentLookup()"
            class="ml-2 text-emerald-600 dark:text-emerald-400 hover:underline font-bold">
            <i class="fa-solid fa-rotate"></i>
            Làm mới tiến độ
          </button>
        </div>
      </div>

      <!-- EMPTY / INITIAL STATE -->
      <div
        id="emptyStateBox"
        class="bg-white dark:bg-slate-900/60 p-10 rounded-3xl border border-gray-200 dark:border-white/10 text-center space-y-3">
        <div
          class="w-14 h-14 rounded-2xl bg-indigo-600/10 text-indigo-600 dark:text-indigo-400 mx-auto flex items-center justify-center text-2xl">
          <i class="fa-solid fa-file-invoice"></i>
        </div>
        <h3 class="text-base font-bold text-slate-900 dark:text-white">Chưa có dữ liệu hiển thị</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 max-w-md mx-auto">
          Hãy nhập số điện thoại của bạn ở khung phía trên để kiểm tra trạng thái xác nhận chuyển khoản đặt cọc hoặc
          lịch hẹn lái thử xe.
        </p>
      </div>

      <!-- RESULTS CONTAINER -->
      <div id="resultsContainer" class="hidden space-y-8">
        <!-- SECTION 1: ĐƠN ĐẶT CỌC GIỮ XE -->
        <section class="space-y-4">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-black font-heading text-slate-900 dark:text-white flex items-center gap-2">
              <i class="fa-solid fa-qrcode text-indigo-600 dark:text-indigo-400"></i>
              ĐƠN ĐẶT CỌC GIỮ XE
            </h2>
            <span
              id="customerDepositCount"
              class="text-xs font-bold px-3 py-1 rounded-full bg-indigo-600/10 text-indigo-600 dark:text-indigo-400">
              0 đơn
            </span>
          </div>
          <div id="customerDepositList" class="grid grid-cols-1 gap-4"></div>
        </section>

        <!-- SECTION 2: LỊCH HẸN LÁI THỬ & TƯ VẤN -->
        <section class="space-y-4">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-black font-heading text-slate-900 dark:text-white flex items-center gap-2">
              <i class="fa-solid fa-calendar-check text-emerald-500"></i>
              LỊCH HẸN LÁI THỬ & TƯ VẤN
            </h2>
            <span
              id="customerBookingCount"
              class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
              0 lịch hẹn
            </span>
          </div>
          <div id="customerBookingList" class="grid grid-cols-1 gap-4"></div>
        </section>
      </div>
    </main>

    <script>
      function showToast(message, type = "success") {
        const container = document.getElementById("toastContainer");
        if (!container) return;
        const toast = document.createElement("div");
        toast.className = `pointer-events-auto flex items-center gap-2.5 px-4 py-3 rounded-2xl shadow-2xl text-xs font-bold border backdrop-blur-xl ${
          type === "success"
            ? "bg-emerald-950/90 border-emerald-500/40 text-emerald-300"
            : "bg-rose-950/90 border-rose-500/40 text-rose-300"
        }`;
        toast.innerHTML = `<i class="fa-solid ${type === "success" ? "fa-circle-check text-emerald-400" : "fa-triangle-exclamation text-rose-400"}"></i><span>${escapeHtml(message)}</span>`;
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 3200);
      }

      function formatCurrency(num) {
        const val = Number(num) || 0;
        if (val <= 0) return "Theo thỏa thuận";
        return Math.round(val).toLocaleString("vi-VN") + " VNĐ";
      }

      // Tạo thanh tiến độ 3 bước cho Đơn Đặt Cọc
      function renderDepositProgress(status) {
        if (status === "cancelled") {
          return `
            <div class="mt-4 p-3 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-600 dark:text-rose-400 text-xs font-bold flex items-center gap-2">
              <i class="fa-solid fa-circle-xmark text-base"></i>
              <span>Đơn đặt cọc này đã bị hủy. Vui lòng liên hệ Hotline 0765.650.114 nếu cần hỗ trợ hoàn/đổi.</span>
            </div>
          `;
        }

        const isVerified = status === "verified";
        return `
          <div class="mt-4 pt-4 border-t border-gray-200 dark:border-white/10">
            <div class="grid grid-cols-3 gap-2 text-center text-[11px]">
              <!-- Bước 1 -->
              <div class="flex flex-col items-center gap-1.5">
                <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shadow">
                  <i class="fa-solid fa-check text-xs"></i>
                </div>
                <span class="font-bold text-slate-800 dark:text-white">1. Đã gửi yêu cầu</span>
                <span class="text-[10px] text-gray-400">Hệ thống đã ghi nhận</span>
              </div>

              <!-- Bước 2 -->
              <div class="flex flex-col items-center gap-1.5">
                <div class="w-7 h-7 rounded-full ${isVerified ? "bg-emerald-500 text-white" : "bg-amber-500 text-white animate-pulse"} flex items-center justify-center font-bold shadow">
                  <i class="fa-solid ${isVerified ? "fa-check" : "fa-hourglass-half"} text-xs"></i>
                </div>
                <span class="font-bold ${isVerified ? "text-slate-800 dark:text-white" : "text-amber-500"}">2. Kế toán đối soát</span>
                <span class="text-[10px] text-gray-400">${isVerified ? "Đã khớp giao dịch" : "Đang kiểm tra CK"}</span>
              </div>

              <!-- Bước 3 -->
              <div class="flex flex-col items-center gap-1.5">
                <div class="w-7 h-7 rounded-full ${isVerified ? "bg-indigo-600 text-white shadow-lg shadow-indigo-600/40" : "bg-gray-200 dark:bg-slate-800 text-gray-400"} flex items-center justify-center font-bold">
                  <i class="fa-solid fa-car-side text-xs"></i>
                </div>
                <span class="font-bold ${isVerified ? "text-indigo-600 dark:text-indigo-400" : "text-gray-400"}">3. Giữ xe & Bàn giao</span>
                <span class="text-[10px] text-gray-400">${isVerified ? "Xe đã khóa giữ cho bạn" : "Chờ xác nhận cọc"}</span>
              </div>
            </div>
          </div>
        `;
      }

      // Tạo thanh tiến độ 3 bước cho Lịch Lái Thử
      function renderBookingProgress(status) {
        if (status === "cancelled") {
          return `
            <div class="mt-4 p-3 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-600 dark:text-rose-400 text-xs font-bold flex items-center gap-2">
              <i class="fa-solid fa-circle-xmark text-base"></i>
              <span>Lịch hẹn này đã hủy. Bạn có thể đặt lại lịch mới bất cứ lúc nào!</span>
            </div>
          `;
        }

        const isConfirmed = status === "confirmed";
        return `
          <div class="mt-4 pt-4 border-t border-gray-200 dark:border-white/10">
            <div class="grid grid-cols-3 gap-2 text-center text-[11px]">
              <!-- Bước 1 -->
              <div class="flex flex-col items-center gap-1.5">
                <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shadow">
                  <i class="fa-solid fa-check text-xs"></i>
                </div>
                <span class="font-bold text-slate-800 dark:text-white">1. Đã đăng ký</span>
                <span class="text-[10px] text-gray-400">Tiếp nhận thông tin</span>
              </div>

              <!-- Bước 2 -->
              <div class="flex flex-col items-center gap-1.5">
                <div class="w-7 h-7 rounded-full ${isConfirmed ? "bg-emerald-500 text-white" : "bg-amber-500 text-white animate-pulse"} flex items-center justify-center font-bold shadow">
                  <i class="fa-solid ${isConfirmed ? "fa-check" : "fa-phone-volume"} text-xs"></i>
                </div>
                <span class="font-bold ${isConfirmed ? "text-slate-800 dark:text-white" : "text-amber-500"}">2. Chuyên viên xác nhận</span>
                <span class="text-[10px] text-gray-400">${isConfirmed ? "Đã chốt lịch hẹn" : "Chờ Admin duyệt"}</span>
              </div>

              <!-- Bước 3 -->
              <div class="flex flex-col items-center gap-1.5">
                <div class="w-7 h-7 rounded-full ${isConfirmed ? "bg-emerald-600 text-white shadow-lg shadow-emerald-600/40" : "bg-gray-200 dark:bg-slate-800 text-gray-400"} flex items-center justify-center font-bold">
                  <i class="fa-solid fa-key text-xs"></i>
                </div>
                <span class="font-bold ${isConfirmed ? "text-emerald-600 dark:text-emerald-400" : "text-gray-400"}">3. Sẵn sàng trải nghiệm</span>
                <span class="text-[10px] text-gray-400">${isConfirmed ? "Xe đã chuẩn bị sẵn" : "Chờ xác nhận"}</span>
              </div>
            </div>
          </div>
        `;
      }

      async function lookupOrdersByPhone(phone, silent = false) {
        const clean = String(phone || "").replace(/[^0-9]/g, "");
        if (clean.length < 8) {
          if (!silent) showToast("Vui lòng nhập số điện thoại hợp lệ!", "error");
          return;
        }

        try {
          const res = await fetch(`../php/get_customer_orders.php?phone=${encodeURIComponent(clean)}&t=${Date.now()}`, {
            cache: "no-store",
          });
          const data = await res.json();

          if (data.status !== "success") {
            if (!silent) showToast(data.message || "Không thể tra cứu dữ liệu!", "error");
            return;
          }

          localStorage.setItem("4tl_customer_phone", clean);
          document.getElementById("lookupPhoneInput").value = clean;
          document.getElementById("currentSearchedPhone").innerText = clean;
          document.getElementById("savedPhoneHint").classList.remove("hidden");

          const deposits = data.deposits || [];
          const bookings = data.bookings || [];

          document.getElementById("emptyStateBox").classList.add("hidden");
          document.getElementById("resultsContainer").classList.remove("hidden");

          // Render Đơn đặt cọc
          document.getElementById("customerDepositCount").innerText = `${deposits.length} đơn`;
          const depContainer = document.getElementById("customerDepositList");
          depContainer.innerHTML =
            deposits.length === 0
              ? `<div class="bg-white dark:bg-slate-900/60 p-6 rounded-2xl border border-gray-200 dark:border-white/10 text-xs text-gray-500 text-center">Không tìm thấy đơn đặt cọc nào gắn với SĐT này.</div>`
              : deposits
                  .map((d) => {
                    const badgeClass =
                      d.status === "verified"
                        ? "bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/30"
                        : d.status === "cancelled"
                          ? "bg-rose-500/15 text-rose-500 border-rose-500/30"
                          : "bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/30";
                    const statusLabel =
                      d.status === "verified"
                        ? "Đã xác nhận nhận cọc"
                        : d.status === "cancelled"
                          ? "Đã hủy đơn"
                          : "Đang chờ kế toán đối soát";

                    return `
                      <div class="bg-white dark:bg-slate-900/80 p-5 sm:p-6 rounded-3xl border border-gray-200 dark:border-white/10 shadow-lg">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                          <div>
                            <div class="flex items-center gap-2 text-xs text-gray-400 font-mono">
                              <span>Mã đơn: #COC-${Number(d.id)}</span>
                              <span>•</span>
                              <span>${escapeHtml(d.created_at || "")}</span>
                            </div>
                            <h3 class="text-lg font-black text-slate-900 dark:text-white mt-1">${escapeHtml(d.car_name)}</h3>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 space-x-3">
                              <span>Khách hàng: <strong class="text-slate-800 dark:text-gray-200">${escapeHtml(d.customer_name)}</strong></span>
                              <span>Nội dung CK: <strong class="font-mono text-amber-600 dark:text-yellow-400">${escapeHtml(d.memo)}</strong></span>
                            </div>
                          </div>
                          <div class="sm:text-right space-y-1.5">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border ${badgeClass}">
                              ${statusLabel}
                            </span>
                            <div class="text-sm font-black text-indigo-600 dark:text-indigo-400 font-heading">
                              Giá xe: ${formatCurrency(d.car_price)}
                            </div>
                          </div>
                        </div>
                        ${renderDepositProgress(d.status)}
                      </div>
                    `;
                  })
                  .join("");

          // Render Lịch lái thử
          document.getElementById("customerBookingCount").innerText = `${bookings.length} lịch hẹn`;
          const bookContainer = document.getElementById("customerBookingList");
          bookContainer.innerHTML =
            bookings.length === 0
              ? `<div class="bg-white dark:bg-slate-900/60 p-6 rounded-2xl border border-gray-200 dark:border-white/10 text-xs text-gray-500 text-center">Không tìm thấy lịch hẹn lái thử nào gắn với SĐT này.</div>`
              : bookings
                  .map((b) => {
                    const badgeClass =
                      b.status === "confirmed"
                        ? "bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/30"
                        : b.status === "cancelled"
                          ? "bg-rose-500/15 text-rose-500 border-rose-500/30"
                          : "bg-amber-500/15 text-amber-600 dark:text-amber-400 border-amber-500/30";
                    const statusLabel =
                      b.status === "confirmed"
                        ? "Admin đã duyệt & chốt lịch"
                        : b.status === "cancelled"
                          ? "Lịch hẹn đã hủy"
                          : "Đang chờ chuyên viên xác nhận";

                    return `
                      <div class="bg-white dark:bg-slate-900/80 p-5 sm:p-6 rounded-3xl border border-gray-200 dark:border-white/10 shadow-lg">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                          <div>
                            <div class="flex items-center gap-2 text-xs text-gray-400 font-mono">
                              <span>Mã lịch hẹn: #LT-${Number(b.id)}</span>
                              <span>•</span>
                              <span>Ngày hẹn: <strong class="text-slate-700 dark:text-gray-200">${escapeHtml(b.booking_date || "Linh hoạt")}</strong></span>
                            </div>
                            <h3 class="text-lg font-black text-slate-900 dark:text-white mt-1">${escapeHtml(b.car_name)}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                              Khách hàng: <strong class="text-slate-800 dark:text-gray-200">${escapeHtml(b.customer_name)}</strong>
                              ${b.note ? ` • Ghi chú: <span class="italic">${escapeHtml(b.note)}</span>` : ""}
                            </p>
                          </div>
                          <div class="sm:text-right">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border ${badgeClass}">
                              ${statusLabel}
                            </span>
                          </div>
                        </div>
                        ${renderBookingProgress(b.status)}
                      </div>
                    `;
                  })
                  .join("");

          if (!silent) {
            showToast(`Tìm thấy ${deposits.length} đơn cọc và ${bookings.length} lịch hẹn!`, "success");
          }
        } catch (err) {
          if (!silent) showToast("Lỗi kết nối máy chủ PHP!", "error");
        }
      }

      function handleLookupSubmit(e) {
        e.preventDefault();
        const phone = document.getElementById("lookupPhoneInput").value;
        lookupOrdersByPhone(phone, false);
      }

      function refreshCurrentLookup() {
        const phone = document.getElementById("lookupPhoneInput").value;
        if (phone) lookupOrdersByPhone(phone, false);
      }

      // Tự động điền SĐT nếu truyền qua URL (?phone=...) hoặc đã lưu trong localStorage
      window.addEventListener("DOMContentLoaded", () => {
        const params = new URLSearchParams(window.location.search);
        const urlPhone = params.get("phone");
        const savedPhone = localStorage.getItem("4tl_customer_phone");
        const targetPhone = urlPhone || savedPhone;

        if (targetPhone) {
          document.getElementById("lookupPhoneInput").value = targetPhone;
          lookupOrdersByPhone(targetPhone, true);
        }
      });
    </script>
  </body>
</html>
```

### file get_customer_orders.php: 
```php
<?php
require_once 'db.php';
header("Content-Type: application/json; charset=UTF-8");

// Nhận số điện thoại từ GET hoặc POST JSON
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$rawPhone = $_GET['phone'] ?? $input['phone'] ?? '';

// Chuẩn hóa SĐT: chỉ giữ lại chữ số để tránh lệch do dấu chấm/khoảng trắng (VD: 0909.123.456 -> 0909123456)
$cleanPhone = preg_replace('/[^0-9]/', '', trim($rawPhone));

if (strlen($cleanPhone) < 8) {
    echo json_encode([
        "status" => "error",
        "message" => "Vui lòng nhập số điện thoại hợp lệ (ít nhất 8 chữ số)!"
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!$pdo) {
    echo json_encode([
        "status" => "error",
        "message" => "Không thể kết nối cơ sở dữ liệu MySQL."
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    // 1. Lấy danh sách đơn đặt cọc theo SĐT (so sánh sau khi loại bỏ dấu chấm/khoảng trắng)
    $stmtDep = $pdo->prepare("
        SELECT id, car_name, car_price, memo, customer_name, customer_phone, status, created_at
        FROM deposits
        WHERE REPLACE(REPLACE(REPLACE(customer_phone, '.', ''), ' ', ''), '-', '') = ?
        ORDER BY id DESC
    ");
    $stmtDep->execute([$cleanPhone]);
    $deposits = $stmtDep->fetchAll();

    // 2. Lấy danh sách lịch lái thử / tư vấn theo SĐT
    $stmtBook = $pdo->prepare("
        SELECT id, customer_name, phone, car_name, booking_date, note, status, created_at
        FROM bookings
        WHERE REPLACE(REPLACE(REPLACE(phone, '.', ''), ' ', ''), '-', '') = ?
        ORDER BY id DESC
    ");
    $stmtBook->execute([$cleanPhone]);
    $bookings = $stmtBook->fetchAll();

    echo json_encode([
        "status" => "success",
        "phone" => $cleanPhone,
        "deposits" => $deposits,
        "bookings" => $bookings
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi truy vấn dữ liệu: " . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
```
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
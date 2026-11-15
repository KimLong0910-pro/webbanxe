// SHOWROOM 4TL - GLOBAL THEME & FONT CONTROLLER (theme.js)

// 1. Cấu hình Tailwind CSS dùng chung cho toàn bộ các trang HTML
if (typeof tailwind !== "undefined") {
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        colors: {
          brand: {
            50: "#eef2ff",
            100: "#e0e7ff",
            400: "#818cf8",
            500: "#6366f1",
            600: "#4f46e5",
            700: "#4338ca",
            800: "#3730a3",
            900: "#312e81",
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

// 5. Gắn sự kiện click cho nút #themeToggle sau khi DOM tải xong
document.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem("theme") || "dark";
  applyGlobalTheme(savedTheme);

  const themeToggle = document.getElementById("themeToggle");
  if (themeToggle) {
    themeToggle.onclick = toggleGlobalTheme;
  }
});

// 6. Tự động đồng bộ khi đổi Dark/Light ở một tab khác
window.addEventListener("storage", (e) => {
  if (e.key === "theme" && e.newValue) {
    applyGlobalTheme(e.newValue);
  }
});
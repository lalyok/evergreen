# Проект: Вечнозелёный сервис

## Стек
- WordPress (кастомная тема, без Page Builder)
- PHP 8.x, CSS, Vanilla JS
- ACF для кастомных полей
- Инструменты: VS Code, Copilot, LocalWP

## Структура темы
/wp-content/themes/evergreen/
├── style.css          # Заголовок темы
├── functions.php      # Хуки, enqueue, регистрация
├── index.php
├── header.php
├── footer.php
├── page.php
├── parts/             # Переиспользуемые блоки
│   ├── hero.php
│   ├── services.php
│   └── ...
├── assets/
│   ├── css/
│   ├── js/
│   └── img/

## Страницы сайта
- [ ] Главная
- [ ] Услуги
- [ ] Портфолио
- [ ] О компании
- [ ] Контакты

## Блоки главной страницы

**PHP-шаблоны**
- [ ] `front-page.php` — основной шаблон главной страницы
- [ ] `header.php` — header (логотип, меню, кнопка «связаться»)
- [ ] `footer.php` — footer (3 колонки контактов и меню)
- [ ] `functions.php` — подключение стилей/скриптов, регистрация меню, поддержка темы
- [ ] `parts/hero.php` — Hero section (фон, заголовок, CTA)
- [ ] `parts/services.php` — Блок услуг (слайдер из 3 карточек)
- [ ] `parts/why-us.php` — Блок «Почему выбирают нас» (текст 7 колонок + изображение 5 колонок)
- [ ] `parts/how-we-work.php` — Блок «Как мы работаем» (нумерованный список + фон)
- [ ] `parts/partners.php` — Блок клиентов/логотипы (ряд на всю ширину)
- [ ] `parts/before-after.php` — Блок «До/после» (слайдер двух фото)
- [ ] `parts/testimonials.php` — Отзывы (слайдер, фон и текстовый блок)
- [ ] `parts/contact-form.php` — Форма обратной связи (9 колонок + фоновое изображение)

**CSS-файлы (в `assets/css/`)**
- [ ] `assets/css/style.css` — главный файл (импорт остальных)
- [ ] `assets/css/layout.css` — 12-колоночная сетка, контейнеры, отступы
- [ ] `assets/css/header.css` — стили навигации и кнопки
- [ ] `assets/css/hero.css` — Hero section (фон, типографика, CTA)
- [ ] `assets/css/services.css` — карточки услуг и стиль слайдера
- [ ] `assets/css/why-us.css` — текстовый блок и изображение (7/5 колонок)
- [ ] `assets/css/how-we-work.css` — нумерованный список с кастомными цифрами и фон
- [ ] `assets/css/partners.css` — ряд логотипов (растяжение на всю ширину)
- [ ] `assets/css/before-after.css` — стили слайдера до/после
- [ ] `assets/css/testimonials.css` — отзывный слайдер и наложение текста на фон
- [ ] `assets/css/form.css` — поля формы, чекбокс, валидация, расположение 9 колонок
- [ ] `assets/css/footer.css` — три равные колонки, контакты
- [ ] `assets/css/components.css` — кнопки, карточки, утилиты
- [ ] `assets/css/slider.css` — общие стили для слайдеров (пагинация/стрелки)
- [ ] `assets/css/responsive.css` — медиазапросы и адаптация сетки

## Текущая задача

## Дизайн-решения (принятые)
- Цветовая палитра:
{
  "WHITE": "rgb(251, 251, 251)", <!-- background -->
  "CREMMY": "rgb(252, 237, 172)", <!-- secondary -->
  "SUPER_PALE_GREEN": "rgb(231, 255, 200)", <!-- secondary -->
  "PALE_GREEN": "rgb(184, 214, 145)", <!-- secondary -->
  "GRASS_GREEN": "rgb(104, 137, 44)", <!-- title-text -->
  "PINK": "rgb(234, 76, 126)", <!-- accent -->
  "TRANSPARENT_GREEN_GRASS": "rgba(104, 137, 44, 0.7)",
  "WHITE_70": "rgba(251, 251, 251, 0.7)",
  "PALE_GREEN_70": "rgba(231, 255, 200, 0.7)",
  "TXT_SUPER_PALE_GREEN": "rgb(231, 255, 200)",
  "TXT_DARK_GREEN_TXT": "rgb(42, 60, 11)",
  "DARK_PINK": "rgb(216, 28, 88)"
}
- Шрифты: Montserrat. Заголовки: Bold, Semibold, Medium. Тело: Medium, Regular
- Layout grid: desktop 12 columns (74px), gap 30px  
- Брейкпоинт мобильного: 768px
- Единица отступов: кратно 8px

## Зависимости и условия
- ACF поля для услуг: service_title, service_text, service_icon
- Поддержка браузеров: последние 2 версии + Safari 15+
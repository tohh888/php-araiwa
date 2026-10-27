
<?php
require_once 'config.php';

// ป้องกันกรณีตัวแปรบางตัวไม่มีค่า
$daysLate = $daysLate ?? 0;
$fine = $fine ?? 0;
$usedPercent = $usedPercent ?? 0;
$isOpen = $isOpen ?? false;
$isLate = $isLate ?? false;

$percent = max(0, min(100, (float) $usedPercent));
$alert = $percent >= ALERT_PERCENT;
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars(APP_NAME) ?></title>

<style>
:root {
    --bg: #f4f7fb;
    --surface: #ffffff;
    --text: #1d2b40;
    --muted: #728198;
    --border: #e3e9f1;
    --primary: #4788f5;
    --primary-soft: #eaf2ff;
    --sidebar: #17263d;
    --sidebar-text: #d5dfed;
    --green: #1eaa78;
    --orange: #e8a13a;
    --red: #e45c65;
    --shadow: 0 3px 14px rgba(28, 48, 78, .045);
}

body[data-theme="green"] {
    --primary: #21865b;
    --primary-soft: #e5f5eb;
}

body[data-theme="purple"] {
    --primary: #7957c8;
    --primary-soft: #f0eafe;
}

body[data-theme="dark"] {
    --bg: #111b2a;
    --surface: #1d2a3d;
    --text: #edf3fb;
    --muted: #a5b3c7;
    --border: #334156;
    --primary: #75aaff;
    --primary-soft: #293d5a;
    --sidebar: #0b1422;
    --sidebar-text: #d5dfed;
    --shadow: none;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Tahoma, "Segoe UI", sans-serif;
    font-size: 14px;
    color: var(--text);
    background: var(--bg);
}

button, input {
    font: inherit;
}

button, a {
    -webkit-tap-highlight-color: transparent;
}

.app {
    display: flex;
    min-height: 100vh;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    flex-shrink: 0;
    background: var(--sidebar);
    color: var(--sidebar-text);
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 8px 24px;
    border-bottom: 1px solid #34445b;
    margin-bottom: 20px;
}

.brand-icon {
    width: 43px;
    height: 43px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    background: var(--primary);
    color: white;
    border-radius: 12px;
    font-size: 23px;
}

.brand-name {
    font-size: 19px;
    font-weight: bold;
    color: #fff;
}

.brand-sub {
    font-size: 11px;
    color: #b9c7d9;
    margin-top: 5px;
}

.menu-label {
    color: #9bacc3;
    font-size: 11px;
    font-weight: bold;
    letter-spacing: .7px;
    padding: 0 12px;
    margin: 16px 0 10px;
}

.menu {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.menu a {
    min-height: 44px;
    padding: 11px 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--sidebar-text);
    text-decoration: none;
    border-radius: 9px;
    font-size: 13px;
    line-height: 1.5;
    transition: background .2s;
}

.menu a:hover {
    background: #283b55;
    color: white;
}

.menu a.active {
    background: #304a6c;
    color: #fff;
    font-weight: bold;
    box-shadow: inset 3px 0 #75aaff;
}

.menu-icon {
    width: 22px;
    flex-shrink: 0;
    text-align: center;
    font-size: 18px;
}

.menu a.disabled {
    color: #b5c3d6;
    cursor: default;
}

.menu a.disabled:hover {
    background: transparent;
}

.coming {
    margin-left: auto;
    color: #c3d0e1;
    font-size: 9px;
    white-space: nowrap;
}

.sidebar-bottom {
    margin-top: auto;
    padding: 20px 8px 0;
    border-top: 1px solid #34445b;
    color: #b9c7d9;
    font-size: 11px;
    line-height: 1.9;
}

/* MAIN */
.main {
    flex: 1;
    min-width: 0;
    padding: 28px 32px;
}

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
    margin-bottom: 28px;
}

.page-title {
    font-size: 25px;
    margin: 0 0 8px;
    font-weight: bold;
    letter-spacing: -.4px;
}

.page-subtitle {
    margin: 0;
    color: var(--muted);
    font-size: 13px;
}

.top-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.theme-picker {
    display: flex;
    align-items: center;
    gap: 10px;
}

.theme-label {
    font-size: 12px;
    color: var(--muted);
}

.theme-btn {
    width: 27px;
    height: 27px;
    border: 2px solid transparent;
    outline: 2px solid transparent;
    outline-offset: 2px;
    border-radius: 50%;
    cursor: pointer;
}

.theme-btn.active {
    outline-color: var(--primary);
}

.theme-btn:focus-visible {
    outline: 2px solid var(--text);
    outline-offset: 4px;
}

.section-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin: 26px 0 15px;
}

.section-heading h2 {
    font-size: 17px;
    margin: 0;
}

.section-heading p {
    margin: 5px 0 0;
    font-size: 12px;
    color: var(--muted);
}

/* KPI CARDS */
.stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 17px;
}

.card {
    min-width: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 13px;
    padding: 21px;
    box-shadow: var(--shadow);
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-bottom: 19px;
}

.card-label {
    color: var(--muted);
    font-size: 12px;
    line-height: 1.6;
}

.card-icon {
    width: 40px;
    height: 40px;
    display: grid;
    place-items: center;
    flex-shrink: 0;
    background: var(--primary-soft);
    color: var(--primary);
    border-radius: 11px;
    font-size: 20px;
}

.card-number {
    font-size: 32px;
    font-weight: bold;
    letter-spacing: -.5px;
    line-height: 1.2;
}

.card-foot {
    margin-top: 11px;
    font-size: 11px;
    color: var(--muted);
    line-height: 1.6;
}

.card-foot strong {
    color: var(--primary);
}

/* PANELS */
.content-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.5fr) minmax(280px, 1fr);
    gap: 18px;
}

.panel {
    min-width: 0;
    padding: 23px;
    border: 1px solid var(--border);
    border-radius: 13px;
    background: var(--surface);
    box-shadow: var(--shadow);
}

.panel-heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 23px;
}

.panel-heading h3 {
    margin: 0;
    font-size: 15px;
}

.panel-heading p {
    color: var(--muted);
    font-size: 12px;
    margin: 7px 0 0;
    line-height: 1.6;
}

/* PROGRESS */
.progress-labels {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    font-size: 12px;
    margin-bottom: 11px;
}

.progress-labels span {
    color: var(--muted);
}

.progress {
    width: 100%;
    height: 10px;
    overflow: hidden;
    background: var(--bg);
    border-radius: 20px;
}

.progress-fill {
    height: 100%;
    background: var(--primary);
    border-radius: 20px;
}

.legend {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-top: 17px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    color: var(--muted);
}

.dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: var(--primary);
}

.dot.gray {
    background: #b9c5d4;
}

.notice {
    margin-top: 24px;
    padding: 14px;
    border-radius: 10px;
    background: var(--primary-soft);
    font-size: 12px;
    line-height: 1.8;
    color: var(--text);
}

.notice strong {
    display: block;
    margin-bottom: 4px;
}

/* RECENT LOAN */
.loan-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px 18px;
}

.loan-item {
    min-width: 0;
    padding-bottom: 13px;
    border-bottom: 1px solid var(--border);
}

.loan-label {
    display: block;
    font-size: 11px;
    color: var(--muted);
    margin-bottom: 8px;
}

.loan-value {
    font-size: 13px;
    font-weight: bold;
    overflow-wrap: anywhere;
    line-height: 1.6;
}

.badge {
    display: inline-block;
    border-radius: 20px;
    padding: 5px 10px;
    font-size: 11px;
    font-weight: normal;
    background: var(--primary-soft);
    color: var(--primary);
}

.badge.success {
    background: #e4f6ec;
    color: #218452;
}

.badge.warning {
    background: #fff0d7;
    color: #9b680c;
}

.badge.danger {
    background: #fde9e9;
    color: #b83745;
}

/* SUMMARY ROWS */
.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    padding: 15px 0;
    border-bottom: 1px solid var(--border);
    font-size: 12px;
}

.summary-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.summary-row span {
    color: var(--muted);
}

.summary-row strong {
    text-align: right;
}

.footer {
    text-align: center;
    color: var(--muted);
    font-size: 11px;
    padding: 27px 0 5px;
}

/* TABLET */
@media (max-width: 1100px) {
    .sidebar {
        width: 225px;
    }

    .main {
        padding: 22px;
    }

    .stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .content-grid {
        grid-template-columns: 1fr;
    }
}

/* MOBILE */
@media (max-width: 650px) {
    .app {
        display: block;
    }

    .sidebar {
        width: 100%;
        padding: 14px;
    }

    .brand {
        padding-bottom: 15px;
        margin-bottom: 8px;
    }

    .menu-label,
    .sidebar-bottom {
        display: none;
    }

    .menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 4px;
    }

    .menu a {
        padding: 10px 8px;
        font-size: 12px;
        min-height: 42px;
    }

    .coming {
        display: none;
    }

    .main {
        padding: 19px 13px;
    }

    .page-title {
        font-size: 22px;
    }

    .card {
        padding: 15px;
    }

    .card-number {
        font-size: 27px;
    }

    .card-icon {
        width: 33px;
        height: 33px;
    }

    .card-label {
        font-size: 11px;
    }

    .panel {
        padding: 17px;
    }
}

@media (max-width: 380px) {
    .stats {
        grid-template-columns: 1fr;
    }

    .loan-grid {
        grid-template-columns: 1fr;
    }
}
</style>
</head>

<body data-theme="blue">
<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">⚽</div>
            <div>
                <div class="brand-name">SportStock</div>
                <div class="brand-sub">ระบบจัดการอุปกรณ์กีฬา</div>
            </div>
        </div>

        <div class="menu-label">WORKSPACE</div>

        <nav class="menu">
            <a href="index.php" class="active">
                <span class="menu-icon">▦</span>
                Dashboard
            </a>

            <a href="#" class="disabled" aria-disabled="true">
                <span class="menu-icon">▣</span>
                รายการอุปกรณ์
                <span class="coming">เร็ว ๆ นี้</span>
            </a>

            <a href="#" class="disabled" aria-disabled="true">
                <span class="menu-icon">⇄</span>
                ยืม–คืนอุปกรณ์
                <span class="coming">เร็ว ๆ นี้</span>
            </a>

            <a href="#" class="disabled" aria-disabled="true">
                <span class="menu-icon">◷</span>
                ประวัติการยืม
                <span class="coming">เร็ว ๆ นี้</span>
            </a>

            <a href="#" class="disabled" aria-disabled="true">
                <span class="menu-icon">♙</span>
                ข้อมูลสมาชิก
                <span class="coming">เร็ว ๆ นี้</span>
            </a>

            <a href="#" class="disabled" aria-disabled="true">
                <span class="menu-icon">▤</span>
                รายงาน
                <span class="coming">เร็ว ๆ นี้</span>
            </a>
        </nav>

        <div class="menu-label">SYSTEM</div>

        <nav class="menu">
            <a href="#" class="disabled" aria-disabled="true">
                <span class="menu-icon">⚙</span>
                ตั้งค่าระบบ
                <span class="coming">เร็ว ๆ นี้</span>
            </a>

            <a href="#" class="disabled" aria-disabled="true">
                <span class="menu-icon">?</span>
                วิธีใช้งาน
                <span class="coming">เร็ว ๆ นี้</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <?= htmlspecialchars(APP_NAME) ?><br>
            SportStock · Version 1.0
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <header class="topbar">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">
                    <?= htmlspecialchars(APP_NAME) ?>
                </p>
            </div>

            <div class="top-actions">
                <div class="theme-picker">
                    <span class="theme-label">เปลี่ยนธีม</span>

                    <button type="button" class="theme-btn active"
                        style="background:#4788f5"
                        data-choice="blue" title="ธีมสีฟ้า"
                        aria-label="ธีมสีฟ้า"></button>

                    <button type="button" class="theme-btn"
                        style="background:#21865b"
                        data-choice="green" title="ธีมสีเขียว"
                        aria-label="ธีมสีเขียว"></button>

                    <button type="button" class="theme-btn"
                        style="background:#7957c8"
                        data-choice="purple" title="ธีมสีม่วง"
                        aria-label="ธีมสีม่วง"></button>

                    <button type="button" class="theme-btn"
                        style="background:#17263d"
                        data-choice="dark" title="โหมดมืด"
                        aria-label="โหมดมืด"></button>
                </div>
            </div>
        </header>

        <!-- KPI -->
        <div class="section-heading">
            <div>
                <h2>ภาพรวมระบบ</h2>
                <p>สรุปจำนวนอุปกรณ์และสถานะการยืม</p>
            </div>
        </div>

        <section class="stats">

            <div class="card">
                <div class="card-top">
                    <span class="card-label">อุปกรณ์ทั้งหมด</span>
                    <div class="card-icon">▣</div>
                </div>
                <div class="card-number"><?= $totalItems ?></div>
                <div class="card-foot">จำนวนอุปกรณ์ในระบบ · ชิ้น</div>
            </div>

            <div class="card">
                <div class="card-top">
                    <span class="card-label">อุปกรณ์ที่ถูกยืม</span>
                    <div class="card-icon">⇄</div>
                </div>
                <div class="card-number"><?= $borrowed ?></div>
                <div class="card-foot">
                    <?= number_format($percent, 1) ?>% ของอุปกรณ์ทั้งหมด
                </div>
            </div>

            <div class="card">
                <div class="card-top">
                    <span class="card-label">พร้อมให้ยืม</span>
                    <div class="card-icon">✓</div>
                </div>
                <div class="card-number"><?= $available ?></div>
                <div class="card-foot">อุปกรณ์ที่ยังเหลือ · ชิ้น</div>
            </div>

            <div class="card">
                <div class="card-top">
                    <span class="card-label">รายการยืมล่าสุด</span>
                    <div class="card-icon">◷</div>
                </div>
                <div class="card-number">
                    <?= $isLate ? $daysLate : 0 ?>
                </div>
                <div class="card-foot">
                    <?= $isLate ? 'วันเกินกำหนด' : 'วันเกินกำหนด · ยังไม่มี' ?>
                </div>
            </div>

        </section>

        <!-- CHART + SYSTEM STATUS -->
        <div class="section-heading">
            <div>
                <h2>การวิเคราะห์อุปกรณ์</h2>
                <p>สัดส่วนการยืมและสถานะปัจจุบัน</p>
            </div>
        </div>

        <section class="content-grid">

            <div class="panel">
                <div class="panel-heading">
                    <div>
                        <h3>สัดส่วนการยืมอุปกรณ์</h3>
                        <p>เปรียบเทียบจำนวนที่ถูกยืมกับจำนวนที่พร้อมให้ยืม</p>
                    </div>
                    <span class="badge">
                        <?= number_format($percent, 1) ?>%
                    </span>
                </div>

                <div class="progress-labels">
                    <span>ถูกยืมไปแล้ว</span>
                    <strong><?= $borrowed ?> ชิ้น</strong>
                </div>

                <div class="progress">
                    <div class="progress-fill"
                        style="width:<?= $percent ?>%">
                    </div>
                </div>

                <div class="legend">
                    <div class="legend-item">
                        <span class="dot"></span>
                        ถูกยืม <?= $borrowed ?> ชิ้น
                    </div>
                    <div class="legend-item">
                        <span class="dot gray"></span>
                        พร้อมให้ยืม <?= $available ?> ชิ้น
                    </div>
                </div>

                <div class="notice">
                    <strong>
                        <?= $alert ? 'ควรตรวจสอบจำนวนอุปกรณ์' : 'สถานะการยืม' ?>
                    </strong>
                    <?php if ($alert): ?>
                        มีอุปกรณ์ถูกยืมถึงเกณฑ์แจ้งเตือน
                        (<?= ALERT_PERCENT ?>%)
                    <?php else: ?>
                        จำนวนอุปกรณ์ที่ถูกยืมยังไม่ถึงเกณฑ์แจ้งเตือน
                    <?php endif; ?>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <div>
                        <h3>สถานะระบบ</h3>
                        <p>ข้อมูลการให้ยืมปัจจุบัน</p>
                    </div>
                    <span class="badge <?= $isOpen ? 'success' : 'danger' ?>">
                        <?= $isOpen ? 'เปิดให้ยืม' : 'ปิดให้ยืม' ?>
                    </span>
                </div>

                <div class="summary-row">
                    <span>ระยะเวลายืมสูงสุด</span>
                    <strong><?= LOAN_DAYS ?> วัน</strong>
                </div>

                <div class="summary-row">
                    <span>ค่าปรับต่อชิ้นต่อวัน</span>
                    <strong><?= number_format(FINE_PER_DAY, 2) ?> บาท</strong>
                </div>

                <div class="summary-row">
                    <span>เกณฑ์แจ้งเตือน</span>
                    <strong><?= ALERT_PERCENT ?>%</strong>
                </div>

                <div class="summary-row">
                    <span>สถานะกำหนดคืนล่าสุด</span>
                    <strong>
                        <?php if ($isLate): ?>
                            <span class="badge danger">เกินกำหนด</span>
                        <?php else: ?>
                            <span class="badge success">ไม่เกินกำหนด</span>
                        <?php endif; ?>
                    </strong>
                </div>
            </div>

        </section>

        <!-- RECENT LOAN -->
        <div class="section-heading">
            <div>
                <h2>ข้อมูลการยืมล่าสุด</h2>
                <p>รายละเอียดรายการตัวอย่างจาก config.php</p>
            </div>
        </div>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h3><?= htmlspecialchars($itemName) ?></h3>
                    <p>ข้อมูลผู้ยืมและกำหนดคืน</p>
                </div>
                <span class="badge <?= $isLate ? 'danger' : 'success' ?>">
                    <?= $isLate ? 'เกินกำหนด' : 'ไม่เกินกำหนด' ?>
                </span>
            </div>

            <div class="loan-grid">
                <div class="loan-item">
                    <span class="loan-label">ชื่อผู้ยืม</span>
                    <span class="loan-value">
                        <?= htmlspecialchars($borrower) ?>
                    </span>
                </div>

                <div class="loan-item">
                    <span class="loan-label">ชื่ออุปกรณ์</span>
                    <span class="loan-value">
                        <?= htmlspecialchars($itemName) ?>
                    </span>
                </div>

                <div class="loan-item">
                    <span class="loan-label">จำนวนที่ยืม</span>
                    <span class="loan-value"><?= $qty ?> ชิ้น</span>
                </div>

                <div class="loan-item">
                    <span class="loan-label">วันที่ยืม</span>
                    <span class="loan-value">
                        <?= htmlspecialchars($borrowDate) ?>
                    </span>
                </div>

                <div class="loan-item">
                    <span class="loan-label">วันที่กำหนดคืน</span>
                    <span class="loan-value">
                        <?= htmlspecialchars($dueDate) ?>
                    </span>
                </div>

                <div class="loan-item">
                    <span class="loan-label">ค่าปรับปัจจุบัน</span>
                    <span class="loan-value">
                        <?= number_format($fine, 2) ?> บาท
                    </span>
                </div>
            </div>
        </section>

        <footer class="footer">
            <?= htmlspecialchars(APP_NAME) ?> · SportStock
        </footer>

    </main>
</div>

<script>
// เปลี่ยนธีมสี
const themeButtons = document.querySelectorAll('.theme-btn');
const themes = ['blue', 'green', 'purple', 'dark'];

function setTheme(theme) {
    if (!themes.includes(theme)) return;

    document.body.dataset.theme = theme;

    themeButtons.forEach(button => {
        button.classList.toggle(
            'active',
            button.dataset.choice === theme
        );
    });

    try {
        localStorage.setItem('sportstock-theme', theme);
    } catch (error) {
        // หากบันทึกไม่ได้ ยังคงเปลี่ยนธีมได้
    }
}

themeButtons.forEach(button => {
    button.addEventListener('click', () => {
        setTheme(button.dataset.choice);
    });
});

// โหลดธีมที่เคยเลือก
try {
    const savedTheme = localStorage.getItem('sportstock-theme');

    if (themes.includes(savedTheme)) {
        setTheme(savedTheme);
    }
} catch (error) {
    // ใช้ธีมสีฟ้าเริ่มต้น
}
</script>

</body>
</html>

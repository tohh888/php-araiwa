<<<<<<< HEAD
<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Locker - Rich & Interactive Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,300;0,400;0,500;0,700;0,900;1,700&display=swap" rel="stylesheet">
    <style>
        /* ==================================================== */
        /* 🎨 THEME PRESETS (เน้นอ่านง่าย สบายตา) */
        /* ==================================================== */

        /* 1. 🕶️ Noir Sleek Dark - DEFAULT */
        body, body[data-theme="noir"] {
            --bg-paper: #0f1117;
            --ink: #f1f5f9;
            --text-muted: #94a3b8;
            --card-bg: #181b24;
            --card-border: #282d3c;
            --accent-red: #f43f5e;
            --accent-yellow: #fbbf24;
            --accent-blue: #38bdf8;
            --accent-green: #34d399;
            --shadow-color: #050608;
            --tag-bg: #222736;
            --tag-active-bg: #38bdf8;
            --tag-active-text: #0f1117;
            --bar-bg: #282d3c;
        }

        /* 2. 📜 Vintage Paper */
        body[data-theme="vintage"] {
            --bg-paper: #f6f3eb;
            --ink: #27272a;
            --text-muted: #71717a;
            --card-bg: #ffffff;
            --card-border: #27272a;
            --accent-red: #e11d48;
            --accent-yellow: #d97706;
            --accent-blue: #0284c7;
            --accent-green: #059669;
            --shadow-color: #27272a;
            --tag-bg: #eae6dd;
            --tag-active-bg: #d97706;
            --tag-active-text: #ffffff;
            --bar-bg: #eae6dd;
        }

        /* 3. ⚡ Cyber Midnight */
        body[data-theme="cyber"] {
            --bg-paper: #0a0e17;
            --ink: #e2e8f0;
            --text-muted: #64748b;
            --card-bg: #131b2e;
            --card-border: #1e293b;
            --accent-red: #ff2a5f;
            --accent-yellow: #facc15;
            --accent-blue: #00f0ff;
            --accent-green: #00ffaa;
            --shadow-color: #020408;
            --tag-bg: #1a243a;
            --tag-active-bg: #00f0ff;
            --tag-active-text: #0a0e17;
            --bar-bg: #1e293b;
        }

        /* 4. 🎨 Soft Charcoal */
        body[data-theme="charcoal"] {
            --bg-paper: #1c1c21;
            --ink: #ececee;
            --text-muted: #8e8e93;
            --card-bg: #25252b;
            --card-border: #383842;
            --accent-red: #ff453a;
            --accent-yellow: #ffd60a;
            --accent-blue: #64d2ff;
            --accent-green: #30d158;
            --shadow-color: #121215;
            --tag-bg: #303038;
            --tag-active-bg: #ffd60a;
            --tag-active-text: #1c1c21;
            --bar-bg: #383842;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            user-select: none;
        }

        body {
            font-family: 'Kanit', sans-serif;
            background-color: var(--bg-paper);
            color: var(--ink);
            padding: 24px 16px;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        .dashboard-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* Top Utility Bar */
        .top-utility-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .status-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .live-status {
            background: var(--card-bg);
            border: 2px solid var(--card-border);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 2px 2px 0px var(--shadow-color);
        }

        .achievement-badge {
            background: var(--card-bg);
            border: 2px solid var(--accent-yellow);
            color: var(--accent-yellow);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 2px 2px 0px var(--shadow-color);
            transition: transform 0.15s ease;
        }

        .achievement-badge:hover {
            transform: scale(1.05) rotate(-2deg);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: var(--accent-green);
            border-radius: 50%;
            animation: pulseDot 1.5s infinite alternate;
        }

        @keyframes pulseDot {
            0% { opacity: 0.4; }
            100% { opacity: 1; }
        }

        /* Theme Switcher */
        .theme-switcher {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--card-bg);
            border: 2px solid var(--card-border);
            padding: 4px;
            border-radius: 30px;
            box-shadow: 3px 3px 0px var(--shadow-color);
            flex-wrap: wrap;
        }

        .theme-label {
            font-size: 11px;
            font-weight: 700;
            padding: 0 8px;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .theme-btn {
            font-family: 'Kanit', sans-serif;
            font-size: 12px;
            font-weight: 500;
            background: transparent;
            color: var(--ink);
            border: none;
            padding: 5px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .theme-btn.active {
            background: var(--ink);
            color: var(--bg-paper);
            font-weight: 700;
        }

        .sound-toggle-btn {
            font-family: 'Kanit', sans-serif;
            font-size: 12px;
            font-weight: 700;
            background: var(--card-bg);
            color: var(--ink);
            border: 2px solid var(--card-border);
            padding: 6px 14px;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 2px 2px 0px var(--shadow-color);
        }

        /* Header Bar */
        .brand-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--card-border);
            padding-bottom: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
            position: relative;
        }

        .brand-title {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
            text-transform: uppercase;
        }

        /* Quick Action Buttons */
        .action-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-action {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            font-weight: 700;
            padding: 10px 16px;
            border: 2px solid var(--card-border);
            box-shadow: 3px 3px 0px var(--shadow-color);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 8px;
            transition: transform 0.12s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.12s ease;
            background: var(--card-bg);
            color: var(--ink);
        }

        .btn-action:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 5px 5px 0px var(--shadow-color);
        }

        .btn-action:active {
            transform: translateY(2px) scale(0.96);
            box-shadow: 1px 1px 0px var(--shadow-color);
        }

        .btn-borrow { border-color: var(--accent-green); color: var(--accent-green); }
        .btn-return { border-color: var(--accent-blue); color: var(--accent-blue); }
        .btn-scan { border-color: var(--accent-yellow); color: var(--accent-yellow); }

        /* Alert Banner */
        .alert-tape {
            background: var(--card-bg);
            border: 2px solid var(--accent-red);
            border-left: 6px solid var(--accent-red);
            box-shadow: 3px 3px 0px var(--shadow-color);
            padding: 14px 18px;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.12s ease;
        }

        .alert-tape:hover {
            transform: scale(1.008);
        }

        .alert-tag {
            background: var(--accent-red);
            color: #ffffff;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 800;
            border-radius: 4px;
            text-transform: uppercase;
        }

        /* 4 Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 2px solid var(--card-border);
            box-shadow: 3px 3px 0px var(--shadow-color);
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.12s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 6px 6px 0px var(--shadow-color);
        }

        .stat-card:active {
            transform: translateY(2px) scale(0.97);
            box-shadow: 1px 1px 0px var(--shadow-color);
        }

        .stat-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .stat-number {
            font-size: clamp(22px, 3.2vw, 36px);
            font-weight: 800;
            line-height: 1.2;
            margin-top: 10px;
            word-break: break-all;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .num-green { color: var(--accent-green); }
        .num-yellow { color: var(--accent-yellow); }
        .num-red { color: var(--accent-red); }
        .num-blue { color: var(--accent-blue); }

        /* ==================================================== */
        /* 2-COLUMN MAIN LAYOUT (แก้ปัญหาหน้าเว็บดูโล้น) */
        /* ==================================================== */
        .main-dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
        }

        /* Content Boxes */
        .content-box {
            background: var(--card-bg);
            border: 2px solid var(--card-border);
            box-shadow: 4px 4px 0px var(--shadow-color);
            padding: 20px;
            margin-bottom: 24px;
            border-radius: 10px;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--card-border);
            padding-bottom: 10px;
        }

        /* Search & Filter Bar */
        .search-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .search-input {
            width: 100%;
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            font-weight: 400;
            padding: 12px 16px;
            border: 2px solid var(--card-border);
            box-shadow: 2px 2px 0px var(--shadow-color);
            background: var(--bg-paper);
            color: var(--ink);
            outline: none;
            border-radius: 6px;
        }

        .search-input:focus {
            border-color: var(--accent-blue);
        }

        .filter-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .tag-btn {
            font-family: 'Kanit', sans-serif;
            font-size: 12px;
            font-weight: 500;
            padding: 6px 14px;
            border: 2px solid var(--card-border);
            background: var(--tag-bg);
            color: var(--ink);
            box-shadow: 2px 2px 0px var(--shadow-color);
            cursor: pointer;
            border-radius: 6px;
            transition: all 0.12s ease;
        }

        .tag-btn:hover {
            transform: translateY(-2px);
        }

        .tag-btn.active {
            background: var(--tag-active-bg);
            color: var(--tag-active-text);
            border-color: var(--tag-active-bg);
            font-weight: 700;
        }

        /* Ticket Stub - Recent Transaction */
        .ticket-stub {
            border: 2px solid var(--card-border);
            background: var(--bg-paper);
            display: grid;
            grid-template-columns: 2fr 1fr;
            position: relative;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.12s ease;
        }

        .ticket-stub:hover {
            transform: scale(1.01);
        }

        .ticket-stub::before {
            content: '';
            position: absolute;
            top: 0; bottom: 0;
            left: 66.66%;
            border-left: 2px dashed var(--card-border);
        }

        .ticket-main {
            padding: 16px 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .ticket-student {
            font-size: 16px;
            font-weight: 700;
        }

        .ticket-item {
            font-size: 14px;
            color: var(--text-muted);
        }

        .ticket-side {
            padding: 16px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
        }

        .status-stamp {
            background: var(--accent-green);
            color: #0f1117;
            border: 1px solid var(--card-border);
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 4px;
            box-shadow: 2px 2px 0px var(--shadow-color);
            margin-bottom: 4px;
        }

        .time-stamp {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ---------------------------------------------------- */
        /* 🆕 NEW COMPONENT 1: STOCK PROGRESS TRACKER (สถิติคลัง) */
        /* ---------------------------------------------------- */
        .stock-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .stock-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .stock-header {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 500;
        }

        .stock-name { display: flex; align-items: center; gap: 6px; }

        .progress-bar-bg {
            height: 10px;
            background: var(--bar-bg);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--card-border);
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        /* ---------------------------------------------------- */
        /* 🆕 NEW COMPONENT 2: PEAK ACTIVITY CHART (กราฟความหนาแน่น) */
        /* ---------------------------------------------------- */
        .chart-bars {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 100px;
            padding-top: 15px;
            gap: 8px;
        }

        .chart-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            height: 100%;
            justify-content: flex-end;
        }

        .chart-bar-fill {
            width: 100%;
            background: var(--accent-blue);
            border-radius: 4px 4px 0 0;
            transition: height 0.4s ease;
        }

        .chart-bar-fill.peak {
            background: var(--accent-yellow);
        }

        .chart-label {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* ---------------------------------------------------- */
        /* 🐶🐱🐦 IN-THEME PETS */
        /* ---------------------------------------------------- */
        .pet-interactive {
            cursor: pointer;
            pointer-events: auto;
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            opacity: 0.85;
        }

        .pet-interactive:hover {
            transform: scale(1.18) rotate(4deg);
            opacity: 1;
        }

        .bg-cat-decoration {
            position: fixed;
            bottom: 12px;
            right: 20px;
            z-index: 3;
            display: flex;
            align-items: flex-end;
            gap: 6px;
        }

        .bg-dog-decoration {
            position: fixed;
            bottom: 10px;
            left: 16px;
            z-index: 3;
            display: flex;
            align-items: flex-end;
            gap: 4px;
        }

        .bg-bird-decoration {
            position: absolute;
            top: -22px;
            right: 180px;
            z-index: 3;
        }

        .speech-bubble-pop {
            position: fixed;
            background: var(--card-bg);
            color: var(--ink);
            border: 2px solid var(--card-border);
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 12px;
            box-shadow: 3px 3px 0px var(--shadow-color);
            pointer-events: none;
            z-index: 999;
            animation: bubblePop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes bubblePop {
            0% { opacity: 0; transform: scale(0.2) translateY(10px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        /* Particles & Pop Words */
        .click-pop-word {
            position: fixed;
            font-weight: 900;
            font-size: 22px;
            color: var(--accent-yellow);
            -webkit-text-stroke: 1px var(--card-border);
            pointer-events: none;
            z-index: 9999;
            animation: popFade 0.5s ease-out forwards;
        }

        @keyframes popFade {
            0% { opacity: 1; transform: translate(-50%, -50%) scale(0.5) rotate(-10deg); }
            50% { transform: translate(-50%, -80%) scale(1.2) rotate(6deg); }
            100% { opacity: 0; transform: translate(-50%, -110%) scale(0.8) rotate(0deg); }
        }

        .confetti-particle {
            position: fixed;
            width: 8px;
            height: 8px;
            border-radius: 2px;
            pointer-events: none;
            z-index: 9998;
            animation: confettiFall 0.7s ease-out forwards;
        }

        @keyframes confettiFall {
            0% { opacity: 1; transform: translate(0, 0) rotate(0deg); }
            100% { opacity: 0; transform: translate(var(--vx), var(--vy)) rotate(360deg); }
        }

        /* Modal Controls */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .comic-modal {
            background: var(--card-bg);
            color: var(--ink);
            border: 2px solid var(--card-border);
            box-shadow: 8px 8px 0px var(--shadow-color);
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            padding: 20px;
            transform: scale(0.95);
            transition: transform 0.2s ease;
        }

        .modal-overlay.active .comic-modal {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            border-bottom: 1px solid var(--card-border);
            padding-bottom: 8px;
        }

        .modal-title {
            font-size: 17px;
            font-weight: 700;
        }

        .btn-close-modal {
            background: var(--accent-red);
            color: #ffffff;
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            font-weight: 700;
            cursor: pointer;
        }

        .scanner-viewfinder {
            height: 140px;
            background: #09090b;
            border: 2px solid var(--card-border);
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .laser-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background: var(--accent-red);
            box-shadow: 0 0 8px var(--accent-red);
            animation: scanLaser 1.5s linear infinite alternate;
        }

        @keyframes scanLaser {
            0% { top: 10%; }
            100% { top: 90%; }
        }

        .scan-text {
            color: var(--accent-yellow);
            font-weight: 500;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .main-dashboard-grid { grid-template-columns: 1fr; }
            .ticket-stub { grid-template-columns: 1fr; }
            .ticket-stub::before { display: none; }
            .ticket-side { align-items: flex-start; border-top: 2px dashed var(--card-border); }
            .bg-cat-decoration, .bg-dog-decoration, .bg-bird-decoration { display: none; }
        }
    </style>
</head>
<body data-theme="noir">

    <!-- 1. น้องหมานักกีฬา (มุมซ้ายล่าง) -->
    <div class="bg-dog-decoration pet-interactive" onclick="petInteract(event, '🐶 โฮ่ง! (เจ้าตูบเชียร์การยืมของ)'); playThemeSound('borrow');">
        <svg width="70" height="60" viewBox="0 0 85 75" fill="none" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="40" cy="50" rx="22" ry="16" fill="var(--card-bg)" stroke="var(--ink)" stroke-width="2.5"/>
            <circle cx="52" cy="32" r="16" fill="var(--card-bg)" stroke="var(--ink)" stroke-width="2.5"/>
            <path d="M60 22C68 28 66 42 62 44" stroke="var(--ink)" stroke-width="4" fill="var(--ink)" stroke-linecap="round"/>
            <ellipse cx="60" cy="36" rx="8" ry="6" fill="var(--bg-paper)" stroke="var(--ink)" stroke-width="2"/>
            <polygon points="62,32 66,32 64,35" fill="var(--ink)"/>
            <circle cx="50" cy="28" r="2.5" fill="var(--ink)"/>
            <path d="M38 24L65 20" stroke="var(--accent-red)" stroke-width="4" stroke-linecap="round"/>
            <path d="M48 60L52 70M36 60L36 70" stroke="var(--ink)" stroke-width="3" stroke-linecap="round"/>
        </svg>

        <svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="15" cy="15" r="12" fill="var(--accent-green)" stroke="var(--ink)" stroke-width="2"/>
            <path d="M6 10C12 10 12 20 6 20M24 10C18 10 18 20 24 20" stroke="var(--card-bg)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>

    <!-- 2. น้องแมวเล่นลูกบอล (มุมขวาล่าง) -->
    <div class="bg-cat-decoration pet-interactive" onclick="petInteract(event, '🐱 เหมียว~ (แมวขอปะทะลูกบอล!)'); playThemeSound('return');">
        <svg width="28" height="28" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="17" fill="var(--accent-yellow)" stroke="var(--ink)" stroke-width="2.5"/>
            <path d="M7 20H33M20 7C24.5 11 24.5 29 20 33M20 7C15.5 11 15.5 29 20 33" stroke="var(--ink)" stroke-width="2" stroke-linecap="round"/>
        </svg>

        <svg width="75" height="65" viewBox="0 0 90 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M72 55C80 50 82 35 76 28" stroke="var(--ink)" stroke-width="4" stroke-linecap="round"/>
            <ellipse cx="48" cy="52" rx="24" ry="18" fill="var(--card-bg)" stroke="var(--ink)" stroke-width="2.5"/>
            <circle cx="28" cy="36" r="18" fill="var(--card-bg)" stroke="var(--ink)" stroke-width="2.5"/>
            <path d="M15 26L22 10L30 22" fill="var(--accent-blue)" stroke="var(--ink)" stroke-width="2" stroke-linejoin="round"/>
            <path d="M28 22L36 10L42 26" fill="var(--accent-blue)" stroke="var(--ink)" stroke-width="2" stroke-linejoin="round"/>
            <ellipse cx="21" cy="36" rx="2" ry="3" fill="var(--ink)"/>
            <ellipse cx="32" cy="36" rx="2" ry="3" fill="var(--ink)"/>
            <polygon points="25,40 28,40 26.5,42" fill="var(--accent-red)"/>
            <path d="M12 38L3 36M12 41L4 42M38 38L47 36M38 41L46 42" stroke="var(--ink)" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M18 56C12 56 6 50 2 46" stroke="var(--ink)" stroke-width="3.5" stroke-linecap="round"/>
        </svg>
    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <div class="dashboard-wrapper">
        
        <!-- Utility Top Bar & Theme Switcher -->
        <div class="top-utility-bar">
            <div class="status-group">
                <div class="live-status">
                    <div class="status-dot"></div>
                    <span>คลังอุปกรณ์: พร้อมใช้งาน</span>
                </div>
                <div class="achievement-badge" onclick="triggerPopFX(event, 'STREAK!'); playThemeSound('alert'); spawnConfetti(event);">
                    🏆 คืนตรงเวลา 100%
                </div>
            </div>

            <!-- 🎨 THEME SWITCHER -->
            <div class="theme-switcher">
                <span class="theme-label">THEME:</span>
                <button class="theme-btn active" onclick="changeTheme('noir', this)">🕶️ Noir Dark</button>
                <button class="theme-btn" onclick="changeTheme('vintage', this)">📜 Vintage</button>
                <button class="theme-btn" onclick="changeTheme('cyber', this)">⚡ Cyber</button>
                <button class="theme-btn" onclick="changeTheme('charcoal', this)">🎨 Charcoal</button>
            </div>

            <button class="sound-toggle-btn" id="soundBtn" onclick="toggleSound()">🔊 SOUND: ON</button>
        </div>

        <!-- Header & Quick Actions -->
        <header class="brand-bar">
            <div class="bg-bird-decoration pet-interactive" onclick="petInteract(event, '🐦 จิ๊บ! (นกกรรมการพร้อมเป่านกหวีด)'); playThemeSound('scan');">
                <svg width="34" height="30" viewBox="0 0 45 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="22" r="14" fill="var(--card-bg)" stroke="var(--ink)" stroke-width="2.5"/>
                    <circle cx="15" cy="18" r="2" fill="var(--ink)"/>
                    <polygon points="8,22 1,20 8,26" fill="var(--accent-yellow)" stroke="var(--ink)" stroke-width="1.5"/>
                    <rect x="2" y="24" width="8" height="4" rx="1" fill="var(--ink)"/>
                </svg>
            </div>

            <div class="brand-title">SPORTS LOCKER // HUB</div>
            
            <div class="action-group">
                <button class="btn-action btn-borrow" onclick="openScannerModal('ยืมอุปกรณ์ด่วน'); triggerPopFX(event, 'POW!'); playThemeSound('borrow'); spawnConfetti(event);">+ ยืมอุปกรณ์ด่วน</button>
                <button class="btn-action btn-return" onclick="openScannerModal('รับคืนอุปกรณ์'); triggerPopFX(event, 'BAM!'); playThemeSound('return'); spawnConfetti(event);">↩️ รับคืนอุปกรณ์</button>
                <button class="btn-action btn-scan" onclick="openScannerModal('สแกน QR / Barcode'); triggerPopFX(event, 'ZAP!'); playThemeSound('scan'); spawnConfetti(event);">📷 สแกน QR</button>
            </div>
        </header>

        <!-- Alert Banner -->
        <div class="alert-tape" onclick="triggerPopFX(event, 'ALERT!'); playThemeSound('alert'); spawnConfetti(event);">
            <span class="alert-tag">ALERT</span>
            <span>{{alertMessage}}</span> <!-- เช่น: พบอุปกรณ์เกินกำหนดส่งคืน 3 รายการ -->
        </div>

        <!-- 4 Stat Cards -->
        <section class="stats-grid">
            <div class="stat-card" onclick="triggerPopFX(event, 'READY!'); playThemeSound('card'); spawnConfetti(event);">
                <div class="stat-label">พร้อมให้ยืม</div>
                <div class="stat-number num-green">{{totalAvailable}}</div>
            </div>

            <div class="stat-card" onclick="triggerPopFX(event, 'BORROWED!'); playThemeSound('card'); spawnConfetti(event);">
                <div class="stat-label">ถูกยืมวันนี้</div>
                <div class="stat-number num-yellow">{{borrowedToday}}</div>
            </div>

            <div class="stat-card" onclick="triggerPopFX(event, 'PENDING!'); playThemeSound('card'); spawnConfetti(event);">
                <div class="stat-label">รอส่งคืน</div>
                <div class="stat-number num-red">{{pendingReturn}}</div>
            </div>

            <div class="stat-card" onclick="triggerPopFX(event, 'ACTIVE!'); playThemeSound('card'); spawnConfetti(event);">
                <div class="stat-label">ผู้เข้าใช้บริการ</div>
                <div class="stat-number num-blue">{{activeStudents}}</div>
            </div>
        </section>

        <!-- ==================================================== -->
        /* 2-COLUMN LAYOUT (ฝั่งซ้าย: ทำรายการ / ฝั่งขวา: มอนิเตอร์สถิติ) */
        /* ==================================================== */
        <div class="main-dashboard-grid">
            
            <!-- Left Panel (Search & Latest Transaction) -->
            <div class="left-panel">
                <!-- Search & Filter Bar -->
                <div class="content-box">
                    <div class="section-title">
                        <span>SEARCH & FILTER // ค้นหาเร่งด่วน</span>
                    </div>
                    
                    <div class="search-container">
                        <input type="text" class="search-input" placeholder="พิมพ์รหัสนักเรียน, เบอร์เสื้อพละ หรือรหัสอุปกรณ์..." value="{{searchQuery}}">
                        <div class="filter-tags">
                            <button class="tag-btn active" onclick="toggleTag(this); triggerPopFX(event, 'ALL!'); playThemeSound('tag');">#ทั้งหมด</button>
                            <button class="tag-btn" onclick="toggleTag(this); triggerPopFX(event, 'B-BALL!'); playThemeSound('tag');">#บาสเกตบอล</button>
                            <button class="tag-btn" onclick="toggleTag(this); triggerPopFX(event, 'BADMINTON!'); playThemeSound('tag');">#แบดมินตัน</button>
                            <button class="tag-btn" onclick="toggleTag(this); triggerPopFX(event, 'PINGPONG!'); playThemeSound('tag');">#ปิงปอง</button>
                            <button class="tag-btn" onclick="toggleTag(this); triggerPopFX(event, 'SOCCER!'); playThemeSound('tag');">#ฟุตบอล</button>
                        </div>
                    </div>
                </div>

                <!-- Recent Transaction -->
                <div class="content-box">
                    <div class="section-title">LATEST CHECKOUT // รายการล่าสุด</div>
                    
                    <div class="ticket-stub" onclick="triggerPopFX(event, 'STAMPED!'); playThemeSound('card'); spawnConfetti(event);">
                        <div class="ticket-main">
                            <div class="ticket-student">{{recentStudentName}}</div> <!-- เช่น: ด.ช. สมชาย ใจดี (ม.3/2) -->
                            <div class="ticket-item">อุปกรณ์: {{recentEquipment}}</div> <!-- เช่น: ลูกบาสเกตบอล (B-001) -->
                        </div>
                        <div class="ticket-side">
                            <div class="status-stamp">{{recentStatus}}</div> <!-- เช่น: กำลังยืม -->
                            <div class="time-stamp">เวลา {{recentTime}}</div> <!-- เช่น: 14:30 น. -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel (🆕 Side Analytics: ป้องกันหน้าจอโล้น) -->
            <div class="right-panel">
                
                <!-- 🆕 Component 1: Visual Stock Status -->
                <div class="content-box">
                    <div class="section-title">
                        <span>STOCK STATUS // อุปกรณ์คงเหลือ</span>
                    </div>
                    <div class="stock-list">
                        <div class="stock-item">
                            <div class="stock-header">
                                <span class="stock-name">🏀 บาสเกตบอล</span>
                                <span>8/10</span>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: 80%; background: var(--accent-green);"></div>
                            </div>
                        </div>

                        <div class="stock-item">
                            <div class="stock-header">
                                <span class="stock-name">⚽ ฟุตบอล (ใกล้หมด)</span>
                                <span>2/15</span>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: 15%; background: var(--accent-red);"></div>
                            </div>
                        </div>

                        <div class="stock-item">
                            <div class="stock-header">
                                <span class="stock-name">🏸 ไม้แบดมินตัน</span>
                                <span>12/15</span>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: 80%; background: var(--accent-blue);"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🆕 Component 2: Peak Borrowing Activity Chart -->
                <div class="content-box">
                    <div class="section-title">
                        <span>PEAK HOURS // ช่วงเวลายืมสูงสุด</span>
                    </div>
                    <div class="chart-bars">
                        <div class="chart-col">
                            <div class="chart-bar-fill" style="height: 35%;"></div>
                            <span class="chart-label">08:00</span>
                        </div>
                        <div class="chart-col">
                            <div class="chart-bar-fill peak" style="height: 90%;"></div>
                            <span class="chart-label">12:00</span>
                        </div>
                        <div class="chart-col">
                            <div class="chart-bar-fill" style="height: 50%;"></div>
                            <span class="chart-label">14:00</span>
                        </div>
                        <div class="chart-col">
                            <div class="chart-bar-fill peak" style="height: 100%;"></div>
                            <span class="chart-label">15:30</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- SCANNER MODAL -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="comic-modal">
            <div class="modal-header">
                <div class="modal-title" id="modalTitle">สแกนอุปกรณ์ด่วน</div>
                <button class="btn-close-modal" onclick="closeModal()">✕</button>
            </div>
            <div class="scanner-viewfinder">
                <div class="laser-line"></div>
                <span class="scan-text">กำลังค้นหาสัญญาณ BARCODE...</span>
            </div>
            <button class="btn-action btn-borrow" style="width: 100%; justify-content: center;" onclick="closeModal(); playThemeSound('borrow'); spawnConfetti(event);">จำลองการสแกนสำเร็จ!</button>
        </div>
    </div>

    <!-- JAVASCRIPT & SOUND SYNTH -->
    <script>
        let currentTheme = 'noir';
        let soundEnabled = true;

        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();

        function playThemeSound(actionType) {
            if (!soundEnabled) return;
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }

            const now = audioCtx.currentTime;
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.connect(gain);
            gain.connect(audioCtx.destination);

            if (currentTheme === 'noir') {
                osc.type = 'square';
                if (actionType === 'theme') {
                    osc.frequency.setValueAtTime(300, now);
                    osc.frequency.setValueAtTime(500, now + 0.05);
                    gain.gain.setValueAtTime(0.08, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.1);
                } else if (actionType === 'borrow') {
                    osc.frequency.setValueAtTime(350, now);
                    osc.frequency.setValueAtTime(700, now + 0.06);
                    gain.gain.setValueAtTime(0.1, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.1);
                } else {
                    osc.frequency.setValueAtTime(450, now);
                    gain.gain.setValueAtTime(0.08, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.04);
                }
                osc.start(now);
                osc.stop(now + 0.12);
            }
            else if (currentTheme === 'vintage') {
                osc.type = 'triangle';
                if (actionType === 'theme') {
                    osc.frequency.setValueAtTime(500, now);
                    osc.frequency.setValueAtTime(650, now + 0.05);
                    gain.gain.setValueAtTime(0.12, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.12);
                } else {
                    osc.frequency.setValueAtTime(900, now);
                    osc.frequency.exponentialRampToValueAtTime(150, now + 0.03);
                    gain.gain.setValueAtTime(0.12, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.03);
                }
                osc.start(now);
                osc.stop(now + 0.15);
            }
            else if (currentTheme === 'cyber') {
                osc.type = 'sawtooth';
                if (actionType === 'scan' || actionType === 'borrow') {
                    osc.frequency.setValueAtTime(1200, now);
                    osc.frequency.exponentialRampToValueAtTime(300, now + 0.08);
                    gain.gain.setValueAtTime(0.08, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.08);
                } else {
                    osc.frequency.setValueAtTime(800, now);
                    osc.frequency.exponentialRampToValueAtTime(350, now + 0.04);
                    gain.gain.setValueAtTime(0.06, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.04);
                }
                osc.start(now);
                osc.stop(now + 0.1);
            }
            else if (currentTheme === 'charcoal') {
                osc.type = 'sine';
                if (actionType === 'theme') {
                    osc.frequency.setValueAtTime(400, now);
                    osc.frequency.setValueAtTime(600, now + 0.06);
                    gain.gain.setValueAtTime(0.12, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.12);
                } else {
                    osc.frequency.setValueAtTime(300, now);
                    osc.frequency.exponentialRampToValueAtTime(700, now + 0.05);
                    gain.gain.setValueAtTime(0.15, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.05);
                }
                osc.start(now);
                osc.stop(now + 0.12);
            }
        }

        // Theme Switcher Logic
        function changeTheme(themeName, btnElement) {
            currentTheme = themeName;
            document.body.setAttribute('data-theme', themeName);
            document.querySelectorAll('.theme-btn').forEach(btn => btn.classList.remove('active'));
            btnElement.classList.add('active');
            playThemeSound('theme');
        }

        function toggleSound() {
            soundEnabled = !soundEnabled;
            document.getElementById('soundBtn').innerText = soundEnabled ? '🔊 SOUND: ON' : '🔇 SOUND: OFF';
            if (soundEnabled) playThemeSound('card');
        }

        // Pop Text FX
        function triggerPopFX(event, word) {
            const pop = document.createElement('div');
            pop.className = 'click-pop-word';
            pop.innerText = word;
            pop.style.left = event.clientX + 'px';
            pop.style.top = event.clientY + 'px';
            document.body.appendChild(pop);
            setTimeout(() => pop.remove(), 500);
        }

        // Confetti Burst
        function spawnConfetti(event) {
            const colors = ['#f59e0b', '#38bdf8', '#34d399', '#f43f5e', '#ffffff'];
            for (let i = 0; i < 10; i++) {
                const p = document.createElement('div');
                p.className = 'confetti-particle';
                p.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                p.style.left = event.clientX + 'px';
                p.style.top = event.clientY + 'px';
                
                const vx = (Math.random() - 0.5) * 140 + 'px';
                const vy = (Math.random() - 0.5) * 140 + 'px';
                p.style.setProperty('--vx', vx);
                p.style.setProperty('--vy', vy);

                document.body.appendChild(p);
                setTimeout(() => p.remove(), 700);
            }
        }

        // Pet Speech Bubbles
        function petInteract(event, text) {
            spawnConfetti(event);
            
            const existing = document.querySelector('.speech-bubble-pop');
            if (existing) existing.remove();

            const bubble = document.createElement('div');
            bubble.className = 'speech-bubble-pop';
            bubble.innerText = text;
            bubble.style.left = Math.min(event.clientX - 40, window.innerWidth - 180) + 'px';
            bubble.style.top = (event.clientY - 45) + 'px';
            
            document.body.appendChild(bubble);
            setTimeout(() => bubble.remove(), 1600);
        }

        // Tag Filter Toggle
        function toggleTag(btn) {
            document.querySelectorAll('.tag-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        // Modal Controls
        function openScannerModal(title) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalOverlay').classList.add('active');
        }

        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('active');
        }
    </script>
</body>
</html>
=======

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
>>>>>>> 34487cbf138fcd99931e123f0a1683bdf4598ff9

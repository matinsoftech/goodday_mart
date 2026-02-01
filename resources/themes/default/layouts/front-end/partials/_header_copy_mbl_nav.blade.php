

@php($announcement=getWebConfig(name: 'announcement'))
<style>
    /* Mobile Menu Left Side Styles */
    @media (max-width: 767.98px) {
        .mobile-child-list {
            position: static !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
            transform: none !important;
        }

        /* Rotate arrow when open */
        .has-children.opened i {
            transform: rotate(90deg);
        }

        .transition-arrow {
            transition: transform 0.3s ease;
        }
    }
        .mobile-menu-left {
            position: fixed !important;
            top: 0 !important;
            left: -100% !important;
            width: 85% !important;
            height: 100vh !important;
            background: #000000 !important;
            z-index: 99999 !important;
            transition: left 0.3s ease-in-out !important;
            overflow-y: auto !important;
            padding: 20px !important;
            box-shadow: 2px 0 10px rgba(0,0,0,0.5) !important;
            visibility: visible !important;
        }

        .mobile-menu-left.show {
            left: 0 !important;
        }

        .mobile-menu-header {
            background: rgba(255,255,255,0.1) !important;
            padding: 15px !important;
            border-radius: 10px !important;
            /* margin-bottom: 20px !important; */
            backdrop-filter: blur(10px) !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
        }

        .mobile-nav-menu {
            width: 100% !important;
        }

        .mobile-nav-menu .nav-item {
            margin-bottom: 5px !important;
        }

        .mobile-nav-link {
            color: #ffffff !important;
            padding: 12px 15px !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            font-weight: 500 !important;
            text-decoration: none !important;
            background: rgba(255,255,255,0.1) !important;
            backdrop-filter: blur(5px) !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
        }

        .mobile-nav-link:hover {
            background: rgba(255,255,255,0.2) !important;
            color: #ffffff !important;
            transform: translateX(5px) !important;
            text-decoration: none !important;
        }

        .mobile-nav-link i {
            width: 20px !important;
            text-align: center !important;
            margin-right: 12px !important;
            font-size: 16px !important;
            color: #ffffff !important;
        }

        .mobile-nav-link.active {
            background: rgba(255,255,255,0.25) !important;
            border-left: 4px solid #ffffff !important;
        }

        .logout-btn {
            margin-top: 30px !important;
            padding: 20px 0 !important;
        }

        .logout-btn .mobile-nav-link {
            background: rgba(255,255,255,0.15) !important;
            border-color: rgba(255,255,255,0.3) !important;
        }

        .logout-btn .mobile-nav-link:hover {
            background: rgba(255,255,255,0.25) !important;
        }

        /* Dropdown styles for mobile */
        .mobile-nav-menu .dropdown-menu {
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            backdrop-filter: blur(10px) !important;
            border-radius: 6px !important;
            margin-top: 2px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            padding: 4px 0 !important;
            min-width: 200px !important;
        }

        .mobile-nav-menu .dropdown-item {
            color: #000000 !important;
            padding: 8px 12px !important;
            border-radius: 0 !important;
            margin: 0 !important;
            background: transparent !important;
            border-bottom: 1px solid rgba(0,0,0,0.05) !important;
            font-size: 14px !important;
            line-height: 1.4 !important;
            transition: all 0.2s ease !important;
        }

        .mobile-nav-menu .dropdown-item:last-child {
            border-bottom: none !important;
        }

        .mobile-nav-menu .dropdown-item:hover {
            background: rgba(0,0,0,0.05) !important;
            color: #000000 !important;
            transform: translateX(3px) !important;
        }

        .mobile-nav-menu .dropdown-item a {
            color: #000000 !important;
            text-decoration: none !important;
            display: block !important;
            width: 100% !important;
            padding: 0 !important;
        }

        .mobile-nav-menu .dropdown-item a:hover {
            color: #000000 !important;
            text-decoration: none !important;
        }

        /* Overlay for mobile menu */
        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 99998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-menu-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Button styles */
        .mobile-nav-link.btn {
            background: rgba(255,255,255,0.15) !important;
            border: 1px solid rgba(255,255,255,0.3) !important;
            color: #ffffff !important;
        }

        .mobile-nav-link.btn:hover {
            background: rgba(255,255,255,0.25) !important;
            color: #ffffff !important;
        }

        /* Prevent body scroll when menu is open */
        body.menu-open {
            overflow: hidden !important;
        }

        /* Ensure mobile menu is visible when collapsed */
        .navbar-collapse.mobile-menu-left {
            display: block !important;
        }

        /* Fix for Bootstrap collapse */
        .navbar-collapse.collapse:not(.show) {
            display: none !important;
        }

        .navbar-collapse.collapsing {
            height: auto !important;
        }

        /* Override Bootstrap collapse behavior on mobile */
        .navbar-collapse.mobile-menu-left.show {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Ensure toggle button is visible and clickable */
        .navbar-toggler {
            position: relative !important;
        }

        /* Fix for mobile menu positioning */
        .navbar-stuck-menu .navbar-collapse.mobile-menu-left {
            position: fixed !important;
            top: 0 !important;
            left: -100% !important;
            width: 85% !important;
            height: 100vh !important;
            background: #000000 !important;
            z-index: 99999 !important;
            transition: left 0.3s ease-in-out !important;
            overflow-y: auto !important;
            padding: 20px !important;
            box-shadow: 2px 0 10px rgba(0,0,0,0.5) !important;
            visibility: visible !important;
        }

        .navbar-stuck-menu .navbar-collapse.mobile-menu-left.show {
            left: 0 !important;
        }

        /* Ensure dropdowns work properly in mobile menu */
        .mobile-nav-menu .dropdown {
            position: relative !important;
        }

        .mobile-nav-menu .dropdown-menu {
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            right: auto !important;
            transform: none !important;
            margin-top: 0 !important;
            z-index: 100000 !important;
        }

        .mobile-nav-menu .dropdown-menu.show {
            display: block !important;
        }

        /* Add arrow icon for categories with sub-categories */
        .mobile-nav-menu .dropdown-toggle::after {
            display: inline-block !important;
            margin-left: 0.255em !important;
            vertical-align: 0.255em !important;
            content: ">" !important;
            border: none !important;
            color: #ffffff !important;
            font-weight: bold !important;
            font-size: 14px !important;
        }

        /* Fix scrolling for categories and sub-categories */
        .mobile-nav-menu .dropdown-menu.scroll-bar {
            max-height: 60vh !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            scrollbar-width: thin !important;
            scrollbar-color: rgba(0,0,0,0.3) transparent !important;
        }

        .mobile-nav-menu .dropdown-menu.scroll-bar::-webkit-scrollbar {
            width: 4px !important;
        }

        .mobile-nav-menu .dropdown-menu.scroll-bar::-webkit-scrollbar-track {
            /* background: transparent !important; */
        }

        .mobile-nav-menu .dropdown-menu.scroll-bar::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.3) !important;
            border-radius: 2px !important;
        }

        .mobile-nav-menu .dropdown-menu.scroll-bar::-webkit-scrollbar-thumb:hover {
            background: rgba(0,0,0,0.5) !important;
        }

        /* Mobile dropdown positioning - show below parent instead of to the right */
        .mobile-nav-menu .dropdown-menu {
            position: absolute !important;
            top: auto !important;
            left: auto !important;
            right: auto !important;
            transform: none !important;
            margin-top: 5px !important;
            margin-left: 20px !important;
            width: 200px !important;
            min-width: auto !important;
            max-height: none !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
            background: rgba(255,255,255,0.1) !important;
            backdrop-filter: blur(5px) !important;
            border-radius: 6px !important;
            box-shadow: none !important;
            padding: 8px 0 !important;
            z-index: auto !important;
            display: none !important;
            float: none !important;
        }

        .mobile-nav-menu .dropdown-menu.show {
            display: block !important;
        }

        .mobile-nav-menu .dropdown-item {
            color: #ffffff !important;
            padding: 8px 15px !important;
            border-bottom: 1px solid rgba(255,255,255,0.1) !important;
            /* background: transparent !important; */
            font-size: 13px !important;
        }

        .mobile-nav-menu .dropdown-item:hover {
            background: rgba(255,255,255,0.1) !important;
            color: #ffffff !important;
            transform: translateX(3px) !important;
        }

        .mobile-nav-menu .dropdown-item:last-child {
            border-bottom: none !important;
        }

        /* Sub-menu styling */
        .mobile-nav-menu .sub-menu {
            position: static !important; /* Changed from absolute */
            display: none !important;
            visibility: visible !important; /* Remove hidden !important */
            opacity: 1 !important;        /* Remove opacity 0 !important */
            width: 100% !important;
            background: rgba(255, 255, 255, 0.05) !important;
            border: none !important;
            box-shadow: none !important;
            padding-left: 20px !important; /* Indent sub-items */
        }

        .mobile-nav-menu .dropdown-submenu:hover .sub-menu {
            display: block !important;
        }
        .mobile-nav-menu .dropdown-submenu .fa-angle-right {
            transition: transform 0.3s ease;
        }
        .mobile-nav-menu .dropdown-submenu .sub-menu.show + a i,
        .mobile-nav-menu .dropdown-submenu.active i {
            transform: rotate(90deg);
        }

        .mobile-nav-menu .sub-menu.show {
            display: block !important;
        }

        /* Ensure proper positioning for nested dropdowns */
        .mobile-nav-menu .dropdown-submenu {
            position: relative !important;
        }

        .mobile-nav-menu .dropdown-submenu .dropdown-item {
            position: relative !important;
        }

        /* Fix sub-category visibility */
        .mobile-nav-menu .dropdown-submenu {
            position: relative !important;
        }

        .mobile-nav-menu .dropdown-submenu .dropdown-item {
            cursor: pointer !important;
            position: relative !important;
        }

        .mobile-nav-menu .sub-menu {
            position: absolute !important;
            left: 100% !important;
            top: 0 !important;
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            padding: 4px 0 !important;
            min-width: 180px !important;
            max-height: 60vh !important;
            overflow-y: auto !important;
            z-index: 100001 !important;
            visibility: hidden !important;
            opacity: 0 !important;
            transition: all 0.2s ease !important;
        }

        .mobile-nav-menu .sub-menu.show {
            visibility: visible !important;
            opacity: 1 !important;
            display: block !important;
        }

        .mobile-nav-menu .dropdown-submenu:hover .sub-menu {
            visibility: visible !important;
            opacity: 1 !important;
            display: block !important;
        }

        /* Ensure sub-menu items are properly styled */
        .mobile-nav-menu .sub-menu .dropdown-item {
            color: #000000 !important;
            padding: 8px 12px !important;
            border-radius: 0 !important;
            margin: 0 !important;
            /* background: transparent !important; */
            border-bottom: 1px solid rgba(0,0,0,0.05) !important;
            font-size: 14px !important;
            line-height: 1.4 !important;
            transition: all 0.2s ease !important;
            display: block !important;
            width: 100% !important;
        }

        .mobile-nav-menu .sub-menu .dropdown-item:last-child {
            border-bottom: none !important;
        }

        .mobile-nav-menu .sub-menu .dropdown-item:hover {
            background: rgba(0,0,0,0.05) !important;
            color: #000000 !important;
            transform: translateX(3px) !important;
        }

        /* Ensure sub-menu is visible and properly positioned */
        .mobile-nav-menu .dropdown-submenu {
            position: relative !important;
        }

        .mobile-nav-menu .dropdown-submenu .dropdown-item {
            position: relative !important;
            cursor: pointer !important;
        }

        .mobile-nav-menu .sub-menu {
            position: absolute !important;
            left: 100% !important;
            top: 0 !important;
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            padding: 4px 0 !important;
            min-width: 180px !important;
            max-height: 60vh !important;
            overflow-y: auto !important;
            z-index: 100001 !important;
            display: none !important;
        }

        .mobile-nav-menu .sub-menu.show {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Mobile-specific sub-menu positioning - show below instead of to the right */
        @media (max-width: 767.98px) {
            .mobile-nav-menu .sub-menu {
                position: static !important;
                left: auto !important;
                top: auto !important;
                margin-top: 5px !important;
                margin-left: 20px !important;
                width: calc(100% - 20px) !important;
                min-width: auto !important;
                max-height: none !important;
                border: 1px solid rgba(255,255,255,0.2) !important;
                background: rgba(255,255,255,0.1) !important;
                backdrop-filter: blur(5px) !important;
                border-radius: 6px !important;
                box-shadow: none !important;
                padding: 8px 0 !important;
                z-index: auto !important;
                display: none !important;
            }

            .mobile-nav-menu .sub-menu.show {
                display: block !important;
            }

            .mobile-nav-menu .sub-menu .dropdown-item {
                color: #ffffff !important;
                padding: 8px 15px !important;
                border-bottom: 1px solid rgba(255,255,255,0.1) !important;
                /* background: transparent !important; */
                font-size: 13px !important;
            }

            .mobile-nav-menu .sub-menu .dropdown-item:hover {
                background: rgba(255,255,255,0.1) !important;
                color: #ffffff !important;
                transform: translateX(3px) !important;
            }

            .mobile-nav-menu .sub-menu .dropdown-item:last-child {
                border-bottom: none !important;
            }

            /* Add visual indicator for categories with sub-categories */
            .mobile-nav-menu .dropdown-submenu .dropdown-item i.fa-angle-right {
                color: #ffffff !important;
                font-size: 12px !important;
                margin-left: auto !important;
            }

            /* Force mobile dropdowns to appear below parent */
            .mobile-nav-menu .dropdown {
                position: relative !important;
                display: block !important;
            }

            .mobile-nav-menu .dropdown-menu {
                position: static !important;
                display: none !important;
                float: none !important;
                margin-top: 5px !important;
                margin-left: 20px !important;
                width: calc(100% - 20px) !important;
                border: 1px solid rgba(255,255,255,0.2) !important;
                background: rgba(255,255,255,0.1) !important;
                backdrop-filter: blur(5px) !important;
                border-radius: 6px !important;
                padding: 8px 0 !important;
            }

            .mobile-nav-menu .dropdown-menu.show {
                display: block !important;
            }

            /* Force sub-menus to appear below parent in mobile */
            .mobile-nav-menu .dropdown-submenu {
                position: relative !important;
                display: block !important;
            }

            .mobile-nav-menu .dropdown-submenu .dropdown-item {
                position: relative !important;
                cursor: pointer !important;
            }

            .mobile-nav-menu .sub-menu {
                position: static !important;
                left: auto !important;
                top: auto !important;
                margin-top: 5px !important;
                margin-left: 20px !important;
                width: calc(100% - 20px) !important;
                min-width: auto !important;
                max-height: none !important;
                border: 1px solid rgba(255,255,255,0.2) !important;
                background: rgba(255,255,255,0.1) !important;
                backdrop-filter: blur(5px) !important;
                border-radius: 6px !important;
                box-shadow: none !important;
                padding: 8px 0 !important;
                z-index: auto !important;
                display: none !important;
                float: none !important;
            }

            .mobile-nav-menu .sub-menu.show {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
            }

            .mobile-nav-menu .sub-menu .dropdown-item {
                color: #ffffff !important;
                padding: 8px 15px !important;
                border-bottom: 1px solid rgba(255,255,255,0.1) !important;
                /* background: transparent !important; */
                font-size: 13px !important;
                display: block !important;
                width: 100% !important;
            }

            .mobile-nav-menu .sub-menu .dropdown-item:hover {
                background: rgba(255,255,255,0.1) !important;
                color: #ffffff !important;
                transform: translateX(3px) !important;
            }

            .mobile-nav-menu .sub-menu .dropdown-item:last-child {
                border-bottom: none !important;
            }
        }
    }

    /* Ensure desktop menu remains unchanged */
    @media (min-width: 768px) {
        /* Overwrite desktop dropdown to match mobile dropdown visuals */
        .mobile-nav-menu .dropdown-menu {
            position: absolute !important;
            top: auto !important;
            left: auto !important;
            right: auto !important;
            transform: none !important;
            margin-top: 5px !important;
            margin-left: 20px !important;
            width: 200px !important;
            min-width: auto !important;
            max-height: none !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
            background: rgba(255,255,255,0.1) !important;
            backdrop-filter: blur(5px) !important;
            border-radius: 6px !important;
            box-shadow: none !important;
            padding: 8px 0 !important;
            z-index: auto !important;
            display: none !important;
            float: none !important;
        }

        .mobile-nav-menu .dropdown-menu.show { display: block !important; }

        .mobile-nav-menu .dropdown-item {
            color: #ffffff !important;
            padding: 8px 15px !important;
            border-bottom: 1px solid rgba(255,255,255,0.1) !important;
            /* background: transparent !important; */
            font-size: 13px !important;
        }

        .mobile-nav-menu .dropdown-item:hover {
            background: rgba(255,255,255,0.1) !important;
            color: #ffffff !important;
            transform: translateX(3px) !important;
        }

        .mobile-nav-menu .dropdown-item:last-child { border-bottom: none !important; }

        .mobile-nav-menu .sub-menu {
            position: static !important;
            left: auto !important;
            top: auto !important;
            margin-top: 5px !important;
            margin-left: 20px !important;
            width: calc(100% - 20px) !important;
            min-width: auto !important;
            max-height: none !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
            background: rgba(255,255,255,0.1) !important;
            backdrop-filter: blur(5px) !important;
            border-radius: 6px !important;
            box-shadow: none !important;
            padding: 8px 0 !important;
            z-index: auto !important;
            display: none !important;
            float: none !important;
        }

        .mobile-nav-menu .sub-menu.show { display: block !important; }

        .mobile-nav-menu .sub-menu .dropdown-item {
            color: #ffffff !important;
            padding: 8px 15px !important;
            border-bottom: 1px solid rgba(255,255,255,0.1) !important;
            /* background: transparent !important; */
            font-size: 13px !important;
            display: block !important;
            width: 100% !important;
        }

        .mobile-nav-menu .sub-menu .dropdown-item:hover {
            background: rgba(255,255,255,0.1) !important;
            color: #ffffff !important;
            transform: translateX(3px) !important;
        }
        .mobile-menu-left {
            position: relative !important;
            left: 0 !important;
            width: auto !important;
            height: auto !important;
            /* background: transparent !important; */
            z-index: auto !important;
            transition: none !important;
            overflow: visible !important;
            padding: 0 !important;
            box-shadow: none !important;
        }

        .mobile-nav-link {
            color: inherit !important;
            padding: inherit !important;
            border-radius: 0 !important;
            transition: none !important;
            display: inherit !important;
            align-items: inherit !important;
            font-weight: inherit !important;
            text-decoration: inherit !important;
            /* background: transparent !important; */
            backdrop-filter: none !important;
            border: none !important;
        }

        .mobile-nav-link:hover {
            /* background: transparent !important; */
            color: inherit !important;
            transform: none !important;
            text-decoration: inherit !important;
        }

        .mobile-nav-link i {
            display: none !important;
        }

        /* Desktop menu styling and gaps */
        .navbar-nav {
            gap: 20px !important;
        }

        .navbar-nav .nav-item {
            margin: 0 !important;
            padding: 0 !important;
        }

        .navbar-nav .nav-link {
            padding: 15px 10px !important;
            margin: 0 !important;
            color: inherit !important;
            /* background: transparent !important; */
            border: none !important;
            border-radius: 0 !important;
            transition: color 0.3s ease !important;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff !important;
            /* background: transparent !important; */
            transform: none !important;
        }

        /* Desktop dropdown styling */
        .navbar-nav .dropdown-menu {
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            padding: 8px 0 !important;
            margin-top: 5px !important;
        }

        .navbar-nav .dropdown-item {
            color: #000000 !important;
            padding: 8px 16px !important;
            /* background: transparent !important; */
            border: none !important;
            border-radius: 0 !important;
            transition: background-color 0.2s ease !important;
        }

        .navbar-nav .dropdown-item:hover {
            background: rgba(0,0,0,0.05) !important;
            color: #000000 !important;
            transform: none !important;
        }

        /* Desktop sub-menu styling */
        .navbar-nav .sub-menu {
            position: absolute !important;
            left: 100% !important;
            top: 0 !important;
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            padding: 8px 0 !important;
            min-width: 180px !important;
            z-index: 1000 !important;
            display: none !important;
        }

        .navbar-nav .dropdown-submenu:hover .sub-menu {
            display: block !important;
        }

        .navbar-nav .sub-menu .dropdown-item {
            color: #000000 !important;
            padding: 8px 16px !important;
            /* background: transparent !important; */
            border: none !important;
            border-radius: 0 !important;
            transition: background-color 0.2s ease !important;
        }

        .navbar-nav .sub-menu .dropdown-item:hover {
            background: rgba(0,0,0,0.05) !important;
            color: #000000 !important;
            transform: none !important;
        }

        /* Reset mobile-specific styles for desktop */
        .mobile-nav-menu {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 20px !important;
        }

        .mobile-nav-menu .nav-item {
            margin: 0 !important;
            padding: 0 !important;
        }

        .mobile-nav-menu .nav-link {
            padding: 15px 10px !important;
            margin: 0 !important;
            color: inherit !important;
            /* background: transparent !important; */
            border: none !important;
            border-radius: 0 !important;
            transition: color 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
        }

        .mobile-nav-menu .nav-link:hover {
            color: #007bff !important;
            /* background: transparent !important; */
            transform: none !important;
        }

        .mobile-nav-menu .dropdown-menu {
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            padding: 8px 0 !important;
            margin-top: 5px !important;
        }

        .mobile-nav-menu .dropdown-item {
            color: #000000 !important;
            padding: 8px 16px !important;
            /* background: transparent !important; */
            border: none !important;
            border-radius: 0 !important;
            transition: background-color 0.2s ease !important;
        }

        .mobile-nav-menu .dropdown-item:hover {
            background: rgba(0,0,0,0.05) !important;
            color: #000000 !important;
            transform: none !important;
        }

        .mobile-nav-menu .sub-menu {
            position: absolute !important;
            left: 100% !important;
            top: 0 !important;
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
            padding: 8px 0 !important;
            min-width: 180px !important;
            z-index: 1000 !important;
            display: none !important;
        }

        .mobile-nav-menu .dropdown-submenu:hover .sub-menu {
            display: block !important;
        }

        .mobile-nav-menu .sub-menu .dropdown-item {
            color: #000000 !important;
            padding: 8px 16px !important;
            /* background: transparent !important; */
            border: none !important;
            border-radius: 0 !important;
            transition: background-color 0.2s ease !important;
        }

        .mobile-nav-menu .sub-menu .dropdown-item:hover {
            background: rgba(0,0,0,0.05) !important;
            color: #000000 !important;
            transform: none !important;
        }

        /* Scoped Category Dropdown Widget (desktop) - GDM prefixed to avoid conflicts */
        .gdm-catdd * { box-sizing: border-box; }
        .gdm-catdd .gdm-container { position: relative; display: inline-block; }
        .gdm-catdd .gdm-trigger {
            background: #ffffff; border: 1px solid rgba(0,0,0,0.1); padding: 10px 16px; border-radius: 8px;
            cursor: pointer; font-size: 14px; font-weight: 500; box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.2s ease; display: flex; align-items: center; gap: 8px; color: #333;
        }
        .gdm-catdd .gdm-trigger:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(0,0,0,0.12); }
        .gdm-catdd .gdm-trigger::after { content: '▼'; font-size: 11px; transition: transform 0.2s ease; margin-left: 6px; }
        .gdm-catdd .gdm-trigger.active::after { transform: rotate(180deg); }

        .gdm-catdd .gdm-menu {
            position: absolute; top: calc(100% + 8px); left: 0; background: #ffffff; border-radius: 12px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.15); opacity: 0; visibility: hidden; transform: translateY(-8px);
            transition: all 0.2s ease; z-index: 1000; min-width: 280px; max-height: 320px; overflow-y: auto;
            border: 1px solid rgba(0,0,0,0.08);
        }
        .gdm-catdd .gdm-menu.active { opacity: 1; visibility: visible; transform: translateY(0); }
        .gdm-catdd .gdm-menu::-webkit-scrollbar { width: 8px; }
        .gdm-catdd .gdm-menu::-webkit-scrollbar-track { background: #f6f6f6; border-radius: 10px; }
        .gdm-catdd .gdm-menu::-webkit-scrollbar-thumb { background: #d2d2d2; border-radius: 10px; }

        .gdm-catdd .gdm-item { position: relative; border-bottom: 1px solid #f2f2f2; }
        .gdm-catdd .gdm-item:last-child { border-bottom: none; }
        .gdm-catdd .gdm-link {
            display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; color: #333; text-decoration: none;
            transition: all 0.2s ease; cursor: pointer;
        }
        .gdm-catdd .gdm-link:hover { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; }
        .gdm-catdd .gdm-item.gdm-has-sub > .gdm-link::after { content: '▶'; font-size: 11px; }

        .gdm-catdd .gdm-sub {
            position: absolute; left: 100%; top: 0; background: #ffffff; border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12); opacity: 0; visibility: hidden; transform: translateX(-8px);
            transition: all 0.2s ease; min-width: 220px; max-height: 260px; overflow-y: auto; z-index: 1001;
            border: 1px solid rgba(0,0,0,0.08);
        }
        .gdm-catdd .gdm-item:hover > .gdm-sub { opacity: 1; visibility: visible; transform: translateX(0); }
        .gdm-catdd .gdm-sub::-webkit-scrollbar { width: 6px; }
        .gdm-catdd .gdm-sub::-webkit-scrollbar-thumb { background: #dcdcdc; border-radius: 8px; }
        .gdm-catdd .gdm-sub-item { border-bottom: 1px solid #f3f3f3; }
        .gdm-catdd .gdm-sub-item:last-child { border-bottom: none; }
        .gdm-catdd .gdm-sub-link { display: block; padding: 10px 14px; color: #555; text-decoration: none; transition: all 0.2s ease; }
        .gdm-catdd .gdm-sub-link:hover { background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); color: #fff; transform: translateX(3px); }
    }

    /* Unify category dropdown styling across mobile and desktop */
    .mobile-nav-menu .dropdown-menu {
        position: absolute !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;
        transform: none !important;
        margin-top: 5px !important;
        margin-left: 20px !important;
        width: 200px !important;
        min-width: auto !important;
        max-height: none !important;
        border: 1px solid rgba(255,255,255,0.2) !important;
        background: rgba(255,255,255,0.1) !important;
        backdrop-filter: blur(5px) !important;
        border-radius: 6px !important;
        box-shadow: none !important;
        padding: 8px 0 !important;
        z-index: auto !important;
        display: none !important;
        float: none !important;
    }

    .mobile-nav-menu .dropdown-menu.show { display: block !important; }

    .mobile-nav-menu .dropdown-item {
        color: #ffffff !important;
        padding: 8px 15px !important;
        border-bottom: 1px solid rgba(255,255,255,0.1) !important;
        /* background: transparent !important; */
        font-size: 13px !important;
    }

    .mobile-nav-menu .dropdown-item:hover {
        background: rgba(255,255,255,0.1) !important;
        color: #ffffff !important;
        transform: translateX(3px) !important;
    }

    .mobile-nav-menu .dropdown-item:last-child { border-bottom: none !important; }

    .mobile-nav-menu .sub-menu {
        position: static !important;
        left: auto !important;
        top: auto !important;
        margin-top: 5px !important;
        margin-left: 20px !important;
        width: calc(100% - 20px) !important;
        min-width: auto !important;
        max-height: none !important;
        border: 1px solid rgba(255,255,255,0.2) !important;
        background: rgba(255,255,255,0.1) !important;
        backdrop-filter: blur(5px) !important;
        border-radius: 6px !important;
        box-shadow: none !important;
        padding: 8px 0 !important;
        z-index: auto !important;
        display: none !important;
        float: none !important;
    }

    .mobile-nav-menu .sub-menu.show { display: block !important; }

    .mobile-nav-menu .sub-menu .dropdown-item {
        color: #000 !important;
        padding: 8px 15px !important;
        border-bottom: 1px solid rgba(255,255,255,0.1) !important;
        /* background: transparent !important; */
        font-size: 13px !important;
        display: block !important;
        width: 100% !important;
    }

    .mobile-nav-menu .sub-menu .dropdown-item:hover {
        background: rgba(255,255,255,0.1) !important;
        color: #000 !important;
        transform: translateX(3px) !important;
    }

    /* Force sub-categories to appear BELOW the main category on all viewports */
    .mobile-nav-menu .dropdown-submenu > .sub-menu {
        position: absolute !important;
        left: auto !important;
        top: auto !important;
        /* margin-top: 5px !important; */
        margin-left: 200px !important;
        width: calc(100% - 20px) !important;
        min-width: auto !important;
        max-height: none !important;
        float: none !important;
    }

    /* Desktop overrides: keep same layout as mobile, but desktop color scheme */
    @media (min-width: 768px) {
        .mobile-nav-menu .dropdown-menu {
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            backdrop-filter: none !important;
            margin-top: 5px !important;
            z-index: 1000 !important;
        }

        .mobile-nav-menu .dropdown-item {
            color: #000000 !important;
            border-bottom: 1px solid rgba(0,0,0,0.05) !important;
            /* background: transparent !important; */
        }

        .mobile-nav-menu .dropdown-item:hover {
            background: rgba(0,0,0,0.05) !important;
            color: #000000 !important;
            transform: none !important;
        }

        .mobile-nav-menu .sub-menu {
            background: #ffffff !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
            backdrop-filter: none !important;
            margin-top: 5px !important;
            z-index: 1000 !important;
        }

        .mobile-nav-menu .sub-menu .dropdown-item {
            color: #000000 !important;
            border-bottom: 1px solid rgba(0,0,0,0.05) !important;
            /* background: transparent !important; */
        }

        .mobile-nav-menu .sub-menu .dropdown-item:hover {
            background: rgba(0,0,0,0.05) !important;
            color: #000000 !important;
            transform: none !important;
        }
    }
    @media (max-width: 767px) {
        /* Position the submenu */
        .dropdown-submenu {
            position: relative !important;
        }

        .dropdown-submenu > .sub-menu {
            top: 0 !important;
            left: 100% !important;
            margin-top: -1px !important;
            display: none !important;
        }

        /* RTL support */
        .dropdown-menu-right .dropdown-submenu > .sub-menu {
            right: 100% !important;
            left: auto !important;
        }


        .mobile-nav-menu .dropdown-menu, .mobile-nav-menu .dropdown-submenu > .sub-menu {
            position: static !important;
        }
        .mobile-nav-menu .sub-menu {
            position: static !important;
        }

    }
</style>
@if (isset($announcement) && $announcement['status']==1)
    <div class="text-center position-relative px-4 py-2" id="announcement"
         style="background-color: {{ $announcement['color'] }};color:{{$announcement['text_color']}}">
        <span>{{ $announcement['announcement'] }} </span>
        <span class="__close-announcement web-announcement-slideUp">X</span>
    </div>
@endif
<header class="rtl __inline-10">
    <div class="navbar-sticky bg-light mobile-head">
        <div class="navbar navbar-expand-md navbar-light">
            <div class="container ">
                <div class="col-2 small-device-nav">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="col-7 small-device-nav">
                    <div class="d-flex align-items-center gap-3">
                        <div class="navbar-tool  open-search-form-mobile d-lg-none">
                            <a class="navbar-tool-icon-box" href="javascript:">
                                {{-- <i class="tio-search"></i> --}}
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                        </div>
                        {{--<a href="{{route('shop-cart')}}" class="">
                            <i class="fa fa-shopping-cart"></i>
                        </a> --}}
                        <div id="cart_items">
                            @include('layouts.front-end.partials._cart')
                        </div>

                        @if(auth('customer')->check())
                            <div class="dropdown navbar-tool">
                                <a class="navbar-tool-icon-box ml-3" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if (auth('customer')->user()->image != 'def.png')
                                                <img class="img-profile __inline-14" alt="" style="border-radius: 6px;"
                                                    src="{{ getValidImage(path: 'storage/app/public/profile/'.auth('customer')->user()->image, type: 'avatar') }}">
                                        @else
                                                <div class="">
                                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                                </div>
                                        @endif
                                    </div>
                                    <div class="navbar-tool-text">
                                        <small>{{ translate('hello')}}, {{auth('customer')->user()->f_name}}</small>
                                        {{ translate('dashboard')}}
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                        href="{{route('account-oder')}}"> {{ translate('my_Order')}} </a>
                                    <a class="dropdown-item"
                                        href="{{route('user-account')}}"> {{ translate('my_Profile')}}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                        href="{{route('customer.auth.logout')}}">{{ translate('logout')}}</a>
                                </div>
                            </div>
                        @else
                            <div class="dropdown navbar-tool responsive-user-icon">
                                <a class="navbar-tool-icon-box {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}"
                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="">
                                        <i class="fa fa-user-o fa-lg" aria-hidden="true"></i>
                                    </div>
                                </a>
                                <div class="text-align-direction dropdown-menu __auth-dropdown dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('customer.auth.login')}}">
                                        <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in')}}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('customer.auth.sign-up')}}">
                                        <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up')}}
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown responsive-login-text">
                                <a class="navbar-tool {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}"
                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="login-reg-btn">
                                        Login / Register
                                    </div>
                                </a>
                                <div class="text-align-direction dropdown-menu __auth-dropdown dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('customer.auth.login')}}">
                                        <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in')}}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('customer.auth.sign-up')}}">
                                        <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up')}}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0 __min-w-7rem"
                    href="{{route('home')}}">
                    <img class=""
                        src="{{ getValidImage(path: 'storage/app/public/company/'.$web_config['web_logo']->value, type: 'logo') }}"
                        alt="{{$web_config['name']->value}}">
                </a>
                <a class="col-3 navbar-brand d-sm-none m-0"
                    href="{{route('home')}}">
                    <img class="mobile-logo-img __inline-12"
                        src="{{ getValidImage(path: 'storage/app/public/company/'.$web_config['mob_logo']->value, type: 'logo') }}"
                        alt="{{$web_config['name']->value}}"/>
                </a>
                <div class="input-group-overlay mx-lg-4 search-form-mobile text-align-direction">
                    <form action="{{route('products')}}" type="submit" class="search_form">
                        <div class="d-flex align-items-center gap-2">
                            <!-- Categories Dropdown as ul/li -->
                            <ul class="nav categories-dropdown search_bar-category">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ translate('Categories') }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                        @foreach($categories as $category)
                                            <li class="dropdown-item">
                                                <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                                    <span>{{$category['name']}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                        <!-- Add more categories as needed -->
                                    </ul>
                                </li>
                            </ul>
                            <!-- Search Input -->
                            <input class="form-control appended-form-control search-bar-input" type="search"
                                autocomplete="off"
                                placeholder="{{ translate('search_for_items') }}..."
                                name="name" value="{{ request('name') }}">
                            <!-- Search Button -->
                            <button class="input-group-append-overlay search_button d-none d-md-block" type="submit">
                                <span class="input-group-text __text-20px gap-2">
                                    <i class="czi-search text-white font-16 font-weight-600"></i>
                                    <span class="text-white font-15 font-weight-600">Search</span>
                                </span>
                            </button>
                            <!-- Close Button for Mobile -->
                            <span class="close-search-form-mobile fs-14 font-semibold text-muted d-md-none" type="submit">
                                {{ translate('cancel') }}
                            </span>
                        </div>
                        <!-- Hidden Fields -->
                        <input name="data_from" value="search" hidden>
                        <input name="page" value="1" hidden>
                        <!-- Search Result Box -->
                        <div class="card search-card mobile-search-card">
                            <div class="card-body">
                                <div class="search-result-box __h-400px overflow-x-hidden overflow-y-auto"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="d-none d-md-block mr-2 text-nowrap">
                    <a class="topbar-link direction-ltr d-flex align-items-center gap-2" href="tel:{{$web_config['phone']->value}}">
                        <div class="header-phone">
                            <i class="fa fa-phone fa-lg text-white"></i>
                        </div>
                        <div class="header-phone-number">
                            <p class="m-0 get-in-touch">
                                Get in Touch
                            </p>
                            <p class="m-0 number">
                                {{$web_config['phone']->value}}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-md navbar-stuck-menu">
            <div class="container px-10px">
                <div class="collapse navbar-collapse text-align-direction justify-content-between mobile-menu-left" id="navbarCollapse">
                    <div class="w-100 d-md-none text-align-direction mobile-menu-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 font-weight-bold">Menu</h5>
                            <button class="navbar-toggler p-0 border-0 bg-transparent" type="button" data-toggle="collapse"
                            data-target="#navbarCollapse">
                                <i class="tio-clear __text-26px"></i>
                        </button>
                    </div>
                        <hr class="border-light">
                    </div>
                    @php($categories=\App\Models\Category::with(['childes.childes'])->where('position', 0)->priority()->paginate(11))
                    <ul class="navbar-nav mega-nav pr-lg-2 pl-lg-2 mr-2 __mega-nav browse-categories" style="visibility: hidden;">
                        <li class="nav-item {{!request()->is('/')?'dropdown':''}}">
                            <a class="nav-link dropdown-toggle category-menu-toggle-btn ps-0" href="javascript:"
                                style="padding-left: 1.125rem !important;">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.875 12.9195C9.875 12.422 9.6775 11.9452 9.32563 11.5939C8.97438 11.242 8.4975 11.0445 8 11.0445C6.75875 11.0445 4.86625 11.0445 3.625 11.0445C3.1275 11.0445 2.65062 11.242 2.29937 11.5939C1.9475 11.9452 1.75 12.422 1.75 12.9195V17.2945C1.75 17.792 1.9475 18.2689 2.29937 18.6202C2.65062 18.972 3.1275 19.1695 3.625 19.1695H8C8.4975 19.1695 8.97438 18.972 9.32563 18.6202C9.6775 18.2689 9.875 17.792 9.875 17.2945V12.9195ZM19.25 12.9195C19.25 12.422 19.0525 11.9452 18.7006 11.5939C18.3494 11.242 17.8725 11.0445 17.375 11.0445C16.1337 11.0445 14.2413 11.0445 13 11.0445C12.5025 11.0445 12.0256 11.242 11.6744 11.5939C11.3225 11.9452 11.125 12.422 11.125 12.9195V17.2945C11.125 17.792 11.3225 18.2689 11.6744 18.6202C12.0256 18.972 12.5025 19.1695 13 19.1695H17.375C17.8725 19.1695 18.3494 18.972 18.7006 18.6202C19.0525 18.2689 19.25 17.792 19.25 17.2945V12.9195ZM16.5131 9.66516L19.1206 7.05766C19.8525 6.32578 19.8525 5.13828 19.1206 4.4064L16.5131 1.79891C15.7813 1.06703 14.5937 1.06703 13.8619 1.79891L11.2544 4.4064C10.5225 5.13828 10.5225 6.32578 11.2544 7.05766L13.8619 9.66516C14.5937 10.397 15.7813 10.397 16.5131 9.66516ZM9.875 3.54453C9.875 3.04703 9.6775 2.57015 9.32563 2.2189C8.97438 1.86703 8.4975 1.66953 8 1.66953C6.75875 1.66953 4.86625 1.66953 3.625 1.66953C3.1275 1.66953 2.65062 1.86703 2.29937 2.2189C1.9475 2.57015 1.75 3.04703 1.75 3.54453V7.91953C1.75 8.41703 1.9475 8.89391 2.29937 9.24516C2.65062 9.59703 3.1275 9.79453 3.625 9.79453H8C8.4975 9.79453 8.97438 9.59703 9.32563 9.24516C9.6775 8.89391 9.875 8.41703 9.875 7.91953V3.54453Z"
                                        fill="currentColor"/>
                                </svg>
                                <span class="category-menu-toggle-btn-text">
                                    Categories
                                </span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mobile-nav-menu">
                        <li class="nav-item {{request()->is('/')?'active':''}}">
                            <a class="nav-link mobile-nav-link" href="{{route('home')}}">
                                <i class="fa fa-home mr-3"></i>{{ translate('home')}}
                            </a>
                        </li>
                        <li class="nav-item {{request()->is('/')?'active':''}}">
                            <a class="nav-link mobile-nav-link" href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">
                                <i class="fa fa-star mr-3"></i>Featured Deal
                            </a>
                        </li>
                        <li class="nav-item {{request()->is('/')?'active':''}}">
                            <a class="nav-link mobile-nav-link" href="{{route('products',['id'=> 473,'data_from'=>'category','page'=>1])}}">
                            <i class="fa fa-star mr-3"></i>Furniture
                            </a>
                        </li>
                        @if(getWebConfig(name: 'product_brand'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle mobile-nav-link" href="#"
                                   data-toggle="dropdown">
                                   <i class="fa fa-tags mr-3"></i>{{ translate('brand') }}
                                </a>
                                <ul class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} scroll-bar" style="height: 54vh; overflow-y: scroll !important;">
                                    @foreach(\App\Utils\BrandManager::get_active_brands() as $brand)
                                    <li class="__inline-17">
                                        <div class="dropdown-item d-flex">
                                                <a target="_blank" class=""
                                                href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}">
                                                        <span>{{$brand['name']}}</span>
                                                        @if($brand['brand_products_count'] > 0 )
                                                            <span class="count-value px-2">( {{ $brand['brand_products_count'] }} )</span>
                                                    @endif
                                                </a>
                                        </div>
                                                {{-- <div class="align-baseline">
                                                    @if($brand['brand_products_count'] > 0 )
                                                    <span class="count-value px-2">( {{ $brand['brand_products_count'] }} )</span>
                                                    @endif
                                                </div> --}}
                                    </li>
                                    @endforeach
                                    <li class="__inline-17">
                                        <div class="dropdown-item">
                                            <a class="dropdown-item web-text-primary" href="{{route('brands')}}">
                                                {{ translate('view_more') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @php($categories=\App\Models\Category::with(['childes.childes'])->where('position', 0)->where('id', '!=', 473)->priority()->paginate(11))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle mobile-nav-link" href="#" id="categoryDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-th-large mr-3"></i>{{ translate('Categories') }}
                            </a>

                            <ul class="dropdown-menu __dropdown-menu-sizing text-align-direction dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }} scroll-bar" aria-labelledby="categoryDropdown">
                                @foreach($categories as $category)
                                <li class="__inline-17 dropdown-submenu position-relative">
                                    <div class="dropdown-item p-0">
                                        <a class="dropdown-item w-100 d-flex justify-content-between align-items-center {{ $category->childes->count() ? 'has-children' : '' }}"
                                            href="{{ route('products', ['id' => $category->id, 'data_from' => 'category', 'page' => 1]) }}">
                                            <span>{{ $category->name }}</span>
                                            @if($category->childes->count())
                                            <i class="fa fa-angle-right transition-arrow"></i>
                                            @endif
                                        </a>
                                    </div>

                                    @if($category->childes->count())
                                    <ul class="mobile-child-list" style="display: none; list-style: none; padding-left: 20px;">
                                        @foreach($category->childes as $sub)
                                        <li>
                                            <a class="dropdown-item py-2" href="{{ route('products', ['id' => $sub->id, 'data_from' => 'category', 'page' => 1]) }}">
                                                {{ $sub->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item {{request()->is('/')?'active':''}}">
                            <a class="nav-link mobile-nav-link" href="{{ url('about-us') }}">
                                <i class="fa fa-info-circle mr-3"></i>About Us
                            </a>
                        </li>
                        @php($businessMode = getWebConfig(name: 'business_mode'))
                        @if ($businessMode == 'multi')
                            <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                                <a class="nav-link text-capitalize mobile-nav-link"
                                    href="{{route('vendors')}}">
                                    <i class="fa fa-store mr-3"></i>{{ translate('all_vendors')}}
                                </a>
                            </li>
                        @endif
                        @if(auth('customer')->check())
                            <li class="nav-item d-md-none">
                                <a href="{{route('user-account')}}" class="nav-link text-capitalize mobile-nav-link">
                                    <i class="fa fa-user mr-3"></i>{{ translate('user_profile')}}
                                </a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a href="{{route('wishlists')}}" class="nav-link mobile-nav-link">
                                    <i class="fa fa-heart mr-3"></i>{{ translate('Wishlist')}}
                                </a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a href="{{route('account-oder')}}" class="nav-link mobile-nav-link">
                                    <i class="fa fa-list-alt mr-3"></i>{{ translate('My Orders')}}
                                </a>
                            </li>
                        @endif
                        @if ($businessMode == 'multi')
                            @if(getWebConfig(name: 'seller_registration'))
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle text-white text-max-md-dark text-capitalize ps-2 mobile-nav-link"
                                                type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-user-tie mr-3"></i>{{ translate('vendor_zone')}}
                                        </button>
                                        <div class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item text-capitalize" href="{{route('vendor.auth.registration.index')}}">
                                                {{ translate('become_a_vendor')}}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{route('vendor.auth.login')}}">
                                                {{ translate('vendor_login')}}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endif
                    </ul>
                    <!-- new added wishlist starts -->
                    <div class="navbar-toolbar d-none d-md-flex flex-shrink-0 align-items-center justify-content-center">
                        <a class="navbar-tool navbar-stuck-toggler" href="#">
                            <span class="navbar-tool-tooltip">{{ translate('expand_Menu') }}</span>
                            <div class="navbar-tool-icon-box">
                                <i class="navbar-tool-icon czi-menu open-icon"></i>
                                <i class="navbar-tool-icon czi-close close-icon"></i>
                            </div>
                        </a>
                        <div class="navbar-tool dropdown d-none d-md-block {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
                            <a class="navbar-tool-icon-box bg-secondary dropdown-toggle d-flex align-items-center justify-content-center mr-0" href="{{route('wishlists')}}">
                                <span class="navbar-tool-label">
                                    <span class="countWishlist">
                                        {{session()->has('wish_list')?count(session('wish_list')):0}}
                                    </span>
                                </span>
                               <img src="{{ asset('public/assets/front-end/img/added/icons/wishlist-icon.png') }}" alt="wishlist" style="width: 25px;">
                                {{-- <i class="navbar-tool-icon czi-heart nav-def-icon"></i> --}}
                            </a>
                        </div>
                        <div id="cart_items">
                            @include('layouts.front-end.partials._cart')
                        </div>
                        @if(auth('customer')->check())
                            <div class="dropdown navbar-tool">
                                <a class="navbar-tool-icon-box ml-3" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if (auth('customer')->user()->image != 'def.png')
                                                <img class="img-profile __inline-14" alt="" style="border-radius: 6px;"
                                                    src="{{ getValidImage(path: 'storage/app/public/profile/'.auth('customer')->user()->image, type: 'avatar') }}">
                                        @else
                                                <div class="">
                                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                                </div>
                                        @endif
                                    </div>
                                    <div class="navbar-tool-text">
                                        <small>{{ translate('hello')}}, {{auth('customer')->user()->f_name}}</small>
                                        {{ translate('dashboard')}}
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                        href="{{route('account-oder')}}"> {{ translate('my_Order')}} </a>
                                    <a class="dropdown-item"
                                        href="{{route('user-account')}}"> {{ translate('my_Profile')}}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                        href="{{route('customer.auth.logout')}}">{{ translate('logout')}}</a>
                                </div>
                            </div>
                        @else
                            <div class="dropdown navbar-tool responsive-user-icon">
                                <a class="navbar-tool-icon-box {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}"
                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="">
                                        <i class="fa fa-user-o fa-lg" aria-hidden="true"></i>
                                    </div>
                                </a>
                                <div class="text-align-direction dropdown-menu __auth-dropdown dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('customer.auth.login')}}">
                                        <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in')}}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('customer.auth.sign-up')}}">
                                        <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up')}}
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown responsive-login-text">
                                <a class="navbar-tool {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}"
                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="login-reg-btn">
                                        Login / Register
                                    </div>
                                </a>
                                <div class="text-align-direction dropdown-menu __auth-dropdown dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('customer.auth.login')}}">
                                        <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in')}}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('customer.auth.sign-up')}}">
                                        <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up')}}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- new added wishlist ends -->
                </div>
            </div>
        </div>
    </div>
</header>
@push('script')
    <script>
        "use strict";
        const arrowDirection = "{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}";
        $(".category-menu").find(".mega_menu").parents("li").each(function () {
            const $link = $(this).find("> a");
            // Check if the arrow icon already exists
            if ($link.find(".czi-arrow-left, .czi-arrow-right").length === 0) {
                $link.append(`<i class='czi-arrow-${arrowDirection}'></i>`);
            }
        });

        // Mobile Menu Functionality
        $(document).ready(function() {
            $('.has-children').on('click', function(e) {
        // Only run this logic on mobile
        if ($(window).width() <= 767) {
            e.preventDefault(); // Stop the link from navigating
            e.stopPropagation();

            // Find the sub-list directly under this list item
            const $subList = $(this).closest('li').find('.mobile-child-list');

            // Toggle the visibility
            $subList.slideToggle(200);

            // Toggle the arrow rotation class
            $(this).toggleClass('opened');
        }
    });
            if ($(window).width() >= 768) {

                $('.subcategory-toggle-btn').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Find the list immediately after this button's parent div
                    const $list = $(this).closest('.dropdown-item').siblings('.mobile-sub-list');

                    // Toggle the list and the arrow rotation
                    $list.toggleClass('active');
                    $(this).toggleClass('open');
                });

                // Main dropdown
                $('.nav-item.dropdown').hover(
                    function () {
                        $(this).addClass('show');
                        $(this).children('.dropdown-menu').addClass('show');
                    },
                    function () {
                        $(this).removeClass('show');
                        $(this).children('.dropdown-menu').removeClass('show');
                    }
                );

                // Submenu
                $('.dropdown-submenu').hover(
                    function () {
                        $(this).children('.sub-menu').addClass('show').show();
                    },
                    function () {
                        $(this).children('.sub-menu').removeClass('show').hide();
                    }
                );
            }

            // Add overlay to body
            $('body').append('<div class="mobile-menu-overlay"></div>');

            // Handle mobile menu toggle
            $('.navbar-toggler[data-target="#navbarCollapse"]').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $menu = $('#navbarCollapse');
                const $overlay = $('.mobile-menu-overlay');

                console.log('Toggle clicked, current state:', $menu.hasClass('show'));

                if ($menu.hasClass('show')) {
                    $menu.removeClass('show');
                    $overlay.removeClass('show');
                    $('body').removeClass('menu-open');
                } else {
                    $menu.addClass('show');
                    $overlay.addClass('show');
                    $('body').addClass('menu-open');
                }
            });

            // Close menu when clicking overlay
            $('.mobile-menu-overlay').on('click', function() {
                $('#navbarCollapse').removeClass('show');
                $(this).removeClass('show');
                $('body').removeClass('menu-open');
            });

            // Close menu when clicking close button
            $('.mobile-menu-header .navbar-toggler').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                $('#navbarCollapse').removeClass('show');
                $('.mobile-menu-overlay').removeClass('show');
                $('body').removeClass('menu-open');
            });

            // Close menu when clicking on a link (for mobile) - but not dropdown toggles
            $('.mobile-nav-link').on('click', function(e) {
                // Don't close menu if it's a dropdown toggle
                if ($(this).hasClass('dropdown-toggle')) {
                    e.stopPropagation();
                    return;
                }

                if ($(window).width() <= 767) {
                    setTimeout(function() {
                        $('#navbarCollapse').removeClass('show');
                        $('.mobile-menu-overlay').removeClass('show');
                        $('body').removeClass('menu-open');
                    }, 300);
                }
            });

                    // Prevent dropdown clicks from closing the mobile menu
            $('.mobile-nav-menu .dropdown-toggle').on('click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                // Toggle the dropdown manually
                const $dropdown = $(this).next('.dropdown-menu');
                $('.dropdown-menu').not($dropdown).removeClass('show');
                $dropdown.toggleClass('show');
            });

                    // Handle sub-category dropdowns
            $('.mobile-nav-menu .dropdown-submenu > .dropdown-item').on('click', function(e) {
                if ($(window).width() <= 767) {
                    e.preventDefault();
                    e.stopPropagation();

                    const $subMenu = $(this).siblings('.sub-menu');

                    // Toggle this menu
                    $subMenu.toggleClass('show');

                    // Optional: Close other open sub-menus at the same level
                    $(this).closest('li').siblings().find('.sub-menu').removeClass('show');
                }
            });

            // Handle hover for sub-categories (for better mobile experience)
            $('.mobile-nav-menu .dropdown-submenu').on('mouseenter', function() {
                const $subMenu = $(this).find('.sub-menu');
                if ($subMenu.length > 0) {
                    $('.sub-menu').not($subMenu).removeClass('show');
                    $subMenu.addClass('show');
                }
            });

            $('.mobile-nav-menu .dropdown-submenu').on('mouseleave', function() {
                const $subMenu = $(this).find('.sub-menu');
                if ($subMenu.length > 0) {
                    // Don't hide immediately, give user time to move to sub-menu
                    setTimeout(() => {
                        if (!$subMenu.is(':hover')) {
                            $subMenu.removeClass('show');
                        }
                    }, 200);
                }
            });

            // Close sub-menus when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown-submenu').length) {
                    $('.sub-menu').removeClass('show');
                }
            });

            // Close dropdowns when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });

            // Prevent Bootstrap's default collapse behavior on mobile
            if ($(window).width() <= 767) {
                $('#navbarCollapse').on('show.bs.collapse', function(e) {
                    e.preventDefault();
                    $(this).addClass('show');
                    $('.mobile-menu-overlay').addClass('show');
                    $('body').addClass('menu-open');
                });

                $('#navbarCollapse').on('hide.bs.collapse', function(e) {
                    e.preventDefault();
                    $(this).removeClass('show');
                    $('.mobile-menu-overlay').removeClass('show');
                    $('body').removeClass('menu-open');
                });
            }

            // Desktop Category Dropdown Widget (scoped, no conflict with mobile)
            if ($(window).width() >= 768) {
                const $trigger = $('#gdmCatTrigger');
                const $menu = $('#gdmCatMenu');

                $trigger.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $trigger.toggleClass('active');
                    $menu.toggleClass('active');
                });

                // Close when clicking outside
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.gdm-catdd').length) {
                        $trigger.removeClass('active');
                        $menu.removeClass('active');
                    }
                });
            }
        });
    </script>
@endpush

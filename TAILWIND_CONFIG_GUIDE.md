/**
 * Tailwind CSS Configuration Guide
 * =================================
 * 
 * Color Palette:
 * - Blue (Primary): blue-50 to blue-900
 * - Slate (Text): slate-50 to slate-900
 * - Gray (Background): gray-50 to gray-900
 * - Green (Success): green-50 to green-900
 * - Red (Danger): red-50 to red-900
 * - Yellow (Warning): yellow-50 to yellow-900
 * 
 * Usage:
 * - Primary action: blue-600
 * - Secondary action: gray-100 (bg) + gray-700 (text)
 * - Danger action: red-600
 * - Success action: green-600
 * 
 * Breakpoints:
 * - sm: 640px
 * - md: 768px
 * - lg: 1024px
 * - xl: 1280px
 */

module.exports = {
  theme: {
    extend: {
      colors: {
        primary: '#2563eb',      // blue-600
        secondary: '#0f172a',    // slate-900
        success: '#16a34a',      // green-600
        danger: '#dc2626',       // red-600
        warning: '#ca8a04',      // yellow-600
        info: '#0ea5e9',         // cyan-600
      },
      spacing: {
        // Already includes all Tailwind defaults (4px increments)
        // p-4, p-6, p-8, etc. are automatically available
      },
      borderRadius: {
        // Card: 1rem (16px)
        card: '1rem',
        // Button: 0.75rem (12px)
        button: '0.75rem',
      },
      boxShadow: {
        // Default
        'sm': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
        // Hover
        'md': '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
        // Focus
        'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1)',
      },
      fontFamily: {
        'sans': ['Inter', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        // Headings
        'h1': ['2.25rem', { lineHeight: '2.5rem', fontWeight: '800' }],
        'h2': ['1.875rem', { lineHeight: '2.25rem', fontWeight: '700' }],
        'h3': ['1.5rem', { lineHeight: '2rem', fontWeight: '700' }],
        // Body
        'body-lg': ['1.125rem', { lineHeight: '1.75rem', fontWeight: '400' }],
        'body': ['1rem', { lineHeight: '1.5rem', fontWeight: '400' }],
        'body-sm': ['0.875rem', { lineHeight: '1.25rem', fontWeight: '400' }],
      },
    },
  },
};

/*
 * RESPONSIVE UTILITIES GUIDE
 * ==========================
 * 
 * Mobile First Approach:
 * 
 * By default styles apply to all breakpoints
 * Add breakpoint prefix for specific screens
 * 
 * Example:
 * <div class="p-4 md:p-6 lg:p-8">
 *   Padding: 16px on mobile, 24px on tablet, 32px on desktop
 * </div>
 * 
 * Breakpoints:
 * - sm: 640px (phones landscape)
 * - md: 768px (tablets)
 * - lg: 1024px (desktops)
 * - xl: 1280px (large desktops)
 * 
 * Grid Examples:
 * 
 * 1 col mobile → 2 col tablet → 3 col desktop:
 * <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
 * 
 * Hide on mobile, show on desktop:
 * <div class="hidden md:block">
 * 
 * Full width on mobile, 50% on desktop:
 * <div class="w-full md:w-1/2">
 */

/*
 * DARK MODE (if needed in future)
 * ==============================
 * 
 * Add to Tailwind config:
 * darkMode: 'class'
 * 
 * Usage:
 * <div class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
 *   Content
 * </div>
 */

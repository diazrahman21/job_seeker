<!-- 
UI Component Examples & Usage Reference
========================================
Copy-paste ready code snippets for consistent UI implementation
-->

<!-- CARD EXAMPLES -->
<div class="space-y-4">
    <!-- Basic Card -->
    <x-card>
        Card content goes here
    </x-card>

    <!-- Card with Title -->
    <x-card title="My Card Title">
        Card content goes here
    </x-card>

    <!-- Card with Custom Class -->
    <x-card title="Styled Card" class="border-2 border-blue-500">
        Special styled card
    </x-card>
</div>

<!-- BUTTON EXAMPLES -->
<div class="flex flex-wrap gap-4">
    <!-- Primary Buttons -->
    <x-button variant="primary" size="sm">Small Primary</x-button>
    <x-button variant="primary" size="md">Medium Primary</x-button>
    <x-button variant="primary" size="lg">Large Primary</x-button>

    <!-- Secondary Buttons -->
    <x-button variant="secondary" size="md">Secondary</x-button>

    <!-- Danger Buttons -->
    <x-button variant="danger" size="md">Delete</x-button>

    <!-- Success Buttons -->
    <x-button variant="success" size="md">Approve</x-button>

    <!-- Disabled State -->
    <x-button variant="primary" disabled>Disabled</x-button>

    <!-- With onclick -->
    <x-button variant="primary" onclick="alert('Clicked!')">Click Me</x-button>
</div>

<!-- BADGE EXAMPLES -->
<div class="flex flex-wrap gap-4">
    <x-badge status="applied">Applied</x-badge>
    <x-badge status="review">Under Review</x-badge>
    <x-badge status="interview">Interview</x-badge>
    <x-badge status="rejected">Rejected</x-badge>
    <x-badge status="hired">Hired</x-badge>
    <x-badge status="pending">Pending</x-badge>
    <x-badge status="active">Active</x-badge>
    <x-badge status="suspended">Suspended</x-badge>
    <x-badge status="approved">Approved</x-badge>
</div>

<!-- INPUT EXAMPLES -->
<x-card title="Form Inputs">
    <form class="space-y-4">
        <!-- Text Input -->
        <x-input 
            name="name" 
            label="Full Name" 
            placeholder="John Doe"
            value="John"
        />

        <!-- Email Input -->
        <x-input 
            name="email" 
            type="email"
            label="Email Address"
            placeholder="john@example.com"
            required
        />

        <!-- Password Input -->
        <x-input 
            name="password" 
            type="password"
            label="Password"
            placeholder="••••••••"
            required
        />

        <!-- Textarea -->
        <x-input 
            name="description"
            type="textarea"
            label="Description"
            placeholder="Enter details..."
            value="Some text"
        />

        <!-- Select Dropdown -->
        <x-input 
            name="status"
            type="select"
            label="Status"
            value="active"
        >
            <option value="">Select status...</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="pending">Pending</option>
        </x-input>

        <!-- With Error -->
        <x-input 
            name="username" 
            label="Username"
            placeholder="username"
            error="Username must be unique"
        />
    </form>
</x-card>

<!-- EMPTY STATE EXAMPLES -->
<!-- Default empty state -->
<x-empty-state 
    title="No Data Found"
    description="There are no items to display"
    icon="document"
/>

<!-- With action button -->
<x-empty-state 
    title="No Lowongan Found"
    description="Start by creating a new job posting"
    icon="briefcase"
    buttonText="Create Job"
    buttonUrl="/jobs/create"
/>

<!-- MODAL EXAMPLES -->
<x-card>
    <x-button onclick="openModal('deleteModal')" variant="danger">Delete Item</x-button>
    
    <x-modal id="deleteModal" title="Confirm Delete">
        <p>Are you sure you want to delete this item? This action cannot be undone.</p>
        <div class="flex gap-3 mt-6">
            <x-button variant="danger" onclick="confirmDelete()">Yes, Delete</x-button>
            <x-button variant="secondary" onclick="closeModal('deleteModal')">Cancel</x-button>
        </div>
    </x-modal>
</x-card>

<!-- LAYOUT EXAMPLES -->

<!-- Two Column Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <x-card title="Column 1">Content</x-card>
    <x-card title="Column 2">Content</x-card>
</div>

<!-- Three Column Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <x-card title="Card 1">Content</x-card>
    <x-card title="Card 2">Content</x-card>
    <x-card title="Card 3">Content</x-card>
</div>

<!-- Four Column Grid (Stats) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <x-card>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-600">Total Users</p>
                <p class="text-3xl font-bold mt-2">1,234</p>
            </div>
            <span class="text-4xl">👥</span>
        </div>
    </x-card>
</div>

<!-- TABLE WITH HOVER -->
<x-card>
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="pb-3 px-4 text-left font-semibold text-slate-600">Name</th>
                <th class="pb-3 px-4 text-left font-semibold text-slate-600">Email</th>
                <th class="pb-3 px-4 text-center font-semibold text-slate-600">Status</th>
                <th class="pb-3 px-4 text-center font-semibold text-slate-600">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b border-gray-100 hover:bg-gray-50">
                <td class="py-3 px-4">John Doe</td>
                <td class="py-3 px-4">john@example.com</td>
                <td class="py-3 px-4 text-center">
                    <x-badge status="active">Active</x-badge>
                </td>
                <td class="py-3 px-4 text-center">
                    <x-button size="sm" variant="secondary">Edit</x-button>
                </td>
            </tr>
        </tbody>
    </table>
</x-card>

<!-- PAGE LAYOUT FULL EXAMPLE -->
@extends('layouts.admin', ['title' => 'Page Title'])

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Page Title</h2>
            <p class="text-slate-500 mt-1">Subtitle or description</p>
        </div>
        <x-button variant="primary">+ New Item</x-button>
    </div>

    <!-- Filters Section -->
    <x-card title="🔍 Filters">
        <form method="get" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-input name="search" label="Search" placeholder="..." />
                <x-input name="filter" type="select" label="Filter">
                    <option>All</option>
                    <option>Active</option>
                </x-input>
                <div class="flex items-end">
                    <x-button type="submit" variant="primary" class="w-full">Search</x-button>
                </div>
            </div>
        </form>
    </x-card>

    <!-- Content Section -->
    <x-card title="📋 Items">
        @if($items->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <!-- Table content -->
                </table>
            </div>
        @else
            <x-empty-state title="No items found" icon="document" />
        @endif
    </x-card>
</div>
@endsection

<!-- RESPONSIVE EXAMPLES -->

<!-- Hide on mobile -->
<div class="hidden md:block">
    Only visible on tablet and desktop
</div>

<!-- Hide on desktop -->
<div class="md:hidden">
    Only visible on mobile
</div>

<!-- Responsive grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <div>Item 1</div>
    <div>Item 2</div>
</div>

<!-- Responsive padding -->
<div class="p-4 md:p-6 lg:p-8">
    Content with responsive padding
</div>

<!-- STATUS COLOR MAPPING -->
@php
$statusColors = [
    'pending' => 'pending',
    'approved' => 'approved',
    'rejected' => 'rejected',
    'hired' => 'hired',
    'active' => 'active',
    'suspended' => 'suspended',
];
@endphp

<x-badge status="{{ $statusColors[$item->status] ?? 'default' }}">
    {{ ucfirst($item->status) }}
</x-badge>

<!-- ANIMATION EXAMPLES -->

<!-- Slide in (used automatically for alerts) -->
<div class="animate-slide-in">
    Content appears with slide-in effect
</div>

<!-- Fade in -->
<div class="animate-fade-in">
    Content appears with fade effect
</div>

<!-- Pulse loading -->
<div class="animate-pulse">
    <div class="h-4 bg-gray-300 rounded"></div>
    <div class="h-4 bg-gray-300 rounded mt-2 w-3/4"></div>
</div>

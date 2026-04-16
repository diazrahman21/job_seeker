# UI/UX Standardization Guide

## Design System Global

### Color Palette
```
Primary: blue-600 (#2563eb)
Secondary: slate-900 (#0f172a)
Background: gray-50 (#f9fafb)
Success: green-600 (#16a34a)
Warning: yellow-600 (#ca8a04)
Danger: red-600 (#dc2626)
Info: cyan-600 (#0891b2)
```

### Spacing
- Padding: p-4, p-6, p-8
- Gap: gap-4, gap-6
- Margin: mb-4, mb-6, mt-4, mt-6

### Border & Shadow
- Border Radius Card: rounded-2xl
- Border Radius Button: rounded-xl
- Shadow Default: shadow-sm
- Shadow Hover: shadow-md

### Typography
- Font Family: Inter (system default)
- Font Sizes:
  - Display: text-3xl md:text-4xl (header)
  - Title: text-2xl (page title)
  - Subtitle: text-lg (section title)
  - Body: text-base (default)
  - Small: text-sm (labels)
  - Extra Small: text-xs (meta)

---

## Reusable Components

### 1. x-card
```blade
<x-card title="Card Title">
    Your content here
</x-card>
```

### 2. x-button
```blade
<x-button variant="primary" size="md">Click Me</x-button>
<!-- Variants: primary, secondary, danger, success -->
<!-- Sizes: sm, md, lg -->
```

### 3. x-badge
```blade
<x-badge status="applied">Applied</x-badge>
<!-- Status: applied, review, interview, rejected, hired, pending, active, suspended -->
```

### 4. x-input
```blade
<x-input name="email" type="email" label="Email" placeholder="user@example.com" />
```

### 5. x-empty-state
```blade
<x-empty-state 
    title="No Data" 
    description="There is no data to display"
    icon="briefcase"
    buttonText="Create New"
    buttonUrl="/create"
/>
```

### 6. x-modal
```blade
<x-modal id="myModal" title="Modal Title">
    Modal content here
</x-modal>

<button onclick="openModal('myModal')">Open</button>
```

---

## Layout Structure

### Admin Panel Layout
```blade
@extends('layouts.admin', ['title' => 'Page Title'])

@section('content')
    <!-- Use x-card, x-badge, x-button components -->
    <x-card title="Section Title">
        Content here
    </x-card>
@endsection
```

### Job Seeker Dashboard Layout
```blade
@extends('layouts.job-seeker', ['title' => 'Page Title'])

@section('content')
    Content here
@endsection
```

### Recruiter Dashboard Layout
```blade
@extends('layouts.recruiter', ['title' => 'Page Title'])

@section('content')
    Content here
@endsection
```

---

## Page Template Examples

### List Page
```blade
<div class="space-y-6">
    <!-- Header with Actions -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold">Items</h2>
        <x-button variant="primary">+ New Item</x-button>
    </div>

    <!-- Filters (Optional) -->
    <div class="flex gap-4">
        <x-input name="search" placeholder="Search..." />
        <x-input name="filter" type="select">
            <option>All</option>
            <option>Active</option>
        </x-input>
    </div>

    <!-- Table or Cards -->
    <x-card>
        <table class="w-full">
            <!-- Table structure -->
        </table>
    </x-card>

    <!-- Empty State (if needed) -->
    @if($items->isEmpty())
        <x-empty-state title="No items found" icon="document" />
    @endif
</div>
```

### Detail Page
```blade
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold">{{ $item->name }}</h2>
            <p class="text-slate-500">ID: {{ $item->id }}</p>
        </div>
        <div class="flex gap-2">
            <x-button variant="secondary">Edit</x-button>
            <x-button variant="danger">Delete</x-button>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-card title="Status">
            <x-badge status="{{ $item->status }}">{{ ucfirst($item->status) }}</x-badge>
        </x-card>
    </div>

    <!-- Details -->
    <x-card title="Details">
        <!-- Details content -->
    </x-card>
</div>
```

### Form Page
```blade
<x-card title="Form Title">
    <form method="POST" action="{{ route('store') }}" class="space-y-4">
        @csrf
        
        <x-input name="title" label="Title" placeholder="Enter title" required />
        
        <x-input name="description" label="Description" type="textarea" 
                 placeholder="Enter description" />
        
        <x-input name="status" label="Status" type="select">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </x-input>

        <div class="flex gap-3 pt-4">
            <x-button type="submit" variant="primary">Save</x-button>
            <x-button type="button" variant="secondary" onclick="window.history.back()">Cancel</x-button>
        </div>
    </form>
</x-card>
```

---

## Responsive Breakpoints

```
Mobile: < 640px (full width, single column)
Tablet: 640px - 1024px (2-3 columns)
Desktop: > 1024px (full grid layout)
```

### Grid Usage
```blade
<!-- 1 column on mobile, 2 on tablet, 3 on desktop -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    ...
</div>
```

---

## Status Badge Colors (Global)

| Status | Color | Class |
|--------|-------|-------|
| Applied | Blue | `status-applied` |
| Review | Yellow | `status-review` |
| Interview | Purple | `status-interview` |
| Rejected | Red | `status-rejected` |
| Hired | Green | `status-hired` |
| Pending | Yellow | `status-pending` |
| Active | Green | `status-active` |
| Suspended | Red | `status-suspended` |

---

## Common Patterns

### Empty State
```blade
@if($collection->isEmpty())
    <x-empty-state 
        title="No Data Available"
        description="Start by creating a new item"
        icon="document"
        buttonText="Create New"
        buttonUrl="{{ route('create') }}"
    />
@endif
```

### Loading State
```blade
<!-- Use animate-pulse for skeleton loading -->
<div class="animate-pulse">
    <div class="h-4 bg-gray-300 rounded"></div>
    <div class="h-4 bg-gray-300 rounded mt-2"></div>
</div>
```

### Table Structure
```blade
<table class="w-full">
    <thead>
        <tr class="border-b border-gray-200">
            <th class="pb-3 px-4 text-left font-semibold">Column</th>
        </tr>
    </thead>
    <tbody>
        <tr class="border-b border-gray-100 hover:bg-gray-50">
            <td class="py-3 px-4">Data</td>
        </tr>
    </tbody>
</table>
```

---

## Implementation Checklist

- [ ] Use x-card for containers
- [ ] Use x-button with proper variant
- [ ] Use x-badge for status badges
- [ ] Use x-input for form fields
- [ ] Add empty state when applicable
- [ ] Use rounded-2xl for cards
- [ ] Use gap-6 for spacing
- [ ] Use blue-600 for primary actions
- [ ] Add hover effects (shadow-md)
- [ ] Make responsive (mobile, tablet, desktop)


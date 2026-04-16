@props(['name', 'label' => null, 'type' => 'text', 'placeholder' => '', 'value' => null, 'error' => null, 'required' => false, 'class' => ''])

<div class="mb-4">
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-semibold text-slate-900 mb-2">
        {{ $label }}
        @if($required)
        <span class="text-red-600">*</span>
        @endif
    </label>
    @endif

    @if($type === 'textarea')
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-slate-900 placeholder-slate-500 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm hover:shadow-sm {{ $error ? 'border-red-500 focus:ring-red-500' : '' }} {{ $class }}"
        {{ $attributes }}
        @required($required)
    >{{ old($name, $value) }}</textarea>
    @elseif($type === 'select')
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-slate-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm hover:shadow-sm {{ $error ? 'border-red-500 focus:ring-red-500' : '' }} {{ $class }}"
        {{ $attributes }}
        @required($required)
    >
        {{ $slot }}
    </select>
    @else
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-slate-900 placeholder-slate-500 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm hover:shadow-sm {{ $error ? 'border-red-500 focus:ring-red-500' : '' }} {{ $class }}"
        {{ $attributes }}
        @required($required)
    />
    @endif

    @if($error)
    <p class="mt-2 text-sm font-medium text-red-600">{{ $error }}</p>
    @endif
</div>

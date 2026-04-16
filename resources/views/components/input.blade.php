@props(['name', 'label' => null, 'type' => 'text', 'placeholder' => '', 'value' => null, 'error' => null, 'required' => false, 'class' => ''])

<div class="mb-4">
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-900 mb-2">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif

    @if($type === 'textarea')
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="block w-full px-4 py-2 border border-gray-300 rounded-xl text-slate-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all {{ $error ? 'border-red-500' : '' }} {{ $class }}"
        {{ $attributes }}
        @required($required)
    >{{ old($name, $value) }}</textarea>
    @elseif($type === 'select')
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        class="block w-full px-4 py-2 border border-gray-300 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all {{ $error ? 'border-red-500' : '' }} {{ $class }}"
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
        class="block w-full px-4 py-2 border border-gray-300 rounded-xl text-slate-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all {{ $error ? 'border-red-500' : '' }} {{ $class }}"
        {{ $attributes }}
        @required($required)
    />
    @endif

    @if($error)
    <p class="mt-1 text-sm text-red-500">{{ $error }}</p>
    @endif
</div>

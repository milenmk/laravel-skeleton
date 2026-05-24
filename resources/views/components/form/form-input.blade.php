@props([
    "fieldName" => "",
    "type" => "text",
    "placeholder" => "",
    "svgIcon" => null,
    "required" => false,
    "value" => "",
    "fieldClass" => null,
    "wireModel" => null,
    "autofocus" => false,
])

<input
    id="{{ $fieldName }}"
    name="{{ $fieldName }}"
    type="{{ $type }}"
    value="{{ $value }}"
    placeholder="{{ __($placeholder) }}"
    @if ($required) required @endif
    @if ($type === "checkbox")
        {{ $attributes->merge(["class" => "form-checkbox placeholder:text-white-dark " . $fieldClass]) }}
    @else
        {{ $attributes->merge(["class" => "form-input placeholder:text-white-dark " . ($svgIcon != null ? "ps-10 " : "") . $fieldClass]) }}
    @endif
    @if ($wireModel)
        wire:model="{{ $wireModel }}"
    @endif
    @if ($autofocus) autofocus @endif
/>
@if ($svgIcon)
    <span class="absolute start-4 top-1/2 -translate-y-1/2">
        @svg("icon-" . $svgIcon)
    </span>
@endif

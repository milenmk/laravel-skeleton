@props([
    'fieldName' => '',
    'fieldLabel' => '',
    'fieldType' => 'text',
    'placeholder' => '',
    'svgIcon' => null,
    'required' => false,
    'value' => '',
    'labelClass' => null,
    'fieldClass' => null,
    'wireModel' => null,
    'autofocus' => false,
])
<label for="{{ $fieldName }}" class="{{ $labelClass }}">
    {{ $fieldLabel }}

    <div class="relative mt-1">
        <x-form.form-input
            {{ $attributes->merge(['class' => $fieldClass]) }}
            :fieldName="$fieldName"
            :type="$fieldType"
            :placeholder="$placeholder"
            :svgIcon="$svgIcon"
            :required="$required"
            :value="$value"
            :wireModel="$wireModel"
            :autofocus="$autofocus"
        />
    </div>

    {{ $slot }}
</label>

<x-custom-error-message field="{{ $fieldName }}" />

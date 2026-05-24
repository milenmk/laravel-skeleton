@props([
    "method" => "post",
    "action" => null,
    "wireSubmit" => null,
    "title" => "",
    "hasFormSection" => false,
    "formSectionCollapsible" => false,
    "formSectionHiddenByDefault" => true,
])

<form
    @if ($formSectionCollapsible)
        x-data="{
            isOpen: {{ $formSectionHiddenByDefault ? "false" : "true" }},
        }"
    @endif
    {{ $attributes->merge(["class" => "rounded-md border border-[#ebedf2] bg-gray-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]"]) }}
>
    @csrf
    @if ($hasFormSection && $formSectionCollapsible)
        <x-form.form-collapsible-section
            :title="$title"
            :formSectionCollapsible="$formSectionCollapsible"
            :formSectionHiddenByDefault="$formSectionHiddenByDefault"
            :data="$slot"
        />
    @else
        <div class="mt-4 space-y-4">
            <h6 class="text-lg font-bold">{{ $title }}</h6>

            {{ $slot }}
        </div>
    @endif
</form>
